<?php

/**
 * 送货员管理
 *
 * @author  wsbnet@qq.com
 * @since   2016.07.28
 * @version 1.0
 */

class base_school_sender extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
	}
	

	public function index()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);
		$base_school_senderName = $this->queryVar('base_school_senderName');
		$data['base_school_senderName'] = $base_school_senderName;
		$param = array();
		if(!empty($base_school_senderName)){
			$param['base_school_senderName'] = $base_school_senderName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_school_sender','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'base_school_senderName' => $base_school_senderName,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'base_school_sender/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$base_school_senderName = $this->queryVar('base_school_senderName');
		$data['base_school_senderName'] = $base_school_senderName;
		$param = array();
		if(!empty($base_school_senderName)){
			$param['base_school_senderName'] = $base_school_senderName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_school_sender','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'base_school_senderName' => $base_school_senderName,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_school_sender/index?base_school_senderName='.$base_school_senderName.'&page='.$page)
		);
		$this->view($data,'base_school_sender/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'base_school_senderName' => '',
				'remarks' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('base_school_sender','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'base_school_senderName' => '',
					'remarks' => ''
				);
			}
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_school_sender/index');
		$this->view($data,'base_school_sender/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['base_school_senderName'] = $this->queryVar('base_school_senderName');
		$param['remarks'] = $this->queryVar('remarks');
		$ref = $this->queryVar('ref',APP_URL . 'base_school_sender/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$param['status'] = 1;
			$resp = $this->model->write('base_school_sender','create', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_school_sender','update', $param);
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '角色'.$opt.'成功' : '角色'.$opt.'失败',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_school_sender/index');
		$param['id'] = $id;
		$param['status'] = 0;
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		$resp = $this->model->write('base_school_sender','update', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '角色删除成功' : '角色删除失败',
			'ref'=> $ref
		));
	}
	
	public function permissions(){
		$data['id'] = $id = $this->queryVar('id', 'i');
		$data['rightItem'] = array();
		$Itemresp = $this->model->read('permissions','getlist');
		$Item = ($Itemresp['status']) ? $Itemresp['data']['list'] : array();

		if (is_array($Item))
		{
			foreach ($Item as $row)
			{
				$data['rightItem'][$row['menuId']][$row['id']] = $row;
			}
		}
		$data['menuItem'] = array();
		$menuItemres  = $this->model->read('menu', 'getMenuList');
		$menuItem = ($menuItemres['status']) ? $menuItemres['data']['list'] : array();
		if (is_array($menuItem))
		{
			foreach ($menuItem as $row)
			{
				if($row['parentId']!=0){
					$data['menuItem'][$row['parentId']][$row['id']] = $row;
				}
			}
		}
		$data['base_school_senderMenuItem']  = array();
		$data['base_school_senderRightItem'] = array();
		$resp = $this->model->read('base_school_sender','getlist',array('id'=>$data['id']));
		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options)>0)
		{
			if (isset($options['menu']))
			{
				$data['base_school_senderMenuItem'] = $options['menu'];
			}
			if (isset($options['permissions']))
			{
				$data['base_school_senderRightItem'] = $options['permissions'];
			}
		}
		$data['ref'] = $this->queryVar('ref',APP_URL . 'base_school_sender/index');
		$this->view($data,'base_school_sender/permissions');
	}

	public function save_base_school_sender_right()
	{
		$base_school_sender_id = $this->queryVar('id');
		$menuIds = $this->queryVar('menuId');
		$rightIds = $this->queryVar('rightId');
		$ref = $this->queryVar('ref');
		$rightItem = array();
		$Itemresp = $this->model->read('permissions','getlist');
		$Item = ($Itemresp['status']) ? $Itemresp['data']['list'] : array();

		if (is_array($Item))
		{
			foreach ($Item as $row)
			{
				$rightItem[$row['id']] = $row;
			}
		}
		$permissions = array();
		if (!empty($rightIds))
		{
			foreach($rightIds as $rightId){
				$permissions[$rightId]['permissions_id'] = $rightItem[$rightId]['id'];
				$permissions[$rightId]['controller'] = $rightItem[$rightId]['controller'];
				$permissions[$rightId]['action'] = $rightItem[$rightId]['action'];
			}
		}
		$menuItems = array();
		$menuItemres  = $this->model->read('menu', 'getMenuList');
		$menuItem = ($menuItemres['status']) ? $menuItemres['data']['list'] : array();
		if (is_array($menuItem))
		{
			foreach ($menuItem as $row)
			{
				if($row['parentId']!=0){
					$menuItems[$row['id']] = $row;
				}
			}
		}
		$menu=array();
		if (!empty($menuIds))
		{
			foreach ($menuIds as $menuId)
			{
				$menu[$menuId]['menu_id'] = $menuItems[$menuId]['id'];
				$menu[$menuId]['url']     = $menuItems[$menuId]['menuUrl'];
			}
		}
		$data=array();
		if (count($permissions)>0)
		{
			$data['permissions'] = $permissions;
		}
		if (count($menu) > 0)
		{
			$data['menu'] = $menu;
		}
		$param['id'] = $base_school_sender_id;
		$param['options'] = json_encode($data);
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		$resp = $this->model->write('base_school_sender','update', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '角色权限设置成功' : '角色权限设置失败',
			'ref'=> $ref
		));
	}
}