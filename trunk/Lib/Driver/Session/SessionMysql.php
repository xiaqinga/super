<?php

/**
 * Session 基于Mysql实现的session类
 * 
 * 
 * @since          2014-10-09
 * @author			zeng.will@outlook.com
 * @version		Version 1.0
 */

class SessionMysql extends SessionDriver{
	
	/**
     * db object class
     */
	var $db					= null;
	/**
     * db session table
     */
	var $sess_table			= null;
	
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
		if( !defined('SESSION_TABLE_NAME') || '' == SESSION_TABLE_NAME )
		{
			$this->result = array(
				'status' => 0,
				'data'   => 'Libraries Session[ SessionMysql ] 启动失败，没有定义session表!'
			);
		}
		else
		{
			$this->sess_table = SESSION_TABLE_NAME;
			if(is_array($config))
			{
				if(array_key_exists('db',$config))
				{
					$this->db   = $config['db'];
					$this->result = array(
						'status' => 1,
						'data'   => 'Libraries Session 启动成功!'
					);
				}
			}
			elseif(is_object($config))
			{
				$this->db       = $config;
				$this->result = array(
					'status' => 1,
					'data'   => 'Libraries Session 启动成功!'
				);
			}
			else
			{
				$this->result = array(
					'status' => 0,
					'data'   => 'Libraries Session[ SessionMysql ] 启动失败，缺少db对象!'
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
		return true;
	}
    
    /**
     * 获取session，返回session id
     * @param string $sess_id session id
	 * @return string
     */
    public function read($sess_id='')
	{
		$data = $this->db->query("SELECT * FROM " . $this->sess_table . " WHERE sess_id ='" . $this->sess_id . "'");
		if(!empty($data))
		{
			$this->sess_data = json_decode($data[0]['sess_data'],true);
		}
		else
		{
			$this->sess_data = array();
			$this->write();
		}
		$this->gc();
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
		$sessdata		= json_encode($this->sess_data);
		$last_activity = time() + (int)$this->sess_expiration;
		return $this->db->execute("INSERT INTO " . $this->sess_table . " (sess_id,last_activity,sess_data) VALUES ('" . $this->sess_id . "', '" . $last_activity . "', '" . $sessdata . "')");
	}
	
    /**
     * 删除session
     * @param string $sess_id session id
	 * @return bool
     */
    public function destroy($sess_id)
	{
		return $this->db->execute("DELETE FROM " . $this->sess_table . " WHERE sess_id ='" . $this->sess_id . "'");
	}

    /**
     * 回收session
	 * @return bool
     */
    public function gc()
	{
		return $this->db->execute("DELETE FROM " . $this->sess_table . " WHERE last_activity <'" . time() . "'");
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
			$this->_update();
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
			$this->_update();
		}
		return true;
	}
	
    /**
     * 更新session
	 * @return bool
     */
	private function _update()
	{
		$sessdata		= json_encode($this->sess_data);
		$last_activity  = time() + (int)$this->sess_expiration;
		return $this->db->execute("UPDATE " . $this->sess_table . " SET sess_data = '" . $sessdata . "',last_activity = " . $last_activity . " WHERE sess_id='" .$this->sess_id. "'");
	}
}