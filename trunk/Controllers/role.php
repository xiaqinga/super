<?php

/**
 * 角色管理
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class role extends common {
		
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
		$roleName = $this->queryVar('roleName');
		$data['roleName'] = $roleName;
		$param = array();
		if(!empty($roleName)){
			$param['roleName'] = $roleName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('role','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'roleName' => $roleName,
			'ref' => $this->func->curr_url()
		);
		$this->setActionLog('role','QUERY','查看角色列表');
		$this->view($data,'role/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$roleName = $this->queryVar('roleName');
		$data['roleName'] = $roleName;
		$param = array();
		if(!empty($roleName)){
			$param['roleName'] = $roleName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('role','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'roleName' => $roleName,
			'ref' => $this->queryVar('ref' , APP_URL . 'role/index?roleName='.$roleName.'&page='.$page)
		);
		$this->view($data,'role/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'roleName' => '',
				'remarks' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('role','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'roleName' => '',
					'remarks' => ''
				);
			}
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'role/index');
		$this->view($data,'role/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['roleName'] = $this->queryVar('roleName');
		$param['remarks'] = $this->queryVar('remarks');
		$ref = $this->queryVar('ref',APP_URL . 'role/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$param['status'] = 1;
			$resp = $this->model->write('role','create', $param);
			$opt  = '添加';
			$this->setActionLog('role','SAVE','新增角色');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('role','update', $param);
			$opt  = '修改';
			$this->setActionLog('role','UPDATE','修改角色');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '角色'.$opt.'成功' : '角色'.$opt.'失败',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'role/index');
		$param['id'] = $id;
		$param['status'] = 0;
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		$resp = $this->model->write('role','update', $param);
		$this->setActionLog('role','DELETE','删除角色');
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
		$menu_where['menuStatus'] = 1;
		$menuItemres  = $this->model->read('menu', 'getMenuList',$menu_where);
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
		$data['roleMenuItem']  = array();
		$data['roleRightItem'] = array();
		$resp = $this->model->read('role','getlist',array('id'=>$data['id']));
		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options)>0)
		{
			if (isset($options['menu']))
			{
				$data['roleMenuItem'] = $options['menu'];
			}
			if (isset($options['permissions']))
			{
				$data['roleRightItem'] = $options['permissions'];
			}
		}
		$data['ref'] = $this->queryVar('ref',APP_URL . 'role/index');
		$this->view($data,'role/permissions');
	}

	public function save_role_right()
	{
		$role_id = $this->queryVar('id');
		$menuIds = $this->queryVar('menuIds');
		$rightIds = $this->queryVar('rightIds');
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
		$param['id'] = $role_id;
		$param['options'] = json_encode($data);
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		$resp = $this->model->write('role','update', $param);
		$this->setActionLog('role','UPDATE','设置角色权限');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '角色权限设置成功' : '角色权限设置失败',
			'ref'=> $ref
		));
	}
}