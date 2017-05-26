var userName = OO.getCookie('userName');
var passWord = OO.getCookie('passWord');
if(userName != null || userName != ''){
	$("#userName").val(userName);
}
if(passWord != null || passWord != ''){
	$("#passWord").val(passWord);
}
/*加载验证码*/
function reloadcode(){
 	document.getElementById('checkcodeimg').src = OO._SRVPATH+'auth/captcha?timestamp='+new Date().getTime();
}

/**
 * 登录
 */
function login(){
	if($("#userName").val()==''){
		$("#userName").focus();
		$('#msg').html('请输入用户名');
		return false;
	}
	if($("#passWord").val()==''){
		$("#passWord").focus();
		$('#msg').html('请输入密码');
		return false;
	}
	if($("#checkCode").val()==""){
		$("#checkCode").focus();
		$('#msg').html('请输入验证码');
		return false;
	}
	var userName = $("#userName").val();
	var passWord = $("#passWord").val();
	OO.setCookie('userName',userName,365*24*60*60);
	OO.setCookie('passWord',passWord,365*24*60*60);
	var url = OO._SRVPATH+'auth/checkLogin';
	var data = {'userName':$("#userName").val(),'passWord':$("#passWord").val(),'checkCode':$("#checkCode").val()};
	$.ajax({type:'post', url:url, data:data, dataType:"json", async:false,
		success:function(d){
			if( 1 == d.status )
			{
				window.location.href = OO._SRVPATH + 'index';
			}
			else
			{
				$('#msg').html(d.data.msg);
			}
		}
	});
	return false;
}