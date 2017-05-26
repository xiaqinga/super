<?php

/**
 * 公共model调用接口
 *
 * @author  janhve@163.com
 * @since   2015.12.16
 * @version 1.0
 */
 
class api extends Controller {
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		//请求认证
        echo 1;
		$this->requestAuth();
	}
	
	/**
	 * 接口请求认证
	 */
	private function requestAuth(){
		$access_token = $this->queryVar('access_token');
		
		if($this->response->code === 200){			
			if($access_token !== ACCESS_TOKEN){
				$this->response->code = 40;
				$this->response->data = '非法请求';
				$this->apijsonout($this->response->data,$this->response->code);
			}
		}
	}
	
	public function read(){
		$apiname = $this->queryVar('apiname');
		$method = $this->queryVar('method');
		$api_param = json_decode($this->queryVar('api_param'),TRUE);
		$resp = $this->model->read($apiname,$method,$api_param);
		
		$this->apijsonout($resp);
	}
	
	public function write(){
		$apiname = $this->queryVar('apiname');
		$method = $this->queryVar('method');
		$api_param = json_decode($this->queryVar('api_param'),TRUE);
		$resp = $this->model->write($apiname,$method,$api_param);
		$this->apijsonout($resp);
	}

	/**
	 * json输出
	 * @param string $status 状态
	 * @param string $data 数据
	 * @param int $code 输出码
	 */
	protected function apijsonout($data){
		exit(json_encode(
			array(
				'code'=>'200',
				'data'=>$data
				)
			));
	}
	
}