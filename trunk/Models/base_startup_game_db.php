<?php

/**
 * 创客大赛表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_startup_game_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_startup_game';
	private $team = 'base_team';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_startup_game';
		$this->team = DB_PREFIX . 'base_team';
	}
	
	public function getlist($param){
		$where = array();
			if(!empty($param['activityName']) == 'activityName' )
			{
				$where['like']['activityName']  = $param['activityName'];
			}
			if(!empty($param['status']) == 'status' || $param['status'] == 'status')
			{
				$where['where']['status']  = $param['status'];	
			}
					
		$total = $this->db->total($this->table.'', $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['id'] = $param['id'];
		}
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
		$ret = $this->db->insert($this->table, $param);
		if($ret){
			$this->result['status'] = 1;
			$param['id'] = $this->db->last_id();
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

	public function findrotation($param){
		$where['where']['id'] = $param['id'];
		$resp = $this->db->select($this->table,'photoIds',$where);
		if($resp){
			$this->result['status'] = 1;
			$this->result['data'] = $resp;
		}else{
			$this->result['status'] = 0;
		}
		return $this->result;
	}

	/**
	 * 团队列表
	 */
	public function getTeamlist($param){
		$where['where']['a.status'] = 1;
		if(!empty($param['key_type']) == 'teamName' )
		{
			$where['like']['a.teamName']  = $param['key'];
		}
					
		$total = $this->db->total($this->team.' a left join '.$this->table.' b on b.id=a.gameId', $where);

		$this->result['data']['total'] = $total;

		if(!empty($param['gameId'])){
			$where['where']['a.gameId'] = $param['gameId'];
		}
		$where['order']['a.sort'] = 'DESC';

		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}

		$data  = $this->db->select($this->team.' a left join '.$this->table.' b on b.id=a.gameId','a.*', $where);
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

	public function teamlist($param){
		if(!empty($param)){
			$where['where']['id'] = $param['id'];
			$where['where']['status'] = 1;
			$resp = $this->db->select($this->team,'',$where);

			if($resp){
				$this->result['status'] = 1;
				$this->result['data']['list'] = $resp;
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

	/**
	 * 添加
	 * @return array
	 */
	public function createteam($param){
		$ret = $this->db->insert($this->team, $param);

		if($ret){
			$this->result['status'] = 1;
			$param['id'] = $this->db->last_id();
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function updateteam($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update($this->team, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->team, '', $where);
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
	function deleteteam($param)
	{
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);
			unset($param['id']);
			$status['status'] = 0;
			$ret = $this->db->update($this->team, $status, $where);
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

	public function teamlistId($param){
		$where = array();
		
		if(!empty($param['gameId'])){
			$where['where']['gameId'] = (int)$param['gameId'];
			if(!empty($param['key_type']) == 'teamName' )
			{
				$where['like']['teamName']  = $param['key'];
			}
			$total = $this->db->total($this->team.'', $where);
			$this->result['data']['total'] = $total;
			if( isset($param['limit']) )
			{
				$where['limit'] = $param['limit'];
			}
			$data  = $this->db->select($this->team,'', $where);
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

	public function teamlistmember($param){
		$where = array();
		
		if(!empty($param['teamId'])){
			$where['where']['a.teamId'] = $param['teamId'];
			if(!empty($param['key_type']) == 'alias' )
			{
				$where['like']['b.alias']  = $param['key'];
			}
			if(!empty($param['key_type']) == 'realName' )
			{
				$where['like']['a.name']  = $param['key'];
			}
			if(!empty($param['key_type']) == 'mobilePhone' )
			{
				$where['like']['a.mobilePhone']  = $param['key'];
			}
			if(!empty($param['id'])){
				$where['where']['a.id'] = $param['id'];
			}
			$total = $this->db->total('t_base_team_member as a left join t_member_customer as b on b.id=a.memberId', $where);
			$this->result['data']['total'] = $total;

			if( isset($param['limit']) )
			{
				$where['limit'] = $param['limit'];
			}
			$data  = $this->db->select('t_base_team_member as a left join t_member_customer as b on b.id=a.memberId left join t_base_school as c on c.id=a.schoolId','a.*,b.alias,c.schoolName', $where);
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

	public function updatePrice($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);

		unset($param['id']);
		$ret = $this->db->update('t_base_team_member', $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$data = $this->db->select($this->table, '', $where);
			$this->result['data']   = $data[0];
		}
		return $this->result;
	}
}