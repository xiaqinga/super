<?php

/**
 * 团队公益金
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class member_customer extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}
	
	public function welfare()
	{
		$this->lib('Pagination','page');

		//每页记录数
		
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$gameId = $this->queryVar('gameId');
		//查询
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if(!empty($startDate)){
			$param['startDate'] = $startDate;
		}
		if(!empty($endDate)){
			$param['endDate'] = $endDate;
		}
		if($gameId){
			$param['gameId'] = $gameId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('member_customer','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' =>$key_type,
			'key' =>$key,
			'startDate' =>$startDate,
			'endDate' =>$endDate,
			'gameId' =>$gameId,
			'ref' => $this->func->curr_url()
		);


		$this->view($data,'member_customer/welfare');

	}

	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$gameId = $this->queryVar('gameId');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if(!empty($startDate)){
			$param['startDate'] = $startDate;
		}
		if(!empty($endDate)){
			$param['endDate'] = $endDate;
		}
		if($gameId){
			$param['gameId'] = $gameId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('member_customer','getlist',$param);
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' =>$key_type,
			'key' =>$key,
			'startDate' =>$startDate,
			'endDate' =>$endDate,
			'gameId' =>$gameId,
			'ref' => $this->queryVar('ref' , APP_URL . 'member_customer/ajaxIndex?key_type='.$key_type.'&key='.$key.'&startDate='.$startDate.'&endDate='.$startDate.'&page='.$page)
		);

		
		$this->view($data,'member_customer/ajaxindex');
	}
	
	public function getClassList(){
		$resp = $this->model->read('member_customer','getlist');
		foreach ($resp['data']['list'] as $key => $value) {
			$classList[$value['id']] = $value['teamName'];
		}
		
	}

}