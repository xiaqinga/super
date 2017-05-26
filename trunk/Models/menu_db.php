<?php

/**
 * 菜单模型
 * @author janhve@163.com
 * @since   2016-07-15
 * @version 1.0
 */
 
class menu_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'admin_menu';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'admin_menu';
	}
	
	public function getMenuList($param){
		$where = array();

		if( isset($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['parentId']) )
		{
			$where['where']['parentId']  = $param['parentId'];
		}
		
		if( isset($param['menuStatus']) )
		{
			$where['where']['menuStatus']  = $param['menuStatus'];
		}
		$where['order']['menuSort'] = 'ASC';
		$data  = $this->db->select($this->table,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取菜单数据失败';
		}
		return $this->result;
	}
	/**
	 * 根据菜单id获取菜单详情
	 *
	 * @param int $id 菜单ID
	 * @return $this->_data 菜单详情
	 */
	function getItem($param)
	{
		$where                  = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		$data                   = $this->db->select($this->table, '', $where);
		$this->result['status'] = 1;
		$this->result['data']   = $data[0];

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
			$this->result['data']   = '菜单添加失败';
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
			$this->result['data']   = '更新菜单信息失败';
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
}