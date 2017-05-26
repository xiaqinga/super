<?php

/**
 * Session 基于Redis实现的session类
 * 
 * 
 * @since          2014-10-09
 * @author			zeng.will@outlook.com
 * @version		Version 1.0
 */

class SessionRedis extends SessionDriver{
	
	/**
     * redis object class
     */
	var $redis					= null;
	/**
     * redis prefix
     */
	var $sess_key_prefix		= null;
	
    /**
     * 初始化
     * @param $config 初始化配置
     */
	public function __construct($config = array())
	{
		$this->_init($config);
		parent::__construct($config);
	}
	
    /**
     * 初始化
     * @param $config 初始化配置
     */
	private function _init($config)
	{
		$this->sess_key_prefix = (!defined('OPT_KEY_PREFIX') || '' == OPT_KEY_PREFIX) ? 'sess_key_prefix' : OPT_KEY_PREFIX;
		if( !defined('REDIS_AUTO_ON') || FALSE === REDIS_AUTO_ON )
		{
			try
			{
				$this->redis  = new Redis();
				$conn         = $this->redis->connect(REDIS_HOST, REDIS_PORT);
				if (!$conn)
				{
					$this->result = array(
						'status' => 0,
						'data'   => 'Libraries Session[ SessionRedis ] 启动失败，无法连接redis服务器!'
					);
				}
				else
				{
					$this->result = array(
						'status' => 1,
						'data'   => 'Libraries Session 启动成功!'
					);
					$this->redis->setOption(Redis::OPT_PREFIX, $this->sess_key_prefix . ':');
				}
			}
			catch (Exception $e)
			{
				$this->result = array(
					'status' => 0,
					'data'   => 'Libraries Session[ SessionRedis ] 启动失败，' . $e->getMessage()
				);
			}
		}
		else
		{
			if(is_array($config))
			{
				if(array_key_exists('redis',$config))
				{
					$this->redis  = $config['redis'];
					$this->result = array(
						'status' => 1,
						'data'   => 'Libraries Session 启动成功!'
					);
					$this->redis->setOption(Redis::OPT_PREFIX, $this->sess_key_prefix . ':');
				}
				else
				{
					$this->result = array(
						'status' => 0,
						'data'   => 'Libraries Session[ SessionRedis ] 启动失败，没有开启Redis服务!'
					);
				}
			}
			elseif(is_object($config))
			{
				$this->redis     = $config;
				$this->result = array(
					'status' => 1,
					'data'   => 'Libraries Session 启动成功!'
				);
				$this->redis->setOption(Redis::OPT_PREFIX, $this->sess_key_prefix . ':');
			}
			else
			{
				$this->result = array(
					'status' => 0,
					'data'   => 'Libraries Session[ SessionRedis ] 启动失败，没有开启Redis服务!'
				);
			}
		}
	}
	
    /**
     * 打开session操作句柄
     * @param string $save_path
	 * @param mixed $sess_name
	 * @return bool
     */
	public function open($save_path='',$sess_name='')
	{
		$this->sess_id = session_id();
		return true;
	}
	
    /**
     * 关闭session
	 * @return bool
     */
	public function close()
	{
		return $this->redis->close();
	}
    
    /**
     * 获取session，返回session id
     * @param string $sess_id session id
	 * @return string
     */
    public function read($sess_id='')
	{
		$data = $this->redis->hGetAll($this->sess_id);
		if(!empty($data))
		{
			$this->sess_data = $data;
		}
		else
		{
			$this->sess_data = array();
			$this->write();
		}
		return $this->sess_id;
	}
	
    /**
     * 设置session
     * @param string $sess_id session id
	 * @param string $sess_data session value
	 * @return bool
     */
    public function write($sess_id='',$sess_data='')
	{
		$this->redis->delete($this->sess_id);
		$this->redis->hMset($this->sess_id,$this->sess_data);
		$this->redis->setTimeout($this->sess_id,(int)$this->sess_expiration);
		return true;
	}
	
    /**
     * 删除session
     * @param string $sess_id session id
	 * @return bool
     */
    public function destroy($sess_id='')
	{
		return $this->redis->delete($this->sess_id);
	}

    /**
     * 回收session
	 * @return bool
     */
    public function gc()
	{
		return true;
	}
	
    /**
     * 定义session处理机制
     * @return bool
     */
	public function exec()
	{
		session_set_save_handler(
			array(&$this,"open"),
			array(&$this,"close"),
			array(&$this,"read"),
			array(&$this,"write"),
			array(&$this,"destroy"),
			array(&$this,"gc")
		);
	}
	
    /**
     * 获取session某个key值
     * @param $key session key
	 * @return mixed
     */
    public function get($key)
	{
		return (array_key_exists($key,$this->sess_data))
				? $this->sess_data[$key]
				: '';
	}

    /**
     * 设置session某个key值
     * @param mixed $key session key
	 * @param string $value session key value
	 * @return bool
     */
    public function set($key=array(),$value='')
	{
		$key = is_array($key) ? $key : array($key=>$value);
		if(!empty($key))
		{
			foreach($key as $index=>$val)
			{
				$this->sess_data[$index] = $val;
			}
			$this->write();
		}
		return true;
	}
	
    /**
     * 删除session某个key值
     * @param mixed $key session key
	 * @return bool
     */
    public function del($key)
	{
		$key = is_array($key) ? $key : array($key);
		if(!empty($key))
		{
			foreach($key as $val)
			{
				if(array_key_exists($val,$this->sess_data))
				{
					unset($this->sess_data[$val]);
				}
			}
			$this->write();
		}
		return true;
	}
}