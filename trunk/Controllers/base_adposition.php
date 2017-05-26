<?php

/**
 * 广告素材
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_adposition extends common {
		
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

		$resp = $this->model->read('base_adposition','getlist',$param);
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
		$this->setActionLog('base_adposition','QUERY','查看广告列表');
		$this->view($data,'base_adposition/index');
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
		$resp = $this->model->read('base_adposition','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_adposition/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_adposition/ajaxindex');
	}
	
		public function viewAd()
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

		$resp = $this->model->read('base_adposition','getlist',$param);
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
		$this->view($data,'base_adposition/viewad');
	}
	
	public function ajaxViewAd(){

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
		$resp = $this->model->read('base_adposition','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_adposition/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_adposition/ajaxviewad');
	}

	public function getClassList(){
		$resp = $this->model->read('base_adposition','getlist');
		foreach ($resp['data']['list'] as $key => $value) {
			$classList[$value['id']] = $value['classTitle'];
		}
		return $classList;
	}

	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_adposition','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_adposition','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['classList'] = $this->getClassList();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_adposition/index');
		$this->view($data,'base_adposition/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['adName'] = $this->queryVar('adName','');
		$param['adLink'] = $this->queryVar('adLink','');
		$param['sort'] = $this->queryVar('sort',0);
		$param['details'] = $this->queryVar('details','');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$ref = $this->queryVar('ref',APP_URL . 'base_adposition/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_adposition','create', $param);
			$opt  = '添加';
			$this->setActionLog('base_adposition','SAVE','添加广告');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_adposition','update', $param);
			$opt  = '修改';
			$this->setActionLog('base_adposition','UPDATE','修改广告');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '广告素材'.$opt.'成功' : '广告素材没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_adposition/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_adposition','delete', $param);
		$this->setActionLog('base_adposition','DELETE','删除广告');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '广告素材删除成功' : '广告素材删除失败',
			'ref'=> $ref
		));
	}
}