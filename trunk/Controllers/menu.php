<?php

/**
 * 菜单管理
 *
 * @author  janhve@163.com
 * @since   2016.07.15
 * @version 1.0
 */
 
class menu extends common {
		
	/**
	 * 初始化
	 * 
	 */
	public $add_icon_src;
	public $noadd_icon_src;
	public $indexParentId;
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->add_icon_src = ASSETS_URL."images/default/add.gif";
		$this->noadd_icon_src = ASSETS_URL."images/default/noadd.gif";
	}
	
	public function index()
	{
		$data['menu_list'] = $this->generateMenuTree();
		$data['dictStatus'] = $this->public_dict['menu_status'];
		if($this->indexParentId != ''){
			$data['indexParentId'] = $this->indexParentId;
		}else{
			$data['indexParentId'] = 0;
		}
		$data['add_icon_src']      = $this->add_icon_src;
		$data['noadd_icon_src']      = $this->noadd_icon_src;
		$this->setActionLog('menu','QUERY','查看系统菜单列表');
		$this->view($data,'menu/index');
	}
	
	public function edit()
	{
		$id        = $this->queryVar('id');
		$parentId = $this->queryVar('parentId');
		if (empty($id))
		{
			$items = array(
				'id'   => '',
				'parentId' => $parentId,
				'menuName'      => '',
				'menuStyle' => '',
				'menuUrl'      => '',
				'menuSort'      => '',
				'menuStatus'    => 1
			);
		}
		else
		{
			$data_items = $this->model->read('menu', 'getItem', array('id' => $id));
			$items = $data_items['data'];
		}

		$data['item']             = $items;
		$data['dictStatusSelect'] = $this->public_dict['menu_status'];
		$data['ref']             = APP_URL . 'menu/index';
		$this->view($data,'menu/edit');
	}

	/**
	 * 菜单管理保存(添加/修改 )
	 */
	public function save()
	{
		$param              = array();
		$id           = $this->queryVar('id');
		$param['parentId'] = $this->queryVar('parentId');
		$param['menuName']      = $this->queryVar('menuName');
		$param['menuStyle'] = $this->queryVar('menuStyle');
		$param['menuUrl']      = $this->queryVar('menuUrl');
		$param['menuSort']      = $this->queryVar('menuSort');
		$param['menuStatus']    = $this->queryVar('menuStatus');

		$ref = $this->queryVar('ref',APP_URL . 'menu/index');
		if( 0 == $id )
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('menu','create', $param);
			$opt  = '添加';
			$this->setActionLog('menu','SAVE','添加系统菜单');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('menu','update', $param);
			$opt  = '修改';
			$this->setActionLog('menu','UPDATE','修改系统菜单');
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '菜单'.$opt.'成功' : '菜单'.$opt.'失败',
			'ref'=> $ref
		));
	}

	/**
	 * 菜单管理删除
	 */
	public function delete()
	{
		$id = $this->queryVar('id', 'i');
		$res = $this->model->read('menu', 'getMenuList', array('parentId' => $id));
		if ($res['status'])
		{
			$data['msg'] = 3;
		}
		else
		{
			$ret = $this->model->write('menu', 'delete', array('id' => $id));
			if ($ret['status'])
			{
				$data['msg'] = 1;
			}
			else
			{
				$data['msg'] = 2;
			}
		}
		$this->setActionLog('menu','DELETE','删除系统菜单');
		echo json_encode($data);
		exit;
	}
	
	/**
	 * 返回菜单树形数组
	 *
	 * @return array
	 */
	function getMenuTreeData()
	{
		$data = array();
		$res  = $this->model->read('menu', 'getMenuList');

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
				$src           = (!empty($data[$id])) ? $this->add_icon_src : $this->noadd_icon_src;
				$row['menuName']   = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $count) . "<img src=\"{$src}\">-&gt{$row['menuName']}";
				$row['menuName'] = (!empty($data[$id])) ? '<span style="cursor: pointer;">' . $row['menuName'] . '</span>': $row['menuName'];
					$this->array[] = $row;
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