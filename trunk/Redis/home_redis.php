<?php

 /**
 * 首页redis
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
class home_redis extends base_redis {
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
	
	public function getCountOrderNoSend(){
		
	}

	public function getCountOrderRefund(){
		
	}
	
	public function getCountOrderComplete(){
		
	}

	public function getCountOrderCompleteSilver(){
		
	}

	public function getCountOrderNoSendSilver(){
		
	}

	public function getAuditSupplier(){
		
	}

	public function getAuditGoods(){
		
	}

	public function getAuditGoodsSilver(){
		
	}

	public function getAuditBusiness(){
		
	}

	
	public function getSellAllTotal($param){
		
	}

	public function getSupplierTotal($param){
		
	}

	public function getBusinessTotal($param){
		
	}

	public function getBrokerageAllTotal($param){
		
	}

	public function getSaleAllTotalResp($param){
		
	}

	public function getSellTotalMonth($param){
		
	}

	public function getBrokerageTotalMonth($param){
		
	}

	public function getBusinessTotalMonth($param){
		
	}
}