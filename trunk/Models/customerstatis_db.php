<?php

/**
 * 会员统计模型
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class customerstatis_db {
	//Db
	private $db = NULL;
	//database table
	private $table_customer = 'member_customer';
	private $table_provider = 'admin_provider';
	private $table_enterprise_info = 'base_enterprise_info';
	private $table_area = 'base_area';
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
		$this->table_area = DB_PREFIX . 'base_area';
	}
	
	/**
	 * 获取会员与供应商总数
	 */
	public function getAllTotal($param){
		$sql = "SELECT
			(select count(1) customerCount from ".$this->table_customer."  where `status`=1) customerCount,
			(select count(1) makergoldCount from ".$this->table_customer." where `status`=1 and makerLevel=1) makergoldCount,	
			(select count(1) makersilverCount from ".$this->table_customer."  where `status`=1 and makerLevel=2) makersilverCount
		FROM
			".$this->table_customer."
		WHERE
			`status` = 1";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员总数和供应商总数失败';
		}
		return $this->result;
	}
	/**
	 * 获取创客每月总数
	 */
	public function getProviderTotalMonth($param){
		$sql = "select count(*) count, month(createDate) `month` from ".$this->table_customer.
			" where createDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') and ".
			"createDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d') and ".
		"`status` = 1 and (makerLevel = 1 or makerLevel = 2) group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取供应商每月总数失败';
		}
		return $this->result;
	}
	
	/**
	 * 获取会员每月总数
	 */
	public function getCustomerTotalMonth($param){
		$sql = "select count(*) count, month(createDate) month from ".$this->table_customer.
			" where createDate >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') and ".
			"createDate <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d') and ".
		"`status` = 1 group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员每月总数失败';
		}
		return $this->result;
	}

	/**
	 * 获取联盟商总数和供应商总数
	 */
	public function getBussTotal($param){
		$sql = "SELECT
			(select count(1) unionCount from ".$this->table_enterprise_info."  where `status`=2 and providerType=1) unionCount,
			(select count(1) supplyCount from ".$this->table_enterprise_info." where `status`=2 and providerType=2) supplyCount
		FROM
			".$this->table_enterprise_info."
		WHERE
			`status` = 2";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取联盟商总数和供应商总数失败';
		}
		return $this->result;
	}

	public function getSupplyTotalMonth($param){
		$sql = "select count(*) count, month(createTime) month from ".$this->table_enterprise_info.
			" where createTime >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') and ".
			"createTime <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d') and ".
		"`status` = 2 and providerType=1 group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取供应商每月总数失败';
		}
		return $this->result;
	}

	/**
	 * 获取联盟商每月总数
	 */
	public function getUnionTotalMonth($param){
		$sql = "select count(*) count, month(createTime) `month` from ".$this->table_enterprise_info.
			" where createTime >= DATE_FORMAT('".$param['year']."-01-01','%Y-%m-%d') and ".
			"createTime <= DATE_FORMAT('".$param['year']."-12-31','%Y-%m-%d') and ".
		"`status` = 2 and providerType=2 group by `month`";
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取联盟商每月总数失败';
		}
		return $this->result;
	}
}