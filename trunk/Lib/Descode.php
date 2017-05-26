<?php

/**
 * descode 3des加密解密
 * 
 * 结合客户java版3des加密解密方法，实现对关键数据的加密解密处理。
 * 需与客户加密解密所使用的key和iv保持一致。
 * 
 * @date            2014-10-09
 * @author			will.zeng@outlook.com
 * @since			Version 1.0
 */

class Descode{

    /**
     * 加密密钥
     *
     * var key string 需与客户端的key保持一致
     */
    public $key = 'so02y60m61biuy2518gnjbih';

    /**
     * 初始化向量
     *
     * var iv string 与客户端的iv一致
     */
    public $iv = '91979694';
    
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
    public function __construct(){
        $this->result = array(
            'status' => 1,
            'data'   => 'Libraries Descode 启动成功!'
        );
    }
    

    /**
     * 3des加密
     * @param $input需要加密的字符串
     */
    function encrypt($input){
        $size = mcrypt_get_block_size(MCRYPT_3DES,MCRYPT_MODE_CBC);
        $input = $this->pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        @mcrypt_generic_init($td, $this->key, $this->iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = rawurlencode(base64_encode($data));
        return $data;
    }

    /**
     * 3des解密
     * @param $encrypted需解密的字符串
     */
    function decrypt($encrypted){
        $encrypted = base64_decode(rawurldecode($encrypted));
        $td = mcrypt_module_open(MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $this->key, $this->iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }

    /**
     * pksc5填充
     * @param $text需填充的字符串
     * @param $blocksize填充字符串
     */
    function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * pksc5去除填充
     * @param $text需删除填充的字符串
     */
    function pkcs5_unpad($text){
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }
}