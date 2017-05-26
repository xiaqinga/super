<?php

/**
 * 团购
 *
 */
 
class base_group_buy extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
		$this->lib('Curl','Curl_api');
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

		$resp = $this->model->read('base_group_buy','getlist',$param);

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
		$this->view($data,'base_group_buy/index');
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
		$resp = $this->model->read('base_group_buy','getlist',$param);
		// var_dump()
		// $resp_list = $resp['status'] ? $resp['data']['list'] : [];
		
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_group_buy/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_group_buy/ajaxindex');
	}

	public	function info(){
	    $id = $this->queryVar('id');
	    $goodsType = $this->queryVar('goodsType');
	    $goodsId = $this->queryVar('goodsId');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $param['goodsType'] = $goodsType;
	      $param['goodsId'] = $goodsId;
	      $resp = $this->model->read('base_group_buy','getlistinfo',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_group_buy/index');
	    
		$this->view($data,'base_group_buy/info');
	}

	//基本信息
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_group_buy','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_group_buy/index');
		$this->view($data,'base_group_buy/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['name'] = $this->queryVar('name');
		$param['goodsType'] = $this->queryVar('goodsType');
		
		$param['photoUrl'] = $this->queryVar('photoUrl');
		$param['status'] = $this->queryVar('status');
		$param['price'] = $this->queryVar('price');
		$param['stockNum'] = $this->queryVar('stockNum');
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$param['maxBuy'] = $this->queryVar('maxBuy');
		$param['description'] = $this->queryVar('description');
		$param['identifier'] = $this->queryVar('identifier');
		if(empty($param['identifier'])){
			if ($param['goodsType'] == '1') {
				$param['identifier'] = 'PT_TG_';
			}elseif($param['goodsType'] == '0'){
				$param['identifier'] = 'YY_TG_';
			}
		}

		$ref = $this->queryVar('ref',APP_URL . 'base_group_buy/index');
		$ref = urldecode($ref);
		if (!$id) {
			$param['number'] = $param['stockNum'];
			$param['goodsId'] = '0';
			$param['goodsName'] = '';
			$param['createUser'] = $this->sess->get('id');
			$param['createTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_group_buy','create', $param);
			if ($resp['status']) {
				echo json_encode(array('msg' => 1,'id' => $resp['data']['id'],'goodsType' => $resp['data']['goodsType']));
			}
			
		}else{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_group_buy','update', $param);
			try{
	          if($resp['status']){
	            $url = SCHOOLAPI."base/updategroupbuyactivity";
			    $url = $url.'?identifier='.$param['identifier'];
			    $res = $this->Curl_api->https_request($url);
	          }
	        }catch(Exception $e){}
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
			$param['identifier'] = 'PT_TG_'.$param['id'];
		}elseif($param['goodsType'] == '0'){
			$param['identifier'] = 'YY_TG_'.$param['id'];
		}
		if (!empty($param['id'])) {
			$resp = $this->model->write('base_group_buy','update',$param);
			if ($resp['status']) {
				try{
		          if($resp['status']){
		            $url = SCHOOLAPI."base/addgroupbuyactivity";
				    $url = $url.'?identifier='.$param['identifier'];
				    $res = $this->Curl_api->https_request($url);
		          }
		        }catch(Exception $e){}
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
		$resp = $this->model->read('base_group_buy','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;
		if($goodsType==1){
			$goodsModel = $this->model->read('base_group_buy','queryGoods',$param_inner);
		}elseif($goodsType==0){
			$goodsModel = $this->model->read('base_group_buy','queryPreGoods',$param_inner);
		}
		$total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
		$data  = array(
			'goodsType' => $goodsType,
			'goodsIds' => $param_inner['ids'],
			'providerList' => $this->getProviderList(),
			'goodsName' => $resp['data']['list'][0]['agname'],
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'][0] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_group_buy/index')
		);
		$this->view($data,'base_group_buy/addgoods');
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
    	$resp = $this->model->read('base_group_buy','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_group_buy','getPreGoodsInfoListByPage',$param);
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
    $this->view($data,'base_group_buy/viewgoods');
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
    	$resp = $this->model->read('base_group_buy','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_group_buy','getPreGoodsInfoListByPage',$param);
    }
    $data  = array(
      'statusList' => $this->statusList(),
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_group_buy/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_group_buy/ajaxviewgoods');
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
		$array = explode(',',$id);
		$ref = $this->queryVar('ref',APP_URL . 'base_group_buy/index');
		$param['id'] = $array[0];
		$resp = $this->model->write('base_group_buy','delete', $param);
    	$this->setActionLog('base_group_buy','DELETE','删除团购');
    	if($resp['status']){
    		try{
		      if($resp['status']){
		        $url = SCHOOLAPI."base/deletegroupbuyactivity";
			    $url = $url.'?identifier='.$array[1];
			    $res = $this->Curl_api->https_request($url);
		      }
		    }catch(Exception $e){}
    	}
    	
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '团购删除成功' : '团购删除失败',
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