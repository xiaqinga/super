<?php

/**
 * 团购专区
 */
 
class base_group_buy_redis extends base_redis {
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

	public function getlistinfo($param){
		

	}

	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		
	}

	/**
	 * 删除
	 */
	public function delete($param){
		
	}

	/**
	 * 查询商品信息
	 */
	public function findgoods($param){
		
	}


	public function getGoodsInfoListByPage($param){
		
	}

	public function getPreGoodsInfoListByPage($param){
		
	}

	public function queryGoods($param){
		
	}

	public function queryPreGoods($param){
		
	}
	
}