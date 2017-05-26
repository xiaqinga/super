<?php

/**  
 * 审核管理
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class  transfer_db {
	//Db
	private $db = NULL;
	//database table
	private $table = '';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . '';
	}
	
	public function getlist($param){
		$where='';
		if(!empty($param['accout'])){
			$where .= " and e.accout='".$param['accout']."'";
		}
		if(!empty($param['realName'])){
			$where .= " and e.realName='".$param['realName']."'";
		}
		if(!empty($param['bankBranchName'])){
			$where .= " and b.bankBranchName='".$param['bankBranchName']."'";
		}
		if(!empty($param['transferStatus'])){
			$where .= ' and a.transferStatus='.$param['transferStatus'];
		}
		if(!empty($param['fromType'])){
			$where .= ' and a.fromType='.$param['fromType'];
		}
		if(!empty($param['transferBatchCode'])){
			$where .= ' and a.transferBatchCode='.$param['transferBatchCode'];
		}
		if(!empty($param['bindType'])){
			$where .= ' and b.bindType='.$param['bindType'];
		} 
		
		$sql = "
				select a.id,a.transferBatchCode,b.bindType,a.failureCause,a.fromType,a.createDate,e.accout,a.emsNo,e.realName,e.mobilePhone,f.bankName,f.bankAreaCode,b.bankBranchName,b.bankBindUserName,b.bankCodeNo,a.inCome as money,d.providerType as infotype from t_enterprise_wallet_income_expend_record as a 
				left join t_enterprise_wallet as b on b.providerRefId=a.providerRefId
				left join t_base_provider_ref as c on c.id=a.providerRefId
				left join t_base_enterprise_info as d on d.id=c.refId 
				left join t_member_customer as e on e.id=d.customerId
				left join t_base_bank_branch as f on f.bankBranchCode=b.bankBranchCode
				where a.status=1 ".$where."
			union all
				select a.id,a.transferBatchCode,b.bindType,a.failureCause,a.fromType,a.createDate,e.accout,a.emsNo,e.realName,e.mobilePhone,f.bankName,f.bankAreaCode,b.bankBranchName,b.bankBindUserName,b.bankCodeNo,a.exPend as money,3 as infotype
				 from t_member_wallet_income_expend_record as a 
				left join t_member_customer as e on e.id=a.customerId
				left join t_member_wallet as b on b.customerId=a.customerId
				left join t_base_bank_branch as f on f.bankBranchCode=b.bankBranchCode
				where a.status=1 and a.exPend >0 ".$where."
		";

		$total  = $this->db->total($sql);
		
		$this->result['data']['total'] = $total;
		$sql .= " order by createDate DESC";
		
		if( isset($param['limit']) )
		{
			$sql .= " limit ".$param['limit'];
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

	public function getEnterpriseList($param){
		$where='';
		if(!empty($param['accout'])){
			$where .= " and e.accout='".$param['accout']."'";
		}
		if(!empty($param['realName'])){
			$where .= " and e.realName='".$param['realName']."'";
		}
		if(!empty($param['bankBranchName'])){
			$where .= " and b.bankBranchName='".$param['bankBranchName']."'";
		}
		if(!empty($param['transferStatus'])){
			$where .= ' and a.transferStatus='.$param['transferStatus'];
		}
		if(!empty($param['providerId'])){
			$where .= ' and d.providerType='.$param['providerId'];
		}
		if(!empty($param['fromType'])){
			$where .= ' and a.fromType='.$param['fromType'];
		}
		if(!empty($param['bindType'])){
			$where .= ' and b.bindType='.$param['bindType'];
		}
		if(!empty($param['startDate'])){
			$where .= " and a.createDate >= '".date('Y-m-d 00:00:00',strtotime($param['startDate']))."' ";
		}

		if(!empty($param['endDate'])){
			$where .= " and a.createDate <= '".date('Y-m-d 23:59:59',strtotime($param['endDate']))."' ";
		}
		$sql = "
				select a.createDate,a.id,e.accout,b.bindType,a.failureCause,a.emsNo,e.mobilePhone,e.realName,f.bankName,f.bankAreaCode,b.bankBranchName,b.bankBindUserName,b.bankCodeNo,a.inCome as money,d.providerType as infotype from t_enterprise_wallet_income_expend_record as a 
				left join t_enterprise_wallet as b on b.providerRefId=a.providerRefId
				left join t_base_provider_ref as c on c.id=a.providerRefId
				left join t_base_enterprise_info as d on d.id=c.refId 
				left join t_member_customer as e on e.id=d.customerId
				left join t_base_bank_branch as f on f.bankBranchCode=b.bankBranchCode
				where a.status=1 ".$where."
	  
		";

		$total  = $this->db->total($sql);

		$this->result['data']['total'] = $total;
		$sql .= " order by createDate DESC";

		if( isset($param['limit']) )
		{
			$sql .= " limit ".$param['limit'];
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
	public function getCustomerList($param){
		$where='';
		if(!empty($param['accout'])){
			$where .= " and e.accout='".$param['accout']."'";
		}
		if(!empty($param['realName'])){
			$where .= " and e.realName='".$param['realName']."'";
		}
		if(!empty($param['bankBranchName'])){
			$where .= " and b.bankBranchName='".$param['bankBranchName']."'";
		}
		if(!empty($param['transferStatus'])){
			$where .= ' and a.transferStatus='.$param['transferStatus'];
		}
		if(!empty($param['providerId'])){
			$where .= ' and d.providerType='.$param['providerId'];
		}
		if(!empty($param['fromType'])){
			$where .= ' and a.fromType='.$param['fromType'];
		}
		if(!empty($param['bindType'])){
			$where .= ' and b.bindType='.$param['bindType'];
		}
		if(!empty($param['startDate'])){
			$where .= " and a.createDate >= '".date('Y-m-d 00:00:00',strtotime($param['startDate']))."' ";
		}
     
		if(!empty($param['endDate'])){
			$where .= " and a.createDate <= '".date('Y-m-d 23:59:59',strtotime($param['endDate']))."' ";
		}
		$sql = "
				select a.createDate,a.id,e.accout,a.emsNo,e.realName,b.bindType,e.mobilePhone,f.bankName,f.bankAreaCode,b.bankBranchName,b.bankBindUserName,b.bankCodeNo,a.exPend as money,3 as infotype from t_member_wallet_income_expend_record as a 
				left join t_member_customer as e on e.id=a.customerId
				left join t_member_wallet as b on b.customerId=a.customerId
				left join t_base_bank_branch as f on f.bankBranchCode=b.bankBranchCode
				where a.status=1 and a.exPend >0 ".$where."
	  
		";

		$total  = $this->db->total($sql);

		$this->result['data']['total'] = $total;
		$sql .= " order by createDate DESC";

		if( isset($param['limit']) )
		{
			$sql .= " limit ".$param['limit'];
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

	public  function setTransferStatus($param){

		$where['where']['id in ']='('.$param['ids'].')';

		$data=[
		    'transferBatchCode'=>$param['transferBatchCode'],
			'transferStatus'=>2,
			'failureCause'=>'',
		];
        if(1==$param['type']){
			$ret = $this->db->update('t_enterprise_wallet_income_expend_record', $data, $where);
		}else{
			$ret = $this->db->update('t_member_wallet_income_expend_record', $data, $where);
		}

		if($ret!==false){

			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		
          return $this->result;
	}

	public function getCityList($param){
	
		$cityList=[];
		if(!empty($param['bankAreaCode'])){
            $where['where']['bankAreaCode']=$param['bankAreaCode'];
			$cityCodeList=$this->db->select('t_base_area','cityCode',$where);
		
            if($cityCodeList['0']['cityCode']){
				$uparam['where']['code']=$cityCodeList['0']['cityCode'];
				$cityList=$this->db->select('t_base_city','name,provinceCode',$uparam);

			}else{

				$cityList=$this->db->select('t_base_city','name,provinceCode',$where);
			}
		}
         return    $cityList['0'];

	}

	public function getProvinceName($param){
		if(!empty($param['provinceCode'])){
			$where['where']['code']=$param['provinceCode'];
			$provinceList=$this->db->select('t_base_province','name',$where);

		}
		return    $provinceList['0']['name'];


	}

	public function setTransferStatusByCode($param){

		if(!empty($param['transferBatchCode'])) {
			$uparam['where']['transferBatchCode']=$param['transferBatchCode'];
			$uparam['where']['transferStatus']=2;

			$enterpriseTotal = $this->db->total('t_enterprise_wallet_income_expend_record', $uparam);
			$memberTotal = $this->db->total('t_member_wallet_income_expend_record', $uparam);



			$where['where']['transferBatchCode']=$param['transferBatchCode'];
			$data=[
				'transferStatus'=>3
			];
		    if($enterpriseTotal){
				$this->db->update('t_enterprise_wallet_income_expend_record', $data, $where);

			}
		    if($memberTotal){
				$this->db->update('t_member_wallet_income_expend_record', $data, $where);

			}
			   $this->result['status'] = 1;
			if(!($enterpriseTotal||$memberTotal)){
				$this->result['status'] = 0;
			}

		}


		return $this->result;
		
     }
	public  function setTransferStatusById($param){
        if(!empty($param['id'])){
			$where['where']['id']=$param['id'];

			$data=[
				'transferStatus'=>$param['transferStatus'],
				'failureCause'=>$param['failureCause']
			];
			if(1==$param['type']){
				$ret = $this->db->update('t_enterprise_wallet_income_expend_record', $data, $where);
			}else{
				$ret = $this->db->update('t_member_wallet_income_expend_record', $data, $where);
			}

		}
    
		if($ret!==false){

			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;

	}


}