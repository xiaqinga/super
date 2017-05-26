<?php

/**
 * 商品分类表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */
 
class goods_class_redis extends base_redis {
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

	public function getItem($param){

	}
	public function getClassName($param){
		
	}

	public function getJson($param){

	}
	public function getChildClass($param){

	}
	public function findrepeat($param){
		
	}
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$this->deleteParent($param);
		foreach ($param['items'] as $key => $value) {
			$name_key = GOODSCLASS_CACHE.$key."_".$param['parentId'];
			$data = json_encode($value,JSON_UNESCAPED_UNICODE);
			$ret = $this->redis->set($name_key,$data);
		}
		
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

	public function test(){;
		//$ret = $this->redis->keys('*');
		//$ret = $this->redis->delete('$REDIS_CACHE_PROD_$GOODSCLASS_0');
		$ret = $this->redis->get('$REDIS_CACHE_PROD_$GOODSCLASS_0');
		print_r($ret);
		exit;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
	
		$this->deleteParent($param['data']);
		foreach ($param['data']['items'] as $key => $value) {
			$name_key = GOODSCLASS_CACHE.$key."_".$param['parentId'];
			$data = json_encode($value,JSON_UNESCAPED_UNICODE);
			$ret = $this->redis->set($name_key,$data);
		}
		if(!empty($param['beforeData'])){
			$this->deleteParent($param['beforeData']);
			foreach ($param['beforeData']['items'] as $key => $value) {
				$name_key = GOODSCLASS_CACHE.$key."_".$param['parentId'];
				$data = json_encode($value,JSON_UNESCAPED_UNICODE);
				$ret = $this->redis->set($name_key,$data);
			}
		}
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



	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	public function delete($param){
		$this->deleteParent($param);
		foreach ($param['items'] as $key => $value) {
			$name_key = GOODSCLASS_CACHE.$key."_".$param['parentId'];
			$data = json_encode($value,JSON_UNESCAPED_UNICODE);
			$ret = $this->redis->set($name_key,$data);
		}
		
		//$ret = $this->redis->set($name_key,'');
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

	public function deleteParent($param){
		$old_mallType = explode(',',$param['old_mallType']);
		foreach ($old_mallType as $key => $value) {

			$name_key = GOODSCLASS_CACHE.$value."_".$param['parentId'];
			$ret = $this->redis->del($name_key);
		}
	}

	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	public function pro_delete($param){
    $name_key = GOODSINDEX_PROVIDER.$param['providerId'];
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

	/**
	 * 更新分类缓存
	 *
	 * @param array   分类集合
	 * @return bool
	 */
	public function updatecahce($param){
		//商品分类
		 foreach ($param as $key=>$value){
			    foreach ($value as $k=>$v){
					$name_key = GOODSCLASS_CACHE.$key."_".$k;
					$data = json_encode($v,JSON_UNESCAPED_UNICODE);
					$ret = $this->redis->set($name_key,$data);
				}

		 }

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

	public function getAttr($param){}
}