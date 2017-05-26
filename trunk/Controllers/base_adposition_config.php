<?php

/**
 * 广告位配置
 *
 * @author wsbnet@qq.com
 * @since   2016-08-01
 * @version 1.0
 */
 
class base_adposition_config extends common {
		
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
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_adposition_config','getlist',$param);
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
		$this->setActionLog('base_adposition_config','QUERY','查看广告位配置列表');
		$this->view($data,'base_adposition_config/index');
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
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_adposition_config','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_adposition_config/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_adposition_config/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');

		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_adposition_config','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_adposition_config/index');
		$this->view($data,'base_adposition_config/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['configName'] = $this->queryVar('configName');
		$param['tag'] = $this->queryVar('tag');
		$param['adpositionId'] = $this->queryVar('adpositionId');
		$ref = $this->queryVar('ref',APP_URL . 'base_adposition_config/index');
		$ref = urldecode($ref);
		if( 0 == $id )
		{
			$param['status'] = 1;
			$resp = $this->model->write('base_adposition_config','create', $param);
			$opt  = '添加';
			$this->setActionLog('base_adposition_config','SAVE','添加广告位配置');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_adposition_config','update', $param);
			$opt  = '修改';
			$this->setActionLog('base_adposition_config','UPDATE','修改广告位配置');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '广告位配置'.$opt.'成功' : '广告位配置'.$opt.'未更改',
			'ref'=> $ref
		));
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_adposition_config/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_adposition_config','delete', $param);
		$this->setActionLog('base_adposition_config','DELETE','删除广告位配置');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '广告位配置删除成功' : '广告位配置删除失败',
			'ref'=> $ref
		));
	}
	
}