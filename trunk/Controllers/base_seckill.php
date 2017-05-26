<?php

/**
 * 活动管理-秒抢专区
 *
 */
 
class base_seckill extends common {
		
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

		$resp = $this->model->read('base_seckill','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index'),
			'bid' => $resp['data']['list'][0]['bid']
		);
    	// $this->setActionLog('base_seckill','QUERY','查看活动列表');
		$this->view($data,'base_seckill/index');
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
		$resp = $this->model->read('base_seckill','getlist',$param);
		$data['bid'] = $resp['bid'];
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index?key_type='.$key_type.'&key='.$key.'&page='.$page),
			
		);


		$this->view($data,'base_seckill/ajaxindex');  
	}

	public function ordinary(){
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

		$resp = $this->model->read('base_seckill','getptlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/ordinary'),
			'bid' => $resp['data']['list'][0]['bid']
		);
    	// $this->setActionLog('base_seckill','QUERY','查看活动列表');
		$this->view($data,'base_seckill/ordinary');
	}

	public function ajaxordinary(){
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
		$resp = $this->model->read('base_seckill','getptlist',$param);

		$data['bid'] = $resp['bid'];
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/ordinary?key_type='.$key_type.'&key='.$key.'&page='.$page),
			
		);


		$this->view($data,'base_seckill/ajaxordinary'); 
	}

	//基本信息
	public function edit(){

    	$goodsType = $this->queryVar('goodsType');
    	if ($goodsType == 1) {
    		$resp = $this->model->read('base_seckill','getptseckill');
    		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_seckill/ordinary');
    	}elseif($goodsType == 0){
    		$resp = $this->model->read('base_seckill','getseckill');
    		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_seckill/index');
    	}
		$data['attr'] = $resp[0];

		$data['id'] = $resp[0]['id'];
		$this->view($data,'base_seckill/edit');
	}


	public function save(){
		$param['id'] = $this->queryVar('id');
		$param['seckillName'] = $this->queryVar('seckillName');
		$param['activityExpalin'] = $this->queryVar('activityExpalin');
		$param['goodsRestrictions'] = $this->queryVar('goodsRestrictions');
		$ref = $this->queryVar('ref',APP_URL . 'base_seckill/index');
		$ref = urldecode($ref);
		$resp = $this->model->write('base_seckill','update', $param);

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '秒抢信息修改成功' : '秒抢信息未更改',
			'ref'=> $ref
		));
		
	}

	public function saveb(){
		$goodsType = $this->queryVar('goodsType');
		$param['id'] = $id = $this->queryVar('id');
		$goodsIds = $this->queryVar('goodsIds');
		$itemsArr = $this->queryVar('itemsArr');
		$itemsArr = $this->objarray_to_array(json_decode($itemsArr));

		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
    $param['goodsIds'] = $this->queryVar('goodsIds','placeholder');

		if (!empty($startDate) && !empty($endDate)){
      $param_times['startDate'] = $startDate;
      $param_times['endDate'] = $endDate;
			$timeP = $this->model->read('base_seckill','seckillTime',$param_times);

      if($timeP['status']){
        echo json_encode(array('msg' => false,'rec' => true));
        exit;
      }
		}

		$identifier = 0;
		if(!empty($goodsIds)){   //替换保存基本信息goodIds的占位符placeholder
      if(strrpos($goodsIds,'placeholder')>-1){
        $param['goodsIds'] = str_replace('placeholder','',$goodsIds);
      }else{
        $param['goodsIds'] = $goodsIds;
      }         
		}
		if ($goodsType == 1) {
    		$identifier_model = $this->model->read('base_seckill','getptseckill');
    	}elseif($goodsType == 0){
    		$identifier_model = $this->model->read('base_seckill','getseckill');
    	}
	
		$identifier = $identifier_model[0]['identifier'];
		$identifier = $this->trimall($identifier);

    if(!empty($id)){
      $resp = $this->model->read('base_seckill','getlist',$param);
      $org_goodsIds = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;
    }else{
      $org_goodsIds = '';
    }

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

		if(!$id){
			$param_insert['identifier'] = $identifier;
			$param_insert['createUser'] = $this->sess->get('id');
			$param_insert['createDate'] = date('Y-m-d H:i:s');
		      $param_insert['startDate'] = $startDate;
		      $param_insert['endDate'] = $endDate;
		      $param_insert['goodsIds'] = $goodsIds;
			$resp = $this->model->write('base_seckill','create', $param_insert);
      		$id = $resp['data']['id'];
		}else{
			$param_update = array(
		        'id' => $id,
		        'goodsIds' => $goodsIds
		      );
			$resp = $this->model->write('base_seckill','timesUpdate', $param_update);
		}


		//匹配当前保存的活动商品
		foreach ($itemsArr as $k2 => $v2) {
			//新的活动商品ID,记录存在就更新
			if(in_array($v2['goodsId'],$org_goodsIds_arr)){
				$param_up = array(
					'goodsName' => $v2['goodsName'],
					'seckillTimesId' => $id,
					'originalPrice' => $v2['originalPrice'],
					'seckillPrice' =>$v2['activityPrice'],
					'seckillNum' =>$v2['activityNum'],
					'updateUser' =>$this->sess->get('id'),
					'identifier' =>$identifier,
					'goodsId' => $v2['goodsId']
				);
				$resp_up = $this->model->write('base_seckill','updateActivityGoods', $param_up);
			}else{ //不存在就插入
				$param_up = array(
					'goodsName' => $v2['goodsName'],
					'seckillTimesId' => $id,
					'identifier' => $identifier,
					'goodsId' => $v2['goodsId'],
					'originalPrice' => $v2['originalPrice'],
					'seckillPrice' => $v2['activityPrice'],
					'seckillNum' => $v2['activityNum'],
					'createDate' => date('Y-m-d H:i:s'),
					'createUser' => $this->sess->get('id'),
					'updateDate' => date('Y-m-d H:i:s'),
					'updateUser' => $this->sess->get('id'),
				);
				$resp_up = $this->model->write('base_seckill','insertActivityGoods', $param_up);
			}

		}

		if( $resp_up['status'] || $resp_del['status'] ){
			echo json_encode(array('msg' => true,'goodsType' => $goodsType));
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
    if(!empty($id)){
      $param_inner = $param = array();
      $param['id'] = $id;

      // var_dump($goodsType.'///'.$id);die();
      if($key_type == 'goodsName'){             
        $param_inner['goodsName'] =  $this->trimall($key);
      }
      if($key_type == 'providerId'){             
        $param_inner['providerId'] =  $this->trimall($key);
      }

      $param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
      if ($goodsType == 1) {
      	$resp = $this->model->read('base_seckill','getptlist',$param);
      }elseif($goodsType == 0){
		$resp = $this->model->read('base_seckill','getlist',$param);
      }

      $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
     
      $param_inner['identifier'] = $this->trimall($identifier);
      $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;
      if($goodsType==1){
		  $goodsModel = $this->model->read('base_seckill','queryGoods',$param_inner);
		}elseif($goodsType==0){
		  $goodsModel = $this->model->read('base_seckill','queryPreGoods',$param_inner);
		}
      // var_dump($goodsModel);die();
      $total = ($goodsModel['status']) ? $goodsModel['data']['total'] : 0;
      $data  = array(
        'goodsType' => $goodsType,
        'goodsIds' => $param_inner['ids'],
        'providerList' => $this->getProviderList(),
        'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
        'startDate' => $resp['data']['list']['0']['startDate'],
        'endDate' => $resp['data']['list']['0']['endDate'],
        'total' => $total,
        'pageindex' => $page,
        'page' => $this->page->page($total,$pagesize),
        'key_type' => $key_type,
        'key' => $key,
        'id' => $id,
        'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index')
      );
    }else{
      $total = 0; 
      $page = 1;
      $data  = array(
      	'goodsType' => $goodsType,
        'total' => $total,
        'pageindex' => $page,
        'page' => $this->page->page($total,$pagesize),
        'key_type' => $key_type,
        'key' => $key,
        'id' => $id,
        'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index')
      );
    }

		$this->view($data,'base_seckill/addgoods');
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
    if ($goodsType == 1) {
      	$resp = $this->model->read('base_seckill','getptlist',$param);
      }elseif($goodsType == 0){
		$resp = $this->model->read('base_seckill','getlist',$param);
      }
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

    if($goodsType==1){
      $goodsModel = $this->model->read('base_seckill','queryGoods',$param_inner);
    }elseif($goodsType==0){
      $goodsModel = $this->model->read('base_seckill','queryPreGoods',$param_inner);
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
      'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index')
    );
    $this->view($data,'base_seckill/addgoods_info');
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
		$param_inner['tid'] = $id;
		$param_inner['limit'] = ($page-1)*$pagesize.','.$pagesize;
		if ($goodsType == 1) {
	      	$resp = $this->model->read('base_seckill','getptlist',$param);
	      }elseif($goodsType == 0){
			$resp = $this->model->read('base_seckill','getlist',$param);
	      }
		$identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
		$param_inner['identifier'] = $this->trimall($identifier);
		$param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

		if($goodsType==1){
			$goodsModel = $this->model->read('base_seckill','queryGoods',$param_inner);
		}elseif($goodsType==0){
			$goodsModel = $this->model->read('base_seckill','queryPreGoods',$param_inner);
		}

		$data  = array(
			'goodsType' => $goodsType,
			'providerList' => $this->getProviderList(),
			'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'id' => $id,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/addGoods?&id='.$id.'key_type='.$key_type.'&key='.$key.'&page='.$page)
		);

		$this->view($data,'base_seckill/ajaxaddgoods');  
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
    if ($goodsType == 1) {
      	$resp = $this->model->read('base_seckill','getptlist',$param);
      }elseif($goodsType == 0){
		$resp = $this->model->read('base_seckill','getlist',$param);
      }
    $identifier = ($resp['status']) ? $resp['data']['list'][0]['identifier'] : 0;
    $param_inner['identifier'] = $this->trimall($identifier);
    $param_inner['ids'] = ($resp['status']) ? $resp['data']['list'][0]['goodsIds'] : 0;

    if($goodsType==1){
      $goodsModel = $this->model->read('base_seckill','queryGoods',$param_inner);
    }elseif($goodsType==0){
      $goodsModel = $this->model->read('base_seckill','queryPreGoods',$param_inner);
    }

    $data  = array(
      'goodsType' => $goodsType,
      'providerList' => $this->getProviderList(),
      'list' => ($goodsModel['status']) ? $goodsModel['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'id' => $id,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );

    $this->view($data,'base_seckill/ajaxaddgoods_info');  
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
		$ref = $this->queryVar('ref',APP_URL . 'base_seckill/index');
		$param['id'] = $id;
		$resp = $this->model->write('base_seckill','delete', $param);

    $this->setActionLog('base_activity','DELETE','删除秒抢');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '删除成功' : '删除失败',
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
    	$resp = $this->model->read('base_seckill','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_seckill','getPreGoodsInfoListByPage',$param);
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
    $this->view($data,'base_seckill/viewgoods');
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
    	$resp = $this->model->read('base_seckill','getGoodsInfoListByPage',$param);
    }else{
    	$resp = $this->model->read('base_seckill','getPreGoodsInfoListByPage',$param);
    }

    $data  = array(
    	'statusList' => $this->statusList(),
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_seckill/ajaxviewgoods');
  }

  public function statusList(){
  	$arrayName = array(
			1 => '上架',
			0 => '删除',
			2 => '下架'
  	);
  	return $arrayName;
  }

  public function info(){
  	$param['id'] = $this->queryVar('id');
  	$param['goodsType'] = $this->queryVar('goodsType');
  	$pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    // var_dump($param);die();
    $resp = $this->model->read('base_seckill','getTimes',$param);
    
    $data = array(
    	'startDate' => $resp['data']['times']['startDate'],
    	'endDate' => $resp['data']['times']['endDate'],
    	'goods' => $resp['data']['goods'],
    	'ref' => $this->queryVar('ref' , APP_URL . 'base_seckill/index')
    );
// var_dump($data);die();
    $this->view($data,'base_seckill/info');
  }

  public function upstore(){
		$id = $this->queryVar('ids');
		$array = explode(',',$id);
		$ref = APP_URL . 'base_seckill/addGoods?&id='.$array[2].'&goodsType='.$array[1];
		$ref = urldecode($ref);
		$param['id'] = $array[0];
		$resp = $this->model->write('base_seckill','upstore', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品启用成功' : '商品启用失败',
			'ref'=> $ref
		));
	}

	public function downstore(){
		$id = $this->queryVar('ids');
		$array = explode(',',$id);
		$ref = APP_URL . 'base_seckill/addGoods?&id='.$array[2].'&goodsType='.$array[1];
		$ref = urldecode($ref);
		$param['id'] = $array[0];
		$resp = $this->model->write('base_seckill','downstore', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品禁用成功' : '商品禁用失败',
			'ref'=> $ref
		));
	}
}