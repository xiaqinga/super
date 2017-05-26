<?php

/**
 * 提问管理
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class member_question_db{
    //Db
    private $db = NULL;
    //database table
    private $table = '';
    private $table_customer = '';
    //数据结果
    private $result = array('status'=>0,'data'=>NULL);

    /**
     * 初始化
     */
    public function __construct(&$db){
        $this->db = $db;
        $this->table = DB_PREFIX .'member_question';
        $this->table_customer = DB_PREFIX .'member_customer';

    }

    public function getlist($param){
        $where = array();

        if(isset($param['key']) && !empty($param['key_type'])){

            switch ($param['key_type']){
                case 'details':$where['like']['a.details']=$param['key'];
                    break;
                case 'realName':$where['like']['b.realName']=$param['key'];
                                $where['like']['b.alias']=$param['key'];
                    break;

            }
        }


        $where['where']['a.status >']=-1;
        $total = $this->db->total($this->table .' a', $where);
         
        $this->result['data']['total'] = $total;

        if(!empty($param['id'])){
            $where['where']['a.id'] = $param['id'];
        }

        if( isset($param['limit']) )
        {
            $where['limit'] = $param['limit'];
        }
        $data  = $this->db->select($this->table.' a left join '.$this->table_customer
            .' b on a.customerId=b.id','a.*,b.realName,b.alias', $where);
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





}