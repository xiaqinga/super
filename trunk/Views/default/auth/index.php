<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<title><?php echo APP_NAME;?> - 登录</title>
		<link rel="shortcut icon" href="<?php echo WWW_RES_URL;?>favicon.ico"/>
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/sui.min.css" />
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/sui-append.min.css" />
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/base.css" />
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/login.css" />
		<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/jquery-1.12.0.min.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sui.min.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/base.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
	</head>
	<body>
	<div class="wrap">
		<div class="wrap-top">
			<h1><?php echo INDEX_TITLE;?></h1>
		</div>
		<div class="login_banner">
			<div class="channellogin">
				<h3>用户登录</h3>
			    <div class="channellogin-content">
			    	<form onsubmit="return login();" action="" method="post" name="thisform">
			        
			        <div class="channellogin-input channellogin-input-username">
			            <input type="text" placeholder="请输入用户名" value="" id="userName" name="userName" class="channellogin-username">
			        </div>
			        <div class="channellogin-input channellogin-input-password">
			            <input type="password" placeholder="请输入密码" value="" id="passWord" name="passWord" class="channellogin-password">
			        </div>
			        <div class="channellogin-input-validateCode">
			            <input type="text" maxlength="4" autocomplete="off" placeholder="请输入验证码" value="" name="checkCode" id="checkCode" class="channellogin-validateCode">
			        	<img alt="刷新验证码" style="cursor: pointer; vertical-align: middle; border: 1px solid #c0c0c0; height: 37px; width: 36%;" src="<?php echo APP_URL;?>Auth/captcha" onclick="reloadcode()" id="checkcodeimg">
			        </div>
			        <div id="msg" class="divmsg"><font color="red"></font></div>
			        <div><input type="submit" class="channellogininp" id="channellogininp" value="登 录"></div>
			        </form>
			    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/auth/index.js"></script>
	</body>
</html>
