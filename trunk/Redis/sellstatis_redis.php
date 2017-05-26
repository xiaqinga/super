<?php

/**
 * 销售统计管理REDIS
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class sellstatis_redis extends base_redis {
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
	
	/**
	 * 获取供应商销售总数
	 */
	public function getSellAllTotal($param){
		
	}
	/**
	 * 获取供应商佣金总数
	 */
	public function getBrokerageAllTotal($param){
		
	}
	/**
	 * 获取供应商销售每月总数
	 */
	public function getSellTotalMonth($param){
		
	}
	
	/**
	 * 获取供应商佣金每月总数
	 */
	public function getBrokerageTotalMonth($param){
		
	}

	/**
	 * 获取联盟商销售总数
	 */
	public function getSellUnionAllTotal($param){
		
	}
	/**
	 * 获取联盟商佣金总数
	 */
	public function getBrokerageUnionAllTotal($param){
		
	}
	/**
	 * 获取联盟商销售每月总数
	 */
	public function getSellUnionTotalMonth($param){
		
	}
	
	/**
	 * 获取联盟商佣金每月总数
	 */
	public function getBrokerageUnionTotalMonth($param){
		
	}
	
	public function getProviderList($param){
		
	}
}