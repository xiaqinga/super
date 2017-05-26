<?php

/**
 * 大赛详情表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class  member_customer_db {
	//Db
	private $db = NULL;
	//database table
	private $table = 'base_team';
	private $member = 'base_team_member';
	private $detail = 'base_startup_game_detail';
	private $game = 'base_startup_game';
	private $customer = 'member_customer';
	
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = DB_PREFIX . 'base_team';
		$this->member = DB_PREFIX . 'base_team_member';
		$this->detail = DB_PREFIX . 'base_startup_game_detail';
		$this->game = DB_PREFIX . 'base_startup_game';
		$this->customer =	DB_PREFIX . 'member_customer';
	}
	
	public function getlist($param){

		$where = array();
		$where['where']['gameId'] = $param['gameId'];
		if(!empty($param['key_type']) && !empty($param['key'])){
	
			if(($param['key_type']) == 'alias' )
			{
				$where['like']['e.alias']  = $param['key'];
			}
			
			if(($param['key_type']) == 'fundationRank')
			{
				$where['like']['c.fundationRank'] = $param['key'];
			}
		}
			if(($param['key_type']) == 'Date')
			{
				$where['where']['d.startDate >='] = $param['startDate'];
				$where['where']['d.endDate <='] = $param['endDate'];
			}
		
	$total  = $this->db->total($this->table.' a left join '.$this->member.' b on b.teamId=a.id'.' left join '.$this->detail.' c on c.teamId=a.id '. 'left join ' .$this->game. ' d on d.id=a.gameId ' . 'left join ' .$this->customer. ' e on e.id=a.createUser ' ,'', $where);
		


		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table.' a left join '.$this->member.' b on b.teamId=a.id'.' left join '.$this->detail.' c on c.teamId=a.id '. 'left join ' .$this->game. ' d on d.id=a.gameId ' . 'left join ' .$this->customer. ' e on e.id=a.createUser ' ,'', $where);
		

		
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
}