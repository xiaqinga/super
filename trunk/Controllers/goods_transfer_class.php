<?php

/**
 * 物品转让分类
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class goods_transfer_class extends common {

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
        if(!empty($key)){
            $param['key'] = $key;
        }

        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

        $resp = $this->model->read('goods_transfer_class','getlist',$param);
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

        $this->view($data,'goods_transfer_class/index');
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
        $resp = $this->model->read('goods_transfer_class','getlist',$param);
        $resp_list = $resp['status'] ? $resp['data']['list'] : [];
        foreach ($resp_list as $key => $value) {
            $class_rumbs = '顶级-->';

            //父级
            $p_parent['id'] = $value['parentId'];
            $resp_parent = $this->model->read('goods_transfer_class','getItem',$p_parent);
            $class_parent = $resp_parent['status'] ? $resp_parent['data']['className'] : null;
            $class_parent = $class_parent ? $class_parent : '';

            //祖父级
            $p_granddad['id'] = $resp_parent['status'] ? $resp_parent['data']['parentId'] :null;
            $resp_granddad = $this->model->read('goods_transfer_class','getItem',$p_granddad);
            $class_granddad = $resp_granddad['status'] ? $resp_granddad['data']['className'] : null;
            $class_granddad = $class_granddad ? $class_granddad : '';

            //本级
            $class_self = $resp['status'] ? $resp['data']['list'][$key]['className'] : null;

            //组合分类面包屑名称
            if($class_granddad){
                $class_rumbs .= $class_granddad.' > ';
            }

            if($class_parent){
                $class_rumbs .= $class_parent.' > ';
            }
            if($class_rumbs){
                $class_rumbs .=$class_self;
            }else{
                $class_rumbs =$class_self;
            }
            $resp['data']['list'][$key]['class_rumbs'] = $class_rumbs;

        }
        if(isset($param['key'])){
            $key = $param['key'];
        }else{
            $key = '';
        }
        $data  = array(
            'list' => ($resp['status']) ? $resp['data']['list'] : array(),
            'key_type' => $key_type,
            'key' => $key,
            'ref' => $this->queryVar('ref' , APP_URL . 'goods_transfer_class/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
        );

        $this->view($data,'goods_transfer_class/ajaxindex');
    }

    // 上级分类 ajax获取分类
    public function getClassJson(){
        //查询
        $param['id'] = $this->queryVar('id',0); //默认获取所有 顶级-->一级 分类
        $resp = $this->model->read('goods_transfer_class','getJson',$param);
        $resp_list = $resp['status'] ? $resp['data']['list'] : [];
        echo json_encode($resp_list);
    }

    public function edit(){
        $id = $this->queryVar('id');
        $classTitles = $this->model->read('goods_transfer_class','getlist');
        $data['classTitles'] = $classTitles['data']['list'];
        if(!empty($id)){
            $param['id'] = $id;
            $resp = $this->model->read('goods_transfer_class','getlist',$param);
            if($resp['status']){
                $data['attr'] = $resp['data']['list'][0];
                //子查询父级分类
                $p_parent['id'] = $data['attr']['parentId'];
                $resp_parent = $this->model->read('goods_transfer_class','getItem',$p_parent);
                $class_parent = $resp_parent['status'] ? $resp_parent['data']['className'] : null;
                $class_parent = $class_parent ? $class_parent : '顶级';
                $data['attr']['class_parent'] = $class_parent;
            }
            $data['id'] = $id;
        }
        $data['ref'] = $this->queryVar('ref' , APP_URL . 'goods_transfer_class/index');
        $this->view($data,'goods_transfer_class/edit');
    }

    public function save(){
        $id = $this->queryVar('id');
        $param['className'] = $this->queryVar('className');
        $param['parentId'] = $this->queryVar('parentId');
        $param['photoUrl'] = $this->queryVar('photoUrl');
        $ref = $this->queryVar('ref',APP_URL . 'goods_transfer_class/index');
        $ref = urldecode($ref);
        $where['className'] = $param['className'];
        $where['parentId'] = $param['parentId'];
        if($id){
            $where['id'] = $id;
        }
        $repeat_classname = $this->model->read('goods_transfer_class','findrepeat',$where);
        // var_dump($repeat_classname);die();
        $status = 0;
        if($repeat_classname['status'] = 1){
            if ($repeat_classname['data']['0']['status'] == '1') {
                $this->jsonout($status,array(
                    'msg'=>'该转让分类已存在',
                    'ref'=> $ref
                ));

            }elseif ($repeat_classname['data']['0']['status'] == '-1') {
                $id = $repeat_classname['data']['0']['id'];
                $param['status'] = 1;
            }
        }
        if(!$id)
        {
            $param['createUser'] = $this->sess->get('id');
            $param['upadteUser'] = $this->sess->get('id');
            $resp = $this->model->write('goods_transfer_class','create', $param);
            $opt  = '添加';
        }
        else
        {
            $param['id'] = $id;
            $param['upadteUser'] = $this->sess->get('id');
            $resp = $this->model->write('goods_transfer_class','update', $param);
            $opt  = '修改';
        }

        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '转让分类'.$opt.'成功' : '转让分类没变化',
            'ref'=> $ref
        ));

    }



    public function delete(){
        $id = $this->queryVar('ids');
        $ref = $this->queryVar('ref',APP_URL . 'goods_transfer_class/index');
        $ref = urldecode($ref);
        $param['id'] = $id;
        $resp = $this->model->write('goods_transfer_class','delete', $param);
        $this->jsonout($resp['status'],array(
            'msg'=>$resp['msg']?$resp['msg']:(($resp['status']) ? '商品分类删除成功' : '商品分类删除失败'),
            'ref'=> $ref
        ));
    }

    //更新分类缓存
    public function updatecahce(){
        $resp = $this->model->write('goods_transfer_class','updatecahce');
        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? true : false
        ));
    }



}