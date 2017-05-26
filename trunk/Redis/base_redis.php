<?php
/**
 * 公共Redis模型处理
 * @author janhve
 * @date   2016-05-20
 * @version 1.0
 */
 
class base_redis {
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
	
	/**
	 * 根据数据表和记录id生成Hashes类型KEY,支持批量生成
	 * table为string时表示取同一数据表，为array时表示取不同数据表
	 * id为int时表示一条记录id，为array时表示多条记录id
	 *
	 * @param string $table 表名
	 * @param int    $id    表记录主键ID
	 * @return array
	 */
	public function getHashKey($table, $id){
		$key_array = array();
		
		//单个数据表
		if(!is_array($table)){
			if(!is_array($id)){
				return 'hash:'. DB_PREFIX . $table . ":" . $id;
			}
			else{
				foreach($id as $val)
					$key_array[] = 'hash:'. DB_PREFIX . $table . ":" . $val;
				
				return $key_array;
			}
		}
		//多个数据表
		else{
			if(!is_array($id)){
				foreach($table as $val)
					$key_array[] = 'hash:'. DB_PREFIX . $val . ":" . $id;
				
				return $key_array;
			}
			else{
				if(count($table) <> count($id))
					return array('status'=>0,'data'=>'table与id的array长度不一致');
				
				foreach($table as $index=>$val)
					$key_array[$index] = 'hash:'. DB_PREFIX . $val . ":" . $id[$index];
				
				return $key_array;
			}
		}
	}
	
	/**
	 * 获取hash数据
	 * @param string $key 键名
	 * @param array $field 字段名
	 * @return array
	 */
	public function gethash($key,$field){
		return $this->redis->hmget($key,$field);
	}

	/**
	 * 保存hash数据
	 * @param string $key 键名
	 * @param array $data 数据
	 * @return array
	 */
	public function savehash($key,$data){
		return $this->redis->hmset($key,$data);
	}
	
	/**
	 * 根据数据表和表字段生成Sorted-Sets类型KEY,支持批量生成
	 * table为string时表示取同一数据表，为array时表示取不同数据表
	 * field为string时表示一个字段，为array时表示多个字段
	 *
	 * @param string $table 表名
	 * @param int    $id    表字段
	 * @return array
	 */
	public function getZsetKey($table, $field){
		$key_array = array();
		
		//单个数据表
		if(!is_array($table)){
			if(!is_array($field)){
				return "zset:". DB_PREFIX . $table . ":" . $field;
			}
			else{
				foreach($field as $val)
					$key_array[] = "zset:". DB_PREFIX . $table . ":" . $field;
				
				return $key_array;
			}
		}
		//多个数据表
		else{
			if(!is_array($field)){
				foreach($table as $val)
					$key_array[] = "zset:". DB_PREFIX . $val . ":" . $field;
				
				return $key_array;
			}
			else{
				if(count($table) <> count($field))
					return array('status'=>0,'data'=>'table与id的array长度不一致');
				
				foreach($table as $index=>$val)
					$key_array[$index] = "zset:". DB_PREFIX . $val . ":" . $field[$index];
				
				return $key_array;
			}
		}
	}
	
	/**
	 * 获取有序集合数据
	 * @param string $key 键名
	 * @param string $desc 排序规则，desc or asc
	 * @param int $limit 起始位，默认0位第一位
	 * @param int $offset 偏移量，默认-1为末位
	 * @return array
	 */
	public function getzset($key,$desc='desc',$limit=0,$offset=-1){
		$limit = (int)$limit;
		$offset= (empty($offset)) ? -1 : (int)$offset;
		if('desc' == strtolower($desc)){
			return $this->redis->zrevrange($key, $limit, $offset);
		}
		else{
			return $this->redis->zrange($key, $limit, $offset);
		}
	}
	
	/**
	 * 获取最大值或最小值
	 * @param string $key 键名
	 * @param string $type 最大或最小，max or min
	 * @return int
	 */
	public function getmaxmin($key,$type='max'){
		if('max' == strtolower($type)){
			$data = $this->redis->zrevrange($key, 0, 0, true);
		}
		else{
			$data = $this->redis->zrange($key, 0, 0, true);
		}
		if(!empty($data)){
			foreach($data as $val)
				return $val;
		}
		else
			return 0;
	}
	
	/**
	 * 保存有序集合数据
	 * @param string $key 键名
	 * @param int $score 对应数据表的字段名
	 * @param int $id 表记录主键ID
	 * @return array
	 */
	public function savezset($key,$score,$id){
		return $this->redis->zadd($key,$score,$id);
	}
	
	/**
	 * 删除有序集合成员
	 * @param string $key 键名
	 * @param int $id 表记录主键ID
	 * @return array
	 */
	public function delzset($key,$id){
		return $this->redis->zrem($key,$id);
	}
	
	/**
	 * 根据搜索关键字生成KEY
	 * @param string $table 表名
	 * @param $keyword 关键字
	 * @return array
	 */
	public function getSearchKey($table,$keyword){
		return DB_PREFIX.$table.":".$keyword;
	}
	
	/**
	 * 保存搜索结果
	 * @param string $key 键名
	 * @param array/string $value 值
	 * @return array
	 */
	public function savesearch($key,$value){
		$value = (is_array($value) || is_object($value)) ? serialize($value) : $value;
		return $this->redis->setex($key, REDIS_CACHE_TIME, $value);
	}
	
	/**
	 * 获取搜索结果
	 * @param string $key 键名
	 * @return array
	 */
	public function getsearch($key){
		return unserialize($this->redis->get($key));
	}
	
	/**
	 * 根据数据表和字段生成KEY
	 * @param string $table 表名
	 * @param array $field 对应数据表的字段名
	 * @param int $id 表记录主键ID
	 * @return array
	 */
	public function getKey($table,$field,$id){
		$key_array = array();
		foreach($field as $val){
			$key_array[$val] = DB_PREFIX.$table.":".$id.":".$val;
		}
		return $key_array;
	}
	
	/**
	 * 建立name到id的映射key
	 * @param string $table 表名
	 * @param array $name 用户名
	 * @return array
	 */
	public function getNameKey($table,$name){
		return DB_PREFIX.$table.":".$name.":id";
	}
	
	
}