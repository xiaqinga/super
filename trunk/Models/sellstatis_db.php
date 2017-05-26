<?php

/**
 * 销售统计模型
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class sellstatis_db {
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
	 * 获取供应商销售总数
	 */
	public function getSellAllTotal($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5,
			t_base_enterprise_info t6,
			t_base_provider_ref t7
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t4.providerId=t7.id 
		AND t7.providerType=1 
		AND t6.id=t7.refId";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
	/**
	 * 获取供应商佣金总数
	 */
	public function getBrokerageAllTotal($param){
		$sql = "SELECT 
		  	1 aliasId,
			t1.*, t2.id,
			t5.goodsName,
			sum(income) sumBrokerage 
			FROM 
			t_member_wallet_income_expend_record t1,
			t_orders_list t2,
			t_orders_flow t3,
			t_orders_goods_info t4,
			t_goods_list t5,
			t_base_enterprise_info t6, 
			t_base_provider_ref t7
		WHERE 
			t1.orderId = t2.id 
		AND t2.id = t3.ordersId 
		AND t2.id = t4.ordersId 
		AND t4.goodsId = t5.id 
		AND t5.providerId = t7.id
		AND t7.refId = t6.id
		AND t7.providerType=1";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
			$this->result['data']   = '获取佣金总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取供应商销售每月总数
	 */
	public function getSellTotalMonth($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId,MONTH(t2.actionDate) `month` 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5, 
			t_base_enterprise_info t6,
			t_base_provider_ref t7
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t4.providerId=t7.id 
		AND t7.refId=t6.id 
		AND t7.providerType=1";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
	
	/**
	 * 获取供应商佣金每月总数
	 */
	public function getBrokerageTotalMonth($param){
		$sql = "SELECT 
		  	1 aliasId,
			t1.*, t2.id,
			t5.goodsName,
			sum(income) sumBrokerage,
			MONTH(t1.createDate) `month` 
			FROM 
			t_member_wallet_income_expend_record t1,
			t_orders_list t2,
			t_orders_flow t3,
			t_orders_goods_info t4,
			t_goods_list t5,
			t_base_enterprise_info t6, 
			t_base_provider_ref t7 
		WHERE 
			t1.orderId = t2.id 
		AND t2.id = t3.ordersId 
		AND t2.id = t4.ordersId 
		AND t4.goodsId = t5.id 
		AND t7.id=t5.providerId 
		AND t7.refId = t6.id 
		AND t7.providerType=1 ";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
		}
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " AND t1.createDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t1.createDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
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
			$this->result['data']   = '获取佣金每月总数失败';
		}
		return $this->result;
	}

	/**
	 * 获取联盟商销售总数
	 */
	public function getSellUnionAllTotal($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5,
			t_base_enterprise_info t6,
			t_base_provider_ref t7
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t4.providerId=t7.id 
		AND t7.providerType=2 
		AND t6.id=t7.refId";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
	/**
	 * 获取联盟商佣金总数
	 */
	public function getBrokerageUnionAllTotal($param){
		$sql = "SELECT 
		  	1 aliasId,
			t1.*, t2.id,
			t5.goodsName,
			sum(income) sumBrokerage 
			FROM 
			t_member_wallet_income_expend_record t1,
			t_orders_list t2,
			t_orders_flow t3,
			t_orders_goods_info t4,
			t_goods_list t5,
			t_base_enterprise_info t6, 
			t_base_provider_ref t7
		WHERE 
			t1.orderId = t2.id 
		AND t2.id = t3.ordersId 
		AND t2.id = t4.ordersId 
		AND t4.goodsId = t5.id 
		AND t5.providerId = t7.id
		AND t7.refId = t6.id 
		AND t7.providerType=2";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
			$this->result['data']   = '获取佣金总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取联盟商销售每月总数
	 */
	public function getSellUnionTotalMonth($param){
		$sql = "SELECT 
			1 aliasId, sum(t1.sumMoney) sellTotalMoney, preferentialPrice, t3.goodsId, goodsNormsValueId,MONTH(t2.actionDate) `month` 
			FROM 
			t_orders_list t1,
			t_orders_flow t2,
			t_orders_goods_info t3,
			t_goods_list t4,
			t_goods_normsvalue_stock t5,
			t_base_enterprise_info t6, 
			t_base_provider_ref t7
		WHERE 
			t1.id = t2.ordersId 
		AND t2.`status` = 7  
		AND t1.id = t3.ordersId 
		AND t3.goodsId = t5.goodsId 
		AND t3.normsValueId = t5.goodsNormsValueId 
		AND t3.goodsId = t4.id 
		AND t1.`status` = 7 
		AND t4.providerId=t7.id 
		AND t7.refId=t6.id 
		AND t7.providerType=2";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
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
	
	/**
	 * 获取联盟商佣金每月总数
	 */
	public function getBrokerageUnionTotalMonth($param){
		$sql = "SELECT 
		  	1 aliasId,
			t1.*, t2.id,
			t5.goodsName,
			sum(income) sumBrokerage,
			MONTH(t1.createDate) `month` 
			FROM 
			t_member_wallet_income_expend_record t1,
			t_orders_list t2,
			t_orders_flow t3,
			t_orders_goods_info t4,
			t_goods_list t5,
			t_base_enterprise_info t6 
			t_base_provider_ref t7 
		WHERE 
			t1.orderId = t2.id 
		AND t2.id = t3.ordersId 
		AND t2.id = t4.ordersId 
		AND t4.goodsId = t5.id 
		AND t7.id=t5.providerId 
		AND t7.refId = t6.id 
		AND t7.providerType=2 ";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND t6.id = ".$param['providerId'];
		}
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " AND t1.createDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t1.createDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
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
			$this->result['data']   = '获取佣金每月总数失败';
		}
		return $this->result;
	}
	
	public function getProviderList($param){
		$where['where']['a.status'] = 2;
		$where['where']['b.providerType'] = $param['providerType'];
		$where['where']['a.providerType'] = $param['providerType'];
		$data  = $this->db->select($this->table_enterprise_info.' a left join t_base_provider_ref b on b.refId=a.id','b.refId as id,a.providerName',$where);
		if(!empty($data))
		{
			$providerList = array();
			foreach ($data as $key => $val) {
				$providerList[$val['id']] = $val['providerName'];
			}
			$this->result['status'] = 1;
			$this->result['data']['list']   = $providerList;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取佣金每月总数失败';
		}
		return $this->result;
	}
}