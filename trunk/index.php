<?php

/**
 * mahua
 * index.php 统一访问入口
 * @author janhve@163.com
 * @date   2014-05-19
 * @version 1.0
 */

//定义项目目录
if(!defined('APP_PATH'))
	define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

//定义配置目录
if (!defined("CONF_PATH"))
	define("CONF_PATH",APP_PATH .'Conf/');

//载入项目
require(APP_PATH .'App.php');
App::run();
