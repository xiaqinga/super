<?php

/**
 * 商品统计管理
 *
 * @author  janhve@163.com
 * @since   2016.08.10
 * @version 1.0
 */
 
class goodsstatis extends common {
		
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
		$param['malltype'] = $this->queryVar('malltype',1);
		$nowYear = date('Y');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$goodsAllTotalResp = $this->model->read('goodsstatis','getGoodsTotal',$param);
		$totalGoodsCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['totalGoodsCount']))?$goodsAllTotalResp['data']['list']['totalGoodsCount']:'0';
		$onOfStockCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['onOfStockCount']))?$goodsAllTotalResp['data']['list']['onOfStockCount']:'0';
		$outOfStockCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['outOfStockCount']))?$goodsAllTotalResp['data']['list']['outOfStockCount']:'0';
		$sellTotalCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['sellTotalCount']))?$goodsAllTotalResp['data']['list']['sellTotalCount']:'0';
		$stockTotalCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['stockTotalCount']))?$goodsAllTotalResp['data']['list']['stockTotalCount']:'0';
		$param['year'] = $year;
		$goodsTotalMonthResp = $this->model->read('goodsstatis','getGoodsTotalMonth',$param);
		$goodsTotalMonth = '';
		if($goodsTotalMonthResp['status']){
			$goodsTotalMonthList = array();
			foreach ($goodsTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$goodsTotalMonthList[$ctval['month']] = $ctval['totalCount'];
			}
			$goodsTotalMonthnum = 0;
			for ($i=1; $i < 13; $i++) { 
				if(isset($goodsTotalMonthList[$i])){
					$goodsTotalMonthnum = $goodsTotalMonthList[$i]+$goodsTotalMonthnum;
					if(empty($goodsTotalMonth)){
						$goodsTotalMonth .= $goodsTotalMonthnum;
					}else{
						$goodsTotalMonth .= ','.$goodsTotalMonthnum;
					}
				}else{
					if($goodsTotalMonth == ''){
						$goodsTotalMonth .= '0';
					}else{
						if(date('n') >= $i){
							$goodsTotalMonth .= ','.$goodsTotalMonthnum;
						}else{
							$goodsTotalMonth .= ',0';
						}
					}
				}
			}
		}else{
			$goodsTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$sellGoodsTotalMonthResp = $this->model->read('goodsstatis','getSellGoodsTotalMonth',$param);
		$sellGoodsTotalMonth = '';
		if($sellGoodsTotalMonthResp['status']){
			$sellGoodsTotalMonthList = array();
			foreach ($sellGoodsTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$sellGoodsTotalMonthList[$ptval['month']] = $ptval['totalSellNum'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($sellGoodsTotalMonthList[$i])){
					if(empty($sellGoodsTotalMonth)){
						$sellGoodsTotalMonth .= $sellGoodsTotalMonthList[$i];
					}else{
						$sellGoodsTotalMonth .= ','.$sellGoodsTotalMonthList[$i];
					}
				}else{
					if($sellGoodsTotalMonth == ''){
						$sellGoodsTotalMonth .= '0';
					}else{
						$sellGoodsTotalMonth .= ',0';
					}
				}
			}
		}else{
			$sellGoodsTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalGoodsCount' => $totalGoodsCount,
			'onOfStockCount' => $onOfStockCount,
			'outOfStockCount' => $outOfStockCount,
			'sellTotalCount' => $sellTotalCount,
			'stockTotalCount' => $stockTotalCount,
			'sellGoodsTotalMonth' => $sellGoodsTotalMonth,
			'goodsTotalMonth' => $goodsTotalMonth,
			'providerId' => $providerId,
			'malltype'=>$param['malltype'],
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
		$this->setActionLog('goodsstatis','QUERY','查看普通商品统计');
		$this->view($data,'goodsstatis/index');
	}
	
	public function preindex()
	{
		$providerId = $this->queryVar('providerId');
		$nowYear = date('Y');
		$year = $this->queryVar('year', $nowYear);
		$param['providerId'] = $providerId;
		$goodsAllTotalResp = $this->model->read('goodsstatis','getPreGoodsTotal',$param);
		$totalGoodsCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['totalGoodsCount']))?$goodsAllTotalResp['data']['list']['totalGoodsCount']:'0';
		$onOfStockCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['onOfStockCount']))?$goodsAllTotalResp['data']['list']['onOfStockCount']:'0';
		$outOfStockCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['outOfStockCount']))?$goodsAllTotalResp['data']['list']['outOfStockCount']:'0';
		$sellTotalCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['sellTotalCount']))?$goodsAllTotalResp['data']['list']['sellTotalCount']:'0';
		$stockTotalCount = ($goodsAllTotalResp['status'] && !empty($goodsAllTotalResp['data']['list']['stockTotalCount']))?$goodsAllTotalResp['data']['list']['stockTotalCount']:'0';
		$param['year'] = $year;
		$goodsTotalMonthResp = $this->model->read('goodsstatis','getPreGoodsTotalMonth',$param);
		$goodsTotalMonth = '';
		if($goodsTotalMonthResp['status']){
			$goodsTotalMonthList = array();
			foreach ($goodsTotalMonthResp['data']['list'] as $ctkey => $ctval) {
				$goodsTotalMonthList[$ctval['month']] = $ctval['totalCount'];
			}
			$goodsTotalMonthnum = 0;
			for ($i=1; $i < 13; $i++) { 
				if(isset($goodsTotalMonthList[$i])){
					$goodsTotalMonthnum = $goodsTotalMonthList[$i]+$goodsTotalMonthnum;
					if(empty($goodsTotalMonth)){
						$goodsTotalMonth .= $goodsTotalMonthnum;
					}else{
						$goodsTotalMonth .= ','.$goodsTotalMonthnum;
					}
				}else{
					if($goodsTotalMonth == ''){
						$goodsTotalMonth .= '0';
					}else{
						if(date('n') >= $i){
							$goodsTotalMonth .= ','.$goodsTotalMonthnum;
						}else{
							$goodsTotalMonth .= ',0';
						}
					}
				}
			}
		}else{
			$goodsTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$sellGoodsTotalMonthResp = $this->model->read('goodsstatis','getPreSellGoodsTotalMonth',$param);
		$sellGoodsTotalMonth = '';
		if($sellGoodsTotalMonthResp['status']){
			$sellGoodsTotalMonthList = array();
			foreach ($sellGoodsTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$sellGoodsTotalMonthList[$ptval['month']] = $ptval['totalSellNum'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($sellGoodsTotalMonthList[$i])){
					if(empty($sellGoodsTotalMonth)){
						$sellGoodsTotalMonth .= $sellGoodsTotalMonthList[$i];
					}else{
						$sellGoodsTotalMonth .= ','.$sellGoodsTotalMonthList[$i];
					}
				}else{
					if($sellGoodsTotalMonth == ''){
						$sellGoodsTotalMonth .= '0';
					}else{
						$sellGoodsTotalMonth .= ',0';
					}
				}
			}
		}else{
			$sellGoodsTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data  = array(
			'totalGoodsCount' => $totalGoodsCount,
			'onOfStockCount' => $onOfStockCount,
			'outOfStockCount' => $outOfStockCount,
			'sellTotalCount' => $sellTotalCount,
			'stockTotalCount' => $stockTotalCount,
			'sellGoodsTotalMonth' => $sellGoodsTotalMonth,
			'goodsTotalMonth' => $goodsTotalMonth,
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
		$this->setActionLog('goodsstatis','QUERY','查看预约商品统计');
		$this->view($data,'goodsstatis/preindex');
	}
}