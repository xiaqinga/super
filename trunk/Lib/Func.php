<?php

/**
 * Function 系统函数库
 *
 *
 * @since             2015-05-22
 * @author            janhve@163.com
 * @version           Version 1.0
 */
class Func
{	
	/**
	 * 处理结果
	 */
	public $result = array(
		'status' => 0,
		'data'   => null
	);
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		$this->result['status'] = 1;
	}

	/**
	 * 截取字符串
	 * @param $str string 待截取的字符串
	 * @param $start int 截取起始位
	 * @param $length int  截取长度
	 * @param $suffix bool 是否带“...”
	 * @return string
	 */
	public function sub_str($str, $start = 0, $length = 0, $suffix = false)
	{
		$charset = strtolower( (defined('CONTENT_CHARSET') ) ? CONTENT_CHARSET : 'utf-8' );
		$strlen  = strlen(trim($str));
		$out_length=( 'utf-8' == $charset ) ? 3*$length : 2*$length;

	    if($length == 0 || $length >= $out_length)
	    {
	        return $str;
	    }

		if(function_exists("mb_substr"))
		{
		    $str    = mb_substr($str, $start, $length, $charset);
		    $str    = ($suffix) ? (($strlen>$out_length) ? $str."..." : $str) : $str;
	  	}
		else
		{
		    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		    $re['gb2312']  = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		    $re['gbk']     = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		    $re['big5']    = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		    
			preg_match_all($re[$charset], $str, $match);
		    
			$str = join("",array_slice($match[0], $start, $length));
		    $str = ($suffix) ? (($strlen>$out_length) ? $str."..." : $str) : $str;
	  	}
		return $str;
	}

	/**
	 * 获取当前URL
	 *
	 * @return string
	 */
	public function curr_url()
	{
		return urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
	}

	/**
	 * 获取来源URL
	 *
	 * @return string
	 */
	public function refer_url()
	{
		return urlencode($_SERVER['HTTP_REFERER']);
	}

	/**
	 * 转换为html格式的文本
	 *
	 * @param $content string 待转换的内容
	 * @return string
	 */
	public function html_text($content)
	{
		return stripslashes(str_replace(array("\n"," ",'`'),array("<br>","&nbsp;",'"'),$content));
	}
	
	/**
	 * 转换特殊html字符
	 *
	 * @param $str string 待转换的字符
	 * @return string
	 */
	public function strip_str($str)
	{
		return str_replace(array("&","\"","`","<",">"),array("&amp;","&quot;","&#039;","&lt;","&gt;"),$str);
	}
	
	/**
	 * 还原特殊html字符
	 *
	 * @param $str string 待还原的字符
	 * @return string
	 */
	public function unstrip_str($str)
	{
		return str_replace(array("&amp;","&quot;","&#039;","&lt;","&gt;"),array("&","\"","`","<",">"),$str);
	}

	/**
	 * 还原被反斜杠转义的字符
	 *
	 * @param $value string 待还原的字符
	 * @return string
	 */
	function stripslashes_deep($value)
	{
	    $value = urldecode($value);
	    $value = is_array($value) ?
	                array_map('stripslashes_deep', $value) :
	                stripslashes($value);

	    return $value;
	}

	/**
	 * 从html文档中取出图片
	 *
	 * @param $value string html文档
	 * @return string
	 */
	function get_image_from_html($value)
	{
		$pattern = "/<img(.*)src=\"([^\"]+)\"[^>]+>/isU";
		preg_match_all($pattern,$value,$imgarr);
		
		if ( !empty($imgarr[2][0]) )
		{
			return $imgarr[2][0];
		}
		else
		{
			return NULL;
		}
	}
	
	/**
	 * 生成xml格式文档
	 *
	 * @param $data mixed 数据
	 * @param $encoding string 数据编码
	 * @param $root string 根节点名称
	 * @return string
	 */
	public function xml_encode($data, $encoding='utf-8', $root="root")
	{
	    $xml = '<?xml version="1.0" encoding="' . $encoding . '"?>';
	    $xml.= '<' . $root . '>';
	    $xml.= $this->data2xml($data);
	    $xml.= '</' . $root . '>';
	    return $xml;
	}
	
	/**
	 * 生成xml节点及数据
	 *
	 * @param $data array 数据
	 * @return string
	 */
	public function data2xml($data)
	{
	    $xml = '';
	    foreach ($data as $key => $val) {
	        is_numeric($key) && $key = "item id=\"$key\"";
	        $xml.="<$key>";
	        $xml.= ( is_array($val) || is_object($val)) ? $this->data2xml($val) : $val;
	        list($key, ) = explode(' ', $key);
	        $xml.="</$key>";
	    }
	    return $xml;
	}
	
	/**
	 * 获取访问端真实IP
	 *
	 * @return string
	 */
	public function client_ip($str)
	{
	    static $realip = NULL;

	    if ($realip !== NULL)
	    {
	        return $realip;
	    }

	    if (isset($_SERVER))
	    {
	        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        {
	            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
	            foreach ($arr AS $ip)
	            {
	                $ip = trim($ip);
	                if ($ip != 'unknown')
	                {
	                    $realip = $ip;
	                    break;
	                }
	            }
	        }
	        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
	        {
	            $realip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	        else
	        {
	            if (isset($_SERVER['REMOTE_ADDR']))
	            {
	                $realip = $_SERVER['REMOTE_ADDR'];
	            }
	            else
	            {
	                $realip = '0.0.0.0';
	            }
	        }
	    }
	    else
	    {
	        if (getenv('HTTP_X_FORWARDED_FOR'))
	        {
	            $realip = getenv('HTTP_X_FORWARDED_FOR');
	        }
	        elseif (getenv('HTTP_CLIENT_IP'))
	        {
	            $realip = getenv('HTTP_CLIENT_IP');
	        }
	        else
	        {
	            $realip = getenv('REMOTE_ADDR');
	        }
	    }

	    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
	    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

	    return $realip;
	}

	/**
	 * 获取价格
	 *
	 * @return string
	 */
	public function getPriceText($rs)
	{
		if($rs['discount']<>0)
		{
			$curr_time = time();
			if($curr_time >= $rs['disc_start'] && $curr_time < $rs['disc_end'])
			{
				$curr_price = round($rs['price'] * $rs['discount'] / 10);
				return '<span class="price-del">&yen;'.$rs['price'].'</span>优惠价：<b class="f24">&yen;'.round($curr_price).'</b>';
			}
			else
			{
				return '<b class="f24">&yen;'.round($rs['price']).'</b>';
			}
		}
		else
		{
			return '<b class="f24">&yen;'.round($rs['price']).'</b>';
		}
	}

	/**
	 * 获取销售价
	 *
	 * @return string
	 */
	public function getSalePrice($rs)
	{
		if($rs['discount']<>0)
		{
			$curr_time = time();
			if($curr_time >= $rs['disc_start'] && $curr_time < $rs['disc_end'])
			{
				$curr_price = round($rs['price'] * $rs['discount'] / 10);
				return round($curr_price);
			}
			else
			{
				return round($rs['price']);
			}
		}
		else
		{
			return round($rs['price']);
		}
	}

}