<?php

/**
 * 用户模型
 * @author janhve@163.com
 * @since   2016-07-14
 * @version 1.0
 */
 
class user_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'admin_user';
	private $table_dept = 'admin_dept';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'admin_user';
		$this->table_dept = DB_PREFIX . 'admin_dept';
	}
	
	public function getUserToPasswrod($param){
		$where = array();

		if( isset($param['accout']) )
		{
			$where['where']['accout']  = $param['accout'];
		}
		
		if( isset($param['passWord']) )
		{
			$where['where']['passWord']  = $param['passWord'];
		}
		$where['where']['status !='] = 0;
		$data  = $this->db->select($this->table,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}
	
	public function getlist($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['phoneNumber']) && !empty($param['phoneNumber']) )
		{
			$where['where']['phoneNumber']  = $param['phoneNumber'];
		}
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$where['like']['accout']  = $param['accout'];
		}
		if( isset($param['userName']) && !empty($param['userName']) )
		{
			$where['like']['userName']  = $param['userName'];
		}
		if( isset($param['passWord']) )
		{
			$where['where']['passWord']  = $param['passWord'];
		}
		$where['where']['userType']  = 1;
		$total = $this->db->total($this->table, $where);
		$this->result['data']['total'] = $total;
		$where['order']['id'] = 'DESC';
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
	
	public function checkexist($param){
		$where = array();
		
		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['phoneNumber']) && !empty($param['phoneNumber']) )
		{
			$where['where']['phoneNumber']  = $param['phoneNumber'];
		}
		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$where['where']['accout']  = $param['accout'];
		}
		
		$where['where']['userType']  = 1;
		$total = $this->db->total($this->table, $where);
		$data  = $this->db->select($this->table,'', $where);
		if($total>=1)
		{
			if( isset($param['id']) && !empty($param['id']) )
			{
				if( $data[0]['id'] <> $param['id'] ){
					$this->result['status'] = 0;
					$this->result['data']   = '已存在';
				}else{
					$this->result['status'] = 1;
					$this->result['data']   = '不存在';
				}
			}else{
				$this->result['status'] = 0;
				$this->result['data']   = '已存在';
			}
		}
		else
		{
			$this->result['status'] = 1;
			$this->result['data']   = '不存在';
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
			$this->result['data']   = '用户添加失败';
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
			$this->result['data']   = '更新用户信息失败';
		}
		return $this->result;
	}
	
	/**
	 * 删除指关键字值的数据
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret   = $this->db->delete($this->table, $where);
			if ($ret)
			{
				$this->result['status'] = 1;
				$this->result['data']   = $param; //返回完整的记录信息
			}
			else
			{
				$this->result['status'] = 0;
			}
		}
		else
		{
			$this->result['status'] = 0;
		}

		return $this->result;
	}
	/**
	 * 获取部门列表
	 */
	public function getDeptList($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}

		if( isset($param['deptName']) && !empty($param['deptName']) )
		{
			$where['like']['deptName']  = $param['deptName'];
		}
		
		$where['where']['deptStatus']  = 1;
		$total = $this->db->total($this->table_dept, $where);
		$this->result['data']['total'] = $total;
		$where['order']['id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table_dept,'', $where);
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
}