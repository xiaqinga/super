<?php

/**
 * 快递公司
 *
 * @author wsbnet@qq.com
 * @since   2016-08-24
 * @version 1.0
 */
 
class ems_list extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}

	public function jsonList()
	{
		//查询
		$id = $this->queryVar('id');
		$param['id'] = $id;
		$resp = $this->model->read('ems_list','getlist',$param);
		json_encode($resp['status'] ? $resp['data']['list'] : array());
	}
}