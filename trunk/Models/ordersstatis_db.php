<?php

/**
 * 订单统计模型
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class ordersstatis_db {
	//Db
	private $db = NULL;
	//database table
	private $table_customer = 'member_customer';
	private $table_provider = 'admin_provider';
	private $table_enterprise_info = 'base_enterprise_info';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table_customer = DB_PREFIX . 'member_customer';
		$this->table_provider = DB_PREFIX . 'admin_provider';
		$this->table_enterprise_info = DB_PREFIX . 'base_enterprise_info';
	}
	
	/**
	 * 获取订单总数
	 */
	public function getOrdersTotal($param){

		$sql = "select count(*) totalCount, sum(if(`status`=1, 1, 0)) preOrderCount, sum(if(`status`=2, 1, 0)) preSendOut, sum(if(`status`=3, 1, 0)) offSendOut,  sum(if(`status`=6, 1, 0)) processedOrder, sum(if(`status`=7, 1, 0)) offStockCount, sum(IF(`status` = 8, 1, 0)) returnOrderCount from(
			select v1.`status`, t1.actionDate, v1.providerId,v1.malltype from v_order_info v1, t_orders_flow t1 where v1.`status` > 0 and v1.id = t1.ordersId group by v1.id) t WHERE 1";
		if( isset($param['providerId']) && !empty($param['providerId']) && $param['providerId'] != -1 )
		{
			$sql.= " and t.providerId = ".$param['providerId'];
		}
		if( isset($param['malltype']) && !empty($param['malltype'])  )
		{
			$sql.= " and t.malltype = ".$param['malltype'];
		}




		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取订单总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取订单每月总数
	 */
	public function getOrdersTotalMonth($param){
		$sql = "select MONTH(actionDate) `month`, providerId, actionDate, count(*) totalCount, sum(if(`status`=1, 1, 0)) preOrderCount, sum(if(`status`=2, 1, 0)) preSendOut, sum(if(`status`=7, 1, 0)) offStockCount,sum(IF(`status` = 8, 1, 0)) returnOrdersCount from(
			select v1.`status`, t1.actionDate, v1.providerId ,v1.malltype from v_order_info v1, t_orders_flow t1 where v1.id = t1.ordersId group by v1.id) t where t.`status` > 0 and t.actionDate >= DATE_FORMAT('".$param['year']."-01-01', '%Y-%m-%d') 
		and t.actionDate <= DATE_FORMAT('".$param['year']."-12-31', '%Y-%m-%d')";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t.providerId = ".$param['providerId'];
		}
		if( isset($param['malltype']) && !empty($param['malltype'])  )
		{
			$sql.= " and t.malltype = ".$param['malltype'];
		}
		$sql .= " group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取订单每月总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取退换货订单总数
	 */
	public function getOrdersReturnTotal($param){
		if( isset($param['providerId']) && !empty($param['providerId']) && $param['providerId'] != -1 )
		{
			$p_sql = " and a.providerId = ".$param['providerId'];
		}
		$sql = "select ifnull(sum(IF(a.status = 5 or a.status = 6, 1, 0)),0) totalCount,
		ifnull(sum(IF(a.type = 1, 1, 0)),0) returnOrderCount,ifnull(sum(IF(a.type = 2, 1, 0)),0) exchangeOrderCount 
		from (select id,status,type,createTime,providerId from v_orders_return  where status!=7) a WHERE 1";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取退换货订单总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取退换货订单每月总数
	 */
	public function getOrdersReturnTotalMonth($param){
		$sql = "select MONTH(a.createTime) `month`,sum(IF(a.status = 5 or a.status = 6, 1, 0)) totalCount,
		sum(IF(a.type = 1, 1, 0)) returnOrderCount,sum(IF(a.type = 2, 1, 0)) exchangeOrderCount 
		 from (select id,status,type,createTime,providerId from v_orders_return  where status!=7) a
		 where a.createTime >= DATE_FORMAT('".$param['year']."-01-01', '%Y-%m-%d') 
		and a.createTime <= DATE_FORMAT('".$param['year']."-12-31', '%Y-%m-%d')";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND a.providerId = ".$param['providerId'];
		}
		$sql .= " group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取退换货订单每月总数失败';
		}
		return $this->result;
	}
	

}