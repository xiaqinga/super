<?php

/**
 * Session 基于PHP session 类
 * 
 * 
 * @since          2014-10-09
 * @author			zeng.will@outlook.com
 * @version		Version 1.0
 */

class SessionDefault extends SessionDriver{
	
    /**
     * 初始化
     * @param $config 初始化配置
     */
	public function __construct($config = array())
	{
		//$this->sess_id = session_id();
		//$this->sess_data = $_SESSION;
		$this->result = array(
			'status' => 1,
			'data'   => 'Libraries Session 启动成功!'
		);
		parent::__construct($config);
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
		$this->sess_data = $_SESSION;
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
		return true;
	}
	
    /**
     * 删除session
     * @param string $sess_id session id
	 * @return bool
     */
    public function destroy($sess_id)
	{
		session_unset();
		session_destory();
		return true;
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
		return true;
	}
	
    /**
     * 获取session某个key值
     * @param $key session key
	 * @return mixed
     */
    public function get($key)
	{
		return (array_key_exists($key,$_SESSION))
				? $_SESSION[$key]
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
				$_SESSION[$index] = $val;
			}
			$this->read();
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
				if(array_key_exists($val,$_SESSION))
				{
					unset($_SESSION[$val]);
				}
			}
			$this->read();
		}
		return true;
	}
}