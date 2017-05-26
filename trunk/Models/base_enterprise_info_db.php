<?php

/**
 * 企业管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.08.01
 * @version 1.0
 */

class base_enterprise_info_db
{
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_enterprise_info';
	private $table_pro = 'base_enterprise_account';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_enterprise_info';
		$this->table_pro = DB_PREFIX . 'base_enterprise_account';
	}

	public function getTotal($param)
	{
    	$where = array();
    	$where['where'] = array('a.status !=' => '0','a.parentId'=>'0'); 
    	if(!empty($param['providerType'])){
    		$where['where'] = array(
			  'a.providerType' => $param['providerType']
			);
    	}
		if (!empty($param['providerName'])){
			$where['like'] = array(
			  'a.providerName' => $param['providerName']
			);
		}
		if (!empty($param['customerId'])){
			$where['where'] = array(
				'a.customerId' => ''
			);
		}
		if(!empty($param['corporate'])){
			$where['like'] = array(
			  'a.corporate' => $param['corporate']
			);
		}
		if (!empty($param['address'])) {
			$where['like'] = array(
			  'a.address' => $param['address']
			);
		}
		if (!empty($param['status'])) {
			$where['where']['a.status'] = $param['status'];
		}
	
    	if (!empty($param['providerType'])) {
			$where['where']['a.providerType'] = $param['providerType'];
		}
		if (!empty($param['accout'])) {
			$where['where']['c.accout'] = $param['accout'];
		}


		// $totals = $this->db->total($this->table.' a', $where);
		$totals = $this->db->total($this->table.' a left join t_base_provider_ref as b on b.refId=a.id left join t_member_customer as c on c.id=a.customerId', $where);
		$this->result['status'] = 1;
		$this->result['data'] = $totals;

		return $this->result;
	}

	public function getItems($param)
	{

    	$where = array();
    	$where['where'] = array(
    		'a.status !=' => '0',
    		'a.parentId'=>'0'
    	); 
    	// $where['where']['a.parentId'] = '0';

		if (!empty($param['customerId'])){
			$where['where'] = array(
				'a.customerId ' =>NULL
			);
		}
		if (!empty($param['providerName'])){
			$where['like'] = array(
			  'a.providerName' => $param['providerName']
			);
		}
		if(!empty($param['corporate'])){
			$where['like'] = array(
			  'a.corporate' => $param['corporate']
			);
		}
		if(!empty($param['address'])){
			$where['like'] = array(
			  'a.address' => $param['address']
			);
		}
		if (!empty($param['status'])) {
			$where['where']['a.status'] = $param['status'];
		}
		if (!empty($param['providerType'])) {
			$where['where']['a.providerType'] = $param['providerType'];
		}
		if (!empty($param['accout'])) {
			$where['where']['c.accout'] = $param['accout'];
		}
		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}

		$where['order']['a.createTime'] = 'DESC';
		if (!empty($param['limit'])){
			$where['limit'] = $param['limit'];
		}
		// $data = $this->db->select($this->table.' a ', 'a.*', $where);
		$data = $this->db->select($this->table.' a left join t_base_provider_ref as b on b.refId=a.id left join t_member_customer as c on c.id=a.customerId', 'a.*,b.id as bid,c.accout', $where);
		if (count($data[0]) > 0){
			$this->result['status'] = 1;
			$this->result['data'] = $data;
		}

		return $this->result;
	}

	public function getItem($param)
	{
		if (!empty($param['id'])) {
			$where['where']['id'] = $param['id'];
		}
		if (!empty($param['providerCode'])) {
			$where['where']['providerCode'] = $param['providerCode'];
		}
		if ($param['providerType'] == '1') {
			$data  = $this->db->select($this->table, '', $where);
		}elseif($param['providerType'] == '2'){
			$data  = $this->db->select('t_base_shop_info', 'shopName as providerName', $where);
		}else{
			$where['where']['parentId'] = '0';
			$data  = $this->db->select($this->table, '', $where);
		}
		
		// $data  = $this->db->select($this->table, '', $where);
		if (count($data[0]) > 0){
			$this->result['status'] = 1;
			$this->result['data'] = $data[0];
		}
		return $this->result;
	}

	/**
	 * 添加企业信息
	 * @return array
	 */
	public function create($param){
		unset($param['id']);
		$ret = $this->db->insert($this->table, $param);
		if($ret){
			$this->result['status'] = 1;
			$param['id'] = $this->db->last_id();
			$this->result['data']   = $param;
		}
		return $this->result;
	}
  
	/**
	 * 添加的中间表数据
	 */

	public function providerref($param){
		$where['where']['refId']=$param['refId'];
		$ret=$this->db->select('t_base_provider_ref','' ,$where);
		if($ret){
			$this->db->update('t_base_provider_ref',$param ,$where);
		}else{
			$this->db->insert('t_base_provider_ref', $param);
		}
	}
	/**
	 * 查找中间表
	 */
	public function findref($param){
		// $where['where']['providerType'] = 1;
		$where['where']['id'] = $param['id'];
		$resp = $this->db->select('t_base_provider_ref','',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data']['list'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 编辑企业信息
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
		if($ret!==false){
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
			$delete['status'] = 0;
			$ret   = $this->db->update($this->table, $delete, $where);
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
	 * 解除店铺和会员的双向绑定
	 *
	 * @param int $id
	 * @return bool
	 */
  
	public function getStuInfo($param){
		$where = 'where 1=1';
		if (!empty($param['realName'])) {
			$where .= " and realName like '%".$param['realName']."%'";
		}

		$sql = "SELECT * FROM t_member_customer ".$where." and id not in 
			(
			SELECT customerId FROM t_base_enterprise_info WHERE isStudent='Y' and customerId  is not null
			) ";

		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		if( isset($param['limit']) )
		{
			$sql .= ' limit '.$param['limit'];
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
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	public function findphoto($param){
		$where['where']['id'] = $param;
		$resp = $this->db->select('t_base_photo','',$where);
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function findbasephoto($param){
		$where['where']['id'] = $param;
		$resp = $this->db->select('t_base_photo','',$where);
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function findrotation($id){
		$where['where']['id'] = $id;
		$resp = $this->db->select($this->table,'rotationPhotoIds,updateTime,customerId',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function deletePhoto($param){
		if (!empty($param)) {
			$where['where']['id'] = $param;
			$resp = $this->db->delete('t_goods_photo',$where);
			if ($resp)
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

    public function  providerlist(){

		$where['where']['providerType']=1;
		if($data=$this->db->select($this->table,'id,providerName',$where)){
			foreach ($data as $key=>$val){
				$list[$val['id']]=$val['providerName'];

			}

		};
		
		return $list?$list:'';


	}

	public function proving($param){
		$sql = "
			select * from t_base_enterprise_info where status=2 and providerName='".$param['providerName']."' and id not in (".$param['id'].")";
		$resp = $this->db->select($sql);
	
		if($resp){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function getSubShop($param){
		$where['where']['status !='] = '0';
		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		if(!empty($param['parentId'])){
			$where['where']['parentId'] = $param['parentId'];
		}
		if(!empty($param['linkman'])){
			$where['where']['linkman'] = $param['linkman'];
		}
		$this->result['total'] = $this->db->total($this->table,$where);
		if (!empty($param['limit'])){
			$where['limit'] = $param['limit'];
		}
		$resp = $this->db->select($this->table,'',$where);
		// var_dump($resp);die();
		// var_dump($this->db->last_query());die();
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data']['list'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function getUnionClassName($param){
		$where['where']['status'] = 1;
		$where['where']['parentId'] = '0';
		$resp = $this->db->select('t_base_union_shop_class','',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data']['list'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}
}
?>