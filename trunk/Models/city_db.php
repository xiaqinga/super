<?php

/**
 * 角色模型
 * @author janhve@163.com
 * @since   2016-07-14
 * @version 1.0
 */
 
class city_db {
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
	
	public function getCityList($param){
		$sql = "SELECT * FROM ((SELECT a.`code` as id,a.`name` as cname,0 as sid FROM ".$this->table_province." a) UNION "
			."(SELECT b.`code` as id,b.`name` as cname,b.provinceCode as sid FROM ".$this->table_city." b) UNION "
			."(SELECT c.`code` as id,c.`name` as cname,c.cityCode as sid FROM ".$this->table_area." c)) city WHERE id != -1";
		if(isset($param['cname']) && !empty($param['cname']))
		{
			$sql .= ' and cname like CONCAT(\'%\','.$param['cname'].',\'%\' )';
		}
		if(isset($param['sid']))
		{
			$sql .= ' and sid = '.$param['sid'];
		}
		if(isset($param['id']) && !empty($param['id']))
		{
			$sql .= ' and id = '.$param['id'];
		}
		$data  = $this->db->select($sql);
	
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取省市区列表失败';
		}
		return $this->result;
	}
}