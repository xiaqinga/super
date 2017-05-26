<?php

/**
 * 富媒体分类
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_media_class extends common {
		
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

		$resp = $this->model->read('base_media_class','getlist',$param);
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
		$this->setActionLog('base_media_class','QUERY','查看富媒体分类列表');
		$this->view($data,'base_media_class/index');
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
		$resp = $this->model->read('base_media_class','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_media_class/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_media_class/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_media_class','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_media_class','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_media_class/index');
		$this->view($data,'base_media_class/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['classTitle'] = $this->queryVar('classTitle');
		$param['parentId'] = $this->queryVar('parentId');
		$param['mark'] = $this->queryVar('mark');
		$ref = $this->queryVar('ref',APP_URL . 'base_media_class/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_media_class','create', $param);
			$opt  = '添加';
			$this->setActionLog('base_media_class','SAVE','添加富媒体分类');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_media_class','update', $param);
			$opt  = '修改';
			$this->setActionLog('base_media_class','UPDATE','修改富媒体分类');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '富媒体分类'.$opt.'成功' : '富媒体分类没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_media_class/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_media_class','delete', $param);
		$this->setActionLog('base_media_class','DELETE','删除富媒体分类');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '富媒体分类删除成功' : '富媒体分类删除失败',
			'ref'=> $ref
		));
	}
}