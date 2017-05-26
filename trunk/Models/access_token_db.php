<?php

/**
 * 微信ACCESSTOKEN控制器
 *
 * @author  lsw
 * @date    2015-08-5
 * @version 1.0
 */
class access_token_db
{
    var $_table;
    //Db
    private $db = null;
    //数据结果
    private $result = array(
        'status' => 0,
        'data'   => null
    );

    /**
     * 初始化
     */
    public function __construct(&$db)
    {
        $this->db     = $db;
        $this->_table = DB_PREFIX.'weixin_developerinfo';
    }

    public function getItem()
    {

        $where                  = array(
            'where' => array(
                'typeName' => 'ACCESSTOKEN'
            )
        );
        $access_data = $this->db->select($this->_table, '', $where);
        if(isset($access_data[0])){
            $this->result['data'] = $access_data[0]; //返回更新的记录信息
        }
        $this->result['status'] = 1;
        return $this->result;
    }

    public function setToken($param)
    {

        $where                  = array(
            'where' => array(
                'typeName' => 'ACCESSTOKEN'
            )
        );
        $setparam['mark'] = $param['access_token'];
        $ret = $this->db->update($this->_table, $setparam, $where);

        if ($ret)
        {
            $this->result['status'] = 1;
            $this->result['data']   = $param; //返回完整的记录信息
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }

    public function del()
    {
        $where                  = array(
            'where' => array(
                'create_time <=' => strtotime('-1 month')
            )
        );
        $ret = $this->db->delete($this->_table, $where);
        if ($ret)
        {
            $this->result['status'] = 1;
            $this->result['data']   = 1;
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }

    public function clear()
    {
        $where                  = array(
            'where' => array(
                'id >' => 0
            )
        );
        $ret = $this->db->delete($this->_table, $where);
        if ($ret)
        {
            $this->result['status'] = 1;
            $this->result['data']   = 1;
        }
        else
        {
            $this->result['status'] = 0;
        }

        return $this->result;
    }
}
?>