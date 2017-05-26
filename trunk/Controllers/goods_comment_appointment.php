<?php

/**
 * 评论管理
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class goods_comment_appointment extends common {
		
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
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
	
		//查询
		$param = array();
		
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if(!empty($startDate)){
			$param['startDate'] = $startDate;
		}
		if(!empty($endDate)){
			$param['endDate'] = $endDate;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$param['providerType'] =2;
		$resp = $this->model->read('goods_comment','getlist',$param);

		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' =>$key_type,
			'key' =>$key,
			'startDate' =>$startDate,
			'endDate' =>$endDate,
			'ref' => $this->func->curr_url()
		);


		$this->view($data,'goods_comment_appointment/index');

	}

	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$startDate = $this->queryVar('startDate');
		$endDate = $this->queryVar('endDate');
	
		$param = array();
		$param['goodsType'] = "2";
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if(!empty($key)){
			$param['key'] = $key;
		}
		if(!empty($startDate)){
			$param['startDate'] = $startDate;
		}
		if(!empty($endDate)){
			$param['endDate'] = $endDate;
		}
		$param['goodsType'] = "pre";
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$param['providerType'] =2;
		$resp = $this->model->read('goods_comment','getlist',$param);
		if($resp['status']){
			foreach ($resp['data']['list'] as $key => $value) {
				$photoPath = [];
				if(strpos($value['photoIds'],',')>-1){
					$photoIds = explode(',',$value['photoIds']);
					foreach ($photoIds as $k => $v) {
						if($v != 'undefined'){
							$param['id'] = $v;
							$resp_inner = $this->model->read('goods_photo','getlist',$param);
							if($resp_inner['status']){
								$photoPath[] = $resp_inner['data']['list'][0]['photoPath'];
							}
						}
					}
					$resp['data']['list'][$key]['photoPath'] = $photoPath;
				}elseif( !empty($value['photoIds']) ){
					$photoIds = $value['photoIds'];
					if($photoIds != 'undefined'){
						$param['id'] = $photoIds;
						$resp_inner = $this->model->read('goods_photo','getlist',$param);
						if($resp_inner['status']){
							$photoPath[0] = $resp_inner['data']['list'][0]['photoPath'];
							$resp['data']['list'][$key]['photoPath'] = $photoPath;
						}
					}
				}
			}
		}
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' =>$key_type,
			'key' =>$key,
			'startDate' =>$startDate,
			'endDate' =>$endDate,
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_comment_appointment/index?key_type='.$key_type.'&key='.$key.'&startDate='.$startDate.'&endDate='.$startDate.'&page='.$page)
		);
		$this->setActionLog('goods_comment_appointment','QUERY','查询联盟商评论列表');
		
		$this->view($data,'goods_comment_appointment/ajaxindex');
	}

	

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_comment_appointment/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_comment_appointment','delete', $param);
		$this->setActionLog('goods_comment_appointment','DELETE','删除联盟商评论');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '评论删除成功' : '评论删除失败',
			'ref'=> $ref
		));
	}
	public function info()
	{
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('goods_comment_appointment','getlist',$param);
      if($resp['status']){
        $data['attr'] = $resp['data']['list'][0];
      }
    }
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_comment_appointment/index');
    $this->view($data,'goods_comment_appointment/info');
	}

}