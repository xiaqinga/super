<?php

/**
 * 系统用户管理
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class user extends common {
		
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
		$searchname = $this->queryVar('searchname');
		$name = $this->queryVar('name');
		$data['name'] = $name;
		$param = array();
		if(!empty($name)){
			$param[$searchname] = $name;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('user','getlist',$param);
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
		$data['rolelist'] = $this->getRoleToName();
		$this->setActionLog('user','QUERY','查询系统用户列表');
		$this->view($data,'user/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$searchname = $this->queryVar('searchname');
		$name = $this->queryVar('name');
		$data['name'] = $name;
		$param = array();
		if(!empty($name)){
			$param[$searchname] = $name;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('user','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'searchname' => $searchname,
			'name' => $name,
			'ref' => $this->queryVar('ref' , APP_URL . 'user/index?searchname='.$searchname.'&name='.$name.'&page='.$page)
		);
		$data['rolelist'] = $this->getRoleToName();
		$this->view($data,'user/ajaxindex');
	}
	
	public function edit(){
		$id = $this->queryVar('id');
		if(empty($id)){
			$data  = array(
				'id' => '',
				'accout' => '',
				'userName' => '',
				'phoneNumber' => '',
				'eMail' => '',
				'roleId' => '',
				'deptId' => ''
			);
		}else{
			$param['id'] = $id;
			$resp = $this->model->read('user','getlist',$param);
			if($resp['status']){
				$data = $resp['data']['list'][0];
			}else{
				$data  = array(
					'id' => '',
					'accout' => '',
					'userName' => '',
					'phoneNumber' => '',
					'eMail' => '',
					'roleId' => '',
					'deptId' => ''
				);
			}
		}
		$data['rolelist'] = $this->getRoleToName();
		$data['deptlist'] = $this->getDeptToName();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'user/index');
		$this->view($data,'user/edit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$param['accout'] = $this->queryVar('accout');
		$param['userName'] = $this->queryVar('userName');
		$param['phoneNumber'] = $this->queryVar('phoneNumber');
		$param['eMail'] = $this->queryVar('eMail');
		$param['roleId'] = $this->queryVar('roleId');
		$ref = $this->queryVar('ref',APP_URL . 'user/index');
		if( 0 == $id )
		{
			$param['passWord'] = md5($param['accout']);
			$param['userType'] = 1;
			$param['status'] = 1;
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('user','create', $param);
			$opt  = '添加';
			$this->setActionLog('user','SAVE','新增系统用户');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('user','update', $param);
			$opt  = '修改';
			$this->setActionLog('user','UPDATE','修改系统用户');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '用户'.$opt.'成功' : '用户'.$opt.'失败',
			'ref'=> $ref
		));
	}

	/**
	 * 重置密码
	 */
	public function rePassword()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'user/index');
		$param['id'] = $id;
		$ret = $this->model->read('user','getlist',$param);
		if($ret['status']){
			$data = $ret['data']['list'][0];
			$param['passWord'] = md5($data['accout']);
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('user','update', $param);
		}else{
			$resp['status'] = false;
		}
		$this->setActionLog('user','UPDATE','重置系统用户密码');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '用户密码重置成功' : '用户密码重置失败',
			'ref'=> $ref
		));
	}
	/**
	 * 设置状态
	 */
	public function setStatus()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'user/index');
		$param['id'] = $id;
		$param['status'] = $this->queryVar('status');
		$param['updateUser'] = $this->sess->get('id');
		$param['updateDate'] = date('Y-m-d H:i:s');
		$resp = $this->model->write('user','update', $param);
		if($param['status']){
			$opt  = '开启';
		}else{
			$opt  = '关闭';
		}
		$this->setActionLog('user','UPDATE','设置系统用户状态');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '用户'.$opt.'成功' : '用户'.$opt.'失败',
			'ref'=> $ref
		));
	}
	/**
	 * 用户删除
	 */
	public function delete()
	{
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'user/index');
		$param['id'] = $id;
		$resp = $this->model->write('user','delete', $param);
		$this->setActionLog('user','DELETE','删除系统用户');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '用户删除成功' : '用户删除失败',
			'ref'=> $ref
		));
	}
	
	public function getRoleToName(){
		$data = array();
		$res  = $this->model->read('role', 'getList');
		if ($res['status'])
		{
			foreach ($res['data']['list'] as $row)
			{
				$data[$row['id']] = $row['roleName'];
			}
		}
		return $data;
	}
	
	public function getDeptToName(){
		$data = array();
		$res  = $this->model->read('user', 'getDeptList');
		if ($res['status'])
		{
			foreach ($res['data']['list'] as $row)
			{
				if($row['parentId'] != 0){
					$data[$row['id']] = $row['deptName'];
				}
			}
		}
		return $data;
	}
	
	/**
	 * 检测数据唯一性
	 */
	public function checkexist(){
		$name   = $this->queryVar('name');
		$value  = $this->queryVar('value');

		$param = array(
			'id' => $this->queryVar('id', 0),
			$name => $value
		);

		$resp = $this->model->read('user', 'checkexist',$param);

		$this->jsonout($resp['status'],array('msg'=>$resp['data']));
	}
}