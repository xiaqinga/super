<?php

/**
 * 用户反馈
 *
 */
 
class base_feedback extends common {
		
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

		$resp = $this->model->read('base_feedback','getlist',$param);
		
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
    	$this->setActionLog('base_feedback','QUERY','查看用户反馈列表');
		$this->view($data,'base_feedback/index');
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
		$resp = $this->model->read('base_feedback','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_feedback/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_feedback/ajaxindex');  
	}

  //基本信息
	public function info(){
	    $id = $this->queryVar('id');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $resp = $this->model->read('base_feedback','getlist',$param);
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	      $data['id'] = $id;
	    }
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_feedback/index');
	    $this->setActionLog('base_feedback','QUERY','查看用户反馈详情');
	    $this->view($data,'base_feedback/info');
	}

}


