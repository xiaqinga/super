<?php

/**
 * 菜单模型
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class menu_redis extends base_redis {
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
	
	public function getMenuList(){
		
	}
	/**
	 * 根据菜单id获取菜单详情
	 *
	 * @param int $id 菜单ID
	 * @return $this->_data 菜单详情
	 */
	function getItem($param)
	{
		
	}
	public function create($param){
		
	}
	
	public function update($param){
		
	}
	/**
	 * 删除指关键字值的数据
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete()
	{
		
	}
	
}