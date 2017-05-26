<?php

/**
 * 供应商
 *
 * @author  lsw
 * @date    2015-08-5
 * @version 1.0
 */
class admin_provider_redis extends base_redis 
{
    //后台用户数据表
    private $admin_user_table = 'user';
    //后台用户表字段
    private $admin_user_field = array('user_id','user_name','password','name','tel','email','role_id','status','created_time','updated_time');
    
    /**
     * 初始化
     */
    public function __construct(&$redis){
        parent::__construct($redis);
    }

    public function getTotal($param)
    {

    }

    public function getItems($param)
    {

    }

    public function getItem($param)
    {

    }

    /**
     * 添加供应商信息
     * @return array
     */
    public function create($param){

    }

    /**
     * 编辑供应商信息
     * @return array
     */
    public function update($param){

    }

    /**
     * 删除指关键字值的数据
     *
     * @param int $id
     * @return bool
     */
    function delete($param)
    {
        
    }

    public function getlist($param){
        
    }

    /**
     * 账户密码重置
     */
    
    public function updatepwd($param){

    }

    /**
     * 企业账号重复判断
     */
    public function isrepeat($param){

    }
}
?>