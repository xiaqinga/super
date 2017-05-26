<?php

/**
 * 微信素材管理接口
 *
 * @author wsbnet@qq.com
 * @since   2016-07-18
 * @version 1.0
 */

class wx_open_api
{
    /**
     * 处理结果
     */
    public $result = array(
        'status' => 0,
        'data'   => null
    );

    //构造函数，获取Access Token
    public function __construct()
    {
        $this->result['status'] = 1;

        //微信应用appid配置
        $this->_wx_appid = APPID;
        $this->_wx_appsecret = APPSECRET;
        $this->_wx_api_url = APP_URL;

        $this->lasttime = false;
        $this->expires_in = false;
        $this->access_token =false;

        $this->get_access_token(); //首先获取数据库保存的.
        $this->response_access_token = $this->get_materialcount(); //请求是否失效

        for ($i = 0; $i < 3; $i++) { //失效重复请求3次
            if(isset($this->response_access_token['errcode'])){ //获取的access_token不正确
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->_wx_appid."&secret=".$this->_wx_appsecret;
                $res = $this->https_request($url);
                $result = json_decode($res, true);
                //save to Database or Memcache
                $this->access_token = $result["access_token"];
                $item = array(
                    'accessDate' => date('Y-m-d H:i:s'),
                    'nextAccessDate' => date('Y-m-d H:i:s',time()+$result["expires_in"]),
                    'access_token' => $this->access_token
                );
                $this->apiCall('access_token','setToken',$item);
            }else{
                break; //access_token正确跳出循环
            }
            sleep(1);
            $this->response_access_token = $this->get_materialcount();
            sleep(1);
        }

    }

    //获取基础支持access_token
    public function get_access_token()
    {
        $access_data = $this->apiCall('access_token','getItem');
        if(count($access_data['data'])>0){
            $this->access_token = $access_data['data']['mark'];
        }
    }

    //获取关注者列表
    public function get_user_list($next_openid = NULL)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->access_token."&next_openid=".$next_openid;
        $res = $this->https_request($url);
        return json_decode($res, true);
    }

    //获取用户基本信息
    public function get_user_info($openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->https_request($url);
        return json_decode($res, true);
    }

    //创建菜单
    public function create_menu($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //获取永久素材的列表
    public function batchget_material($data)
    {   
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

     //获取永久素材详情
    public function get_material($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //获取永久素材的总数
    public function get_materialcount($data=null)
    {   
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //发送客服消息，已实现发送文本，其他类型可扩展
    public function send_custom_message($touser, $type, $data)
    {
        $msg = array('touser' =>$touser);
        switch($type)
        {
            case 'text':
                $msg['msgtype'] = 'text';
                $msg['text']    = array('content'=> urlencode($data));
                break;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->access_token;
        return $this->https_request($url, urldecode(json_encode($msg)));
    }

    //生成参数二维码
    public function create_qrcode($scene_type, $scene_id)
    {
        switch($scene_type)
        {
            case 'QR_LIMIT_SCENE': //永久
                $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
                break;
            case 'QR_SCENE':       //临时
                $data = '{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
                break;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        $result = json_decode($res, true);
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($result["ticket"]);
    }

    //创建分组
    public function create_group($name)
    {
        $data = '{"group": {"name": "'.$name.'"}}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //移动用户分组
    public function update_group($openid, $to_groupid)
    {
        $data = '{"openid":"'.$openid.'","to_groupid":'.$to_groupid.'}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //上传多媒体文件
    public function upload_media($type, $file)
    {
        $data = array("media"  => "@".$file, "type" => $type);
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    /**
     * 上传图文素材
     * $jsondata 图文素材json数据
    */
    public function add_news($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    /**
     * 更新图文素材
     * $jsondata 图文素材json数据
    */
    public function update_news($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }


    /**
     * 删除图文素材
     * $jsondata 图文素材json数据
    */
    public function del_material($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }


    /**
     * 群发
     * $jsondata 图文素材json数据
    */
    public function sendall($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //https请求（支持GET和POST）
    protected function https_request($url, $data = null)
    {
        $curl = curl_init();
        if (class_exists ( '/CURLFile' )) {//php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同  
            curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, true );  
        } else {  
            if (defined ( 'CURLOPT_SAFE_UPLOAD' )) {  
                curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false );  
            }  
        } 
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * 调用接口
     *
     * @param       $module 接口模块名
     * @param       $action 接口动作名
     * @param array $param  接口参数
     * @return mixed    返回内容
     */
    public function apiCall($module, $action, $param = array())
    {
        $result                = $this->apiPost($this->_wx_api_url."{$module}/{$action}", $param);
        return json_decode($result, true);
    }

    /**
     * api POST 数据
     *
     * @param       $url
     * @param array $data
     * @return mixed
     */
    public function apiPost($url, $data = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //POST数据
        curl_setopt($ch, CURLOPT_POST, 1); //POST的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}