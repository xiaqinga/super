<?php

/**
 * 对账管理表
 *
 */
 
class base_statement_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'orders_list';

	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'orders_list';	
		
	}

	public function pro(){
		$host= DB_HOST;
		$user=DB_USER;
		$password=DB_PWD;
		$db=DB_NAME;
		$dblink=mysql_connect($host,$user,$password);
		mysql_select_db($db,$dblink);
		mysql_query("CALL proEnterpriseInfo");
		$dblink->close;
	}

	public function getlist($param){
		// $this->pro();
		
		$where = ' where a.status=1';
		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'ordersNo' )
			{
				$where .= " and d.ordersNo=".$param['key'];
			}
			if( $param['key_type'] == 'providerName' )
			{
				$where .= " and c.providerName like '%".$param['key']."%'";
			}

		}

			if (!empty($param['providerType'])) {
				$where .= ' and c.providerType='.$param['providerType'];
				if ($param['providerType']==1) {
					$where .= ' and a.orderType=0';
				}elseif($param['providerType'] == 2){
					$where .= ' and a.orderType=5';
				}
			}
           $sql=" select 
					a.turnover,
					a.inCome,
					a.fromType,
					a.createDate,
					c.providerName,
					d.ordersNo
				FROM
					t_enterprise_wallet_income_expend_record AS a
				LEFT JOIN t_base_provider_ref AS b ON b.id=a.providerRefId
				LEFT JOIN t_base_enterprise_info AS c ON c.id=b.refId
				LEFT JOIN t_orders_list AS d ON d.id=a.orderId ".$where
				// ." GROUP BY e.ordersNo"
				;
	

		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		
		$sql.=" ORDER BY a.createDate DESC";

		if( isset($param['limit']) )
		{
			$sql .= ' limit '.$param['limit'];
		}
		
		
		$data  = $this->db->select($sql);
		// var_dump($this->db->last_query());exit;
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']  = '获取数据失败';
		}
		return $this->result;
	}



	public function exportOrders($param){
		if (!empty($param)) {
			$where = ' where a.status=1';
			if (!empty($param['providerName'])) {
				$where .= " and c.providerName='".$param['providerName']."'";
			}
			if (!empty($param['startDate'])) {
				$where .=" and a.createDate >='".$param['startDate']." 00:00:00 '";
			}
			if(!empty($param['endDate'])){
				$where .= " and a.createDate <='".$param['endDate']." 23:59:59 '";
			}
			if (!empty($param['providerType'])) {
				$where .= ' and c.providerType='.$param['providerType'];
				if ($param['providerType']==1) {
					$where .= ' and a.orderType=0';
				}elseif($param['providerType'] == 2){
					$where .= ' and a.orderType=5';
				}
			}
			$sql=" select 
					a.turnover,
					a.inCome,
					a.fromType,
					a.createDate,
					c.providerName,
					d.ordersNo
				FROM
					t_enterprise_wallet_income_expend_record AS a
				LEFT JOIN t_base_provider_ref AS b ON b.id=a.providerRefId
				LEFT JOIN t_base_enterprise_info AS c ON c.id=b.refId
				LEFT JOIN t_orders_list AS d ON d.id=a.orderId ".$where
				// ." GROUP BY e.ordersNo"
				;

			$resp = $this->db->select($sql);
			// print_r($this->db->last_query());exit;
			// var_dump($resp);exit;
			if ($resp) {
				$this->result['status'] = 1;
				$this->result['data'] = $resp;
			}else{
				$this->result['status'] = 0;
			}
			return $this->result;
			
		}
	}

	public function countOrder($param){
		$where = ' where a.status=1';
		if (!empty($param['key']) && !empty($param['key_type'])) {
			if ($param['key_type'] == 'pname') {
				$where .= " and c.providerName='".$param['key']."'";
			}
		}
		if (!empty($param['providerType'])) {
			$where .= ' and c.providerType='.$param['providerType'];
		}
		$sql=" select t.providerName,sum(t.turnover) as turnover,sum(t.inCome) as inCome
		         FROM
		         (select 
					a.turnover,
					a.inCome,
					a.fromType,
					a.createDate,
					c.providerName,
					d.ordersNo
				   FROM
					t_enterprise_wallet_income_expend_record AS a
				LEFT JOIN t_base_provider_ref AS b ON b.id=a.providerRefId
				LEFT JOIN t_base_enterprise_info AS c ON c.id=b.refId
				LEFT JOIN t_orders_list AS d ON d.id=a.orderId ".$where."
				 ) t
				GROUP BY t.providerName
				";
			$total = $this->db->total($sql);
			$this->result['data']['total'] = $total;
		
	
			if( isset($param['limit']) )
			{
				$sql .= ' limit '.$param['limit'];
			}
	
	
			$data  = $this->db->select($sql);
		if($data){
			$this->result['status'] = 1;
			$this->result['data']['list'] = $data;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}
	public function getItem()
	{
		$sql = "SELECT * from t_base_enterprise_info";
		$data  = $this->db->select($sql);
		$this->result['status'] = 1;
		$this->result['data'] = $data;

		return $this->result;
	}
     //获取基金金额总数
	public function  getFundMoneyCount(){
		$sql = "SELECT SUM(accumulaFund) as money,fundType from t_base_fund GROUP BY fundType;";
		$data  = $this->db->select($sql);
		if($data){
			$this->result['status'] = 1;
			$this->result['data'] = $data;
		}else{
			$this->result['status'] = 0;
		}

	return $this->result;

	}

	//获取基金记录总数
	public function  getFundList($param){



			switch ($param['key_type']){
				case 'schoolName':
					$sql = "
				         select a.income,a.fromType,a.createDate,b.schoolName as name ,c.accout,d.ordersNo from t_member_wallet_income_expend_record as a 
				         left join t_base_school as b on b.id=a.schoolId
				         left join t_member_customer as c on a.customerId=c.id 
			             left join t_orders_list as d on a.orderId=d.id 
		                 where a.status=1 AND a.orderType=9 AND b.schoolName LIKE '%".$param['key']."%'";
					break;
				case 'providerName':
					$sql = "select a.income,a.fromType,a.createDate,'尚一' as name,c.accout,d.ordersNo
				            from t_member_wallet_income_expend_record as a 
				            left join t_member_customer as c on a.customerId=c.id 
			                left join t_orders_list as d on a.orderId=d.id 
				            where a.status=1 AND a.orderType=8 ";
                    break;
				default :$sql = "
							select a.income,a.fromType,a.createDate,b.schoolName as name,c.accout,d.ordersNo from t_member_wallet_income_expend_record as a 
							left join t_base_school as b on b.id=a.schoolId
							left join t_member_customer as c on a.customerId=c.id 
							left join t_orders_list as d on a.orderId=d.id 
							where a.status=1 AND a.orderType=9 
						   union all
							select a.income,a.fromType,a.createDate,'尚一' as name,c.accout,d.ordersNo
							 from t_member_wallet_income_expend_record as a 
							left join t_member_customer as c on a.customerId=c.id 
							left join t_orders_list as d on a.orderId=d.id 
							where a.status=1 AND a.orderType=8  
					";
			}







		$total  = $this->db->total($sql);
	
		$this->result['data']['total'] = $total;
		$sql .= " order by createDate DESC";

		if( isset($param['limit']) )
		{
			$sql .= ' limit '.$param['limit'];
		}


		$data  = $this->db->select($sql);
	
		if($data){
			$this->result['status'] = 1;
			$this->result['data']['list'] = $data;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;

	}




}