<?php

 /**
 * 物流redis
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
class logistics_redis extends base_redis {
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
	
	public function getLogisticsCostList($param){
		
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
	 * 删除运费模板
	 */
	public function delete($param){
		
	}
	
	/**
	 * 获取运费列表运送范围详情数据
	 */
	public function getAreacodeList($param){
		
	}
		
	public function getLogisticsCostconfig($param){
		
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function createCostconfig($param){
		
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function updateCostconfig($param){
		
	}
	
	public function getEmsList($param){
		
	}
	
	/**
	 * 添加快递公司
	 * @return array
	 */
	public function createEms($param){
		
	}

	/**
	 * 编辑快递公司
	 * @return array
	 */
	public function updateEms($param){
		
	}
	
	/**
	 * 删除快递公司的数据
	 *
	 * @param int $id
	 * @return bool
	 */
	function deleteEms($param)
	{
		
	}
}