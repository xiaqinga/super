<?php

/**
 * 爆款专区
 *
 * @author wsbnet@qq.com
 * @since   2016-09-12
 * @version 1.0
 */
 
class base_moldbaby extends common {
		
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

		$resp = $this->model->read('base_moldbaby','getlist',$param);
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
    $this->setActionLog('base_moldbaby','QUERY','查看爆款列表');
		$this->view($data,'base_moldbaby/index');
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
		$resp = $this->model->read('base_moldbaby','getlist',$param);
		foreach ($resp['data']['list'] as $key => $value) {
			if(strrpos($value['goodsId'],',')>-1){
				$goods_ids_arr = explode(',', $value['goodsId']);
			}else{
				$goods_ids_arr[0] = $value['goodsId'];			
			}
		    foreach ($goods_ids_arr as $kk => $vv) {
		      if($vv){
		        $_goods_ids_arr[] = $vv;
		      }
		    }
			$param_goods['id'] = $_goods_ids_arr[0];
	      	if($param_goods['id']){
	        	$resp_goods = $this->model->read('goods_list','getlist',$param_goods);
	      	}

			$resp['data']['list'][$key]['first_goodsname'] = $resp_goods['data']['list'][0]['goodsName'];
		}
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);


		$this->view($data,'base_moldbaby/ajaxindex');  
	}

	//基本信息
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_moldbaby','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_moldbaby/index');
		$this->view($data,'base_moldbaby/edit');
	}

  //基本信息
  public function info(){
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('base_moldbaby','getlist',$param);
      if($resp['status']){
        $data['attr'] = $resp['data']['list'][0];
      }
      $data['id'] = $id;
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_moldbaby/index');
    $this->setActionLog('base_moldbaby','QUERY','查看爆款详情');
    $this->view($data,'base_moldbaby/info');
  }

	//保存基本信息
	public function save(){
		$id = $this->queryVar('id');
		$param['name'] = $this->queryVar('name');
		$param['identifier'] = $this->queryVar('identifier');
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$param['photoUrl'] = $this->queryVar('photoUrl');
		$param['marketAmount'] = $this->queryVar('marketAmount');
    $param['goodsId'] = $this->queryVar('goodsId','placeholder');
		$param['description'] = $this->queryVar('description');

		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_moldbaby','create', $param);
      $this->setActionLog('base_moldbaby','SAVE','新增爆款');
      		if($resp['status']){
		        //更新活动搜索引擎
		        try{
		          if($resp['status']){
		            $url = SCHOOLAPI."search/initsearchengine";
				    $url = $url.'?goodsType=3&identifier='.$param['identifier'];
				    $res = $this->Curl_api->https_request($url);
		          }
		        }catch(Exception $e){}
		      }
      echo json_encode(array('msg' => 1,'id' => $resp['data']['id']));
		}
		else
		{
			$param['id'] = $id;
      unset($param['goodsId']);
			$resp = $this->model->write('base_moldbaby','update', $param);
			//更新活动搜索引擎
		        try{
		            $url = SCHOOLAPI."search/initsearchengine";
				    $url = $url.'?goodsType=3&identifier='.$param['identifier'];
				    $res = $this->Curl_api->https_request($url);
		        }catch(Exception $e){}
      $this->setActionLog('base_moldbaby','UPDATE','修改爆款');
      echo json_encode(array('msg' => 1));
		}
	}

	//保存添加商品
	public function saveb(){
		$id = $this->queryVar('id');
		$goodsId = $this->queryVar('goodsId');
		$itemsArr = $this->queryVar('itemsArr');
		$itemsArr = $this->objarray_to_array(json_decode($itemsArr));

		if(!empty($goodsId)){   //替换保存基本信息goodIds的占位符placeholder
      if(strrpos($goodsId,'placeholder')>-1){
        $param['goodsId'] = str_replace('placeholder','',$goodsId);
      }else{
        $param['goodsId'] = $goodsId;
      }         
		}

		$param['id'] = $id;
		$resp = $this->model->read('base_moldbaby','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$identifier = $this->trimall($identifier);
		$org_goodsId = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;

		//原活动商品数组
		if(strrpos($org_goodsId,',')>-1){
			$org_goodsId_arr = explode(',', $org_goodsId);
		}else{
			$org_goodsId_arr[0] = $org_goodsId;			
		}

		//新保存活动商品数组
		if(strrpos($goodsId,',')>-1){
			$new_goodsId_arr = explode(',', $goodsId);
		}else{
			$new_goodsId_arr[0] = $goodsId;			
		}

		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_moldbaby','create', $param);
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_moldbaby','update', $param);
		}

		//删除活动商品(删除数组没有包含的ids)
		$param_del = array('identifier' => $identifier,'goodsId' =>$goodsId );
		$resp_del = $this->model->write('base_moldbaby','updateActivityGoodsById', $param_del);

		// var_dump($new_goodsId_arr,$org_goodsId_arr,$itemsArr);die();

		//匹配当前保存的活动商品
		foreach ($itemsArr as $k2 => $v2) {
			//新的活动商品ID,记录存在就更新
			if(in_array($v2['goodsId'],$org_goodsId_arr)){
				$param_up = array(
					'goodsName' => $v2['goodsName'],
					'originalPrice' => $v2['originalPrice'],
					'activityPrice' =>$v2['activityPrice'],
					'activityNum' =>$v2['activityNum'],
					'updateUser' =>$this->sess->get('id'),
					'updateDate' => date('Y-m-d H:i:s'),
					'identifier' =>$identifier,
					'goodsId' => $v2['goodsId']
				);
				$resp_up = $this->model->write('base_moldbaby','updateActivityGoods', $param_up);
			}else{ //不存在就插入
				$param_up = array(
					'identifier' => $identifier,
					'goodsId' => $v2['goodsId'],
					'goodsName' => $v2['goodsName'],
					'originalPrice' => $v2['originalPrice'],
					'activityPrice' => $v2['activityPrice'],
					'activityNum' => $v2['activityNum'],
					'createDate' => date('Y-m-d H:i:s'),
					'createUser' => $this->sess->get('id'),
					'updateDate' => date('Y-m-d H:i:s'),
					'updateUser' => $this->sess->get('id')
				);
				$resp_up = $this->model->write('base_moldbaby','insertActivityGoods', $param_up);
			}

		}

		if( $resp_up['status'] || $resp_del['status'] ){
			//更新活动搜索引擎
	      try{
	        if($resp_up['status'] || $resp_del['status'] || $resp['status']){
	          $url = SCHOOLAPI."search/initsearchengine";
			  $url = $url.'?goodsType=3&identifier='.$resp['data']['identifier'];
			  $res = $this->Curl_api->https_request($url);
	        }
	      }catch(Exception $e){}
			echo json_encode(array('msg' => true));
		}else{
			echo json_encode(array('msg' => false));
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

		$param_inner = $param = array();
		$param['id'] = $id;

		if($key_type == 'goodsName'){             
			$param_inner['goodsName'] =  $this->trimall($key);
		}
		if($key_type == 'providerId'){             
			$param_inner['providerId'] =  $this->trimall($key);
		}

		$param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_moldbaby','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;

		$goodsModel = $this->model->read('base_moldbaby','queryGoods',$param_inner);
		$total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
		$data  = array(
			'goodsId' => $param_inner['ids'],
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index')
		);
		$this->view($data,'base_moldbaby/addgoods');
	}

  public function addGoods_info()                  
  {
    $this->lib('Pagination','page');     

    //每页记录数
    $pagesize = 10;           
    $page = $this->queryVar('page', 1);  

    //查询
    $id = $this->queryVar('id');
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');

    $param_inner = $param = array();
    $param['id'] = $id;

    if($key_type == 'goodsName'){             
      $param_inner['goodsName'] =  $this->trimall($key);
    }
    if($key_type == 'providerId'){             
      $param_inner['providerId'] =  $this->trimall($key);
    }

    $param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_moldbaby','getlist',$param);
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;

    $goodsModel = $this->model->read('base_moldbaby','queryGoods',$param_inner);

    $total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
    $data  = array(
      'goodsId' => $param_inner['ids'],
      'providerList' => $this->getProviderList(),
      'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'id' => $id,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index')
    );
    $this->view($data,'base_moldbaby/addgoods_info');
  }
	
	public function ajaxAddgoods(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);

		//查询
		$id = $this->queryVar('id');
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');

		$param_inner = $param = array();
		$param['id'] = $id;

		if($key_type == 'goodsName'){             
			$param_inner['goodsName'] = $this->trimall($key);
		}
		if($key_type == 'providerId'){             
			$param_inner['providerId'] =  $this->trimall($key);
		}

		$param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_moldbaby','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;

		$goodsModel = $this->model->read('base_moldbaby','queryGoods',$param_inner);

		$data  = array(
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);

		$this->view($data,'base_moldbaby/ajaxaddgoods');  
	}

  public function ajaxAddgoods_info(){         

    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);  
    $page = $this->queryVar('page', 1);

    //查询
    $id = $this->queryVar('id');
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');

    $param_inner = $param = array();
    $param['id'] = $id;

    if($key_type == 'goodsName'){             
      $param_inner['goodsName'] = $this->trimall($key);
    }
    if($key_type == 'providerId'){             
      $param_inner['providerId'] =  $this->trimall($key);
    }

    $param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_moldbaby','getlist',$param);
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsId'] : 0;

    $goodsModel = $this->model->read('base_moldbaby','queryGoods',$param_inner);

    $data  = array(
      'providerList' => $this->getProviderList(),
      'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'id' => $id,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );

    $this->view($data,'base_moldbaby/ajaxaddgoods_info');  
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
		$ref = $this->queryVar('ref',APP_URL . 'base_moldbaby/index');
		$param['id'] = $id;
		$resp = $this->model->write('base_moldbaby','delete', $param);
		if($resp['status']){
	      //更新活动搜索引擎
	      try{
	        if($resp['status']){
	          $url = SCHOOLAPI."search/initsearchengine";
			  $url = $url.'?goodsType=3&identifier='.$resp['data']['identifier'];
			  $res = $this->Curl_api->https_request($url);
	        }
	      }catch(Exception $e){}
	    }
    $this->setActionLog('base_moldbaby','DELETE','删除爆款');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '活动管理删除成功' : '活动管理删除失败',
			'ref'=> urldecode($ref),
	
		));
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
    $goodsName = $this->queryVar('goodsName');
    $goodsId = $this->queryVar('goodsId');
    if(strrpos($goodsId,'placeholder')>-1){
      $goodsId = '';
    }

    $param = array();

    if(!empty($goodsName)){
      $param['goodsName'] = $goodsName;
    }

    if(!empty($goodsId)){
      $param['goodsId'] = $goodsId;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    $resp = $this->model->read('base_moldbaby','getGoodsInfoListByPage',$param);

    $total = ($resp['status']) ? $resp['data']['total'] : 0;

    $data  = array(
    	'goodsName' => $goodsName,
    	'goodsId' => $goodsId,
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->func->curr_url()
    );
    $this->view($data,'base_moldbaby/viewgoods');
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
    $goodsName = $this->queryVar('goodsName');
    $goodsId = $this->queryVar('goodsId');
    if(strrpos($goodsId,'placeholder')>-1){
      $goodsId = '';
    }

    $param = array();

    if(!empty($goodsName)){
      $param['goodsName'] = $goodsName;
    }

    if(!empty($goodsId)){
      $param['goodsId'] = $goodsId;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    $resp = $this->model->read('base_moldbaby','getGoodsInfoListByPage',$param);
    $data  = array(
    	'statusList' => $this->statusList(),
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_moldbaby/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_moldbaby/ajaxviewgoods');
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


