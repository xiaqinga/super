<?php

/**
 * 角色管理REDIS
 * @author wsbnet@qq.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class weixin_menu_redis extends base_redis {
	//后台用户数据表
	private $admin_user_table = 'admin_weixin_menu';
	//后台用户表字段
	private $admin_user_field = array();
	
	/**
	 * 初始化
	 */
	public function __construct(&$redis){
		parent::__construct($redis);
	}
	
	/**
	 * 获取所有菜单列表
	 *
	 * @return json $data
	 */
	function getItems()
	{
		
	}

	function menuIdToName()
	{
		
	}

	/**
	 * @param int $parentId 父菜单ID
	 * @return $this->_data 菜单列表
	 */
	function getItemsByWhere()
	{

	}

	/**
	 * 根据菜单id获取菜单详情
	 *
	 * @param int $id 菜单ID
	 * @return $this->_data 菜单详情
	 */
	function getItem()
	{
		
	}

	/**
	 * 存储菜单,方法名setUser与redis保持同名
	 *
	 * @param array $param 参数组
	 * @param int   $id    用户id
	 * @return array
	 */
	public function setMenu($param)
	{
		
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