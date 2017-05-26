<?php

/**
 * 联盟商分类
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class sign extends common {

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
        if(isset($key)){
            $param['key'] = $key;
        }
        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
        $resp = $this->model->read('sign','getlist',$param);
        $total = ($resp['status']) ? $resp['data']['total'] : 0;
        $data  = array(
            'list' => ($resp['status']) ? $resp['data']['list'] : array(),
            'total' => $total,
            'pageindex' => $page,
            'page' => $this->page->page($total,$pagesize),
            'key_type' => $key_type,
            'key' => $key,
            'signStatusList'=>[
              '0'=>'否',
              '1'=>'是' 
            ],
            'ref' => $this->func->curr_url()
        );
        $this->view($data,'sign/index');
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
        if(isset($key)){
            $param['key'] = $key;
        }
        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
        $resp = $this->model->read('sign','getlist',$param);
        $list=($resp['status']) ? $resp['data']['list'] : array();
        $data  = array(
            'list' => $list,
            'key_type' => $key_type,
            'key' => $key,
            'ref' => $this->queryVar('ref' , APP_URL . 'sign/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
        );
        $this->setActionLog('sign','QUERY','查看签到列表');
        $this->view($data,'sign/ajaxindex');
    }
    public function uploadexcel(){
        $this->view('sign/uploadexcel');
    }
    public function info(){
        $id = $this->queryVar('id');

        if(!empty($id)){
            $param['id'] = $id;
            $resp = $this->model->read('sign','getInfo',$param);
            if($resp['status']){
                $data = $resp['data']['list'][0];
            }
          
        }
        $data['ref'] = $this->queryVar('ref' , APP_URL . 'sign/index');
        $this->view($data,'sign/edit');
    }



    public function delete(){
        $id = $this->queryVar('ids');
        $ref = $this->queryVar('ref',APP_URL . 'sign/index');
        $ref = urldecode($ref);
        $param['id'] = $id;
        $resp = $this->model->write('base_union_class','delete', $param);


        $this->setActionLog('base_union_class','DELETE','删除联盟商分类');
        $this->jsonout($resp['status'],array(
            'msg'=>$resp['data']['msg'],
            'ref'=> $ref
        ));
    }
    //导入
    public function uploadexcelsave(){
        $this->lib('PHPExcelToUp','phpExcel');
        $listNameArr = array(
            'A' => '学校名称',
            'B' => '真实姓名',
            'C' => '手机号码',
        );
        $datas = $this->phpExcel->uploadExcel('file',$listNameArr);


        if((!empty($datas))&& $datas == 2){
            $this->jsonout(0,array(
                'msg'=>'导入的表格格式不正确，请导入正确的用户信息表格（A学校名称B真实姓名C手机号码）！',
            ));
            exit;
        }

         foreach ($datas as $key=>$val){
              if($val['0']&&$val['1']&&$val['2']){
                  $data=[
                      'schoolName'=>$val['0'],
                      'realName'=>$val['1'],
                      'mobilePhone'=>$val['2'],
                  ];
             
                  $this->model->write('sign','create', $data);
              }
         }
            $this->jsonout(1,array(
                'msg'=>'导入成功！',
            ));

        }
     //导出
    public  function exportorder(){
        $param = array();
        $key_type = $this->queryVar('key_type');
        $key = $this->queryVar('key');
        if(!empty($key_type)){
            $param['key_type'] = $key_type;
        }
        if(isset($key)){
            $param['key'] = $key;
        }

        $resp = $this->model->read('sign','getlist',$param);
        if(!$resp['status']){
            echo "还没有相关信息！";
            return false;
        }

        $sep = "\t";

       $savename = '用户列表'.date("YmjHis");

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

   


        $th_td[0] = "<td>学校名称</td>";
        $th_td[1] = "<td>真实姓名</td>";
        $th_td[2] = "<td>手机号码</td>";
        $th_td[3] = "<td>签到状态</td>";
        $th_td[4] = "<td>签到时间</td>";
        $th_td[5] = "<td>抽奖编号</td>";
       
            

        echo "<tr>";
        foreach ($th_td as $key => $value) {
            echo iconv('utf-8', 'gbk', $value).$sep;
        }
        echo "</tr>";
        $signStatusList=[
            '0'=>'否',
            '1'=>'是'
        ];
 
        foreach ($resp['data']['list'] as $key => $value) {
            $head_td[0] =  "<td>".$value['schoolName']."</td>";
            $head_td[1] =  "<td>".$value['realName']."</td>";
            $head_td[2] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['mobilePhone']."</td>";
            $head_td[3] = "<td>".$signStatusList[$value['signStatus']]."</td>";
            $value['signDate']=$value['signStatus']==1?$value['signDate']:'';
            $head_td[4] ="<td style=\"vnd.ms-excel.numberformat:yyyy-mm-dd\ hh\:mm\:ss\">".$value['signDate']."</td>";;
            $head_td[5] = "<td style=\"vnd.ms-excel.numberformat:@\">".$value['lotteryCode']."</td>";
          


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



}