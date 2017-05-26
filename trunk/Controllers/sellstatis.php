<?php

/**
 * 销售统计管理
 *
 * @author  janhve@163.com
 * @since   2016.08.10
 * @version 1.0
 */
 
class sellstatis extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
	}
	
	public function index()
	{
		$nowYear = date('Y');
		$providerId = $this->queryVar('providerId');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$sellAllTotalResp = $this->model->read('sellstatis','getSellAllTotal',$param);
		$sellAllTotal = ($sellAllTotalResp['status'])?$sellAllTotalResp['data']['list']['sellTotalMoney']:'0.00';
		$brokerageAllTotalResp = $this->model->read('sellstatis','getBrokerageAllTotal',$param);
		$brokerageAllTotal = ($brokerageAllTotalResp['status'])?$brokerageAllTotalResp['data']['list']['sumBrokerage']:'0.00';
		$param['year'] = $year;
		$sellTotalMonthResp = $this->model->read('sellstatis','getSellTotalMonth',$param);
		$sellTotalMonthMonth = '';
		if($sellTotalMonthResp['status']){
			$sellTotalMonthMonthList = array();
			foreach ($sellTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$sellTotalMonthMonthList[$ctval['month']] = $ctval['sellTotalMoney'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($sellTotalMonthMonthList[$i])){
					if(empty($sellTotalMonthMonth)){
						$sellTotalMonthMonth .= $sellTotalMonthMonthList[$i];
					}else{
						$sellTotalMonthMonth .= ','.$sellTotalMonthMonthList[$i];
					}
				}else{
					if($sellTotalMonthMonth == ''){
						$sellTotalMonthMonth .= '0';
					}else{
						$sellTotalMonthMonth .= ',0';
					}
				}
			}
		}else{
			$sellTotalMonthMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$brokerageTotalMonthResp = $this->model->read('sellstatis','getBrokerageTotalMonth',$param);
		$brokerageTotalMonth = '';
		if($brokerageTotalMonthResp['status']){
			$brokerageTotalMonthList = array();
			foreach ($brokerageTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$brokerageTotalMonthList[$ptval['month']] = $ptval['sumBrokerage'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($brokerageTotalMonthList[$i])){
					if(empty($brokerageTotalMonth)){
						$brokerageTotalMonth .= $brokerageTotalMonthList[$i];
					}else{
						$brokerageTotalMonth .= ','.$brokerageTotalMonthList[$i];
					}
				}else{
					if($brokerageTotalMonth == ''){
						$brokerageTotalMonth .= '0';
					}else{
						$brokerageTotalMonth .= ',0';
					}
				}
			}
		}else{
			$brokerageTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'sellAllTotal' => $sellAllTotal,
			'brokerageAllTotal' => $brokerageAllTotal,
			'sellTotalMonthMonth' => $sellTotalMonthMonth,
			'brokerageTotalMonth' => $brokerageTotalMonth,
			'providerId' => $providerId,
			'year' => $year,
			'ref' => $this->func->curr_url()
		);
		$base_year = date('Y');
		$x = $base_year-2013;
		$yearlist = array();
		for($i=0;$i<$x+1;$i++){
			$yearlist[] = $base_year-($x-$i);
		}
		$data['yearlist'] = $yearlist;
		$proId['providerType'] = 1;
		$providerList = $this->model->read('sellstatis','getProviderList',$proId);
		$data['providerList'] = ($providerList['status'])?$providerList['data']['list']:array();
		$this->setActionLog('sellstatis','QUERY','查看供应商销售统计');
		$this->view($data,'sellstatis/index');
	}


	public function indexunion()
	{
		$nowYear = date('Y');
		$providerId = $this->queryVar('providerId');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$sellAllTotalResp = $this->model->read('sellstatis','getSellUnionAllTotal',$param);
		$sellAllTotal = ($sellAllTotalResp['status'])?$sellAllTotalResp['data']['list']['sellTotalMoney']:'0.00';
		$brokerageAllTotalResp = $this->model->read('sellstatis','getBrokerageUnionAllTotal',$param);
		$brokerageAllTotal = ($brokerageAllTotalResp['status'])?$brokerageAllTotalResp['data']['list']['sumBrokerage']:'0.00';
		$param['year'] = $year;
		$sellTotalMonthResp = $this->model->read('sellstatis','getSellUnionTotalMonth',$param);
		$sellTotalMonthMonth = '';
		if($sellTotalMonthResp['status']){
			$sellTotalMonthMonthList = array();
			foreach ($sellTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$sellTotalMonthMonthList[$ctval['month']] = $ctval['sellTotalMoney'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($sellTotalMonthMonthList[$i])){
					if(empty($sellTotalMonthMonth)){
						$sellTotalMonthMonth .= $sellTotalMonthMonthList[$i];
					}else{
						$sellTotalMonthMonth .= ','.$sellTotalMonthMonthList[$i];
					}
				}else{
					if($sellTotalMonthMonth == ''){
						$sellTotalMonthMonth .= '0';
					}else{
						$sellTotalMonthMonth .= ',0';
					}
				}
			}
		}else{
			$sellTotalMonthMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$brokerageTotalMonthResp = $this->model->read('sellstatis','getBrokerageUnionTotalMonth',$param);
		$brokerageTotalMonth = '';
		if($brokerageTotalMonthResp['status']){
			$brokerageTotalMonthList = array();
			foreach ($brokerageTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$brokerageTotalMonthList[$ptval['month']] = $ptval['sumBrokerage'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($brokerageTotalMonthList[$i])){
					if(empty($brokerageTotalMonth)){
						$brokerageTotalMonth .= $brokerageTotalMonthList[$i];
					}else{
						$brokerageTotalMonth .= ','.$brokerageTotalMonthList[$i];
					}
				}else{
					if($brokerageTotalMonth == ''){
						$brokerageTotalMonth .= '0';
					}else{
						$brokerageTotalMonth .= ',0';
					}
				}
			}
		}else{
			$brokerageTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'sellAllTotal' => $sellAllTotal,
			'brokerageAllTotal' => $brokerageAllTotal,
			'sellTotalMonthMonth' => $sellTotalMonthMonth,
			'brokerageTotalMonth' => $brokerageTotalMonth,
			'providerId' => $providerId,
			'year' => $year,
			'ref' => $this->func->curr_url()
		);
		$base_year = date('Y');
		$x = $base_year-2013;
		$yearlist = array();
		for($i=0;$i<$x+1;$i++){
			$yearlist[] = $base_year-($x-$i);
		}
		$data['yearlist'] = $yearlist;
		$proId['providerType'] = 2;
		$providerList = $this->model->read('sellstatis','getProviderList',$proId);
		$data['providerList'] = ($providerList['status'])?$providerList['data']['list']:array();
		$this->setActionLog('sellstatis','QUERY','查看联盟商销售统计');
		$this->view($data,'sellstatis/indexunion');
	}
	
}