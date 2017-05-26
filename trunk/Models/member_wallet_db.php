<?php

/**
 * 钱包管理
 *
 * @since   2017-01-04
 */
 
class member_wallet_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'member_wallet';
	private $table_member = "member_customer";
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'member_wallet';
		$this->table_member = DB_PREFIX . 'member_customer';
	
	}
	
	public function getlist($param){
		if(!empty($param['key_type']) && !empty($param['key'])){
		
			if(($param['key_type']) == 'alias' )
			{
				$where .= " and a.alias='".$param['key']."'";
			}
			if(($param['key_type']) == 'accout')
			{
				$where .= " and a.accout='".$param['key']."'";
			}
			if(($param['key_type']) == 'realName')
			{
				$where .= " and a.realName='".$param['key']."'";
			}
		}
		$sql_total = "
			select 
				a.id,
				a.alias,
				a.accout,
				a.realName,
				a.mobilePhone,
				b.availableMoney,
				b.remainingMoney,
				s.exPend
			FROM
				t_member_customer AS a
			LEFT JOIN t_member_wallet AS b ON a.id = b.customerId 
			LEFT JOIN 
			(
				SELECT
					sum(c.exPend) as exPend,a1.id
				FROM 
					t_member_customer AS a1
				LEFT JOIN t_member_wallet_income_expend_record AS c ON a1.id = c.customerId
				WHERE 
					c.fromType = 3
				OR c.fromType = 4
			GROUP BY c.customerId
			) AS s on a.id=s.id

			WHERE
				a. STATUS = 1  
		".$where;
		$total = $this->db->total($sql_total);
		$this->result['data']['total'] = $total;
		if(!empty($param['id'])){
			$where .= " and a.id=".$param['id'];
		}

		$where .= " order by a.id DESC";

		if( isset($param['limit']) )
		{
			$where .= " limit ".$param['limit'];
		}
		$sql = "
			select a.id,
				a.alias,
				a.accout,
				a.realName,
				a.mobilePhone,
				b.availableMoney,
				b.remainingMoney,
				s.exPend
			FROM
				t_member_customer AS a
			LEFT JOIN t_member_wallet AS b ON a.id = b.customerId 
			LEFT JOIN 
			(
				SELECT
					sum(c.exPend) as exPend,a1.id
				FROM 
					t_member_customer AS a1
				LEFT JOIN t_member_wallet_income_expend_record AS c ON a1.id = c.customerId
				WHERE 
					c.fromType = 3
				OR c.fromType = 4
			GROUP BY c.customerId
			) AS s on a.id=s.id
			WHERE
				a. STATUS = 1  
		".$where;
		
		$data = $this->db->select($sql);
		// print_r($this->db->last_query());die();
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}
    public  function setIntegral($param){

		if(!empty($param['id'])&&isset($param['id'])){
			$where['where']['customerId']=$param['id'];
			$dataparam['remainingSilverScore = '] = 'remainingSilverScore+'.$param['remainingSilverScore'].'';
			$dataparam['accumulaSilverScore = '] = 'accumulaSilverScore+'.$param['accumulaSilverScore'].'';

            $this->db->update($this->table,$dataparam,$where);
		}

	}

	public function getBaseConfig($param){
		$where['where']['sysKey'] = $param['sysKey'];
		$resp = $this->db->select("t_base_config",'sysValue,sysDescribe',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['list'] = $resp[0];
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function setIncomeDetail($param){
		$this->db->insert('t_member_wallet_income_expend_record',$param);
	}
	
}