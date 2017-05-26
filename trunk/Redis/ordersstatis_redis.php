<?php

/**
 * 统计统计管理REDIS
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class ordersstatis_redis extends base_redis {
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
	
	public function getOrdersTotal($param){
		
	}
	public function getOrdersTotalMonth($param){
		
	}
	/**
	 * 获取退换货订单总数
	 */
	public function getOrdersReturnTotal($param){
		
	}
	/**
	 * 获取退换货订单每月总数
	 */
	public function getOrdersReturnTotalMonth($param){
		
	}
	/**
	 * 获取预定商品订单总数
	 */
	public function getOrdersPreTotal($param){
		
	}
	/**
	 * 获取预定商品每月总数
	 */
	public function getOrdersPreTotalMonth($param){
		
	}
}