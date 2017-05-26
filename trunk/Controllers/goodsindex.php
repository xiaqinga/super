<?php

/**
 * 首页模板管理
 *
 * @author  janhve@163.com
 * @since   2016.08.30
 * @version 1.0
 */
 
class goodsindex extends common {
		
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
		$templateName = $this->queryVar('templateName');
		$data['templateName'] = $templateName;
		$param = array();
		if(!empty($templateName)){
			$param['templateName'] = $templateName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goodsindex','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'templateName' => $templateName,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('goodsindex','QUERY','查看首页模板列表');
		$this->view($data,'goodsindex/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$templateName = $this->queryVar('templateName');
		$data['templateName'] = $templateName;
		$param = array();
		if(!empty($templateName)){
			$param['templateName'] = $templateName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goodsindex','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'templateName' => $templateName,
			'ref' => $this->queryVar('ref' , APP_URL . 'goodsindex/index?templateName='.$templateName.'&page='.$page)
		);
		$this->view($data,'goodsindex/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'templateName' => '',
				'identifier' => '',
				'description' => '',
				'indexs' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('goodsindex','getIndexInfo',$param);
			if($resp['status']){
				$data = $resp['data'];
			}else{
				$data  = array(
					'id' => '',
					'templateName' => '',
					'identifier' => '',
					'description' => '',
					'indexs' => ''
				);
			}
		}
	    
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goodsindex/index');
		$this->view($data,'goodsindex/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['identifier'] = $this->queryVar('identifier');
		$param['templateName'] = $this->queryVar('templateName');
		$param['description'] = $this->queryVar('description');
		$param['goodsIndexs'] = $_REQUEST['goodsIndexs'];
		/*echo '<pre>';
		var_dump($param['goodsIndexs']);
		echo '</pre>';
		exit;*/
		$ref = $this->queryVar('ref',APP_URL . 'goodsindex/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createTime'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateTime'] = date('Y-m-d H:i:s');
			$param['status'] = 1;
			$resp = $this->model->write('goodsindex','create', $param);
			$opt  = '添加';
			$this->setActionLog('goodsindex','SAVE','添加模板');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goodsindex','update', $param);
			$opt  = '修改';
			$this->setActionLog('goodsindex','UPDATE','修改首模板');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '模板'.$opt.'成功' : '模板'.$opt.'失败',
			'ref'=> $ref
		));
	}

	public function info(){
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$resp = $this->model->read('goodsindex','getIndexInfo',$param);
		if($resp['status']){
			$data = $resp['data'];
		}else{
			$data  = array(
				'id' => '',
				'templateName' => '',
				'identifier' => '',
				'description' => '',
				'indexs' => ''
			);
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goodsindex/index');
		$this->setActionLog('goodsindex','QUERY','查看模板');
		$this->view($data,'goodsindex/info');
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goodsindex/index');
		$param['id'] = $id;
		$resp = $this->model->write('goodsindex','delete', $param);
		$this->setActionLog('goodsindex','DELETE','删除模板');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '模板删除成功' : '模板删除失败',
			'ref'=> $ref
		));
	}
	
	public function actionurl(){
		$data['relName'] = $this->queryVar('relName');
		$data['relId'] = $this->queryVar('relId');
		$data['type'] = $this->queryVar('type',1);
		$data['url'] = $this->queryVar('url');
		$this->view($data,'goodsindex/actionurl');
	}
	
	public function goodsclass()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$relId = $this->queryVar('relId');
		$className = $this->queryVar('className');
		$param = array();
		if(!empty($className)){
			$param['className'] = $className;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

		$resp = $this->model->read('goods_class','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'relId' => $relId,
			'className' => $className
		);
		$this->view($data,'goodsindex/goodsclass');
	}
	
	public function ajaxGoodsclass(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$relId = $this->queryVar('relId');
		$className = $this->queryVar('className');
		$param = array();
		if(!empty($className)){
			$param['className'] = $className;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goods_class','getlist',$param);
		$resp_list = $resp['status'] ? $resp['data']['list'] : [];
		foreach ($resp_list as $key => $value) {
			$class_rumbs = '顶级-->';

			//父级
			$p_parent['id'] = $value['parentId'];
			$resp_parent = $this->model->read('goods_class','getItem',$p_parent);
			$class_parent = $resp_parent['status'] ? $resp_parent['data']['className'] : null;
			$class_parent = $class_parent ? $class_parent : '';

			//祖父级
			$p_granddad['id'] = $resp_parent['status'] ? $resp_parent['data']['parentId'] :null;
			$resp_granddad = $this->model->read('goods_class','getItem',$p_granddad);
			$class_granddad = $resp_granddad['status'] ? $resp_granddad['data']['className'] : null;
			$class_granddad = $class_granddad ? $class_granddad : '';

			//本级
			$class_self = $resp['status'] ? $resp['data']['list'][$key]['className'] : null;

			//组合分类面包屑名称
			if($class_granddad){
				$class_rumbs .= $class_granddad.' > ';
			}

			if($class_parent){
				$class_rumbs .= $class_parent.' > ';
			}
			if($class_rumbs){
				$class_rumbs .=$class_self;
			}else{
				$class_rumbs =$class_self;
			}
			$resp['data']['list'][$key]['class_rumbs'] = $class_rumbs;

		}
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'relId' => $relId,
			'className' => $className
		);
		$this->view($data,'goodsindex/ajaxGoodsclass');
	}

	public function goods()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$relId = $this->queryVar('relId');
		$goodsName = $this->queryVar('goodsName');
		$param = array();
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		$param['status'] = 1;

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		
		$resp = $this->model->read('goods_list','getlist',$param);
		
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			//传递查询框的值
			'relId' => $relId,
			'goodsName' => $goodsName,
		);
		$this->view($data,'goodsindex/goods');
	}
	
	public function ajaxGoods(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$relId = $this->queryVar('relId');
		$goodsName = $this->queryVar('goodsName');
		$param = array();
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		$param['status'] = 1;

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goods_list','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			//传递查询框的值
			'relId' => $relId,
			'goodsName' => $goodsName,
			'mallTypes' =>$this->public_dict['mallTypes']
		);
		$this->view($data,'goodsindex/ajaxGoods');
	}
	
	/**
	 * 检测数据唯一性
	 */
	public function checkexist(){
		$name   = $this->queryVar('name');
		$value  = $this->queryVar('value');

		$param = array(
			'id' => $this->queryVar('id', 0),
			$name => $value
		);

		$resp = $this->model->read('goodsindex', 'selectGoodsIndexMainIdentifier',$param);

		$this->jsonout($resp['status'],array('msg'=>$resp['data']));
	}
}