<?php

/**
 * 用户提问
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class member_question extends common {

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
        $resp = $this->model->read('member_question','getlist',$param);
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
        $this->view($data,'member_question/index');
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
        $resp = $this->model->read('member_question','getlist',$param);
        $list=($resp['status']) ? $resp['data']['list'] : array();
        $data  = array(
            'list' => $list,
            'statusList'=>[
              '0'=>'待审核',
              '1'=>'正常'
            ],
            'key_type' => $key_type,
            'key' => $key,
            'ref' => $this->queryVar('ref' , APP_URL . 'member_question/index?key_type='.$key_type.'&key='.$key.'&page='.$page)
        );
        $this->setActionLog('member_question','QUERY','查看签到列表');
        $this->view($data,'member_question/ajaxindex');
    }
    public function upstore(){
        $id=$this->queryVar('ids');
        $param=[
            'id'=>$id,
            'status'=>1
        ];
        $resp = $this->model->write('member_question','update',$param);
        $this->jsonout($resp['status'],array(
            'msg'=>$resp['status']?'修改成功':'修改失败',
            'ref'=> $this->queryVar('ref', APP_URL . 'member_question/index')
        ));
    }
    public function downstore(){
        $id=$this->queryVar('ids');
        $param=[
            'id'=>$id,
            'status'=>-1
        ];
        $resp = $this->model->write('member_question','update',$param);
        $this->jsonout($resp['status'],array(
            'msg'=>$resp['status']?'修改成功':'修改失败',
            'ref'=> $this->queryVar('ref', APP_URL . 'member_question/index')
        ));


    }




}