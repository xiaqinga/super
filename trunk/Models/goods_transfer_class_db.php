<?php

/**
 * 物品转让分类表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class goods_transfer_class_db {
    //Db
    private $db = NULL;
    //database table
    private $table = 'goods_transfer_class';
    //数据结果
    private $result = array('status'=>0,'data'=>NULL);

    /**
     * 初始化
     */
    public function __construct(&$db){
        $this->db = $db;
        $this->table = DB_PREFIX . 'goods_transfer_class';
    }

    public function getlist($param){
        $where = array();

        if(!empty($param['key']) && !empty($param['key_type'])){
            if( $param['key_type'] == 'className' )
            {
                $where['like']['a.className']  = $param['key'];
            }
        }

        $where['where']['a.status >'] = 0;
        $where['where']['a.id !='] = 0;




        $total = $this->db->total($this->table.' a ', $where);
        $this->result['data']['total'] = $total;

        if(!empty($param['id'])){
            $where['where']['a.id'] = $param['id'];
        }

        if( isset($param['limit']) )
        {
            $where['limit'] = $param['limit'];
        }
        $data  = $this->db->select($this->table.' a ','a.*', $where);
        if(!empty($data))
        {
            $this->result['status'] = 1;
            $this->result['data']['list']   = $data;
        }
        else
        {
            $this->result['status'] = 0;
            $this->result['data']   = '获取数据失败';
        }
        return $this->result;
    }

    public function getItem($param){
        if($param['id']>=0 && $param['id']!==null){
            $where['where']['id'] = $param['id'];
            $where['order']['id'] = 'DESC';
            $data  = $this->db->select($this->table,'', $where);
        }
        if(!empty($data) && count($data)>0)
        {
            $this->result['status'] = 1;
            $this->result['data']   = $data[0];
        }
        else
        {
            $this->result['status'] = 0;
            $this->result['data']   = null;
        }
        return $this->result;
    }



    public function getJson($param){
        $where = array();

        $where['where']['status >'] = 0;
        $where['where']['id !='] = 0;


        if($param['id']>-1){
            $where['where']['parentId'] = $param['id'];

            $data  = $this->db->select($this->table, 'id,className', $where);
            if(count($data)>0){
                foreach ($data as $key => $value) {
                    $where_inner = array();

                    $where_inner['where']['status >'] = 0;
                    $where_inner['where']['id !='] = 0;

                    if(!empty($value['id'])){
                        $where_inner['where']['parentId'] = $value['id'];
                    }

                    $data_inner  = $this->db->select($this->table, 'className', $where_inner);
                    if(count($data_inner)>0)
                    {
                        $data[$key]['has_sub']=1;
                    }
                }
            }
        }

        if(!empty($data))
        {
            $this->result['status'] = 1;
            $this->result['data']['list']   = $data;
        }
        else
        {
            $this->result['status'] = 0;
            $this->result['data']   = '获取数据失败';
        }
        return $this->result;
    }



    /**
     * 添加
     * @return array
     */
    public function create($param){
        $ret = $this->db->insert($this->table, $param);

        if($ret){
            $this->result['status'] = 1;
            $where = array(
                'where' => array(
                    'id' => $this->db->last_id
                )
            );
            $data = $this->db->select($this->table, '', $where);

            //父分类下的
            $where_items = array(
                'where' => array(
                    'parentId' => $data[0]['parentId']
                )
            );
            $items = $this->db->select($this->table, '', $where_items);
            $itemsArr = array();
            foreach ($items as $key => $value) {
                $itemsArr[] = array(
                    'id' => $value['id'],
                    'className' => $value['className'],
                    'photoPath' => $value['photoUrl'],
                );
            }

            $getredis = array(
                'parentId' => $data[0]['parentId'],
                'items' => $itemsArr
            );
            $this->result['data']   = $getredis;
        }
        return $this->result;
    }

    /**
     * 编辑
     * @return array
     */
    public function update($param){
        $where = array(
            'where' => array(
                'id' => $param['id']
            )
        );

        unset($param['id']);
        $ret = $this->db->update($this->table, $param, $where);

        if($ret){
            $this->result['status'] = 1;
            $data = $this->db->select($this->table, '', $where);

            //父分类下的
            $where_items = array(
                'where' => array(
                    'parentId' => $data[0]['parentId']
                )
            );
            $items = $this->db->select($this->table, '', $where_items);
            $itemsArr = array();
            foreach ($items as $key => $value) {
                $itemsArr[] = array(
                    'id' => $value['id'],
                    'className' => $value['className'],
                    'photoPath' => $value['photoUrl'],
                );
            }

            $getredis = array(
                'parentId' => $data[0]['parentId'],
                'items' => $itemsArr
            );
            $this->result['data']   = $getredis;
        }
        return $this->result;
    }


    /**
     * 删除
     *
     * @param int $id
     * @return bool
     */
    function delete($param)
    {
        if (!empty($param['id']))
        {
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );
            $param['status'] = '-1';
            $uparam['where']['parentId']=$param['id'];
            $uparam['where']['status >'] = 0;
            unset($param['id']);
            $data = $this->db->select($this->table,'', $uparam);


            if (!$data)
            {
                $ret = $this->db->update($this->table,$param ,$where);
                if($ret){
                    $this->result['status'] = 1;
                }else{
                    $this->result['status'] = 0;
                }


            }
            else
            {
                $this->result['status'] = 0;
                $this->result['msg'] = '该分类下有子分类,无法删除';
            }
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }





    /*
    查询分类命是否重复
     */
    public function findrepeat($param){


        $where = array(
            'where' => array(
                'className' => $param['className'],
                'parentId' => $param['parentId']
            )
        );
        if (!empty($param['id'])) {
            $where['where']['id !=']=$param['id'];
        };
        $resp = $this->db->select($this->table,'id,status',$where);

        if($resp){
            $this->result['status'] = 1;
            $this->result['data'] = $resp;
        }else{
            $this->result['status'] = 0;
        }
        return $this->result;
    }


}