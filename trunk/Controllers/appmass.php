<?php

/**
 * 群发管理
 *
 * @author wsbnet@qq.com
 * @since   2017-02-14
 * @version 1.0
 */

class appmass extends common {

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

        
        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;

        $resp = $this->model->read('appmass','getlist',$param);
        $total = ($resp['status']) ? $resp['data']['total'] : 0;
        $data  = array(
            'list' => ($resp['status']) ? $resp['data']['list'] : array(),
            'total' => $total,
            'pageindex' => $page,
            'page' => $this->page->page($total,$pagesize),
            'ref' => $this->func->curr_url()
        );
        $this->view($data,'appmass/index');
    }

    public function ajaxIndex(){

        //每页记录数
        $pagesize = $this->queryVar('pagesize', 10);
        $page = $this->queryVar('page', 1);
        //查询
      
        $param['limit'] = ($page-1)*$pagesize.','.$pagesize;
        $resp = $this->model->read('appmass','getlist',$param);

        $data  = array(
            'list' => ($resp['status']) ? $resp['data']['list'] : array(),
            'ref' => $this->queryVar('ref' , APP_URL . 'appmass/index?page='.$page)
        );
        $data['mass_type']=$this->public_dict['mass_type'];
        $this->view($data,'appmass/ajaxindex');
    }



    public function edit(){
        $data['mass_type']=$this->public_dict['mass_type'];
        $data['ref'] = $this->queryVar('ref' , APP_URL . 'appmass/index');
        $this->view($data,'appmass/edit');
    }
    public function info(){
        $param['id']= $this->queryVar('id');
        $resp=$this->model->read('appmass','find',$param);
        if($resp['status']){
            $data=$resp['data']['list']['0'];
        }

        $data['mass_type']=$this->public_dict['mass_type'];
        $data['ref'] = $this->queryVar('ref' , APP_URL . 'appmass/index');
        $this->view($data,'appmass/info');
    }
    public function save(){
        
        $param['ticker'] = $this->queryVar('ticker');
        $param['title'] = $this->queryVar('title');
        $param['text'] = $this->queryVar('text');
        $param['url'] = $this->queryVar('url');
        $ref = $this->queryVar('ref',APP_URL . 'appmass/index');
        $ref = urldecode($ref);
        //IOS key secret 配置
        $uparam['key']= UMENG_IOS_APP_KEY;
        $uparam['secret']=UMENG_IOS_SECRET;


        //IOS 推送
        $this->lib('Umeng','UmengOne',$uparam);



        $result=$this->UmengOne->sendIOSBroadcast($param['text']);
        //$result=$this->UmengOne->sendIOSUnicast($param['text']);
        //android key secret 配置
        $uparam['key']= UMENG_ANDROID_APP_KEY;
        $uparam['secret']=UMENG_ANDROID_SECRET;
        //android 推送
        $this->lib('Umeng','UmengTwo',$uparam);
        $res=$this->UmengTwo->sendAndroidBroadcast($param);
        if($result['code']!==200&&$res['code']!==200){
            $this->jsonout(0,array(
                'msg'=> '群发发送失败',
                'ref'=> $ref
            ));
              exit;
        }
        $param['type'] = $this->queryVar('type');
        $param['user_id'] = $this->sess->get('id');
        

        
        $resp = $this->model->write('appmass','create', $param);
        $opt  = '发送';
      

        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '群发'.$opt.'成功': '群发'.$opt.'失败',
            'ref'=> $ref
        ));

    }

  

    public function delete(){
        $id = $this->queryVar('ids');
        $ref = $this->queryVar('ref',APP_URL . 'appmass/index');
        $param['id'] = $id;
        $resp = $this->model->write('appmass','delete', $param);
        $this->jsonout($resp['status'],array(
            'msg'=>($resp['status']) ? '商品分类删除成功' : '商品分类删除失败'
        ));
    }

  

}