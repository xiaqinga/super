<?php

/**
 * 快递公司模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-24
 * @version 1.0
 */
 
class ems_list_db{
	//Db
	private $db = NULL;
	//database table
	private $table = 'ems_list';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX.'ems_list';
	}
	
  public function getlist($param){
    $where = array();

    if(!empty($param['emsName'])){
      $where['like']['emsName'] = $param['emsName'];
    }

    $total = $this->db->total($this->table, $where);
    $this->result['data']['total'] = $total;

    if(!empty($param['id'])){
      $where['where']['id'] = $param['id'];
    }
    $where['order']['id'] = 'DESC';
    if( isset($param['limit']) )
    {
      $where['limit'] = $param['limit'];
    }
    $data = $this->db->select($this->table, '', $where);

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']['list']   = $data;
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data']   = 'No Data';
    }
    return $this->result;
  }

}