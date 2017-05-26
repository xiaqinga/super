<?php

/**
 * 商品规格表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-6
 * @version 1.0
 */
 
class goods_norms_name_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_norms_name';
	private $table_value = 'goods_norms_value';
	private $table_pre_value = 'pre_goods_norms_value';
	private $table_value_stock = 'goods_normsvalue_stock';
	private $table_norms_stock = 'goods_norms_stock';
	private $table_value_stock_ref = 'goods_norms_values_ref';
	private $table_add_norms_value = 'goods_add_norms_value';

	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'goods_norms_name';
		$this->table_value = DB_PREFIX . 'goods_norms_value';
		$this->table_pre_value = DB_PREFIX . 'pre_goods_norms_value';
		$this->table_value_stock = DB_PREFIX . 'goods_normsvalue_stock';
		$this->table_norms_stock = DB_PREFIX . 'goods_norms_stock';
		$this->table_value_stock_ref = DB_PREFIX . 'goods_norms_values_ref';
		$this->table_add_norms_value = DB_PREFIX . 'goods_add_norms_value';
		$this->table_pre_add_norms_value = DB_PREFIX . 'pre_goods_add_norms_value';
	}
	
	public function getlist($param){
		$where['where']['status'] = 1;

		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'normsName' )
			{
				$where['where']['normsName']  = $param['key'];
			}
		}
    if(!empty($param['status'])){
			$where['where']['status'] = $param['status'];
		}

		$total = $this->db->total($this->table, $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		
		$where['order']['id'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table, '', $where);
     
		//遍历规格表->规格值表
		if(!empty($data)){
			foreach ($data as $key => $value) {
				if($value['id']){
					$where_inner['where']['status !='] = 0;
					$where_inner['where']['normsId'] = $value['id'];
					$where_inner['order']['displayOrder'] = 'asc';
					$data_inner = $this->db->select($this->table_value, 'id,normsValue,displayOrder', $where_inner);

					if(!empty($data_inner)){
						$data[$key]['normsValueList'] = $data_inner;
						foreach ($data_inner as $k => $v) {
							$normsValue[] = $v['normsValue'];
						}
						$data[$key]['normsValueListJion'] = implode($normsValue,' , ');
						unset($normsValue);
					}
				}
			}
		}
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

	public function getlistpre($param){
		$where = array();

		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'normsName' )
			{
				$where['where']['normsName']  = $param['key'];
			}
		}

		$total = $this->db->total($this->table, $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
		$where['order']['id'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table, '', $where);

		//遍历规格表->规格值表
		if(!empty($data)){
			foreach ($data as $key => $value) {
				if($value['id']){
					$where_inner['where']['normsId'] = $value['id'];
					$where_inner['order']['displayOrder'] = 'asc';
					$data_inner = $this->db->select($this->table_pre_value, 'id,normsValue,displayOrder', $where_inner);

					if(!empty($data_inner)){
						$data[$key]['normsValueList'] = $data_inner;
						foreach ($data_inner as $k => $v) {
							$normsValue[] = $v['normsValue'];
						}
						$data[$key]['normsValueListJion'] = implode($normsValue,' , ');
						unset($normsValue);
					}
				}
			}
		}
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

	//查询规格名称和规格值
	public function getNormsNameValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE  a.id=".$param['id'];
			$data  = $this->db->select("SELECT CONCAT(b.normsName,':',a.normsValue) normsValue FROM ".$this->table_value." a INNER JOIN ".$this->table." b on b.id=a.normsId ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['attr']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询自定义的 规格名称和规格值
	public function getNormsNameAddValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE  a.id=".$param['id'];
			$data  = $this->db->select("SELECT CONCAT(b.normsName,':',a.normsValue) normsValue FROM ".$this->table_add_norms_value." a INNER JOIN ".$this->table." b on b.id=a.normsId ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['attr']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询规格预约名称和规格值
	public function getPreNormsNameValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE  a.id=".$param['id'];
			$data  = $this->db->select("SELECT CONCAT(b.normsName,':',a.normsValue) normsValue FROM t_pre_goods_norms_value a INNER JOIN ".$this->table." b on b.id=a.normsId ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['attr']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询自定义的 规格名称和规格值
	public function getPreNormsNameAddValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE  a.id=".$param['id'];
			$data  = $this->db->select("SELECT CONCAT(b.normsName,':',a.normsValue) normsValue FROM ".$this->table_pre_add_norms_value." a INNER JOIN ".$this->table." b on b.id=a.normsId ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['attr']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询规格名称和规格值
	public function getNormsNameRefValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE id=".$param['id'];
			$data  = $this->db->select("SELECT normsValueIds FROM ".$this->table_value_stock_ref." ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询预约规格名称和规格值
	public function getPreNormsNameRefValue($param){
		$where = "";
		if(!empty($param['id'])){
			$where .= " WHERE id=".$param['id'];
			$data  = $this->db->select("SELECT normsValueIds FROM t_pre_goods_norms_values_ref ".$where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询标准规格名称
	public function getNorms($param){
		$where = array();
		if(!empty($param['id'])){
			$where['where']['id']  = $param['id'];
			$data  = $this->db->select($this->table, '', $where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//获取所有规格值
	public function getAllNormsValue($param){
		$where = array();
		if(!empty($param['normsId'])){
			$where['where']['normsId']  = $param['normsId'];
			$where['where']['status']  = 1;
			$data  = $this->db->select($this->table_value, '', $where);
		}
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

	//获取预约所有规格值
	public function getAllPreNormsValue($param){
		$where = array();
		if(!empty($param['normsId'])){
			$where['where']['normsId']  = $param['normsId'];
			$where['where']['status']  = 1;
			$data  = $this->db->select($this->table_pre_value, '', $where);
		}
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

	//查询标准规格值
	public function getNormsValue($param){
		$where = array();
		if(!empty($param['id'])){
			$where['where']['id']  = $param['id'];
			$data  = $this->db->select($this->table_value, '', $where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询预约标准规格值
	public function getPreNormsValue($param){
		$where = array();
		if(!empty($param['id'])){
			$where['where']['id']  = $param['id'];
			$data  = $this->db->select($this->table_pre_value, '', $where);
			var_dump($data);
			exit;
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询对应商品的规格值
	public function getNormsAddValue($param){
		$where = array();
		if(!empty($param['id'])){
			$where['where']['id']  = $param['id'];
			$data  = $this->db->select($this->table_add_norms_value, '', $where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//查询对应预约商品的规格值
	public function getPreNormsAddValue($param){
		$where = array();
		if(!empty($param['id'])){
			$where['where']['id']  = $param['id'];
			$data  = $this->db->select('t_pre_goods_add_norms_value', '', $where);
		}
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']   = $data[0];
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	//根据商品Id查询商品的规格、库存、价格
	public function getGoodsNormsValueStock($param){
		$where = '';
		if(!empty($param['goodsId'])){
			$where .= " WHERE a.status>0 and a.goodsId=".$param['goodsId'];
			$data  = $this->db->select("SELECT a.id,a.goodsId,a.goodsNormsValueId,a.stockId,a.preferentialPrice,a.restockPrice,a.discount,b.stockNum as stockNum, c.normsValueIds,a.weight
																	FROM ".$this->table_value_stock." a join ".$this->table_norms_stock." b on b.id=a.stockId
																	join ".$this->table_value_stock_ref." c on a.goodsNormsValueId = c.id ".$where);
		}
	;
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

	//根据商品Id查询预约商品的规格、库存、价格
	public function getPreGoodsNormsValueStock($param){
		$where = '';
		if(!empty($param['preGoodsId'])){
			$where .= " WHERE a.status>0 and a.preGoodsId=".$param['preGoodsId'];
			$data  = $this->db->select("SELECT a.id,a.preGoodsId,a.goodsNormsValueId,a.stockId,a.originalPrice,a.preferentialPrice,a.distPrice,a.photosId,b.stockNum as stockNum, c.normsValueIds,a.weight
																	FROM t_pre_goods_normsvalue_stock a join t_pre_goods_norms_stock b on b.id=a.stockId
																	join t_pre_goods_norms_values_ref c on a.goodsNormsValueId = c.id ".$where);
		}
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
		$inner_ok = false; //规格值更新状态
		$normsValueList = json_decode(stripslashes($param['normsValueList']));
		unset($param['normsValueList']);

		$ret = $this->db->insert($this->table, $param);

		//遍历添加规格值
		foreach ($normsValueList as $key => $value) {
			$param_inner = array(
				'normsId' => $last_id?$last_id:$id,
				'normsValue' => $value->normsValue, 
				'displayOrder' => $value->displayOrder
			);

			$ret_inner = $this->db->insert($this->table_value, $param_inner);
			if($ret_inner){$inner_ok=true;}

		}

		if( $ret || $inner_ok ){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$inner_ok = false; //规格值更新状态
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
		$id = $param['id'];
		$normsValueList = json_decode(stripslashes($param['normsValueList']));
		$delValueIds = json_decode(stripslashes($param['delValueIds'])); 
		unset($param['normsValueList']);
		unset($param['delValueIds']);
		unset($param['id']);
		$ret = $this->db->update($this->table, $param, $where);
		$last_id = $this->db->last_id;

    $param['delpartids'] = stripslashes($param['delpartids']); 
    $delpartids = json_decode($param['delpartids'],true);
    if( count($delValueIds) > 0 ){
    	// var_dump($delValueIds);die();
     //    //删除规格值
     //    $dvl = implode(',', $delValueIds);
        
        $sql = "
			select GROUP_CONCAT(c.normsValueIds) as vids  from t_goods_list a
			INNER JOIN t_goods_normsvalue_stock b on b.goodsId =a.id
			INNER JOIN t_goods_norms_values_ref c on c.id=b.goodsNormsValueId
			where a.`status`=1 OR a.`status`=2 ;
		";
		$findValue = $this->db->select($sql);

		foreach ($delValueIds as $key => $value) {
			$sql_d = "
				select IFNULL(count(1),0) count from t_goods_norms_value a 
				where FIND_IN_SET(a.id,'".$findValue[0]['vids']."')
				and a.status=1 and a.id=".$value.";
			";
			$findIds = $this->db->select($sql_d);
			// var_dump($findIds);die();
			if ($findIds[0]['count'] == 0) {
				$delStatus = $this->db->update("update {$this->table_value} set status=0 WHERE  id={$value}");
				// var_dump($this->db->last_query());die();
			}
		}

        // $delStatus = $this->db->delete("DELETE FROM {$this->table_value} WHERE  id  IN ($dvl)");
    }
		//遍历更新/添加规格值
		foreach ($normsValueList as $key => $value) {
			$where_inner = array(
				'where' => array(
					'id' => $value->id
				)
			);
			$param_inner = array(
				'normsId' => $last_id?$last_id:$id,
				'normsValue' => $value->normsValue, 
				'displayOrder' => $value->displayOrder
			);
			if($value->id){
				$ret_inner = $this->db->update($this->table_value, $param_inner, $where_inner);
			}else{
				$ret_inner = $this->db->insert($this->table_value, $param_inner);
			}
			if($ret_inner){$inner_ok=true;}
		}
		if( $ret || $inner_ok || $delStatus){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table, '', $where);
			$this->result['data']   = $data[0];
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
			$param_inner = array(
				'status' => 0,
			);

			$sql = "
				select GROUP_CONCAT(c.normsValueIds) as vids  from t_goods_list a
				INNER JOIN t_goods_normsvalue_stock b on b.goodsId =a.id
				INNER JOIN t_goods_norms_values_ref c on c.id=b.goodsNormsValueId
				where a.`status`=1 OR a.`status`=2 ;
			";
			$findValue = $this->db->select($sql);
			
			$sql_v = "
				select GROUP_CONCAT(a.normsId) as nids from t_goods_norms_value a 
				where FIND_IN_SET(a.id,'".$findValue[0]['vids']."')
				and a.status=1;
			";
			$findIds = $this->db->select($sql_v);
			
			$sql_n = "
				select IFNULL(count(1),0) count from t_goods_norms_name a 
				where FIND_IN_SET(a.id,'".$findIds[0]['nids']."')
				and a.status=1 and a.id=".$param['id'].";
			";
			$findName = $this->db->select($sql_n);
			// var_dump($findName[0]['count'] );die();
			if ($findName[0]['count'] == 0) {
				//删除规格的值
				$this->db->update($this->table_value,$param_inner,$where);
		    //$this->db->delete("DELETE FROM {$this->table_value} WHERE  normsId = {$param['id']}");
		    //删除规格
				
				$ret   = $this->db->update($this->table,$param_inner,$where);
				if ($ret)
				{
					$this->result['status'] = 1;
					$this->result['data']   = $param; //返回完整的记录信息
				}
				else
				{
					$this->result['status'] = 0;
				}
			}else{
				$this->result['status'] = 0;
			}
		}
		else
		{
			$this->result['status'] = 0;
		}

		return $this->result;
	}
}