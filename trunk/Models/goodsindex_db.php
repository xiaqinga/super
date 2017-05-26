<?php

/**
 * 首页模板模型
 * @author janhve@163.com
 * @since   2016-08-30
 * @version 1.0
 */
 
class goodsindex_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_index';
	private $table_detail = 'goods_index_detail';
	private $table_main = 'goods_index_main';
	private $table_photo = 'base_photo';
	private $table_goods_class = 'goods_class';
	private $table_goods_list = 'goods_list';
	private $table_goods_normsvalue_stock = 'goods_normsvalue_stock';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'goods_index';
		$this->table_detail = DB_PREFIX . 'goods_index_detail';
		$this->table_main = DB_PREFIX . 'goods_index_main';
		$this->table_photo = DB_PREFIX . 'base_photo';
		$this->table_goods_class = DB_PREFIX . 'goods_class';
		$this->table_goods_list = DB_PREFIX . 'goods_list';
		$this->table_goods_normsvalue_stock = DB_PREFIX . 'goods_normsvalue_stock';
	}
	
	public function getlist($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		
		if( isset($param['templateName']) && !empty($param['templateName']) )
		{
			$where['like']['templateName']  = $param['templateName'];
		}
		
		$total = $this->db->total($this->table_main, $where);
		$this->result['data']['total'] = $total;
		$where['order']['createTime'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table_main,'', $where);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取首页模板数据失败';
		}
		return $this->result;
	}
	
	public function getIndexInfo($param){
		$where = array();

		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id']  = $param['id'];
		}
		$data  = $this->db->select($this->table_main,'', $where);
		$indexmain = ($data)?$data[0]:array();
		if(isset($indexmain['id'])){
			$indexs_where['where']['mainId']  = $indexmain['id'];
			$indexs_where['order']['sort'] = 'ASC';
			$indexmain['indexs']  = $this->db->select($this->table,'', $indexs_where);
			if($indexmain['indexs']){
				foreach ($indexmain['indexs'] as $key => $value) {
					$sql = 'select t1.*, 
		(case type when 1 then (select className from '.$this->table_goods_class.' where id = relId) when 2 then (select goodsName from '.$this->table_goods_list.' where id = relId) else url end) relName 
	from (select * from '.$this->table_detail.' where indexId = '.$value['id'].') t1 ';

					$indexmain['indexs'][$key]['detail']  = $this->db->select($sql);
					foreach($indexmain['indexs'][$key]['detail'] as $n_key=>$n_val){
						if($n_val['type'] == 2){
							$n_sql = 'select goodsNormsValueId,preferentialPrice from '.$this->table_goods_normsvalue_stock.' where goodsId = '.$n_val['relId'];
							$n_data = $this->db->select($n_sql);
							$indexmain['indexs'][$key]['detail'][$n_key]['normsValueId'] = $n_data[0]['goodsNormsValueId'];
							$indexmain['indexs'][$key]['detail'][$n_key]['preferentialPrice'] = $n_data[0]['preferentialPrice'];

						}
					}
				}
			}
		}
		if(!empty($indexmain))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $indexmain;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取首页模板详情数据失败';
		}
		return $this->result;
	}
	
	public function selectGoodsIndexMainIdentifier($param){
		$where = array();

		if( isset($param['identifier']) && !empty($param['identifier']) )
		{
			$where['where']['identifier']  = $param['identifier'];
		}
		
		if( isset($param['id']) && !empty($param['id']) )
		{
			$where['where']['id !=']  = $param['id'];
		}
		$total = $this->db->total($this->table_main, $where);
		if(!empty($total))
		{
			$this->result['status'] = 0;
			$this->result['data']   = '已存在';
		}
		else
		{
			$this->result['status'] = 1;
			$this->result['data']   = '不存在';
		}
		return $this->result;
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$main_param['templateName'] = $param['templateName'];
		$main_param['identifier'] = $param['identifier'];
		$main_param['description'] = $param['description'];
		$main_param['createUser'] = $param['createUser'];
		$main_param['createTime'] = $param['createTime'];
		$main_param['updateUser'] = $param['updateUser'];
		$main_param['updateTime'] = $param['updateTime'];
		$ret = $this->db->insert($this->table_main, $main_param);
		$id = $this->db->last_id();
		if($ret){
			foreach($param['goodsIndexs'] as $key=>$val){
				$index_param['mainId'] = $id;
				$index_param['templateName'] = $val['templateName'];
				$index_param['forUrl'] = $val['forUrl'];
				$index_param['sort'] = $val['sort'];
				$index_param['status'] = $val['status'];
				$index_param['templateName'] = $val['templateName'];
				$index_param['updateUser'] = $param['updateUser'];
				$index_param['updateTime'] = $param['updateTime'];
				$index_param['createUser'] = $param['createUser'];
				$index_param['createTime'] = $param['createTime'];
				$index_ret = $this->db->insert($this->table, $index_param);
				$indexId = $this->db->last_id();
				foreach($val['goodsIndexDetails'] as $d_key=>$d_val){
					$details_param['indexId'] = $indexId;
					if($d_val['relId']){
						$details_param['relId'] = $d_val['relId'];
					}
					$details_param['photoUrl'] = $d_val['photoUrl'];
					$details_param['url'] = $d_val['url'];
					$details_param['type'] = $d_val['type'];
					$details_ret = $this->db->insert($this->table_detail, $details_param);
				}
			}
			$data = $this->getIndexInfo(array('id'=>$id));
			$redisdata = $this->getRedisDate($data['data']);

			$this->result['status'] = 1;
			$this->result['data']   = $redisdata;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '首页模板添加失败';
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
		$id = $param['id'];
		unset($param['id']);
		$main_param['templateName'] = $param['templateName'];
		$main_param['identifier'] = $param['identifier'];
		$main_param['description'] = $param['description'];
		$main_param['updateUser'] = $param['updateUser'];
		$main_param['updateTime'] = $param['updateTime'];
		$ret = $this->db->update($this->table_main, $main_param, $where);
		if($ret !== false){
			foreach($param['goodsIndexs'] as $key=>$val){
				$index_where = array(
					'where' => array(
						'id' => $val['id']
					)
				);
				$index_param['templateName'] = $val['templateName'];
				$index_param['forUrl'] = $val['forUrl'];
				$index_param['sort'] = $val['sort'];
				$index_param['templateName'] = $val['templateName'];
				$index_param['updateUser'] = $param['updateUser'];
				$index_param['updateTime'] = $param['updateTime'];
				$this->db->update($this->table, $index_param, $index_where);
				foreach($val['goodsIndexDetails'] as $d_key=>$d_val){
					$details_where = array(
						'where' => array(
							'id' => $d_val['id']
						)
					);
					if($d_val['relId']){
						$details_param['relId'] = $d_val['relId'];
					}

					$details_param['photoUrl'] = $d_val['photoUrl'];
					$details_param['url'] = $d_val['url'];
					$details_param['type'] = $d_val['type'];
					$this->db->update($this->table_detail, $details_param, $details_where);
				}
			}
			$data = $this->getIndexInfo(array('id'=>$id));

			$redisdata = $this->getRedisDate($data['data']);
			$this->result['status'] = 1;
			$this->result['data']   = $redisdata;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '更新首页模板信息失败';
		}
		return $this->result;
	}

	function getRedisDate($param){
		$data = array();
		foreach($param['indexs'] as $key=>$val){
			$data[$key]['photos'] = array();
			foreach ($val['detail'] as $d_key => $d_val) {
				if($d_val['type']==1){
					$data[$key]['photos'][$d_key]['goods'] = array();
					$data[$key]['photos'][$d_key]['goodsClassId'] = $d_val['relId'];
					$data[$key]['photos'][$d_key]['type'] = $d_val['type'];
					$data[$key]['photos'][$d_key]['photoUrl'] = $d_val['photoUrl'];
					$data[$key]['photos'][$d_key]['redirectUrl'] = '';
				}else if($d_val['type']==2){
					$data[$key]['photos'][$d_key]['goods'] = array(
						'normsValueId'=>$d_val['normsValueId'],
						'goodsId'=>$d_val['relId'],
						'preferentialPrice'=>$d_val['preferentialPrice'],
						'goodsName'=>$d_val['relName']
					);
					$data[$key]['photos'][$d_key]['goodsClassId'] = '';
					$data[$key]['photos'][$d_key]['type'] = $d_val['type'];
					$data[$key]['photos'][$d_key]['photoUrl'] = $d_val['photoUrl'];
					$data[$key]['photos'][$d_key]['redirectUrl'] = '';
				}else{
					$data[$key]['photos'][$d_key]['goods'] = array();
					$data[$key]['photos'][$d_key]['goodsClassId'] = '';
					$data[$key]['photos'][$d_key]['type'] = $d_val['type'];
					$data[$key]['photos'][$d_key]['photoUrl'] = $d_val['photoUrl'];
					$data[$key]['photos'][$d_key]['redirectUrl'] = $d_val['url'];
				}
			}
			$data[$key]['templateUrl'] = $val['forUrl'];
			$data[$key]['name'] = $val['templateName'];
			$data[$key]['status'] = $val['status'];
		}
		$redisDate['identifier'] = $param['identifier'];
		$redisDate['data'] = $data;
		return $redisDate;
	}

	public function delete($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		$id = $param['id'];
		$data  = $this->db->select($this->table_main,'identifier', $where);
		$ret = $this->db->delete($this->table_main,$where);
		if($ret)
		{
			$index_where = array(
				'where' => array(
					'mainId' => $id
				)
			);
			$index_data  = $this->db->select($this->table,'id', $index_where);
			$this->db->delete($this->table,$index_where);
			foreach ($index_data as $key => $val) {
				$detail_where = array(
					'where' => array(
						'indexId' => $val['id']
					)
				);
				$this->db->delete($this->table_detail,$detail_where);
			}
			$this->result['status'] = 1;
			$this->result['data']['identifier']   = $data['0']['identifier'];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '删除首页模板数据失败';
		}
		return $this->result;
	}
}