<?php

/**
 * 会员统计管理
 *
 * @author  janhve@163.com
 * @since   2016.08.10
 * @version 1.0
 */
 
class customerstatis extends common {
		
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
		$year = $this->queryVar('year', 2017);
		$resp = $this->model->read('customerstatis','getAllTotal');
		$param['year'] = $year;
		$customerTotalMonthResp = $this->model->read('customerstatis','getCustomerTotalMonth',$param);
		$customerTotalMonth = '';
		if($customerTotalMonthResp['status']){
			$customerTotalMonthList = array();
			foreach ($customerTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$customerTotalMonthList[$ctval['month']] = $ctval['count'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($customerTotalMonthList[$i])){
					if(empty($customerTotalMonth)){
						$customerTotalMonth .= $customerTotalMonthList[$i];
					}else{
						$customerTotalMonth .= ','.$customerTotalMonthList[$i];
					}
				}else{
					if($customerTotalMonth == ''){
						$customerTotalMonth .= '0';
					}else{
						$customerTotalMonth .= ',0';
					}
				}
			}
		}else{
			$customerTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$providerTotalMonthResp = $this->model->read('customerstatis','getProviderTotalMonth',$param);
		$providerTotalMonth = '';
		if($providerTotalMonthResp['status']){
			$providerTotalMonthList = array();
			foreach ($providerTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$providerTotalMonthList[$ptval['month']] = $ptval['count'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($providerTotalMonthList[$i])){
					if(empty($providerTotalMonth)){
						$providerTotalMonth .= $providerTotalMonthList[$i];
					}else{
						$providerTotalMonth .= ','.$providerTotalMonthList[$i];
					}
				}else{
					if($providerTotalMonth == ''){
						$providerTotalMonth .= '0';
					}else{
						$providerTotalMonth .= ',0';
					}
				}
			}
		}else{
			$providerTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalCustomer' => ($resp['status']) ? $resp['data']['list']['customerCount'] : 0,
			'makergoldCount' => ($resp['status']) ? $resp['data']['list']['makergoldCount'] : 0,
			'makersilverCount' => ($resp['status']) ? $resp['data']['list']['makersilverCount'] : 0,
			// 'checkedenterpriseCount' => ($resp['status']) ? $resp['data']['list']['checkedenterpriseCount'] : 0,
			'customerTotalMonth' => $customerTotalMonth,
			'providerTotalMonth' => $providerTotalMonth,
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
		$this->setActionLog('customerstatis','QUERY','查看会员统计');
		$this->view($data,'customerstatis/index');
	}

	public function indexbusiness()
	{
		$year = $this->queryVar('year', 2017);
		$resp = $this->model->read('customerstatis','getBussTotal');
		$param['year'] = $year;
		$customerTotalMonthResp = $this->model->read('customerstatis','getSupplyTotalMonth',$param);
		$customerTotalMonth = '';
		if($customerTotalMonthResp['status']){
			$customerTotalMonthList = array();
			foreach ($customerTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$customerTotalMonthList[$ctval['month']] = $ctval['count'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($customerTotalMonthList[$i])){
					if(empty($customerTotalMonth)){
						$customerTotalMonth .= $customerTotalMonthList[$i];
					}else{
						$customerTotalMonth .= ','.$customerTotalMonthList[$i];
					}
				}else{
					if($customerTotalMonth == ''){
						$customerTotalMonth .= '0';
					}else{
						$customerTotalMonth .= ',0';
					}
				}
			}
		}else{
			$customerTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$providerTotalMonthResp = $this->model->read('customerstatis','getUnionTotalMonth',$param);
		$providerTotalMonth = '';
		if($providerTotalMonthResp['status']){
			$providerTotalMonthList = array();
			foreach ($providerTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$providerTotalMonthList[$ptval['month']] = $ptval['count'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($providerTotalMonthList[$i])){
					if(empty($providerTotalMonth)){
						$providerTotalMonth .= $providerTotalMonthList[$i];
					}else{
						$providerTotalMonth .= ','.$providerTotalMonthList[$i];
					}
				}else{
					if($providerTotalMonth == ''){
						$providerTotalMonth .= '0';
					}else{
						$providerTotalMonth .= ',0';
					}
				}
			}
		}else{
			$providerTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'unionCount' => ($resp['status']) ? $resp['data']['list']['unionCount'] : 0,
			'supplyCount' => ($resp['status']) ? $resp['data']['list']['supplyCount'] : 0,
			'customerTotalMonth' => $customerTotalMonth,
			'providerTotalMonth' => $providerTotalMonth,
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
		$this->setActionLog('customerstatis','QUERY','查看商企统计');
		$this->view($data,'customerstatis/indexbusiness');
	}
	
}