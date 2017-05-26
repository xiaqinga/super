<?php

/**
 * 操作日志管理
 *
 * @author  janhve@163.com
 * @since   2016.08.10
 * @version 1.0
 */
 
class actionLog extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('Curl','Curl_api');
	}
	/**
	 * 操作日志列表
	 */
	public function index(){
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$userName = $this->queryVar('userName');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$actionType = $this->queryVar('actionType');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'userName'){
			$param['userName'] = $userName;
		}elseif($searchname == 'actionType'){
			$param['actionType'] = $actionType;
		}elseif($searchname == 'actionDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('actionLog','getActionLogList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'userName' => $userName,
			'actionType' => $actionType,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'ref' => $this->func->curr_url()
		);
		$data['searchnameList'] = array(
			'userName'=>'操作员',
			'actionType'=>'操作类型',
			'actionDate'=>'操作时间'
		);
		$data['actionTypeList'] = array(
			'SAVE'=>'新增',
			'DELETE'=>'删除',
			'UPDATE'=>'修改',
			'QUERY'=>'查询'
		);
		$this->setActionLog('actionLog','QUERY','查询操作日志列表');
		$this->view($data,'actionLog/index');
	}

	/**
	 * ajax操作日志列表
	 */
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$userName = $this->queryVar('userName');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$actionType = $this->queryVar('actionType');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'userName'){
			$param['userName'] = $userName;
		}elseif($searchname == 'actionType'){
			$param['actionType'] = $userName;
		}elseif($searchname == 'actionDate'){
			if(!empty($startDate)){
				$param['startDate'] = $startDate;
			}
			if(!empty($endDate)){
				$param['endDate'] = $endDate;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('actionLog','getActionLogList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'userName' => $userName,
			'actionType' => $actionType,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'ref' => $this->queryVar('ref' , APP_URL . 'actionLog/index?searchname='.$searchname.'&userName='.$userName.'&actionType='.$actionType.'&startDate='.$startDate.'&endDate='.$endDate.'&page='.$page)
		);
		$data['searchnameList'] = array(
			'userName'=>'操作员',
			'actionType'=>'操作类型',
			'actionDate'=>'操作时间'
		);
		$data['actionTypeList'] = array(
			'SAVE'=>'新增',
			'DELETE'=>'删除',
			'UPDATE'=>'修改',
			'QUERY'=>'查询'
		);
		$this->view($data,'actionLog/ajaxindex');
	}

	public function info(){
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$resp = $this->model->read('actionLog','getActionLogList',$param);
		if($resp['status']){
			$data = $resp['data']['list'][0];
		}else{
			$data  = array(
				'id' => '',
				'actionIp' => '',
				'moduleId' => '',
				'actionDate' => '',
				'actionType' => '',
				'actionContent' => '',
				'userName' => ''
			);
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'logistics/courier');
		$data['actionTypeList'] = array(
			'SAVE'=>'新增',
			'DELETE'=>'删除',
			'UPDATE'=>'修改',
			'QUERY'=>'查询'
		);
		$this->setActionLog('actionLog','QUERY','查询操作日志详情');
		$this->view($data,'actionLog/info');
	}

	/**
	 * 更新搜索引擎
	 */
	public function updateAction(){
		$url = SCHOOLAPI.'/goods/initsearchengine?goodsType=1';
      	$res = $this->Curl_api->https_request($url);
      	$res = json_decode($res,true);
		if($res['status'] == 1){
			echo json_encode(array('msg' =>1));
		}else{
			echo json_encode(array('msg' =>0));
		}	
	}

	public function delete(){
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
		$param['startDate'] = $startDate;
		$param['endDate'] = $endDate;
		$resp = $this->model->write('actionLog','delete',$param);
		$this->setActionLog('actionLog','DELETE','删除操作日志');
		if($resp){
			echo json_encode(array('msg' => 1));
		}else{
			echo json_encode(array('msg' => 0));
		}
	}
}