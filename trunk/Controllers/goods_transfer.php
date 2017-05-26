<?php

/**
 * 活动管理
 *
 * @author wsbnet@qq.com
 * @since   2016-09-08
 * @version 1.0
 */

class goods_transfer extends common {

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

        $resp = $this->model->read('goods_transfer','getlist',$param);
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
        $this->view($data,'goods_transfer/index');
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

        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
        $resp = $this->model->read('goods_transfer','getlist',$param);
        $data  = array(
            'list' => ($resp['status']) ? $resp['data']['list'] : array(),
            'key_type' => $key_type,
            'key' => $key,
            'ref' => $this->queryVar('ref' , APP_URL . 'goods_transfer/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
        );


        $this->view($data,'goods_transfer/ajaxindex');
    }


    //基本信息
    public function info(){
        $id = $this->queryVar('id');
        if(!empty($id)){
            $param['id'] = $id;
            $resp = $this->model->read('goods_transfer','getlist',$param);
            if($resp['status']){
                $data = $resp['data']['list'][0];
                //当前省市区
                if($data['areaCode']){
                    $provinceCode = substr($data['areaCode'],0,2);
                    $pro['code'] = $provinceCode;
                    $data['provinceCurList'] = $this->getProvinceList($pro)['data']['list']['0']['name'];
                }
                if($data['areaCode']){
                    $cityCode = substr($data['areaCode'],0,4);
                    $city['code'] = $cityCode;
                    $data['cityCurList'] = $this->getCityList($city)['data']['list']['0']['name'];
                }



            }

        }
        $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_transfer/index');
        $this->view($data,'goods_transfer/info');
    }
    public function upstore(){
        $id = $this->queryVar('ids');
        $ref = $this->queryVar('ref',APP_URL . 'goods_transfer/index');
        $ref = urldecode($ref);
        $param['id'] = $id;
        $resp = $this->model->write('goods_transfer','upstore', $param);
        //新增/修改商品搜索引擎
        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '物品上架成功' : '商品上架失败',
            'ref'=> $ref
        ));


    }
    public function downstore(){
        $id = $this->queryVar('ids');
        $ref = $this->queryVar('ref',APP_URL . 'goods_transfer/index');
        $ref = urldecode($ref);
        $param['id'] = $id;
        $resp = $this->model->write('goods_transfer','downstore', $param);
        //新增/修改商品搜索引擎
        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '物品下架成功' : '物品下架失败',
            'ref'=> $ref
        ));


    }





}


