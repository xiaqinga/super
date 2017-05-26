<?php

/**
 * 爆款专区
 *
 * @author wsbnet@qq.com
 * @since   2016-09-12
 * @version 1.0
 */
 
class base_moldbaby_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_moldbaby';
	private $list  = 'goods_list';

	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */

	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_moldbaby';
		$this->list = DB_PREFIX . 'goods_list';
	
		
	}

	public function getlist($param){
		$where = array();

		if(!empty($param['key']) && !empty($param['key_type'])){
		
			if( $param['key_type'] == 'activityName' )
			{
				$where['like']['activityName']  = $param['key'];
			}
			if( $param['key_type'] == 'identifier' )
			{
				$where['like']['identifier']  = $param['key'];
			}
			
		}
		$total = $this->db->total($this->table.' a ', $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		
		$where['order']['a.createDate'] = 'desc';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
	
		$data = $this->db->select($this->table.' a left join t_goods_list b on a.goodsId=b.id ','a.*,b.goodsName as goodsName', $where);
	
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
		$sql .= "select a.*,a.goodsName as agname,b.goodsName,c.providerName,d.preferentialPrice,e.stockNum,f.photoPath from t_base_activity_goods a
		INNER JOIN t_goods_list b on b.id=a.goodsid
		INNER JOIN t_base_provider_ref h on h.id=b.providerId
		INNER JOIN t_base_enterprise_info c on c.id=h.refId
		INNER JOIN t_goods_normsvalue_stock d on d.goodsId=a.goodsid 
		INNER JOIN t_goods_norms_stock e on e.id = d.stockId
		INNER JOIN t_goods_photo f on f.goodsId = a.goodsid 
		where b.status>0 and a.status>0 and f.displayOrder=0 and h.providerType=1 ";

		if( !empty($param['identifier']) ){
			$sql .= " and replace(a.identifier, ' ', '') like '%".$param['identifier']."%' and b.status>0 ";
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
			$ret_get = $this->db->select($this->table, 'id, identifier', $where);
			$where_inner['where'] = array('identifier' => $ret_get[0]['identifier']);
			$ret_inner   = $this->db->delete($this->act_goods, $where_inner); //删除次记录

			$ret   = $this->db->delete($this->table, $where); //删除主记录
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
					INNER JOIN t_base_provider_ref h on h.id=a.providerId
					INNER JOIN t_base_enterprise_info d on d.id=h.refId
					INNER JOIN t_goods_norms_stock e on e.id = c.stockId
					WHERE a.status=1 and c.status>0 and h.providerType=1";
		if(!empty($param['ids'])){
			$sql.=" and a.id not in({$param['ids']})";
		}

		if(!empty($param['goodsId'])){
			$sql.=" and a.id not in({$param['goodsId']})";
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
	 * 删除活动商品
	 *
	 * @param string $identifier
	 * @return bool
	 */
	public function updateActivityGoodsById($param){
		$sql = '';

		$sql = "update t_base_activity_goods set status=0
		where identifier='".$param['identifier']."' 
		and goodsId NOT IN(".$param['goodsId'].")";

		$ret = $this->db->update($sql);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
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

		$sql .= " update t_base_activity_goods SET ";

		if(!empty($param['goodsName'])){
			$sql .= " goodsName='".$param['goodsName']."', ";
		}

		if(!empty($param['originalPrice'])){
			$sql .= " originalPrice=".$param['originalPrice'].", ";
		}

		if(!empty($param['activityPrice'])){
			$sql .= " activityPrice=".$param['activityPrice'].", ";
		}

		if(!empty($param['activityNum'])){
			$sql .= " activityNum=".$param['activityNum'].", ";
		}

		if(!empty($param['updateUser'])){
			$sql .= " updateUser=".$param['updateUser'].", ";
		}

		$sql .= " updateDate=now(), ";
		$sql .= " status=1 ";
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
		$ret = $this->db->insert("t_base_activity_goods", $param);

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}

}