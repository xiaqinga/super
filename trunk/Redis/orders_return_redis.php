<?php

/**
 * 角色管理REDIS
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class orders_return_redis extends base_redis {
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
	
  
  //获取所有
  public function getlist($param){

  }

   public function getinfo($param){

  }

   public function getOrderReturnById($param){

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


    // 根据商品Id查询商品的规格、库存、价格
   public function selectGoodsNormsValueStockGoodsId($param){

  }

    //换货商品
   public function getNormsValueStockByMap($param){

  }

  public function queryOrdersNormsInfoById($param){

  }

  public function insertOrderReturnCheck($param){

  }

  public function insertReturnFlow($param){

  }

  public function updateOrderReturnRef($param){

  }

  public function updateOrderGoodsInfo($param){

  }

  public function updateOrdersById($param){

  }

  public function insertOrdersFlow($param){

  }

  public function insertIncomeExpendRecord($param){

  }

  public function updateWallet($param){

  }

  public function selectGoodsNormsStock($param){

  }

  public function updateGoodsNormsStock($param){

  }
  
  public function insertOrdersList($param){

  }

  public function insertOrdersGoodsInfo($param){

  }

  public function insertOrdersReceivingAddress($param){

  }
  
  public function queryReceivingAddressByOrdersId($param){

  }

  public function queryOrderById($param){

  }
	
}