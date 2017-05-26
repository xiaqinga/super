<?php

/**
 * 微信关键字回复
 * @author wsbnet@qq.com
 * @since   2016-07-25
 * @version 1.0
 */
 
class weixin_msg_redis extends base_redis {
	//后台用户数据表
	private $admin_user_table = 'admin_weixin_msg';
	//后台用户表字段
	private $admin_user_field = array();
	
	/**
	 * 初始化
	 */
	public function __construct(&$redis){
		parent::__construct($redis);
	}
	
	function getTotal()
	{
		
	}
	
	function getItems()
	{
		
	}

	function getCommissionSet()
	{
		
	}

	function getItem()
	{
		
	}
	
	function setWeixinMsg()
	{
		
	}

	function delete()
	{
		
	}
}