<?php

/**
 * 会员订单模型
 * @author janhve@163.com
 * @since   2016-08-18
 * @version 1.0
 */
 
class customerorders_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'member_customer';
	private $table_member_active = 'member_active';
	private $table_orders_list = 'orders_list';
	private $table_pre_orders_list = 'pre_orders_list';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'member_customer';
		$this->table_member_active = DB_PREFIX . 'member_active';
		$this->table_orders_list = DB_PREFIX . 'orders_list';
		$this->table_pre_orders_list = DB_PREFIX . 'pre_orders_list';
	}
	
	public function getlist($param){
		$sql = "SELECT a.alias,a.accout,
			(select count(1) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=1 and b.mallType=".$param['mallType'].") noPay,
			(select count(1) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=2 and b.mallType=".$param['mallType'].") noSend,
			(select count(1) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=3 and b.mallType=".$param['mallType'].") sended,
			(select count(1) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=7 and b.mallType=".$param['mallType'].") finished,
			(select count(1) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=8 and b.mallType=".$param['mallType'].") returned
		FROM ".$this->table." a";
		
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$sql  .= " where a.accout =".$param['accout'];
		}
		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		$sql  .= " ORDER BY a.id DESC";
		if( isset($param['limit']) )
		{
			$sql  .= " limit ".$param['limit'];
		}
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员订单数据失败';
		}
		return $this->result;
	}

	/**
	 * 商企
	 */
	public function getlistbusiness($param){
		$sql = "SELECT a.alias,a.accout,
			(select sum(b.sumMoney) from ".$this->table_orders_list." b where b.customerId=a.id and b.`status`=7 and b.mallType=".$param['mallType'].") allPay
		FROM ".$this->table." a";
		
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$sql  .= " where a.accout =".$param['accout'];
		}
		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		$sql  .= " ORDER BY a.id DESC";
		if( isset($param['limit']) )
		{
			$sql  .= " limit ".$param['limit'];
		}
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员订单数据失败';
		}
		return $this->result;
	}
	/**
	 * 会员每种预约订单的统计
	 */
	public function getPreOrderList($param){
		$sql = "SELECT a.alias,a.accout,
			(select count(1) from ".$this->table_pre_orders_list." b where b.customerId=a.id and b.`status`=3) receivedOrders,
			(select count(1) from ".$this->table_pre_orders_list." b where b.customerId=a.id and b.`status`=4) complete,
			(select count(1) from ".$this->table_pre_orders_list." b where b.customerId=a.id and b.`status`=5) fail 
		FROM ".$this->table." a";
		
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$sql  .= " where a.accout =".$param['accout'];
		}
		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		$sql  .= " ORDER BY a.id DESC";
		if( isset($param['limit']) )
		{
			$sql  .= " limit ".$param['limit'];
		}
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员预约订单数据失败';
		}
		return $this->result;
	}
}