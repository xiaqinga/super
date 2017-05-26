<?php

/**
 * 创客大赛
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class base_startup_game extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
	}
	
	public function index()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
	
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);

		$this->view($data,'base_startup_game/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_startup_game/ajaxindex');
	}
	public function getclass(){
		$data = array('1'=>"启用",'0'=>"禁用");
		return $data;
	}
	public function teamTypeclass(){
		$data = array('1'=>'自建团队','2'=>'指定团队');
		return $data;
	}
	public function edit(){
		$id = $this->queryVar('id');
		$classTitles = $this->model->read('base_startup_game','getlist');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_startup_game','getlist',$param);
			// var_dump($resp);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
			$qq = explode(',',$data['attr']['photoIds']);
	        foreach ($qq as $value) {
	          $photo = $this->model->read('base_enterprise_info','findbasephoto',$value);
	          // var_dump($photo);
	          if ($photo['status']) {
	            $photo_resp[] = $photo['data'][0];
	          }
	        }
	        // var_dump($photo_resp);die();
	        $data['main_photos'] = $photo_resp;
		}
		$data['teamTypelist'] = $this->teamTypeclass();
		$data['statuslist'] = $this->getclass();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game/index');
		$this->view($data,'base_startup_game/edit');
	}
	public function Team(){
		$id = $this->queryVar('id');
		$data['classTitles'] = $classTitles['data']['list'];
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_startup_game','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
		}
		$data['classList'] = $this->getClassList();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game_detail/index');

		$this->view($data,'base_startup_game_detail/index');

		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		$classTitles = $this->model->read('base_startup_game','getlist');
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','getlist',$param);
		$data  = array(
			'classList' => $this->getClassList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'activityName' => $activityName,
			'status' => $status,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/index?key_type='.$key_type.'&activityName='.$activityName.'&status='.$status.'&page='.$page)

		);

		$this->view($data,'base_startup_game_detail/ajaxindex');
	}
	public function save(){
		$id = $this->queryVar('id');
		$param['activityName'] = $this->queryVar('activityName');
		$param['identifier'] = $this->queryVar('identifier');
		$param['teamMaxCount'] = $this->queryVar('teamMaxCount',0);
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['description'] = $this->queryVar('description',0);
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$param['sort'] = $this->queryVar('sort',0);
		$param['status'] = $this->queryVar('status');
		$param['createUser'] = $this->queryVar('createUser',0);
		$param['brief'] = $this->queryVar('brief');
		$param['applyStartDate'] = $this->queryVar('applyStartDate');
		$param['applyEndDate'] = $this->queryVar('applyEndDate');
		$param['teamType'] = $this->queryVar('teamType');	
		$main_photos = $this->queryVar('listphote');
	    $main_photos = array_filter(json_decode($main_photos,true));
	    if(count($main_photos)>0){
	        foreach ($main_photos as $key => $value) {
	          if(!$value['id']){
	            $param1 = array(
	              'photoName' => $value['photoName'], 
	              'photoPath' => $value['photoPath'], 
	            );
	            $resp = $this->model->write('base_photo','create', $param1);
	            // var_dump($resp);die();
	            $last_id[] = $resp['data']['id'];
	            if($resp['status']){$ok = true;}
	          }else{
	            //更新
	            $param1 = array(
	              'id' => $value['id'],
	              'photoName' => $value['photoName'], 
	              'photoPath' => $value['photoPath'],  
	            );
	            $resp = $this->model->write('base_photo','update', $param1);
	            $last_id[]=$value['id'];
	            if($resp['status']){$ok = true;}
	          }
	          
	        }
	        $param['photoIds'] = implode(',',$last_id);
	    }
	    
	    $ref = $this->queryVar('ref',APP_URL . 'base_startup_game/index');
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_startup_game','create', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_startup_game','update', $param);
			$opt  = '修改';
		}
		if ($param['teamType'] == '2') {
			$ref = APP_URL . "base_startup_game/teamindex?id=".$resp['data']['id'];
		}
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '大赛'.$opt.'成功' : '大赛没变化',
			'ref'=> $ref
		));
	}

	public function photoDelete(){
	    $id = $this->queryVar('id');
	    $ref = $this->queryVar('ref',APP_URL . 'base_startup_game/index');
	    $ref = urldecode($ref);
	    $param['id'] = $id;
	    $resp = $this->model->write('base_photo','delete', $param);
	    $this->jsonout($resp['status'],array(
	      'status'=> 1,
	      'msg'=>'图片删除成功',
	      'ref'=> $ref
	    ));
	}

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_startup_game/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_startup_game','delete', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '大赛删除成功' : '大赛删除失败',
			'ref'=> $ref
		));
	}
	public	function info(){
	    $id = $this->queryVar('id');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $resp = $this->model->read('base_startup_game','getlist',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game/index');
	    $this->view($data,'base_startup_game/info');
	}

	public function teamindex(){
		$id = $this->queryVar('id');
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
	
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['gameId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','getTeamlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'id' => $id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);

		$this->view($data,'base_startup_game/teamindex');
	}

	public function ajaxteamindex(){
		$id = $this->queryVar('id');
		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['gameId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','getTeamlist',$param);
		$data  = array(
			'id' => $id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/teamindex?id='.$id.'&key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_startup_game/ajaxteamindex');
	}

	public function editteam(){
		$id = $this->queryVar('id');
		$tid = $this->queryVar('tid');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_startup_game','teamlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
		}
		$data['tid'] = $tid;
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game/teamindex?id='.$tid);
		$this->view($data,'base_startup_game/editteam');
	}

	public function saveteam(){
		$id = $this->queryVar('id');
		$tid = $this->queryVar('tid');
		$param['gameId'] = $tid;
		$param['teamName'] = $this->queryVar('teamName');
		$param['maxNumberCount'] = $this->queryVar('maxNumberCount',0);
		$param['description'] = $this->queryVar('description');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['brief'] = $this->queryVar('brief');
		$param['sort'] = $this->queryVar('sort');
		$param['status'] = 1;
		//微信相关
		$ref = $this->queryVar('ref',APP_URL . 'base_startup_game/teamindex?id='.$id);
		$ref = urldecode($ref);
		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['ceateTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_startup_game','createteam', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$resp = $this->model->write('base_startup_game','updateteam', $param);
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '团队'.$opt.'成功' : '团队没变化',
			'ref'=> $ref
		));
	}

	public function infoteam(){
		$id = $this->queryVar('id');
		$tid = $this->queryVar('tid');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $resp = $this->model->read('base_startup_game','teamlist',$param);
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['tid'] = $tid;
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game/teamindex?id='.$tid);
	    $this->view($data,'base_startup_game/infoteam');
	}

	public function deleteteam(){
		$id = $this->queryVar('ids');
		$array_id = explode(',',$id);
		$ref = $this->queryVar('ref',APP_URL . 'base_startup_game/teamindex?id='.$array_id[1]);
		$ref = urldecode($ref);
		$param['id'] = $array_id[0];
		$resp = $this->model->write('base_startup_game','deleteteam', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '团队解散成功' : '团队解散失败',
			'ref'=> $ref
		));
	}

	public function teamlist(){
		$id = $this->queryVar('gameId');
		$this->lib('Pagination','page');
		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
	
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['gameId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','teamlistId',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'id' => $id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);

		$this->view($data,'base_startup_game/teamlist');
	}

	public function ajaxteamlist(){
		$id = $this->queryVar('gameId');
		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['gameId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','teamlistId',$param);
		$data  = array(
			'id' => $id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_startup_game/ajaxteamlist');
	}

	public function infoteamPes(){
		$id = $this->queryVar('id');
		$teamId = $this->queryVar('teamId');
		$gameId = $this->queryVar('gameId');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $param['teamId'] = $teamId;
	      $resp = $this->model->read('base_startup_game','teamlistmember',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['id'] = $teamId;
	    $data['gameId'] = $gameId;
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_startup_game/teamlist?id='.$id);
	    $this->view($data,'base_startup_game/infoteamPes');
	}

	public function teammember(){
		$id = $this->queryVar('id');
		$gameId = $this->queryVar('gameId');
		$this->lib('Pagination','page');
		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['teamId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','teamlistmember',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'id' => $id,
			'gameId' => $gameId,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);

		$this->view($data,'base_startup_game/teammember');
	}

	public function ajaxteammember(){
		$id = $this->queryVar('id');
		$gameId = $this->queryVar('gameId');
		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		$param = array();
		$param['teamId'] = $id;
		if(!empty($key_type)){
			$param['key_type'] = $key_type;
		}
		if($key){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_startup_game','teamlistmember',$param);
		$data  = array(
			'id' => $id,
			'gameId' => $gameId,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_startup_game/teamlist?id='.$id.'&gameId='.$gameId.'&key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_startup_game/ajaxteammember');
	}

	public function savePrice(){
		$id = $this->queryVar('id');
		$gameId = $this->queryVar('gameId');
		$param['id'] = $this->queryVar('memberId');
		$param['sellPrice'] = $this->queryVar('sellPrice');
		// $ref = $this->queryVar('ref',APP_URL . 'base_startup_game/index');
		// $ref = urldecode($ref);
		$ref = APP_URL .'base_startup_game/teammember?id='.$id.'&gameId='.$gameId;
		$resp = $this->model->write('base_startup_game','updatePrice', $param);
		$opt  = '修改';
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '销售额'.$opt.'成功' : '销售额没变化',
			'ref'=> $ref
		));
	}

}