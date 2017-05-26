<?php

/**
 * 商品品牌
 *
 * @author wsbnet@qq.com
 * @since   2016-8-26
 * @version 1.0
 */
 
class goods_brand extends common {
		
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

		$resp = $this->model->read('goods_brand','getlist',$param);
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
		$this->view($data,'goods_brand/index');
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
		$resp = $this->model->read('goods_brand','getlist',$param);

		//获取相关分类
		if($resp['status']){
			foreach ($resp['data']['list'] as $k => $v) {
				if($v['classIds']){
					$classId = $v['classIds'];
					$param_inner['ids'] = $classId;
					$classNameData = $this->model->read('goods_class','getClassName',$param_inner);
					if($classNameData['status']){
						foreach ($classNameData['data']['list'] as $k2 => $v2) {
							$classNames[] = $v2['className'];
						}
					}
					$resp['data']['list'][$k]['classNames'] = implode(',', $classNames);
				}
				$classNames = array();
			}
		}

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_brand/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->setActionLog('goods_brand','QUERY','查询商品品牌');
		$this->view($data,'goods_brand/ajaxindex');
	}

	public function jsonGoodsBrand(){

		//查询
		$id = $this->queryVar('id');
		$param = array();
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_brand','getGoodsBrandClassId',$param);
			$arr = ($resp['status']) ? $resp['data']['list'] : array();
			echo json_encode($arr);
		}
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_brand','getlist',$param);
			if($resp['status']){
				$classId = $resp['data']['list'][0]['classIds'];
				$param_inner['ids'] = $classId;
				$classNameData = $this->model->read('goods_class','getClassName',$param_inner);
				if($classNameData['status']){
					foreach ($classNameData['data']['list'] as $k2 => $v2) {
						$classNames[] = $v2['className'];
					}
				}
				$data['attr'] = $resp['data']['list'][0]['classNames'] = $classNames;
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_brand/index');
		$this->view($data,'goods_brand/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['brandName'] = $this->queryVar('brandName');
		$classIds = $this->queryVar('classIds');
		$param['classIds'] = implode(',', $classIds);
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$ref = $this->queryVar('ref',APP_URL . 'goods_brand/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goods_brand','create', $param);
			$opt  = '添加';
			$this->setActionLog('goods_brand','SAVE','添加商品品牌');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('goods_brand','update', $param);
			$opt  = '修改';
			$this->setActionLog('goods_brand','UPDATE','修改商品品牌');
		}
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品品牌'.$opt.'成功' : '商品品牌没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_brand/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_brand','delete', $param);
		$this->setActionLog('goods_brand','DELETE','删除商品品牌');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品品牌删除成功' : '商品品牌删除失败',
			'ref'=> $ref
		));
	}
}