<?php

/**
 * 转让物品表
 *
 * @author wsbnet@qq.com
 * @since   2016-11-18
 * @version 1.0
 */

class goods_transfer_db {
    //Db
    private $db = NULL;
    //database table
    private $table = 'goods_transfer_goods';
    private $table_customer  = 'member_customer';
    private $table_class  = 'goods_transfer_class';


    //数据结果
    private $result = array('status'=>0,'data'=>NULL);

    /**
     * 初始化
     */

    public function __construct(&$db){
        $this->db = $db;
        $this->table = DB_PREFIX . 'goods_transfer_goods';
        $this->table_customer = DB_PREFIX . 'member_customer';
        $this->table_class = DB_PREFIX . 'goods_transfer_class';



    }

    public function getlist($param){
        $where = array();

        if(!empty($param['key']) && !empty($param['key_type'])){

            if( $param['key_type'] == 'customerName' )
            {
                $where['like']['b.alias']  = $param['key'];
            }
            if( $param['key_type'] == 'linkMan' )
            {
                $where['like']['a.linkMan']  = $param['key'];
            }
            if( $param['key_type'] == 'goodsName' )
            {
                $where['like']['a.goodsName']  = $param['key'];
            }

        }


        $total = $this->db->total($this->table.' a  left join '.$this->table_customer.' b on a.customerId = b.id  left 
        join '.$this->table_class.' c on a.classId = c.id ', $where);

        $this->result['data']['total'] = $total;

        if(!empty($param['id'])){
            $where['where']['a.id'] = $param['id'];
        }

        $where['order']['a.createTime'] = 'desc';

        if( isset($param['limit']) )
        {
            $where['limit'] = $param['limit'];
        }

        $data = $this->db->select($this->table.' a  left join '.$this->table_customer.' b on a.customerId = b.id  left 
        join '.$this->table_class.' c on a.classId = c.id ',' a.* ,b.alias,c.className ', $where);

        if(!empty($data))
        {
            $this->result['status'] = 1;
            $this->result['data']['list']   = $data;
        }
        else
        {
            $this->result['status'] = 0;
            $this->result['data']   = 'NODATA';
        }
        return $this->result;
    }
    /**
     * 上架
     *
     * @param int $id
     * @return bool
     */
    function upstore($param)
    {
        if (!empty($param['id']))
        {
            $up_param = array(
                'status' => 1
            );
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );
            $ret   = $this->db->update($this->table, $up_param, $where);
            $this->result['status'] = 1;
            $this->result['data']   = $param;
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }

    /**
     * 下架
     *
     * @param int $id
     * @return bool
     */
    function downstore($param)
    {
        if (!empty($param['id']))
        {
            $up_param = array(
                'status' => 2
            );
            $where = array(
                'where' => array(
                    'id' => $param['id']
                )
            );
            $ret   = $this->db->update($this->table, $up_param, $where);
            $this->result['status'] = 1;
            $this->result['data']   = $param;
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }



}