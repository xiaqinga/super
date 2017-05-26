<?php

/**
 * 会员管理模型
 * @author janhve@163.com
 * @since   2016-08-30
 * @version 1.0
 */
 
class customer_list_db {
	//Db
	private $db = NULL;
	//database table
	private $table = '';
	private $table_area = '';
	private $table_provider = '';
	private $table_address = '';
	private $table_enterprise = '';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'member_customer';
		$this->table_area = DB_PREFIX . 'base_area';
		$this->table_address = DB_PREFIX . 'member_receiving_address';
		$this->table_provider   =  DB_PREFIX . 'base_provider_ref';
		$this->table_enterprise =  DB_PREFIX . 'base_enterprise_info';
	}



	public function getTotal($param)
	{
		$where = array();
		$where['where'] = array('a.status !=' => '0');
		if(!empty($param['id'])){
			$where['where'] = array(
				'parentId '=> $param['id']
			);
		}


		// $totals = $this->db->total($this->table.' a', $where);
		$totals = $this->db->total($this->table, $where);
		return $totals?$totals:'0';
	}
	public function getSuperiorAccount($param){
		$where = array();
		$where['where'] = array('a.status !=' => '0');
		if(!empty($param['parentId'])){
			$where['where'] = array(
				'id '=> $param['parentId']
			);
			$res=$this->db->select($this->table,'accout',$where);

		}


		return $res?$res['0']['accout']:'--';

	}
	
	public function getlist($param){
		$sql = "SELECT a.id,a.accout,a.alias,a.realName,a.mobilePhone,a.status,a.makerLevel,a.createDate,a.awardRule,a.matrixUrl,b.providerType,c.providerName 
		FROM ".$this->table." a left join ".$this->table_provider."  b on  a.providerRefId = b.id left join t_base_enterprise_info as c on a.id=c.customerId 
		where 1=1";
		if( isset($param['id']) && !empty($param['id']) )
		{
			$sql  .= " and a.id = ".$param['id'];
		}
		
		if( isset($param['parentId']) && !empty($param['parentId']) )
		{
			$sql  .= " and a.parentId = ".$param['parentId'];
		}
		// var_dump($param['customerType']);die();
		if( isset($param['customerType']) && !empty($param['customerType']) )
		{
			switch ($param['customerType']){
				case '1':
					$sql  .= " and a.makerLevel is null and b.providerType is null ";
					break;
				case '2':
					$sql  .= " and a.makerLevel = 1 ";
					break;
				case '3':
					$sql  .= " and a.makerLevel = 2 ";
					break;
				case '4':
					$sql  .= " and b.providerType = 1 ";
					break;
				case '5':
					$sql  .= " and b.providerType = 2 ";
					break;
			}

		}

		if( isset($param['accout']) && !empty($param['accout']) )
		{
			$sql  .= " and a.accout like '%".$param['accout']."%'";
		}
		
		if( isset($param['status']) && !empty($param['status']) )
		{
			$sql  .= " and a.status = ".$param['status'];
		}

		if( isset($param['providerName']) && !empty($param['providerName']) )
		{
			$sql  .= " and c.providerName = '".$param['providerName']."'";
		}
		if( isset($param['mobilePhone']) && !empty($param['mobilePhone']) )
		{
			$sql  .= " and a.mobilePhone = ".$param['mobilePhone'];
		}

		
		if( isset($param['alias']) && !empty($param['alias']) )
		{
			$sql  .= " and a.alias like '%".$param['alias']."%'";
		}
		
		if( isset($param['startDate']) && !empty($param['startDate']) )
		{
			$sql  .= " and a.createDate >= '".date('Y-m-d 00:00:00',strtotime($param['startDate']))."'";
		}
		
		if( isset($param['endDate']) && !empty($param['endDate']) )
		{
			$sql  .= " and a.createDate <= '".date('Y-m-d 23:59:59',strtotime($param['endDate']))."'";
		}
		
		$total = $this->db->total($sql);
		// var_dump($this->db->last_query());die();
		$this->result['data']['total'] = $total;
		$sql  .= " order by id DESC";
		if( isset($param['limit']) )
		{
			$sql  .= " limit ".$param['limit'];
		}
		$data  = $this->db->select($sql);
		// var_dump($this->db->last_query());die();
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取会员数据失败';
		}
		return $this->result;
	}
	
	public function getInfo($param){
		$where['where']['a.id']=$param['id'];
		$ret= $this->db->select($this->table.' a left join '.$this->table_provider.' b on a.providerRefId = b.id 
			  ','a.*,b.providerType,b.refId',$where);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $ret;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取失败';
		}
		return $this->result;
	}
	/**
	 * 获得会收货地址信息
	 * @return array
	 */
	public function getReceivingAddress($param){
		$where['where']['a.customerId']=$param['id'];
		$ret= $this->db->select($this->table_address.' a left join '.$this->table_area.' b 
		on a.areaCode = b.code','a.receivingPeople,a.telephone,a.address,b.postalCode,func_receiveAddress(a.areaCode) as prefixAddress',$where);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $ret;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取失败';
		}
		return $this->result;
	}


	/**
	 * 获得会员详细信息
	 * @return array
	 */
	 public function findOne($param){
	 	 $where['where']['a.id']=$param['id'];
		 $ret= $this->db->select($this->table.' a left join '.$this->table_provider.' b on a.providerRefId = b.id left join '.
			 $this->table_enterprise.' c on b.refId=c.id ','a.id,a.accout,a.alias,a.realName,a.providerRefId,
			 c.providerName,c.linkman,c.mobilePhone,c.industry',$where);
		 if($ret){
			 $this->result['status'] = 1;
			 $this->result['data']   = $ret;
		 }
		 else{
			 $this->result['status'] = 0;
			 $this->result['data']   = '获取失败';
		 }
		 return $this->result;
	 }
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){

		$ret = $this->db->insert($this->table, $param);
		$param['id'] = $this->db->last_id();
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '会员添加失败';
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
		$id = $param['id'];
		unset($param['id']);
		$ret = $this->db->update($this->table, $param, $where);
		if($ret!==false){
			$param['id'] = $id;
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新会员信息失败';
		}
		return $this->result;
	}

	public function delete($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		$ret = $this->db->delete($this->table,$where);
		if($ret)
		{
			$this->result['status'] = 1;
			$this->result['data']   = '删除会员数据成功';
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '删除会员数据失败';
		}
	}
	public function  findParent($param){
		$res='';
		$where['where']['id']=$param['id'];
		$ret = $this->db->select($this->table,'parentId',$where);
		if($ret){
			$arr['where']['id']=$ret['0']['parentId'];
			$res=$this->db->select($this->table,'id,makerLevel',$arr);
		}

		if($res){
			$this->result['status'] = 1;
			$this->result['data']   = $res;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取失败';
		}
		return $this->result;
	}
}