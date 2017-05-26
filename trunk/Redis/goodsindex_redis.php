<?php

/**
 * 首页模板管理REDIS
 * @author janhve@163.com
 * @since   2016-08-30
 * @version 1.0
 */
 
class goodsindex_redis extends base_redis {
	//后台用户数据表
	private $admin_user_table = 'user';
	//后台用户表字段
	private $admin_user_field = array('user_id','user_name','password','name','tel','email','role_id','status','created_time','updated_time');
	
	/**
	 * 初始化
	 */
	public function __construct(&$redis){
		parent::__construct($redis);
	}
	
	public function getlist($param){
		
	}
	
	public function getIndexInfo($param){
		
	}
	
	public function selectGoodsIndexMainIdentifier($param){
		
	}
	
	public function create($param){
		$name_key = GOODSINDEX_KEY.$param['identifier'];
		$data = json_encode($param['data'],JSON_UNESCAPED_UNICODE);
		$ret = $this->redis->set($name_key,$data);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data'] = 'Redis数据存储成功';
		}
		else{
			$this->result['status'] = 0;
			$this->result['data'] = 'Redis数据存储失败';
		}
		return $this->result;
	}
	
	public function update($param){
		$name_key = GOODSINDEX_KEY.$param['identifier'];
		$data = json_encode($param['data'],JSON_UNESCAPED_UNICODE);

		$ret = $this->redis->set($name_key,$data);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data'] = 'Redis数据存储成功';
		}
		else{
			$this->result['status'] = 0;
			$this->result['data'] = 'Redis数据存储失败';
		}
		return $this->result;
	}
	 
	public function delete($param){
		$name_key = GOODSINDEX_KEY.$param['identifier'];
		$ret = $this->redis->del($name_key);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data'] = 'Redis数据删除成功';
		}
		else{
			$this->result['status'] = 0;
			$this->result['data'] = 'Redis数据删除失败';
		}
		return $this->result;
	}
	
}