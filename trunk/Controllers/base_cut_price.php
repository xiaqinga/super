<?php

/**
 * 团购
 *
 */
 
class base_cut_price extends common {
		
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
		// echo '进入';die();
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

		$resp = $this->model->read('base_cut_price','getlist',$param);

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
		$this->view($data,'base_cut_price/index');
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
		$resp = $this->model->read('base_cut_price','getlist',$param);
		// var_dump()
		// $resp_list = $resp['status'] ? $resp['data']['list'] : [];
		
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_cut_price/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_cut_price/ajaxindex');
	}

	public	function info(){
	    $id = $this->queryVar('id');
	    $goodsType = $this->queryVar('goodsType');
	    $goodsId = $this->queryVar('goodsId');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $param['goodsType'] = $goodsType;
	      $param['goodsId'] = $goodsId;
	      $resp = $this->model->read('base_cut_price','getlistinfo',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_cut_price/index');
	    
		$this->view($data,'base_cut_price/info');
	}

	//基本信息
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_cut_price','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_cut_price/index');
		$this->view($data,'base_cut_price/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['name'] = $this->queryVar('name');
		$param['goodsType'] = $this->queryVar('goodsType');
		
		$param['photoUrl'] = $this->queryVar('photoUrl');
		$param['status'] = $this->queryVar('status');
		$param['preferentialPrice'] = $this->queryVar('preferentialPrice');
		$param['minPrice'] = $this->queryVar('minPrice');
		$param['number'] = $this->queryVar('number');
		$param['cutTimes'] = $this->queryVar('cutTimes');
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$param['description'] = $this->queryVar('description');

		if ($param['goodsType'] == '1') {
			$param['identifier'] = 'PT_KJ_';
		}elseif($param['goodsType'] == '0'){
			$param['identifier'] = 'YY_KJ_';
		}
		$ref = $this->queryVar('ref',APP_URL . 'base_cut_price/index');
		$ref = urldecode($ref);
		if (!$id) {
			$param['goodsId'] = '0';
			$param['createUser'] = $this->sess->get('id');
			$param['createTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_cut_price','create', $param);
			if ($resp['status']) {
				echo json_encode(array('msg' => 1,'id' => $resp['data']['id'],'goodsType' => $resp['data']['goodsType']));
			}
		}else{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_cut_price','update', $param);
			if ($resp['status']) {
				echo json_encode(array('msg' => 1));
			}
		}
	}

	public function saveb(){
		$param['id'] = $this->queryVar('id');
		$param['goodsId'] = $this->queryVar('goodsIds');
		$param['goodsName'] = $this->queryVar('goodsName');
		$param['goodsType'] = $this->queryVar('goodsType');
		if ($param['goodsType'] == '1') {
			$param['identifier'] = 'PT_KJ_'.$param['goodsId'];
		}elseif($param['goodsType'] == '0'){
			$param['identifier'] = 'YY_KJ_'.$param['goodsId'];
		}
		if (!empty($param['id'])) {
			$resp = $this->model->write('base_cut_price','update',$param);
			if ($resp['status']) {
				echo json_encode(array('msg' => true));
			}else{
				echo json_encode(array('msg' => false));
			}
		}else{
			echo json_encode(array('msg' => false));
		}

	}

	public function ajaxfindgoods(){
		$goodsIds = $this->queryVar('goodsIds');
		$goodsType = $this->queryVar('goodsType');
		if (!empty($goodsIds)) {
			$param['goodsIds'] = $goodsIds;
			$param['goodsType'] = $goodsType;
			$resp = $this->model->read('base_group_buy','findgoods',$param);
			if($resp['status']){
				//a.goodsName,b.preferentialPrice,c.providerName,d.stockNum,e.photoPath'
				echo json_encode(array('msg' => true,'goodsName' => $resp['data'][0]['goodsName'],'preferentialPrice' => $resp['data'][0]['preferentialPrice'],'providerName' => $resp['data'][0]['providerName'],'stockNum' => $resp['data'][0]['stockNum'],'photoPath' => $resp['data'][0]['photoPath']));
			}else{
				echo json_encode(array('msg' => false ));
			}
		}else{
			echo json_encode(array('msg' => false ));
		}
	}

	public function addGoods()                  
	{
		$this->lib('Pagination','page');     

		//每页记录数
		$pagesize = 10;						
		$page = $this->queryVar('page', 1);  

		//查询
		$id = $this->queryVar('id');
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$goodsType = $this->queryVar('goodsType');

		$param_inner = $param = array();
		$param['id'] = $id;

		if($key_type == 'goodsName'){             
			$param_inner['goodsName'] =  $this->trimall($key);
		}
		if($key_type == 'providerId'){             
			$param_inner['providerId'] =  $this->trimall($key);
		}

		$param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_cut_price','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;
		if($goodsType==1){
			$goodsModel = $this->model->read('base_cut_price','queryGoods',$param_inner);
		}elseif($goodsType==0){
			$goodsModel = $this->model->read('base_cut_price','queryPreGoods',$param_inner);
		}

		$total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
		$data  = array(
			'goodsType' => $goodsType,
			'goodsIds' => $param_inner['ids'],
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'][0] : array(),
			'goodsName' => $resp['data']['list'][0]['agname'],
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_cut_price/index')
		);
		$this->view($data,'base_cut_price/addgoods');
	}

  /**
   * [viewProvider 弹窗加载商品数据]
   * @return [type] [HTML]
   */
  public function viewGoods()
  {
    $this->lib('Pagination','page');

    //每页记录数
    $pagesize = 10;
    $page = $this->queryVar('page', 1);

    //查询
    $goodsType = $this->queryVar('goodsType');
    $goodsName = $this->queryVar('goodsName');
    $goodsIds = $this->queryVar('goodsIds');
    if(strrpos($goodsIds,'placeholder')>-1){
      $goodsIds = '';
    }

    $param = array();

    if(!empty($goodsName)){
      $param['goodsName'] = $goodsName;
    }

    if(!empty($goodsIds)){
      $param['ids'] = $goodsIds;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    if($goodsType==1){
    	$resp = $this->model->read('base_cut_price','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_cut_price','getPreGoodsInfoListByPage',$param);
    }

    $total = ($resp['status']) ? $resp['data']['total'] : 0;

    $data  = array(
    	'goodsType' => $goodsType,
    	'goodsName' => $goodsName,
    	'goodsIds' => $goodsIds,
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->func->curr_url()
    );
    $this->view($data,'base_cut_price/viewgoods');
  }

  /**
   * [ajaxviewProvider 弹窗ajax加载供应商数据]
   * @return [type] [HTML]
   */
  public function ajaxGoods(){

    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $goodsType = $this->queryVar('goodsType');
    $goodsName = $this->queryVar('goodsName');
    $goodsIds = $this->queryVar('goodsIds');
    if(strrpos($goodsIds,'placeholder')>-1){
      $goodsIds = '';
    }

    $param = array();

    if(!empty($goodsName)){
      $param['goodsName'] = $goodsName;
    }

    if(!empty($goodsIds)){
      $param['ids'] = $goodsIds;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    if($goodsType==1){
    	$resp = $this->model->read('base_cut_price','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_cut_price','getPreGoodsInfoListByPage',$param);
    }

    $data  = array(
      'statusList' => $this->statusList(),
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_cut_price/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_cut_price/ajaxviewgoods');
  }

  public function getProviderList(){
		$param['field']='id,providerName';
		$resp = $this->model->read('admin_provider','getItems',$param);
		foreach ($resp['data'] as $key => $value) {
			$classList[$value['id']] = $value['providerName'];
		}
		return $classList;
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_cut_price/index');
		$param['id'] = $id;
		$resp = $this->model->write('base_cut_price','delete', $param);
    	$this->setActionLog('base_cut_price','DELETE','删除砍价');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '砍价删除成功' : '砍价删除失败',
			'ref'=> urldecode($ref),
		));
	}

	public function statusList(){
	  	$arrayName = array(
				1 => '上架',
				0 => '删除',
				2 => '下架'
	  	);
	  	return $arrayName;
	}

}