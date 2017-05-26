<?php

/**
 * 商品订单模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-23
 * @version 1.0
 */
 
class orders_goods_info_redis extends base_redis {
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

   public function getinfo($param){

  }

   public function getAllinfo($param){
 
  }

  //根据订单ID查询订单中的商品
  public function getOrderGoodsIdByOrdersId($param){

  }

  public function confirmSendGoods($param){

  }

  public function confirmAllSendGoods($param){

  }

  public function updateChangeInfo($param){

  }
  public function umengInfoKey($param){
      
    }
}