<?php

/**
 * 公共Redis模型处理
 *
 * @author  will.zeng@outlook.com
 * @date    2014-05-20
 * @version 1.0
 */
class rediscache
{
	//Redis
	public $redis = null;
	//REDIS KEY 前缀
	public $opi_key_prefix;
	//数据结果
	public $result = array(
		'status' => 0,
		'data'   => null
	);

	/**
	 * 初始化
	 */
	public function __construct(&$redis)
	{
		if(null != $redis)
		{
			$this->redis = $redis;
		}
		else
		{
			try
			{
				$this->redis = new Redis();
				$conn         = $this->redis->connect(REDIS_HOST, REDIS_PORT);
				if (!$conn)
				{
					$this->result['status'] = 22;
					$this->result['data'] = '无法连接redis服务器';
					
					return $this->result;
				}
			}
			catch (Exception $e)
			{
				$this->result['status'] = 21;
				$this->result['data'] = $e->getMessage();
				
				return $this->result;
			}
		}
		
		$this->opi_key_prefix = (!defined("OPT_KEY_PREFIX")) ? 'FCASSISTANT' : OPT_KEY_PREFIX;
		$this->redis->setOption(Redis::OPT_PREFIX, $this->opi_key_prefix . ':');
	}

	/**
	 * 根据一个或多个主键key生成Hashes类型KEY,支持批量生成
	 * table默认表示cache数据
	 * key为array时表示多个主键
	 *
	 * @param string $table 表名
	 * @param string $key 主键
	 * @return array
	 */
	public function getHashKey($key , $table='cache')
	{
		$key_array = array();

		if (!is_array($key))
		{
			return 'hash:' . $table . ":" . $key;
		}
		else
		{
			foreach ($key as $val)
			{
				$key_array[] = 'hash:' . $table . ":" . $val;
			}
		
			return $key_array;
		}
	}

	/**
	 * 获取hash数据
	 *
	 * @param string $key   键名
	 * @param array  $field 字段名
	 * @return array
	 */
	public function gethash($key, $field)
	{
		return $this->redis->hmget($key, $field);
	}

	/**
	 * 保存hash数据
	 *
	 * @param string $key  键名
	 * @param array  $data 数据
	 * @return array
	 */
	public function savehash($key, $data)
	{
		return $this->redis->hmset($key, $data);
	}

	/**
	 * 根据一个或多个主键key生成Sorted-Sets类型KEY,支持批量生成
	 * table默认表示cache数据
	 * key为array时表示多个主键
	 *
	 * @param string $table 表名
	 * @param string $key 主键
	 * @return array
	 */
	public function getZsetKey($key , $table='cache')
	{
		$key_array = array();

		if (!is_array($key))
		{
			return "zset:" . $table . ":" . $key;
		}
		else
		{
			foreach ($key as $val)
			{
				$key_array[] = "zset:" . $table . ":" . $val;
			}
		
			return $key_array;
		}
	}

	/**
	 * 获取有序集合数据
	 *
	 * @param string $key    键名
	 * @param string $order  排序规则，desc or asc
	 * @param int    $limit  起始位，默认0位第一位
	 * @param int    $offset 偏移量，默认-1为末位
	 * @return array
	 */
	public function getzset($key, $order = 'desc', $limit = 0, $offset = -1)
	{
		$limit  = (int)$limit;
		$offset = (0 == $offset) ? -1 : (int)$offset;
		if ('desc' == strtolower($order))
		{
			return $this->redis->zrevrange($key, $limit, $offset);
		}
		else
		{
			return $this->redis->zrange($key, $limit, $offset);
		}
	}

	/**
	 * 获取最大值或最小值
	 *
	 * @param string $key  键名
	 * @param string $type 最大或最小，max or min
	 * @return int
	 */
	public function getmaxmin($key, $type = 'max')
	{
		if ('max' == strtolower($type))
		{
			$data = $this->redis->zrevrange($key, 0, 0, true);
		}
		else
		{
			$data = $this->redis->zrange($key, 0, 0, true);
		}
		if (!empty($data))
		{
			foreach ($data as $val)
			{
				return $val;
			}
		}
		else
		{
			return 0;
		}
	}

	/**
	 * 保存有序集合数据
	 *
	 * @param string $key   键名
	 * @param int    $score 对应数据表的字段名
	 * @param int    $id    表记录主键ID
	 * @return array
	 */
	public function savezset($key, $score, $id)
	{
		return $this->redis->zadd($key, $score, $id);
	}

	/**
	 * 删除有序集合成员
	 *
	 * @param string $key 键名
	 * @param int    $id  表记录主键ID
	 * @return array
	 */
	public function delzset($key, $id)
	{
		return $this->redis->zrem($key, $id);
	}
}