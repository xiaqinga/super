<?php

/**
 * 评论表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class  goods_comment_appointment_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'goods_comment';
	private $member = 'member_customer';
	private $list = 'goods_list';
	
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
	}
	
	public function getlist($param){

		$where = array();	
		$where['where']['goodsType'] = "pre";
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
				$where['where']['a.commentLevel IN '] = '('.$param['key'].')';
			}
			if(($param['key_type']) == 'goodsName')
			{
				$where['like']['c.goodsName'] = $param['key'];
			}

		}
	
			if(($param['key_type']) == 'createDate')
			{
				$where['where']['a.createDate >='] = $param['startDate'];
				$where['where']['a.createDate <='] = $param['endDate'];
			}
		$total  = $this->db->total($this->table. ' a left join '.$this->member. ' b on b.id =a.createUser '. ' left join ' .$this->list. ' c on c.id = a.goodsId' , $where);
		$this->result['data']['total'] = $total;
	
		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		$where['order']['a.id'] = 'ASC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table. ' a left join '.$this->member. ' b on b.id =a.createUser '. ' left join ' .$this->list. ' c on c.id = a.goodsId' ,'a.id,a.createDate,a.status,a.commentContent,a.commentLevel,a.photoIds,b.alias,c.goodsName',  $where);

		
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

}