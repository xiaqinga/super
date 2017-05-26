<?php

/**
 * 转让分类表模型
 *
 */
 
class base_group_buy_db {
	//Db
	private $db = NULL;
	private $table = 'base_group_buy';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_group_buy';
	}
	
	public function getlist($param){
		$where = '';
		if(!empty($param['key']) && !empty($param['key_type'])){
			if( $param['key_type'] == 'goodsName' )
			{
				$where .= " and b.goodsName like '%".$param['key']."%'";
			}
			
			if( $param['key_type'] == 'name' )
			{
				$where .= " and a.name like '%".$param['key']."%'";
			}

			if( $param['key_type'] == 'price' )
			{
				$where .= " and a.price = ".$param['key'];
			}
		}

		$sql_t = "(SELECT a.*,a.goodsName as agname,b.goodsName FROM t_base_group_buy as a 
			LEFT JOIN t_goods_list as b on a.goodsId=b.id
			WHERE a.goodsType=1 " .$where. ") UNION (SELECT a.*,a.goodsName as agname,b.goodsName FROM t_base_group_buy as a 
			LEFT JOIN t_pre_goods_list as b on a.goodsId=b.id
			WHERE a.goodsType=0 " .$where. ")";

		if (!empty($param['id'])) {
			$where .= ' and a.id='.$param['id'];
		}
		
		$where .= ' order by createtime DESC ';
		if( isset($param['limit']) )
		{
			$limit = ' limit '.$param['limit'];
		}
		
		$sql .= "
			(SELECT a.*,a.goodsName as agname,b.goodsName FROM t_base_group_buy as a 
			LEFT JOIN t_goods_list as b on a.goodsId=b.id
			WHERE a.goodsType=1 ".$where.") UNION (SELECT a.*,a.goodsName as agname,b.goodsName FROM t_base_group_buy as a 
			LEFT JOIN t_pre_goods_list as b on a.goodsId=b.id
			WHERE a.goodsType=0 ".$where.") ".$limit."
		";
		// var_dump($sql);exit();
		$total = $this->db->total($sql_t);
		$this->result['data']['total'] = $total;
		$data  = $this->db->select($sql);
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

	public function getlistinfo($param){
		if(!empty($param['id'])){
			$where = " and a.id=".$param['id'];
			$where .= " GROUP BY a.id";
			if ($param['goodsType'] == '1') {
				$sql = "
					SELECT a.*,d.providerName,e.photoPath,b.preferentialPrice,f.stockNum as fNum 
					FROM t_base_group_buy as a
					LEFT JOIN t_goods_normsvalue_stock as b on a.goodsId=b.goodsId
					LEFT JOIN t_goods_list as c ON c.id=a.goodsId
					LEFT JOIN t_base_provider_ref as h on h.id=c.providerId
					LEFT JOIN t_base_enterprise_info as d ON d.id=h.refId
					LEFT JOIN t_goods_photo as e ON e.goodsId=a.goodsId 
					LEFT JOIN t_goods_norms_stock as f ON f.id=b.stockId
					WHERE a.goodsType=1 and h.providerType=1
				".$where;
			}elseif($param['goodsType'] == '0'){
				$sql = "
					SELECT a.*,d.providerName,e.photoPath,b.preferentialPrice,f.stockNum as fNum 
					FROM t_base_group_buy as a
					LEFT JOIN t_pre_goods_normsvalue_stock as b on a.goodsId=b.preGoodsId
					LEFT JOIN t_pre_goods_list as c ON c.id=a.goodsId
					LEFT JOIN t_base_enterprise_info as d ON d.id=c.providerId
					LEFT JOIN t_pre_goods_photo as e ON e.preGoodsId=a.goodsId 
					LEFT JOIN t_pre_goods_norms_stock as f ON f.id=b.stockId
					WHERE a.goodsType=0
				".$where;
			}

			$data = $this->db->select($sql);
			if( !empty($data) )
			{
				$this->result['status'] = 1;
				$this->result['data']['list']   = $data;
			}
			else
			{
				$this->result['status'] = 0;
				$this->result['data']   = 'NODATA';
			}
			return $this->result;
		}

	}

	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table, $param);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
			$this->result['data']['id']  = $this->db->last_id;
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
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 删除
	 */
	public function delete($param){
		if (!empty($param['id'])) {
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret   = $this->db->delete($this->table, $where); 
			
			if ($ret)
			{
				$this->result['status'] = 1;
				$this->result['data']   = $param; 
			}
			else
			{
				$this->result['status'] = 0;
			}
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 查询商品信息
	 */
	public function findgoods($param){
		if(!empty($param)){
			$where = array(
				'where' => array(
					'id' => $param['goodsId']
				)
			);
			if ($param['goodsType'] == '1') {
				$resp = $this->db->select('t_goods_list as a left join t_goods_normsvalue_stock as b on b.goodsId=a.id 
					left join t_base_enterprise_account as c on c.id=a.providerId 
					left join t_goods_norms_stock as d on d.id=b.stockId 
					left join t_goods_photo as e on e.goodsId=a.id 
					','a.goodsName,b.preferentialPrice,c.providerName,d.stockNum,e.photoPath',$where);
			}elseif($param['goodsType'] == '0'){
				$resp = $this->db->select('t_pre_goods_list as a left join t_pre_goods_normsvalue_stock as b on b.goodsCode=a.id 
					left join t_base_enterprise_account as c on c.id=a.providerId 
					left join t_pre_goods_normsvalue_stock as d on d.id=b.stockId 
					left join t_pre_goods_photo as e on e.preGoodsId=a.id 
					','a.goodsName,b.preferentialPrice,c.providerName,d.stockNum,e.photoPath',$where);
			}
			if ($resp) {
				$this->result['status'] = 1;
				$this->result['data']   = $param; 
			}else{
				$this->result['status'] = 0; 
			}
			
		}else{
			$this->result['status'] = 0; 
		}
		return $this->result;
	}


	public function getGoodsInfoListByPage($param){
		// var_dump($param);exit();
		$sql='';
		$sql.="SELECT a.id, a.goodsName,
						(
							SELECT
								b.photoPath
							FROM
								t_goods_photo b
							WHERE
								b.goodsId = a.id and b.displayOrder=0
							ORDER BY
								b.displayOrder
							LIMIT 0,1
						) photoPath,
						max(c.preferentialPrice)  highestPrice,
						min(c.preferentialPrice) lowestPrice,
						a.status,d.providerName,c.originalPrice,e.stockNum
					FROM
						t_goods_list a 
					INNER JOIN t_goods_normsvalue_stock c on a.id=c.goodsId
					INNER JOIN t_base_provider_ref f on a.providerId=f.id
					INNER JOIN t_base_enterprise_info d ON d.id = f.refId
					INNER JOIN t_goods_norms_stock e on e.id = c.stockId
					WHERE a.status=1 and c.status>0 and f.providerType=1 ";
		if(!empty($param['ids'])){
			$sql.=" and a.id not in({$param['ids']})";
		}

		// if(!empty($param['goodsIds'])){
		// 	$sql.=" and a.id not in({$param['goodsIds']})";
		// }

		if(!empty($param['goodsName'])){
			$sql.=" and a.goodsName like '%{$param['goodsName']}%'";
		}
			
		$sql.=" GROUP BY a.id";

		$total = $this->db->total($sql);

		$this->result['data']['total'] = $total;

		if(!empty($param['limit'])){
			$sql.=" limit {$param['limit']}";
		}
	
		$data = $this->db->select($sql);
		// print_r($this->db->last_query());exit;
		// var_dump($this->db->last_query());
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
	}

	public function getPreGoodsInfoListByPage($param){
		// var_dump($param);exit();
		$sql='';
		$sql.="SELECT a.id, a.goodsName,
						(
							SELECT
								b.photoPath
							FROM
								t_pre_goods_photo b
							WHERE
								b.preGoodsId = a.id and b.displayOrder=0
							ORDER BY
								b.displayOrder
							LIMIT 0,1
						) photoPath,
						max(c.preferentialPrice)  highestPrice,
						min(c.preferentialPrice) lowestPrice,
						a.status,d.providerName,c.originalPrice,e.stockNum
					FROM
						t_pre_goods_list a 
					INNER JOIN t_pre_goods_normsvalue_stock c on a.id=c.preGoodsId
					INNER JOIN t_base_enterprise_info d ON d.id = a.providerId
					INNER JOIN t_pre_goods_norms_stock e on e.id = c.stockId
					WHERE
						a.status=1 and c.status>0";
		if(!empty($param['ids'])){
			$sql.=" and a.id not in({$param['ids']})";
		}

		// if(!empty($param['goodsIds'])){
		// 	$sql.=" and a.id not in({$param['goodsIds']})";
		// }

		if(!empty($param['goodsName'])){
			$sql.=" and a.goodsName like '%{$param['goodsName']}%'";
		}
			
		$sql.=" GROUP BY a.id";

		$total = $this->db->total($sql);

		$this->result['data']['total'] = $total;

		if(!empty($param['limit'])){
			$sql.=" limit {$param['limit']}";
		}
	
		$data = $this->db->select($sql);
	
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
	}

	public function queryGoods($param){
		$sql = '';
		$sql .= "select a.*,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
		from t_base_group_buy a
		INNER JOIN t_goods_list b on b.id=a.goodsId
		INNER JOIN t_base_provider_ref h on h.id=b.providerId
		INNER JOIN t_base_enterprise_info c on c.id=h.refId
		INNER JOIN t_goods_normsvalue_stock d on d.goodsId=a.goodsid 
		INNER JOIN t_goods_norms_stock e on e.id = d.stockId
		INNER JOIN t_goods_photo f on f.goodsId = a.goodsid and f.displayOrder=0
		where b.status>0 and a.status>0 and f.displayOrder=0 and h.providerType=1";

		if( !empty($param['identifier']) ){
			$sql .= " and replace(a.identifier, ' ', '') = '".$param['identifier']."'";
		}

		if( !empty($param['providerId']) ){
			$sql .= " and b.providerId = ".$param['providerId'];
		}

		if( !empty($param['goodsName']) ){
			$sql .= " and replace(b.goodsName, ' ', '') like '%".$param['goodsName']."%'";
		}

		$sql .= " GROUP BY a.id";
		$total = $this->db->total($sql);

		if( !empty($param['limit']) )
		{
			$sql .= " limit ".$param['limit'];
		}
		$this->result['data']['total'] = $total;
		$data = $this->db->select($sql);
	
		if( !empty($data) )
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
	}

	public function queryPreGoods($param){
		$sql = '';
		$sql .= "select a.*,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
		from t_base_group_buy a
		INNER JOIN t_pre_goods_list b on b.id=a.goodsId
		INNER JOIN t_base_enterprise_info c on c.id=b.providerId
		INNER JOIN t_pre_goods_normsvalue_stock d on d.preGoodsId=a.goodsId 
		INNER JOIN t_pre_goods_norms_stock e on e.id = d.stockId
		INNER JOIN t_pre_goods_photo f on f.preGoodsId = a.goodsid and f.displayOrder=0
		where b.status>0 and a.status>0 and f.displayOrder=0 ";

		if( !empty($param['identifier']) ){
			$sql .= " and replace(a.identifier, ' ', '') = '".$param['identifier']."'";
		}

		if( !empty($param['providerId']) ){
			$sql .= " and b.providerId = ".$param['providerId'];
		}

		if( !empty($param['goodsName']) ){
			$sql .= " and replace(b.goodsName, ' ', '') like '%".$param['goodsName']."%'";
		}

		$sql .= " GROUP BY a.id";

		$total = $this->db->total($sql);
		if( !empty($param['limit']) )
		{
			$sql .= " limit ".$param['limit'];
		}
		$this->result['data']['total'] = $total;
		$data = $this->db->select($sql);
	
		if( !empty($data) )
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
	}
}