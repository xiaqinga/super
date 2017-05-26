<?php

/**
 * 业务模板
 *
 */
 
class base_config extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){           
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}
	
	public function edit(){
		$resp = $this->model->read('base_config','getlist');
		$array = array();
		foreach ($resp['data']['list'] as $key => $value) {
			$array[$value['sysKey']] = array(
				$value['sysKey'] => $value['sysKey'],
				'sysKey' => $value['sysValue']
			);
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_config/edit');

		$data['attr'] = $array;
		$this->view($data,'base_config/edit');
	}


	public function save(){
		$data_config = json_decode($this->queryVar('data_config'),true);


		foreach ($data_config as $key => $value) {
			if($value['time']){
				  $param['sysKey'] = $value['status'];
			    $param['sysValue'] = $value['time'];
			  	$resp = $this->model->write('base_config','update',$param);
			}
			
		
		}
		$ref = $this->queryVar('ref',APP_URL . 'base_config/edit');
		$this->setActionLog('base_config','UPDATE','修改规则信息');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '规则信息修改成功' : '规则信息未更改',
			'ref'=> $ref
		));
		
	}

}