<?php

/**
 * 活动管理
 *
 * @author wsbnet@qq.com
 * @since   2016-09-08
 * @version 1.0
 */
 
class base_activity extends common {
		
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

		$resp = $this->model->read('base_activity','getlist',$param);
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
    $this->setActionLog('base_activity','QUERY','查看活动列表');
		$this->view($data,'base_activity/index');
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
		$resp = $this->model->read('base_activity','getlist',$param);
		foreach ($resp['data']['list'] as $key => $value) {
			if(strrpos($value['goodsIds'],',')>-1){
				$goods_ids_arr = explode(',', $value['goodsIds']);
			}else{
				$goods_ids_arr[0] = $value['goodsIds'];			
			}
			$param_goods['id'] = $goods_ids_arr[0];

      if(strpos($param_goods['id'],'placeholder')<0){
        if($value['goodsType']==1){
          $resp_goods = $this->model->read('goods_list','getlist',$param_goods);
        }elseif($value['goodsType']==0){
          $resp_goods = $this->model->read('goods_list_pre','getlist',$param_goods);
        }
        if($resp_goods['status'] && count($resp_goods['data']['list'])>0){
          if($resp_goods['data']['list'][0]['goodsName']){
            $resp['data']['list'][$key]['first_goodsname'] = $resp_goods['data']['list'][0]['goodsName'];
          }
        }
      }
		}
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);


		$this->view($data,'base_activity/ajaxindex');  
	}

	//基本信息
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_activity','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_activity/index');
		$this->view($data,'base_activity/edit');
	}

  //基本信息
  public function info(){
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('base_activity','getlist',$param);
      if($resp['status']){
        $data['attr'] = $resp['data']['list'][0];
      }
      $data['id'] = $id;
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_activity/index');
    $this->setActionLog('base_activity','QUERY','查看活动详情');
    $this->view($data,'base_activity/info');
  }

	//保存基本信息
	public function save(){
		$id = $this->queryVar('id');
		$param['activityName'] = $this->queryVar('activityName');
		$param['identifier'] = $this->queryVar('identifier');
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$param['goodsType'] = $this->queryVar('goodsType');
    $param['limitType'] = $this->queryVar('limitType');
		$param['goodsBuy'] = $this->queryVar('goodsBuy');
    $param['goodsIds'] = $this->queryVar('goodsIds','placeholder');
		$param['activityExpalin'] = $this->queryVar('activityExpalin');

		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_activity','create', $param);

      if($resp['status']){
        //更新活动搜索引擎
        try{
          if($resp['status']){
            $url = SCHOOLAPI."search/initsearchengine";
		    $url = $url.'?goodsType=2&identifier='.$param['identifier'];
		    $res = $this->Curl_api->https_request($url);
          }
        }catch(Exception $e){}
      }

      $this->setActionLog('base_activity','SAVE','新增活动');
      echo json_encode(array('msg' => 1,'id' => $resp['data']['id'],'goodsType' => $resp['data']['goodsType']));
		}
		else
		{
			$param['id'] = $id;
      unset($param['goodsId']);
			$resp = $this->model->write('base_activity','update', $param);

      //更新活动搜索引擎
        try{
          $url = SCHOOLAPI."search/initsearchengine";
		    $url = $url.'?goodsType=2&identifier='.$param['identifier'];
		    $res = $this->Curl_api->https_request($url);
        }catch(Exception $e){}

      $this->setActionLog('base_activity','UPDATE','修改活动');
      echo json_encode(array('msg' => 1));
		}
	}

	//保存添加商品
	public function saveb(){
		$id = $this->queryVar('id');
		$goodsIds = $this->queryVar('goodsIds');
		$itemsArr = $this->queryVar('itemsArr');
		$itemsArr = $this->objarray_to_array(json_decode($itemsArr));

		if(!empty($goodsIds)){   //替换保存基本信息goodIds的占位符placeholder
      if(strrpos($goodsIds,'placeholder')>-1){
        $param['goodsIds'] = str_replace('placeholder','',$goodsIds);
      }else{
        $param['goodsIds'] = $goodsIds;
      }         
		}

		$param['id'] = $id;
		$resp = $this->model->read('base_activity','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$identifier = $this->trimall($identifier);
		$org_goodsIds = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

		//原活动商品数组
		if(strrpos($org_goodsIds,',')>-1){
			$org_goodsIds_arr = explode(',', $org_goodsIds);
		}else{
			$org_goodsIds_arr[0] = $org_goodsIds;			
		}

		//新保存活动商品数组
		if(strrpos($goodsIds,',')>-1){
			$new_goodsIds_arr = explode(',', $goodsIds);
		}else{
			$new_goodsIds_arr[0] = $goodsIds;			
		}

		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_activity','create', $param);
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_activity','update', $param);
		}

		//删除活动商品(删除数组没有包含的ids)
		$param_del = array('identifier' => $identifier,'goodsIds' =>$goodsIds );
		$resp_del = $this->model->write('base_activity','updateActivityGoodsById', $param_del);

		//var_dump($new_goodsIds_arr,$org_goodsIds_arr,$itemsArr);

		//匹配当前保存的活动商品
		foreach ($itemsArr as $k2 => $v2) {
			//新的活动商品ID,记录存在就更新
			if(in_array($v2['goodsId'],$org_goodsIds_arr)){
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
				$resp_up = $this->model->write('base_activity','updateActivityGoods', $param_up);
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
				$resp_up = $this->model->write('base_activity','insertActivityGoods', $param_up);
			}

		}
		if( $resp_up['status'] || $resp_del['status'] ){
	      //更新活动搜索引擎
	      try{
	        if($resp_up['status'] || $resp_del['status'] || $resp['status']){
	          $url = SCHOOLAPI."search/initsearchengine";
			  $url = $url.'?goodsType=2&identifier='.$identifier;
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
		$resp = $this->model->read('base_activity','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;
		if($goodsType==1){
			$goodsModel = $this->model->read('base_activity','queryGoods',$param_inner);
		}elseif($goodsType==0){
			$goodsModel = $this->model->read('base_activity','queryPreGoods',$param_inner);
		}
// var_dump($goodsModel);die();
		$total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
		$data  = array(
			'goodsType' => $goodsType,
			'goodsIds' => $param_inner['ids'],
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index')
		);
		$this->view($data,'base_activity/addgoods');
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
    $resp = $this->model->read('base_activity','getlist',$param);
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;
    if($goodsType==1){
      $goodsModel = $this->model->read('base_activity','queryGoods',$param_inner);
    }elseif($goodsType==0){
      $goodsModel = $this->model->read('base_activity','queryPreGoods',$param_inner);
    }

    $total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
    $data  = array(
      'goodsType' => $goodsType,
      'goodsIds' => $param_inner['ids'],
      'providerList' => $this->getProviderList(),
      'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'id' => $id,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index')
    );
    $this->view($data,'base_activity/addgoods_info');
  }
	
	public function ajaxAddgoods(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);

		//查询
		$id = $this->queryVar('id');
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$goodsType = $this->queryVar('goodsType');

		$param_inner = $param = array();
		$param['id'] = $id;

		if($key_type == 'goodsName'){             
			$param_inner['goodsName'] = $this->trimall($key);
		}
		if($key_type == 'providerId'){             
			$param_inner['providerId'] =  $this->trimall($key);
		}

		$param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_activity','getlist',$param);
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

		if($goodsType==1){
			$goodsModel = $this->model->read('base_activity','queryGoods',$param_inner);
		}elseif($goodsType==0){
			$goodsModel = $this->model->read('base_activity','queryPreGoods',$param_inner);
		}

		$data  = array(
			'goodsType' => $goodsType,
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);

		$this->view($data,'base_activity/ajaxaddgoods');  
	}

  public function ajaxAddgoods_info(){         

    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);  
    $page = $this->queryVar('page', 1);

    //查询
    $id = $this->queryVar('id');
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');
    $goodsType = $this->queryVar('goodsType');

    $param_inner = $param = array();
    $param['id'] = $id;

    if($key_type == 'goodsName'){             
      $param_inner['goodsName'] = $this->trimall($key);
    }
    if($key_type == 'providerId'){             
      $param_inner['providerId'] =  $this->trimall($key);
    }

    $param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_activity','getlist',$param);
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

    if($goodsType==1){
      $goodsModel = $this->model->read('base_activity','queryGoods',$param_inner);
    }elseif($goodsType==0){
      $goodsModel = $this->model->read('base_activity','queryPreGoods',$param_inner);
    }

    $data  = array(
      'goodsType' => $goodsType,
      'providerList' => $this->getProviderList(),
      'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'id' => $id,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );

    $this->view($data,'base_activity/ajaxaddgoods_info');  
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
		$ref = $this->queryVar('ref',APP_URL . 'base_activity/index');
		$param['id'] = $id;
		$resp = $this->model->write('base_activity','delete', $param);

    if($resp['status']){
      //更新活动搜索引擎
      try{
        if($resp['status']){
          $url = SCHOOLAPI."search/initsearchengine";
		  $url = $url.'?goodsType=2&identifier='.$resp['data']['identifier'];
		  $res = $this->Curl_api->https_request($url);
        }
      }catch(Exception $e){}
    }
    $this->setActionLog('base_activity','DELETE','删除活动');
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
      $param['goodsIds'] = $goodsIds;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    if($goodsType==1){
    	$resp = $this->model->read('base_activity','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_activity','getPreGoodsInfoListByPage',$param);
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
    $this->view($data,'base_activity/viewgoods');
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
      $param['goodsIds'] = $goodsIds;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    if($goodsType==1){
    	$resp = $this->model->read('base_activity','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_activity','getPreGoodsInfoListByPage',$param);
    }

    $data  = array(
    	'statusList' => $this->statusList(),
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_activity/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_activity/ajaxviewgoods');
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


