<?php

/**
 * 供应商管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.07.27
 * @version 1.0
 */

class admin_provider extends common
{
  /**
   * 初始化
   * 
   */
   
  public function __construct(){
    parent::__construct();
    $this->lib('assets');
    $this->helper('from'); 
  }

	
  /**
   * [viewProvider 弹窗加载供应商数据]
   * @return [type] [HTML]
   */
  public function viewProvider()
  {
    $this->lib('Pagination','page');

    //每页记录数
    $pagesize = 10;
    $page = $this->queryVar('page', 1);

    //查询
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');
    $providerName = $this->queryVar('providerName');
    $customerId=$this->queryVar('customerId');
    $mallType = $this->queryVar('mallType');
    $param = array();
    if(!empty($key_type)){
      $param['key_type'] = $key_type;
    }
    if(!empty($key)){
      $param['key'] = $key;
    }
    if(!empty($providerName)){
      $param['providerName'] = $providerName;
    }
    if(!empty($customerId)){
      $param['customerId'] = $customerId;
    }
    $param['providerType'] = $this->queryVar('providerType',1);
    $param['status'] = 2;
    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    $lm = $this->queryVar('lm');


    //获取总数

    $resp = $this->model->read('base_enterprise_info','getTotal',$param);

    $total = ($resp['status']) ? $resp['data'] : 0;
  
    
    $data  = array(
      'lm' => $lm,
      'mallType' => $mallType,
      'providerName' => $providerName,
      'providerType' => $param['providerType'],
      'customerId' =>$customerId,
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->func->curr_url()
    ); 
     
    $this->view($data,'admin_provider/viewprovider');
  }

  /**
   * [ajaxviewProvider 弹窗ajax加载供应商数据]
   * @return [type] [HTML]
   */
  public function ajaxViewProvider(){

    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');
    $providerName = $this->queryVar('providerName');
    $customerId=$this->queryVar('customerId');
    $mallType = $this->queryVar('mallType');
    $param = array();
    if(!empty($key_type)){
      $param['key_type'] = $key_type;
    }
    if(!empty($key)){
      $param['key'] = $key;
    }
    if(!empty($providerName)){
      $param['providerName'] = $providerName;
    }
    if(!empty($customerId)){
      $param['customerId'] = $customerId;
    }
    $param['providerType'] = $this->queryVar('providerType',1);
    $param['status'] = 2;
    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
    
    $resp = $this->model->read('base_enterprise_info','getItems',$param);
    $lm = $this->queryVar('lm');
    $data  = array(
      'lm' => $lm,
      'mallType' => $mallType,
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'admin_provider/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    $this->setActionLog('admin_provider','QUERY','查询供应商管理列表');
    $this->view($data,'admin_provider/ajaxviewprovider');
  }

  public function indexshop(){
    $this->lib('Pagination','page');

    //每页记录数
    $pagesize = 10;
    $page = $this->queryVar('page', 1);

    //查询
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');
    $providerName = $this->queryVar('providerName');
    $param = array();
    if(!empty($key_type)){
      $param['key_type'] = $key_type;
    }
    if(!empty($key)){
      $param['key'] = $key;
    }
    if(!empty($providerName)){
      $param['providerName'] = $providerName;
    }
    $param['providerType'] = 2;
    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;



    //获取总数

    $resp = $this->model->read('base_enterprise_info','getTotal',$param);

    $total = ($resp['status']) ? $resp['data'] : 0;
  
    
    $data  = array(
      'providerName' => $providerName,
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'total' => $total,
      'pageindex' => $page,
      'page' => $this->page->page($total,$pagesize),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->func->curr_url()
    ); 
     
    $this->view($data,'admin_provider/indexshop');
  }

  public function ajaxindexshop(){
    //每页记录数
    $pagesize = $this->queryVar('pagesize', 10);
    $page = $this->queryVar('page', 1);
    //查询
    $key_type = $this->queryVar('key_type');
    $key = $this->queryVar('key');
    $providerName = $this->queryVar('providerName');
    $param = array();
    if(!empty($key_type)){
      $param['key_type'] = $key_type;
    }
    if(!empty($key)){
      $param['key'] = $key;
    }
    if(!empty($providerName)){
      $param['providerName'] = $providerName;
    }

    $param['providerType'] = 2;
    $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

    $resp = $this->model->read('base_enterprise_info','getItems',$param);

    $data  = array(
      'list' => ($resp['status']) ? $resp['data'] : array(),
      'key_type' => $key_type,
      'key' => $key,
      'ref' => $this->queryVar('ref' , APP_URL . 'admin_provider/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
    );
    
    $this->view($data,'admin_provider/ajaxindexshop');
  }
  
  

  }
?>