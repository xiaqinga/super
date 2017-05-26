<?php

/**
 * 联盟商分类
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class base_union_class_redis extends base_redis {
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
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		
	}

	/*
	查询分类命是否重复
	 */
	public function findrepeat($param){
		
	}

	public function getClassJson($param){
		

	}

	public function getParentName($param){

	}
}