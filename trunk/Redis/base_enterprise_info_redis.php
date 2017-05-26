<?php

/**
 * 企业
 *
 * @author  lsw
 * @date    2015-08-5
 * @version 1.0
 */
class base_enterprise_info_redis extends base_redis 
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
     * 添加企业信息
     * @return array
     */
    public function create($param){

    }

    /**
     * 编辑企业信息
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
    public function getStuInfo($param){

    }

    public function findphoto($param){

    }

    public function findbasephoto($param){
        
    }

    public function findrotation($id){
        
    }
    public function deletePhoto($param){
    }

    /**
     * 添加的中间表数据
     */
    public function providerref($param){
        
    }
    /**
     * 查找中间表
     */
    public function findref($param){
       
    }
    public function  providerlist($param){
        

    }
    public function proving($param){
        
    }

    public function getSubShop($param){
        
    }

    public function getUnionClassName($param){
        
    }
}
?>