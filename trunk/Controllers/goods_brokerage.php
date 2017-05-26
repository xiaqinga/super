<?php

/**
 * 积分表
 *
 */
 
class goods_brokerage extends common {
		
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
		$goodsName = $this->queryVar('goodsName');
		$providerId = $this->queryVar('providerId');
		$param = array();
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		if(!empty($providerId)){
			$param['providerId'] = $providerId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

		$resp = $this->model->read('goods_brokerage','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(			
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'goodsName' => $goodsName,
			'providerId' => $providerId,
			'ref' => $this->func->curr_url(),
			'providerlist'=>$this->model->read('base_enterprise_info','providerlist')
		);
        //var_dump($data['providerlist']);
		$this->view($data,'goods_brokerage/index');
	}

	public function ajaxIndex(){         

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);  
		$page = $this->queryVar('page', 1);
		//查询
		$goodsName = $this->queryVar('goodsName');
		$providerId = $this->queryVar('providerId');
		$param = array();
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		if(!empty($providerId)){
			$param['providerId'] = $providerId;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goods_brokerage','getlist',$param);
		$data  = array(
			'goodsName' =>$goodsName,
			'providerId' => $providerId,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_brokerage/index?key_type='.$key_type.'&key='.$key.'&page='.$page)

		);
		
		$this->setActionLog('goods_brokerage','QUERY','查询金商城积分');
		$this->view($data,'goods_brokerage/ajaxindex');  
		$data = urldecode($data);
	
	}
	


	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_brokerage','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_brokerage/index');
		$this->view($data,'goods_brokerage/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$goodsid = $this->queryVar('goodsid');
		$param['pointsType'] = $this->queryVar('pointsType');
		$param['points'] = $this->queryVar('points');
		$param['pointsPercent'] = $this->queryVar('pointsPercent');

		if($param['pointsType']=='1'){
			$param['points'] = $this->queryVar('points');
			$param['pointsPercent'] = 0;
		}else if ($param['pointsType']=='2') {
			$param['points'] = 0;
			$param['pointsPercent'] = $this->queryVar('pointsPercent');
		}
		$ref = $this->queryVar('ref',APP_URL . 'goods_brokerage/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goods_brokerage','create', $param);
			$opt  = '添加';
			$this->setActionLog('goods_brokerage','SAVE','添加金商城积分');
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('goods_brokerage','update', $param);
			$opt  = '修改';
			$this->setActionLog('goods_brokerage','UPDATE','修改金商城积分');
		}
		//新增/修改商品搜索引擎
		try{
			if($resp['status']){
			    $url = SCHOOLAPI."goods/insertsearchengine";
			    $url = $url.'?goodsType=1&identifier=COMMON_GOODS&value='.$goodsid;
			    $res = $this->Curl_api->https_request($url);

				}
		}catch(Exception $e){}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '积分信息'.$opt.'成功' : '积分信息失败',
			'ref'=> $ref
		));
	}
	

	public function info()
	{
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('goods_brokerage','getlist',$param);
      if($resp['status']){
        $data['attr'] = $resp['data']['list'][0];
      }
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_brokerage/index');
    $this->setActionLog('goods_brokerage','QUERY','查询金商城积分详情');
    $this->view($data,'goods_brokerage/info');
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_brokerage/index');
		$param['id'] = $id;
		$resp = $this->model->write('goods_brokerage','delete', $param);
		$this->setActionLog('goods_brokerage','DELETE','删除金商城积分');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '佣金信息删除成功' : '佣金信息删除失败',
			'ref'=> urldecode($ref),
	
		));
	}
}