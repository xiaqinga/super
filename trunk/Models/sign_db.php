<?php

/**
 * 联盟商分类
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class sign_db {
    //Db
    private $db = NULL;
    //database table
    private $table = '';
    //数据结果
    private $result = array('status'=>0,'data'=>NULL);

    /**
     * 初始化
     */
    public function __construct(&$db){
        $this->db = $db;
        $this->table = DB_PREFIX .'member_sign';

    }

    public function getlist($param){
        $where = array();

        if(isset($param['key']) && !empty($param['key_type'])){
        
            switch ($param['key_type']){
                case 'signStatus':$where['where']['signStatus']=$param['key'];
                    break;
                case 'schoolName':$where['like']['schoolName']=$param['key'];
                    break;
                case 'realName':$where['like']['realName']=$param['key'];
                    break;

            }
        }

        $where['where']['status'] = 1;


        $total = $this->db->total($this->table, $where);
        $this->result['data']['total'] = $total;

        if(!empty($param['id'])){
            $where['where']['a.id'] = $param['id'];
        }
        
        if( isset($param['limit']) )
        {
            $where['limit'] = $param['limit'];
        }
        $data  = $this->db->select($this->table,'', $where);

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
        $where['where']['mobilePhone']=$param['mobilePhone'];
        $result=$this->db->select($this->table,'mobilePhone',$where);

        if(!empty($result)){
            $ret = $this->db->update($this->table, $param,$where);
        }else{

            $ret = $this->db->insert($this->table, $param);
        }
        
        
        if($ret!==false){
            $this->result['status'] = 1;
        }else{
            $this->result['status'] = 0;
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
        }else{
            $this->result['status'] = 0;
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
         
            unset($param['id']);

            $setparam['status'] = '-1';
            $ret = $this->db->update($this->table, $setparam, $where);
            if ($ret !== false) {
                $this->result['status'] = 1;
                $this->result['data']['msg'] = '删除成功';
            } else {
                $this->result['status'] = 0;
                $this->result['data']['msg'] = '删除失败';
            }
        }

        return $this->result;
    }
   //获取单条信息
    public  function  getInfo($param){
        if (!empty($param['id']))
        {
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );



            $ret = $this->db->select($this->table, '', $where);
            if ($ret) {
                $this->result['status'] = 1;
                $this->result['data']['list']= $ret;
            } else {
                $this->result['status'] = 0;
                $this->result['data']['list'] = $ret;
            }
        }

        return $this->result;


    }
   //删除
    public function resetStatus(){

        $setparam['status'] = '0';
        $this->db->update($this->table, $setparam);


    }


   


}