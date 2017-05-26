<?php

/**
 * 商品分类表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */
 
class goods_class_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_class';
	private $table_photo = 'base_photo';
	private $table_goods = 'goods_list';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX .'goods_class';
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
			
			if( $param['key_type'] == 'mark' )
			{
				$where['like']['a.mark']  = $param['key'];
			}
		}

		$where['where']['a.status >'] = 0;
		$where['where']['a.id !='] = 0;
		$where['where']['a.classLevel >='] = 1;
		if($param['classType'] == 1){
			$where['where']['a.classType'] = 1;
		}
		if($param['classType'] == 2){
			$where['where']['a.classType'] = 2;
		}
		
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

	public function getItem($param){
		if($param['id']>=0 && $param['id']!==null){
			$where['where']['id'] = $param['id'];
			$where['order']['id'] = 'DESC';
			$data  = $this->db->select($this->table,'', $where);
		}
		if(!empty($data) && count($data)>0)
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = null;
		}
		return $this->result;
	}

	public function getClassName($param){
		if(!empty($param['ids'])){ 
			$where['where']['id IN '] = "(".$param['ids'].")";
			$where['order']['id'] = 'DESC';
			$data  = $this->db->select($this->table,'className', $where);
		}
		if(count($data)>0)
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = null;
		}
		return $this->result;
	}

	public function getJson($param){
		$where = array();

		$where['where']['status >'] = 0;
		$where['where']['id !='] = 0;
		$where['where']['classLevel >='] = 1;

		if(!empty($param['mallType'])){
			$param['mallType'] = explode(',', $param['mallType']);
		
			$where['like']['mallType'] = $param['mallType'];
			
			// $where['where']['mallType'] = $param['mallType'];
		}
		
		if($param['id']>-1){
			$where['where']['parentId'] = $param['id'];
			$where['order']['classSort'] = 'DESC';

			$data  = $this->db->select($this->table, 'id,className', $where);

			if(count($data)>0){
				foreach ($data as $key => $value) {
					$where_inner = array();

					$where_inner['where']['status >'] = 0;
					$where_inner['where']['id !='] = 0;
					$where_inner['where']['classLevel >='] = 1;

					if(!empty($value['id'])){
						$where_inner['where']['parentId'] = $value['id'];
					}

					$where_inner['order']['classSort'] = 'DESC';
					$data_inner  = $this->db->select($this->table, 'className', $where_inner);
					if(count($data_inner)>0)
					{
						$data[$key]['has_sub']=1;
					}
				}
			}
		}
		// var_dump($this->db->last_query());die();
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

	public function getChildClass($id){
		$where['where']['parentId'] = $param['id'];
		$where['order']['classSort'] = 'DESC';
		$data  = $this->db->select($this->table, 'id', $where);
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
			$where = array(
				'where' => array(
					'id' => $this->db->last_id
				)
			);
			$data = $this->db->select($this->table, '', $where);
		
			$where_items = array(
				'where' => array(
					'id' => $data[0]['parentId']?$data[0]['parentId']:'0'
				)
			);
            $list=$this->db->select($this->table, '', $where_items);
            $mallType = explode(',',$list['0']['mallType']);

            $paId = $list[0]['id']?$list[0]['id']:'0';
            $where_parent['where']['parentId']=$paId;
			$where_parent['where']['status']=1;
            $itemsArr = array();
			foreach ($mallType as $key => $value) {
				$where_parent['like']['mallType'] = $value;
				$items = $this->db->select($this->table, '', $where_parent);			
				foreach ($items as $k => $v) {
					$itemsArr[$value][] = array(
						'id' => $v['id'],
						'className' => $v['className'],
						'photoPath' => $v['photoUrl'],
					);
				}
			}

			//父分类下的
			$getredis = array(
				'parentId' => $list[0]['id'],
				'old_mallType'=>$mallType,
				'items' => $itemsArr
			);
			$this->result['data']   = $getredis;
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
		$beforeData= $this->db->select($this->table, '', $where);

		$ret = $this->db->update($this->table, $param, $where);

		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table, '', $where);

			
			//父分类下的
			$where_items = array(
				'where' => array(
					'id' => $data[0]['parentId']?$data[0]['parentId']:'0'
				)
			);
			$list=$this->db->select($this->table, '', $where_items);
			$mallType = explode(',',$list['0']['mallType']);
			$itemsArr = array();
			$paId = $list[0]['id']?$list[0]['id']:'0';
			$where_parent['where']['parentId']=$paId;
			$where_parent['where']['status']=1;
			foreach ($mallType as $key => $value) {
				$where_parent['like']['mallType'] = $value;
				$items = $this->db->select($this->table, '', $where_parent);

				foreach ($items as $k => $v) {
					$itemsArr[$value][] = array(
						'id' => $v['id'],
						'className' => $v['className'],
						'photoPath' => $v['photoUrl']
					);
				}
			}
			//父分类下的
			$getredis = array(
				'parentId' => $list[0]['id'],
				'old_mallType'=>$mallType,
				'items' => $itemsArr
			);

			if($beforeData[0]['parentId']!=$data[0]['parentId']){
				$beforeWhere_items = array(
					'where' => array(
						'id' => $beforeData[0]['parentId']?$beforeData[0]['parentId']:'0'
					)
				);
				$beforeList=$this->db->select($this->table, '', $beforeWhere_items);
				$beforeMallType = explode(',',$beforeList['0']['mallType']);
				$beforeItemsArr = array();
				$beforePaId = $beforeList[0]['id']?$beforeList[0]['id']:'0';
				$beforeWhereParent['where']['parentId']=$beforePaId;
				$beforeWhereParent['where']['status']=1;
				foreach ($beforeMallType as $key => $value) {
					$beforeWhereParent['like']['mallType'] = $value;
					$beforeItems = $this->db->select($this->table, '', $beforeWhereParent);

					foreach ($beforeItems as $k => $v) {
						$beforeItemsArr[$value][] = array(
							'id' => $v['id'],
							'className' => $v['className'],
							'photoPath' => $v['photoUrl']
						);
					}
				}
				//父分类下的
				$beforeGetredis = array(
					'parentId' => $beforeList[0]['id'],
					'old_mallType'=>$beforeMallType,
					'items' => $beforeItemsArr
				);
			}
			
			
			$redisData=[
			     'data'=>$getredis,
				 'beforeData'=>$beforeGetredis
			];
			
			$this->result['data']   = $redisData;


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
			$param['status'] = '-1';
			unset($param['id']);
			$data = $this->db->select($this->table, 'parentId', $where);
			$ret = $this->db->update($this->table,$param ,$where);
			if ($ret)
			{
				$where_items = array(
					'where' => array(
						'id' => $data[0]['parentId']?$data[0]['parentId']:'0'
					)
				);
	            $list=$this->db->select($this->table, '', $where_items);
	            $mallType = explode(',',$list['0']['mallType']);
	            $itemsArr = array();
	            $paId = $list[0]['id']?$list[0]['id']:'0';
	            $where_parent['where']['parentId']=$paId;
				$where_parent['where']['status']=1;
				foreach ($mallType as $key => $value) {
					$where_parent['like']['mallType'] = $value;
					$items = $this->db->select($this->table, '', $where_parent);
					foreach ($items as $k => $v) {
						$itemsArr[$value][] = array(
							'id' => $v['id'],
							'className' => $v['className'],
							'photoPath' => $v['photoUrl']
						);
					}
				}
				//父分类下的
				$getredis = array(
					'parentId' => $list[0]['id'],
					'old_mallType'=>$mallType,
					'items' => $itemsArr
				);
				$this->result['status'] = 1;
				$this->result['data']   = $getredis;
			}else{
				$this->result['status'] = 0;
			}
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function getAttr($param){
		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		$where['order']['id'] = 'DESC';
		$data  = $this->db->select($this->table, $param['field'], $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']  = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	/**
	 * 更新分类/供应商分类/缓存
	 * @return array
	 */
	public function updatecahce(){
		//商品分类
		 $where = array(
			'where' => array(
				'status' => 1
			)
		 );
		 $where['order']['classSort'] = 'ASC';
		 $del_data = $this->db->select($this->table,'id,className,mallType,parentId,photoUrl as photoPath', $where);
		 $malltypes=array(1,2,3,4);
         $arr=array();
		 foreach ($del_data as  $key=>$value){
			  foreach ($malltypes as $kk=>$vv){
				  if(in_array($vv,explode(',',$value['mallType']))){
					  foreach($del_data as  $k=>$v){
						  if($value['id']==$v['parentId']&&in_array($vv,explode(',',$v['mallType']))){
							  $arr[$vv][$value['id']][]=$v;
						  }

					  }
				  }

			 }

		 }
	
		if(count($del_data)>0){
			$this->result['status'] = 1;
			$this->result['data']   = $arr;
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
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
				'parentId' => $param['parentId']
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

	public function getpreclass($param){
		$where = array();
		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'className' )
			{
				$where['like']['a.className']  = $param['key'];
			}
			
			if( $param['key_type'] == 'mark' )
			{
				$where['like']['a.mark']  = $param['key'];
			}
		}

		$where['where']['a.status >'] = 0;
		$where['where']['a.id !='] = 0;
		$where['where']['a.classLevel >='] = 1;
		$where['where']['a.classType'] = 2;
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
}