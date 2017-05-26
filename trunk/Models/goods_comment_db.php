<?php

/**  
 * 评论表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class  goods_comment_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_comment';
	private $member = 'member_customer';
	private $list = 'goods_list';
	private $order = 'order_list';
	private $table_provider = '';
	private $table_enterprise = '';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'goods_comment';
		$this->member = DB_PREFIX . 'member_customer';
		$this->list = DB_PREFIX . 'goods_list';
		$this->order = DB_PREFIX . 'orders_list';
		$this->table_provider   =  DB_PREFIX . 'base_provider_ref';
		$this->table_enterprise =  DB_PREFIX . 'base_enterprise_info';
	}
	
	public function getlist($param){

		$where = array();


		if(!empty($param['key_type']) && !empty($param['key'])){
			
			if(($param['key_type']) == 'commentContent' )
			{
				$where['like']['a.commentContent']  = $param['key'];
			}
			
			if(($param['key_type']) == 'alias')
			{
				$where['like']['b.alias'] = $param['key'];
			}
			if(($param['key_type']) == 'commentLevel')
			{
				$where['where']['commentLevel IN '] = '('.$param['key'].')';
			}
			if(($param['key_type']) == 'goodsName')
			{
				$where['like']['c.goodsName'] = $param['key'];
			}

		}
		if (!empty($param['providerType'])) {
			$where['where']['d.providerType'] = $param['providerType'];
		}

		if(($param['key_type']) == 'createDate')
		{
			$where['where']['a.createDate >='] = $param['startDate'];
			$where['where']['a.createDate <='] = $param['endDate'];
		}

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}

		$total  = $this->db->total($this->table. ' a left join '.$this->member.
			' b on b.id =a.createUser '. ' left join ' .$this->list. ' c on c.id = a.goodsId left join
			 '.$this->table_provider.' as d on d.id=c.providerId left join ' .$this->order. ' f on 
			 a.ordersId= f.id left join '.$this->table_enterprise. ' e on d.refId =e.id ', $where);
		
		$this->result['data']['total'] = $total;

		$where['order']['a.id'] = 'DESC';
		
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table. ' a left join '.$this->member. ' b on b.id =a.createUser '.
		' left join ' .$this->list. ' c on c.id = a.goodsId left join '.$this->table_provider.' as d on 
		d.id=c.providerId left join '.$this->table_enterprise. ' f on d.refId =f.id left join '.$this->order. ' e on a.ordersId= e.id' ,
		'a.id,a.createDate,a.status,a.commentContent,a.commentLevel,a.photoIds,b.alias,c.goodsName,f.providerName,e.ordersNo',  $where);
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
			$ret   = $this->db->delete($this->table, $where);
			if ($ret)
			{
				$this->result['status'] = 1;
				$this->result['data']   = $param; //返回完整的记录信息
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
	 * 修改
	 *
	 * @param int $id
	 * @return bool
	 */
	function update($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret   = $this->db->update($this->table,$param,$where);
			if ($ret!==false)
			{
				$this->result['status'] = 1;
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
	 * 获取评论回复
	 *
	 * @param int $id
	 * @return string
	 */
     function getRereplyContent($param){
		if(!empty($param['id'])&&isset($param['id'])){
			$where['where']['commentId']=$param['id'];
			$ret=$this->db->select('t_goods_comment_reply','replyContent,id',$where);
		}
        return  $ret['0']['replyContent']?$ret['0']:'';
	 }
	/**
	 * 新增/修改评论回复
	 *
	 * @param array
	 * @return bool
	 */
	function setRereplyContent($param){
		 if(!empty($param['id'])&&isset($param['id'])){
			   $where['where']['id']=$param['id'];
				$resp=$this->db->update('t_goods_comment_reply',$param,$where);
			}else{
				$resp=$this->db->insert('t_goods_comment_reply',$param);
			}

		$this->result['status']=($resp!==false)?1:0;
		return $this->result;
	}
}