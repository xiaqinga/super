<?php

/**
 * 商品积分
 *
 */
 
class goods_brokerage_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_brokerage';
	private $list  = 'goods_list';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'goods_brokerage';
		$this->list = DB_PREFIX . 'goods_list';
	}
	
	public function getlist($param){
		$where = array();
		if(!empty($param['goodsName'])){
		
			$where['like']['b.goodsName']  = $param['goodsName'];
			
		}
		if(!empty($param['providerName'])){
		
			$where['like']['info.providerName']  = $param['providerName'];
			
		}
		if(!empty($param['providerId'])){

			$where['where']['info.id']  = $param['providerId'];

		}
		$total  = $this->db->total($this->table.' a left join  '.$this->list. ' b on b.id = a.goodsId left join t_base_provider_ref as rf on rf.id=b.providerId left join t_base_enterprise_info as info on info.id=rf.refId', $where);
	
		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		$where['order']['a.id'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$this->result['data']['total'] = $total;
		
		$data  = $this->db->select($this->table.' a left join  '.$this->list. ' b on b.id = a.goodsId left join t_base_provider_ref as rf on rf.id=b.providerId left join t_base_enterprise_info as info on info.id=rf.refId','a.*,b.id as Only,b.goodsName,b.isGiveScore', $where);

		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
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
	
}