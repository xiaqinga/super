<?php

/**
 * Controller控制器基类 抽象类
 * @author janhve@163.com
 * @date   2014-05-20
 * @version 1.0
 */
 
abstract class Controller {
	//模型实例对象
	protected $model = NULL;
    //视图实例对象
    protected $view   =  NULL;
	//系统响应
	public $response = NULL;
    //当前controller名称
    private $name =  '';
	//请求的参数
	public $request_var = array();
	//定义的公共词典
	public $public_dict = array();
	
	/**
	 * 初始化，取得模型实例对象
	 * 
	 */
	public function __construct(){
		//定义初始响应
		$this->response = json_decode(json_encode(array('code'=>200,'data'=>'')));
		
		//实例化模型类
		$this->model = App::instance('Model');
		if($this->model->response->code){
			$this->response = $this->model->response;
		}
		if($this->response->code !== 200){
			$this->output($this->response->data,$this->response->code);
		}

        //实例化视图类
        $this->view  = App::instance('View');

		//获取请求参数
		$this->_getRequestVar();

		//设置公共词典
		$this->_getPublicDict();
	}
	
	/**
	 * 设置GET、POST参数
	 */
	private function _getRequestVar(){
		if(isset($_GET))
			$this->_setRequestVar($_GET);
		if(isset($_POST))
			$this->_setRequestVar($_POST);
	}
	
	/**
	 * 对GET、POST参数进行类型转换，并保存在request_var
	 * @param array $data GET或POST数组
	 */
	private function _setRequestVar($data){
		$format_request_var = unserialize(IN_REQUEST_PARAM);
		if(!empty($data)){
			foreach($data as $key=>$val){
				if($val !== '' && $val !== NULL){
					if(in_array($key,$format_request_var['int'])){
						$this->request_var[$key] = (int)$val;
					}
          elseif(in_array($key,$format_request_var['string']))
						$this->request_var[$key] = (string)$val;
					elseif(in_array($key,$format_request_var['array']))
						$this->request_var[$key] = (array)$val; 
					elseif(in_array($key,$format_request_var['bool']))
						$this->request_var[$key] = (bool)$val;
					else
						$this->request_var[$key] = (string)$val;
				}
			}
		}
	}

	/**
	 * 设置公共词典
	 */
	private function _getPublicDict(){
		if (defined('PUBLIC_DICT'))
		{
			$this->public_dict = unserialize(PUBLIC_DICT);
		}
	}
	
	/**
	 * 检测必选参数，缺少时提示错误
	 * @param array/string $var
	 */
	protected function checkRequireVar($var){
		$var = (is_array($var)) ? $var : array($var);
		
		foreach($var as $value){
			if(!isset($this->request_var[$value]) || '' === $this->request_var[$value]){
				$this->response->code = 31;
				$this->response->data = '缺少参数'.$value;
				$this->output($this->response->data,$this->response->code);
				break;
			}
		}
	}
	
	/**
	 * 获取get/post等参数
	 *
	 * @param string $param 参数名
	 * @param string $default 默认值
	 */
	public function queryVar($param,$default='')
	{
		$str = isset($this->request_var[$param]) 
				? ( ('' === $this->request_var[$param]) ? $default : $this->request_var[$param] )  
				: $default;
    return is_string($str)?trim($str):$str;
	}
	
    /**
     * 模板显示
     * @access protected
     * @param string $templateFile 模板文件名
	 * @param array $data 模板变量
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return void
     */
    protected function view($data=array(),$templateFile='',$charset='',$contentType='') {
        $this->view->display($data,$templateFile,$charset,$contentType);
    }
	
    /**
     * 获取输出页面内容
     * 调用内置的模板引擎fetch方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件.默认为空 由系统自动定位模板文件
     * @return string
     */
    protected function fetch($templateFile='',$data=array()) {
    	return $this->view->fetch($templateFile,$data);
    }
	
   /**
     * 获取当前Action名称
     * @access protected
     */
    protected function getControllerName() {
        if(empty($this->name)) {
            $this->name     =   MODULE_NAME;
        }
        return $this->name;
    }
    
    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return void
     */
    public function set($name,$value) {
    	$this->view->assign($name,$value);
    }
	
    /**
     * 跳转(URL重定向） 支持指定模块
     * @access protected
     * @param string $url 跳转的URL表达式
     * @return void
     */
    protected function redirect($url) {
    	$url    =   (false === strpos(urldecode($url),APP_URL)) ? APP_URL.urldecode($url) : urldecode($url);
    	header("Location: " . $url);
    	exit;
    }
	
	/**
	 * 加载外部库
	 * @param $name 库名
	 * $param $rename 自定义对象名
	 * $param $otype 对象类型 db/redis
	 * @access protected
	 */
	protected function lib($name,$rename='',$otype='')
	{
		//加载文件
		if (file_exists(LIB_PATH . '/' . $name  . '.php'))
		{
			include_once(LIB_PATH . '/' . $name  . '.php');
			
			if( 'db' == $otype || 'mysql' == $otype)
			{
				$obj = $this->model->getObject('db');
			}
			elseif( 'redis' == $otype )
			{
				$obj = $this->model->getObject($otype);
			}
			else
			{
				$obj = $otype;
			}
			//$obj = ('' == $otype || 'default' == $otype) ? '' : $this->model->getObject($otype);
			
			$hander = new $name($obj);
			
			$status = $hander->result['status'];
			
			if(0 == $status){
				App::response(60,$hander->result['data']);
			}
			else{
				$object  = strtolower($name);
				$objname = ($rename <>'') ? $rename : $object;
				$this->$objname = ( property_exists($hander,$object) ) ? $hander->$object : $hander;
			}
		}
	}
	
	/**
	 * 加载自定义函数
	 * @param $name 函数名
	 * @access protected
	 */
	protected function helper($name)
	{
		//加载文件
		if (file_exists(HELPER_PATH . '/' . $name  . '_helper.php'))
		{
			include_once(HELPER_PATH . '/' . $name  . '_helper.php');
		}
	}
	
	/**
	 * 响应输出
	 *
	 * @param     array /string $data
	 * @param int $code 输出码
	 */
	protected function output($data, $code = 200)
	{
		$this->response->code = $code;
		$this->response->data = $data;
		App::response($code, $data);
	}

	/**
	 * json输出
	 * @param string $status 状态
	 * @param string $data 数据
	 * @param int $code 输出码
	 */
	protected function jsonout($status,$data){
		exit(json_encode(
			array('status' => $status,
				  'data' => $data
			)
		));
	}
	
	/**
	 * 记录日志
	 *
	 * @access    public
	 * @param     string/array
	 * @param     $param 数据参数
	 * @return    bool
	 */
	public function log($message,$param=NULL)
	{
		$message = (is_array($message)) ? $message : array('message'=>$message);
		if(($param))
		{
			$message['param'] = $param;
		}
		$message = json_encode($message);
		@file_put_contents(LOG_PATH . date("Y-m-d",time()).'.log', date("Y-m-d H:i:s",time())." : ".$message."\r\n", FILE_APPEND);
	}
	
   /**
     * 析构方法
     * @access public
     */
    public function __destruct() {
        
    }
}