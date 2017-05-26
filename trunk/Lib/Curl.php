<?php

/**
 * Curl
 *
 *
 * @since             2015-08-31
 * @author            wsbnet@qq.com
 * @version           Version 1.0
 */
class Curl
{	
    /**
     * 处理结果
     */
    public $result = array(
        'status' => 0,
        'data'   => null
    );

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->result['status'] = 1;
    }

    //https请求（支持GET和POST）
    public function https_request($url, $data = null)
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
        $result = $this->apiPost(APP_URL."{$module}/{$action}", $param);
        return json_decode($result, true);
    }

    /**
     * 调用接口
     *
     * @param array $param  接口参数
     * @return mixed    返回内容
     */
    public function apiUrl($url, $param = array())
    {
        $result = $this->apiPost($url, $param);
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