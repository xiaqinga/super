<?php

/**
 * 投稿征集
 *
 */
 
class base_submission extends common {
		
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
		$resp = $this->model->read('base_submission','getlist',$param);
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

		$this->view($data,'base_submission/index');
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
		$resp = $this->model->read('base_submission','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_submission/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_submission/ajaxindex');
	}
	public function getclass(){
		$data = array('1'=>"启用",'-1'=>"禁用");
		return $data;
	}
	public function isAuditclass(){
		$data = array('1'=>'需要','0'=>'不需要');
		return $data;
	}
	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('base_submission','getlist',$param);
			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];
			}
			$data['id'] = $id;
			$qq = explode(',',$data['attr']['photoIds']);
	        foreach ($qq as $value) {
	          $photo = $this->model->read('base_enterprise_info','findbasephoto',$value);
	          if ($photo['status']) {
	            $photo_resp[] = $photo['data'][0];
	          }
	        }
	        // var_dump($photo_resp);die();
	        $data['main_photos'] = $photo_resp;
		}
		$data['statuslist'] = $this->getclass();
		$data['isAuditlist'] = $this->isAuditclass();
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'base_submission/index');
		$this->view($data,'base_submission/edit');
	}

	public function save(){		
		$id = $this->queryVar('id');
		$param['subName'] = $this->queryVar('subName');
		$param['identifier'] = $this->queryVar('identifier');
		$param['photoUrl'] = $this->queryVar('photoUrl',0);
		$param['description'] = $this->queryVar('description',0);
		$param['startDate'] = $this->queryVar('startDate');
		$param['endDate'] = $this->queryVar('endDate');
		$TT = substr($param['endDate'],0,10);
		$param['endDate'] = $TT.' 23:59:59';
		$param['description'] = $this->queryVar('description');
		$param['status'] = $this->queryVar('status');
		$param['detail'] = $this->queryVar('detail');
		$param['isAudit'] = $this->queryVar('isAudit');
		$ref = $this->queryVar('ref',APP_URL . 'base_submission/index');
		$ref = urldecode($ref);
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

		if(!$id)
		{
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_submission','create', $param);
			$opt  = '添加';
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('base_submission','update', $param);
			$opt  = '修改';
		}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '投稿征集'.$opt.'成功' : '投稿征集没变化',
			'ref'=> $ref
		));
	}

	public function photoDelete(){
	    $id = $this->queryVar('id');
	    $infoid = $this->queryVar('infoid');
	    $goodsId = $this->queryVar('goodsId');
	    $ref = $this->queryVar('ref',APP_URL . 'base_submission/index');
	    $ref = urldecode($ref);
	    $param['id'] = $id;
	    $param['goodsId'] = $goodsId;

	    $info = $this->model->read('base_submission','findrotation',$infoid);
	    $qq = explode(',',$info['data'][0]['photoIds']);
	    foreach ($qq as $value) {
	      if ($value == $id) {
	        unset($value);
	      }else{
	        $array[] = $value;
	      }
	    }
	    $where['photoIds'] = implode(',',$array);
	    $where['id'] = $infoid;
	    $this->model->write('base_submission','update',$where);

	    $resp = $this->model->write('base_photo','delete', $param);
	    $this->jsonout($resp['status'],array(
	      'status'=> 1,
	      'msg'=>'图片删除成功',
	      'ref'=> $ref
	    ));
	  }

	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'base_submission/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('base_submission','delete', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '投稿征集删除成功' : '投稿征集删除失败',
			'ref'=> $ref
		));
	}
	public	function info(){
	    $id = $this->queryVar('id');
	    // var_dump($id);die();
	    if(!empty($id)){
	      $param['id'] = $id;
	      $resp = $this->model->read('base_submission','getlist',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	      }
	    }
	    $data['id'] = $id;
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_submission/index');
	    $this->view($data,'base_submission/info');
	}

	public function record(){
		$id = $this->queryVar('id');
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
		$param['id'] = $id;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_submission','recordlist',$param);
		$school = $this->model->read('base_submission','schoollist');
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'id' =>$id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url(),
			'school' => ($school['status']) ? $school['data']['list'] : array(),
		);

		$this->view($data,'base_submission/record');
	}

	public function ajaxRecord(){
		$id = $this->queryVar('id');
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
		$param['id'] = $id;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_submission','recordlist',$param);
		// var_dump($resp);die();
		$school = $this->model->read('base_submission','schoollist');
		$data  = array(
			'id' =>$id,
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_submission/record?id='.$id.'&key_type='.$key_type.'&key='.$key.'&page='.$page),
			'school' => ($school['status']) ? $school['data']['list'] : array(),
		);
		$this->view($data,'base_submission/ajaxrecord');
	}

	public function upstatus(){
		$id = $this->queryVar('ids');
		$array = explode(',', $id);
		$record_id = $array[0];
		$submission_id = $array[1];
		$ref = $this->queryVar('ref',APP_URL . 'base_submission/record?id='.$submission_id);
		$ref = urldecode($ref);
		$param['id'] = $record_id;
		$sd = $this->model->read('base_submission','findSubId',$param);
		$param['submissionId'] = $sd['data'][0]['submissionId'];
		$submissionId = $this->model->read('base_submission','findSubIds',$param);
		if (empty($submissionId['data'][0]['code'])) {
			$param['code'] = '001';
		}else{
			$param['code']  = $submissionId['data'][0]['code']+1;
			// var_dump(strlen($param['code']));die();
			if(strlen($param['code']) == 1){
				$param['code'] = '00'.$param['code'];
			}
			if ( strlen($param['code']) > 1 && strlen($param['code']) <= 2  ) {
				$param['code'] = '0'.$param['code'];
			}
			if ( strlen($param['code']) > 2 ) {
				$param['code'] = $param['code'];
			}
		}
		$resp = $this->model->write('base_submission','upstatus', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '投稿入围成功' : '投稿入围失败',
			'ref'=> $ref
		));
	}

	public function inforecord(){
		$id = $this->queryVar('id');
		$sid = $this->queryVar('sid');
	    if(!empty($id)){
	      $param['id'] = $id;
	      $resp = $this->model->read('base_submission','findrecord',$param);	
	      if($resp['status']){
	        $data['attr'] = $resp['data']['list'][0];
	        $photo = explode(',',$data['attr']['photoIds']);
	        foreach ($photo as $key => $value) {
	        	$photoPath = $this->model->read('base_submission','findPhoto',$value);
	        	$photoUrl[] = $photoPath['data'][0]['photoPath'];
	        }
	        $data['photoUrl'] = $photoUrl;
	      }
	    }
	    // var_dump($data['photoUrl']);
	    $data['id'] = $sid;
	    $data['ref'] = $this->queryVar('ref' , APP_URL . 'base_submission/record?id='.$sid);
	    $this->view($data,'base_submission/inforecord');
	}

	//导出投稿记录
	function exportorder(){
		$id = $this->queryVar('id');
		$resp = $this->model->read('base_submission','exportorder',$id);
		$status = array(
	        '1' => '待入围',
	        '2' => '已入围'
	    );
	    $sep = "\t"; 
	    $savename = date("YmjHis");  
	    
	    $file_type = "vnd.ms-excel";  
	    $file_ending = "xls";  
	    header("Content-Type: application/$file_type;charset=gbk");  
	    header("Content-Disposition: attachment; filename=".$savename.".$file_ending");  
	    header("Pragma: no-cache");
			echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
			 xmlns:x="urn:schemas-microsoft-com:office:excel"
			 xmlns="http://www.w3.org/TR/REC-html40">
			<head>
			 <meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
			 <meta http-equiv=Content-Type content="text/html; charset=gb2312">
			 <!--[if gte mso 9]><xml>
			 <x:ExcelWorkbook>
			 <x:ExcelWorksheets>
			   <x:ExcelWorksheet>
			   <x:Name></x:Name>
			   <x:WorksheetOptions>
			     <x:DisplayGridlines/>
			   </x:WorksheetOptions>
			   </x:ExcelWorksheet>
			 </x:ExcelWorksheets>
			 </x:ExcelWorkbook>
			 </xml><![endif]-->

			</head>';
			echo "<table>";

	    $th_td[0] = "<td>标识符</td>";
	    $th_td[1] = "<td>名称</td>";
	    $th_td[2] = "<td>投稿人姓名</td>";
	    $th_td[3] = "<td>联系电话</td>";
	    $th_td[4] = "<td>学校</td>";
	    $th_td[5] = "<td>所属系</td>";
	    $th_td[6] = "<td>班级</td>";
	    $th_td[7] = "<td>主题</td>";
	    $th_td[8] = "<td>描述</td>";
	    $th_td[9] = "<td>状态</td>";
	    $th_td[10] = "<td>投稿时间</td>";

			echo "<tr>";
	    foreach ($th_td as $key => $value) {
	       echo iconv('utf-8', 'gbk', $value).$sep;
	    }
	    echo "</tr>";
	    foreach ($resp['data']['list'] as $key => $value) {
	    	if ($value['status'] == '1') {
	    		$status = '未入围';
	    	}elseif($value['status'] == '2'){
	    		$status = '已入围';
	    	}
	        $head_td[0] = "<td>".$value['identifier']."</td>";
	        $head_td[1] = "<td>".$value['bName']."</td>";
	        $head_td[2] = "<td>".$value['subName']."</td>";
	        $head_td[3] = "<td>".$value['telPhone']."</td>";
	        $head_td[4] = "<td>".$value['schoolName']."</td>";
	        $head_td[5] = "<td>".$value['department']."</td>";
	        $head_td[6] = "<td>".$value['classGrade']."</td>";
	        $head_td[7] = "<td>".$value['subject']."</td>";
	        $head_td[8] = "<td>".$value['description']."</td>";
	        $head_td[9] = "<td>".$status."</td>";
	        $head_td[10] = "<td>".$value['createDate']."</td>";
	        echo "<tr>";
	        foreach ($head_td as $key_ht => $value_ht) {
	           echo iconv('utf-8', 'gbk', $value_ht).$sep;
	        }
	        echo "</tr>";
	    }
	    echo "</table>";
	    
	    return (true);
	}

	/*
	启用禁用
	 */
	public function disable(){
		$id = $this->queryVar('ids');
		$array = explode(',', $id);
		$record_id = $array[0];
		$submission_id = $array[1];
		$enableStatus = $array[2];
		$ref = $this->queryVar('ref',APP_URL . 'base_submission/record?id='.$submission_id);
		$ref = urldecode($ref);
		$param['id'] = $record_id;
		$param['enableStatus'] = $enableStatus;
		$resp = $this->model->write('base_submission','disabled', $param);
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '更改成功' : '更改失败',
			'ref'=> $ref
		));
	}
}