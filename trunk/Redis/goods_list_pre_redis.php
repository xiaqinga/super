<?php

/**
 * 角色管理REDIS
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class goods_list_pre_redis extends base_redis {
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

  public function getGoodsByProvider($param){
 
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

  /**
   * 上架
   *
   * @param int $id
   * @return bool
   */
  function upstore($param)
  {

  }

  /**
   * 下架
   *
   * @param int $id
   * @return bool
   */
  function downstore($param)
  {

  }


  /**
   * 存储组合商品
   *
   * @param array $param 参数组
   * @param int   $id    用户id
   * @return array
   */
  public function savesizegoods($param)
  {

  }
	
}