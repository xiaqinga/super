<?php

/**
 * 第三方授权账户
 * @author zeng.will@outlook.com  
 * @since   2015.08.22
 * @version 1.0
 */

class OauthUser {
	
	/**
	 * db object
	 */
	public $db = null;

	/**
	 * Array,第三方平台授权信息
	 */
	private $token_access;

	/**
	 * 用户系统账户id
	 */
	private $uid;

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
	public function __construct(&$db) {
		$this->db = $db;
		$this->result['status'] = 1;
	}
	
	/**
	 * 检测账户是否已绑定
	 * @access public
	 * @param array $token_access 平台授权信息
	 * @return bool
	 */	
	public function checkBind(){
		$auth_id = $this->token_access['auth_id'];
		$plat    = $this->token_access['plat'];
		return $this->db->total("SELECT 1 FROM ".DB_PREFIX."auth_member WHERE plat='$plat' AND auth_id='$auth_id'");
	}
	
	/**
	 * 已绑定账户自动获取登录状态
	 * @access public
	 * @param array $token_access 平台授权信息
	 * @return int 0未绑定，1登录成功，3账号绑定出错，需重新绑定，4账户被禁止登录
	 */	
	public function userLogin($token_access){
		$this->token_access = $token_access;

		if ( $this->checkBind() ){
			$plat    = $this->token_access['plat'];
			$auth_id = $this->token_access['auth_id'];
			
			$data = $this->db->select("SELECT b.username,b.uid,b.mobphone,b.groupid,b.photo,b.email,b.birthday,b.address,b.gender,b.car,b.score,b.descript,b.fans_num,b.status,b.createtime,b.lastlogin,b.logintimes FROM ".DB_PREFIX."auth_member AS a,".DB_PREFIX."member AS b WHERE a.uid=b.uid AND a.auth_id='$auth_id' AND a.plat='$plat'");
			
			if(empty($data))
			{
				return 3;//绑定账号出错，需重新绑定
			}	
			else
			{
				$rs = $data[0];
				if($rs['status'] == 4)
				{
					return 4;//账户被禁止登录
				}	
				else
				{
					$this->uid = $rs['uid'];
					
					//与上次登录超过1分钟，更新登录信息
					if( time()-$rs['lastlogin'] > 60 )
					{
						$this->updateLogin();
					}
										
					return $rs;
				}
			}
		}
		else
		{
			//未绑定账户，默认注册新账户
			$this->oauthReg($this->token_access['nickname'],$this->token_access['photo']);
			$rs = array(
				'uid'    => $this->uid,
				'username' => $this->token_access['nickname'],
				'photo' => $this->token_access['photo'],
				'groupid' => 0,
				'gender' => 0,
				'fans_num' => 0,
				'status' => 0,
				'lastlogin' => time()
			);
			return $rs;
		}
			
	}
	
	/**
	 * 认证用户登录并绑定（第三方账号登录有系统账户时默认绑定）
	 * @access public
	 * @param string $name 登录账户
	 * @param string $pwd 密码
	 * @return string
	 */	
	public function oauthLogin($name,$pwd){
		$data = $this->db->select("SELECT b.username,b.uid,b.groupid,b.gender,b.fans_num,b.status,b.lastlogin FROM ".DB_PREFIX."member  WHERE mobphone='$name' AND password='$pwd'");
		
		if(empty($data))
		{
			return false;
		}	
		else
		{
			$rs = $data[0];
			$this->uid = $rs['uid'];
			
			if(!$this->checkBind())
			{
				$this->bindUser();
			}	
			
			if($rs['status'] == 4)
			{
				return 4;//账户被禁止登录
			}	
			else
			{				
				//与上次登录超过1分钟，更新登录信息
				if( time()-$rs['lastlogin'] > 60 )
				{
					$this->updateLogin();
				}
				
				return $rs['username'];
			}
		}
	}
	
	/**
	 * 认证用户注册并绑定（第三方账号登录无绑定时默认注册系统账户）
	 * @access public
	 * @param string $username 昵称
	 * @param string $photo 个人头像
	 * @return bool
	 */	
	public function oauthReg($username,$photo){
		//if(!$this->checkForbid($nick)){
			$time = time();
			$this->db->insert("INSERT INTO ".DB_PREFIX."member (mobphone,username,photo,email,birthday,car,address,descript,createtime,lastlogin,thislogin) VALUES ('','$username','$photo','','','','','','$time','$time','$time')");
			$this->uid = $this->db->last_id;
			$this->bindUser();
			return true;
		//}
		//else
			//return false;
		
	}
	
	/**
	 * 绑定认证用户到系统账户
	 * @access private
	 * @return void
	 */	
	private function bindUser(){
		if( $this->uid )
		{
			$plat      = $this->token_access['plat'];
			$auth_id   = $this->token_access['auth_id'];
			$uid       = $this->uid;
			$auth_nick = $this->token_access['nickname'];
			$auth_photo= $this->token_access['photo'];
			$token     = $this->token_access['token'];
			$createtime= time();
			
			return $this->db->insert("INSERT INTO ".DB_PREFIX."auth_member (auth_id,uid,plat,auth_user_nick,auth_user_photo,token,createtime) VALUES ('$auth_id','$uid','$plat','$auth_nick','$auth_photo','$token','$createtime')");
		}
	}
	
	/**
	 * 更新用户登录信息
	 * @access private
	 * @return void
	 */	
	private function updateLogin(){
		$ip   = $this->getClientIP();
		$time = time();
		$uid = $this->uid;
		
		$this->db->update("UPDATE ".DB_PREFIX."member SET lastlogin=thislogin,thislogin='$time',logintimes=logintimes+1 WHERE uid='$uid'");
	}
	
	/**
	 * 检测是否包含屏蔽词
	 * @access private
	 * @param string $str 被检测的字符
	 * @return bool
	 */	
	private function checkForbid($str){
		$data = $this->db->select("SELECT cfg_value FROM tb_config WHERE cfg_name='forbid'");
		$forbid_arr = explode(" ",$data[0]);
		if(!empty($forbid_arr)){
			foreach($forbid_arr as $val){
				if($val<>'' && false !== strpos($str,$val)){
					return true;
					break;
				}
			}
		}
		else
			return false;
	}
	
	/**
	 * 获取用户IP
	 * @access public
	 * @return string
	 */	
	public function getClientIP(){
	    static $ip = NULL;
	    if ($ip !== NULL) return $ip;
	    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	        $pos =  array_search('unknown',$arr);
	        if(false !== $pos) unset($arr[$pos]);
	        $ip   =  trim($arr[0]);
	    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    // IP地址合法验证
	    $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
	    return $ip;
	}
	
	/**
	 * 设置用户Cookie信息(默认48小时)
	 * @access public
	 * @param string $email 登录邮箱
	 * @param string $pwd 密码
	 * @param string $nick 昵称
	 * @return void
	 */	
	public function setCookie48($email,$pwd,$nick){
		setcookie("usm_email",$email,time()+3600*48,'/');
		setcookie("usm_password_md5",$pwd,time()+3600*48,'/');
		setcookie("usm_nick",$nick,time()+3600*48,'/');
	}
	
	public function __destruct() {
		//
	}
}