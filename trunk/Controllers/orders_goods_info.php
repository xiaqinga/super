<?php

/**
 * 金商城订单
 *
 * @author wsbnet@qq.com
 * @since   2016-08-23
 * @version 1.0
 */
 
class orders_goods_info extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
		$this->lib('Curl','Curl_api');
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
		$realName = $this->queryVar('realName');
		$payMode = $this->queryVar('payMode');
		$status = $this->queryVar('status');
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
		if(!empty($realName)){
			$key_type = 'realName';
			$key = $realName;
			$param['realName'] = $realName;
		}
		if(!empty($payMode)){
			$key_type = 'payMode';
			$key = $payMode;
			$param['payMode'] = $payMode;
		}
		if(!empty($status)){
			$param['status'] = $status;
		}
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}
		$param['mallType'] =1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('orders_goods_info','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;


		$payList = array(
			'weChatPay' => '微支付',
			'sayimoPay' => '钱包支付'
		);

		$data  = array(
			'providerList' => $this->getProviderList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			//传递查询框的值
			'key_type' => $key_type,
			'key' => $key,
			'status' => $status,
			//传递下拉菜单
			'statusList' => $this->public_dict['orderStatusList'],
			'accouttype' => $accouttype,
			'payList' => $payList,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'orders_goods_info/index');
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
		$realName = $this->queryVar('realName');
		$payMode = $this->queryVar('payMode');
		$status = $this->queryVar('status');
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
		if(!empty($realName)){
			$key_type = 'realName';
			$key = $realName;
			$param['realName'] = $realName;
		}
		if(!empty($payMode)){
			$key_type = 'payMode';
			$key = $payMode;
			$param['payMode'] = $payMode;
		}
		if(!empty($status)){
			$param['status'] = $status;
		}
		
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}
		$param['mallType'] =1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('orders_goods_info','getlist',$param);


		$payList = array(
			'weChatPay' => '微支付',
			'sayimoPay' => '钱包支付'
		);

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			//传递查询框的值
			'key_type' => $key_type,
			'key' => $key,
			'status' => $status,
			//传递下拉菜单
			'statusList' => $this->public_dict['orderStatusList'],
			'payList' => $payList,
			'ref' => $this->queryVar('ref' , APP_URL . 'orders_goods_info/index?'.$key_type.'='.$key.'&page='.$page.'&status='.$status)
		);
		$this->setActionLog('orders_goods_info','QUERY','查询金商城订单列表');
		$this->view($data,'orders_goods_info/ajaxindex');
	}

	public function info()
	{
		//查询
		$id = $this->queryVar('id');
		$status = $this->queryVar('status');
		$param['id'] = $id;
		$info = $this->model->read('orders_goods_info','getinfo', $param);
		$orderGoods = $this->model->read('orders_goods_info','getOrderGoodsIdByOrdersId', $param);

		$ems_list = $this->model->read('ems_list','getlist');

		$payList = array(
			'weChatPay' => '微支付',
			'sayimoPay' => '钱包支付'
		);

		$data  = array(
			//传递下拉菜单
			'payList' => $payList,
			'ems' => $ems_list['status'] ? $ems_list['data']['list'] : array(),
			'attr' => $info['status'] ? $info['data'] : array(),
			'goods' => $orderGoods['data']['list'],
			'id' => $id,
			'status'=>$status,
			'ref' => $this->queryVar('ref', APP_URL . 'orders_goods_info/index')
		);
		$this->setActionLog('orders_goods_info','QUERY','查询金商城订单详情');
		$this->view($data,'orders_goods_info/info');
	}

	public function confirm()
	{
		//查询
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$info = $this->model->read('orders_goods_info','getinfo', $param);
		$orderGoods = $this->model->read('orders_goods_info','getOrderGoodsIdByOrdersId', $param);

		$ems_list = $this->model->read('ems_list','getlist');

		$payList = array(
			'weChatPay' => '微支付',
			'sayimoPay' => '钱包支付'
		);

		$data  = array(
			//传递下拉菜单
			'payList' => $payList,
			'ems' => $ems_list['status'] ? $ems_list['data']['list'] : array(),
			'attr' => $info['status'] ? $info['data'] : array(),
			'goods' => $orderGoods['data']['list'],
			'id' => $id,
			'ref' => APP_URL . 'orders_goods_info/index?status=2',
		);
		
		$this->view($data,'orders_goods_info/confirm');
	}

	public function confirmAll()
	{
		//查询
		$ids = $this->queryVar('ids');
		$param['ids'] = $ids;
		$allInfo = $this->model->read('orders_goods_info','getAllinfo', $param);
		if($allInfo['status']){
			foreach ($allInfo['data']['list'] as $key => $value) {
				$param_inner['id'] = $value['id'];
				$orderGoods = $this->model->read('orders_goods_info','getOrderGoodsIdByOrdersId', $param_inner);
				if($orderGoods['status'] && count($orderGoods['data']['list'])>0){
					$allInfo['data']['list'][$key]['orderGoods'] = $orderGoods['data']['list'];
				}
			}
		}
		//快递公司
		$ems_list = $this->model->read('ems_list','getlist');

		$payList = array(
			'weChatPay' => '微支付',
			'sayimoPay' => '钱包支付'
		);
		$data  = array(
			//传递下拉菜单
			'payList' => $payList,
			'ems' => $ems_list['status'] ? $ems_list['data']['list'] : array(),
			'list' => $allInfo['status'] ? $allInfo['data']['list'] : array(),
			'id' => $id,
			'ref' => APP_URL . 'orders_goods_info/index?status=2',
		);

	
		$this->view($data,'orders_goods_info/confirmall');
	}

	public function confirmSendGoods()
	{
		//查询
		$id = $this->queryVar('id');
		$emsName = $this->queryVar('emsName');
		$emsNo = $this->queryVar('emsNo');
		$emsId = $this->queryVar('emsId');
		$leaveWords = $this->queryVar('leaveWords');
		if(!empty($emsName)){
			$param['emsName'] = $emsName;
		}
		if(!empty($emsNo)){
			$param['emsNo'] = $emsNo;
		}
		if(!empty($emsId)){
			$param['emsId'] = $emsId;
		}
		if(!empty($leaveWords)){
			$param['leaveWords'] = $leaveWords;
		}
		if(!empty($id)){
			$param['id'] = $id;
		}
		$param['user'] = $this->sess->get('id');


			$resp = $this->model->write('orders_goods_info','confirmSendGoods', $param);
			if($resp['status']){
				$this->setUmengMsg($this->queryVar('customerId'));
				$data = array('msg' => true);
			}else{
				$data = array('msg' => false);

		}
	    echo json_encode($data);
	    exit;
	}

	public function confirmAllSendGoods()
	{
		//查询
		$sends = $this->queryVar('sends');
		
		$sends = json_decode($sends,true);

		if(count($sends)>0){
			foreach ($sends as $key => $value){
				$value['user']= $this->sess->get('id');
				$resp = $this->model->write('orders_goods_info','confirmSendGoods', $value);
				if($resp['status']) {
					$result=$this->setUmengMsg($value['customerId']);
				
				}
			}
		}


		if($resp['status']){
			$data = array('msg' => true);
		}else{
			$data = array('msg' => false);
		}
    echo json_encode($data);
    exit;
	}

	//导出商品订单
  function exportOrder(){

		$param = array();
		//右边查询
		$status = $this->queryVar('status');
		$providerId = $this->queryVar('providerId');
		$startDate = $this->queryVar('chkStartDate');
		$endDate = $this->queryVar('chkEndDate');
	    $ids = $this->queryVar('ids');


		if(!empty($ids)){
			  $param['ids'] = $ids;
		}
		if(!empty($status)){
			$param['status'] = $status;
		}
		if(!empty($providerId)){
			$param['providerId'] = $providerId;
		}
		if(!empty($startDate) || !empty($endDate)){
			$param['startDate'] = $startDate;
			$param['endDate'] = $endDate;
		}

		//左边查询
		$ordersNo = $this->queryVar('ordersNo');
		$goodsName = $this->queryVar('goodsName');
		$providerName = $this->queryVar('providerName');
		$memberAlias = $this->queryVar('memberAlias');
		$realName = $this->queryVar('realName');
		$payMode = $this->queryVar('payMode');
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
		if(!empty($realName)){
			$key_type = 'realName';
			$key = $realName;
			$param['realName'] = $realName;
		}
		if(!empty($payMode)){
			$key_type = 'payMode';
			$key = $payMode;
			$param['payMode'] = $payMode;
		}
		

		$param['mallType'] =1;
		$resp = $this->model->read('orders_goods_info','getlist',$param);
	 
		if(!$resp['status']){
			echo "还没有相关订单！";
			return false;
		}

    $sep = "\t"; 
    switch ($status) {
    	case 2:
    		$savename = '待发货订单列表'.date("YmjHis");  
    		break;

    	case 3:
    		$savename = '已发货订单列表'.date("YmjHis");  
    		break;

    	case 7:
    		$savename = '完成的订单列表'.date("YmjHis");  
    		break;
    	
    	default:
    		$savename = '全部订单列表'.date("YmjHis"); 
    		break;
    }
    $file_type = "vnd.ms-excel";  
    $file_ending = "xls";  
    ob_end_clean();
    header("Content-Type: application/$file_type;charset=gbk");  
    header("Content-Disposition: attachment; filename=\"$savename.$file_ending\"");  
    header("Pragma: no-cache");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		 xmlns:x="urn:schemas-microsoft-com:office:excel"
		 xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		 <meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		 <meta http-equiv=Content-Type content="text/html; charset=gb2312">
		 <!--[if gte mso 9]><xml>
		 <x:ExcelWorkbook>
		 <x:ExcelWorksheets>
		   <x:ExcelWorksheet>
		   <x:Name></x:Name>
		   <x:WorksheetOptions>
		     <x:DisplayGridlines/>
		   </x:WorksheetOptions>
		   </x:ExcelWorksheet>
		 </x:ExcelWorksheets>
		 </x:ExcelWorkbook>
		 </xml><![endif]-->

		</head>';
		echo "<table>";



		$param['status'] = 2;

    $th_td[0] = "<td>订单号</td>";
    $th_td[1] = "<td>供应商名称</td>";
    $th_td[2] = "<td>供应商联系人</td>";
    $th_td[3] = "<td>供应商联系方式</td>";
    $th_td[4] = "<td>商品名称</td>";
    $th_td[5] = "<td>规格</td>";
    $th_td[6] = "<td>数量</td>";
    $th_td[7] = "<td>单价</td>";
    $th_td[8] = "<td>收货人姓名</td>";
    $th_td[9] = "<td>收货人联系方式</td>";
    $th_td[10] = "<td>收货地址</td>";
    $th_td[11] = "<td>留言</td>";
    $th_td[12] = "<td>实收</td>";
    $th_td[13] = "<td>支付时间</td>";

		echo "<tr>";
    foreach ($th_td as $key => $value) {
       echo iconv('utf-8', 'gbk', $value).$sep;
    }
    echo "</tr>";

    foreach ($resp['data']['list'] as $key => $value) {
    		$normsNameIdArr = array();
    		if(!$value['normsValueId']){
					continue;
				}
				$param_u = array('id' => $value['normsValueId'] );
				$resp_u = $this->model->read('goods_norms_name','getNormsNameRefValue',$param_u);

				if($resp_u['status']){
					$normsValueIds = $resp_u['data']['normsValueIds'];
				}

    		if(strpos($normsValueIds,',')>-1){
    			$normsNameIdArr = explode(",", $normsValueIds);
    		}else{
    			$normsNameIdArr[] = $normsValueIds;
    		}
				$normsValue = array();
				foreach ($normsNameIdArr as $k => $v) {
					if($v>0){
						$param_value = array('id' => abs($v));
						$resp_value = $this->model->read('goods_norms_name','getNormsNameValue',$param_value);
						($resp_value['status']) ? $normsValue [] = $resp_value['data']['attr']['normsValue'] : null;
					}elseif($v<0){
						$param_value =  array('id' => abs($v) );
						$resp_value = $this->model->read('goods_norms_name','getNormsAddValue',$param_value);
						($resp_value['status']) ? $normsValue [] = $resp_value['data']['normsValue'] : null;
					}
				}
				$linkman = ($value['linkman'])?$value['linkman']:$value['corporate'];
				$linkInfo = ($value['linkInfo'])?$value['linkInfo']:$value['lockPhone'];
        $head_td[0] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['ordersNo']."</td>";
        $head_td[1] = "<td>".$value['providerName']."</td>";
        $head_td[2] = "<td>".$linkman."</td>";
        $head_td[3] = "<td>".$linkInfo."</td>";
        $head_td[4] = "<td>".$value['goodsName']."</td>";
        $head_td[5] = "<td>".implode(',', $normsValue)."</td>";
        $head_td[6] = "<td>".$value['buyNum']."</td>";
        $head_td[7] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".number_format($value['unitPrice'], 2)."</td>";
        $head_td[8] = "<td>".$value['receivePeople']."</td>";
        $head_td[9] = "<td>".$value['receivePeopleTelePhone']."</td>";
        $head_td[10] = "<td>".$value['allAddress']."</td>";
        $head_td[11] = "<td>".$value['leaveWords']."</td>";
        $head_td[12] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['shouldPay']."</td>";
        $head_td[13] = "<td style=\"vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss\">".$value['payDate']."</td>";
        echo "<tr>";
        foreach ($head_td as $key_ht => $value_ht) {
           echo iconv('utf-8', 'gbk', $value_ht).$sep;
        }
        echo "</tr>";
    }
    echo "</table>";
    $this->setActionLog('orders_goods_info','QUERY','导出金商城订单');
    return (true);  
  }

	public function getProviderList(){
		$param['field']='id,providerName';
		// $param['providerType'] = 1;
		$resp = $this->model->read('base_enterprise_info','getItems',$param);
		$classList[0] = "请选择";
		foreach ($resp['data'] as $key => $value) {
			$classList[$value['id']] = $value['providerName'];
		}
		return $classList;
	}

	//确认退款
	public function refund(){
		$ordersId = $this->queryVar('ordersId');
		$url = SCHOOLAPI."/orders/sayimoreimburse?ordersId=".$ordersId;
		$res = $this->Curl_api->https_request($url);
	}

	public function confirmChangeInfo(){
		//查询
		$id = $this->queryVar('id');
		$emsName = $this->queryVar('emsName');
		$emsNo = $this->queryVar('emsNo');
		$emsId = $this->queryVar('emsId');
		$leaveWords = $this->queryVar('leaveWords');
		if(!empty($emsName)){
			$param['emsName'] = $emsName;
		}
		if(!empty($emsNo)){
			$param['emsNo'] = $emsNo;
		}
		if(!empty($emsId)){
			$param['emsId'] = $emsId;
		}
		if(!empty($leaveWords)){
			$param['leaveWords'] = $leaveWords;
		}
		if(!empty($id)){
			$param['id'] = $id;
		}
		$param['user'] = $this->sess->get('id');
		$resp = $this->model->write('orders_goods_info','updateChangeInfo', $param);
		if($resp['status']){
			$data = array('msg' => true);
		}else{
			$data = array('msg' => false);
		}
	    echo json_encode($data);
	    exit;
	}


  

}