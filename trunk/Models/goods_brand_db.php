<?php

/**
 * 商品品牌模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-12
 * @version 1.0
 */
 
class goods_brand_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_brand';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'goods_brand';
	}
	
	public function getlist($param){

		$where = array();
		$where['where']['t1.status >'] = 0;

		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'brandName' )
			{
				$where['like']['t1.brandName']  = $param['key'];
			}
		}
		if(!empty($param['id'])){
			$where['where']['t1.id']  = $param['id'];
		}
		$where['order']['t1.id'] = 'DESC';

		$total = $this->db->total($this->table.' t1 ', $where);
		$this->result['data']['total'] = $total;

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table.' t1 ',' t1.* ', $where);
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

	public function getGoodsBrandClassId($param){

		if(!empty($param['id'])){
			$data  = $this->db->select("SELECT id,brandName FROM {$this->table} WHERE  status > '0' AND ( classIds LIKE CONCAT('%', {$param['id']}, '%'))");
		}
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
			$this->result['data']   = $param;
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

	public function getAttr($param){
		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		$where['order']['id'] = 'DESC';
		$data  = $this->db->select($this->table, $param['field'], $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']  = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}
}