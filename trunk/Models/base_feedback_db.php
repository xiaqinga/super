<?php

/**
 * 用户反馈
 *
 */
 
class base_feedback_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_faceback';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_faceback';	
		
	}

	public function getlist($param){
		$where = array();
		if(!empty($param['key']) && !empty($param['key_type'])){
		
			if( $param['key_type'] == 'alias' )
			{
				$where['where']['b.alias']  = $param['key'];
			}
		}
		$total = $this->db->total($this->table.' a left join t_member_customer as b on b.id=a.customerId ', $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		
		$where['order']['b.createDate'] = 'desc';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
	
		$data = $this->db->select($this->table.' a left join t_member_customer as b on b.id=a.customerId','a.*,b.alias', $where);
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