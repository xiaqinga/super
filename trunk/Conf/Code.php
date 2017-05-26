<?php

/**
 * 错误码
 * 系统定义200为唯一正确状态码，其他码均为错误码
 * 
 * @author janhve@163.com
 * @date   2014-03-21
 * @version 1.0
 */

return array(
	//接口级别错误
	11  => '文件错误',
	12  => '系统错误',
	13  => '环境错误',
	//环境级别错误
	21  => 'Redis错误',
	22  => 'Redis无法连接',
	23  => '暂未启用Redis数据处理，请先关闭',
	//业务级别错误
	31  => '参数错误',
	//权限认证错误
	40  => '认证失败',
	41  => '认证不通过',
	42  => '口令错误',
	43  => '请求次数已达上限',
	44  => '请求被禁止',
	45  => '接口配置错误',
	//数据库错误
	50  => '连接错误',
	//扩展库启动错误
	60  => '扩展库启动失败',
	//网络级别错误
	100 => 'Continue',
	101 => 'Switching Protocols',
	200 => 'OK',
	201 => 'Created',
	202 => 'Accepted',
	203 => 'Non-Authoritative Information',
	204 => 'No Content',
	205 => 'Reset Content',
);