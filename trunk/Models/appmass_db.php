<?php

/**
 * 用户模型
 * @author janhve@163.com
 * @since   2016-07-14
 * @version 1.0
 */

class appmass_db {
    //Db
    private $db = NULL;
    //database table
    private $table = 'app_mass';
    //数据结果
    private $result = array('status'=>0,'data'=>NULL);

    /**
     * 初始化
     */
    public function __construct(&$db){
        $this->db = $db;
        $this->table = DB_PREFIX . 'app_mass';

    }



    public function getlist($param){
        $where='';
        $total = $this->db->total($this->table, $where);
        $this->result['data']['total'] = $total;
        $where['order']['createDate'] = 'DESC';
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
            $this->result['data']   = $param;
        }
        else{
            $this->result['status'] = 0;
            $this->result['data']   = '群发添加失败';
        }
        return $this->result;
    }

    /**
     *
     * @return array获取一条数据
     */
    public function find($param){
        $where = array(
            'where' => array(
                'id' => $param['id']
            )
        );


        $ret = $this->db->select($this->table,'', $where);
        if($ret){
            $this->result['status'] = 1;
            $this->result['data']['list']   = $ret;
        }
        else{
            $this->result['status'] = 0;
            $this->result['data']   = '更新群发信息失败';
        }
        return $this->result;
    }

    /**
     * 删除指关键字值的数据
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
            $ret   = $this->db->delete($this->table, $where);
            if ($ret)
            {
                $this->result['status'] = 1;
                $this->result['data']   = $param; //返回完整的记录信息
            }
            else
            {
                $this->result['status'] = 0;
            }
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }

}