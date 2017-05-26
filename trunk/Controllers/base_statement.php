<?php

/**
 * 对账管理
 *
 */
 
class base_statement extends common {
		
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
		// echo '进入 ';die();
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
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['providerType']=$this->queryVar('providerType',1);
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

		$resp = $this->model->read('base_statement','getlist',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		// var_dump($resp);exit();
		$data  = array(
			'providerList'=>$this->getProviderList(),
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'providerType'=>$param['providerType'],
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
    	$this->setActionLog('base_statement','QUERY','查看对账列表');
		$this->view($data,'base_statement/index');
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
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['providerType']= $this->queryVar('providerType');
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$resp = $this->model->read('base_statement','getlist',$param);
		// $resp_list = $resp['status'] ? $resp['data']['list'] : [];
		
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'mallTypes'=>$this->public_dict['mallTypes'],
			'ref' => $this->queryVar('ref' , APP_URL . 'base_statement/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_statement/ajaxindex');
	}

	public function statistic(){
		// echo '进入 ';die();
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
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['providerType']=$this->queryVar('providerType',1);
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
       
		$resp = $this->model->read('base_statement','countOrder',$param);
		// var_dump($resp);die();
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		// var_dump($resp);exit();
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'pageindex' => $page,
			'providerType'=>$param['providerType'],
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
    	$this->setActionLog('base_statement','QUERY','查看对账统计列表');
		$this->view($data,'base_statement/statistic');
	}

	public function ajaxstatistic(){
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
		if(!empty($key)){
			$param['key'] = $key;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
		$param['providerType']= $this->queryVar('providerType');
		$resp = $this->model->read('base_statement','countOrder',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_statement/statistic?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_statement/ajaxstatistic');
	}

	public function fund(){
		// echo '进入 ';die();
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
		if(!empty($key)){
			$param['key'] = $key;
		}
		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;

		$countResp=$this->model->read('base_statement','getFundMoneyCount');
		$resp = $this->model->read('base_statement','getFundList',$param);
		$total = ($resp['status']) ? $resp['data']['total'] : 0;
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'total' => $total,
			'moneyCount'=>($countResp['status']) ? $countResp['data'] : array(),
			'pageindex' => $page,
			'providerType'=>$param['providerType'],
			'page' => $this->page->page($total,$pagesize),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->func->curr_url()
		);
		
		$this->setActionLog('base_statement','QUERY','查看对账统计列表');
		$this->view($data,'base_statement/fund');
	}

	public function ajaxfund(){
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
		if(!empty($key)){
			$param['key'] = $key;
		}

		$param['limit'] = ($page-1)*$pagesize.','.$pagesize;
	
		$resp = $this->model->read('base_statement','getFundList',$param);
		$data  = array(
			'list' => ($resp['status']) ? $resp['data']['list'] : array(),
			'key_type' => $key_type,
			'key' => $key,
			'ref' => $this->queryVar('ref' , APP_URL . 'base_statement/fund?key_type='.$key_type.'&key='.$key.'&page='.$page)
		);
		$this->view($data,'base_statement/ajaxfund');
	}
	
	
	public function exportOrder(){
		$param = array();
		$status = $this->queryVar('status');
		$providerName = $this->queryVar('providerName');
		$startDate = $this->queryVar('chkStartDate');
		$endDate = $this->queryVar('chkEndDate');
		$param['providerType']= $this->queryVar('providerType');
		// var_dump($param['providerType']);die();
		if(!empty($status)){
			$param['status'] = $status;
		}
		if(!empty($providerName)){
			$param['providerName'] = $providerName;
		}
		if(!empty($startDate) || !empty($endDate)){
			$param['startDate'] = $startDate;
			$param['endDate'] = $endDate;
		}

		$resp = $this->model->read('base_statement','exportOrders',$param);
		// var_dump($resp);exit;
		if(!$resp['status']){
			echo "还没有相关订单！";
			return false;
		}
		ob_end_clean();
    $sep = "\t"; 
    $savename = '对账管理列表'.date("YmjHis");  
    	
    // $malltypes = $this->public_dict['malltypes'];
    $paymode = array(
    	'1' => '银行卡支付',
    	'5' => '支付宝支付'
    );
    $file_type = "vnd.ms-excel";  
    $file_ending = "xls";  
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

    $th_td[0] = "<td>订单号</td>";
    $th_td[1] = "<td>供应商名称</td>";
    $th_td[2] = "<td>消费金额</td>";
    $th_td[3] = "<td>收入手续费</td>";
    $th_td[4] = "<td>结算金额</td>";
    $th_td[5] = "<td>支出手续费</td>";
    $th_td[6] = "<td>提款方式</td>";
    $th_td[7] = "<td>完成时间</td>";

		echo "<tr>";
    foreach ($th_td as $key => $value) {
       echo iconv('utf-8', 'gbk', $value).$sep;
    }
    echo "</tr>";

    foreach ($resp['data'] as $key => $value) {
    		
        $head_td[0] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['ordersNo']."</td>";
        $head_td[1] = "<td>".$value['providerName']."</td>";
        $head_td[2] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['turnover']."</td>";
        $head_td[3] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['turnover']*0.006."</td>";
        $head_td[4] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['inCome']."</td>";
        $head_td[5] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['inCome']*0.006."</td>";
        $head_td[6] = "<td>".$paymode[$value['fromType']]."</td>";
        $head_td[7] = "<td>".$value['createDate']."</td>";
        
        echo "<tr>";
        foreach ($head_td as $key_ht => $value_ht) {
           echo iconv('utf-8', 'gbk', $value_ht).$sep;
        }
        echo "</tr>";
    }
    echo "</table>";
    
    return (true);  

  }
  	public function exportOrderCount(){
		$param['providerType']= $this->queryVar('providerType');
		$resp = $this->model->read('base_statement','countOrder',$param);
		// var_dump($resp);exit;
		if(!$resp['status']){
			echo "还没有相关的对账统计！";
			return false;
		}
		ob_end_clean();
	    $sep = "\t"; 
	    $savename = '对账统计'.date("YmjHis");  
    	
	    $file_type = "vnd.ms-excel";  
	    $file_ending = "xls";  
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

	    $th_td[0] = "<td>公司名称</td>";
	    $th_td[1] = "<td>公司收入</td>";
	    $th_td[2] = "<td>收入手续费</td>";
	    $th_td[3] = "<td>支出金额</td>";
	    $th_td[4] = "<td>支出手续费</td>";


		echo "<tr>";
	    foreach ($th_td as $key => $value) {
	       echo iconv('utf-8', 'gbk', $value).$sep;
	    }
	    echo "</tr>";

	    foreach ($resp['data']['list'] as $key => $value) {
	    	
	        $head_td[0] = "<td>".$value['providerName']."</td>";
	        $head_td[1] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".($value['turnover']-($value['turnover']*0.006-$value['inCome']-$value['inCome']*0.006))."</td>";
	        $head_td[2] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['turnover']*0.006."</td>";
	        $head_td[3] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['inCome']."</td>";
	        $head_td[4] = "<td style=\"vnd.ms-excel.numberformat:￥#,##0.00\">".$value['inCome']*0.006."</td>";

	        
	        echo "<tr>";
	        foreach ($head_td as $key_ht => $value_ht) {
	           echo iconv('utf-8', 'gbk', $value_ht).$sep;
	        }
	        echo "</tr>";
	    }
	    echo "</table>";
	    
	    return (true);  	

    }
	public function getProviderList(){
		$resp = $this->model->read('base_statement','getItem');
		$classList[] = '请选择';
		foreach ($resp['data'] as $key => $value) {
			$classList[$value['providerName']] = $value['providerName'];
		}
		return $classList;
	}

	
}


