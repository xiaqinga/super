<?php

/**
 * 活动管理-秒抢专区表
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_seckill_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_seckill';
	private $goods = 'base_seckill_goods';
	private $times = 'base_seckill_times';

	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_seckill';
		$this->goods = DB_PREFIX . 'base_seckill_goods';
		$this->times = DB_PREFIX . 'base_seckill_times';
	
		
	}

	public function getseckill(){
		$sql = '';
		$sql .= 'select * from t_base_seckill where goodsType=0';
		$ret = $this->db->select($sql);
		return $ret;
	}

	public function getptseckill(){
		$sql = '';
		$sql .= 'select * from t_base_seckill where goodsType=1';
		$ret = $this->db->select($sql);
		return $ret;
	}

	public function getlist($param){
		$where = array();
		$where['where']['b.goodsType'] = 0;
		if(!empty($param['key']) && !empty($param['key_type'])){
		
			if( $param['key_type'] == 'seckillName' )
			{
				$where['like']['b.seckillName']  = $param['key'];
			}
			if( $param['key_type'] == 'identifier' )
			{
				$where['where']['a.identifier']  = $param['key'];
			}
			
		}
		$total = $this->db->total($this->times.' a LEFT JOIN ' .$this->table.' b on b.identifier=a.identifier ' , $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}

		$where['order']['a.createDate'] = 'desc';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
	
		$data = $this->db->select($this->times.' a LEFT JOIN '.$this->table.' b on b.identifier=a.identifier',' a.*,b.seckillName,b.id as bid,b.activityExpalin,b.goodsRestrictions', $where);

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

	public function getptlist($param){
		$where = array();
		$where['where']['b.goodsType'] = 1;
		if(!empty($param['key']) && !empty($param['key_type'])){
		
			if( $param['key_type'] == 'seckillName' )
			{
				$where['like']['b.seckillName']  = $param['key'];
			}
			if( $param['key_type'] == 'identifier' )
			{
				$where['where']['a.identifier']  = $param['key'];
			}
			
		}
		$total = $this->db->total($this->times.' a LEFT JOIN ' .$this->table.' b on b.identifier=a.identifier ' , $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}

		$where['order']['a.createDate'] = 'desc';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
	
		$data = $this->db->select($this->times.' a LEFT JOIN '.$this->table.' b on b.identifier=a.identifier',' a.*,b.seckillName,b.id as bid,b.activityExpalin,b.goodsRestrictions', $where);

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
		if (!empty($param['tid'])){
			$sql .= "select a.*,a.goodsName as agname,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
			from t_base_seckill_goods a
			INNER JOIN t_goods_list b on b.id=a.goodsId
			INNER JOIN t_base_enterprise_info c on c.id=b.providerId
			INNER JOIN t_goods_normsvalue_stock d on d.goodsId=a.goodsid 
			INNER JOIN t_goods_norms_stock e on e.id = d.stockId
			INNER JOIN t_goods_photo f on f.goodsId = a.goodsid and f.displayOrder=0
			where b.status>0 and f.displayOrder=0 and a.seckillTimesId=".$param['tid'];
			$sql_times = "select startDate,endDate from t_base_seckill_times where id=".$param['tid'];
			$s_times = $this->db->select($sql_times);
		}else{
			$sql .= "select a.*,a.goodsName as agname,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
			from t_base_activity_goods a
			INNER JOIN t_goods_list b on b.id=a.goodsId
			INNER JOIN t_base_enterprise_info c on c.id=b.providerId
			INNER JOIN t_goods_normsvalue_stock d on d.goodsId=a.goodsid 
			INNER JOIN t_goods_norms_stock e on e.id = d.stockId
			INNER JOIN t_goods_photo f on f.goodsId = a.goodsid and f.displayOrder=0
			where b.status>0 and f.displayOrder=0 ";
		}
		
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
	// print_r($this->db->last_query());die();
		if( !empty($data) )
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
			$this->result['times'] = $s_times;
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
		if (!empty($param['tid'])){
			$sql .= "select a.*,a.goodsName as agname,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
			from t_base_seckill_goods a
			INNER JOIN t_pre_goods_list b on b.id=a.goodsId
			INNER JOIN t_base_enterprise_info c on c.id=b.providerId
			INNER JOIN t_pre_goods_normsvalue_stock d on d.preGoodsId=a.goodsId 
			INNER JOIN t_pre_goods_norms_stock e on e.id = d.stockId
			INNER JOIN t_pre_goods_photo f on f.preGoodsId = a.goodsid and f.displayOrder=0
			where b.status>0 and f.displayOrder=0 and a.seckillTimesId=".$param['tid'];
			$sql_times = "select startDate,endDate from t_base_seckill_times where id=".$param['tid'];
			$s_times = $this->db->select($sql_times);
		}else{
			$sql .= "select a.*,a.goodsName as agname,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
			from t_base_activity_goods a
			INNER JOIN t_pre_goods_list b on b.id=a.goodsId
			INNER JOIN t_base_enterprise_info c on c.id=b.providerId
			INNER JOIN t_pre_goods_normsvalue_stock d on d.preGoodsId=a.goodsId 
			INNER JOIN t_pre_goods_norms_stock e on e.id = d.stockId
			INNER JOIN t_pre_goods_photo f on f.preGoodsId = a.goodsid and f.displayOrder=0
			where b.status>0 and f.displayOrder=0 ";
		}
		
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
		// var_dump($this->db->last_query());die();
	
		if( !empty($data) )
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
			$this->result['times'] = $s_times;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = 'NODATA';
		}
		return $this->result;
		
		
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->times, $param);
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
	public function timesUpdate($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update($this->times, $param, $where);
		if($ret){
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

			$ret_get = $this->db->select($this->times, 'id, identifier', $where);
			$where_inner['where'] = array('seckillTimesId' => $ret_get[0]['id']);
			$ret_inner   = $this->db->delete($this->goods, $where_inner); //删除次记录

			$ret   = $this->db->delete($this->times, $where); //删除主记录
			
			if ($ret)
			{
				$this->result['status'] = 1;
				$this->result['data']   = $ret_get[0]; 
			}
			else
			{
				$this->result['status'] = 0;
			}
		}
		else
		{
			$this->result['status'] = 0;
		}

		return $this->result;
	}

	/**
	 * 查看
	 */
	public function getTimes($param){
		if (!empty($param['id'])) {
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret = $this->db->select($this->times,'',$where);
			// var_dump($ret);die();

			$sql = '';
			if($param['goodsType'] == '0'){
				$sql .= "select a.*,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
					from t_base_seckill_goods a
					INNER JOIN t_pre_goods_list b on b.id=a.goodsId
					INNER JOIN t_base_enterprise_info c on c.id=b.providerId
					INNER JOIN t_pre_goods_normsvalue_stock d on d.preGoodsId=a.goodsId 
					INNER JOIN t_pre_goods_norms_stock e on e.id = d.stockId
					INNER JOIN t_pre_goods_photo f on f.preGoodsId = a.goodsid 
					where f.displayOrder=0 and a.seckillTimesId=". $ret['0']['id'] ." group by a.id";
			}elseif($param['goodsType'] == '1'){
				$sql .= "select a.*,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath 
					from t_base_seckill_goods a
					INNER JOIN t_goods_list b on b.id=a.goodsId
					INNER JOIN t_base_enterprise_info c on c.id=b.providerId
					INNER JOIN t_goods_normsvalue_stock d on d.goodsId=a.goodsId 
					INNER JOIN t_goods_norms_stock e on e.id = d.stockId
					INNER JOIN t_goods_photo f on f.goodsId = a.goodsid 
					where f.displayOrder=0 and a.seckillTimesId=". $ret['0']['id'] ." group by a.id";
			}
			
			// b.status>0 and a.status>0 and
			$total = $this->db->total($sql);

			if( !empty($param['limit']) )
			{
				$sql .= " limit ".$param['limit'];
			}
			$data = $this->db->select($sql);
			// var_dump($this->db->last_query());die();
			// $where_good = array(
			// 	'where' => array(
			// 		'seckillTimesId' = $ret['0']['id']
			// 	),
			// 	'limit' => $param['limit']
			// );
			// $where_good['where']['seckillTimesId'] = $ret['0']['id'];
			// $ret_good = $this->db->select($this->goods,$where_good);
			if ($data) {
				$this->result['status'] = 1;
				$this->result['data']['times'] = $ret['0']; 
				$this->result['data']['goods'] = $data;
				$this->result['data']['total'] = $total;
			}else{
				$this->result['status'] = 0;
			}
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}
	

	public function getGoodsInfoListByPage($param){
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
					INNER JOIN t_base_enterprise_info d on d.id=a.providerId
					INNER JOIN t_goods_norms_stock e on e.id = c.stockId
					WHERE a.status=1 and c.status>0 ";
		if(!empty($param['ids'])){
			$sql.=" and a.id not in({$param['ids']})";
		}

		if(!empty($param['goodsIds'])){
			$sql.=" and a.id not in({$param['goodsIds']})";
		}

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

	public function getPreGoodsInfoListByPage($param){
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
					INNER JOIN t_base_enterprise_info d on d.id=a.providerId
					INNER JOIN t_pre_goods_norms_stock e on e.id = c.stockId
					WHERE
						a.status=1 and c.status>0";
		if(!empty($param['ids'])){
			$sql.=" and a.id not in({$param['ids']})";
		}

		if(!empty($param['goodsIds'])){
			$sql.=" and a.id not in({$param['goodsIds']})";
		}

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

	/**
	 * 更新活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function updateActivityGoods($param){
		$sql = '';

		$sql .= " update t_base_seckill_goods SET ";

		if(!empty($param['goodsName'])){
			$sql .= " goodsName='".$param['goodsName']."', ";
		}

		if(!empty($param['originalPrice'])){
			$sql .= " originalPrice=".$param['originalPrice'].", ";
		}

		if(!empty($param['seckillPrice'])){
			$sql .= " seckillPrice='".$param['seckillPrice']."', ";
		}

		if(!empty($param['seckillNum'])){
			$sql .= " seckillNum=".$param['seckillNum'].", ";
		}

		if(!empty($param['updateUser'])){
			$sql .= " updateUser=".$param['updateUser'].", ";
		}

		$sql .= " updateDate=now() ";
		// $sql .= " status=1 ";
		$sql .= " where identifier='".$param['identifier']."' and goodsId=".$param['goodsId']." ";
		$ret = $this->db->update($sql);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 添加活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function insertActivityGoods($param){
		$ret = $this->db->insert("t_base_seckill_goods", $param);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}


	/**
	 * 启用商品
	 */
	public function upstore($param){
		if(!empty($param['id'])){
			$sql = '';

			$sql .= " update t_base_seckill_goods SET status=1 where id=".$param['id'];

			$ret = $this->db->update($sql);
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}
	/**
	 * 禁用商品
	 */
	public function downstore($param){
		if(!empty($param['id'])){
			$sql = '';

			$sql .= " update t_base_seckill_goods SET status=0 where id=".$param['id'];

			$ret = $this->db->update($sql);
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 判断秒抢日期
	 */
	public function seckillTime($param){
		$sql = "";
		$sql = "select * from t_base_seckill_times where (startDate > '".$param['startDate']."' AND startDate < '".$param['endDate']."') OR (startDate < '".$param['startDate']."' AND endDate > '".$param['endDate']."') OR (endDate > '".$param['startDate']."' AND endDate < '".$param['endDate']."') "; 
		
		$ret = $this->db->select($sql);

		if($ret){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}	
		
		return $this->result;
	}

}