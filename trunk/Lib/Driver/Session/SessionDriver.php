<?php

/**
 * SessionHander 类
 * 
 * 
 * @since          2014-10-09
 * @author			zeng.will@outlook.com
 * @version		Version 1.0
 */

abstract class SessionDriver{  
	/**
     * sesson 有效期
     */
    var $sess_expiration			= 7200;
    /**
     * 是否开启sesson有效期，默认开启
     */
    var $sess_expire_on_close		= TRUE;
	/**
     * session id
     */
	var $sess_id					= '';
	/**
     * session data
     */
	var $sess_data					= array();
    /**
     * 处理结果
     */
    var $result = array(
    		'status' => 0,
    		'data'   => null
    );
	
	
	/**
     * 初始化
     * @param $config 初始化配置
     */
	public function __construct($config = array())
	{
		if(is_array($config))
		{
			$this->sess_expiration = (isset($config['sess_expiration'])) ? $config['sess_expiration'] : SESSION_EXPIRATION;
			$this->sess_expire_on_close = (isset($config['sess_expire_on_close'])) ? $config['sess_expire_on_close'] : SESSION_EXPIRE_ON_CLOSE;
		}
		if($this->result['status'])
		{
			$this->exec();
			session_start();
		}
	}
	
    /**
     * 打开session操作句柄
     * @param string $save_path
	 * @param mixed $sess_name
	 * @return bool
     */
	abstract public function open($save_path='',$sess_name='');

    /**
     * 关闭session
     */
	abstract public function close();

    /**
     * 获取session，返回session id
     * @param string $sess_id session id
	 * @return string
     */
    abstract public function read($sess_id='');

    /**
     * 设置session
     * @param string $sess_id session id
	 * @param string $sess_data session value
	 * @return bool
     */
    abstract public function write($sess_id='',$sess_data='');
	
    /**
     * 删除session
     * @param string $sess_id session id
	 * @return bool
     */
    abstract public function destroy($sess_id);

    /**
     * 回收session
	 * @return bool
     */
    abstract public function gc();
	
    /**
     * 定义session处理机制
     * @return bool
     */
	abstract public function exec();
	
    /**
     * 获取session某个key值
     * @param string $key session key
	 * @return mixed
     */
    abstract public function get($key);

    /**
     * 设置session某个key值
     * @param mixed $key session key
	 * @param mixed $value session key value
	 * @return bool
     */
    abstract public function set($key=array(),$value='');
	
    /**
     * 删除session某个key值
     * @param mixed $key session key
	 * @return bool
     */
    abstract public function del($key);
}