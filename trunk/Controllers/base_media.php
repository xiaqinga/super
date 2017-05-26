<?php

/**
 * 富媒体信息
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_media extends common {
		
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

		$resp = $this->model->read('base_media','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('base_media','QUERY','查看富媒体管理列表');
		$this->view($data,'base_media/index');
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
		$resp = $this->model->read('base_media','getlist',$param);
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_media/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_media/ajaxindex');
	}
	
	public function getClassList(){
		$resp = $this->model->read('base_media_class','getlist');
		foreach ($resp['data']['list'] as $key => $value) {
			$classList[$value['id']] = $value['classTitle'];
		}
		return $classList;
	}

	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_media','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_media','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['classList'] = $this->getClassList();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_media/index');
		$this->view($data,'base_media/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['classId'] = $this->queryVar('classId',0);
		$param['title'] = $this->queryVar('title');
		$param['details'] = $this->queryVar('details');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['sort'] = $this->queryVar('sort',0);
		$param['mark'] = $this->queryVar('mark');
		$param['instruction'] = $this->queryVar('instruction');
		//微信相关
		$param['urlPath'] = $this->queryVar('urlPath');
		$param['showType'] = $this->queryVar('showType');
		$ref = $this->queryVar('ref',APP_URL . 'base_media/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_media','create', $param);
			$opt  = '添加';
			$this->setActionLog('base_media','SAVE','添加富媒体管理');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_media','update', $param);
			$opt  = '修改';
			$this->setActionLog('base_media','UPDATE','修改富媒体管理');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '富媒体'.$opt.'成功' : '富媒体没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_media/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_media','delete', $param);
		$this->setActionLog('base_media','DELETE','删除富媒体管理');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '富媒体删除成功' : '富媒体删除失败',
			'ref'=> $ref
		));
	}
}