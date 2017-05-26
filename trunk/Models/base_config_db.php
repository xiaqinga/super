<?php

/**
 * 业务
 *
 */
 
class base_config_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_config';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_config';	
		
	}

	public function getlist($param){
		$data = $this->db->select($this->table,'*', $where);

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

	public function update($param){
		$where['where']['sysKey'] = $param['sysKey'];
		$array['sysValue'] = $param['sysValue'];
		$resp = $this->db->update($this->table,$array,$where);
		if($resp!==false){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

}