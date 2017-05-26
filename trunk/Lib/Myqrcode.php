<?php

/**
 * Qrcode 生成二维码
 *
 *
 * @since             2014-11-26
 * @author            will.zeng@outlook.com
 * @version           Version 1.0
 */

require_once(LIB_PATH . 'phpqrcode/qrlib.php');

class Myqrcode
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
		//
	}

	/**
	 * 生成二维码
	 * @param $appid 应用id
	 * @return string
	 */
	public function generationQRcode($appid)
	{
		$weiyiappid   = APKNAME_PREFIX . $appid;
		$qr_file_name = UPLOAD_TMP_PATH . 'qr_' . $weiyiappid . '.png';
		$qr_url       = APP_URL. 'Tmp/' . 'qr_' . $weiyiappid . '.png';
		$update_url   = APP_DOWN_URL . $appid;
		QRcode::png($update_url, $qr_file_name, 'L', 4, 2);
		return $qr_url;
	}
	
	/**
	 * 检测图片是否有效
	 *
	 * @param string $url 原图标地址
	 * @return string 新图标地址
	 */
	protected function _checkImage($url)
	{
		$tmp_assets_url= APP_URL. 'Tmp/';
		$remote_path = UPLOAD_TMP_PATH;
	
		$img_path = $remote_path . str_replace($tmp_assets_url,'',$url);
	
		$name     = basename($img_path);
		$filelist = explode('.', $name);
		if (count($filelist) > 1 && in_array(strtolower(end($filelist)),array('png','jpg')) )
		{
			if (file_exists($img_path))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * 图标转为png格式
	 *
	 * @param string $url 原图标地址
	 * @return string 新图标地址
	 */
	protected function _coverImage2png($url)
	{
		$tmp_assets_url= APP_URL. 'Tmp/';
		$remote_path = UPLOAD_TMP_PATH;
	
		$img_path = $remote_path . str_replace($tmp_assets_url,'',$url);
	
		$name     = basename($img_path);
		$filelist = explode('.', $name);
		if (count($filelist) > 1 && end($filelist) == 'png')
		{
			return $url;
		}
		$newurl = $filelist[0] . ".png";
		$dest = dirname($img_path) .'/' . $newurl;
		imagepng(imagecreatefromstring(file_get_contents($url)), $dest);
		unlink($img_path);
	
		return $tmp_assets_url . $newurl;
	}
	
	/**
	 * 获取远程图片保存至本地
	 *
	 * @param string $url 原图片地址
	 * @return string 新图片地址
	 * @author zenghl
	 */
	protected function _getRemoteImage($url)
	{
		$ext      = strrchr($url, ".");
		$name     = md5(time().rand(10000,99999));
		$filename = UPLOAD_TMP_PATH . $name . $ext;
		$imgurl   = APP_URL . 'Tmp/' .$name . $ext;
	
		ob_start();
		readfile($url);
		$im = ob_get_contents();
		ob_end_clean();
		$size = strlen($im);
		$fp = @fopen($filename, "a");
		fwrite($fp, $im);
		fclose($fp);
		return $imgurl;
	}
	
}