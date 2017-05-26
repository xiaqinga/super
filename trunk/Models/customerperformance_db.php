<?php

/**
 * 会员业绩模型
 * @author janhve@163.com
 * @since   2016-08-18
 * @version 1.0
 */
 
class customerperformance_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'member_customer';
	private $table_member_active = 'member_active';
	private $table_orders_list = 'orders_list';
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
	}
	
	public function getlist($param){
		$sql = "SELECT alias,accout,b.loginTimes,(SELECT COUNT(c.parentId) FROM ".$this->table." c WHERE  c.parentId = a.id) lowerLevelCount,
			(SELECT sum(d.totalAmount) FROM ".$this->table_orders_list." d WHERE d.customerId=a.id and d.`status`=7) totalAmount,
			(SELECT sum(e.totalAmount) from ".$this->table_orders_list." e LEFT JOIN ".$this->table." f on e.customerId=f.id where f.parentId=a.id and e.`status`=7) Sales,
			(SELECT sum(h.totalAmount*0.03) from ".$this->table_orders_list." h LEFT JOIN ".$this->table." g on h.customerId=g.id where g.parentId=a.id and h.`status`=7) fund
		FROM ".$this->table." a
		LEFT JOIN ".$this->table_member_active." b on a.id=b.customerId where 1=1";
		
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$sql  .= " and a.accout like '%".$param['accout']."%'";
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
			$this->result['data']   = '获取会员业绩数据失败';
		}
		return $this->result;
	}
	
}