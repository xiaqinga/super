<?php

/**
 * 服务请求
 * @author  yinjh@sayimo.cn
 * @since   2016.08.05
 * @version 1.0
 */
 
class service extends common {
	
	
	/**
	 * 初始化，并检查中间错误
	 * 
	 */
	public function __construct(){
		parent::__construct();
	}

	public function getcity(){
		$data['code'] = 200;
		$data['data'] =  array();
		$param = array(
			'sid' => $this->queryVar('id', 0)
		);
		$resp = $this->model->read('city','getCityList', $param);

		if($resp['status'] == 1){
			$city_data = $resp['data']['list'];
		}
		
		if($resp['status'] && !empty($resp['data']['list'])){
			foreach ($resp['data']['list'] as $key => $val) {
				$data['data'][$key]['id'] = $val['id'];
				$data['data'][$key]['value'] = $val['cname'];
				$data['data'][$key]['parent'] = $val['sid'];
				$data['data'][$key]['isleaf'] = "false";
			}
		}
		$data['data'] = array_values($data['data']);
		exit(json_encode($data));
	}
	
	public function setSession(){
		$key = $this->queryVar('key_data');
		$sess_data[$key] = $this->queryVar('val_data');
		
		$this->sess->set($sess_data);
		$this->jsonout(1,array(
			'msg'=>true
		));
	}
}