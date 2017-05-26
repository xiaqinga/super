<?php

/**
 * App模型
 * @author janhve@163.com
 * @since   2016-09-10
 * @version 1.0
 */
 
class appmanager_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'app_manage';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'app_manage';
	}
	
	public function getlist($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['mobileSysType']) && !empty($param['mobileSysType']) )
		{
			$where['where']['mobileSysType']  = $param['mobileSysType'];
		}
		if( isset($param['version'])  && !empty($param['version']) )
		{
			$where['where']['version']  = $param['version'];
		}
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
			$this->result['data']   = '获取App数据失败';
		}
		return $this->result;
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table, $param);
		$id = $this->db->last_id();
		if($ret){
			$where = array(
				'where'=>array(
					'id !=' => $id,
					'mobileSysType' => $param['mobileSysType'],
					'apptype' => $param['apptype']
				)
			);
			$up_param['isNow'] = 'N';
			$ret = $this->db->update($this->table, $up_param, $where);
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = 'App添加失败';
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
			$this->result['data']   = '更新App信息失败';
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
			$data  = $this->db->select($this->table,'', $where);
			$mobileSysType = $data[0]['mobileSysType'];
			$isNow = $data[0]['isNow'];
			$ret   = $this->db->delete($this->table, $where);
			if ($ret)
			{
				if($isNow == 'Y'){
					$u_where = array(
						'where' => array(
							'mobileSysType' => $mobileSysType
						)
					);
					$u_where['order']['id'] = 'DESC';
					$u_data  = $this->db->select($this->table,'', $u_where);
					$up_where['where']['id'] = $u_data[0]['id'];
					$up_param['isNow'] = 'Y';
					$ret = $this->db->update($this->table, $up_param, $up_where);
				}
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