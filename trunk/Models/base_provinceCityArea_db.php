<?php

/**
 * 省份模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-03
 * @version 1.0
 */
 
class base_provinceCityArea_db {
	//Db
	private $db = NULL;
	//database table
	private $table_province = 'base_province';
	private $table_city = 'base_city';
	private $table_area = 'base_area';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table_province = DB_PREFIX . 'base_province';
		$this->table_city = DB_PREFIX . 'base_city';
		$this->table_area = DB_PREFIX . 'base_area';
	}
	
	public function getProvinceList($param){
		$where = array();

		/*if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'classId' )
			{
				$where['where']['a.classId']  = $param['key'];
			}
			
			if( $param['key_type'] == 'mark' )
			{
				$where['like']['a.mark']  = $param['key'];
			}
		}*/

		$total = $this->db->total($this->table_province, $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['code'])){
			$where['where']['code IN '] ='('.$param['code'].')';
		}
		$where['order']['id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table_province, '', $where);
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

	public function getCityList($param){
		$where = array();

		$total = $this->db->total($this->table_city, $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['provinceCode'])){
			$where['where']['provinceCode'] = $param['provinceCode'];
		}
		if(!empty($param['code'])){
			$where['where']['code IN '] = '('.$param['code'].')';
		}
		$where['order']['id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table_city, '', $where);
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

	public function getAreaList($param){
		$where = array();

		$total = $this->db->total($this->table_area, $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['cityCode'])){
			$where['where']['cityCode'] = $param['cityCode'];
		}
		if(!empty($param['code'])){
			$where['where']['code IN '] = '('.$param['code'].')';
		}
		$where['order']['id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table_area, '', $where);
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


}