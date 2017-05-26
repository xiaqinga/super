<?php

if ( ! function_exists('form_a_auth'))
{
	function form_a_auth($btdata=array()){
		$content = '编辑';
		$url = '';
		$rem = '';
		$rid = '';
		$onclick = '';
		$class = '';
		$style = '';
		$img = '';
		$check = '';
		if(isset($btdata['content'])){
			$content = $btdata['content'];
		}
		if(isset($btdata['url'])){
			$url = $btdata['url'];
		}
		if(isset($btdata['rem'])){
			$rem = $btdata['rem'];
		}
		if(isset($btdata['rid'])){
			$rid = $btdata['rid'];
		}
		if(isset($btdata['onclick'])){
			$onclick = $btdata['onclick'];
		}
		if(isset($btdata['class'])){
			$class = $btdata['class'];
		}
		if(isset($btdata['id'])){
			$id = $btdata['id'];
		}
		if(isset($btdata['style'])){
			$style = $btdata['style'];
		}
		if(isset($btdata['img'])){
			$img = $btdata['img'];
		}
		if(isset($btdata['check'])){
			$check = $btdata['check'];
		}
		if(empty($check)){
			$check = $url;
		}
		$clickhtml = '';
		if(!empty($id)){
			$clickhtml = ' id="'.$id.'"';
		}
		if(!empty($url)){
			$clickhtml = ' data-url="'.$url.'"';
		}
		if(!empty($rem)){
			$clickhtml = ' data-rem="'.$rem.'"';
		}
		if(!empty($rid)){
			$clickhtml = ' data-id="'.$rid.'"';
		}
		if(!empty($onclick)){
			$clickhtml = ' onclick="'.$onclick.'"';
		}
		if(!empty($style)){
			$stylehtml = ' style="'.$style.'"';
		}else{
			$stylehtml = '';
		}
		if(!empty($img)){
			$imghtml = '<img class="imgtable" src="'.ASSETS_URL.'images/default/'.$img.'">';
		}else{
			$imghtml = $content;
		}
		$html_data = '<a href="javascript:void(0);" class="sui-btn '.$class.'"'.$clickhtml.$stylehtml.' title="'.$content.'">'.$imghtml.'</a>';
		if(!empty($check))
		{
			$urls = explode('?',$check);
			//没有权限返回空
			if(!auth_check_permissions($urls[0]))
			{
				return '';
			}
		}
		
		return $html_data;
	}
}

if ( ! function_exists('auth_check_permissions')){
	/**
	 * 根据url判断用户是否拥有权限
	 *
	 * @param string $uri
	 * @return bool
	 */
	function auth_check_permissions($uri='',$virtual=false)
	{
		//实例化模型类
		$model = App::instance('Model');
		$roleMenuItem  = array();
		$roleRightItem = array();
		$resp = $model->read('role','getlist',array('id'=>ROLE_ID));
		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options) > 0)
		{
			if (isset($options['menu']))
			{
				foreach ($options['menu'] as $menu)
				{
					if (!empty($menu['url']))
					{
						$menu_val = strstr($menu['url'], '/');
						if (empty($menu_val))
						{
							$menu['url'] = $menu['url'] . '/index';
						}
						$roleMenuItem[] = strtolower($menu['url']);
					}
				}
			}
			if (isset($options['permissions']))
			{
				foreach ($options['permissions'] as $permissions)
				{
					$permissions['action'] = explode(',', $permissions['action']);
					foreach ($permissions['action'] as $action)
					{
						$roleRightItem[] = strtolower($permissions['controller'] . '/' . $action);
					}
				}
			}
		}
		$menuItems = array_merge($roleMenuItem, $roleRightItem);
		$menuItems = array_unique($menuItems);
        $uri = str_replace(APP_URL,'',strtolower($uri));
		if (ROLE_ID == 1 || in_array($uri, $menuItems))
		{
			$ret = true;
		}
		else
		{
			$ret = false;
		}

		return $ret;
	}
}

/**
 * 设置session,在uploadify上传时使用
 */
if(!function_exists('session_tmp')) {
    function session_tmp() {
        $tmp = array();
        $tmp['session_id'] = $_COOKIE[SESSION_COOKIE_NAME];
        $tmp['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $tmp['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		
        return json_encode($tmp);
	}
}
/**
 * 获取arr中某一列的集合
 */
if(!function_exists('get_parameter_set')) {
	function get_parameter_set($parameter,$array) {
		$arr='';
		if($parameter){
			foreach($array as $v){

				$arr[]=$v[$parameter];
			}
		}
		$arr=array_unique($arr?explode(',',join(',',$arr)):false);


		return $arr?join(',',$arr):false;
	}
}


/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/download_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('force_download'))
{
	/**
	 * Force Download
	 *
	 * Generates headers that force a download to happen
	 *
	 * @param	string	filename
	 * @param	mixed	the data to be downloaded
	 * @param	bool	whether to try and send the actual file MIME type
	 * @return	void
	 */
	function force_download($filename = '', $data = '', $set_mime = FALSE)
	{  
      
		if ($filename === '' OR $data === '')
		{
			return;
		}
		elseif ($data === NULL)
		{ 


			/*if ( ! @is_file($filename) OR ($filesize = @filesize($filename)) === FALSE)
			{ 

				return;
			}*/
      
			$filepath = file_get_contents($filename);
			var_dump($filepath);
	   
			$filename = explode('/', str_replace(DIRECTORY_SEPARATOR, '/', $filename));
			$filename = end($filename);
		}
		else
		{
			$filesize = strlen($data);
		}
       
		// Set the default MIME type to send
		$mime = 'application/octet-stream';

		$x = explode('.', $filename);
		$extension = end($x);
     
		if ($set_mime === TRUE)
		{
			if (count($x) === 1 OR $extension === '')
			{
				/* If we're going to detect the MIME type,
				 * we'll need a file extension.
				 */
				return;
			}

			// Load the mime types
			$mimes =& get_mimes();

			// Only change the default MIME if we can find one
			if (isset($mimes[$extension]))
			{
				$mime = is_array($mimes[$extension]) ? $mimes[$extension][0] : $mimes[$extension];
			}
		}
    
		/* It was reported that browsers on Android 2.1 (and possibly older as well)
		 * need to have the filename extension upper-cased in order to be able to
		 * download it.
		 *
		 * Reference: http://digiblog.de/2011/04/19/android-and-the-download-file-headers/
		 */
		if (count($x) !== 1 && isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Android\s(1|2\.[01])/', $_SERVER['HTTP_USER_AGENT']))
		{
			$x[count($x) - 1] = strtoupper($extension);
			$filename = implode('.', $x);
		}
    

		if ($data === NULL && ($fp = @fopen($filepath, 'rb')) === FALSE)
		{
			return;
		}

		// Clean output buffer
		if (ob_get_level() !== 0 && @ob_end_clean() === FALSE)
		{
			@ob_clean();
		}

		// Generate the server headers
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Expires: 0');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.$filesize);
		header('Cache-Control: private, no-transform, no-store, must-revalidate');

		// If we have raw data - just dump it
		if ($data !== NULL)
		{
			exit($data);
		}

		// Flush 1MB chunks of data
		while ( ! feof($fp) && ($data = fread($fp, 1048576)) !== FALSE)
		{
			echo $data;
		}

		fclose($fp);
		exit;
	}
}