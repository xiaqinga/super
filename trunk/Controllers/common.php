<?php

/**
 * 公共处理
 * @author  janhve@163.com
 * @since   2015.12.16
 * @version 1.0
 */
 
class common extends Controller {
	
	public $isajax   = false;
	public $role_menu = array();
	public $role_permission = array();
	public $user_role;
	public $user_ds_id;
	public $user_ds_bid;
	
	/**
	 * 初始化，定义response初始值，设置请求参数变量
	 * 
	 */
	public function __construct(){
		parent::__construct();
		
		$this->lib('Session','sess',SESSION_STORER_TYPE);
		$this->lib('Func');
		$this->helper('from'); 
		$this->_isLogin();
		
	}
	
	/**
	 * 判断是否登陆
	 */
	private function _isLogin(){
		$auth_key = $this->sess->get(USER_AUTH_KEY);
		if ( 'schoolmaker_auth_passed' != $auth_key )
		{
			$this->redirect('auth');
		}else{
			define('ROLE_ID', $this->sess->get('roleId'));
			define('ACCOUT_TYPE', $this->sess->get('accouttype'));
		}
	}
	
	public function getTopMenu(){
		$roleId = $this->sess->get('roleId');

		$roleMenuItem  = array();

		$resp = $this->model->read('role','getlist',array('id'=>$roleId));

		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options) > 0)
		{
			if (isset($options['menu']))
			{
				foreach ($options['menu'] as $menu)
				{
					if (!empty($menu['menu_id']))
					{
						$roleMenuItem[$menu['menu_id']] = $menu['menu_id'];
					}
				}
			}
		}
		$param['parentId'] = 1;
		$param['menuStatus'] = 1;
		$topmenulist = $this->model->read('menu','getMenuList',$param);
		$topmenu_list = array();
		if($topmenulist['status']){
			foreach($topmenulist['data']['list'] as $tm_key=>$tm_val){
				if($tm_val['menuName']!='首页'){
					if ($roleId == 1 || $roleMenuItem[$tm_val['id']] == $tm_val['id']){
						$topmenu_list[] = array(
							'id' => $tm_val['id'],
							'name' => $tm_val['menuName'],
							'style' => $tm_val['menuStyle']
						);
					}
				}
			}
		}
		return $topmenu_list;
	}

	/**
	 * 获取菜单
	 */
	public function getAllMenu(){
		$roleId   = $this->sess->get('roleId');
		$roleMenuItem  = array();
		$resp = $this->model->read('role','getlist',array('id'=>$roleId));
		$res  = ($resp['status']) ? $resp['data']['list'][0] : array();
		$options = json_decode(stripslashes($res['options']), true);
		if (count($options) > 0)
		{
			if (isset($options['menu']))
			{
				foreach ($options['menu'] as $menu)
				{
					if (!empty($menu['menu_id']))
					{
						$roleMenuItem[$menu['menu_id']] = $menu['menu_id'];
					}
				}
			}
		}
		$param['parentId'] = $this->queryVar('parentId');
		$param['menuStatus'] = 1;
		$menulist = $this->model->read('menu','getMenuList',$param);
		$menu_list = array();
		if($menulist['status']){
			foreach($menulist['data']['list'] as $m_key=>$m_val){
				if ($roleId == 1 || $roleMenuItem[$m_val['id']] == $m_val['id']){
					$menu_list[] = array(
						'name' => $m_val['menuName'],
						'url' => $m_val['menuUrl']
					);
				}
			}
		}
		echo json_encode($menu_list);exit;
	}

	/**
	 * 上传
	 */
	public function upload()
	{
		$type  = $_GET['type'];
		
		if($_FILES['uploadfile']){
			$this->lib('UploadFile','upload');
			$uptype = array("file",0,0,"");
			$this->upload->upload($uptype,$_FILES['uploadfile'],array("1",""),"res/");
			$ret = $this->upload->files();
			if (is_numeric($ret) && $ret<>0)
				$this->jsonout(0,array('msg'=>$this->upload->ReturnText[$ret]));
			else
				$this->jsonout(1,array('msg'=>$ret,'file'=>$_FILES['uploadfile']['name'],'url'=>WWW_RES_URL . $ret));
		}
	}

	/**
	 * 获取短信验证码
	 */
	public function smscode()
	{
		$require_var = array(
			'mobphone'
		);
		$this->checkRequireVar($require_var);

		$mobphone = $this->queryVar('mobphone');
		
		$this->lib('Sms','sms', 'db');
		$vcode = rand(1000,9999);
		
		$this->sess->set('sms_'.$mobphone,$vcode);
		$resp = $this->sms->send($mobphone,$vcode);

		$this->jsonout($resp['status'],$resp['data']);
	}

	//本周的第一天和最后一天
	public function dayOfWeek($d){
		$date=new DateTime();
		$date->modify('this week');
		$first_day_of_week=$date->format('Y-m-d');
		$date->modify('this week +6 days');
		$end_day_of_week=$date->format('Y-m-d');
		if($d == 1){
			return $first_day_of_week;
		}else{
			return $end_day_of_week;
		}
	}
	//时间转换为几秒前、几分钟前等
	public function time_tran($the_time) { 
	    $now_time = date("Y-m-d H:i:s", time());  
	    //echo $now_time;  
	    $now_time = strtotime($now_time);   
	    $dur = $now_time - $the_time;  
		
	    if ($dur < 0) {  
	        return $the_time;  
	    } else {  
	        if ($dur < 60) {  
	            if($dur == 0){
	            	return '刚刚';
	            }else{
	            	return $dur . '秒前';
	            }
	        } else {  
	            if ($dur < 3600) {  
	                return floor($dur / 60) . '分钟前';  
	            } else {  
	                if ($dur < 86400) {  
	                    return floor($dur / 3600) . '小时前';  
	                } else {  
	                    if ($dur < 259200) {//3天内  
	                        return floor($dur / 86400) . '天前';  
	                    } else {  
	                        return date("Y-m-d H:i:s", $the_time);  
	                    }  
	                }  
	            }  
	        }  
	    }  
	} 

	/**
	 *操作失败提示信息
	 */
	public function error($message,$jump_url='',$delay_second=3)
	{
		$data = array();
		if(!empty($jump_url)){
			$jump_url = (false === strpos($jump_url,APP_URL)) ? APP_URL.$jump_url : $jump_url;
			$data['jump_url'] = $jump_url;
		}
		else
			$data['jump_url'] = (array_key_exists('HTTP_REFERER', $_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : APP_URL;
		$data['error'] = $message;
		$data['delay_second'] = $delay_second;
		$this->view($data,'public/error');
		exit;
	}

	/**
	 *伪造的浏览器获取图片/文件url
	 *
	 * wsbnet@qq.com 2016-07-22 
	 */
   public function getImagesUrl($url,$userinfo,$header)
    {
        $ch = curl_init();
        $timeout = 1;
        curl_setopt ($ch, CURLOPT_URL, "$url");
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt ($ch, CURLOPT_REFERER, "http://www.qq.com/"); 
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, "$userinfo");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     
        $contents = curl_exec($ch);
        curl_close($ch);
        return $contents ;
        
    }

    //保存伪造来源的文件/图片
    function saveUrl($handle ,$fileurl)
    {
        if(!file_exists($fileurl)){
        	@$fp = fopen($fileurl,"w");
        	fwrite($fp,$handle);
	        unset($fp);
	        unset($handle);
        }
    }

    //修改referer伪造一个浏览器
    public function forgedReferer($url,$media_id){
    		$folder = 'weixin';
    		$dir = 'uploads'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
    		file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));
    		$save_path = $dir.$media_id.'.jpg';
    		$save_url = 'uploads/'.$folder.'/'.$media_id.'.jpg';
    		if(!file_exists($save_path)){
	        $binfo =array('Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; InfoPath.2; AskTbPTV/5.17.0.25589; Alexa Toolbar)','Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET4.0C; Alexa Toolbar)','Mozilla/4.0(compatible; MSIE 6.0; Windows NT 5.1; SV1)',$_SERVER['HTTP_USER_AGENT']);
	        $cip = '123.125.68.'.mt_rand(0,254);
	        $xip = '125.90.88.'.mt_rand(0,254);
	        $header = array( 
	        'CLIENT-IP:'.$cip, 
	        'X-FORWARDED-FOR:'.$xip, 
	        ); 
	        $u = $binfo[mt_rand(0,3)];

	        $get_file = $this->getImagesUrl($url,$u,$header);
	        $this->saveUrl($get_file, $save_path);
    		}
        return $save_url;
    }

	/**
	 * 上传微信图片
	 *
	 * wsbnet@qq.com 2016-07-22 
	 */
	public function upload_weixin_media()
	{	
		$r = $this->ajaxUpload('weixin_temp');
		$obj = json_decode($r);
		$type = 'image';
		$resp = $this->wxopenapi->upload_media($type, APP_PATH.$obj->file);
		$resp['status'] = 1;
		if($resp['media_id']){
			$resp['baseurl'] = WWW_RES_URL.$this->forgedReferer($resp['url'], $resp['media_id']);
		}
		echo json_encode($resp);
	}

	/**
	 * 图片上传
	 * 
	 */
	public function ajaxUpload($dir='deault')
	{	 
		if(isset($_FILES))
		{ 
			$ret = array();
			$ret['status']=0;
			$ret['file']=array();
			$ret['msg']='请选择照片';
			$open_type = array('image/gif','image/jpeg','image/png');
			$stop_upload = "不支持的格式,支持以下".implode(',',$open_type)."的格式";
			$uploadDir = 'uploads'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.date("Ymd").DIRECTORY_SEPARATOR;
			$webDir = 'uploads/'.$dir.'/'.date("Ymd").'/';
			$dir = APP_PATH.DIRECTORY_SEPARATOR.$uploadDir;
			file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));
			foreach ($_FILES as $key => $value) {
				if(!in_array($value['type'], $open_type)){
					$ret['msg'] = $stop_upload;
				}else{
					$p=pathinfo($value["name"]);
					$fileName = time().uniqid().'.'.$p['extension'];
					move_uploaded_file($value["tmp_name"],$dir.$fileName);
					$ret['file'][] = $webDir.$fileName; //返回图片路径
					$ret['status']=1;
					$ret['msg']='上传成功';
				}
			}
			$ret['file']= implode('|',$ret['file']);
			return json_encode($ret);
		}
	}

		/**
		 * [uploadbase64 base64图片上传接口]
		 * @param  [type] $fileStr   [base64图片编码]
		 * @param  [type] $fileName  [图片名称]
		 * @param  [type] $filePath  [图片保存路径]
		 * @param  [type] $imagePath [图片浏览URL]
		 * @param  string $dir       [默认路径]
		 * @return [type]            [json]
		 * 303232810@qq.com
		 * 2016-08-17
		 */
		public function uploadbase64($fileStr, $fileName, $filePath, $imagePath, $dir='deault')
		{	 
			$fileStr = $this->queryVar('fileStr');
			$fileName = $this->queryVar('fileName');
			$filePath = $this->queryVar('filePath');
			$imagePath = $this->queryVar('imagePath');

			if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $fileStr, $result)) {//base64上传
				$uploadDir = 'uploads'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.date("Ymd").DIRECTORY_SEPARATOR;
				$webUrl = 'uploads/'.$dir.'/'.date("Ymd").'/';
				$dir = APP_PATH.DIRECTORY_SEPARATOR.$uploadDir;
				file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));

			  $data = base64_decode(str_replace($result[1], '', $fileStr));
			  $dataname = uniqid() . '.' . $result[2];
			  if (file_put_contents($dir.$dataname, $data)) {
			  	$res['status'] = 1;
			  	$res['data'][0] = array(
			  		'photoUrl' => LOCALHOST_RES_URL.$webUrl.$dataname
			   	);
			   	echo json_encode($res); 
			  }else{
			  	$res['status'] = 0;
			  	$res['data'][0] = array(
			  		'photoUrl' => ''
			   	);
			   	echo json_encode($res); 
			  }
			}
		}

	public function getProvinceList($param)
	{

		$resp = $this->model->read('base_provinceCityArea','getProvinceList',$param);
    return $resp;
	}

	public function getCityList($param)
	{
    $resp = $this->model->read('base_provinceCityArea','getCityList',$param);
    return $resp;
	}

	public function getAreaList($param)
	{
    $resp = $this->model->read('base_provinceCityArea','getAreaList',$param);
    return $resp;
	}

	public function getProvinceJsonList()
	{
		$param['code'] = $this->queryVar('code');
    $resp = $this->getProvinceList($param);
    echo json_encode($resp['data']['list']);
	}

	public function getCityJsonList()
	{
		$param['provinceCode'] = $this->queryVar('provinceCode');
	   $resp = $this->getCityList($param);
	   echo json_encode($resp['data']['list']);
	}

	public function getAreaJsonList()
	{
		$param['cityCode'] = $this->queryVar('cityCode');
    $resp = $this->getAreaList($param);
    echo json_encode($resp['data']['list']);
	}




	/**
	 *Created by
	 *User:XiaXuhua
	 *Date:2017/4/17
	 *Time:15:42
	 *Explan:根据区编码获取省市区详细信息
	 *@param:area_code
	 *@return:array
	 */
	protected function getAddressDetail($area_code){
		
		$areaList=$this->getAreaList(['code'=>$area_code])['data']['list'];

		$city_codes=get_parameter_set('cityCode',$areaList);

		$cityList=$this->getCityList(['code'=>$city_codes])['data']['list'];
		$province_codes=get_parameter_set('provinceCode',$cityList);
		$provinceList=$this->getProvinceList(['code'=>$province_codes])['data']['list'];
		foreach ($cityList as &$city){
			foreach ($areaList as $item) {
				if($city['code']==$item['cityCode']){
					$city['area_name']=$item['name'];
					$city['area_code']=$item['code'];
				}
			}
		}

		$data=[];
		foreach ($provinceList as $item) {
			foreach ($cityList as $value) {
				if($item['code']==$value['provinceCode']){
					$data[$value['area_code']]['name']=$item['name'].$value['name'].$value['area_name'];
					$data[$value['area_code']]['province_code']=$value['code'];
					$data[$value['area_code']]['city_code']=$item['code'];
				}
			}
		}

		return $data;
	}
	
	
	
	
	
	/**
	 * [strFilter 字符串中特殊符号的过滤方法]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function strFilter($str){
			$str = str_replace(' ', '', $str);
	    $str = str_replace('`', '', $str);
	    //$str = str_replace('·', '', $str);
	    $str = str_replace('~', '', $str);
	    $str = str_replace('!', '', $str);
	    $str = str_replace('！', '', $str);
	    $str = str_replace('@', '', $str);
	    $str = str_replace('#', '', $str);
	    $str = str_replace('$', '', $str);
	    $str = str_replace('￥', '', $str);
	    $str = str_replace('%', '', $str);
	    $str = str_replace('^', '', $str);
	    $str = str_replace('……', '', $str);
	    $str = str_replace('&', '', $str);
	    $str = str_replace('*', '', $str);
	    //$str = str_replace('(', '', $str);
	    //$str = str_replace(')', '', $str);
	    $str = str_replace('（', '', $str);
	    $str = str_replace('）', '', $str);
	    //$str = str_replace('-', '', $str);
	    $str = str_replace('_', '', $str);
	    $str = str_replace('——', '', $str);
	    //$str = str_replace('+', '', $str);
	    $str = str_replace('=', '', $str);
	    $str = str_replace('|', '', $str);
	    $str = str_replace('\\', '', $str);
	    $str = str_replace('[', '', $str);
	    $str = str_replace(']', '', $str);
	    $str = str_replace('【', '', $str);
	    $str = str_replace('】', '', $str);
	    $str = str_replace('{', '', $str);
	    $str = str_replace('}', '', $str);
	    $str = str_replace(';', '', $str);
	    $str = str_replace('；', '', $str);
	    $str = str_replace(':', '', $str);
	    $str = str_replace('：', '', $str);
	    $str = str_replace('\'', '', $str);
	    $str = str_replace('"', '', $str);
	    $str = str_replace('“', '', $str);
	    $str = str_replace('”', '', $str);
	    $str = str_replace(',', '', $str);
	    $str = str_replace('，', '', $str);
	    $str = str_replace('<', '', $str);
	    $str = str_replace('>', '', $str);
	    $str = str_replace('《', '', $str);
	    $str = str_replace('》', '', $str);
	    //$str = str_replace('.', '', $str);
	    $str = str_replace('。', '', $str);
	    //$str = str_replace('/', '', $str);
	    $str = str_replace('、', '', $str);
	    $str = str_replace('?', '', $str);
	    $str = str_replace('？', '', $str);
	    return trim($str);
	}

	/**
	 * 插入操作日志
	 */
	public function setActionLog($moduleId,$actionType,$actionContent)
	{
		$param['actionIp'] = $this->get_real_ip();
		$param['actionUser'] = $this->sess->get('id');
		$param['moduleId'] = $moduleId;
		$param['actionDate'] = date('Y-m-d H:i:s');
		$param['actionType'] = $actionType;
		$param['actionContent'] = $actionContent;
		$resp = $this->model->write('actionLog','create', $param);
		return true;
	}

	public function get_real_ip(){
	    static $realip;
	    if(isset($_SERVER)){
	        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
	            $realip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	        }else if(isset($_SERVER['HTTP_CLIENT_IP'])){
	            $realip=$_SERVER['HTTP_CLIENT_IP'];
	        }else{
	            $realip=$_SERVER['REMOTE_ADDR'];
	        }
	    }else{
	        if(getenv('HTTP_X_FORWARDED_FOR')){
	            $realip=getenv('HTTP_X_FORWARDED_FOR');
	        }else if(getenv('HTTP_CLIENT_IP')){
	            $realip=getenv('HTTP_CLIENT_IP');
	        }else{
	            $realip=getenv('REMOTE_ADDR');
	        }
	    }
	    return $realip;
	}

	//获取毫秒级时间戳
	public function getMillisecond() {
		list($t1, $t2) = explode(' ', microtime());
		return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}

	//随机数 默认4位
	public function randomNumbers( $s = 4 ){
		//range 是将1到9 列成一个数组 
		$numbers = range (1,9); 
		//shuffle 将数组顺序随即打乱 
		shuffle ($numbers); 
		//array_slice 取该数组中的某一段 
		$result = array_slice($numbers, 0, $s); 
		return implode('', $result);
	}
	
	/**
	 * FTP上传文件
	 */
	public function uploadFtpFile($filepath,$ftppath,$filename){
		$this->lib('UploadFtp','uploadftp');
		$pathret = $this->uploadftp->up_file($filepath,$ftppath);
		print_r($pathret);exit;
		if($pathret['status']){
			$path = AUDIO_RES_URL.$filename;
			$data = array(
				'status' => 1,
				'fileurl' => $path
			);
		}else{
			$data = array(
				'status' => 0,
				'fileurl' => ''
			);
		}
		return $data;
	}

	public function trimall($str)//删除所有空格
	{
	    $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
	    return str_replace($qian,$hou,$str);    
	}

  /**
   * 对象数组转为普通数组
   *
   * AJAX提交到后台的JSON字串经decode解码后为一个对象数组，
   * 为此必须转为普通数组后才能进行后续处理，
   * 此函数支持多维数组处理。
   * 303232810@qq.com 
   * 2016-08-22
   */
  public function objarray_to_array($obj) {
      $ret = array();
      foreach ($obj as $key => $value) {
      if (gettype($value) == "array" || gettype($value) == "object"){
              $ret[$key] =  $this->objarray_to_array($value);
      }else{
          $ret[$key] = $value;
      }
      }
      return $ret;
  }

	//友盟推送信息
public function  setUmengMsg($customerId){
	$UmengKey = $this->model->read('orders_goods_info','umengInfoKey',$customerId);
	if ($UmengKey['status']) {
		if ($UmengKey['data']['deviceType'] == 1) {
			$uparam['key']= UMENG_ANDROID_APP_KEY;
			$uparam['secret']=UMENG_ANDROID_SECRET;
			$params['device_tokens'] = $UmengKey['data']['deviceToken'];
			$params['ticker'] = UMENG_ANDROID_TICEKER;
			$params['title'] = UMENG_ANDROID_TITLE;
			$params['text'] = UMENG_ANDROID_TEXT;
			//android 推送
			$this->lib('Umeng','UmengTwo',$uparam);
			$result=$this->UmengTwo->sendAndroidUnicast($params);
		}elseif($UmengKey['data']['deviceType'] == 2){
			$uparam['key']= UMENG_IOS_APP_KEY;
			$uparam['secret']=UMENG_IOS_SECRET;
			$params['text'] = UMENG_IOS_TEXT;
			$params['device_tokens'] = $UmengKey['data']['deviceToken'];
			//IOS 推送
			$this->lib('Umeng','UmengOne',$uparam);
			$result=$this->UmengOne->sendIOSUnicast($params);
		}
	}


	return $result;
}
}