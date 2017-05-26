<?php

/**
 * 创客中心,创客需求
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_school_demand extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){           
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}
	
	public function maker()                  
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

		$resp = $this->model->read('base_school_demand','getlist',$param);
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
		$this->view($data,'base_school_demand/maker');
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
		$resp = $this->model->read('base_school_news','getlist',$param);
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_school_demand/maker?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);

		$this->view($data,'base_school_demand/ajaxindex');  
	}
	
	public function getClassList(){
		$param['classType']=2;
		$resp = $this->model->read('base_school_news_class','getlist',$param);
		foreach ($resp['data']['list'] as $key => $value) {
				$classList[$value['id']] = $value['classTitle'];
		}
		
		return $classList;
	}

	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_school_news','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_school_news','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['classList'] = $this->getClassList();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_school_demand/maker');
		$this->view($data,'base_school_demand/edit');
	}
		public function edit_class(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_school_news_class','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_school_news_class','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['classList'] = $this->getClassList();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_school_demand/maker');
		$this->view($data,'base_school_demand/edit_class');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['classTitle'] = $this->queryVar('classTitle');
		$param['parentId'] = $this->queryVar('parentId',0);
		$param['photoId'] = $this->queryVar('photoId');
		$param['classType'] = $this->queryVar('classType');
		$param['status'] = $this->queryVar('status',0);
		
		
		//微信相关
	

		$ref = $this->queryVar('ref',APP_URL . 'base_school_demand/maker');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_school_news_class','create', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_school_demand','update', $param);
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '校企快讯信息'.$opt.'成功' : '校企快讯信息失败',
			'ref'=> $ref
		));
	}
		public function save_edit(){
		$id = $this->queryVar('id');
		$param['classId'] = $this->queryVar('classId',0);
		$param['title'] = $this->queryVar('title');
		$param['details'] = $this->queryVar('details');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['sort'] = $this->queryVar('sort',0);
		$param['mark'] = $this->queryVar('mark');
		$param['instruction'] = $this->queryVar('instruction');
		$param['status'] = $this->queryVar('status');
		//微信相关
		$param['urlPath'] = $this->queryVar('urlPath');
		$param['showType'] = $this->queryVar('showType');

		$ref = $this->queryVar('ref',APP_URL . 'base_school_demand/maker');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_school_news','create', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_school_demand','update', $param);
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '校企快讯信息'.$opt.'成功' : '校企快讯信息失败',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_school_demand/maker');
		$param['id'] = $id;
		$resp = $this->model->write('base_school_news','delete', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '校企快讯删除成功' : '校企快讯删除失败',
			'ref'=> urldecode($ref),
	
		));
	}
}