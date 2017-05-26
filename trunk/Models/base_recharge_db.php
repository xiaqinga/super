<?php

/**
 * 业务
 *
 */
 
class base_recharge_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'member_wallet_income_expend_record';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'member_wallet_income_expend_record';	
		
	}

	public function getlist($param){
		$where = array();
		$where['where']['a.status'] = 1;
		if(!empty($param['key']) && !empty($param['key_type'])){
		
			if( $param['key_type'] == 'realName' )
			{
				$where['like']['b.realName']  = $param['key'];
			}
			if( $param['key_type'] == 'accout' )
			{
				$where['like']['b.accout']  = $param['key'];
			}
			
		}
		if (!empty($param['fromType'])) {
			$where['where']['a.fromType IN '] = '('.$param['fromType'].')';
		}
		if (!empty($param['orderType'])) {
			$where['where']['a.orderType'] = $param['orderType'];
		}
		if (!empty($param['inCome'])) {
			$where['where']['a.inCome !='] = null;
		}
		if (!empty($param['exPend'])) {
			$where['where']['a.exPend !='] = null;
		}
		$total = $this->db->total($this->table.' a left join t_member_customer b on a.customerId=b.id', $where);

		$this->result['data']['total'] = $total;
		
		$where['order']['a.createDate'] = 'desc';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
	
		$data = $this->db->select($this->table.' a left join t_member_customer b on a.customerId=b.id','a.*,b.accout,b.mobilePhone,b.realName', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
	}


}