<?php

/**
 * 会员统计管理REDIS
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class customerstatis_redis extends base_redis {
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
	
	public function getAllTotal($param){
	}
	/**
	 * 获取创客每月总数
	 */
	public function getProviderTotalMonth($param){
	}
	
	/**
	 * 获取会员每月总数
	 */
	public function getCustomerTotalMonth($param){
	}

	/**
	 * 获取联盟商总数和供应商总数
	 */
	public function getBussTotal($param){
	}

	public function getSupplyTotalMonth($param){
	}

	/**
	 * 获取联盟商每月总数
	 */
	public function getUnionTotalMonth($param){
	}
}