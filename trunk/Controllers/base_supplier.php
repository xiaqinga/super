<?php

/**
 * 供应商管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.08.01
 * @version 1.0
 */

class base_supplier extends common
{
  /**
   * 初始化
   * 
   */
   
  public function __construct(){
    parent::__construct();
    $this->lib('assets');
    $this->helper('from'); 
    $this->lib('Curl','Curl_api');
  }

	/**
	 * 获取企业列表
	 */
	public function index()
	{
    $this->lib('Pagination','page');

    //每页记录数
    $pagesize = 12;  //每页记录
    $page = $this->queryVar('page', 1); //当前页数

    //查找关键字
    $param = array(
      'providerName'  => $this->queryVar('providerName'),
      'corporate' => $this->queryVar('corporate'),
      'address' => $this->queryVar('address'),
      'status' => $this->queryVar('status'),
      'providerType' => 1,
      'accout' => $this->queryVar('accout'),
    );

    
    //获取总数
    $resp = $this->model->read('base_enterprise_info','getTotal',$param);
    $total = ($resp['status']) ? $resp['data'] : 0;
    //传递参数
    $data  = array(
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'ref' => $this->func->curr_url(),
      'providerName' => $param['providerName'],
      'corporate' => $param['corporate'],
      'address' => $param['address'],
      'status' => $param['status'],
      'accout' => $param['accout'],
      'searchname' => $this->queryVar('searchname',''),
      'searchnamelist'=> array('providerName' => '企业名称','corporate' => '法人代表','address' => '地址','status' => '状态','accout' => '捆绑账号' ),
      'statuslist'=> array(2 => '已审核', 1 => '待审核',3 => '已驳回')
    );
    $data['providerIdCur'] = $param['providerId'];
	  $this->setActionLog('base_supplier','QUERY','查询供应商管理列表');
    $this->view($data,'base_supplier/index');
	}

	/**
	 * ajax获取企业列表
	 *
	 */
	function ajaxIndex()
	{
    //状态
    $status = array(
      '1' => '待审核',
      '2' => '已审核' 
    );
    //每页记录数
    $pagesize = $this->queryVar('pagesize', 12); //每页记录
    $page = $this->queryVar('page', 1); //当前页数
    //查询条件
    $param['providerName'] = $providerName = $this->queryVar('providerName');
    $param['corporate'] = $corporate = $this->queryVar('corporate');
    $param['address'] = $address = $this->queryVar('address');
    $param['status'] = $status = $this->queryVar('status');
    $param['providerType'] = 1;
    $param['accout'] = $accout = $this->queryVar('accout');

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_enterprise_info','getItems',$param);

    //传递参数
    $data  = array(
      'status' => $status,
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'providerName' => $providerName,
      'corporate' => $corporate,
      'address' => $address,
      'accout' => $accout,
      'statuslist'=> array(2 => '已审核', 1 => '待审核',3 => '已驳回'),
      'ref' => $this->queryVar('ref' , APP_URL . 'base_supplier/index?providerName='.$providerName.'&corporate='.$corporate.'&page='.$page)
    );
    $this->view($data,'base_supplier/ajaxindex');
	}

  /**
   * 查看企业详情
   */
  function info()
  {
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('base_enterprise_info','getItem',$param);
      if($resp['status']){
        $data = $resp['data'];
      }
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_supplier/index');

    //当前省市区
    $pro['code']=$data['provinceCode'];
    $city['code']=$data['cityCode'];
    $area['code']=$data['areaCode'];
    $provinceCurList = $this->getProvinceList($pro);
    $cityCurList = $this->getCityList($city);
    $areaCurList = $this->getAreaList($area);
    $province_cur = $provinceCurList['status']==1?$provinceCurList['data']['list'][0]:null;
    $city_cur = $cityCurList['status']==1?$cityCurList['data']['list'][0]:null;
    $area_cur = $areaCurList['status']==1?$areaCurList['data']['list'][0]:null;



    $data['province_cur'] = $province_cur;
    $data['city_cur'] = $city_cur;
    $data['area_cur'] = $area_cur;


    $data['providerTypes'] =$this->public_dict['providerTypes'];
    $this->setActionLog('base_supplier','QUERY','查看供应商详情');
    $this->view($data,'base_supplier/info');
  }

	/**
	 * 编辑企业
	 */
	function edit()
	{
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('base_enterprise_info','getItem',$param);
      if($resp['status']){
        $data = $resp['data'];
        $qq = explode(',',$data['rotationPhotoIds']);
        foreach ($qq as $value) {
          $photo = $this->model->read('base_enterprise_info','findphoto',$value);
     
          if ($photo['status']) {
            $photo_resp[] = $photo['data']['0'];
          }
        }
        // var_dump($photo_resp);die();
        $data['main_photos'] = $photo_resp;
      }
    }else{
      $data['providerType']=1;
    }


    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_supplier/index');

    //当前省市区
    if($data['provinceCode']){
      $pro['code']=$data['provinceCode'];
      $provinceCurList = $this->getProvinceList($pro);
    }
    if($data['cityCode']){
      $city['code']=$data['cityCode'];
      $cityCurList = $this->getCityList($city);
    }
    if($data['areaCode']){
      $area['code']=$data['areaCode'];
      $areaCurList = $this->getAreaList($area);
    }
    $province_cur = $provinceCurList['status']==1?$provinceCurList['data']['list'][0]:null;
    $city_cur = $cityCurList['status']==1?$cityCurList['data']['list'][0]:null;
    $area_cur = $areaCurList['status']==1?$areaCurList['data']['list'][0]:null;

    $provinceList = $this->getProvinceList();//显示所有省份
    
    //下拉菜单省市区
    if($data['provinceCode']){
      $drop_pro['provinceCode']=$data['provinceCode'];
      $cityList = $this->getCityList($drop_pro);//当前省份所有城市
    }
    if($data['cityCode']){
      $drop_city['cityCode']=$data['cityCode'];
      $areaList = $this->getAreaList($drop_city);//当前城市所有县区
    }

    $data['provinceList'] = $provinceList['status']==1?$provinceList['data']['list']:null;
    $data['cityList'] = $cityList['status']==1?$cityList['data']['list']:null;
    $data['areaList'] = $areaList['status']==1?$areaList['data']['list']:null;

    $data['province_cur'] = $province_cur;
    $data['city_cur'] = $city_cur;
    $data['area_cur'] = $area_cur;

    // var_dump($province_cur);die();
    $data['providerTypes'] =$this->public_dict['providerTypes'];
    $this->view($data,'base_supplier/edit');
	}

	/**
	 * 企业保存(添加 )
	 */
	function save()
	{
    $id = $this->queryVar('id');
    $ref = $this->queryVar('ref',APP_URL . 'base_supplier/index');
    $ref = urldecode($ref);

    // $param['providerCode'] = $this->queryVar('providerCode');
    $param['providerName'] = $this->queryVar('providerName');
    $param['providerType'] = $this->queryVar('providerType');
    $param['photoUrl'] = $this->queryVar('photoUrl');
    $param['crePhotoUrl'] = $this->queryVar('crePhotoUrl',0);
    $param['taxPhotoUrl'] = $this->queryVar('taxPhotoUrl',0);

    $param['linkman'] = $this->queryVar('linkman');
    $param['mobilePhone'] = $this->queryVar('mobilePhone');
    $param['telPhone'] = $this->queryVar('telPhone');
    $param['fax'] = $this->queryVar('fax');
    $param['email'] = $this->queryVar('email');
    $param['address'] = $this->queryVar('address');
    $param['description'] = $this->queryVar('description');
    $param['status'] = $this->queryVar('status_radio',1);

    $param['corporate'] = $this->queryVar('corporate');
    $param['lockPhone'] = $this->queryVar('lockPhone');
    $param['industry'] = $this->queryVar('industry');
    $param['industryCode'] = $this->queryVar('industryCode');
    $param['product'] = $this->queryVar('product');
    $param['creditCode'] = $this->queryVar('creditCode');
    $param['taxCode'] = $this->queryVar('taxCode');
    $param['website'] = $this->queryVar('website');
    $param['provinceCode'] = $this->queryVar('provinceCode');
    $param['cityCode'] = $this->queryVar('cityCode');
    $param['areaCode'] = $this->queryVar('areaCode');
    $param['reject'] = $this->queryVar('reject');
    // $param['customerId'] = $this->queryVar('customerId');
    // $param['isStudent'] = $this->queryVar('isStudent');
    $main_photos = $this->queryVar('listphote');
    $main_photos = array_filter(json_decode($main_photos,true));

      if(count($main_photos)>0){
        foreach ($main_photos as $key => $value) {
          if(!$value['id']){
            $param1 = array(
              'photoName' => $value['photoName'], 
              'photoPath' => $value['photoPath'],

            );
            $resp = $this->model->write('base_photo','create', $param1);
            $last_id[] = $resp['last_id'];
            if($resp['status']){$ok = true;}
          }else{
            //更新
            $param1 = array(
              'id' => $value['id'],
              'photoName' => $value['photoName'], 
              'photoPath' => $value['photoPath'],
              
            );
            $resp = $this->model->write('base_photo','update', $param1);
            $last_id[] = $value['id'];
            if($resp['status']){$ok = true;}
          }
          
        }

        $param['rotationPhotoIds'] = implode(',',$last_id);
      }
     
      if(!$id){
        $param['createUser'] = $this->sess->get('id');
        $param['createTime'] = date('Y-m-d H:i:s');
        $resp = $this->model->write('base_enterprise_info','create', $param);
        $infos['refId'] = $resp['data']['id'];
        $infos['providerType'] =  $param['providerType'];
        $ref_pro = $this->model->write('base_enterprise_info','providerref',$infos);
        if($resp['status'] == '0'){
          $qq = explode(',',$param['rotationPhotoIds']);
          foreach ($qq as $value) {
            $removePhoto = $this->model->write('base_enterprise_info','deletePhoto',$value);
          }
        }
        $opt  = '添加';
  	    $this->setActionLog('base_enterprise_info','SAVE','新增企业');
      }else{

        $param['id'] = $id;
        $info = $this->model->read('base_enterprise_info','findrotation',$param['id']);
        $param['updateUser'] = $this->sess->get('id');
        if($param['status'] == '1'){
          $param['updateTime'] = null;
        }elseif (($param['status'] == '2')) {
          $param['updateTime'] = date('Y-m-d H:i:s');
          $this->setIntegral($info['data'][0]['customerId']);
        }
        $resp = $this->model->write('base_enterprise_info','update', $param);
           //修改中间表
        $infos['refId'] = $id;
        $infos['providerType'] =  $param['providerType'];
        
        $ref_pro = $this->model->write('base_enterprise_info','providerref',$infos);
        $opt  = '修改';
  	    $this->setActionLog('base_supplier','UPDATE','修改供应商');
      }
      
      // if($isStudent != $param['isStudent']){
        //新增/修改商品搜索引擎
        try{
          if($resp['status']){
            $url = SCHOOLAPI."search/insertsearchengine";
            $url = $url.'?goodsType=1';
            $res = $this->Curl_api->https_request($url);
          }
        }catch(Exception $e){}
      // }
      
      $this->jsonout($resp['status'],array(
        'msg'=>($resp['status']) ? '企业'.$opt.'成功' : '企业'.$opt.'没更新',
        'ref'=> $ref
      ));
	}
  public function setIntegral($id){
    $list=$this->model->read('customer_list','findParent',array('id'=>$id));
    if($list['status']){
      $param['id']=$list['data']['0']['id'];
      $makerLevel=$list['data']['0']['makerLevel'];
      // $makerLevel = $list['makerLevel'];
      if($makerLevel){
        switch($makerLevel){
          case 1:
            $where['sysKey'] = 'GOLD_PROVIDER_SLIVER_SCORE';
            $data = $this->model->read('member_wallet','getBaseConfig',$where);
            $param['remainingSilverScore']=$data['list']['sysValue'];
            $param['accumulaSilverScore']=$data['list']['sysValue'];
            break;
          case 2:
            $where['sysKey'] = 'SILVER_PROVIDER_SLIVER_SCORE';
            $data = $this->model->read('member_wallet','getBaseConfig',$where);
            $param['remainingSilverScore']=$data['list']['sysValue'];
            $param['accumulaSilverScore']=$data['list']['sysValue'];
            break;
        }

        $this->model->write('member_wallet','setIntegral',$param);
        $a = rand(0,9);
        for ($i=0; $i < 4 ; $i++) { 
          $a = rand(0,9);
          $b.=$a;
        }
        list($u,$y) = explode(' ',microtime());
        $emsNo = ((float)$u+(float)$y);
        $emsNo = str_replace('.','',$emsNo);
        $emsNo = substr($emsNo, 0,-1);
        $emsNos = $emsNo.$b;
        $detail['customerId'] = $param['id'];
        $detail['inCome'] = $param['remainingSilverScore'];
        $detail['fromType'] = 7;
        $detail['orderType'] = 6;
        $detail['commet'] = $data['list']['sysDescribe'];
        $detail['createDate'] = date('Y-m-d H:i:s');
        $detail['emsNo'] = $emsNos;
        $this->model->write('member_wallet','setIncomeDetail',$detail);

      }
    }

  }
  public function photoDelete(){
    $id = $this->queryVar('id');
    $infoid = $this->queryVar('infoid');
   
    $ref = $this->queryVar('ref',APP_URL . 'base_supplier/index');
    $ref = urldecode($ref);
    $param['id'] = $id;
 

    $info = $this->model->read('base_enterprise_info','findrotation',$infoid);
    $qq = explode(',',$info['data'][0]['rotationPhotoIds']);
    foreach ($qq as $value) {
      if ($value == $id) {
        unset($value);
      }else{
        $array[] = $value;
      }
    }
    $where['rotationPhotoIds'] = implode(',',$array);
    $where['id'] = $infoid;
    $this->model->write('base_enterprise_info','update',$where);

    $resp = $this->model->write('base_photo','delete', $param);
    $this->jsonout($resp['status'],array(
      'status'=> 1,
      'msg'=>'图片删除成功',
      'ref'=> $ref
    ));
  }

  public function delete(){
    $id = $this->queryVar('ids');
    $ref = $this->queryVar('ref',APP_URL . 'base_supplier/index');
    $ref = urldecode($ref);
    $param['id'] = $id;
    $info = $this->model->read('base_enterprise_info','findrotation',$id);
    if($info['data'][0]['rotationPhotoIds']){
      $this->model->write('base_photo','delete',array('id'=>$info['data'][0]['rotationPhotoIds']));
    };
    
    $resp = $this->model->write('base_enterprise_info','delete', $param);
    
    $this->setActionLog('base_supplier','DELETE','删除供应商');
    $this->jsonout($resp['status'],array(
      'msg'=>($resp['status']) ? '供应商删除成功' : '供应商删除失败',
      'ref'=> $ref
    ));
  }

  

  public function viewIndustry(){
  	$data['industry_list'] = $this->public_dict['industry_list'];
	$this->view($data,'base_supplier/viewIndustry');
  }

  public function viewstudents(){
    $this->lib('Pagination','page');
    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $param['realName'] = $this->queryVar('realName');

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_enterprise_info','getStuInfo',$param);
    $total = ($resp['status']) ? $resp['data']['total'] : 0;
    // var_dump($total);exit();
    $data  = array(
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'ref' => $this->func->curr_url()
    );
    $this->view($data,'base_supplier/viewstudents');

  }

  public function ajaxStudents(){
    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $param['realName'] = $this->queryVar('realName');

    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $resp = $this->model->read('base_enterprise_info','getStuInfo',$param);
    $data  = array(
      'list' => ($resp['status']) ? $resp['data']['list'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'base_supplier/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->view($data,'base_supplier/ajaxviewstudents');
  }

  public function setProviderName(){
    $param['providerName'] = $this->queryVar('providerName');
    $param['id'] = $this->queryVar('id');

    $data = $this->model->read("base_enterprise_info",'proving',$param);
    if($data['status']=='1'){
        echo json_encode(array('msg'=>1));
    }else{
        echo json_encode(array('msg'=>0));
    }
  }

}
?>