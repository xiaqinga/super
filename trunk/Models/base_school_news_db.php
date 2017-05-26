<?php

/**
 * 校企资讯体表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
  
class base_school_news_db{
	//Db
	private $db = NULL;
	//database table
	private $table = '';

	//数据结果
	private $result = array('status'=>0,'data'=>NULL);

	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_maker_news';

		
	}
	
	public function getlist($param){
		$where = array();
		if(!empty($param['key_type']) && !empty($param['key'])){
		
			if(($param['key_type']) == 'title' )
			{
				$where['like']['title']  = $param['key'];
			}


			if($param['key_type'] == 'status'){
		
			$where['where']['status']  = $param['key'];
			
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

		$data  = $this->db->select($this->table,'',$where);

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
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table, $param);
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
		if($ret!==false){
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