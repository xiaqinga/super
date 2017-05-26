<?php

/**
 * 页面调用
 *
 *
 * @since             2015-07-19
 * @author            wsbnet@qq.com
 * @version           Version 1.0
 */
class assets
{	

	public static $sayimo;
	public static $wx_assets_css;
	public static $wx_editnews_css;
	public static $editor;
	public static $neweditor;
	public static $wx_image;
	public static $wx_msg;
	public static $wx_msg_key;
	public static $html5upload;
	public static $jcrop;
	public static $base64;
	public static $shop;
	public static $shop_silver;
	public static $shop_business;
	public static $shop_pre;
	public static $resume;
	var $version;

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
		$this->version = "?time=".time();

		assets::$sayimo = $this->registerJsAndCss(['js/sayimo.js']);//重载的js

		//微信素材图文
		assets::$wx_assets_css = $this->registerJsAndCss(['css/weixin/base.css','css/weixin/media.css']);

		assets::$wx_editnews_css = $this->registerJsAndCss(['css/weixin/base.css','css/weixin/jquery.scrollbar.css','css/weixin/date_select.css','css/weixin/appmsg_new.css']);

	    assets::$editor = $this->registerJsAndCss(['editor/ueditor.config.js','editor/ueditor.all.js']);

		//微信素材图片
		assets::$wx_image = $this->registerJsAndCss(['js/weixin/weixin.js', 'css/weixin/base.css','css/weixin/media_list_img.css']);

		//微信素材回复
		assets::$wx_msg = $this->registerJsAndCss(['js/weixin/weixin.js', 'css/weixin/msg_sender.css','css/weixin/advanced_reply_common.css','css/weixin/base.css']);

		///微信素材关键字回复
		assets::$wx_msg_key = $this->registerJsAndCss(['js/weixin/weixin.js','css/weixin/msg_sender.css','css/weixin/advanced_reply_common.css','css/weixin/advanced_reply_keywords.css','css/weixin/base.css']);

		assets::$html5upload = $this->registerJsAndCss(['htmp5upload/html5File.js','htmp5upload/upload.css','htmp5upload/upload.js']);

		//图片裁剪
		assets::$jcrop = $this->registerJsAndCss(['jcrop/image/jquery.Jcrop.min.css','jcrop/image/J_jcorp.css','jcrop/js/jquery.Jcrop.min.js','jcrop/js/J_jcorp.js']);

		//商城
		assets::$shop = $this->registerJsAndCss(['js/shop.js','css/shop.css']);

		//银商城
		assets::$shop_silver = $this->registerJsAndCss(['js/shop_silver.js','css/shop.css']);

		//商企商城
		assets::$shop_business = $this->registerJsAndCss(['js/shop_business.js','css/shop.css']);

		//商城预约商品
		assets::$shop_pre = $this->registerJsAndCss(['js/shop_pre.js','css/shop.css']);

		//jbase64
		assets::$base64 = $this->registerJsAndCss(['js/base64.js']);

		//resume
		assets::$resume = $this->registerJsAndCss(['js/demand/major_arr.js','js/demand/major_func.js','js/demand/funtype_arr.js','js/demand/funtype_func.js','js/demand/drag.js','css/demand/alpha.css','css/demand/css.css']);
	}

	public function registerJsAndCss($arr)
	{
		$js = '';
		$css = '';
		if(is_array($arr)){
			foreach ($arr as  $value) {
				if(strripos($value,'js')>-1){
					$js .= "<script type=\"text/javascript\" src=\"".ASSETS_URL.$value.$this->version."\"></script>\n";
				}elseif(strripos($value,'css')>-1){
					$css .= "<link rel=\"stylesheet\" href=\"".ASSETS_URL.$value.$this->version."\">\n";
				}
			}
			return $css.$js;
		}else{
			return false;
		}
	}


}