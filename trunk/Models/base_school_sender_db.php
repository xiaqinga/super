<?php

/**
 * 送货员管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.07.28
 * @version 1.0
 */

class base_school_sender_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_school_sender';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_school_sender';
	}
	
	public function getlist($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['roleName']) && !empty($param['roleName']) )
		{
			$where['like']['roleName']  = $param['roleName'];
		}
		$where['where']['status'] = 1;
		
		$total = $this->db->total($this->table, $where);
		$this->result['data']['total'] = $total;
		$where['order']['id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table,'', $where);
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
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table, $param);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '角色添加失败';
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
			$this->result['data']   = '更新角色信息失败';
		}
		return $this->result;
	}
}