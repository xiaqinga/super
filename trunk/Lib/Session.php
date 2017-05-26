<?php

/**
 * SessionHander 类
 * 
 * 
 * @since          2014-10-09
 * @author			zeng.will@outlook.com
 * @version		Version 1.0
 */

class Session{
	
    /**
     * session 对象
     */
    var $session					= null;
    
    /**
     * 处理结果
     */
    public $result = array(
    		'status' => 0,
    		'data'   => null
    );
	
    /**
     * 初始化
     * @param $config 初始化配置
     */
	public function __construct($config = array())
	{
		if(!defined('SESSION_STORER_TYPE'))
		{
			$this->result = array(
				'status' => 0,
				'data'   => 'Libraries Session 启动失败，没有定义SESSION_STORER_TYPE!'
			);
		}
		else
		{
			$driver      = 'Session'.ucwords(strtolower(SESSION_STORER_TYPE));
			$drivehander = LIB_PATH . 'Driver/Session/SessionDriver.php';
			$drivepath   = LIB_PATH . 'Driver/Session/' . $driver . '.php';
			if( file_exists( $drivehander ) )
			{
				require_once ( $drivehander );
				if( file_exists( $drivepath ) )
				{
					require_once ( $drivepath );
					
					$this->result = array(
						'status' => 1,
						'data'   => 'Libraries Session 启动成功!'
					);
					
					$handler = new $driver($config);
					if($handler->result['status'])
					{
						$this->session = $handler;
					}
					else
					{
						$this->result = $handler->result;
					}
				}
				else
				{
					$this->result = array(
						'status' => 0,
						'data'   => 'Libraries Session Driver [ ' . $driver . ' ] is not exists!'
					);
				}
			}
			else
			{
				$this->result = array(
					'status' => 0,
					'data'   => 'Libraries Session Driver hander [ SessionDriver ] is not exists!'
				);
			}
		}
	}
}