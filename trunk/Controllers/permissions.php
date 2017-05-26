<?php

/**
 * 权限管理
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class permissions extends common {
		
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
		$permissionsName = $this->queryVar('permissionsName');
		$data['permissionsName'] = $permissionsName;
		$param = array();
		if(!empty($permissionsName)){
			$param['permissionsName'] = $permissionsName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('permissions','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'permissionsName' => $permissionsName,
			'ref' => $this->func->curr_url()
		);
		$data['menulist'] = $this->getMenuToName();
		$this->setActionLog('permissions','QUERY','查看权限列表');
		$this->view($data,'permissions/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$permissionsName = $this->queryVar('permissionsName');
		$data['permissionsName'] = $permissionsName;
		$param = array();
		if(!empty($permissionsName)){
			$param['permissionsName'] = $permissionsName;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('permissions','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'permissionsName' => $permissionsName,
			'ref' => $this->queryVar('ref' , APP_URL . 'permissions/index?permissionsName='.$permissionsName.'&page='.$page)
		);
		$data['menulist'] = $this->getMenuToName();
		$this->view($data,'permissions/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'permissionsName' => '',
				'menuId' => '',
				'controller' => '',
				'action' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('permissions','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'permissionsName' => '',
					'menuId' => '',
					'controller' => '',
					'action' => ''
				);
			}
		}
		$data['menu_list'] = $this->getMenuToName();
		$data['menulist'] = $this->generateMenuTree();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'permissions/index');
		$this->view($data,'permissions/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['permissionsName'] = $this->queryVar('permissionsName');
		$param['menuId'] = $this->queryVar('menuId');
		$param['controller'] = $this->queryVar('controller');
		$param['action'] = $this->queryVar('action');
		$ref = $this->queryVar('ref',APP_URL . 'permissions/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('permissions','create', $param);
			$opt  = '添加';
			$this->setActionLog('permissions','SAVE','添加权限');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('permissions','update', $param);
			$opt  = '修改';
			$this->setActionLog('permissions','UPDATE','修改权限');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '权限'.$opt.'成功' : '权限'.$opt.'失败',
			'ref'=> $ref
		));
	}
	
	/**
	 * 权限删除
	 */
	public function delete()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'permissions/index');
		$param['id'] = $id;
		$resp = $this->model->write('permissions','delete', $param);
		$this->setActionLog('permissions','DELETE','删除权限');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '权限删除成功' : '权限删除失败',
			'ref'=> $ref
		));
	}
	
	public function getMenuToName(){
		$data = array();
		$menu_where['menuStatus'] = 1;
		$res  = $this->model->read('menu', 'getMenuList',$menu_where);
		if ($res['status'])
		{
			foreach ($res['data']['list'] as $row)
			{
				if($row['parentId'] != 0){
					$data[$row['id']] = $row['menuName'];
				}
			}
		}
		return $data;
	}
	/**
	 * 返回菜单树形数组
	 *
	 * @return array
	 */
	function getMenuTreeData()
	{
		$data = array();
		$menu_where['menuStatus'] = 1;
		$res  = $this->model->read('menu', 'getMenuList',$menu_where);
		if ($res['status'])
		{
			foreach ($res['data']['list'] as $row)
			{
				if($row['parentId'] != 0){
					$data[$row['parentId']][$row['id']] = $row;
				}else{
					$this->indexParentId = $row['id'];
				}
			}
		}
		return $data;
	}

	/**
	 * 生成树列表
	 *
	 * @return array
	 */
	function getMenuTreeArray($parentId, $data, $count)
	{
		$root = (array_key_exists($parentId, $data)) ? $data[$parentId] : 0;
		if (!empty($root))
		{
			$count++; //计数器
			if ($parentId == 1)
				$count = 1;
			foreach ($root as $id => $row)
			{
				if($row['parentId']>1){
					$row['menuName']   = '|'.str_repeat("-", $count) . $row['menuName'];
				}
					$this->array[$row['parentId']][$row['id']] = $row;
				$this->getMenuTreeArray($row['id'], $data, $count);

			}
		}

		return $this->array;
	}

	/**
	 * 读取菜单列表
	 *
	 * @return array
	 */
	function generateMenuTree()
	{
		$res  = array();
		$data = $this->getMenuTreeData();
		$res  = $this->getMenuTreeArray(1, $data, 1);
		return $res;
	}
}