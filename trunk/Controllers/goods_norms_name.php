<?php

/**
 * 商品规格
 *
 * @author wsbnet@qq.com
 * @since   2016-8-6
 * @version 1.0
 */
 
class goods_norms_name extends common {
		
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
    $param['status'] =1;
 		$resp = $this->model->read('goods_norms_name','getlist',$param);
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
		$this->view($data,'goods_norms_name/index');
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
    $param['status'] =1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goods_norms_name','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_norms_name/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
    	$this->setActionLog('goods_norms_name','QUERY','查看商品规格');
		$this->view($data,'goods_norms_name/ajaxindex');
	}


	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('goods_norms_name','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_norms_name','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_norms_name/index');
		$this->view($data,'goods_norms_name/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['normsName'] = $this->queryVar('normsName');
		$param['sort'] = $this->queryVar('sort',0);
		$param['normsValueList'] = $this->queryVar('normsValueList');
		$ref = $this->queryVar('ref',APP_URL . 'goods_norms_name/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goods_norms_name','create', $param);
			$opt  = '添加';
			$this->setActionLog('goods_norms_name','SAVE','添加商品规格');
		}
		else
		{
			$param['id'] = $id;
			$param['delValueIds'] = $this->queryVar('delValueIds');
			$resp = $this->model->write('goods_norms_name','update', $param);
			$opt  = '修改';
			$this->setActionLog('goods_norms_name','UPDATE','修改商品规格');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品规格'.$opt.'成功' : '商品规格没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_norms_name/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_norms_name','delete', $param);
		$this->setActionLog('goods_norms_name','DELETE','删除商品规格');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品规格删除成功' : '商品规格删除失败',
			'ref'=> $ref
		));
	}
}