<?php
/**
 * 公共模型
 * @author janhve@163.com
 * @date   2014-03-27
 * @version 1.0
 */
 
class Model {
	//响应数据对象
	public $response = NULL;
	//redis object
	private $_redis = null;
	//db object
	private $_db = null;
	
	/**
	 * 初始化
	 */
	public function __construct(){
		//初始化响应数据
		$this->response = json_decode(json_encode(array('code'=>200,'data'=>'')));
		
		//配置REDIS
		if(REDIS_AUTO_ON){
			try{
				$this->_redis = new Redis();
				$conn        = $this->_redis->connect(REDIS_HOST, REDIS_PORT);
				if(REDIS_PASSWORD){
					$conn        = $this->_redis->auth(REDIS_PASSWORD);
				}
				if(!$conn){
					$this->response->code = 22;
					$this->response->data = '无法连接redis服务器 [' . REDIS_HOST . ':' . REDIS_PORT . ']';
				}
			}
			catch(Exception $e){
				$this->response->code = 21;
				$this->response->data = $e->getMessage();
			}
		}
		
		//配置DB
		if(200 == $this->response->code && DB_AUTO_ON){
			$this->_db = App::instance(DB_TYPE);
			$this->_db->init(DB_TYPE);
			if($this->_db->response->code){
				$this->response = $this->_db->response;
			}
		}
	}
	
	/**
	 * 获取db或redis对象
	 *
	 * @param string $type  对象类型
	 * @param object
	 */
	public function getObject($type='db')
	{
		$type = strtolower($type);
		switch($type)
		{
			case 'db':
				return $this->_db;
				break;
			case 'redis':
				return $this->_redis;
				break;
		}
		
	}
	
	/**
	 * 读操作
	 * @param string $model 模型
	 * @param string $action 方法名
	 * @param array $param 参数
	 */
	public function read($model,$action,$param=array()){
		if (REDIS_AUTO_ON) //读redis数据
		{
			if(false !== strpos($action,'search')){
				$param['action'] = 'get';//定义执行动作，get为获取结果
			}
			$res = $this->redisexec($model, $action, $param);
			if (!empty($res))
			{
				return $res;
			}
		}

		$res = $this->dbexec($model, $action, $param); //读db数据
		
		//缓存查询结果，方法命中包含search，会自动执行搜索结果缓存
		if(false !== strpos($action,'search')){
			//搜索结果保存到redis
			$data['data'] = $res['data'];
			$data['param'] = $param;
			$data['action'] = 'save';//定义执行动作，save为保存结果
			$res = $this->redisexec($model, $action, $data);
		}
		return $res;
	}
	
	/**
	 * 写操作
	 * @param string $model 模型
	 * @param string $action 方法名
	 * @param array $param 参数
	 */
	public function write($model,$action,$param=array()){
		//写db数据
		$result = $this->dbexec($model,$action,$param);
		if(REDIS_AUTO_ON && $result['status']){
			//写redis数据
			$redisresult = $this->redisexec($model,$action,$result['data']);
		}
		if(!empty($redisresult)){
			$result = $redisresult;
		}
		return $result;
	}
	
	/**
	 * Redis操作
	 * @param string $model 模型
	 * @param string $action 方法名
	 * @param array $param 参数
	 */
	private function redisexec($model,$action,$param){
		$model_path = REDIS_PATH. $model .'_redis.php';
		if ( file_exists($model_path) ){
			include_once(REDIS_PATH .'base_redis.php');
			include_once($model_path);
			$object  = basename($model).'_redis';

			if(class_exists($object,false)){
				$class = new $object($this->_redis);
				if(!empty($action) && method_exists($class,$action)){
					return call_user_func_array(array(&$class, $action),array($param));
				}
				else{
					$this->response->code = 31;
					$this->response->data = 'Redis '.$model.'中不存在'.$action.'方法';
					App::response($this->response->code,$this->response->data);
				}
			}
			else{
				$this->response->code = 11;
				$this->response->data = 'Redis '.$model.'不存在';
				App::response($this->response->code,$this->response->data);
			}
		}
		else{
			$this->response->code = 11;
			$this->response->data = 'Redis '.$model.'文件不存在';
			App::response($this->response->code,$this->response->data);
		}	
	}
	
	/**
	 * 库操作
	 * @param string $model 模型
	 * @param string $action 方法名
	 * @param array $param 参数
	 */
	private function dbexec($model,$action,$param){
		$model_path = MODEL_PATH. $model .'_db.php';
		if ( file_exists($model_path) ){
			include_once($model_path);
			$object  = basename($model).'_db';

			if(class_exists($object,false)){
				$class = new $object($this->_db);
				if(!empty($action) && method_exists($class,$action)){
					return call_user_func_array(array(&$class, $action),array($param));
				}
				else{
					$this->response->code = 31;
					$this->response->data = 'model '.$model.'中不存在'.$action.'方法';
					App::response($this->response->code,$this->response->data);
				}
			}
			else{
				$this->response->code = 11;
				$this->response->data = 'model '.$model.'不存在';
				App::response($this->response->code,$this->response->data);
			}
		}
		else{
			$this->response->code = 11;
			$this->response->data = 'model '.$model.'文件不存在';
			App::response($this->response->code,$this->response->data);
		}	
	}
	/**
	 * 取数据操作
	 * @param string $apiname 调用的接口名
	 * @param string $method 调用的方法名
	 * @param array $param 参数
	 */
	public function api($apiname,$method,$param = array(), $post='post', $headers = array()){
		$param['access_token'] = ACCESS_TOKEN;
		if( 'post' == strtolower($post) )
		{
			$api_url = $apiname.'/'.$method;
			$reponse = json_decode($this->curl(DATA_GATEWAY_URL . $api_url, $param, $headers),TRUE);
		}
		else
		{
			$api_url = $apiname.'/'.$method.'?'.http_build_query($param);
			$reponse = json_decode($this->curl(DATA_GATEWAY_URL . $api_url, null, $headers),TRUE);
		}
		if( 200 == $reponse['code'] )
		{
			$resp = $reponse['data'];
		}
		else
		{
			$resp = array('status' => 0 ,'data' => $reponse['msg'] .',' . $reponse['detail']);
		}
		return $resp;
	}
	
	public function curl($url, $postFields = null, $headers = array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (!empty($headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}
		//https 请求
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		if (is_array($postFields) && 0 < count($postFields)){
			$postBodyString = "";
			$postMultipart = false;
			foreach ($postFields as $k => $v){
				if("@" != substr($v, 0, 1))//判断是不是文件上传
					$postBodyString .= "$k=" . urlencode($v) . "&"; 
				else//文件上传用multipart/form-data，否则用www-form-urlencoded
					$postMultipart = true;
			}
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			if ($postMultipart)
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			else
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
		}
		$reponse = curl_exec($ch);
		
		if (curl_errno($ch))
			throw new Exception(curl_error($ch),0);
		else{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
				throw new Exception($reponse,$httpStatusCode);
		}
		curl_close($ch);
		return $reponse;
	}
	
}