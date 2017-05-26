<?php

/**
 * 学校地址
 *
 * @author wsbnet@qq.com
 * @since   
 * @version
 */

class base_school_address extends common {

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
        $resp = $this->model->read('base_school_address','getlist',$param);
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
        $this->view($data,'base_school_address/index');
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
        $resp = $this->model->read('base_school_address','getlist',$param);
        $list=($resp['status']) ? $resp['data']['list'] : array();
        $areaCode=get_parameter_set('areaCode',$list);
        $addressPrefix=$this->getAddressDetail($areaCode);
      


        $data  = array(
            'list' => $list,
            'addressPrefix'=>$addressPrefix,
            'key_type' => $key_type,
            'key' => $key,
            'ref' => $this->queryVar('ref' , APP_URL . 'base_school_address/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
        );
        $this->setActionLog('base_school_address','QUERY','查看学院列表');
        $this->view($data,'base_school_address/ajaxindex');
    }
    public function delete(){
        $id=$this->queryVar('ids');
        $param=[
            'id'=>$id,
            'status'=>0
        ];
        $resp = $this->model->write('base_school_address','update',$param);
        $this->jsonout($resp['status'],array(
            'msg'=>$resp['status']?'修改成功':'修改失败',
            'ref'=> $this->queryVar('ref', APP_URL . 'base_school_address/index')
        ));
    }
    public function edit(){
        $id = $this->queryVar('id');
        if(!empty($id)){
            $param['id'] = $id;
            $resp = $this->model->read('base_school_address','getItem',$param);
            if($resp['status']){
                $data = $resp['data']['list']['0'];
            }
        }


        $data['ref'] = $this->queryVar('ref', APP_URL . 'base_enterprise_info/index');



        $area['code']=$data['areaCode'];
        $areaCurList = $this->getAreaList($area);
        $area_cur = $areaCurList['status']==1?$areaCurList['data']['list'][0]:null;




        $city['code']=$area_cur['cityCode'];
        $cityCurList = $this->getCityList($city);
        $city_cur = $cityCurList['status']==1?$cityCurList['data']['list'][0]:null;

        $pro['code']=$city_cur['provinceCode'];
        $provinceCurList = $this->getProvinceList($pro);
        $province_cur = $provinceCurList['status']==1?$provinceCurList['data']['list'][0]:null;


        $provinceList = $this->getProvinceList();//显示所有省份

        //下拉菜单省市区

            $drop_pro['provinceCode']=$city_cur['provinceCode'];
            $cityList = $this->getCityList($drop_pro);//当前省份所有城市


            $drop_city['cityCode']=$area_cur['cityCode'];
            $areaList = $this->getAreaList($drop_city);//当前城市所有县区


        $data['provinceList'] = $provinceList['status']==1?$provinceList['data']['list']:null;
        $data['cityList'] = $cityList['status']==1?$cityList['data']['list']:null;
        $data['areaList'] = $areaList['status']==1?$areaList['data']['list']:null;

        $data['province_cur'] = $province_cur;
        $data['city_cur'] = $city_cur;
        $data['area_cur'] = $area_cur;
        $this->view($data,'base_school_address/edit');
    }

    //保存
    /**
     * 学校保存(添加 )
     */
    function save()
    {


        $id = $this->queryVar('id');
        $ref = $this->queryVar('ref',APP_URL . 'base_school_address/index');
        $ref = urldecode($ref);

        $param['schoolCode'] = $this->queryVar('schoolCode');
        $param['schoolName'] = $this->queryVar('schoolName');
        $param['photoUrl'] = $this->queryVar('photoUrl');
        $param['areaCode'] = $this->queryVar('areaCode');
        $param['fullAddress'] = $this->queryVar('fullAddress');
        $param['description'] = $this->queryVar('description');
        


        if(!$id){

            $param['createDate'] = date('Y-m-d H:i:s');
            $checkResp=$this->model->read('base_school_address','checkName',['schoolName'=>$param['schoolName']]);
            if($checkResp['status']){
                $this->jsonout(0,array(
                    'msg'=>'该学校名称已被使用',
                    'ref'=> $ref
                ));
            }
            $resp = $this->model->write('base_school_address','create', array_filter($param));

            $opt  = '添加';
            $this->setActionLog('base_school_address','SAVE','新增学校');
        }else{
            $param['id']=$id;

            $checkResp=$this->model->read('base_school_address','checkName',['id'=>$param['id'],'schoolName'=>$param['schoolName']]);
            if($checkResp['status']){
                $this->jsonout(0,array(
                    'msg'=>'该学校名称已被使用',
                    'ref'=> $ref
                ));
            }



            $resp = $this->model->write('base_school_address','update', array_filter($param));

            $opt  = '修改';
            $this->setActionLog('base_school_address','UPDATE','修改学校');
        }


        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '学校'.$opt.'成功' : '学校'.$opt.'没更新',
            'ref'=> $ref
        ));
    }


    public function info()
    {
        $id = $this->queryVar('id');
        if(!empty($id)){
            $param['id'] = $id;
            $resp = $this->model->read('base_school_address','getItem',$param);
            if($resp['status']){
                $data = $resp['data']['list']['0'];
                $data['addressPrefix']=$this->getAddressDetail($data['areaCode']);

            }
        }


        $data['ref'] = $this->queryVar('ref', APP_URL . 'base_enterprise_info/index');
        $this->view($data,'base_school_address/info');
    }

}