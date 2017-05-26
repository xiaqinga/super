<?php

/**
 * 会员业绩管理
 *
 * @author  janhve@163.com
 * @since   2016.08.18
 * @version 1.0
 */
 
class customerperformance extends common {
		
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
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerperformance','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'accout' => $accout,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('customerperformance','QUERY','查看会员业绩统计');
		$this->view($data,'customerperformance/index');
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
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('customerperformance','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'accout' => $accout,
			'ref' => $this->queryVar('ref' , APP_URL . 'customerperformance/index?accout='.$accout.'&page='.$page)
		);
		$this->view($data,'customerperformance/ajaxindex');
	}
	
}