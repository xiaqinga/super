<?php

 /**
 * 操作日志redis
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
class actionLog_redis extends base_redis {
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
	 * 获取操作日志列表
	 */
	public function getActionLogList($param){
		
	}
	/**
	 * 添加操作日志
	 * @return array
	 */
	public function create($param){
		
	}

	public function delete($param){
		
	}
}