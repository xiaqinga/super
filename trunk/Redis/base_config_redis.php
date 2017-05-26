<?php

/**
 * 业务
 */
 
class base_config_redis extends base_redis {
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
	
  
	public function getseckill(){
		
	}

	public function getptseckill(){
		
	}

	public function getlist($param){
		
	}

	public function getptlist($param){

	}

	public function queryGoods($param){
		
	}

	public function queryPreGoods($param){
		
		
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
	public function timesUpdate($param){
		
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		
	}

	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		
	}

	/**
	 * 查看
	 */
	public function getTimes($param){
		
	}
	

	public function getGoodsInfoListByPage($param){
		
	}

	public function getPreGoodsInfoListByPage($param){
		
	}

	/**
	 * 删除活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function updateActivityGoodsById($param){
		
	}

	/**
	 * 更新活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function updateActivityGoods($param){
		
	}

	/**
	 * 添加活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function insertActivityGoods($param){
		
	}


	/**
	 * 启用商品
	 */
	public function upstore($param){
		
	}
	/**
	 * 禁用商品
	 */
	public function downstore($param){
		
	}

	/**
	 * 判断秒抢日期
	 */
	public function seckillTime($param){
		
	}
	
}