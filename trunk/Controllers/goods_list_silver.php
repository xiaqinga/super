<?php

/**
 * 商品集合模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class goods_list_silver extends common {
		
	/**
	 * 初始化
	 * 
	 */
	 
	public function __construct(){
		parent::__construct();
		$this->helper('from');
		$this->lib('assets');
		$this->lib('Curl','Curl_api');
	}
	
	public function index()
	{
		$this->lib('Pagination','page');

		//每页记录数
		$pagesize = 10;
		$page = $this->queryVar('page', 1);

		//查询
		$goodsCode = $this->queryVar('goodsCode');
		$goodsName = $this->queryVar('goodsName');
		$goodsClassId = $this->queryVar('goodsClassId');
		$providerId = $this->queryVar('providerId');
		$status = $this->queryVar('status');
		$className = $this->queryVar('className');
		$providerName = $this->queryVar('providerName');
		$param = array();
		if(!empty($goodsCode)){
			$param['goodsCode'] = $goodsCode;
		}
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		if(!empty($goodsClassId)){
			$param['goodsClassId'] = $goodsClassId;
		}
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}elseif(!empty($providerId)){
			$param['providerId'] = $providerId;
		}
		if(!empty($status)){
			$param['status'] = $status;
		}
		$param['mallType'] = 2;
		//找子分类
		$childClass = $this->getChildClass($goodsClassId);
		if($childClass){
			$param['childClass'] = $childClass;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

		$resp = $this->model->read('goods_list','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'providerList' => $this->getProviderList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			//传递查询框的值
			'goodsCode' => $goodsCode,
			'goodsName' => $goodsName,
			'goodsClassId' => $goodsClassId,
			'providerId' => $providerId,
			'status' => $status,
			'className' => $className,
			'providerName' => $providerName,
			'accouttype' => $accouttype,
			'ref' => $this->func->curr_url()
		);
		$this->view($data,'goods_list_silver/index');
	}
	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$goodsCode = $this->queryVar('goodsCode');
		$goodsName = $this->queryVar('goodsName');
		$goodsClassId = $this->queryVar('goodsClassId');
		$providerId = $this->queryVar('providerId');
		$status = $this->queryVar('status');
		$className = $this->queryVar('className');
		$providerName = $this->queryVar('providerName');
		$param = array();
		if(!empty($goodsCode)){
			$param['goodsCode'] = $goodsCode;
		}
		if(!empty($goodsName)){
			$param['goodsName'] = $goodsName;
		}
		if(!empty($goodsClassId)){
			$param['goodsClassId'] = $goodsClassId;
		}
		$accouttype = $this->sess->get('accouttype');
		if($accouttype == 2){
			$param['providerId'] = $this->sess->get('enterpriseInfoId');
		}elseif(!empty($providerId)){
			$param['providerId'] = $providerId;
		}
		if(!empty($status)){
			$param['status'] = $status;
		}
		$param['mallType'] = 2;
		//找子分类
		$childClass = $this->getChildClass($goodsClassId);
		if($childClass){
			$param['childClass'] = $childClass;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('goods_list','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			//传递查询框的值
			'goodsCode' => $goodsCode,
			'goodsName' => $goodsName,
			'goodsClassId' => $goodsClassId,
			'providerId' => $providerId,
			'status' => $status,
			'className' => $className,
			'providerName' => $providerName,
			'ref' => $this->queryVar('ref' , APP_URL . 'goods_list_silver/index?goodsCode='.$goodsCode.'&goodsName='.$goodsName.'&goodsClassId='.$goodsClassId.'&providerId='.$providerId.'&status='.$status.'&className='.$className.'&providerName='.$providerName.'&page='.$page)
		);
		$this->setActionLog('goods_list_silver','QUERY','查看银商城商品列表');
		$this->view($data,'goods_list_silver/ajaxindex');
	}

	public function getProviderList(){
		$param['status']=2;
		$param['providerType'] = 1;
		$resp = $this->model->read('base_enterprise_info','getItems',$param);
		$classList[] = '请选择';
		foreach ($resp['data'] as $key => $value) {
			$classList[$value['bid']] = $value['providerName'];
		}
		return $classList;
	}

	//获取当前所有子类ID
	public function getChildClass($id){
		$classList = null;
		$param['id'] = $id;
		$resp = $this->model->read('goods_class','getJson',$param);
		if($resp['status']){
			foreach ($resp['data']['list'] as $key => $value) {
				$classList[] = $value['id'];
			}
		}
		return $classList;
	}

	//导出供应商商品
  function exportOrder(){
		//查询
		$providerId = $this->queryVar('providerId');
	  $param = array();
	  if(!empty($providerId)){
		  $param['providerId'] = $providerId;
		  $param['mallType'] = 2;
	  }else{
		  return false;
	  }

	  $resp = $this->model->read('goods_list','getGoodsByProvider',$param);

	  if(!$resp['status']){
		  echo "还没有相关商品！";
		  return false;
	  }

	  $sep = "\t";
	  $savename = $resp['data']['list']['0']['providerName'].date("YmjHis");
	  $isTurnBackDrop = array(
		  'Y' => '是',
		  'N' => '否'
	  );
	  $statusDrop = array(
		  '0'=>'删除',
		  '1' => '上架',
		  '2' => '下架',
		  '3' => '待审核',
		  '4' => '已驳回'
	  );
	  $file_type = "vnd.ms-excel";
	  $file_ending = "xls";
	  ob_end_clean();
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

	  $th_td[0] = "<td>供应商名称</td>";
	  $th_td[1] = "<td>商品名称</td>";
	  $th_td[2] = "<td>分类</td>";
	  $th_td[3] = "<td>规格</td>";
	  $th_td[4] = "<td>进货价</td>";
	  $th_td[5] = "<td>销售价</td>";
	  $th_td[6] = "<td>退换货支持</td>";
	  $th_td[7] = "<td>是否需要运费</td>";
	  $th_td[8] = "<td>商品状态</td>";

	  echo "<tr>";
	  foreach ($th_td as $key => $value) {
		  echo iconv('utf-8', 'gbk', $value).$sep;
	  }
	  echo "</tr>";

	  foreach ($resp['data']['list'] as $key => $value) {
		  $normsNameIdArr = array();
		  if(!$value['normsValueIds']){
			  continue;
		  }
		  if(strpos($value['normsValueIds'],',')>-1){
			  $normsNameIdArr = explode(",", $value['normsValueIds']);
		  }else{
			  $normsNameIdArr[] = $value['normsValueIds'];
		  }
		  $normsValue = array();
		  foreach ($normsNameIdArr as $k => $v) {
			  $param_value['id'] = abs($v);
			  if($v>0){
				  $resp_value = $this->model->read('goods_norms_name','getNormsNameValue',$param_value);
				  if(!$resp_value['status']) continue 2; //结束了当前内层循环的同时，也结束了当前外层循环，直接进入下一次外层循环
				  ($resp_value['status']) ? $normsValue [] = $resp_value['data']['attr']['normsValue'] : null;
			  }elseif($v<0){
				  $resp_value = $this->model->read('goods_norms_name','getNormsNameAddValue',$param_value);
				  if(!$resp_value['status']) continue 2;
				  ($resp_value['status']) ? $normsValue [] = $resp_value['data']['attr']['normsValue'] : null;
			  }
		  }

		  $head_td[0] = "<td>".$value['providerName']."</td>";
		  $head_td[1] = "<td>".$value['goodsName']."</td>";
		  $head_td[2] = "<td>".$value['className']."</td>";
		  $head_td[3] = "<td>".implode(',', $normsValue)."</td>";
		  $head_td[4] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".number_format($value['restockPrice'], 2)."</td>";
		  $head_td[5] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".number_format($value['preferentialPrice'], 2)."</td>";
		  $head_td[6] = "<td>".$value['isTurnBack']."</td>";
		  $head_td[7] = "<td>".$value['isFreight']."</td>";
		  $head_td[8] = "<td>".$value['status']."</td>";
		  echo "<tr>";
		  foreach ($head_td as $key_ht => $value_ht) {
			  echo iconv('utf-8', 'gbk', $value_ht).$sep;
		  }
		  echo "</tr>";
	  }
	  echo "</table>";
    $this->setActionLog('goods_list_silver','QUERY','导出银商城商品列表');
    return (true);  

  }

	public function edit(){
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['id'] = $id;
			$resp = $this->model->read('goods_list','getlist',$param);

			if($resp['status']){
				$data['attr'] = $resp['data']['list'][0];

				$param['id'] = $data['attr']['providerId'];
				$findref = $this->model->read('base_enterprise_info','findref',$param);
				$param['id'] = $findref['data']['list'][0]['refId'];
				$param['providerType'] = $findref['data']['list'][0]['providerType'];
				$resp = $this->model->read('base_enterprise_info','getItem',$param);
				$data['attr']['providerName'] = $resp['status'] ? $resp['data']['providerName'] : '';

				$param['id'] = $data['attr']['goodsClassId'];
				$param['field'] = 'id, className';
				$resp = $this->model->read('goods_class','getAttr',$param);
				$data['attr']['goodsClassName'] = $resp['status'] ? $resp['data']['className'] : '';

				$param['id'] = $data['attr']['goodsBrandId'];
				$param['field'] = 'id, brandName';
				$resp = $this->model->read('goods_brand','getAttr',$param);
				$data['attr']['goodsBrandName'] = $resp['status'] ? $resp['data']['brandName'] : '';

				$param['id'] = $data['attr']['goodsClassId'];
				$resp = $this->model->read('goods_brand','getGoodsBrandClassId',$param);
				$data['attr']['goodsBrandList'] = $resp['status'] ? $resp['data']['list'] : array();

				$param['id'] = $data['attr']['logisticsCostId'];
				$resp = $this->model->read('logistics','getLogisticsCostList',$param);
				$data['attr']['freightTmplateName'] = $resp['status'] ? $resp['data']['list'][0]['logisticsName'].' / '.$resp['data']['list'][0]['expressCompanyName'].' / '.$resp['data']['list'][0]['sourceSendAddress'] : '';
			}
			$data['id'] = $id;
		}
		$data['ref'] = APP_URL . 'goods_list_silver/photoedit?id='.$id;
		$data['goback'] = APP_URL . 'goods_list_silver/index';
		$this->view($data,'goods_list_silver/edit');
	}

	public function photoEdit()
	{
		$id = $this->queryVar('id');
		if(!empty($id)){
			$param['goodsId'] = $id;
			$resp = $this->model->read('goods_photo','getlist',$param);
			if($resp['status']){
				$data['thumb_photos'][0] = $resp['data']['list'][0];
				$data['thumb_photos_val'] = $data['thumb_photos']['photoPath'];
				unset($resp['data']['list'][0]);
				$data['main_photos'] = $resp['data']['list'];
				if(count($data['main_photos'])>1){
					foreach ($data['main_photos'] as $key => $value) {
						$photoPath_arr[] = $value['photoPath'];
					}
					$data['main_photos_val'] = implode('||', $photoPath_arr);
				}else{
					$data['main_photos_val'] = $photoPath_arr[0];
				}
			}
			$data['id'] = $id;
		}
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_list_silver/index');
		$this->view($data,'goods_list_silver/photoedit');
	}

	public function normsEdit()
	{
		$id = $this->queryVar('id');
		$resp = $this->model->read('goods_norms_name','getlist');
		if($resp['status']){
			$data['normslist'] = $resp['data']['list'];
		}
		$data['id'] = $id;
		$data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_list_silver/index');
		$this->view($data,'goods_list_silver/normsedit');
	}

	public function save(){
		$id = $this->queryVar('id');
		$providerCode = $this->queryVar('providerCode');
		$param['providerId'] = $this->queryVar('providerId');
		$param['goodsClassId'] = $this->queryVar('goodsClassId',0);
		$param['goodsName'] = $this->queryVar('goodsName');
		$param['goodsBrandId'] = $this->queryVar('goodsBrandId',0);
		$param['intro'] = $this->queryVar('intro');
		$param['goodsAttribute'] = $this->queryVar('goodsAttribute');
		$param['description'] = $this->queryVar('description');
		$param['isTurnBack'] = $this->queryVar('isTurnBack');
		$param['isFreight'] = $this->queryVar('isFreight');
		$param['logisticsCostId'] = $this->queryVar('freightTmplateId',0);
		$param['sendAddress'] = $this->queryVar('sendAddress');
		$param['status'] = $this->queryVar('status',1);
		$param['goodsCode'] = $this->queryVar('goodsCode');
		$param['mallType'] = 2;
		//返回URL
		$ref = $this->queryVar('ref',APP_URL . 'goods_list_silver/index');
		$ref = urldecode($ref);
		

		if(!$id)
		{
			// $numbers = range (1,9); //数组
			// shuffle ($numbers); //打散
			// $numbers_result = array_slice($numbers,3,3); //截取3个
			// $numbers_join = implode('',$numbers_result); //截取的数组连成字符
			// $param['goodsCode'] = $providerCode.$numbers_join;

			// $code = $this->model->read('goods_list','findGoodsCode',$param['goodsCode']);
			// while ($code['status']) {
			// 	$numbers = range (1,9); //数组
			// 	shuffle ($numbers); //打散
			// 	$numbers_result = array_slice($numbers,3,3); //截取3个
			// 	$numbers_join = implode('',$numbers_result); //截取的数组连成字符
			// 	$param['goodsCode'] = $providerCode.$numbers_join;
			// 	$code = $this->model->read('goods_list','findGoodsCode',$param['goodsCode']);
			// }
			$param['createUser'] = $this->sess->get('id');
			$param['createDate'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goods_list','create', $param);
			$id=$resp['data']['id'];
			$ref =  APP_URL . 'goods_list_silver/photoedit?id='.$resp['data']['id'];
			$opt  = '添加';
			$id = $resp['data']['id'];
			$this->setActionLog('goods_list_silver','SAVE','添加银商城商品');
		}
		else
		{
			$param['id'] = $id;
			$param['updateUser'] = $this->sess->get('id');
			$param['updateTime'] = date('Y-m-d H:i:s');
			$resp = $this->model->write('goods_list','update', $param);
			$opt  = '修改';
			$ref =  APP_URL . 'goods_list_silver/photoedit?id='.$id;
			$this->setActionLog('goods_list_silver','UPDATE','修改银商城商品');
		}

		//新增/修改商品搜索引擎
		try{
			if($resp['status']){
	      $url = SCHOOLAPI."goods/insertsearchengine";
	      $url = $url.'?goodsType=1&identifier=COMMON_GOODS&value='.$id;
	      $res = $this->Curl_api->https_request($url);
			}
		}catch(Exception $e){}

		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品基本信息'.$opt.'成功' : '商品基本信息没变化',
			'ref'=> $ref
		));
	}

	public function photoSave(){
		$id = $this->queryVar('id');
		//返回URL
		$ref = $this->queryVar('ref',APP_URL . 'goods_list/index');
		$ref = urldecode($ref);
		$thumb_photos = $this->queryVar('thumb_photos');
		$main_photos = $this->queryVar('main_photos');
		$thumb_photos = json_decode($thumb_photos,true);
		$main_photos = json_decode($main_photos,true);
		$ok = false;
		/*var_dump($thumb_photos);
		var_dump($main_photos);
		exit;*/
		if($id){
			//添加/更新商品列表图
			if(count($thumb_photos)>0){
				if(!$thumb_photos[0]['id']){
					$param = array(
						'photoName' => $thumb_photos[0]['photoName'], 
						'photoPath' => $thumb_photos[0]['photoPath'], 
						'goodsId' => $thumb_photos[0]['goodsId'], 
						'displayOrder' => $thumb_photos[0]['displayOrder'], 
					);
				
					$resp = $this->model->write('goods_photo','create', $param);
					if($resp['status']){$ok = true;}
					$this->setActionLog('goods_list_silver','SAVE','添加银商城商品列表图');
				}else{
					//更新
					$param = array(
						'id' => $thumb_photos[0]['id'],
						'photoName' => $thumb_photos[0]['photoName'], 
						'photoPath' => $thumb_photos[0]['photoPath'],
						'goodsId' => $thumb_photos[0]['goodsId'],
						'displayOrder' => $thumb_photos[0]['displayOrder'],
						'status' => $thumb_photos[0]['status'], 
					);
					$resp = $this->model->write('goods_photo','update', $param);
					if($resp['status']){$ok = true;}
					$this->setActionLog('goods_list_silver','SAVE','更新银商城商品列表图');
				}
			}
			//添加/更新商品轮廓图
			if(count($main_photos)>0){
				foreach ($main_photos as $key => $value) {
					if(!$value['id']){
						$param = array(
							'photoName' => $value['photoName'], 
							'photoPath' => $value['photoPath'], 
							'goodsId' => $value['goodsId'], 
							'displayOrder' => $value['displayOrder'], 
						);
						$resp = $this->model->write('goods_photo','create', $param);
						if($resp['status']){$ok = true;}
						$this->setActionLog('goods_list_silver','SAVE','添加银商城商品轮播图');
					}else{
						//更新
						$param = array(
							'id' => $value['id'],
							'photoName' => $value['photoName'], 
							'photoPath' => $value['photoPath'], 
							'goodsId' => $value['goodsId'], 
							'displayOrder' => $value['displayOrder'], 
							'status' => $value['status'],  
						);
						$resp = $this->model->write('goods_photo','update', $param);
						if($resp['status']){$ok = true;}
						$this->setActionLog('goods_list_silver','UPDATE','更新银商城商品轮播图');
					}
				}
			}

			$opt  = '保存';
		}

		//新增/修改商品搜索引擎
		try{
			if($ok){
				$url = SCHOOLAPI."goods/insertsearchengine";
	      $url = $url.'?goodsType=1&identifier=COMMON_GOODS&value='.$id;
	      $res = $this->Curl_api->https_request($url);
			}
		}catch(Exception $e){}

		$this->jsonout($ok,array(
			'msg'=>$ok ? '图片参数'.$opt.'成功' : '图片参数没变化',
			'ref'=> $ref
		));
	}
	
	public function delete(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_list_silver/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_list','delete', $param);
		//删除商品搜索引擎
		try{
			if($resp['status']){
				
	      $url = SCHOOLAPI."goods/deletesearchengine";
	      $url = $url.'?identifier=COMMON_GOODS&ids='.$id;
	      $res = $this->Curl_api->https_request($url);
			}
		}catch(Exception $e){}
		$this->setActionLog('goods_list_silver','DELETE','删除银商城商品');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品删除成功' : '商品删除失败',
			'ref'=> $ref
		));
	}

	public function upstore(){
		$id = $this->queryVar('ids');
		$data = explode(',',$id);
		$ref = $this->queryVar('ref',APP_URL . 'goods_list_silver/index');
		$ref = urldecode($ref);
		if($data[1]){
			$param['id'] = $id;
			$resp = $this->model->write('goods_list','upstore', $param);
			//新增/修改商品搜索引擎
			try{
				if($resp['status']){
					$url = SCHOOLAPI."goods/insertsearchengine";
		      		$url = $url.'?goodsType=1&identifier=COMMON_GOODS&value='.$id;
		      		$res = $this->Curl_api->https_request($url);
				}
			}catch(Exception $e){}

			$this->setActionLog('goods_list_silver','UPDATE','更改银商城商品状态');
			$this->jsonout($resp['status'],array(
				'msg'=>($resp['status']) ? '商品上架成功' : '商品上架失败',
				'ref'=> $ref
			));
		}else{
			$this->jsonout($resp['status'],array(
				'msg'=>($resp['status']) ? '商品上架成功' : '请填写商品编号',
				'ref'=> $ref
			));
		}
		
	}

	public function downstore(){
		$id = $this->queryVar('ids');
		$ref = $this->queryVar('ref',APP_URL . 'goods_list_silver/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$resp = $this->model->write('goods_list','downstore', $param);
		//删除商品搜索引擎
		try{
			if($resp['status']){
				$url = SCHOOLAPI."goods/deletesearchengine";
	      		$url = $url.'?identifier=COMMON_GOODS&ids='.$id;
	      		$res = $this->Curl_api->https_request($url);
			}
		}catch(Exception $e){}
		$this->setActionLog('goods_list_silver','UPDATE','更改银商城商品状态');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '商品下架成功' : '商品下架失败',
			'ref'=> $ref
		));
	}

	public function photoDelete(){
		$id = $this->queryVar('id');
		$goodsId = $this->queryVar('goodsId');
		$ref = $this->queryVar('ref',APP_URL . 'goods_list/index');
		$ref = urldecode($ref);
		$param['id'] = $id;
		$param['goodsId'] = $goodsId;
		$resp = $this->model->write('goods_photo','delete', $param);
		$this->setActionLog('goods_list_silver','DELETE','删除银商城商品图片');
		$this->jsonout($resp['status'],array(
			'status'=> 1,
			'msg'=>'图片删除成功',
			'ref'=> $ref
		));
	}

	/**
	 * 编辑时获取组合的商品
	 *
	 */
	public function getpartgoods(){

			//初始化
			$sizesitems = array();

	    //查询条件
	    $items              = array(
	        'goodsId' => $this->queryVar('goodsId')
	    );
	    //获取规格组合商品列表
	    $dataitems     = $this->model->read('goods_norms_name','getGoodsNormsValueStock', $items);
	    $data['items'] = $dataitems['data']['list'];
	    $counts = count($data['items']);
			if($counts > 0){
				foreach ($data['items'] as $key => $value) {
					if($value['normsValueIds']){
						$normsValueIds = explode(',', $value['normsValueIds']);

						$param_v = array('id'=> abs($normsValueIds[0]));
						if($normsValueIds[0] > 0){
							$norms_value['a'] = $this->model->read('goods_norms_name', 'getNormsValue',$param_v);
							$a_add = 0; 
						}else if($normsValueIds[0] < 0){
							$norms_value['a'] = $this->model->read('goods_norms_name', 'getNormsAddValue',$param_v);
							$a_add = 1; //商品添加的规格 标记
						}

						$param_v = array('id'=> abs($normsValueIds[1]));
						if($normsValueIds[1] > 0){
							$norms_value['b'] = $this->model->read('goods_norms_name', 'getNormsValue', $param_v);
							$b_add = 0;
						}else if($normsValueIds[1] < 0){
							$norms_value['b'] = $this->model->read('goods_norms_name', 'getNormsAddValue', $param_v);
							$b_add = 1; //商品添加的规格 标记
						}

						if($norms_value['a']['status']){

							//把规格A属性(id,normsValue,)存入到$data['items']商品组合记录中
							$data['items'][$key]['normsValueA'] = $norms_value['a']['data']['normsValue'];
							$data['items'][$key]['normsValueAId'] = $norms_value['a']['data']['id'];
							$data['items'][$key]['normsvalue_a_add'] = $a_add;
							$data['items'][$key]['normsValueAOrder'] = $norms_value['a']['data']['displayOrder'] ? $norms_value['a']['data']['displayOrder']: 0;

							//获取规格A的ID和名称
							$param_v = array('id'=> $norms_value['a']['data']['normsId']);
							$norms['a'] = $this->model->read('goods_norms_name', 'getNorms',$param_v);
							if($norms['a']['status']){
								$sizesitems['titleA'] = array(
									'id' => $norms['a']['data']['id'], 
									'name' => $norms['a']['data']['normsName'], 
								);
							}

							//获取A所有规格值, 在这个循环中,第一次才执行
							$param_v = array('normsId'=> $norms_value['a']['data']['normsId']);
							$allNormsValue['a'] = $this->model->read('goods_norms_name', 'getAllNormsValue',$param_v);
							if($key== 0){
								if($allNormsValue['a']['status']){
									foreach ($allNormsValue['a']['data']['list'] as $k => $v) {
										$sizesitems['sizesA'][$v['id']] = array(
											'id' => $v['id'], 
											'value' => $v['normsValue'], 
											'order' => $v['displayOrder'], 
											'chk' => 0,
											'add' => 0
										);
									}
								}
							}

							if($normsValueIds[0] > 0){
								//当前已选的标准规格值,覆盖已经有的
								$d2 = $norms_value['a']['data']['id'];
								$sizesitems['sizesA'][$d2] = array(
									'id' => $norms_value['a']['data']['id'], 
									'value' => $norms_value['a']['data']['normsValue'], 
									'order' => $norms_value['a']['data']['displayOrder'], 
									'chk' => 1,
									'add' => 0
								);
								//var_dump($d2);
							}

							if($normsValueIds[0] < 0){
								//当前已选的添加规格值,排序在所有规格值后面
								$d2 = 'add_'.$norms_value['a']['data']['id'];
								$sizesitems['sizesA'][$d2] = array(
									'id' => -$norms_value['a']['data']['id'],
									'value' => $norms_value['a']['data']['normsValue'], 
									'order' => 0, 
									'chk' => 1,
									'add' => 1
								);
							}

						}
						if($norms_value['b']['status']){

							//把规格B属性(id,normsValue,)存入到$data['items']商品组合记录中
							$data['items'][$key]['normsValueB'] = $norms_value['b']['data']['normsValue'];
							$data['items'][$key]['normsValueBId'] = $norms_value['b']['data']['id'];
							$data['items'][$key]['normsvalue_b_add'] = $b_add;
							$data['items'][$key]['normsValueBOrder'] = $norms_value['b']['data']['displayOrder'] ? $norms_value['b']['data']['displayOrder']: 0;

							//获取规格B的ID和名称
							$param_v = array('id'=> $norms_value['b']['data']['normsId']);
							$norms['b'] = $this->model->read('goods_norms_name', 'getNorms',$param_v);
							if($norms['b']['status']){
								$sizesitems['titleB'] = array(
									'id' => $norms['b']['data']['id'], 
									'name' => $norms['b']['data']['normsName'], 
								);
							}


							//获取B所有规格值
							$param_v = array('normsId'=> $norms_value['b']['data']['normsId']);
							$allNormsValue['b'] = $this->model->read('goods_norms_name', 'getAllNormsValue',$param_v);
							if($key== 0){
								if($allNormsValue['b']['status']){
									foreach ($allNormsValue['b']['data']['list'] as $k => $v) {
										$sizesitems['sizesB'][$v['id']] = array(
											'id' => $v['id'], 
											'value' => $v['normsValue'], 
											'order' => $v['displayOrder'], 
											'chk' => 0,
											'add' => 0
										);
									}
								}
							}

							if($normsValueIds[1] > 0){
								//当前已选的标准规格值,覆盖已经有的
								$d2 = $norms_value['b']['data']['id'];
								$sizesitems['sizesB'][$d2] = array(
									'id' => $norms_value['b']['data']['id'], 
									'value' => $norms_value['b']['data']['normsValue'], 
									'order' => $norms_value['b']['data']['displayOrder'], 
									'chk' => 1,
									'add' => 0
								);
							}

							if($normsValueIds[1] < 0){
								//当前已选的添加规格值,排序在所有规格值后面
								$d2 = 'add_'.$norms_value['b']['data']['id'];
								$sizesitems['sizesB'][$d2] = array(
									'id' => -$norms_value['b']['data']['id'],
									'value' => $norms_value['b']['data']['normsValue'], 
									'order' => 0, 
									'chk' => 1,
									'add' => 1
								);
							}

						}
						
					}
				}
			}

			//获取规格值和规格标题

			//--->规格值和规格标题组合, 这是输出的例子
			/*$sizesitems = array(
				'titleA' => array(
					'id' => 1,
					'name' => '手机品牌', 
				), 
				'titleB' => array(
					'id' => 2,
					'name' => '手机颜色', 
				), 
				'sizesA' => array(
					0 => array(
						'id' => 1, 
						'value' => '联想',
						'order' => '1',
						'chk' => 1,
						'add' => 0
					), 
					1 => array(
						'id' => 2, 
						'value' => '七喜',
						'order' => '1',
						'chk' => 1, //已选的
						'add' => 1  //跟商品添加的
					), 
				),
				'sizesB' => array(
					0 => array(
						'id' => 1, 
						'value' => '金色',
						'order' => '1',
						'chk' => 1,
						'add' => 0
					), 
					1 => array(
						'id' => 1, 
						'value' => '黑色',
						'order' => '1',
						'chk' => 1,
						'add' => 1
					), 
				),
			);*/
			//<---例子结束
	    $data['sizesitems'] = $sizesitems;
	    $data['controller'] = $this;
	    $data['discount'] = $this->getSelectDiscount();
	    $this->view($data, 'goods_list_silver/partgoods'); //输出
	}

	public function getSelectDiscount(){
		$array = array(
			'6' => '6',
			'6.5' => '6.5',
			'7' => '7',
			'7.5' => '7.5',
			'8' => '8',
			'8.5' => '8.5',
			'9' => '9',
			'9.5' => '9.5',
			'10' => '10'
		);
		return $array;
	}

  //点击规格, 获取规格值
  public function sizeAttr(){
      //获取显示的结果
      $items['id'] = $this->queryVar('id');
      $dataClassitems = $this->model->read('goods_norms_name','getlist',$items);
      $classitems = $dataClassitems['data']['list'][0]['normsValueList'];
      if(count($classitems)>0){
          foreach ($classitems as $key => $val) {
              $m['id'] = $val['id'];
              $m['value'] = $this->strFilter($val['normsValue']);
              $m['order'] = $val['displayOrder'];
              $classTypes[$key+1] = $m;
          }
      }else{
           /* $m['id'] = 0;
            $m['value'] = '默认值';
            $m['order'] = 1;
          $classTypes[0] = $m;*/
      }
      echo json_encode((Object)$classTypes);
      exit;
  }

  //保存商品自定义规格
  public function savesize(){
      $items['goods_id'] = $this->queryVar('goods_id');
	  $items['normsaId'] =  $this->queryVar('normsaId');
	  $items['normsbId'] =  $this->queryVar('normsbId');
      $items['f_vals'] = $this->queryVar('f_vals');
      $items['s_vals'] = $this->queryVar('s_vals');
      $dataitem = $this->model->write('goods_list','savesize', $items);
      $ret      = $dataitem['status'];
      $this->setActionLog('goods_list_silver','SAVE','添加银商城商品规格');
      if ($ret)
      {
          $data['msg'] = true;
      }
      else
      {
          $data['msg'] = false;
      }
      echo json_encode($data);
      exit;
  }

  //保存组合商品
  public function savesizegoods(){
      $items['delpartids'] = $this->queryVar('delpartids');
      $items['postsizes'] = $this->queryVar('postsizes');
      $items['goodsId'] = $this->queryVar('id');

			$dataitem = $this->model->write('goods_list','savesizegoods', $items);
			
      $ret      = $dataitem['status'];
      $this->setActionLog('goods_list_silver','SAVE','添加银商城商品组合商品');
      if ($ret)
      {
          $data['msg'] = true;
					//新增/修改商品搜索引擎
					try{
						$url = SCHOOLAPI."goods/insertsearchengine";
	      				$url = $url.'?goodsType=1&identifier=COMMON_GOODS&value='.$items['goodsId'];
	      				$res = $this->Curl_api->https_request($url);
			      		
		      }catch(Exception $e){}
      }
      else
      {
          $data['msg'] = false;
      }
      echo json_encode($data);
      exit;
  }

  	public function sync_goods(){
	  	$url = SYNC_TSH;
	  	try{
	      		$res = $this->Curl_api->https_request($url);
			}catch(Exception $e){}
	}
}