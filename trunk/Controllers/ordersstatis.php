<?php

/**
 * 订单统计管理
 *
 * @author  janhve@163.com
 * @since   2016.08.10
 * @version 1.0
 */
 
class ordersstatis extends common {
		
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
		$providerId = $this->queryVar('providerId');
		$nowYear = date('Y');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$param['malltype'] = $this->queryVar('malltype',1);
		$ordersAllTotalResp = $this->model->read('ordersstatis','getOrdersTotal',$param);
		$totalCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['totalCount']))?$ordersAllTotalResp['data']['list']['totalCount']:'0';
		$preOrderCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['preOrderCount']))?$ordersAllTotalResp['data']['list']['preOrderCount']:'0';
		$preSendOut = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['preSendOut']))?$ordersAllTotalResp['data']['list']['preSendOut']:'0';
		$offSendOut = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['offSendOut']))?$ordersAllTotalResp['data']['list']['offSendOut']:'0';
		$processedOrder = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['processedOrder']))?$ordersAllTotalResp['data']['list']['processedOrder']:'0';
		$offStockCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['offStockCount']))?$ordersAllTotalResp['data']['list']['offStockCount']:'0';
		$param['year'] = $year;
		$ordersTotalMonthResp = $this->model->read('ordersstatis','getOrdersTotalMonth',$param);
		$ordersTotalMonth = '';
		$offStockCountMonth = '';
		if($ordersTotalMonthResp['status']){
			$ordersTotalMonthList = array();
			$offStockCountMonthList = array();
			foreach ($ordersTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$ordersTotalMonthList[$ctval['month']] = $ctval['totalCount'];
				$offStockCountMonthList[$ctval['month']] = $ctval['offStockCount'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($ordersTotalMonthList[$i])){
					if(empty($ordersTotalMonth)){
						$ordersTotalMonth .= $ordersTotalMonthList[$i];
					}else{
						$ordersTotalMonth .= ','.$ordersTotalMonthList[$i];
					}
				}else{
					if($ordersTotalMonth == ''){
						$ordersTotalMonth .= '0';
					}else{
						$ordersTotalMonth .= ',0';
					}
				}
				if(isset($offStockCountMonthList[$i])){
					if(empty($offStockCountMonth)){
						$offStockCountMonth .= $offStockCountMonthList[$i];
					}else{
						$offStockCountMonth .= ','.$offStockCountMonthList[$i];
					}
				}else{
					if($offStockCountMonth == ''){
						$offStockCountMonth .= '0';
					}else{
						$offStockCountMonth .= ',0';
					}
				}
			}
		}else{
			$ordersTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
			$offStockCountMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalCount' => $totalCount,
			'preOrderCount' => $preOrderCount,
			'preSendOut' => $preSendOut,
			'offSendOut' => $offSendOut,
			'processedOrder' => $processedOrder,
			'offStockCount' => $offStockCount,
			'ordersTotalMonth' => $ordersTotalMonth,
			'offStockCountMonth' => $offStockCountMonth,
			'malltype'=>$param['malltype'],
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
		$providerList = $this->model->read('sellstatis','getProviderList');
		$data['providerList'] = ($providerList['status'])?$providerList['data']['list']:array();
		$this->setActionLog('ordersstatis','QUERY','查看商品订单统计');
		$this->view($data,'ordersstatis/index');
	}
	
	public function returnindex()
	{
		$providerId = $this->queryVar('providerId');
		$nowYear = date('Y');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$ordersAllTotalResp = $this->model->read('ordersstatis','getOrdersReturnTotal',$param);
		$totalCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['totalCount']))?$ordersAllTotalResp['data']['list']['totalCount']:'0';
		$returnOrderCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['returnOrderCount']))?$ordersAllTotalResp['data']['list']['returnOrderCount']:'0';
		$exchangeOrderCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['exchangeOrderCount']))?$ordersAllTotalResp['data']['list']['exchangeOrderCount']:'0';
		$param['year'] = $year;
		$ordersTotalMonthResp = $this->model->read('ordersstatis','getOrdersReturnTotalMonth',$param);
		$returnOrderCountMonth = '';
		$exchangeOrderCountMonth = '';
		if($ordersTotalMonthResp['status']){
			$returnOrderCountMonthList = array();
			$exchangeOrderCountMonthList = array();
			foreach ($ordersTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$returnOrderCountMonthList[$ctval['month']] = $ctval['returnOrderCount'];
				$exchangeOrderCountMonthList[$ctval['month']] = $ctval['exchangeOrderCount'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($returnOrderCountMonthList[$i])){
					if(empty($returnOrderCountMonth)){
						$returnOrderCountMonth .= $returnOrderCountMonthList[$i];
					}else{
						$returnOrderCountMonth .= ','.$returnOrderCountMonthList[$i];
					}
				}else{
					if($returnOrderCountMonth == ''){
						$returnOrderCountMonth .= '0';
					}else{
						$returnOrderCountMonth .= ',0';
					}
				}
				if(isset($exchangeOrderCountMonthList[$i])){
					if(empty($exchangeOrderCountMonth)){
						$exchangeOrderCountMonth .= $exchangeOrderCountMonthList[$i];
					}else{
						$exchangeOrderCountMonth .= ','.$exchangeOrderCountMonthList[$i];
					}
				}else{
					if($exchangeOrderCountMonth == ''){
						$exchangeOrderCountMonth .= '0';
					}else{
						$exchangeOrderCountMonth .= ',0';
					}
				}
			}
		}else{
			$returnOrderCountMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
			$exchangeOrderCountMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalCount' => $totalCount,
			'returnOrderCount' => $returnOrderCount,
			'exchangeOrderCount' => $exchangeOrderCount,
			'returnOrderCountMonth' => $returnOrderCountMonth,
			'exchangeOrderCountMonth' => $exchangeOrderCountMonth,
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
		$providerList = $this->model->read('sellstatis','getProviderList');
		$data['providerList'] = ($providerList['status'])?$providerList['data']['list']:array();
		$this->setActionLog('ordersstatis','QUERY','查看退换货订单统计');
		$this->view($data,'ordersstatis/returnindex');
	}

	public function preindex()
	{
		$providerId = $this->queryVar('providerId');
		$nowYear = date('Y');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$ordersAllTotalResp = $this->model->read('ordersstatis','getOrdersPreTotal',$param);
		$totalCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['totalCount']))?$ordersAllTotalResp['data']['list']['totalCount']:'0';
		$preOrderCount = ($ordersAllTotalResp['status'] && !empty($ordersAllTotalResp['data']['list']['preOrderCount']))?$ordersAllTotalResp['data']['list']['preOrderCount']:'0';
		$param['year'] = $year;
		$ordersTotalMonthResp = $this->model->read('ordersstatis','getOrdersPreTotalMonth',$param);
		$preOrderCountMonth = '';
		if($ordersTotalMonthResp['status']){
			$preOrderCountMonthList = array();
			foreach ($ordersTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$preOrderCountMonthList[$ctval['month']] = $ctval['preOrderCount'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($preOrderCountMonthList[$i])){
					if(empty($preOrderCountMonth)){
						$preOrderCountMonth .= $preOrderCountMonthList[$i];
					}else{
						$preOrderCountMonth .= ','.$preOrderCountMonthList[$i];
					}
				}else{
					if($preOrderCountMonth == ''){
						$preOrderCountMonth .= '0';
					}else{
						$preOrderCountMonth .= ',0';
					}
				}
			}
		}else{
			$preOrderCountMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalCount' => $totalCount,
			'preOrderCount' => $preOrderCount,
			'preOrderCountMonth' => $preOrderCountMonth,
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
		$providerList = $this->model->read('sellstatis','getProviderList');
		$data['providerList'] = ($providerList['status'])?$providerList['data']['list']:array();
		$this->setActionLog('ordersstatis','QUERY','查看预约订单统计');
		$this->view($data,'ordersstatis/preindex');
	}
}