<?php

/**
 * 转账管理
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class transfer extends common {
		
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

		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');
		//查询
		$param = array();

		if(!empty($key_type)&&!empty($key)){
			switch ($key_type){
				case 'accout':$param['accout'] = $key;
					break;
				case 'realName':$param['realName'] = $key;
					break;
				case 'bankBranchName':$param['bankBranchName'] = $key;
					break;
			}

		}
		$transferStatus = $this->queryVar('transferStatus',1);
        if($transferStatus==1){
			$param['fromType'] = 1;
		}
		$param['transferStatus'] = $transferStatus;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

        
		$resp = $this->model->read('transfer','getlist',$param);
      
		$total = ($resp['status']) ? $resp['data']['total'] : 0;

		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' =>$key_type,
			'transferStatus' => $transferStatus,
			'key' =>$key,
			'transferType'=>$this->public_dict['transferType'],
			'ref' => APP_URL . 'transfer/index?transferStatus='.$transferStatus.'&key_type='.$key_type.'&key='.$key.'&page='.$page
		);

		$this->view($data,'transfer/index');

	}

	
	public function ajaxIndex(){

		//每页记录数
		$pagesize = $this->queryVar('pagesize', 10);
		$page = $this->queryVar('page', 1);
		//查询
		$key_type = $this->queryVar('key_type');
		$key = $this->queryVar('key');

		$param = array();
		if(!empty($key_type)&&!empty($key)){
			switch ($key_type){
				case 'accout':$param['accout'] = $key;
					break;
				case 'realName':$param['realName'] = $key;
					break;
				case 'bankBranchName':$param['bankBranchName'] = $key;
					break;
			}

		}
		$transferStatus = $this->queryVar('transferStatus',1);
		if($transferStatus==1){
			$param['fromType'] = 1;
		}
		$param['transferStatus'] = $transferStatus;
		$param['providerType'] =1;
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('transfer','getlist',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' =>$key_type,
			'key' =>$key,
			'transferStatus'=>$transferStatus,
			'ref' => $this->queryVar('ref' , APP_URL . 'transfer/index?transferStatus='.$transferStatus.'&key_type='.$key_type.'&key='.$key.'&page='.$page)
		);


		$this->setActionLog('transfer','QUERY','查询转账管理列表');
		$this->view($data,'transfer/ajaxindex');
	}

	//导出商品订单
	function exportOrder(){

		$param = array();
		//右边查询
		$transferStatus = $this->queryVar('transferStatus');
		$providerId = $this->queryVar('providerId');
		$startDate = $this->queryVar('chkStartDate');
		$endDate = $this->queryVar('chkEndDate');
        $transferBatchCode=$this->queryVar('transferBatchCode');


		if(!empty($transferStatus)){
			$param['transferStatus'] = $transferStatus;
		}

		if(!empty($startDate) || !empty($endDate)){
			$param['startDate'] = $startDate;
			$param['endDate'] = $endDate;
		}

		//左边查询
		$accout = $this->queryVar('accout');
		$realName = $this->queryVar('realName');
		$bankName = $this->queryVar('bankName');
		if(!empty($ordersNo)){
			$param['accout'] = $accout;
		}

		if(!empty($realName)){
			$param['realName'] = $realName;
		}
		if(!empty($bankName)){
			$param['bankBranchName'] = $bankName;
		}

		if(1==$transferStatus||4==$transferStatus){
			if(1==$transferStatus){
				$param['fromType']=1;
			}elseif(4==$transferStatus){
				$param['bindType']=2;
			}

			switch ($providerId){
				case '1':$param['providerId'] = $providerId;
					$resp = $this->model->read('transfer','getEnterpriseList',$param);
					$transferBatchCode=$this->getTransferBatchCode();
					if($resp['status']){
						$this->setTransferStatus($resp['data']['list'],1,$transferBatchCode);
					}
					break;
				case '2':$param['providerId'] = $providerId;
					$resp = $this->model->read('transfer','getEnterpriseList',$param);

					$transferBatchCode=$this->getTransferBatchCode();
					if($resp['status']){
						$this->setTransferStatus($resp['data']['list'],1,$transferBatchCode);
					}
					break;
				case '3':$resp = $this->model->read('transfer','getCustomerList',$param);
					$transferBatchCode=$this->getTransferBatchCode();
					if($resp['status']){
						$this->setTransferStatus($resp['data']['list'],2,$transferBatchCode);
					}
					break;

				default:
					$transferBatchCode=$this->getTransferBatchCode();
					$resp = $this->getAllList($param,$transferBatchCode);

			}
		}elseif (2==$transferStatus){

			$param['transferBatchCode']=$transferBatchCode;

			$resp = $this->model->read('transfer','getlist',$param);



		}




		
		if(!$resp['status']){
			echo "还没有相关帐单信息！";
			return false;
		}
		$data=$this->getProvinceCity($resp['data']['list']);


		$sep = "\t";
		switch ($transferStatus){
			case 1:
				$savename = '待转账列表'.date("YmjHis");
				break;

			case 2:
				$savename = '转账中列表'.date("YmjHis");
				break;

			case 3:
				$savename = '转账完成列表'.date("YmjHis");
				break;
			case 4 :
				$savename = '转账失败列表'.date("YmjHis");
				break;

			default:
				$savename = '全部订单列表'.date("YmjHis");
				break;
		}
		$file_type = "vnd.ms-excel";
		$file_ending = "xls";
		ob_end_clean();
		header("Content-Type: application/$file_type;charset=gbk");
		header("Content-Disposition: attachment; filename=\"$savename.$file_ending\"");
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





		$th_td[0] = "<td>付方帐号</td>";
		$th_td[1] = "<td>金额上限</td>";
		$th_td[2] = "<td>生效日期</td>";
		$th_td[3] = "<td>失效日期</td>";
		$th_td[4] = "<td>支票权限</td>";
		$th_td[5] = "<td>授权使用人</td>";
		$th_td[6] = "<td>收方信息填写类型</td>";
		$th_td[7] = "<td>收方帐号</td>";
		$th_td[8] = "<td>收方户名</td>";
		$th_td[9] = "<td>汇路类型</td>";
		$th_td[10] = "<td>收方行名称</td>";
		$th_td[11] = "<td>收方行行号</td>";
		$th_td[12] = "<td>收方支行</td>";
		$th_td[13] = "<td>收方行地址</td>";
		$th_td[14] = "<td>附言</td>";
		$th_td[15] = "<td>收款人手机号码</td>";
		$th_td[16] = "<td>转帐批次号</td>";
		$th_td[17] = "<td>订单号</td>";



		echo "<tr>";
		foreach ($th_td as $key => $value) {
			echo iconv('utf-8', 'gbk', $value).$sep;
		}
		echo "</tr>";

        $info_type=$this->public_dict['info_type'];
		foreach ($data as $key => $value) {


			$head_td[0] = "<td style=\"vnd.ms-excel.numberformat:@\">755927637010603</td>";
			$head_td[1] =  "<td style=\"vnd.ms-excel.numberformat:#,##0.00\">".$value['money']."</td>";
			$head_td[2] = "<td style=\"vnd.ms-excel.numberformat:yyyy-mm-dd\"></td>";
			$head_td[3] = "<td style=\"vnd.ms-excel.numberformat:yyyy-mm-dd\"></td>";
			$head_td[4] ="<td>可支付、不可转让</td>";
			$head_td[5] =  "<td>赵淑敏1</td>";
			$head_td[6] =  "<td>预先录入(支付时不可修改)</td>";
			$head_td[7] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['bankCodeNo']."</td>";
			$head_td[8] = "<td>".$value['bankBindUserName']."</td>";
			$type=($value['bankName']=='招商银行')?:'他行普通';
			$head_td[9] = "<td>".$type."</td>";
			$head_td[10] = "<td>".$value['bankName']."</td>";
			$head_td[11] = "<td></td>";
			$head_td[12] = "<td>".$value['bankBranchName']."</td>";
			$head_td[13] = "<td>".$value['provinceName'].$value['cityName']."</td>";
			$head_td[14] = "<td>".$info_type[$value['infotype']]."</td>";
			$head_td[15] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['mobilePhone']."</td>";
			if(1==$transferStatus||4==$transferStatus){
				$value['transferBatchCode']=$transferBatchCode;
			}
			$head_td[16] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['transferBatchCode']."</td>";
			$head_td[17] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['emsNo']."</td>";



			echo "<tr>";
			foreach ($head_td as $key_ht => $value_ht) {
				echo iconv('utf-8', 'gbk', $value_ht).$sep;
			}
			echo "</tr>";
		}
		echo "</table>";
		$this->setActionLog('transfer','QUERY','导出'.$savename.'账单');
		return (true);
	}

	public function getAllList($param,$transferBatchCode)
	{

		$resp = $this->model->read('transfer','getEnterpriseList',$param);



		if($resp['status']){
		$this->setTransferStatus($resp['data']['list'],1,$transferBatchCode);
			$data=$resp['data']['list'];
		}

		$respp =$this->model->read('transfer','getCustomerList',$param);



		if($respp['status']){
			$this->setTransferStatus($respp['data']['list'],2,$transferBatchCode);

			if(!empty($data)){
				foreach ($respp['data']['list'] as $key=>$value){
					$data[]=$value;
				}
			}else{
				$data=$respp['data']['list'];
			}

		}


        if(!empty($data)){
			$arr=[
				'status'=>1,
				'data'=>[
					'list'=>$data
				     ]
			];
		}else{
			$arr=[
				'status'=>0
			];
		}


		return $arr;
    }

	public function setTransferStatus($data,$type,$transferBatchCode){
		$ids=get_parameter_set('id',$data);
		$uparam=[
			'ids'=>$ids,
			'type'=>$type,
			'transferBatchCode'=>$transferBatchCode,
		];
		$this->model->write('transfer','setTransferStatus',$uparam);
	}

	public function  getProvinceCity($data){


		foreach ($data as $key=>&$value){
			$CityList=$this->model->read('transfer','getCityList',['bankAreaCode'=>$value['bankAreaCode']]);

			$value['cityName']=$CityList['name']?(strpos($CityList['name'],'市')?$CityList['name']:$CityList['name'].'市'):'';

			$provinceName=$this->model->read('transfer','getProvinceName',['provinceCode'=>$CityList['provinceCode']]);
			$value['provinceName']=  $provinceName?$provinceName.'省':'';
		}
		
		return $data;
	}
    public function setTransferStatusByCode(){
		$transferBatchCode = $this->queryVar('transferBatchCode');

		$param['transferBatchCode'] = $transferBatchCode;
		$resp = $this->model->write('transfer','setTransferStatusByCode', $param);
		$this->setActionLog('transfer','WRITE','确认到账');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '确认到账成功' : '确认到账失败',
		));


	}
	public  function  setTransferStatusByID(){
		
		$infotype= $this->queryVar('infotype');
		$failureCause=$this->queryVar('failureCause');
		$id= $this->queryVar('id');
		$param=[
		    'id'=>$id,
		    'transferStatus'=>4,
			'failureCause'=>$failureCause,
			'type'=>($infotype==3)?2:1
		];
		$resp = $this->model->write('transfer','setTransferStatusById', $param);
		$this->setActionLog('transfer','WRITE','到账失败');
		$this->jsonout($resp['status'],array(
			'msg'=>($resp['status']) ? '修改成功' : '修改失败',
			'ref' => $this->queryVar('ref' , APP_URL . 'transfer/index?transferStatus=2')
		
		));
	}

	private  function getTransferBatchCode(){
		return date('YmdHis',time()).time();
	}

	public  function failure(){
		$data=[
			'infotype'=>$this->queryVar('infotype'),
			'id'=>$this->queryVar('id'),
		];
		$this->view($data,'transfer/failure');

	}

}

