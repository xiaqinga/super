<?php

/**
 * 首页
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class index extends common {
		
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
		$data['id'] = $this->sess->get('id');
		$data['name'] = $this->sess->get('name');
		$data['roleId'] = $this->sess->get('roleId');
		$data['accouttype'] = $this->sess->get('accouttype');
		$data['topmenulist'] = $this->getTopMenu();
		$this->view($data,'index/index');
	}
	
	public function home()
	{
		$sellAllTotalResp = $this->model->read('home','getSellAllTotal',$param);
		$sellAllTotal = ($sellAllTotalResp['status'])?$sellAllTotalResp['data']['list']['sellTotalMoney']:'0.00';

		$supplierAllTotalResp = $this->model->read('home','getSupplierTotal',$param);
		$supplierAllTotal = ($supplierAllTotalResp['status'])?$supplierAllTotalResp['data']['list']['supplierTotalMoney']:'0.00';

		$businessAllTotalResp = $this->model->read('home','getBusinessTotal',$param);
		$businessAllTotal = ($businessAllTotalResp['status'])?$businessAllTotalResp['data']['list']['businessTotalMoney']:'0.00';

		$brokerageAllTotalResp = $this->model->read('home','getBrokerageAllTotal',$param);
		$brokerageAllTotal = ($brokerageAllTotalResp['status'])?$brokerageAllTotalResp['data']['list']['sumBrokerage']:'0.00';
		$brokerageAllTotal = $sellAllTotal-$brokerageAllTotal;
		$saleAllTotalResp = $this->model->read('home','getSaleAllTotalResp');
		$saleAllTotal = ($saleAllTotalResp['status'])?$saleAllTotalResp['data']['list']['sumSaleGoods']:'0';
		$nowYear = date('Y');
		// $providerId = $this->queryVar('providerId');
		$year = $this->queryVar('year', $nowYear);
		// $param['providerId'] = $providerId;
		$param['year'] = $year;
		$sellTotalMonthResp = $this->model->read('home','getSellTotalMonth',$param);
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
		$supplierTotalMonthResp = $this->model->read('home','getBrokerageTotalMonth',$param);
		$supplierTotalMonth = '';
		if($supplierTotalMonthResp['status']){
			$supplierTotalMonthList = array();
			foreach ($supplierTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$supplierTotalMonthList[$ptval['month']] = $ptval['sumBrokerage'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($supplierTotalMonthList[$i])){
					if(empty($supplierTotalMonth)){
						$supplierTotalMonth .= $supplierTotalMonthList[$i];
					}else{
						$supplierTotalMonth .= ','.$supplierTotalMonthList[$i];
					}
				}else{
					if($supplierTotalMonth == ''){
						$supplierTotalMonth .= '0';
					}else{
						$supplierTotalMonth .= ',0';
					}
				}
			}
		}else{
			$supplierTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$businessTotalMonthResp = $this->model->read('home','getBusinessTotalMonth',$param);
		$businessTotalMonth = '';
		if($businessTotalMonthResp['status']){
			$businessTotalMonthList = array();
			foreach ($businessTotalMonthResp['data']['list'] as $ptkey => $ptval) {
				$businessTotalMonthList[$ptval['month']] = $ptval['sumBrokerage'];
			}
			for ($i=1; $i < 13; $i++) { 
				if(isset($businessTotalMonthList[$i])){
					if(empty($businessTotalMonth)){
						$businessTotalMonth .= $businessTotalMonthList[$i];
					}else{
						$businessTotalMonth .= ','.$businessTotalMonthList[$i];
					}
				}else{
					if($businessTotalMonth == ''){
						$businessTotalMonth .= '0';
					}else{
						$businessTotalMonth .= ',0';
					}
				}
			}
		}else{
			$businessTotalMonth = '0,0,0,0,0,0,0,0,0,0,0,0';
		}
		$data['sellAllTotal'] = $sellAllTotal;
		$data['supplierAllTotal'] = $supplierAllTotal;
		$data['businessAllTotal'] = $businessAllTotal;
		$data['brokerageAllTotal'] = $brokerageAllTotal;
		$data['sellTotalMonthMonth'] = $sellTotalMonthMonth;
		$data['supplierTotalMonth'] = $supplierTotalMonth;
		$data['businessTotalMonth'] = $businessTotalMonth;
		$data['saleAllTotal'] = $saleAllTotal;
		$data['year'] = $year;
		$data['ref'] = $this->func->curr_url();
		// $data  = array(
		// 	'sellAllTotal' => $sellAllTotal,
		// 	'brokerageAllTotal' => $brokerageAllTotal,
		// 	'sellTotalMonthMonth' => $sellTotalMonthMonth,
		// 	'brokerageTotalMonth' => $brokerageTotalMonth,
		// 	'saleAllTotal' => $saleAllTotal,
		// 	'providerId' => $providerId,
		// 	'year' => $year,
		// 	'ref' => $this->func->curr_url()
		// );
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


		$orderNoSendCount = $this->model->read('home','getCountOrderNoSend');
		$data['orderNoSendCount'] = ($orderNoSendCount['status'])?$orderNoSendCount['data']['total']:0;
		$orderRefundCount = $this->model->read('home','getCountOrderRefund');
		$data['orderRefundCount'] = ($orderRefundCount['status'])?$orderRefundCount['data']['total']:0;
		$orderCompleteCount = $this->model->read('home','getCountOrderComplete');
		$data['orderCompleteCount'] = ($orderCompleteCount['status'])?$orderCompleteCount['data']['total']:0;
		$orderNoSendCountSilver = $this->model->read('home','getCountOrderNoSendSilver');
		$data['orderNoSendCountSilver'] = ($orderNoSendCountSilver['status'])?$orderNoSendCountSilver['data']['total']:0;
		$orderCompleteCountSilver = $this->model->read('home','getCountOrderCompleteSilver');
		$data['orderCompleteCountSilver'] = ($orderCompleteCountSilver['status'])?$orderCompleteCountSilver['data']['total']:0;
		$auditSupplier = $this->model->read('home','getAuditSupplier');
		$data['auditSupplier'] = ($auditSupplier['status'])?$auditSupplier['data']['total']:0;
		$auditGoods = $this->model->read('home','getAuditGoods');
		$data['auditGoods'] = ($auditGoods['status'])?$auditGoods['data']['total']:0;
		$auditGoodsSilver = $this->model->read('home','getAuditGoodsSilver');
		$data['auditGoodsSilver'] = ($auditGoodsSilver['status'])?$auditGoodsSilver['data']['total']:0;
		$auditBusiness = $this->model->read('home','getAuditBusiness');
		$data['auditBusiness'] = ($auditBusiness['status'])?$auditBusiness['data']['total']:0;

		
		
		$this->setActionLog('index','QUERY','查看首页');
		$auth_check_permissions = $this->auth_check_permissions('index/home');
		if($auth_check_permissions){
			$this->view($data,'index/home');
		}else{
			$this->view($data,'index/welcome');
		}
	}
	
	public function editpassword(){
		$this->view('index/editpassword');
	}
	
	public function checkexistpass()
	{
		$param['id'] = $this->sess->get('id');
		$passWord = $this->queryVar('value');
		$accouttype = $this->sess->get('accouttype');
		// if($accouttype==1){
			$param['passWord'] = md5($passWord);
			$resp = $this->model->read('user','getlist',$param);
		// }else{
		// 	$param['providerPassWord'] = md5($passWord);
		// 	$resp = $this->model->read('provider','getProviderToPasswrod',$param);
		// }
		$this->jsonout($resp['status'],array('msg'=>($resp['status']) ? '原密码正确' : '原密码错误'));
	}
	public function setPassword()
	{
		$param['id'] = $this->sess->get('id');
		$passWord = $this->queryVar('newpassword');
		$ref = APP_URL;
		$accouttype = $this->sess->get('accouttype');
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		// if($accouttype==1){
			$param['passWord'] = md5($passWord);
			$resp = $this->model->write('user','update', $param);
			$this->setActionLog('user','UPDATE','修改系统用户密码');
		// }else{
		// 	$param['providerPassWord'] = md5($passWord);
		// 	$resp = $this->model->write('provider','update', $param);
		// 	$this->setActionLog('user','UPDATE','修改企业用户密码');
		// }
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '用户密码修改成功' : '用户密码修改失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 根据url判断用户是否拥有权限
	 *
	 * @param string $uri
	 * @return bool
	 */
	function auth_check_permissions($uri='',$virtual=false)
	{
		$roleMenuItem  = array();
		$roleRightItem = array();
		$roleId = $this->sess->get('roleId');
        $resp = $this->model->read('role','getlist',array('id'=>$roleId));
		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options) > 0)
		{
			if (isset($options['menu']))
			{
				foreach ($options['menu'] as $menu)
				{
					if (!empty($menu['url']))
					{
						$menu_val = strstr($menu['url'], '/');
						if (empty($menu_val))
						{
							$menu['url'] = $menu['url'] . '/index';
						}
						$roleMenuItem[] = $menu['url'];
					}
				}
			}
			if (isset($options['permissions']))
			{
				foreach ($options['permissions'] as $permissions)
				{
					$permissions['action'] = explode(',', $permissions['action']);
					foreach ($permissions['action'] as $action)
					{
						$roleRightItem[] = $permissions['controller'] . '/' . $action;
					}
				}
			}
		}
		$menuItems = array_merge($roleMenuItem, $roleRightItem);
		$menuItems = array_unique($menuItems);
        $uri = str_replace(APP_URL,'',strtolower($uri));
		if ($roleId == 1 || in_array($uri, $menuItems))
		{
			$ret = true;
		}
		else
		{
			$ret = false;
		}

		return $ret;
	}
}