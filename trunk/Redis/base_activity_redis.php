<?php

/**
 * 爆款专区REDIS
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class base_activity_redis extends base_redis {
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
	
}