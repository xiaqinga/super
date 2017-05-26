<?php

/**
 * 评论管理
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class goods_comment extends common {
		
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
		$param['goodsType'] = $this->queryVar('goodsType');
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
		$param['providerType'] =1;
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
		$this->view($data,'goods_comment/index');

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
		$param['providerType'] =1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
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
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_comment/index?key_type='.$key_type.'&key='.$key.'&startDate='.$startDate.'&endDate='.$endDate.'&page='.$page)
		);
		$this->setActionLog('goods_comment','QUERY','查询供应商评论列表');
		$this->view($data,'goods_comment/ajaxindex');
	}
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_comment/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_comment','delete', $param);
		$this->setActionLog('goods_comment','QUERY','删除供应商评论');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '评论删除成功' : '评论删除失败',
			'ref'=> $ref
		));
	}
	// public function info()
	// {
 //    $id = $this->queryVar('id');
 //    if(!empty($id)){
 //      $param['id'] = $id;
 //      $resp = $this->model->read('goods_comment','getlist',$param);
 //      if($resp['status']){
 //        $data['attr'] = $resp['data']['list'][0];
 //      }
 //    }
 //    $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_comment/index');
 //    $this->view($data,'goods_comment/info');
	// }

	//回复评论
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_comment','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
				$data['replyContent']=$this->model->read('goods_comment','getRereplyContent',$param);
			}
		}
	     
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_comment/index');
		$this->view($data,'goods_comment/edit');



	}
	//评论详情
	public function info()
	{
    $id = $this->queryVar('id');
    if(!empty($id)){
      $param['id'] = $id;
      $resp = $this->model->read('goods_comment','getlist',$param);
      if($resp['status']){
        $data = $resp['data']['list'][0];
      }
    }
		$this->setActionLog('goods_comment','READ','查看评论详情');	
    $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_comment/index');
    $this->view($data,'goods_comment/info');
	}
	//启用评论
    /*public function upstore(){
		$id = $this->queryVar('ids');
		if(!empty($id)){
			$param['id'] = $id;
			$param['status'] = 1;
			$resp = $this->model->write('goods_comment','update',$param);
			$this->setActionLog('goods_comment','SAVE','启用评论');
			$this->jsonout($resp['status'],array(
				'msg'=>($resp['status']) ? '评论启用成功' : '评论启用失败',
				'ref'=> APP_URL . 'goods_comment/index'
			));
		}
	}*/
	//禁用评论
	/*public function downstore(){
		$id = $this->queryVar('ids');
		if(!empty($id)){
			$param['id'] = $id;
			$param['status'] = 0;
			$resp = $this->model->write('goods_comment','update',$param);
			$this->setActionLog('goods_comment','SAVE','禁用评论');
			$this->jsonout($resp['status'],array(
				'msg'=>($resp['status']) ? '评论禁用成功' : '评论禁用失败',
				'ref'=> APP_URL . 'goods_comment/index'
			));
		}
	}*/

	//新增\保存评论回复
	public  function save(){
		$param['commentId'] = $this->queryVar('commentId');
		$id = $this->queryVar('id');
		$param['replyContent']=$this->queryVar('replyContent');
		$param['createUser'] =$this->queryVar('createUser',1);
		$param['type'] =$this->queryVar('type',0);
		if($id){
			$param['id']=$id;
		}
		$resp = $this->model->write('goods_comment','setRereplyContent',$param);
		$this->setActionLog('goods_comment','SAVE','修改评论回复');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '评论回复成功' : '评论回复失败',
			'ref'=>$this->queryVar('ref',APP_URL . 'goods_comment/index')
		));

	}

}