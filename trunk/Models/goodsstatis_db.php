<?php

/**
 * 商品统计模型
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class goodsstatis_db {
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
	 * 获取销售总数
	 */
	public function getGoodsTotal($param){
		$p_sql='';
		if( isset($param['providerId']) && !empty($param['providerId']) && $param['providerId'] != -1 )
		{
			$p_sql.= " and providerId = ".$param['providerId'];
		}
		if( isset($param['malltype']) && !empty($param['malltype']) )
		{
			$p_sql.= " and malltype = ".$param['malltype'];
		}
		$sql = "select * from (select count(*) totalGoodsCount from t_goods_list 
  		where `status` > 0".$p_sql;
		$sql .= ") t1, 
  		(select count(*) outOfStockCount from t_goods_list where `status` = 2".$p_sql.
		") t2, 
		(select count(*) onOfStockCount from t_goods_list where `status` = 1".$p_sql.
		") t5, 
	  	(select sum(sellNum) sellTotalCount from t_goods_list where `status` = 1".$p_sql.
		") t3, 
		(select sum(p3.stockNum) stockTotalCount from t_goods_list p1, t_goods_normsvalue_stock p2, t_goods_norms_stock p3 where p1.id = p2.goodsId and p2.stockId = p3.id and p1.`status` = 2".$p_sql.") t4";
		$data  = $this->db->select($sql);

		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取普通商品总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取商品每月总数
	 */
	public function getGoodsTotalMonth($param){
		$sql = "select `month`, sum(IFNULL(t1.totalCount,0)) totalCount from (select count(*) totalCount, month(createDate) `month` from t_goods_list where `status` > 0 and createDate >= DATE_FORMAT('".$param['year']."-01-01', '%Y-%m-%d') 
		and createDate <= DATE_FORMAT('".$param['year']."-12-31', '%Y-%m-%d')";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND providerId = ".$param['providerId'];
		}
		if( isset($param['malltype']) && !empty($param['malltype']) )
		{
			$sql .= " and malltype = ".$param['malltype'];
		}
		$sql .= " group by `month`) t1 group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取商品每月总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取商品每月销售总数
	 */
	public function getSellGoodsTotalMonth($param){
		$sql = "SELECT sum(t.totalSellNums) totalSellNum, MONTH(t.createDate) `month` FROM 
			(SELECT sum(ordersGoods.buyNum) totalSellNums, orders.createDate, goods.id FROM t_goods_list AS goods 
			LEFT JOIN t_orders_goods_info AS ordersGoods ON ordersGoods.goodsId = goods.id 
			LEFT JOIN t_orders_list AS orders ON orders.id = ordersGoods.ordersId 
			WHERE goods.status > 0 and orders.status = 7";
		if( isset($param['providerId']) && !empty($param['providerId']) )
		{
			$sql .= " AND goods.providerId = ".$param['providerId'];
		}
		if( isset($param['malltype']) && !empty($param['malltype']) )
		{
			$sql .= " AND goods.malltype = ".$param['malltype'];
		}
		$sql .= " ) t";
		if( isset($param['year']) && !empty($param['year']) )
		{
			$sql .= " WHERE t.createDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') AND t.createDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d')";
		}
		$sql .= " GROUP BY `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取商品每月销售总数失败';
		}
		return $this->result;
	}
	

}