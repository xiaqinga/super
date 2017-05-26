<?php

/**
 * 供应商模型
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class provider_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_enterprise_account';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_enterprise_account';
	}
	
	public function getProviderToPasswrod($param){
		$where = array();

		if( isset($param['providerAccout']) )
		{
			$where['where']['providerAccout']  = $param['providerAccout'];
		}
		
		if( isset($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['providerPassWord']) )
		{
			$where['where']['providerPassWord']  = $param['providerPassWord'];
		}
		$where['where']['status'] = 1;
		$data  = $this->db->select($this->table,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取供应商账号数据失败';
		}
		return $this->result;
	}
	
	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update($this->table, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table, '', $where);
			$this->result['data']   = $data[0];
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新供应商账号数据失败';
		}
		return $this->result;
	}
}