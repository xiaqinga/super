<?php

/**
 * 首页模型
 * @author janhve@163.com
 * @since   2016-07-14
 * @version 1.0
 */
 
class home_db {
	//Db
	private $db = NULL;
	//database table
	private $table_provider = 'admin_provider';
	private $table_dept = 'admin_dept';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table_provider = DB_PREFIX . 'admin_provider';
		$this->table_dept = DB_PREFIX . 'admin_dept';
	}
	
	public function getCountOrderNoSend(){
		$where = ' 1 ';
		$sql = 'select count(1) from v_order_info where `status`=2 and mallType=1 group by ordersNo';
		$total = $this->db->total($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getCountOrderRefund(){
		$where = ' 1 ';
		$sql = 'select count(1) from v_order_info where `status`=4 and mallType=1 group by ordersNo';
		$total = $this->db->total($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}
	
	public function getCountOrderComplete(){
		$where = ' 1 ';
		$sql = 'select count(1) from v_order_info where `status`=7 or `status` = 6 and mallType=1 group by ordersNo';
		$total = $this->db->total($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getCountOrderCompleteSilver(){
		$where = ' 1 ';
		$sql = 'select count(1) from v_order_info where `status`=7 or `status` = 6 and mallType=2 group by ordersNo';
		$total = $this->db->total($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getCountOrderNoSendSilver(){
		$where = ' 1 ';
		$sql = 'select count(1) from v_order_info where `status`=2 and mallType=2 group by ordersNo';
		$total = $this->db->total($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getAuditSupplier(){
		$where = ' 1 ';
		$sql = 'select count(1) as ctotal from t_base_enterprise_info where `status`=1 and providerType=1';
		$total = $this->db->select($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total[0]['ctotal'];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getAuditGoods(){
		$where = ' 1 ';
		$sql = 'select count(1) as ctotal from t_goods_list where `status`=3 and mallType=1';
		$total = $this->db->select($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total[0]['ctotal'];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getAuditGoodsSilver(){
		$where = ' 1 ';
		$sql = 'select count(1) as ctotal from t_goods_list where `status`=3 and mallType=2';
		$total = $this->db->select($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total[0]['ctotal'];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	public function getAuditBusiness(){
		$where = ' 1 ';
		$sql = 'select count(1) as ctotal from t_base_enterprise_info where `status`=1 and providerType=2';
		$total = $this->db->select($sql);
		if($total>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['total'] = $total[0]['ctotal'];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']['total'] = 0;
		}
		return $this->result;
	}

	
	public function getSellAllTotal($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5 
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t4.providerId = ".$param['providerId'];
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
			$this->result['data']   = '获取销售总数失败';
		}
		return $this->result;
	}

	public function getSupplierTotal($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) supplierTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5, 
			t_base_provider_ref t6
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t6.id=t4.providerId
		AND t6.providerType=1";
		
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取销售总数失败';
		}
		return $this->result;
	}

	public function getBusinessTotal($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) businessTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5, 
			t_base_provider_ref t6
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t6.id=t4.providerId
		AND t6.providerType=2";
		
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取销售总数失败';
		}
		return $this->result;
	}

	public function getBrokerageAllTotal($param){
		$sql = "SELECT 
		  	1 aliasId,
			t1.*,
			sum(t2.restockPrice) sumBrokerage 
			FROM 
			t_orders_goods_info t1,
			t_goods_normsvalue_stock t2
		WHERE 
			t1.goodsId = t2.goodsId 
		AND t1.status = 1 
		AND t2.status = 1";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取失败';
		}
		return $this->result;
	}

	public function getSaleAllTotalResp($param){
		$sql = "SELECT 
			sum(t1.buyNum) sumSaleGoods 
			FROM 
			t_orders_goods_info t1
		WHERE
			t1.status = 1 ";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取失败';
		}
		return $this->result;
	}

	public function getSellTotalMonth($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId,MONTH(t2.actionDate) `month` 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5 
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t4.providerId = ".$param['providerId'];
		}
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " AND t2.actionDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t2.actionDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
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
			$this->result['data']   = '获取销售每月总数失败';
		}
		return $this->result;
	}

	public function getBrokerageTotalMonth($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sumBrokerage, preferentialPrice, t3.goodsId, goodsNormsValueId,MONTH(t2.actionDate) `month` 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5, 
			t_base_provider_ref t6
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t6.id=t4.providerId 
		AND t6.providerType=1";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t4.providerId = ".$param['providerId'];
		}
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " AND t2.actionDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t2.actionDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
		}
		$sql .= " group by `month`";
		$data  = $this->db->select($sql);
		// var_dump($this->db->last_query());die();
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取供应商销售每月总数失败';
		}
		return $this->result;
	}

	public function getBusinessTotalMonth($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sumBrokerage, preferentialPrice, t3.goodsId, goodsNormsValueId,MONTH(t2.actionDate) `month` 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5, 
			t_base_provider_ref t6
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t6.id=t4.providerId 
		AND t6.providerType=2";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t4.providerId = ".$param['providerId'];
		}
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " AND t2.actionDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t2.actionDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
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
			$this->result['data']   = '获取联盟商销售每月总数失败';
		}
		return $this->result;
	}
}