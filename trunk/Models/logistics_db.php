<?php

/**
 * 物流模型
 * @author janhve@163.com
 * @since   2016-07-14
 * @version 1.0
 */
 
class logistics_db {
	//Db
	private $db = NULL;
	//database table
	private $table_logisticsCost = 'base_logisticscost';
	private $table_logistcsCost_Detail = 'base_logistcscost_detail';
	private $table_ems = 'ems_list';
	private $table_config = 'base_config';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table_logisticsCost = DB_PREFIX . 'base_logisticscost';
		$this->table_ems = DB_PREFIX . 'ems_list';
		$this->table_logistcsCost_Detail = DB_PREFIX . 'base_logistcscost_detail';
		$this->table_config = DB_PREFIX . 'base_config';
	}
	
	public function getLogisticsCostList($param){
		$sql = "SELECT a.id ,a.logisticsName,a.logisticsCompanyId,b.emsName as expressCompanyName,a.aeraCode,func_receiveAddress(a.aeraCode) as sourceSendAddress,a.logisticsType,a.priceType,a.createDate FROM " . $this->table_logisticsCost . " AS a 
				LEFT JOIN " . $this->table_ems . " AS b ON a.logisticsCompanyId = b.id 
				WHERE a.status>0";
		if(isset($param['logisticsName']) && !empty($param['logisticsName']))
		{
			$sql .= ' and a.logisticsName like \'%'.$param['logisticsName'].'%\'';
		}
		if(isset($param['expressCompanyName']) && !empty($param['expressCompanyName']))
		{
			$sql .= ' and b.emsName like \'%'.$param['expressCompanyName'].'%\'';
		}
		if(isset($param['id']) && !empty($param['id']))
		{
			$sql .= ' and a.id = '.$param['id'];
		}
		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		$sql .= ' order by a.createDate desc';
		if( isset($param['limit']) )
		{
			$sql .= ' limit '.$param['limit'];
		}
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
			foreach ($this->result['data']['list'] as $key => $val) {
				$where['where']['logisticsCostId'] = $val['id'];
				$where['where']['status'] = 1;
				$detaildata  = $this->db->select($this->table_logistcsCost_Detail,'',$where);
				if(!empty($detaildata)){
					$this->result['data']['list'][$key]['areaCodeListStr']=$detaildata;
				}else{
					$this->result['data']['list'][$key]['areaCodeListStr']='';
				}
			}
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取运费列表失败';
		}
		return $this->result;
	}

	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$areaCodeListStr = '';
		if(isset($param['areaCodeListStr'])){
			$areaCodeListStr = $param['areaCodeListStr'];
			unset($param['areaCodeListStr']);
		}
		$param['status'] = 1;
		$ret = $this->db->insert($this->table_logisticsCost, $param);
		$id = $this->db->last_id();
		if($ret){
			if(!empty($areaCodeListStr)){
				$where_details['where']['logisticsCostId'] = $id;
				$param_details['status'] = 0;
				$this->db->update($this->table_logistcsCost_Detail, $param_details, $where_details);
				foreach($areaCodeListStr as $key=>$val){
					$param_detail['logisticsCostId'] = $id;
					$param_detail['areaCodeList'] = $val['areaCodeList'];
					$param_detail['destinations'] = $val['destinations'];
					$param_detail['firstItem'] = $val['firstItem'];
					$param_detail['firstCost'] = $val['firstCost'];
					$param_detail['addItem'] = $val['addItem'];
					$param_detail['addCost'] = $val['addCost'];
					if(!empty($val['id'])){
						$where_detail['where']['id'] = $val['id'];
						$param_detail['status'] = 1;
						$this->db->update($this->table_logistcsCost_Detail, $param_detail, $where_detail);
					}else{
						$param_detail['status'] = 1;
						$param_detail['createUser'] = $param['createUser'];
						$param_detail['createDate'] = $param['createDate'];
						$this->db->insert($this->table_logistcsCost_Detail, $param_detail);
					}
				}
			}
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '运费模板添加失败';
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$areaCodeListStr = '';
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		$id = $param['id'];
		unset($param['id']);
		if(isset($param['areaCodeListStr'])){
			$areaCodeListStr = $param['areaCodeListStr'];
			unset($param['areaCodeListStr']);
		}
		$ret = $this->db->update($this->table_logisticsCost, $param, $where);
		if($ret){
			if(!empty($areaCodeListStr)){
				$where_details['where']['logisticsCostId'] = $id;
				$param_details['status'] = 0;
				$this->db->update($this->table_logistcsCost_Detail, $param_details, $where_details);
				foreach($areaCodeListStr as $key=>$val){
					$param_detail['logisticsCostId'] = $id;
					$param_detail['areaCodeList'] = $val['areaCodeList'];
					$param_detail['destinations'] = $val['destinations'];
					$param_detail['firstItem'] = $val['firstItem'];
					$param_detail['firstCost'] = $val['firstCost'];
					$param_detail['addItem'] = $val['addItem'];
					$param_detail['addCost'] = $val['addCost'];
					if(!empty($val['id'])){
						$where_detail['where']['id'] = $val['id'];
						$param_detail['status'] = 1;
						$this->db->update($this->table_logistcsCost_Detail, $param_detail, $where_detail);
					}else{
						$param_detail['status'] = 1;
						$param_detail['createUser'] = $param['updateUser'];
						$param_detail['createDate'] = $param['updateDate'];
						$this->db->insert($this->table_logistcsCost_Detail, $param_detail);
					}
				}
			}
			$this->result['status'] = 1;
			$data = $this->db->select($this->table_logisticsCost, '', $where);
			$this->result['data']   = $data[0];
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新运费模板信息失败';
		}
		return $this->result;
	}
	
	/**
	 * 删除运费模板
	 */
	public function delete($param){
		$where = array();
		$where_detail = array();
		if(isset($param['id'])){
			$where['where']['id'] = $param['id'];
			$where_detail['where']['logisticsCostId'] = $param['id'];
			$where_detail['where']['status'] = 1;
			$data = $this->db->select($this->table_logistcsCost_Detail, '', $where_detail);
			$detail_ids = array();
			if(!empty($data)){
				foreach($data as $key=>$val){
					$detail_ids[] = $val['id'];
				}
			}
			if(!empty($detail_ids)){
				foreach($detail_ids as $dkey=>$dval){
					$dwhere_detail['where']['id'] = $dval;
					$param_detail['status'] = 0;
					$this->db->update($this->table_logistcsCost_Detail, $param_detail, $dwhere_detail);
				}
			}
			$id = $param['id'];
			unset($param['id']);
			$param['status'] = 0;
			$ret = $this->db->update($this->table_logisticsCost, $param, $where);
			if($ret){
				$param['id'] = $id;
				$this->result['status'] = 1;
				$this->result['data']   = $param;
			}
			else{
				if(!empty($detail_ids)){
					foreach($detail_ids as $dkey=>$dval){
						$dwhere_detail['where']['id'] = $dval;
						$param_detail['status'] = 1;
						$this->db->update($this->table_logistcsCost_Detail, $param_detail, $dwhere_detail);
					}
				}
				$this->result['status'] = 0;
				$this->result['data']   = '删除运费模板失败';
			}
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '删除运费模板失败';
		}
		return $this->result;
	}
	
	/**
	 * 获取运费列表运送范围详情数据
	 */
	public function getAreacodeList($param){
		$where = array();
		if(isset($param['id'])){
			$where['where']['id'] = $param['id'];
		}	
		$data  = $this->db->select($this->table_logistcsCost_Detail,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取运费列表运送范围详情数据失败';
		}
		return $this->result;
	}
	
	public function getLogisticsCostconfig($param){
		$where = array();

		if( isset($param['sysKey']) )
		{
			$where['where']['sysKey']  = $param['sysKey'];
		}
		
		$data  = $this->db->select($this->table_config,'id,sysKey,sysValue freeMinConsumption', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取运费策略信息失败';
		}
		return $this->result;
	}
	/**
	 * 添加
	 * @return array
	 */
	public function createCostconfig($param){
		$ret = $this->db->insert($this->table_config, $param);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '最低消费金额添加失败';
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function updateCostconfig($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		unset($param['id']);
		$ret = $this->db->update($this->table_config, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table_config, '', $where);
			$this->result['data']   = $data[0];
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新最低消费金额信息失败';
		}
		return $this->result;
	}
	
	public function getEmsList($param){
		$where = array();
		if(isset($param['emsName'])){
			$where['like']['emsName'] = $param['emsName'];
		}
		$total = $this->db->total($this->table_ems, $where);
		$this->result['data']['total'] = $total;
		$where['order']['id'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}		
		$data  = $this->db->select($this->table_ems,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取快递公司数据失败';
		}
		return $this->result;
	}
	
	/**
	 * 添加快递公司
	 * @return array
	 */
	public function createEms($param){
		$ret = $this->db->insert($this->table_ems, $param);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '快递公司添加失败';
		}
		return $this->result;
	}

	/**
	 * 编辑快递公司
	 * @return array
	 */
	public function updateEms($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update($this->table_ems, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table_ems, '', $where);
			$this->result['data']   = $data[0];
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新快递公司信息失败';
		}
		return $this->result;
	}
	
	/**
	 * 删除快递公司的数据
	 *
	 * @param int $id
	 * @return bool
	 */
	function deleteEms($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret   = $this->db->delete($this->table_ems, $where);
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