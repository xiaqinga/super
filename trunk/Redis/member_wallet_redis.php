<?php

/**
 * 钱包管理REDIS
 *
 * @since   2017-01-04
 * @version 1.0
 */
 
class member_wallet_redis extends base_redis {
	//后台用户数据表
	private $admin_user_table = 'base_media';
	//后台用户表字段
	private $admin_user_field = array();
	
	/**
	 * 初始化
	 */
	public function __construct(&$redis){
		parent::__construct($redis);
	}
	
	public function getlist($param){

	}
	public  function setIntegral($param){
		
	}
	public function getBaseConfig($param){
		
	}

	public function setIncomeDetail($param){
		
	}
}