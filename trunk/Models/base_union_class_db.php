<?php

/**
 * 联盟商分类
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */
 
class base_union_class_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_union_shop_class';
	private $table_photo = 'base_photo';
	private $table_goods = 'goods_list';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX .'base_union_shop_class';
		$this->table_photo = DB_PREFIX .'base_photo';
		$this->table_goods = DB_PREFIX .'goods_list';
	}
	
	public function getlist($param){
		$where = array();

		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'className' )
			{
				$where['like']['a.className']  = $param['key'];
			}
		}

		$where['where']['a.status'] = 1;
		$where['where']['a.id !='] = 0;
		$where['where']['a.classLevel >='] = 1;
		
		// var_dump($param['classType']);die();
		$total = $this->db->total($this->table.' a ', $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}

		$where['order']['a.classSort'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table.' a ','a.*', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	

	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table, $param);
		if($ret){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);

		$ret = $this->db->update($this->table, $param, $where);

		if($ret){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	
	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$uparam['where']['parentId']=$param['id'];
		    $uparam['where']['status']=1;
			unset($param['id']);


			$reg=$this->db->select($this->table,'',$uparam);

		
			if($reg){
				$this->result['status'] = 0;
				$this->result['data']['msg'] = '该分类下有子类存在,请先删除子类';

			}else {
				$setparam['status'] = '-1';
				$ret = $this->db->update($this->table, $setparam, $where);
				if ($ret !== false) {
					$this->result['status'] = 1;
					$this->result['data']['msg'] = '删除成功';
				} else {
					$this->result['status'] = 0;
					$this->result['data']['msg'] = '删除失败';
				}
			}

		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/*
	查询分类命是否重复
	 */
	public function findrepeat($param){
		$where = array(
			'where' => array(
				'className' => $param['className'],
				'parentId' => $param['parentId'],
				'status' => 1
			)
		);
		if ($param['id']) {
			$where['where']['id !='] = $param['id'];
		}
		$resp = $this->db->select($this->table,'id,status',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}


	public function getClassJson($param){
		$where['where']['status '] = 1;
		$where['where']['parentId']=$param['id'];
		$where['order']['classSort'] = 'ASC';
		$resp = $this->db->select($this->table,'id,className',$where);
		if(count($resp)>0){
			foreach ($resp as $key => $value) {
				$where_inner = array();

				$where_inner['where']['status '] = 1;

				if(!empty($value['id'])){
					$where_inner['where']['parentId'] = $value['id'];
				}

				$where_inner['order']['classSort'] = 'DESC';
				$data_inner  = $this->db->select($this->table, 'className', $where_inner);
				if(count($data_inner)>0)
				{
					$resp[$key]['has_sub']=1;
				}
			}
		}



		if($resp){
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;

	}
	
	public function getParentName($param){
		$where['where']['id']=$param['id'];
		$resp = $this->db->select($this->table,'id,className',$where);

		return $resp['0']['className'];
	}

}