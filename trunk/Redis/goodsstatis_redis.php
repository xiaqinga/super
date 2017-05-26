<?php

/**
 * 商品统计管理REDIS
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class goodsstatis_redis extends base_redis {
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
	
	public function getGoodsTotal($param){
		
	}
	public function getGoodsTotalMonth($param){
		
	}
	/**
	 * 获取销售每月总数
	 */
	public function getSellGoodsTotalMonth($param){
		
	}
	
	public function getPreGoodsTotal($param){
		
	}
	public function getPreGoodsTotalMonth($param){
		
	}
	/**
	 * 获取销售每月总数
	 */
	public function getPreSellGoodsTotalMonth($param){
		
	}
}