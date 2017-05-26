<?php

/**
 * 会员管理
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class customer_list extends common {
		
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
		$searchname = $this->queryVar('searchname');
		$accout = $this->queryVar('accout');
		$customerType = $this->queryVar('customerType');
		$alias = $this->queryVar('alias');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$providerName = $this->queryVar('providerName');
		$mobilePhone = $this->queryVar('mobilePhone');
		$param = array();
		if($searchname == 'mobilePhone'){
			if(!empty($mobilePhone)){
				$param['mobilePhone'] = $mobilePhone;
			}
		}
		if($searchname == 'providerName'){
			if(!empty($providerName)){
				$param['providerName'] = $providerName;
			}
		}
		if($searchname == 'accout'){
			if(!empty($accout)){
				$param['accout'] = $accout;
			}
		}
		if($searchname == 'customerType'){
			if(!empty($customerType)){
				$param['customerType'] = $customerType;
			}
		}
		
		if($searchname == 'alias'){
			if(!empty($alias)){
				$param['alias'] = $alias;
			}
		}
		if($searchname == 'createDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customer_list','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'accout' => $accout,
			'customerType' => $customerType,
			'alias' => $alias,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'providerName' => $providerName,
			'mobilePhone' => $mobilePhone,
			'ref' => $this->func->curr_url()
		);
		$data['searchnamelist'] = array(
			'accout' => '用户账号',
			'customerType' => '会员类型',
			'alias' => '昵称',
			'providerName' => '供应商\联盟商',
			'mobilePhone' => '捆绑手机',
			'createDate' => '加入时间'
		);

		$data['customerTypelist'] =$this->public_dict['customerTypelist'];
		$this->setActionLog('customer_list','QUERY','查看会员列表');
		$this->view($data,'customer_list/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$searchname = $this->queryVar('searchname');
		$accout = $this->queryVar('accout');
		$customerType = $this->queryVar('customerType');
		$isStudent = $this->queryVar('isStudent');
		$alias = $this->queryVar('alias');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$mobilePhone = $this->queryVar('mobilePhone');
		$providerName = $this->queryVar('providerName');
		$param = array();
		if($searchname == 'providerName'){
			if(!empty($providerName)){
				$param['providerName'] = $providerName;
			}
		}
		if($searchname == 'mobilePhone'){
			if(!empty($mobilePhone)){
				$param['mobilePhone'] = $mobilePhone;
			}
		}
		if($searchname == 'accout'){
			if(!empty($accout)){
				$param['accout'] = $accout;
			}
		}
		if($searchname == 'customerType'){
			if(!empty($customerType)){
				$param['customerType'] = $customerType;
			}
		}

		if($searchname == 'alias'){
			if(!empty($alias)){
				$param['alias'] = $alias;
			}
		}
		if($searchname == 'createDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customer_list','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'accout' => $accout,
			'customerType' => $customerType,
			'isStudent' => $isStudent,
			'alias' => $alias,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'mobilePhone' => $mobilePhone,
			'providerName' => $providerName,
			'ref' => $this->queryVar('ref' , APP_URL . 'customer_list/index?searchname='.$searchname.'&page='.$page)
		);
		$this->setActionLog('customer_list','QUERY','查询会员账号列表');
		
		$this->view($data,'customer_list/ajaxindex');
	}
	
	public function info(){
		$param['id'] = $this->queryVar('id');
		$resp = $this->model->read('customer_list','getInfo',$param);
		$data = ($resp['status']) ? $resp['data']['0'] : array();
		// 上级会员帐号

		$data['superioraccount']=$this->model->read('customer_list','getSuperiorAccount',array('parentId'=>$data['parentId']));
		//下级会员总数
		$data['lowertotal']=$this->model->read('customer_list','getTotal',$param);
		//会员收货地址
		$receivingAddress=$this->model->read('customer_list','getReceivingAddress',$param);
		$data['receivingAddress']=($receivingAddress['status']) ? $receivingAddress['data'] : array();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'customer_list/index');
		$this->setActionLog('customer_list','QUERY','查看会员详情');
		$this->view($data,'customer_list/info');
	}
	
	public function junior(){
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$searchname = $this->queryVar('searchname');
		$accout = $this->queryVar('accout');
		$customerType = $this->queryVar('customerType');
		$isStudent = $this->queryVar('isStudent');
		$alias = $this->queryVar('alias');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$param = array();
		if($searchname == 'accout'){
			if(!empty($accout)){
				$param['accout'] = $accout;
			}
		}
		if($searchname == 'customerType'){
			if(!empty($customerType)){
				$param['customerType'] = $customerType;
			}
		}

		if($searchname == 'alias'){
			if(!empty($alias)){
				$param['alias'] = $alias;
			}
		}
		if($searchname == 'createDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['parentId'] = $this->queryVar('id');
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customer_list','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'accout' => $accout,
			'customerType' => $customerType,
			'isStudent' => $isStudent,
			'alias' => $alias,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'id' => $param['parentId'],
			'ref' => $this->func->curr_url()
		);
		$data['searchnamelist'] = array(
			'accout' => '用户账号',
			'customerType' => '会员类型',
			'alias' => '昵称',
			'createDate' => '加入时间'
		);
		$data['customerTypelist'] =$this->public_dict['customerTypelist'];
       
		$this->setActionLog('customer_list','QUERY','查看会员下级会员列表');
		$this->view($data,'customer_list/junior');
	}

	public function ajaxjunior(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$searchname = $this->queryVar('searchname');
		$accout = $this->queryVar('accout');
		$customerType = $this->queryVar('customerType');
		$isStudent = $this->queryVar('isStudent');
		$alias = $this->queryVar('alias');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$param = array();
		if($searchname == 'accout'){
			if(!empty($accout)){
				$param['accout'] = $accout;
			}
		}
		if($searchname == 'customerType'){
			if(!empty($customerType)){
				$param['customerType'] = $customerType;
			}
		}

		if($searchname == 'alias'){
			if(!empty($alias)){
				$param['alias'] = $alias;
			}
		}
		if($searchname == 'createDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['parentId'] = $this->queryVar('id');
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customer_list','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'accout' => $accout,
			'customerType' => $customerType,
			'alias' => $alias,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'awardRule_list'=>$this->public_dict['awardRule_list'],
			'ref' => $this->queryVar('ref' , APP_URL . 'customer_list/index?searchname='.$searchname.'&page='.$page)
		);

		
		$this->view($data,'customer_list/ajaxjunior');
	}
	
    //会员绑定绑定供应商页面
	public function edit(){
	
		$param['id'] = $this->queryVar('id');
		$resp = $this->model->read('customer_list','findOne',$param);
		$data = ($resp['status']) ? $resp['data']['0'] : array();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'customer_list/index');
		$this->setActionLog('customer_list','QUERY','查看会员关联企业信息');
		$this->view($data,'customer_list/edit');
	}
	//修改
	public function save(){
		$param['id'] = $this->queryVar('id');
		$providerRefId= $this->queryVar('providerRefId');
		$awardRule= $this->queryVar('awardRule');
		$supplier_id= $this->queryVar('supplier_id');
		if(!empty($providerRefId)){
			$param['providerRefId']=$providerRefId;
		}
		if(!empty($awardRule)){
			$param['awardRule']=($awardRule==3)?'0':$awardRule;
		}
		$resp=$this->model->write('customer_list','update',$param);

		if($providerRefId&&$supplier_id){
			$unparam=array(
				'id'=>$supplier_id,
			    'customerId'=>$param['id']
			);
			$this->model->write('base_enterprise_info','update',$unparam);
		}
		
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '更改成功' : '更改失败',
			'ref'=> APP_URL . 'customer_list/index',

		));
		
	}

	public function  imageDdownload(){

		$url= $this->queryVar('url');
		if (ob_get_level() !== 0 && @ob_end_clean() === FALSE)
		{
			@ob_clean();
		}
		$url=str_replace('https','http',$url);
		$arr=explode('.',$url);
		$ext=end($arr);
		$name=time().'.'.$ext;
		header ("Content-type: octet/stream");
		header ("Content-disposition: attachment; filename=".$name.";");
		header("Content-Length: ".filesize($url));
		readfile($url);
		exit;
        /*
		if($ext=="jpg" || $ext=="jpeg" ||$ext=="gif" ||$ext == "bmp"){
			$name=time().'.'.$ext;
			$url=str_replace('https','http',$url);
			header('Content-type: image/'.$ext);
			header("Content-Disposition: attachment; filename={$name}");
			@readfile($url);
			exit;
		}else{
			header("location:{$url}");
		}*/

	}
  
    
	
}