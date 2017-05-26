<?php

/**
 * 投稿征集表

 */
 
class base_submission_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_submission';
	private $t_table = 'base_submission_record';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_submission';
		$this->t_table = DB_PREFIX . 'base_submission_record';
	}
	
	public function getlist($param){
		$where = array();
		if(!empty($param['key']) && !empty($param['key_type'])){
			if($param['key_type'] == 'identifier' )
			{
				$where['where']['identifier']  = $param['key'];
			}
			if($param['key_type'] == 'subName' )
			{
				$where['where']['subName']  = $param['key'];
			}
			if($param['key_type'] == 'status')
			{
				$where['where']['status']  = $param['key'];	
			}
		}
					
		$total = $this->db->total($this->table.'', $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}

		$where['order']['createDate'] = 'DESC';
		
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}

		$data  = $this->db->select($this->table,'', $where);

		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}
	
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$sql = "
			INSERT INTO t_base_submission (
				`subName`,
				`identifier`,
				`photoUrl`,
				`description`,
				`startDate`,
				`endDate`,
				`status`,
				`detail`,
				`createUser`,
				`createDate`,
				`photoIds`
			)VALUES(
				'".$param['subName']."','".$param['identifier']."','".$param['photoUrl']."','".$param['description']."','".$param['startDate']."','".$param['endDate']."','".$param['status']."','".$param['detail']."','".$param['createUser']."','".$param['createDate']."','".$param['photoIds']."'
			)	
		";
		$ret = $this->db->insert($sql);
		// var_dump($this->db->last_query());die();
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update($this->table, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table, '', $where);
			$this->result['data']   = $data[0];
		}
		return $this->result;
	}

	/**
	 * 删除
	 *
	 * @param int $id
	 * @return bool
	 */
	function delete($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			$ret   = $this->db->delete($this->table, $where);
			if ($ret)
			{
				$this->result['status'] = 1;
				$this->result['data']   = $param; //返回完整的记录信息
			}
			else
			{
				$this->result['status'] = 0;
			}
		}
		else
		{
			$this->result['status'] = 0;
		}

		return $this->result;
	}

	//投稿列表
	public function recordlist($param){
		if(!empty($param['id'])){
			// var_dump($param);die();
			$where = array();
			$where['where']['a.status !='] = '-1';
			$where['where']['a.submissionId'] = $param['id'];
			if(!empty($param['key']) && !empty($param['key_type'])){
				if($param['key_type'] == 'subName' )
				{
					$where['where']['a.subName']  = $param['key'];
				}
				if($param['key_type'] == 'telPhone' )
				{
					$where['where']['a.telPhone']  = $param['key'];
				}
				if($param['key_type'] == 'schoolId')
				{
					$where['where']['a.schoolId']  = $param['key'];	
				}
			}
						
			$total = $this->db->total($this->t_table.' a', $where);

			$this->result['data']['total'] = $total;

			if( isset($param['limit']) )
			{
				$where['limit'] = $param['limit'];
			}
			$data  = $this->db->select($this->t_table.' a  left join t_base_school as b on b.id=a.schoolId' ,'a.*,b.schoolName', $where);
			// var_dump($this->db->last_query());die();
			if(!empty($data))
			{
				$this->result['status'] = 1;
				$this->result['data']['list']   = $data;
			}
			else
			{
				$this->result['status'] = 0;
				$this->result['data']   = '获取用户数据失败';
			}
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		
		return $this->result;
	}

	//学校列表
	public function schoollist($param){
		$resp = $this->db->select('t_base_school','',$param);
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data']['list']   = $resp;
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}

	//查看记录详情
	public function findrecord($param){
		if (!empty($param['id'])) {
			$where['where']['a.id'] = $param['id'];
			$resp = $this->db->select($this->t_table.' a left join t_base_school as b on b.id=a.schoolId','a.*,b.schoolName',$where);
			if($resp){
				$this->result['status'] = 1;
				$this->result['data']['list']   = $resp;
			}else{
				$this->result['status'] = 0;
				$this->result['data']   = '获取用户数据失败';
			}
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}

	public function findSubId($param){
		$where['where']['id'] = $param['id'];
		$resp = $this->db->select($this->t_table,'',$where);
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}
		return $this->result;
	}

	public function findSubIds($param){
		$where['where']['submissionId'] = $param['submissionId'];
		$where['order']['code'] = 'DESC';
		$resp = $this->db->select($this->t_table,'',$where);
		if ($resp) {
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}
		return $this->result;
	}

	public function upstatus($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$status['status'] = 2;
		$status['code'] = $param['code'];
		$ret = $this->db->update($this->t_table, $status, $where);
		if($ret){
			$this->result['status'] = 1;
		}
		return $this->result;
	}

	public function exportorder($param){
		if (!empty($param)) {
			$where['where']['a.submissionId'] = $param;
			$where['where']['a.status !='] = '-1';
			$resp = $this->db->select($this->t_table.' a left join '.$this->table.' b on b.id=a.submissionId left join t_base_school as c on c.id=a.schoolId','a.*,b.identifier,b.subName as bName,c.schoolName',$where);
			if($resp){
				$this->result['status'] = 1;
				$this->result['data']['list']   = $resp;
			}else{
				$this->result['status'] = 0;
				$this->result['data']   = '获取用户数据失败';
			}
		}else{
			$this->result['status'] = 0;
			$this->result['data']   = '获取用户数据失败';
		}
		return $this->result;
	}

	public function findrotation($id){
		$where['where']['id'] = $id;
		$resp = $this->db->select($this->table,'photoIds',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	public function disabled($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$status['enableStatus'] = $param['enableStatus'];
		$ret = $this->db->update($this->t_table, $status, $where);
		if($ret){
			$this->result['status'] = 1;
		}
		return $this->result;
	}

	public function findPhoto($param){
		if(!empty($param)){
			$where['where']['id'] = $param;
			$resp = $this->db->select('t_goods_photo','photoPath',$where);
			if($resp){
				$this->result['status'] = 1;
				$this->result['data'] = $resp;
			}else{
				$this->result['status'] = 0;
			}
		}
		return $this->result;
	}
}