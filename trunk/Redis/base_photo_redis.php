<?php
/**
 * 公共Redis模型处理
 * @author janhve
 * @date   2016-05-20
 * @version 1.0
 */
 
class base_photo_redis {
	//Redis
	protected $redis = NULL;
	//REDIS KEY 前缀
	private $opi_key_prefix;
	//数据结果
	protected $result = array('status'=>0,'data'=>NULL);
	
	
	/**
	 * 初始化
	 */
	public function __construct(&$redis){
		$this->redis = $redis;
		//$this->opi_key_prefix = (!defined("OPT_KEY_PREFIX")) ? 'MAHUA' : OPT_KEY_PREFIX;
		$this->redis->setOption(Redis::OPT_PREFIX,'');
	}
	
	public function getlist($param){
		
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		
	}

	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		
	}
	
	
}