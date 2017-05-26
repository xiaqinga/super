<?php

/**
 * 学校地址管理
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class base_school_address_db{
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
        $this->table = DB_PREFIX .'base_school';
        

    }

    public function getlist($param){
        $where = array();

        if(isset($param['key']) && !empty($param['key_type'])){

            switch ($param['key_type']){
                case 'schoolCode':$where['where']['schoolCode']=$param['key'];
                    break;
                case 'schoolName':$where['like']['schoolName']=$param['key'];
                   
                    break;

            }
        }


        $where['where']['status ']=1;
        $total = $this->db->total($this->table, $where);

        $this->result['data']['total'] = $total;

      

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
        $ret=false;
        if(!empty($param['id'])){
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );

         $ret = $this->db->update($this->table, $param, $where);

        }
        
        if($ret!==false){
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


    public function getItem($param)
    {
        if (!empty($param['id']))
        {
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );

         $data = $this->db->select($this->table,'', $where);
           
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

    public  function checkName($param){
        $where['where']['schoolName']=$param['schoolName'];
        if(!empty($param['id'])){
            $where['where']['id !=']=$param['id']; 
        }
        $data = $this->db->select($this->table,'', $where);
        if(!empty($data))
        {
            $this->result['status'] = 1;
        }
        else
        {
            $this->result['status'] = 0;
        }
        return $this->result;
    }
}