<?php

/**
 * 大赛详情表
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_team extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}
	
	public function consumption()
	{
		$this->lib('Pagination','page');

		//每页记录数
		
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$gameId =$this->queryVar('gameId');
		//查询
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if($gameId){
			$param['gameId'] = $gameId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_team','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'gameId' => $gameId,
			'page' => $this->page->page($total,$pagesize),
			'key_type' =>$key_type,
			'key' =>$key,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'base_team/consumption');

	}

	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$gameId =$this->queryVar('gameId');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if($gameId){
			$param['gameId'] = $gameId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
	
		$resp = $this->model->read('base_team','getlist',$param);
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' =>$key_type,
			'key' =>$key,
			'gameId' => $gameId,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);

		
		$this->view($data,'base_team/ajaxindex');
	}
	
	public function getClassList(){
		$resp = $this->model->read('base_team','getlist');
		foreach ($resp['data']['list'] as $key => $value) {
			$classList[$value['id']] = $value['teamName'];
		}
		
	}


	public	function info(){
		    $id = $this->queryVar('id');
		    if(!empty($id)){
		      $param['id'] = $id;
		      $resp = $this->model->read('base_team','getlist',$param);	
		      if($resp['status']){
		        $data['attr'] = $resp['data']['list'][0];
		      }
		    }
		    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_team/index');
		    $this->view($data,'base_team/info');
	}
}