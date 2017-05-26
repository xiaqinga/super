<?php

/**
 * Form 表单处理库
 *
 *
 * @since             2014-10-22
 * @author            will.zeng@outlook.com
 * @version           Version 1.0
 */
class Form
{
	/**
	 * 错误提示
	 */
	public $message = array(
			'length' => 0,
			'char'   => '',
			'phone'   => '',
			'email'   => ''
	);
	
	/**
	 * 处理结果
	 */
	public $result = array(
		'status' => 0,
		'data'   => null
	);
	
	/**
	 * 初始化，并检查中间错误
	 */
	public function __construct()
	{
		//
	}

	/**
	 * 验证长度
	 * 适合UTF-8编码格式，长度1汉字=3字符
	 * @param $str 待检测的字符串
	 * @param $msg 提示信息
	 * @param $minlen 最小长度，默认为0或空表示不限制
	 * @param $maxlen 最大长度，默认为0或空表示不限制
	 * @param $num 根据编码方式(UTF-8/GBK/GB2312)，一个汉字算几个字符，默认算1个
	 */
	public function checklength($str,$msg='',$min=0,$max=0,$num=1)
	{
		$len = $this->str_len($str,$num);
		
		//if(!isset($str) || !$len) $this->_error($msg);
		
		if($min && $len < $min) $this->_error($msg);
		
		if($max && $len > $max) $this->_error($msg);
	}

	/**
	 * 验证是否为指定字符
	 *
	 * @param $str 待检测的字符串
	 * @param $msg 提示信息
	 * @param $mode 检测模式，支持数字(number)、字母(char)、汉字(chinese)、下划线(_)，默认空时检测全部
	 */
	public function checkchar($str,$msg='',$mode='')
	{
		switch($mode)
		{
			case 'number':
				if(!preg_match("/^[0-9]+$/",$str)) $this->_error($msg);
				break;
			case 'char':
				if(!preg_match("/^[a-zA-Z]+$/",$str)) $this->_error($msg);
				break;
			case 'chinese':
				if(!preg_match("/^[\x80-\xff][\x40-\xfe]+$/",$str)) $this->_error($msg);
				break;
			case 'filter':
				if(!preg_match("/^(?!_|\s\')[A-Za-z0-9_\x80-\xff\s\']+$/",$str)) $this->_error($msg);
				break;
			default:
				break;
		}
	}

	/**
	 * 验证电话号码
	 *
	 * @param $phone 手机号码
	 * @param $msg 提示信息
	 */
	public function checkphone($phone,$msg='')
	{
		if(!preg_match("/^(13|15|18|17)d{9}+$/",$phone)) $this->_error($msg);
	}
	
	/**
	 * 验证邮箱
	 *
	 * @param $email 邮箱地址
	 * @param $msg 提示信息
	 */
	public function checkemail($email,$msg='')
	{
		if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)) $this->_error($msg);
	}
	
	/**
	 * 特殊字符过滤和转义
	 *
	 * @param $str 待处理的字符串
	 * @param $msg 提示信息
	 */
	public function filter($str)
	{
		$disallow_tag = 'alert|applet|audio|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|isindex|layer|link|meta|object|plaintext|style|script|textarea|title|video|xml|xss';
		$str = preg_replace_callback('#<(/*\s*)('.$disallow_tag.')([^><]*)([><]*)#is', array($this, 'filterHtmlTag'), $str);
		$str = preg_replace('#(alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2&#40;\\3&#41;", $str);
		return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), $str);
	}
	
	/**
	 * 获取字符串长度，适用于utf-8/GBK/GB2312
	 *
	 * @param string $str 字符串
	 * @param int $num 根据编码方式(UTF-8/GBK/GB2312)，一个汉字算几个字符，默认算1个
	 */
	public function str_len($str,$num=1)
	{
		if('' == $str)
		{
			return 0;
		}
		preg_match_all('/./us', $str, $match);
		$arr = $match[0];
		if(!function_exists('getlength'))
		{
			function getlength(&$value,$key,$num){
				if(preg_match("/^[\x80-\xff][\x40-\xfe]+$/",$value))
					$value = $num;
				else
					$value = 1;
			}
		}
		array_walk_recursive($arr,"getlength",$num);
		return array_sum($arr);
	}	
	
	/**
	 * 获取字符串长度，适用于utf-8
	 *
	 * @param string $str 字符串
	 */
	public function utf8_strlen($str)
	{
		preg_match_all('/./us', $str, $match);
		return count($match[0]);
	}
	
	/**
	 * 获取字符串长度，适用于GBK/GB2312
	 *
	 * @param string $str 字符串
	 */
	public function gbk_strlen($str)
	{
		preg_match_all('/./us', $str, $match);
		$arr = $match[0];
		function getlength(&$value,$key){
			if(preg_match("/^[\x80-\xff][\x40-\xfe]+$/",$value))
				$value = 2;
			else 
				$value = 1;
		}
		array_walk_recursive($arr,"getlength");
		return array_sum($arr);
	}
	
	/**
	 * 过滤特殊html标签
	 *
	 * @param string $str 字符串
	 */
	protected function filterHtmlTag($matches)
	{
		$str = '&lt;'.$matches[1].$matches[2].$matches[3];
		$str .= str_replace(array('>', '<'), array('&gt;', '&lt;'),$matches[4]);
		return $str;
	}

	/**
	 * 输出错误
	 *
	 * @param string $msg 错误信息
	 */
	private function _error($msg, $code = 32)
	{
		exit(json_encode(array(
			'code'   => $code,
			'msg'    => '参数值不合要求',
			'detail' => $msg
		)));
	}

}