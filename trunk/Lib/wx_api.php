<?php

/**
 * 微信消息管理接口
 *
 * @author wsbnet@qq.com
 * @since   2016-07-20
 * @version 1.0
 */

class wx_api
{
    /**
     * 处理结果
     */
    public $result = array(
        'status' => 0,
        'data'   => null
    );
    public $followdata = Array();
    public $autodata = Array();
    public $keydata = Array();
    public $test;
    public function __construct() {
        
         $this->result['status']=1;
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            switch($RX_TYPE)
            {
                case "text":
                $resultStr = $this->handleText($postObj);
                break;
                case "event":
                $resultStr = $this->handleEvent($postObj);
                break;
                default:
                $resultStr = "Unknow msg type: ".$RX_TYPE;
                break;
            }
            return $resultStr;
        }else {
            return "";
            exit;
        }
    }

    public function handleText($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $haskey = false;
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>"; 

        //按关键字回复
        $keylists = $this->keydata;
        foreach ($keylists as $key => $value) {
            if(strpos($value['keyword'],$keyword)>-1){
                if($value['msgtype']==1){
                    $msgType = "text";
                    $contentStr = json_decode($value['content'])->content;

                }elseif($value['msgtype']==2){
                    $msgType = "image";
                    $imageTpl ="<xml>
                                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                                <CreateTime>".$time."</CreateTime>
                                <MsgType><![CDATA[".$msgType."]]></MsgType>
                                <Image>
                                <MediaId><![CDATA[".json_decode($value['content'])->media_id."]]></MediaId>
                                </Image>
                                </xml>"; 
                    $result['resultStr'] = $imageTpl;
                    return $result;

                }elseif($value['msgtype']==3){
                    $msgType = "voice";
                    $voiceTpl ="<xml>
                                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                                <CreateTime>".$time."</CreateTime>
                                <MsgType><![CDATA[".$msgType."]]></MsgType>
                                <Voice>
                                <MediaId><![CDATA[".json_decode($value['content'])->media_id."]]></MediaId>
                                </Voice>
                                </xml>"; 
                    $result['resultStr'] = $voiceTpl;
                    return $result;

                }elseif($value['msgtype']==4){
                    $msgType = "video";
                    $voiceTpl ="<xml>
                                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                                <CreateTime>".$time."</CreateTime>
                                <MsgType><![CDATA[".$msgType."]]></MsgType>
                                <Video>
                                <MediaId><![CDATA[".json_decode($value['content'])->media_id."]]></MediaId>
                                <Title><![CDATA[".json_decode($value['content'])->name."]]></Title>
                                <Description><![CDATA[".json_decode($value['content'])->description."]]></Description>
                                </Video> 
                                </xml>"; 
                    $result['resultStr'] = $voiceTpl;
                    return $result;

                }elseif($value['msgtype']==5){
                    $itemTpl = "";
                    $msgType = "news";

                    $str = str_replace(" ","+",json_decode($value['content'])->content);//解决用base64_decode解密的时候,出现乱码
                    $itemobj = json_decode(base64_decode($str));
                    $news_item = $itemobj->content->news_item;

                   /*
                    $this->test=$news_item[0]->title; //调试代码保留
                    $contentStr = 'ddd';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    $result['resultStr'] = $resultStr;
                    return $result;*/

                    foreach ($news_item as $key => $value) {
                       $itemTpl .= "<item>
                                    <Title><![CDATA[".$value->title."]]></Title> 
                                    <Description><![CDATA[".$value->digest."]]></Description>
                                    <PicUrl><![CDATA[".$value->thumb_url."]]></PicUrl>
                                    <Url><![CDATA[".$value->url."]]></Url>
                                    </item>";
                    }
                    $newsTpl = "<xml>
                                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                                <CreateTime>".$time."</CreateTime>
                                <MsgType><![CDATA[".$msgType."]]></MsgType>
                                <ArticleCount>".count($news_item)."</ArticleCount>
                                <Articles>".$itemTpl."</Articles>
                                </xml>"; 
                    $result['resultStr'] = $newsTpl;
                    return $result;
                }
                $haskey = true;
            }
        }

        ///多客服回复 和 自动回复 只能二选一 (后面的自动回复不执行了)
        /*$result['resultStr'] = " <xml>
                                 <ToUserName>".$fromUsername."</ToUserName>
                                 <FromUserName>".$toUsername."</FromUserName>
                                 <CreateTime>".$time."</CreateTime>
                                 <MsgType><![CDATA[transfer_customer_service]]></MsgType>
                             </xml>";
        return $result;*/

        //自动回复
        if(!$haskey){
            $autodata = $this->autodata;
                if($autodata[0]['msgtype']==1){ //文字
                    $contentStr = str_replace("<quotes>","\"",json_decode($autodata[0]['content'])->content);
                    $resultStr = $this->responseText($postObj, $contentStr);
                }elseif($autodata[0]['msgtype']==2){ //图片
                    $contentStr = json_decode($autodata[0]['content'])->media_id;
                    $resultStr = $this->responseImage($postObj, $contentStr);
                }elseif($autodata[0]['msgtype']==3){ //语音
                    $contentStr = json_decode($autodata[0]['content'])->media_id;
                    $resultStr = $this->responseVoice($postObj, $contentStr);
                }elseif($autodata[0]['msgtype']==4){ //视频
                    $media_id = json_decode($autodata[0]['content'])->media_id;
                    $title = json_decode($autodata[0]['content'])->title;
                    $description = json_decode($autodata[0]['content'])->description;
                    $resultStr = $this->responseVideo($postObj, $media_id, $title, $description);
                }
            return $resultStr;
        }
        
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        $result['resultStr'] = $resultStr;
        return $result;
    }

    public function setFollowData($a)
    {
        $this->followdata = $a;
    }

    public function setAutoData($a)
    {
        $this->autodata = $a;
    }

    public function setKeyData($a)
    {
        $this->keydata = $a;
    }

    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":

                /*$followdata = $this->followdata; //调试保留
                $contentStr = "TEST".$followdata[0]['msgtype'];
                $resultStr = $this->responseText($object, $contentStr);*/

                $followdata = $this->followdata;
                if($followdata[0]['msgtype']==1){ //文字
                    $contentStr = str_replace("<quotes>","\"",json_decode($followdata[0]['content'])->content);
                    $resultStr = $this->responseText($object, $contentStr);
                }elseif($followdata[0]['msgtype']==2){ //图片
                    $contentStr = json_decode($followdata[0]['content'])->media_id;
                    $resultStr = $this->responseImage($object, $contentStr);
                }elseif($followdata[0]['msgtype']==3){ //语音
                    $contentStr = json_decode($followdata[0]['content'])->media_id;
                    $resultStr = $this->responseVoice($object, $contentStr);
                }elseif($followdata[0]['msgtype']==4){ //视频
                    $media_id = json_decode($followdata[0]['content'])->media_id;
                    $title = json_decode($followdata[0]['content'])->title;
                    $description = json_decode($followdata[0]['content'])->description;
                    $resultStr = $this->responseVideo($object, $media_id, $title, $description);
                }
            break;
            default :
            $contentStr = "Unknow Event: ".$object->Event;
            break;
        }
        $event = (array)$object->Event;
        $resultStr['event'] = $event[0];

        return $resultStr;
    }

    public function handleCustomer($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $msgType = "transfer_customer_service";
        $textTpl =  "<xml>
                         <ToUserName><![CDATA[%s]]></ToUserName>
                         <FromUserName><![CDATA[%s]]></FromUserName>
                         <CreateTime>%s</CreateTime>
                         <MsgType><![CDATA[%s]]></MsgType>
                     </xml>"; 
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
        $result['resultStr'] = $resultStr;
        return $result;
    }

    public function responseText($object, $content, $flag=0)
    {
        $textTpl = "<xml>
             <ToUserName><![CDATA[%s]]></ToUserName>
             <FromUserName><![CDATA[%s]]></FromUserName>
             <CreateTime>%s</CreateTime>
             <MsgType><![CDATA[text]]></MsgType>
             <Content><![CDATA[%s]]></Content>
        </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        $result['resultStr'] = $resultStr;
        $openids = (array)$object->FromUserName;
        $result['openid'] = $openids[0];
        return $result;
    }

    public function responseImage($object, $media_id, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $media_id);
        $result['resultStr'] = $resultStr;
        $openids = (array)$object->FromUserName;
        $result['openid'] = $openids[0];
        return $result;
    }

    public function responseVoice($object, $media_id, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[voice]]></MsgType>
                    <Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $media_id);
        $result['resultStr'] = $resultStr;
        $openids = (array)$object->FromUserName;
        $result['openid'] = $openids[0];
        return $result;
    }

    public function responseVideo($object, $media_id, $title, $description, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[video]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    </Video> 
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $media_id, $title, $description);
        $result['resultStr'] = $resultStr;
        $openids = (array)$object->FromUserName;
        $result['openid'] = $openids[0];
        return $result;
    }

    public function checkSignature($signature='',$timestamp='',$nonce='')
    {
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>