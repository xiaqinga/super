<?php

/**
 * App管理
 *
 * @author  janhve@163.com
 * @since   2016.09.10
 * @version 1.0
 */
 
class appmanager extends common {
		
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
		$mobileSysType = $this->queryVar('mobileSysType');
		$version = $this->queryVar('version');
		$param = array();
		if($searchname == 'mobileSysType'){
			if(!empty($mobileSysType)){
				$param['mobileSysType'] = $mobileSysType;
			}
		}
		if($searchname == 'version'){
			if(!empty($version)){
				$param['version'] = $version;
			}
		}
		
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('appmanager','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'mobileSysType' => $mobileSysType,
			'version' => $version,
			'ref' => $this->func->curr_url()
		);
		$data['searchnamelist'] = array(
			'mobileSysType' => '操作系统',
			'version' => '版本'
		);
		$data['mobileSysTypelist'] = array(
			'1' => 'Android',
			'2' => 'IOS'
		);
		$data['isNowlist'] = array(
			'Y' => '当前',
			'N' => '历史'
		);
		$this->setActionLog('appmanager','QUERY','查看App列表');
		$this->view($data,'appmanager/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$searchname = $this->queryVar('searchname');
		$mobileSysType = $this->queryVar('mobileSysType');
		$version = $this->queryVar('version');
		$param = array();
		if($searchname == 'mobileSysType'){
			if(!empty($mobileSysType)){
				$param['mobileSysType'] = $mobileSysType;
			}
		}
		if($searchname == 'version'){
			if(!empty($version)){
				$param['version'] = $version;
			}
		}
		
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('appmanager','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'mobileSysType' => $mobileSysType,
			'version' => $version,
			'ref' => $this->queryVar('ref' , APP_URL . 'appmanager/index?searchname='.$searchname.'&mobileSysType='.$mobileSysType.'&version='.$version.'&page='.$page)
		);
		$data['searchnamelist'] = array(
			'mobileSysType' => '操作系统',
			'version' => '版本'
		);
		$data['mobileSysTypelist'] = array(
			'1' => 'Android',
			'2' => 'IOS'
		);
		$data['isNowlist'] = array(
			'Y' => '当前',
			'N' => '历史'
		);
		$this->view($data,'appmanager/ajaxindex');
	}
	
	public function info(){
		$param['id'] = $this->queryVar('id');
		$resp = $this->model->read('appmanager','getlist',$param);
		$data = ($resp['status']) ? $resp['data']['list'][0] : array();
		$data['searchnamelist'] = array(
			'mobileSysType' => '操作系统',
			'version' => '版本'
		);
		$data['mobileSysTypelist'] = array(
			'1' => 'Android',
			'2' => 'IOS'
		);
		$data['isNowlist'] = array(
			'Y' => '当前',
			'N' => '历史'
		);
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'appmanager/index');
		$this->setActionLog('appmanager','QUERY','查看App详情');
		$this->view($data,'appmanager/info');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'name' => APPNAME,
				'appSign' => APPSIGN,
				'iconUrl' => APPICONURL,
				'version' => '',
				'appName' => '',
				'detail' => '',
				'isNow' => '',
				'networkType' => '',
				'networkUrl' => '',
				'localUrl' => '',
				'mobileSysType' => '',
				'apptype' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('appmanager','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'name' => APPNAME,
					'appSign' => APPSIGN,
					'iconUrl' => APPICONURL,
					'version' => '',
					'appName' => '',
					'detail' => '',
					'isNow' => '',
					'networkType' => '',
					'networkUrl' => '',
					'localUrl' => '',
					'mobileSysType' => '',
					'apptype' => ''
				);
			}
		}
		$data['searchnamelist'] = array(
			'mobileSysType' => '操作系统',
			'version' => '版本'
		);
		$data['mobileSysTypelist'] = array(
			'1' => 'Android',
			'2' => 'IOS'
		);
		$data['isNowlist'] = array(
			'Y' => '当前',
			'N' => '历史'
		);
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'appmanager/index');
		$this->view($data,'appmanager/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['name'] = $this->queryVar('name');
		$param['appSign'] = $this->queryVar('appSign');
		$param['iconUrl'] = $this->queryVar('iconUrl');
		$param['version'] = $this->queryVar('version');
		$param['appName'] = $this->queryVar('appName');
		$param['detail'] = $this->queryVar('detail');
		$param['networkType'] = $this->queryVar('networkType');
		$param['localUrl'] = $this->queryVar('localUrl');
		$param['networkUrl'] = $this->queryVar('networkUrl');
		$param['mobileSysType'] = $this->queryVar('mobileSysType');
		$param['apptype'] = (int)$this->queryVar('apptype');
		$ref = $this->queryVar('ref',APP_URL . 'appmanager/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['isNow'] = 'Y';
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('appmanager','create', array_filter($param));
			$opt  = '添加';
			$this->setActionLog('appmanager','SAVE','新增App');
		}
		else
		{
			$param['id'] = $id;
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('appmanager','update', array_filter($param));
			$opt  = '修改';
			$this->setActionLog('appmanager','UPDATE','修改App');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? 'App'.$opt.'成功' : 'App'.$opt.'失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 删除App
	 */
	public function delete()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'appmanager/index');
		$param['id'] = $id;
		$resp = $this->model->write('appmanager','delete', $param);
		$this->setActionLog('appmanager','DELETE','删除App');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? 'App删除成功' : 'App删除失败',
			'ref'=> $ref
		));
	}
	/**
	 * 添加web
	 */
	public function addWeb()
	{
		$this->view($data,'appmanager/addweb');
	}
}