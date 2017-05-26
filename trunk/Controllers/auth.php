<?php

/**
 * 登录鉴权
 *
 * @author  janhve@163.com
 * @since   2015.12.16
 * @version 1.0
 */
 
class auth extends Controller {
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
	
		parent::__construct();
	}
	
	public function index()
	{
		$this->login();
	}

	public function login()
	{
		$this->lib('Session','sess',SESSION_STORER_TYPE);
		$auth_key = $this->sess->get(USER_AUTH_KEY);

		if ( 'schoolmaker_auth_passed' === $auth_key )
		{

			$this->redirect('index');
		}
		else
		{
			$this->view('auth/index');
		}
	}
	
	public function checkLogin()
	{
		$userName = $this->queryVar('userName');
		$passWord = $this->queryVar('passWord');
		$checkCode = strtolower($this->queryVar('checkCode'));
		$this->lib('Session','sess',SESSION_STORER_TYPE);
		$verifycode = $this->sess->get('verifycode');
		if($verifycode != $checkCode){
			$this->jsonout(0,array('msg'=>'验证码错误'));
		}
	
			$param['accout'] = $userName;
			$param['passWord'] = md5($passWord);
		
			$resp = $this->model->read('user','getUserToPasswrod',$param);
			if( $resp['status'] )
			{
				$userdata = $resp['data']['list'];
				$sess_data = array(
					USER_AUTH_KEY => 'schoolmaker_auth_passed',
					'id'	  => $userdata['id'],
					'name'	  => ( '' == $userdata['userName'] ) ? $userdata['accout'] : $userdata['userName'],
					'accout' => $userdata['accout'],
					'roleId'	  => $userdata['roleId'],
				);
				$this->sess->set($sess_data);
				$this->sess->del('verifycode');
				$this->jsonout(1,array('msg'=>'登录成功'));
			}
			else
			{
				$this->jsonout(0,array('msg'=>'用户名不存在或密码错误'));
			}
	
	}

	public function logout()
	{
		$this->lib('Session','sess',SESSION_STORER_TYPE);
		$this->sess->del(array(USER_AUTH_KEY,'id','username','phone','name','email','isemailtip','roleid','project','lastdatetime'));
		$this->jsonout(1,array('msg'=>'退出成功'));
	}
	
	public function captcha()
	{
		$this->lib('Session','sess',SESSION_STORER_TYPE);
		$this->lib('wcore_verify','wcoreverify');
		
		/*$this->wcoreverify->font_size = 20;
		$this->wcoreverify->bgcolor   = '#FFFFFF';*/
		$this->wcoreverify->doimg();
		$vcode = $this->wcoreverify->getCode();
		$this->sess->set('verifycode',strtolower($vcode));
	}
	
	public function checkexist()
	{
		$name   = $this->queryVar('name');
		$value  = $this->queryVar('value');
		$id = $this->queryVar('id', 0);
		$param[$name] = $value;
		if(!empty($id)){
			$param['id'] = $id;
		}
		
		$resp = $this->model->read('user','checkexist',$param);
		
		if( $resp['status'] )
		{
			$this->jsonout(1,array('msg'=>'存在'));
		}
		else
		{
			$this->jsonout(0,array('msg'=>'不存在'));
		}
	}
}