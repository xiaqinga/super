<?php

/**
 * 供应商管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.07.27
 * @version 1.0
 */

class admin_provider_db
{
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_enterprise_account';
	private $table_info = 'base_enterprise_info';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_enterprise_account';
		$this->table_info = DB_PREFIX . 'base_enterprise_info';
	}

	public function getTotal($param)
	{
		$where = array();
    $where['where'] = array('status !=' => '0');
    	if(!empty($param['providerAccout'])){
			$where['where'] = array(
				'providerAccout' => $param['providerAccout']
			);
		}
		if (!empty($param['providerName'])){
			$where['like'] = array(
			  'providerName' => $param['providerName']
			);
		}
		if(!empty($param['linkman'])){
			$where['like'] = array(
			  'linkman' => $param['linkman']
			);
		}
		$totals = $this->db->total($this->table, $where);
		$this->result['status'] = 1;
		$this->result['data'] = $totals;

		return $this->result;
	}

	public function getItems($param)
	{
		$where = array();
    	$where['where'] = array('a.status !=' => '0');
    	if(!empty($param['providerAccout'])){
			$where['where'] = array(
				'a.providerAccout' => $param['providerAccout']
			);
		}
		if (!empty($param['providerName'])){
			$where['like'] = array(
			  'b.providerName' => $param['providerName']
			);
		}
		if(!empty($param['linkman'])){
			$where['like'] = array(
			  'a.linkman' => $param['linkman']
			);
		}
		$total = $this->db->total($this->table.' a left join t_base_enterprise_info as b on b.id=a.enterpriseInfoId', $where);
		$this->result['total'] = $total;

		$where['order']['a.createTime'] = 'DESC';
		if (!empty($param['limit'])){
			$where['limit'] = $param['limit'];
		}
		$data = $this->db->select($this->table.' a left join t_base_enterprise_info as b on b.id=a.enterpriseInfoId','a.*,b.providerName', $where);
		if (count($data[0]) > 0){
			$this->result['status'] = 1;
			$this->result['data'] = $data;
		}

		return $this->result;
	}

	public function getItem($param)
	{
		$where = array(
			'where' => array(
				'a.id' => $param['id']
			)
		);

		$data  = $this->db->select($this->table.' a left join '.$this->table_info.' b on b.id=a.enterpriseInfoId ', 'a.*,b.providerName, b.telPhone, b.industry, b.address, b.description, b.website', $where);
		if (count($data[0]) > 0){
			$this->result['status'] = 1;
			$this->result['data'] = $data[0];
		}

		return $this->result;
	}

	/**
	 * 添加供应商信息
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
	 * 编辑供应商信息
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

	public function getlist($param){
		if(!empty($param['id'])){
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret = $this->db->select($this->table,'',$where);
			if($ret){
				$this->result['status'] = 1;
				$this->result['data'] = $ret;
			}else{
				$this->result['status'] = 0;
			}
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 账户密码重置
	 */
	
	public function updatepwd($param){
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
	 * 企业账号重复判断
	 */
	public function isrepeat($param){
		if(!empty($param)){
			$where['where']['providerAccout'] = $param;
			$resp = $this->db->select($this->table,'',$where);
			if($resp){
				$this->result['status'] = 0;
				$this->result['isrepeat'] = 1;
			}else{
				$this->result['status'] = 1;
				$this->result['isrepeat'] = 0;
			}
		}else{
			$this->result['status'] = 0;
			$this->result['isrepeat'] = 1;
		}	
		return $this->result;
	}
}
?>