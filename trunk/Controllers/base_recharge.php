<?php

/**
 * 钱包管理
 *
 */
 
class base_recharge extends common {
		
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
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){             
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['orderType'] = $this->queryVar('orderType',3);

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'orderType'=>$param['orderType'],
			'ref' => $this->func->curr_url()
		);
    	$this->setActionLog('base_recharge','QUERY','查看充值记录列表');
		$this->view($data,'base_recharge/index');
	}
	
	public function ajaxIndex(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');

		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}

		$param['orderType'] = $this->queryVar('orderType',3);
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'orderType'=>$param['orderType'],
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_recharge/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_recharge/ajaxindex');  
	}

	public function indexrecord()                  
	{
		$this->lib('Pagination','page');     

		//每页记录数
		$pagesize = 10;						
		$page = $this->queryVar('page', 1);  

		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){             
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['fromType'] = "0,1,2,4,5,7";
		$param['exPend']=true;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
    	$this->setActionLog('base_recharge','QUERY','查看消费记录列表');
		$this->view($data,'base_recharge/indexrecord');
	}
	
	public function ajaxIndexrecord(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
	
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['fromType'] = '0,1,2,4,5,7';
		$param['exPend']=true;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'fromTypes'=>$this->public_dict['fromTypes'],
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_recharge/indexrecord?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_recharge/ajaxindexrecord');  
	}

	public function indexdetail()                  
	{
		$this->lib('Pagination','page');     

		//每页记录数
		$pagesize = 10;						
		$page = $this->queryVar('page', 1);  

		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){             
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['fromType'] = "3,4,5,6";
		$param['inCome']=true;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
    	$this->setActionLog('base_recharge','QUERY','查看收入明细列表');
		$this->view($data,'base_recharge/indexdetail');
	}
	
	public function ajaxIndexdetail(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
	
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['fromType'] = '3,4,5,6';
		$param['inCome']=true;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_recharge','getlist',$param);

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'fromTypes'=>$this->public_dict['fromTypes'],
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_recharge/indexdetail?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_recharge/ajaxindexdetail');  
	}





	public function edit(){
		$resp = $this->model->read('base_config','getlist');
		$array = array();
		foreach ($resp['data']['list'] as $key => $value) {
			$array[$value['sysKey']] = array(
				$value['sysKey'] => $value['sysKey'],
				'sysKey' => $value['sysValue']
			);
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_config/edit');

		$data['attr'] = $array;
		// print_r($array);die();
		$this->view($data,'base_config/edit');
	}


	public function save(){
		// array(2) { 
		// 	["sysKey"]=> int(0)
		// 	["sysValue"]=> array(2) 
		// 		{ 
		// 			["status"]=> string(15) 
		// 			"GOLD_MAKER_CASH" 
		// 			["time"]=> string(1) "1" 
		// 		} } 
		// array(2) { 
		// 	["sysKey"]=> string(15) "GOLD_MAKER_CASH" 
		// 	["sysValue"]=> string(1) "1" } 
		$data_config = json_decode($this->queryVar('data_config'),true);
		// var_dump($data_config);die();
		foreach ($data_config as $key => $value) {
			$param['sysKey'] = $value['status'];
			$param['sysValue'] = $value['time'];
			$resp = $this->model->write('base_config','update',$param);
		}
		// $data_config = $this->queryVar('data_config');
		// $param['id'] = $this->queryVar('id');
		// $param['seckillName'] = $this->queryVar('seckillName');
		// $param['activityExpalin'] = $this->queryVar('activityExpalin');
		// $param['goodsRestrictions'] = $this->queryVar('goodsRestrictions');
		$ref = $this->queryVar('ref',APP_URL . 'base_config/edit');
		// $ref = urldecode($ref);
		// $resp = $this->model->write('base_seckill','update', $param);

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '规则信息修改成功' : '规则信息未更改',
			'ref'=> $ref
		));
		
	}

}