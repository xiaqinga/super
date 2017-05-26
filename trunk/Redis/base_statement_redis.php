<?php

/**
 * 团购专区
 */
 
class base_statement_redis extends base_redis {
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
	
  
	public function getlist($param){
		
	}

	public function getItem()
	{
		
	}

	public function exportOrders($param){
		
	}

	public function countOrder($param){
		
	}
	public function  getFundList($param){

	}
	public function  getFundMoneyCount(){
		
	}
}