<?php

/**
 * 联盟商分类
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */
 
class base_union_class extends common {
		
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

		$resp = $this->model->read('base_union_class','getlist',$param);
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
		$this->view($data,'base_union_class/index');
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
		$resp = $this->model->read('base_union_class','getlist',$param);
		$list=($resp['status']) ? $resp['data']['list'] : array();
		if($list){

			foreach ($list as $key=>&$val){
				if($val['parentId']){

					$val['classLevelName']=$this->model->read('base_union_class','getParentName',['id'=>$val['parentId']]).'->';


				}

			}
		}



		$data  = array(
			'list' => $list,
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_union_class/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->setActionLog('base_union_class','QUERY','查看商品分类');
		$this->view($data,'base_union_class/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_union_class','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_union_class','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
				$data['attr']['class_parent']=$this->model->read('base_union_class','getParentName',['id'=>$data['attr']['parentId']]);


			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_union_class/index');
		$this->view($data,'base_union_class/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['className'] = $this->queryVar('className');
		$param['classLevel'] = $this->queryVar('classLevel',1);
		$param['parentId'] = $this->queryVar('parentId',0);
		$param['photoUrl'] = $this->queryVar('photoUrl');
		$param['isDisplay'] = $this->queryVar('isDisplay');
		$param['classSort'] = $this->queryVar('classSort');
		$ref = $this->queryVar('ref',APP_URL . 'base_union_class/index');
		$ref = urldecode($ref);
		$where['className'] = $param['className'];
		if($id){
			$where['id'] = $id;
		}
		$repeat_classname = $this->model->read('base_union_class','findrepeat',$where);
		// var_dump($repeat_classname);die();
		$status = 0;
		if($repeat_classname['status'] = 1){
			if ($repeat_classname['data']['0']['status'] == '1') {
				$this->jsonout($status,array(
					'msg'=>'商品分类已存在',
					'ref'=> $ref
				));

			}elseif ($repeat_classname['data']['0']['status'] == '-1') {
				$id = $repeat_classname['data']['0']['id'];
				$param['status'] = 1;
			}
		}
		if(!$id)
		{


			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_union_class','create', $param);
			$opt  = '添加';
			$this->setActionLog('base_union_class','SAVE','添加联盟商分类');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_union_class','update', $param);
			$opt  = '修改';
			$this->setActionLog('base_union_class','UPDATE','修改联盟商分类');
		}
		
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品分类'.$opt.'成功' : '联盟商分类没变化',
			'ref'=> $ref
		));
		
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_union_class/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_union_class','delete', $param);


		$this->setActionLog('base_union_class','DELETE','删除联盟商分类');
		$this->jsonout($resp['status'],array(
			'msg'=>$resp['data']['msg'],
			'ref'=> $ref
		));
	}


	
	public function getClassJson(){
		//查询
		$param['id'] = $this->queryVar('id',0); //默认获取所有 顶级-->一级 分类
		$resp = $this->model->read('base_union_class','getClassJson',$param);
		//$resp_list = $resp['status'] ? $resp['data']['list'] : [];
		//echo json_encode($resp_list);
		$this->jsonout($resp['status'],array(
			'data'=>$resp['data']
		));
		
	}

}