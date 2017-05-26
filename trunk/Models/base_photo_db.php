<?php

/**
 * 基本图片模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_photo_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_photo';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_photo';
	}
	
	public function getlist($param){
		$where = array();

		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'classId' )
			{
				$where['where']['classId']  = $param['key'];
			}
			
			if( $param['key_type'] == 'mark' )
			{
				$where['like']['mark']  = $param['key'];
			}
		}

		$total = $this->db->total($this->table, $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		if(!empty($param['goodsId'])){
			$where['where']['goodsId'] = $param['goodsId'];
		}
		$where['order']['displayOrder'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table, '', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
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
			$this->result['last_id']   = $this->db->last_id;
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
		return $this->result;
	}

	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		if (!empty($param['id']))
		{

			$where['where']['id IN ']  = '('.$param['id'].')';

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