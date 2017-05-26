<?php

/**
 * 操作日志模型
 * @author janhve@163.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class actionLog_db {
	//Db
	private $db = NULL;
	//database table
	private $table_user = 'admin_user';
	private $table_action_log = 'admin_action_log';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table_user = DB_PREFIX . 'admin_user';
		$this->table_action_log = DB_PREFIX . 'admin_action_log';
	}
	/**
	 * 获取操作日志列表
	 */
	public function getActionLogList($param){
		$sql = "SELECT a.id,a.actionIp,a.moduleId,a.actionUser,a.actionDate,a.actionType,a.actionContent,b.userName
		FROM ".$this->table_action_log." AS a LEFT JOIN ". $this->table_user . " AS b ON a.actionUser = b.id WHERE 1";
		
		if(isset($param['userName']) && !empty($param['userName']))
		{
			$sql .= " AND b.userName like '%".$param['userName']."%'";
		}
		if(isset($param['actionType']) && !empty($param['actionType']))
		{
			$sql .= " AND a.actionType=".$param['actionType'];
		}
		if(isset($param['startDate']) && !empty($param['startDate']))
		{
			$sql .= " AND  TO_DAYS(a.actionDate) >= TO_DAYS('".$param['startDate']."')";
		}
		if(isset($param['endDate']) && !empty($param['endDate']))
		{
			$sql .= " AND TO_DAYS(a.actionDate) <= TO_DAYS('".$param['endDate']."')";
		}
		if(isset($param['id']) && !empty($param['id']))
		{
			$sql .= " AND a.id=".$param['id'];
		}
		$total = $this->db->total($sql);
		$this->result['data']['total'] = $total;
		$sql .= " order by a.id desc";
		if(isset($param['limit']) && !empty($param['limit']))
		{
			$sql .= " limit ".$param['limit'];
		}
		$data  = $this->db->select($sql);
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取操作日志失败';
		}
		return $this->result;
	}

	/**
	 * 添加操作日志
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->table_action_log, $param);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		else{
			$this->result['status'] = 0;
			$this->result['data']   = '操作日志添加失败';
		}
		return $this->result;
	}

	public function delete($param){
		if (!empty($param)) {
			$sql = 'DELETE from t_admin_action_log where actionDate>="'.$param['startDate'].' 00:00:00"'.' AND actionDate<="'.$param['endDate'].' 23:59:59"';
		}
		$resp = $this->db->delete($sql);
		if($resp){
			$this->result['status'] = 1;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}
}