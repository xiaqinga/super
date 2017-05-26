<?php

/**
 * 校企快讯信息
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_school_news extends common {
		
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
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_school_news','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'statuslist'=>$this->public_dict['schoolNewsStatus'],
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'base_school_news/index');
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
		if($key){
			$param['key'] = $key;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_school_news','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_school_news/index?key_type='.$key_type.'&key='.$key.'&page='.$page)

		);
			

		$this->view($data,'base_school_news/ajaxindex');  
		$data = urldecode($data);
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
		$data['statuslist']=$this->public_dict['schoolNewsStatus'];
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_school_news/index');
		$this->view($data,'base_school_news/edit');
	}
	
	public function save(){
		$id = $this->queryVar('id');
		//$param['classId'] = $this->queryVar('classId');
		$param['title'] = $this->queryVar('title');
		$param['details'] = $this->queryVar('details');
		$param['publishdate'] = $this->queryVar('publishdate');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['urlPath'] = $this->queryVar('urlPath');
		$param['source'] = $this->queryVar('source');
		$param['author'] = $this->queryVar('author');
		$param['sort'] = $this->queryVar('sort');
		$param['mark'] = $this->queryVar('mark');
		$param['status'] = $this->queryVar('status');
		$param['instruction'] = $this->queryVar('instruction');
		$param['showType'] =$this->queryVar('showType',0);
	
		$ref = $this->queryVar('ref',APP_URL . 'base_school_news/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_school_news','create', array_filter($param));
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_school_news','update', array_filter($param));
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '未来快讯信息'.$opt.'成功' : '未来快讯信息'.$opt.'成功',
			'ref'=> $ref
		));
	}
	

	public function info()
	{
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('base_school_news','getlist',$param);
      if($resp['status']){
        $data['attr'] = $resp['data']['list'][0];

      }
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_school_news/index');
    $this->view($data,'base_school_news/info');
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_school_news/index');
		$param['id'] = $id;
		$resp = $this->model->write('base_school_news','delete', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '未来快讯删除成功' : '未来快讯删除失败',
			'ref'=> urldecode($ref),
	
		));
	}
}