<?php

/**
 * 会员订单管理
 *
 * @author  janhve@163.com
 * @since   2016.08.18
 * @version 1.0
 */
 
class customerorders extends common {
		
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
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'accout' => $accout,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('customerorders','QUERY','查看金商城订单统计');
		$this->view($data,'customerorders/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'accout' => $accout,
			'ref' => $this->queryVar('ref' , APP_URL . 'customerorders/index?accout='.$accout.'&page='.$page)
		);
		$this->view($data,'customerorders/ajaxindex');
	}
	
	public function indexsilver()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 2;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'accout' => $accout,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('customerorders','QUERY','查看银商城订单统计');
		$this->view($data,'customerorders/indexsilver');
	}
	
	public function ajaxIndexsilver(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 2;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'accout' => $accout,
			'ref' => $this->queryVar('ref' , APP_URL . 'customerorders/indexsilver?accout='.$accout.'&page='.$page)
		);
		$this->view($data,'customerorders/ajaxindexsilver');
	}

	public function indexbusiness()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 4;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlistbusiness',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'accout' => $accout,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('customerorders','QUERY','查看商企订单统计');
		$this->view($data,'customerorders/indexbusiness');
	}
	
	public function ajaxIndexbusiness(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$accout = $this->queryVar('accout');
		$data['accout'] = $accout;
		$param = array();
		if(!empty($accout)){
			$param['accout'] = $accout;
		}
		$param['mallType'] = 4;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerorders','getlistbusiness',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'accout' => $accout,
			'ref' => $this->queryVar('ref' , APP_URL . 'customerorders/indexbusiness?accout='.$accout.'&page='.$page)
		);
		$this->view($data,'customerorders/ajaxindexbusiness');
	}
}