<?php

/**
 * 退换货
 *
 * @author wsbnet@qq.com
 * @since   2016-9-01
 * @version 1.0
 */
 
class orders_return extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}

	public function index()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$ordersNo = $this->queryVar('ordersNo');
		$goodsName = $this->queryVar('goodsName');
		$providerName = $this->queryVar('providerName');
		$memberAlias = $this->queryVar('memberAlias');
		$statuses = $this->queryVar('statuses');
		$param = array();
		if(!empty($ordersNo)){
			$key_type = 'ordersNo';
			$key = $ordersNo;
			$param['ordersNo'] = $ordersNo;
		}
		if(!empty($goodsName)){
			$key_type = 'goodsName';
			$key = $goodsName;
			$param['goodsName'] = $goodsName;
		}
		if(!empty($providerName)){
			$key_type = 'providerName';
			$key = $providerName;
			$param['providerName'] = $providerName;
		}
		if(!empty($memberAlias)){
			$key_type = 'memberAlias';
			$key = $memberAlias;
			$param['memberAlias'] = $memberAlias;
		}
		if(!empty($statuses)){
			$param['statuses'] = $statuses;
		}
		
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('orders_return','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			//传递查询框的值
			'key_type' => $key_type,
			'key' => $key,
			'statuses' => $statuses,
			'accouttype' => $accouttype,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'orders_return/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$ordersNo = $this->queryVar('ordersNo');
		$goodsName = $this->queryVar('goodsName');
		$providerName = $this->queryVar('providerName');
		$memberAlias = $this->queryVar('memberAlias');
		$statuses = $this->queryVar('statuses');
		$param = array();
		if(!empty($ordersNo)){
			$key_type = 'ordersNo';
			$key = $ordersNo;
			$param['ordersNo'] = $ordersNo;
		}
		if(!empty($goodsName)){
			$key_type = 'goodsName';
			$key = $goodsName;
			$param['goodsName'] = $goodsName;
		}
		if(!empty($providerName)){
			$key_type = 'providerName';
			$key = $providerName;
			$param['providerName'] = $providerName;
		}
		if(!empty($memberAlias)){
			$key_type = 'memberAlias';
			$key = $memberAlias;
			$param['memberAlias'] = $memberAlias;
		}
		if(!empty($statuses)){
			$param['statuses'] = $statuses;
		}
		
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('orders_return','getlist',$param);

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			//传递查询框的值
			'key_type' => $key_type,
			'key' => $key,
			'statuses' => $statuses,
			'ctrl' => $this,
			'ref' => $this->queryVar('ref' , APP_URL . 'orders_return/index?'.$key_type.'='.$key.'&page='.$page.'&statuses='.$statuses)
		);
		$this->view($data,'orders_return/ajaxindex');
	}

	public function info()
	{
		//查询
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$info = $this->model->read('orders_return','getinfo', $param);
		
		$data  = array(
			//传递下拉菜单
			'attr' => $info['status'] ? $info['data'] : array(),
			'ctrl' => $this,
			'id' => $id,
			'ref' => $this->queryVar('ref', APP_URL . 'orders_return/index')
		);
		$this->view($data,'orders_return/info');
	}

	public function confirm()
	{
		//查询
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$info = $this->model->read('orders_return','getinfo', $param);

		if ($info['status']) {
			$normsValueIds = $info['data']['normsValueIds'];
			
			$normsValue = $this->getNormsValueString($normsValueIds);
			$info['data']['normsValues'] = $normsValue;
		}

			// 如果退换货，需要加载换货商品的所有规格和所有物流信息，供商家选择，重新发货，生成订单
			if( $info['data']['type']==2 && $info['data']['status']!=7 ){
				$orderReturnStatus = $info['data']['orderReturnStatus'];
				if ($orderReturnStatus == 3) {
					// 物流公司信息
					$ems_list = $this->model->read('ems_list','getlist');
					$data['ems'] = $ems_list['status'] ? $ems_list['data']['list'] : array();

					// 用户选择的退换货商品对应的所有规格
					$param_sgnv = array('id' => $info['data']['goodsId']);
					$GoodsNormsValueStockModel = $this->model->read('orders_return','selectGoodsNormsValueStockGoodsId', $param_sgnv);
					$goodsNormsValueStocksArr = $GoodsNormsValueStockModel['status'] ? $GoodsNormsValueStockModel['data']['list'] : array();
					foreach ($goodsNormsValueStocksArr as $k => $v) {
						$normsValue = $this->getNormsValueString($v['normsValueIds']);
						$goodsNormsValueStocksArr[$k]['normsValue'] = $normsValue;
					}
					$data['goodsNormsValueStocks'] = $goodsNormsValueStocksArr;
				} else if ($orderReturnStatus > 3) {
					// 商家查看订单，展示已选择的商品和物流信息
					// 获取换货生成的新订单,读取订单信息
					// 新订单
					$newOrderId = $info['data']['newOrderId'];
					$put = array('ordersId' => $info['data']['newOrderId']);
					$normsInfo = $this->model->read('orders_return','queryOrdersNormsInfoById', $put);
					$newOrdersNo = $normsInfo['data'][0]['ordersNo'];
					// 新订单的订单号
					$data['newOrdersNo'] = $newOrdersNo;
					
					// 换货商品
					$normsValueId = $normsInfo['data'][0]['normsValueId'];
					$goodsId = $info['data']['goodsId'];
					$param_gnvs = array('goodsId' => $goodsId, 'goodsNormsValueId' => $normsValueId);
					$GoodsNormsValueStock = $this->model->read('orders_return','getNormsValueStockByMap', $param_gnvs);
					$newNormsValue = $this->getNormsValueString($GoodsNormsValueStock['data']['normsValueIds']);
					$data['newNormsValue'] = $newNormsValue;
					$data['newNormsPreferentialPrice'] =$GoodsNormsValueStock['data']['preferentialPrice'];
					
					// 物流信息
					$put = array('id' => $newOrderId);
					$order = $this->model->read('orders_return','queryOrdersNormsInfoById', $put);
					$emsNo = $order['data']['EMSNo'];
					$emsName = $order['data']['EMSName'];
					$data['newEmsNo'] = $emsNo;
					$data['newEmsName'] = $newEmsName;
				}
			}

		$data['attr'] = $info['status'] ? $info['data'] : array();
		$data['ctrl'] = $this;
		$data['id'] = $id;
		$data['ref'] = APP_URL . 'orders_return/index?status=2';
		$this->view($data,'orders_return/confirm');
	}

	//规格值对应的名称
	public function getNormsValueString($goodsNormsValueIds){
		$normsValue = '';
		$normsValueIds = $goodsNormsValueIds;
		$normsValueIdsArr = explode(',', $normsValueIds);
		foreach ($normsValueIdsArr as $k => $v) {
			if( $v == 0 ){
				continue;
			}
			if( $v > 0 ){
				$param_v = array('id'=> $v);
 				$norms_value = $this->model->read('goods_norms_name', 'getNormsValue',$param_v);
 				$normsValue .= $norms_value['data']['normsValue'];
			}else{
				$param_v = array('id'=> abs($v));
 				$norms_value = $this->model->read('goods_norms_name', 'getNormsAddValue',$param_v);
 				$normsValue .= $norms_value['data']['normsValue'];
			}
			if( $k ==0 && $normsValueIdsArr[1] != 0 ){
				$normsValue .='/';
			}
		}
		return $normsValue;
	}

  public function setStatus($status, $type){

		// （1待审核2退换货中（商家已同意，待用户还货）3退换货中（用户已还货，待商家确认）4已生成换货新订单5已换货6为已退货7为已驳回）
		if($type == 1){ // 退货
			if($status == 1)
				return "待审核";
			else if($status == 2)
				return "退货中<div>(待用户还货)</div>";
			else if($status == 3)
				return "退货中<div>(待商家确认)</div>";
			else if($status == 7)
				return "已驳回";
			else
				return "已完成";
		}
		else{ // 换货
			if($status == 1)
				return "待审核";
			else if($status == 2)
				return "退货中<div>(待用户还货)</div>";
			else if($status == 3)
				return "退货中<div>(待商家确认)</div>";
			else if($status == 4)
				
				return "换货中<div>(商家已发货)</div>";
			else if($status == 7)
				return "已驳回";
			else
				return "已完成";
		}
  }

  //退换货审核
  /*状态
  	1待审核
		2退换货中（商家已同意，待用户还货）
		3退换货中（用户已还货，待商家确认）
		4已生成换货新订单
		5已换货
		6为已退
		7为已驳回*/
	public function approveOrder(){
		//查询
		$id = $this->queryVar('id',0);
		$auditExplain = $this->queryVar('auditExplain','');
		$status = $this->queryVar('status',0);
		if(!empty($id)){
			$param['id'] = $id;
		}
		//判断订单状态
		$orderReturnRef = $this->model->read('orders_return','getOrderReturnById', $param);
		if($orderReturnRef['status'] != 1 ){
			$data = array('error' => true, 'msg' => '订单状态不正确');
		}else{

			//审核表
			$param = array(
				'auditExplain' => $auditExplain, 
				'returnRefId' => $id, 
				'createTime' => date('Y-m-d H:i:s'), 
				'status' => 1 //通过
			);
			$resp = $this->model->write('orders_return','insertOrderReturnCheck', $param);

			//流程表
			$up_status = $status == 1 ? 2 : 7;
			$param = array(
				'returnRefId' => $id, 
				'status' => $up_status, 
				'createTime' => date('Y-m-d H:i:s'), 
				'createUser' => $this->sess->get('id'),
				'userType' => 1
			);
			$resp = $this->model->write('orders_return','insertReturnFlow', $param);

			//修改退换货订单状态
			$param = array(
				'where' => array(
					'where' => array(
						'id' => $id, 
					)
				),
				'field' => array(
					'status' => $up_status,
				)
			);
			$resp = $this->model->write('orders_return','updateOrderReturnRef', $param);

			//修改原始订单信息（修改退换货商品状态、重新计算原订单金额）
			if ( $status == 1 ) {
				$param_up = array(
					'orderId' => $orderReturnRef['data']['orderId'],
					'returnGoodsNum' => $orderReturnRef['data']['returnGoodsNum'], 
					'customerId' => $orderReturnRef['data']['customerId'], 
					'totalMoeny' => $orderReturnRef['data']['totalMoeny'], 
					'goodsId' => $orderReturnRef['data']['goodsId'], 
					'normsValueId' => $orderReturnRef['data']['normsValueId'],
					'type' => $orderReturnRef['data']['type']
				);
				$this->updatePrimitiveOrderInfo($param_up);
				exit;
			}
			$data = array('error' => false, 'msg' => '审核成功');
		}
    echo json_encode($data);
    exit;
	}

	//修改原始订单信息（修改退换货商品状态、重新计算原订单金额）
	public function updatePrimitiveOrderInfo($param){
		//查询原订单信息
		$param_up = array(
			'ordersId' => $param['orderId'], 
		);
		$ordersGoodsInfos = $this->model->read('orders_return','queryOrdersNormsInfoById', $param_up);
		if(!$ordersGoodsInfos['status']){
			return false;
		}

		$ordersGoodsStatus = $param['type'] == 1 ? 2 : 3;
		$returnMoney = 0;
		foreach ($ordersGoodsInfos['data'] as $k => $v) {

			if($v['goodsId'] != $param['goodsId']){
				continue;
			}

			$buyNum = $v['buyNum'] - $param['returnGoodsNum'];
			//该款商品已全部退换，则修改对应的订单下商品状态为“已退、换货”
			if ($buyNum == 0) { 
				$status = $ordersGoodsStatus;
			}
			$uparam = array(
				'where' => array(
					'where' => array(
						'id' => $v['id'], 
					)
				),
				'field' => array(
					'buyNum' => $buyNum,
					'status' => $status,
				)
			);

			$resp = $this->model->write('orders_return','updateOrderGoodsInfo', $uparam);
			$returnMoney = ($param['returnGoodsNum']*$v['transactionPrice'])+$returnMoney;
		}

		//判断订单状态
		if (count($ordersGoodsInfos['data']) == 1) {
			$param_up = array(
				'ordersId' => $param['orderId'], 
			);
			$ordersGoodsInfos = $this->model->read('orders_return','queryOrdersNormsInfoById', $param_up);
			// 订单下商品已全部退换货
			if(!$ordersGoodsInfos['status']){
				// 修改订单状态为“已完成”
				$param1 = array(
					'actionUser' => $this->sess->get('id'), 
					'actionUserType' => 1, 
					'ordersId' => $param1['orderId'], 
					'status' => 8
				);
				$resp = $this->model->write('orders_return','insertOrdersFlow', $param1);
			}
		}

		// 订单改为已退换货
		$list = array(
			'where' => array(
				'where' => array(
					'id' => $param['goodsId'], 
				)
			),
			'field' => array(
				'status' => 8,
				'totalAmount' => $ordersGoodsInfos['data'][0]['totalAmount']-$returnMoney,
				'sumMoney' => $ordersGoodsInfos['data'][0]['sumMoney']
			)
		);
		$resp = $this->model->write('orders_return','updateOrdersById', $list);
	}

	//商家确认收到用户返货
  /*状态
  	1待审核
		2退换货中（商家已同意，待用户还货）
		3退换货中（用户已还货，待商家确认）
		4已生成换货新订单
		5已换货
		6为已退
		7为已驳回*/
	public function updateReceipt(){

		//查询
		$id = $this->queryVar('id',0);
		$newOrderNormsValueId = $this->queryVar('newOrderNormsValueId');
		$emsNo = $this->queryVar('emsNo');
		$emsName = $this->queryVar('emsName');
		$emsId = $this->queryVar('emsId');
		$ordersNo = $this->queryVar('ordersNo');

		if(!empty($id)){
			$param['id'] = $id;
		}
		//判断订单状态
		$orderReturnRef = $this->model->read('orders_return','getOrderReturnById', $param);
		if($orderReturnRef['data']['status'] != 3 ){
			$data = array('error' => true, 'msg' => '订单状态不正确');
		}else{
			$param_up['field']['orderId']=$orderReturnRef['data']['orderId'];
			$param_up['field']['returnGoodsNum']=$orderReturnRef['data']['returnGoodsNum'];
			$param_up['field']['customerId']=$orderReturnRef['data']['customerId'];
			$param_up['field']['totalMoeny']=$orderReturnRef['data']['totalMoeny'];
			$param_up['field']['goodsId']=$orderReturnRef['data']['goodsId'];
			$param_up['field']['normsValueId']=$orderReturnRef['data']['normsValueId'];

			//退货->6已退货已完成，换货->4已生成换货新订单
			$type = $orderReturnRef['data']['type'];
			$status = $type == 1 ? 6 : 4;

			//退货
			if ($type == 1) {
				$param_put = array(
					'id' => $id, 
					'type' => $type, 
					'customerId' => $orderReturnRef['data']['customerId'],
					'totalMoeny' => $orderReturnRef['data']['totalMoeny'],
					'goodsId' => $orderReturnRef['data']['goodsId'],
					'normsValueId' => $orderReturnRef['data']['normsValueId'],
					'returnGoodsNum' => $orderReturnRef['data']['returnGoodsNum'],
					'orderId' =>  $orderReturnRef['data']['orderId'],
					'ordersNo' => $ordersNo
				);
				$this->updateOrderReturn($param_put);
				$msg = '退货成功';
			}else{ //换货
				$param_put = array(
					'goodsId' =>  $orderReturnRef['data']['goodsId'],
					'newOrderNormsValueId' => $newOrderNormsValueId,
					'customerId' =>  $orderReturnRef['data']['customerId'],
					'returnGoodsNum' =>  $orderReturnRef['data']['returnGoodsNum'],
					'emsNo' => $emsNo,
					'emsName' => $emsName,
					'emsId' => $emsId,
					'normsValueId' =>  $orderReturnRef['data']['normsValueId'],
					'orderId' =>  $orderReturnRef['data']['orderId']
				);
				$newOrderId = $this->updateOrderReplace($param_put);
				$param_up['field']['newOrderId'] = $newOrderId;
				$msg = '换货成功';
			}

			//订单流程表
			$param_in = array(
				'returnRefId' => $id, 
				'status' => $status, 
				'createTime' => date('Y-m-d H:i:s'), 
				'createUser' => $this->sess->get('id'),
				'userType' => 2
			);
			$resp = $this->model->write('orders_return','insertReturnFlow', $param_in);

			//修改订单状态订单表
			$param_up = array(
				'where' => array(
					'where' => array(
						'id' => $id, 
					)
				),
				'field' => array(
					'status' => $status,
					'newOrderId'=>$newOrderId
				)
			);
			$resp = $this->model->write('orders_return','updateOrderReturnRef', $param_up);
			$data = array('error' => false, 'msg' => $msg);
		}

    echo json_encode($data);
    exit;
	}

	//退货返还钱包
	public function updateOrderReturn($param){
		$param_in = array(
			'customerId' => $param['customerId'], 
			'inCome' => $param['totalMoeny'], 
			'emsNo' => $this->getMillisecond().$this->randomNumbers(4), 
			'fromType' => 2,
			'commet' => '来源订单号'.$param['ordersNo'].'的退款',
			'createDate' => date('Y-m-d H:i:s')
		);
		$resp = $this->model->write('orders_return','insertIncomeExpendRecord', $param_in);

		$param_in = array(
			'customerId' => $param['customerId'], 
			'remainingMoney' => $param['totalMoeny'], 
			'availableMoney' => $param['totalMoeny'], 
		);
		$resp = $this->model->write('orders_return','updateWallet', $param_in);

		//修改商品库存数量
		$param_gnvs = array('goodsId' => $param['goodsId'], 'goodsNormsValueId' => $param['normsValueId']);
		$GoodsNormsValueStock = $this->model->read('orders_return','getNormsValueStockByMap', $param_gnvs);

		$param_put= array('stockId' => $GoodsNormsValueStock['data']['stockId']);
		$goodsNormsStock = $this->model->read('orders_return','selectGoodsNormsStock', $param_put);

		$param_in = array(
			'where' => array(
				'where' => array(
					'id' => $goodsNormsStock['data']['id']
				) 
			),
			'field' => array(
				'stockNum' => $goodsNormsStock['data']['stockNum'] + $param['returnGoodsNum']
			)
		);
		$resp = $this->model->write('orders_return','updateGoodsNormsStock', $param_in);
		
	}

	//换货处理、并生成新订单
	public function updateOrderReplace($param){
		//获取所选新商品规格信息
		$param_gnvs = array('goodsId' => $param['goodsId'], 'goodsNormsValueId' => $param['newOrderNormsValueId']);
		$GoodsNormsValueStock = $this->model->read('orders_return','getNormsValueStockByMap', $param_gnvs);

		//生成新商品订单
		$param_in = array(
			'ordersNo' => $this->getMillisecond().$this->randomNumbers(4), 
			'status' => 3, 
			'customerId' => $param['customerId'], 
			'totalAmount' => $param['returnGoodsNum'] * $GoodsNormsValueStock['data']['preferentialPrice'],
			'sumMoney' => $param['returnGoodsNum'] * $GoodsNormsValueStock['data']['preferentialPrice'],
			'returnLabel' => 1,
			'emsNo' => $param['emsNo'],
			'emsName' => $param['emsName'],
			'emsId' => $param['emsId'],
			'sendDate' => date('Y-m-d H:i:s'), 
			'createDate'  => date('Y-m-d H:i:s'), 
		);
		$ordersList = $this->model->write('orders_return','insertOrdersList', $param_in);
		$orderId = $ordersList['data']['id'];

		//订单下商品信息
		$param_in = array(
			'ordersId' => $orderId, 
			'goodsId' => $param['goodsId'], 
			'normsValueId' => $param['newOrderNormsValueId'], 
			'buyNum' => $param['returnGoodsNum'],
			'sellPrice' => $GoodsNormsValueStock['data']['originalPrice'],
			'transactionPrice' => $GoodsNormsValueStock['data']['preferentialPrice'],
			'goodsFrom' => $GoodsNormsValueStock['data']['sendAddress'],
		);
		$resp = $this->model->write('orders_return','insertOrdersGoodsInfo', $param_in);

		//订单收货地址
		$param_put = array('ordersId' => $param['orderId']);
		$receivingAddress = $this->model->read('orders_return','queryReceivingAddressByOrdersId', $param_put);

		$param_in = $receivingAddress['data'];
		$param_in['ordersId'] = $orderId;
		$param_in['batchCode'] = $this->generateBatchCode();
		unset($param_in['id']);
		$resp = $this->model->write('orders_return','insertOrdersReceivingAddress', $param_in);

		//修改商品规格库存信息
		//原商品规格+退换货数量
		$param_gnvs = array('goodsId' => $param['goodsId'], 'goodsNormsValueId' => $param['normsValueId']);
		$orgGoodsNormsValueStock = $this->model->read('orders_return','getNormsValueStockByMap', $param_gnvs);
		$stockId = $orgGoodsNormsValueStock['data']['stockId'];
		$param_put= array('stockId' => $stockId);
		$goodsNormsStock = $this->model->read('orders_return','selectGoodsNormsStock', $param_put);
		$param_in = array(
			'where' => array(
				'where' => array(
					'id' => $stockId
				)
			),
			'field' => array(
				'stockNum' => $goodsNormsStock['data']['stockNum'] + $param['returnGoodsNum']
			)
		);
		$resp = $this->model->write('orders_return','updateGoodsNormsStock', $param_in);

		//新选择的商品规格-退换货数量
		$param_gnvs = array('goodsId' => $param['goodsId'], 'goodsNormsValueId' => $param['newOrderNormsValueId']);
		$orgGoodsNormsValueStock = $this->model->read('orders_return','getNormsValueStockByMap', $param_gnvs);
		$stockId = $orgGoodsNormsValueStock['data']['stockId'];
		$param_put= array('stockId' => $stockId);
		$goodsNormsStock = $this->model->read('orders_return','selectGoodsNormsStock', $param_put);
		$param_in = array(
			'where' => array(
				'where' => array(
					'id' => $stockId
				)
			),
			'field' => array(
				'stockNum' => $goodsNormsStock['data']['stockNum'] - $param['returnGoodsNum']
			)
		);
		$resp = $this->model->write('orders_return','updateGoodsNormsStock', $param_in);
		//订单流程表
		$param_in = array(
			'ordersId' => $orderId, 
			'actionUser' => $this->sess->get('id'), 
			'status' => 3, 
			'actionUserType' => 1
		);
		$resp = $this->model->write('orders_return','insertOrdersFlow', $param_in);

		return $orderId;
	}

	//订单收货地址批次(时间YYMMDD+6位随机数)
	public function generateBatchCode(){
		$batchCode = '';
		$charArray = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X','Y', 'Z'];
		//shuffle 将数组顺序随即打乱 
		shuffle($charArray); 
		$beforeTwoPlace = array_slice($charArray, 0, 2); 
		$batchCode = implode('', $beforeTwoPlace).date('Ymd').$this->randomNumbers(6);
		return $batchCode;
	}

}