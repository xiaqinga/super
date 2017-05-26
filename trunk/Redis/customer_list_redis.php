<?php

/**
 * 会员管理REDIS
 * @author janhve@163.com
 * @since   2016-08-30
 * @version 1.0
 */
 
class customer_list_redis extends base_redis {
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
	public function getTotal($param){

	}
	public function getlist($param){
		
	}
	
	public function getInfo($param){
		
	}
	public function findOne($param){

	}
	public function getReceivingAddress($param){

	}
	public function getSuperiorAccount($param){
		
	}
	public function create($param){
		
	}
	
	public function update($param){
		
	}
	
	public function delete($param){
		
	}
	public function  findParent($param){
		
	}
	
}