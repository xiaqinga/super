<?php

/**
 * 物流
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class logistics extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
	}
	/**
	 * 运费模板列表
	 */
	public function index()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$name = $this->queryVar('name');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'logisticsName'){
			if(!empty($name)){
				$param['logisticsName'] = $name;
			}
		}
		if($searchname == 'expressCompanyName'){
			if(!empty($name)){
				$param['expressCompanyName'] = $name;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('logistics','getLogisticsCostList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'name' => $name,
			'ref' => $this->func->curr_url()
		);
		$data['searchnamelist'] = array(
			'logisticsName'=>'运费模板名称',
			'expressCompanyName'=>'快递公司'
		);
		$data['logisticsTypeList'] = $this->public_dict['logisticsType'];
		$this->setActionLog('logistics','QUERY','查看运费模板列表');
		$this->view($data,'logistics/index');
	}
	/**
	 * ajax请求运费模板列表
	 */
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$name = $this->queryVar('name');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'logisticsName'){
			if(!empty($name)){
				$param['logisticsName'] = $name;
			}
		}
		if($searchname == 'expressCompanyName'){
			if(!empty($name)){
				$param['expressCompanyName'] = $name;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('logistics','getLogisticsCostList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'name' => $name,
			'ref' => $this->queryVar('ref' , APP_URL . 'logistics/index?searchname='.$searchname.'&name='.$name.'&page='.$page)
		);
		$data['searchnamelist'] = array(
			'logisticsName'=>'运费模板名称',
			'expressCompanyName'=>'快递公司'
		);
		$data['logisticsTypeList'] = $this->public_dict['logisticsType'];
		$this->setActionLog('logistics','QUERY','查询运费模板列表');
		$this->view($data,'logistics/ajaxindex');
	}
	/**
	 * 查看运费模板
	 */
	public function info(){
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$resp = $this->model->read('logistics','getLogisticsCostList',$param);
		if($resp['status']){
			$data = $resp['data']['list'][0];
			$data['aeraCode'] = $this->getCityName($data['aeraCode']);
		}else{
			$data  = array(
				'id' => '',
				'logisticsName' => '',
				'aeraCode' => '',
				'logisticsCompanyId' => '',
				'logisticsType' => '',
				'priceType' => '',
				'areaCodeListStr' => ''
			);
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'logistics/courier');
		$data['emslist'] = $this->getEmsTree();
		$this->setActionLog('logistics','QUERY','查看运费模板详情');
		$this->view($data,'logistics/info');
	}
	/**
	 * 编辑运费模板
	 */
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'logisticsName' => '',
				'aeraCode' => '',
				'logisticsCompanyId' => '',
				'logisticsType' => '',
				'priceType' => '',
				'areaCodeListStr' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('logistics','getLogisticsCostList',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
				$data['aeraCode'] = $this->getCityIdList($data['aeraCode']);
			}else{
				$data  = array(
					'id' => '',
					'logisticsName' => '',
					'aeraCode' => '',
					'logisticsCompanyId' => '',
					'logisticsType' => '',
					'priceType' => '',
					'areaCodeListStr' => ''
				);
			}
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'logistics/courier');
		var_dump($data);
		$data['emslist'] = $this->getEmsTree();
		$this->view($data,'logistics/edit');
	}
	/**
	 * 保存运费模板信息
	 */
	public function save(){
		$id = $this->queryVar('id');
		$param['logisticsName'] = $this->queryVar('logisticsName');
		$aeraCode = $this->queryVar('aeraCode');
		$aeraCode=explode(",", $aeraCode);
		//获取最后一个/后边的字符
		$param['aeraCode']=$aeraCode[count($aeraCode)-1];
		$param['logisticsCompanyId'] = $this->queryVar('logisticsCompanyId');
		$param['logisticsType'] = $this->queryVar('logisticsType');
		$param['priceType'] = $this->queryVar('priceType');
		$areaCodeListKey = $this->queryVar('areaCodeListKey');
		if(!empty($areaCodeListKey)){
			foreach($areaCodeListKey as $key=>$val){
				$param['areaCodeListStr'][$key]['id'] = $this->queryVar('areaCodeListId'.$val);
				$param['areaCodeListStr'][$key]['areaCodeList'] = $this->queryVar('areaCodeList'.$val);
				$param['areaCodeListStr'][$key]['destinations'] = $this->queryVar('destinations'.$val);
				$param['areaCodeListStr'][$key]['firstItem'] = $this->queryVar('firstItem'.$val);
				$param['areaCodeListStr'][$key]['firstCost'] = $this->queryVar('firstCost'.$val);
				$param['areaCodeListStr'][$key]['addItem'] = $this->queryVar('addItem'.$val);
				$param['areaCodeListStr'][$key]['addCost'] = $this->queryVar('addCost'.$val);
			}
		}
		$ref = $this->queryVar('ref',APP_URL . 'logistics/courier');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('logistics','create', $param);
			$opt  = '添加';
			$this->setActionLog('logistics','SAVE','添加运费模板');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('logistics','update', $param);
			$opt  = '修改';
			$this->setActionLog('logistics','UPDATE','修改运费模板');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '运费模板'.$opt.'成功' : '运费模板'.$opt.'失败',
			'ref'=> $ref
		));
	}

	/**
	 * 删除运费模板信息
	 */
	public function delete()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'logistics/index');
		$param['id'] = $id;
		$resp = $this->model->write('logistics','delete', $param);
		$this->setActionLog('logistics','DELETE','删除运费模板');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '运费模板删除成功' : '运费模板删除失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 运费策略配置首页
	 */
	public function strategy()
	{
		$param['sysKey'] = 'freeMinConsumption';
		$resp = $this->model->read('logistics','getLogisticsCostconfig',$param);
		if($resp['status']){
			$data = $resp['data']['list'];
		}else{
			$data  = array(
				'id' => '',
				'sysKey' => '',
				'freeMinConsumption' => ''
			);
		}
		$this->setActionLog('logistics','QUERY','查看运费策略配置');
		$this->view($data,'logistics/strategy');
	}
	/**
	 * 保存运费策略配置
	 */
	public function saveCostconfig(){
		$id = $this->queryVar('id');
		$param['sysKey'] = 'freeMinConsumption';
		$param['sysValue'] = $this->queryVar('freeMinConsumption');
		$ref = $this->queryVar('ref',APP_URL . 'logistics/strategy');
		if( 0 == $id )
		{
			$resp = $this->model->write('logistics','createCostconfig', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('logistics','updateCostconfig', $param);
			$opt  = '修改';
		}
		$this->setActionLog('logistics','UPDATE','保存运费策略配置');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '最低消费金额'.$opt.'成功' : '最低消费金额'.$opt.'失败',
			'ref'=> $ref
		));
	}
	/**
	 * 快递公司列表
	 */
	public function courier(){
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$name = $this->queryVar('name');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'emsName'){
			if(!empty($name)){
				$param['emsName'] = $name;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('logistics','getEmsList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'searchname' => $searchname,
			'name' => $name,
			'ref' => $this->func->curr_url()
		);
		$data['searchnamelist'] = array(
			'emsName'=>'快递名称'
		);
		$this->setActionLog('logistics','QUERY','查看快递公司列表');
		$this->view($data,'logistics/courier');
	}
	/**
	 * ajax请求快递公司列表
	 */
	public function ajaxcourier(){
		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$name = $this->queryVar('name');
		$searchname = $this->queryVar('searchname');
		$param = array();
		if($searchname == 'emsName'){
			if(!empty($name)){
				$param['emsName'] = $name;
			}
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('logistics','getEmsList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'name' => $name,
			'ref' => $this->queryVar('ref' , APP_URL . 'logistics/courier?searchname='.$searchname.'&name='.$name.'&page='.$page)
		);
		$data['searchnamelist'] = array(
			'emsName'=>'快递名称'
		);
		$this->view($data,'logistics/ajaxcourier');
	}
	/**
	 * 编辑快递公司信息
	 */
	public function editcourier(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'emsCode' => '',
				'emsName' => '',
				'emsTel' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('logistics','getEmsList',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'emsCode' => '',
					'emsName' => '',
					'emsTel' => ''
				);
			}
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'logistics/courier');
		$this->view($data,'logistics/editcourier');
	}
	
	/**
	 * 保存快递公司信息
	 */
	public function savecourier(){
		$id = $this->queryVar('id');
		$param['emsCode'] = $this->queryVar('emsCode');
		$param['emsName'] = $this->queryVar('emsName');
		$param['emsTel'] = $this->queryVar('emsTel');
		$ref = $this->queryVar('ref',APP_URL . 'logistics/courier');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('logistics','createEms', $param);
			$opt  = '添加';
			$this->setActionLog('logistics','SAVE','添加快递公司');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('logistics','updateEms', $param);
			$opt  = '修改';
			$this->setActionLog('logistics','UPDATE','修改快递公司');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '快递公司'.$opt.'成功' : '快递公司'.$opt.'失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 删除快递公司
	 */
	public function deletecourier()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'logistics/courier');
		$param['id'] = $id;
		$resp = $this->model->write('logistics','deleteEms', $param);
		$this->setActionLog('logistics','DELETE','删除快递公司');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '快递公司删除成功' : '快递公司删除失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 获取物流公司ID对应物流公司名称的列表
	 */
	public function getEmsTree(){
		$treedata = array();
		$resp = $this->model->read('logistics','getEmsList');
		if($resp['status']){
			$data = $resp['data']['list'];
			foreach($data as $key=>$val){
				$treedata[$val['id']] = $val['emsName'];
			}
		}
		return $treedata;
	}
	
	/**
	 * 获取对应城市ID
	 */
	public function getCityIdList($aeraCode){
		$city_data = '';
		$param['id'] = $aeraCode;
		$resp = $this->model->read('city','getCityList', $param);

		if($resp['status'] == 1){
			$data = $resp['data']['list'][0];
			$city_data = $data['id'];
			if($data['sid'] != 0){
				$city_data = $this->getCityIdList($data['sid']).','.$city_data;
			}
		}
		return $city_data;
	}
	/**
	 * 获取对应城市名称
	 */
	public function getCityName($aeraCode){
		$city_data = '';
		$param['id'] = $aeraCode;
		$resp = $this->model->read('city','getCityList', $param);

		if($resp['status'] == 1){
			$data = $resp['data']['list'][0];
			$city_data = $data['cname'];
			if($data['sid'] != 0){
				$city_data = $this->getCityName($data['sid']).','.$city_data;
			}
		}
		return $city_data;
	}
	/**
	 * 获取运送范围中的城市列表信息
	 */
	public function eidtAreacodeList(){
		$areaCodes = $this->sess->get('areacodes');
		if(empty($areaCodes)){
			$id = $this->queryVar('id');
			$param = array();
			if(!empty($id)){
				$param['id'] = $id;
			}
			$areacodeListData = $this->model->read('logistics','getAreacodeList',$param);
			$ids = '';
			if($areacodeListData['status'] == 1){
				$ids = $areacodeListData['data']['list']['areaCodeList'];
			}
		}else{
			$ids = $areaCodes;
		}
		$data['cityListTrees'] = $this->getCityListTree($ids,0);
		$this->view($data,'logistics/eidtAreacodeList');
	}
	
	/**
	 * 获取城市列表树形结构
	 */
	public function getCityListTree($ids){
		$city_data = array();
		$ids = explode(',', $ids);
		$resp = $this->model->read('city','getCityList');
		if($resp['status'] == 1){
			foreach ($resp['data']['list'] as $key => $val) {
				$city_data[$key]['id'] = $val['id'];
				$city_data[$key]['name'] = $val['cname'];
				$city_data[$key]['pId'] = $val['sid'];
				if(!empty($ids) && in_array($val['id'],$ids)){
					$city_data[$key]['open'] = true;
					$city_data[$key]['checked'] = true;
				}else{
					$city_data[$key]['open'] = false;
					$city_data[$key]['checked'] = false;
				}
			}
		}

		return json_encode(array_values($city_data));
	} 

  /**
   * [viewCompany 弹窗加载物流数据]
   * wsbnet@qq.com
   * @return [type] [HTML]
   */
  public function viewFreight()
  {
    $this->lib('Pagination','page');

    //每页记录数
    $pagesize = 10;
    $page = $this->queryVar('page', 1);

    //查询
    $logisticsName = $this->queryVar('logisticsName');
    $expressCompanyName = $this->queryVar('expressCompanyName');
    $param = array();
    if(!empty($logisticsName)){
      $param['logisticsName'] = $logisticsName;
    }
    if(!empty($expressCompanyName)){
      $param['expressCompanyName'] = $expressCompanyName;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    $resp = $this->model->read('logistics','getLogisticsCostList',$param);

    //获取总数
    $total = ($resp['status']) ? $resp['data']['total'] : 0;

    $data  = array(
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'logisticsName' => $logisticsName,
      'expressCompanyName' => $expressCompanyName,
      'ref' => $this->func->curr_url()
    );
    $this->view($data,'logistics/viewfreight');
  }

  /**
   * [viewCompany 弹窗ajax加载物流数据]
   * wsbnet@qq.com
   * @return [type] [HTML]
   */
  public function ajaxViewFreight(){

    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $logisticsName = $this->queryVar('logisticsName');
    $expressCompanyName = $this->queryVar('expressCompanyName');
    $param = array();
    if(!empty($logisticsName)){
      $param['logisticsName'] = $logisticsName;
    }
    if(!empty($expressCompanyName)){
      $param['expressCompanyName'] = $expressCompanyName;
    }

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('logistics','getLogisticsCostList',$param);
    $data  = array(
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'logisticsName' => $logisticsName,
      'expressCompanyName' => $expressCompanyName,
      'ref' => urlencode($this->queryVar('ref' , APP_URL . 'logistics/index?logisticsName='.$logisticsName.'&expressCompanyName='.$expressCompanyName.'&page='.$page))
    );
    $this->view($data,'logistics/ajaxviewfreight');
  }
}