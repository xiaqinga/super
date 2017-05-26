/**
 *  * fileName:base.js
 *   * since:2015.07.20
 *    * author yinjh<janhve@163.com>
 *     */

var Conf = {};
Conf.HTTP = ('https:' == document.location.protocol) ? 'https://' : 'http://';
Conf.HOST = Conf.HTTP+window.location.host+'/';
Conf.RES = Conf.HOST+'assets/default/';
Conf.STRPWS = 'sayimo';

Conf.IMGUPURL = 'http://testapi.sayimo.cn/makerapi/base/uploadfilebackurl';

Conf.EDITIMGPATH = 'cy_files/editor';
Conf.EDITIMGURL = 'cy_editor';
$(function(){
	OO.init();	
});

var OO = (function(){
		return {
			_SRVPATH : Conf.HOST+'index.php/',
			_ASSETS : Conf.RES,
			_IMGUPURL : Conf.IMGUPURL,
			_EDITIMGPATH : Conf.EDITIMGPATH,
			_EDITIMGURL : Conf.EDITIMGURL,
			
			init : function(){
				$("a").focus(function(){this.blur();});
				
			},
			check_number : function(num){
				var reg = /^[0-9]*$/;
				return reg.test(num)
			},
			check_mobphone : function(mob){
				var reg = /^1[3|4|5|7|8]\d{9}$/;
				return reg.test(mob)
			},
			check_email : function(email){
				var reg = /^([a-zA-Z0-9_-_.])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
				return reg.test(email)
			},
			check_idcard : function(idcard){
				var reg = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
				return reg.test(idcard)
			},
			length : function(str){
				return str.replace(/[^\x00-\xff]/g,'##').length;
			},
			str_count : function($obj){
				var limit = 70;
				var str_length = parseInt($($obj).val().length);
				if(str_length <= limit)
					$('.str_count').html(str_length+'/'+limit);
				else{
					$($obj).attr('value',$($obj).val().substring(0,limit));
					$('.str_count').html(limit+'/'+limit);
				}
			},
			checkbox_select_all : function(status,id){
				(status) ? $("[name='"+id+"']").attr("checked",'true') : $("[name='"+id+"']").removeAttr("checked");
			},
			get_check_value : function(id){
				var $value = [];
				$('input[name="'+id+'"]:checked').each(function(){
					$value.push($(this).val());
				});
				return $value.join(',');
			},
			get_input_value : function(id){
				var $value = [];
				$('input[name="'+id+'"]').each(function(){
					if( '' != $(this).val() )
					{
						$value.push($(this).val());
					}
				});
				return $value.join(',');
			},
			addFavorite : function(name,url){
				try{
					window.external.AddFavorite(url,name);
				}
				catch(e){
					(window.sidebar)?window.sidebar.addPanel(name,url,''):alert('请使用按键 Ctrl+d，收藏'+url);
				}
			},
			inputNumber : function(){
				$('.input-number').unbind('keyup').keyup(function(){
					$(this).attr('value',$(this).val().replace(/[^\d]/g,''));
				});
			},
			fixheight : function(a,b){
				var _a = $('.' + a).outerHeight();
				var _b = $('.' + b).outerHeight() + 40;
				var _h = Math.max(380,_b);
				$('.' + a).height(_h);
				location.hash = 'main';
			},
			message : function(o,msg){
				$('#' + o).siblings('.errmsg').remove();
				$('#' + o).parent().append('<p class="pub-table-close red errmsg"><span class="bug-icon"></span>' + msg + '</p>');
				$('#' + o).focus(function(){
					$('#' + o).siblings('.errmsg').remove();
				});
				return false;
			},
			form : function(options,callback){
				$('body').append("<div class='sui-modal-backdrop fade in' style='background:#000'><div style='margin-top: 20%' class='sui-loading loading-xxlarge'><i class='sui-icon icon-pc-loading'></i><br>努力加载中...</div></div>");
				$.ajax({type:'post', url:options.url, data:options.data, dataType:"json", success:function(d){
					$('.sui-modal-backdrop.fade.in').remove();
						callback(d);	
					}
				});
			},
			list_scroll : function(o,t){
				var ul = $("ul","."+o);
				setInterval(function(){
					var h = $('li',ul).eq(0).height();
					$('li',ul).eq(0).clone().appendTo(ul);
					ul.animate({
							marginTop:'-'+h+'px'
					},1000,function(){
							$(this).css({marginTop:"0px"}).find("li:first").remove();
					});
				},t);
			},
			mask : function(){
				var arr = new Array('mask-div');
				for(var i = 0; i < arr.length; i++){
			    $('.'+arr[i]).find(".mask-item").each(function (){
			      var curr_mask = $(this).find(".mask");
			      var siblings_mask = $(this).siblings().find(".mask");
			      var _wdith = curr_mask.width();
			      var _height = curr_mask.height();
			      $(this).hover(function() {
			        var _isdef = curr_mask.parent().attr('href');
			        if(typeof(_isdef) == "undefined" )
			        	curr_mask.css({width:0,height:0});
			        siblings_mask.stop().fadeTo("200", 0.3);
			    	},function(){
			        	var _isdef = curr_mask.parent().attr('href');
			        	if(typeof(_isdef) == "undefined" )
							curr_mask.css({width:_wdith,height:_height});
						siblings_mask.stop().fadeTo("200", 0);
					});
			    });
			  }
			},
			tab : function(obj){
				var o = $('.'+obj);
				var cl = 'curr';
				var nav_width=$('.nav',o).children().width();
				o.each(function(){
					var t = $('.nav li',$(this));
					var c = $('.box',$(this));
					t.eq(0).addClass(cl);
					c.eq(0).show().siblings('.box').hide();
					
					t.each(function(i){
						$(this).click(function(){
							t.eq(i).addClass(cl).siblings().removeClass(cl);
							$(this).closest('.nav').siblings().stop().animate({'left':''+nav_width*$(this).index()+'px'},500);
							c.eq(i).show().siblings('.box').hide();
						});
					});
				});
			},
			pager : function(options){
				var options = options || {};

				$(".pagination").pagination(options.total, {
				    callback: function(page_index){
						options.data.offset = options.pagesize;
						options.data.limit  = page_index;
						OO.loading($('.'+options.container));

						$.ajax({type:'get', url:options.url, data:options.data, dataType:"html", success:function(d){
								$('.'+options.container).html(d);
							}
						});
				    },
				    items_per_page : options.pagesize,
				});
			},
			upload : function(btn,status,type,save){
				new AjaxUpload($('.'+btn), {
					action: OO._SRVPATH+'common/upload?type='+type,
					name: 'uploadfile',
					responseType:'json',
					onSubmit: function(file, ext){
						 if ( 'image' == type && !(ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
							$('.'+status).html('仅支持 JPG, PNG or GIF 格式图片上传');
							return false;
						}
						$('#upimging').remove();
						$('.'+status).append('<span id="upimging">上传中，请稍等...</span>');
					},
					onComplete: function(file, $response){
						//Add uploaded file to list
						if($response.status===1){
							$('#upimging').remove();
							var li_num = $('.'+status).children('li').length+1;
							$('.'+status).append('<li><div onclick="closeLi(this);" data-src="'+$response.data.msg+'" class="close" title="删除"><i class="bug-icon"></i></div><img class="js-lightbox" data-role="lightbox" data-group="group-1" data-id="'+li_num+'" data-source="'+$response.data.url+'" src="'+$response.data.url+'" title="点击查看大图" /></li>');
							if($('#'+save).val() == ''){
								$('#'+save).attr('value',$response.data.msg);
							}else{
								$('#'+save).attr('value',$('#'+save).val()+','+$response.data.msg);
							}
						} else{
							$('.'+status).append('<span id="upimging" style="color:red">上传失败，请重试</span>');
						}
					}
				});
			},
			back2t : function(){
				var bt = '<div class="back2top"><a href="javascript:;" target="_self" title="返回顶部"></a></div>';
				$('body').append(bt);
				$(window).scroll(function(){
					i($('.back2top'));
				});
				var i=function(b){
				setTimeout(function(){$(window).scrollTop()==0?b.fadeOut():b.fadeIn()},200);
				}
				$(".back2top a").live("click",function(){$("html, body").animate({scrollTop:0},200)});
			},
			iframe : function(id){
				var frm = document.getElementById(id);
				var subWeb = document.frames ? document.frames[obj].document : frm.contentDocument;
				if(frm != null && subWeb != null)
					frm.height = (subWeb.body.scrollHeight < 300) ? 300 : subWeb.body.scrollHeight;
			},
			lazyload : function(){
				if($("img").length){
					$("img").lazyload({
						effect : "fadeIn"
					});
					$("img").lazyload({ threshold : 200 });
				}
			},
			loading : function($obj){
				$obj.html('<div style="text-align:center;padding-top:30px;font-size:15px;"><div class="sui-loading loading-inline"><i class="sui-icon icon-pc-loading"></i></div><br>努力加载中...</div>');
			},
			login : {
				init : function(){
					$("a").focus(function(){this.blur();});
					$(".login-btn").focus(function(){this.blur();});
					$('.wh').css('height',$(document).height()-$('.login-top').height()-$('.login').height()-$('.login-bottom').height() -20-2);
					$('.remember').click(function(){
						var $remember = parseInt($('#remember').val());
						if( 0 == $remember )
						{
							$(this).addClass('on');
							$('#remember').val('1');
						}
						else
						{
							$(this).removeClass('on');
							$('#remember').val('0');
						}
					});
					$('.login-btn').click(function(){
						OO.login.execute();
					});
				},
				execute : function(){
					var $account = $('#username').val();
					var _opts = {};
					var _data = {};

					_data.account = $account;
					_data.password = $.trim($('#password').val());
					_data.verifycode = $.trim($('#verifycode').val());
					_data.remember = $('#remember').val();

					if ( '' == $account )
					{
						$('.opt-msg').removeClass('suc').addClass('err').html('请输入您的手机号');
						$('#username').removeClass('nor').addClass('err');
						setTimeout(function(){
							$('.opt-msg').removeClass('err').html('');
							$('#username').removeClass('err').addClass('nor');
						},3000);
						return false;
					}
					else if( !OO.check_mobphone($account) )
					{
						$('.opt-msg').removeClass('suc').addClass('err').html('您输入的手机号不正确');
						$('#username').removeClass('nor').addClass('err');
						setTimeout(function(){
							$('.opt-msg').removeClass('err').html('');
							$('#username').removeClass('err').addClass('nor');
						},3000);
						return false;
					}
					else if ( '' == _data.password )
					{
						$('.opt-msg').removeClass('suc').addClass('err').html('请输入您的登录密码');
						$('#password').removeClass('nor').addClass('err');
						setTimeout(function(){
							$('.opt-msg').removeClass('err').html('');
							$('#password').removeClass('err').addClass('nor');
						},3000);
						return false;
					}
					else
					{
						if( OO.check_mobphone($account) )
						{
							_data.account_type = 'mobphone';
						}
						else if( OO.check_email($account) )
						{
							_data.account_type = 'email';
						}
						else
						{
							_data.account_type = 'username';
						}

						$('.opt-msg').removeClass('err').addClass('suc').html('登录中，请等待...');
						$('.login-btn').attr('disabled','true').val('登录中...');
						_opts.url = OO._SRVPATH + 'auth/checkLogin';
						_opts.data= _data;
						OO.form(_opts,function(d){
							if( 1 == d.status )
							{
								window.location.href = OO._SRVPATH;
							}
							else
							{
								$('.opt-msg').removeClass('suc').addClass('err').html(d.data.msg).show();
								$('.login-btn').removeAttr('disabled').val('登 录');
							}
						});
					}
				}
			},
			register : {
				init : function(){
					$("a").focus(function(){this.blur();});
					
					$('.reg-type').each(function(i){
						$(this).click(function(){
							var reg_type = $(this).attr('data-type');
							$(this).addClass('active').siblings().removeClass('active');
							$('.reg-form').eq(i).show().siblings('.reg-form').hide();
							$('#account_type').attr('value',reg_type);
						});
					});

					$('.sms-verify').click(function(){
						var mobphone = $.trim($('#mobphone').val());

						if( !OO.check_mobphone(mobphone) )
						{
							OO.message('mobphone','手机号码不正确');
						}
						else
						{
							var o = $(this);
							if(o.hasClass('bc1')){
								o.addClass('bc2').removeClass('bc1');
								var time_delay = 120;
								var timeID = setInterval(function(){
									if(time_delay < 0){
										clearInterval(timeID);
										o.addClass('bc1').removeClass('bc2');
										o.html('获取验证码');
									}
									else{
										o.html('剩余 '+time_delay+' 秒');
										time_delay = time_delay - 1;
									}
								},1000);
								
								$.ajax({type: 'post',url: OO._SRVPATH + 'common/smscode',data: {mobphone : mobphone},dataType: "json",success:function(d){
										if (d.status == 1)
										{
											//OO.message('verifycode','验证码已发送');
										}	
										else
											OO.message('verifycode',d.msg);
									}
								});
							}
						}
					})
					
					$('.btn').click(function(){
						OO.register.execute();
					});
				},
				execute : function(){
					var $account_type = $.trim($('#account_type').val());

					var _opts = {};
					var _data = {};
					_data.account_type = $account_type;

					if( 'mobphone' == _data.account_type )
					{
						_data.mobphone = $.trim($('#mobphone').val());
						_data.verifycode = $.trim($('#verifycode').val());
						_data.password = $.trim($('#mpassword').val());

						if( !OO.check_mobphone(_data.mobphone) )
						{
							return OO.message('mobphone','请输入正确的手机号码');
						}
						else if ( '' == _data.verifycode )
						{
							var ret = OO.message('verifycode','请输入短信验证码');
							$('.errmsg').css({'display':'block'});
							return ret;
						}
						else if ( '' == _data.password )
						{
							return OO.message('mpassword','请输入密码');
						}
						else if ( OO.length(_data.password) < 6 ||  OO.length(_data.password) > 16 )
						{
							return OO.message('mpassword','密码长度6~16位');
						}
					}
					else if( 'email' == $account_type )
					{
						_data.email = $.trim($('#email').val());
						_data.verifycode = $.trim($('#vcode').val());
						_data.password = $.trim($('#epassword').val());

						if( !OO.check_email(_data.email) )
						{
							return OO.message('email','请输入正确的邮箱地址');
						}
						else if ( '' == _data.password )
						{
							return OO.message('epassword','请输入密码');
						}
						else if ( OO.length(_data.password) < 6 ||  OO.length(_data.password) > 16 )
						{
							return OO.message('epassword','密码长度6~16位');
						}
						else if ( '' == _data.verifycode )
						{
							var ret = OO.message('vcode','请输入验证码');
							$('.errmsg').css({'display':'block'});
							return ret;
						}
					}
					else
					{
						$('.opt-msg').css({'color':'red'}).html('请选择注册类型！');
						setTimeout(function(){$('.opt-msg').html('');},3000);
						return false;
					}

					if( !$('#accept').is(":checked") )
					{
						$('.opt-msg').css({'color':'red'}).html('接受用户协议才可完成注册！');
						setTimeout(function(){$('.opt-msg').html('');},3000);
						return false;
					}

					$('.reg-button').attr('disabled','true').html('Loading...');
					_opts.url = OO._SRVPATH + 'auth/checkReg';
					_opts.data= _data;
					OO.form(_opts,function(status){
						if( 1 == status )
						{
							window.location.href = OO._SRVPATH + 'member';
						}
						else
						{
							$('.reg-button').removeAttr('disabled').html('注 册');
						}
					});
				}
			},
			usermenu : function(){
				var $cont = $('.user-main');

				$('.menu dd').each(function(){
					$(this).click(function(){
						$('.menu dl dd').removeClass('active');
						$(this).addClass('active')
						location.hash = 'main';
						var _u = $('a',$(this)).attr('url');
						$cont.load(OO._SRVPATH + _u);
					});
				});

				$('.menu dd').eq(0).addClass('active');
				var url = $('.menu dd a').eq(0).attr('url');

				OO.loading($cont);
				$cont.load(OO._SRVPATH + url);
			},
			logout : function(){
				$.ajax({
					type:'post',
					url:OO._SRVPATH+'auth/logout',
					dataType:"json",
					success:function(d) {
						if (d.status == 1)
							window.location.href = OO._SRVPATH + 'auth';
						else
							alert(d.msg);
					}
				});
			},
			search_wd : function(){
				var $wd = $('#wd');
				if ($wd.val() == '' || $wd.val() == '请输入关键字 支持模糊搜索') 
				{	
					alert('请输入搜索关键字!');
					$wd.focus();
				}
				else
					location.href = OO._SRVPATH + 'search/index&wd=' + unescape($wd.val()) + '&type=' + unescape($('#search_type').val());
			},
			encrypt : function(str) {//加密
			  var str = encodeURIComponent(str);
			  var pwd = Conf.STRPWS;
			  var prand = "";
			  for(var i=0; i<pwd.length; i++) {
			    prand += pwd.charCodeAt(i).toString();
			  }
			  var sPos = Math.floor(prand.length / 5);
			  var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
			  var incr = Math.ceil(pwd.length / 2);
			  var modu = Math.pow(2, 31) - 1;
			  if(mult < 2) {
			    alert("Algorithm cannot find a suitable hash. Please choose a different password. \nPossible considerations are to choose a more complex or longer password.");
			    return null;
			  }
			  var salt = Math.round(Math.random() * 1000000000) % 100000000;
			  prand += salt;
			  while(prand.length > 10) {
			    prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
			  }
			  prand = (mult * prand + incr) % modu;
			  var enc_chr = "";
			  var enc_str = "";
			  for(var i=0; i<str.length; i++) {
			    enc_chr = parseInt(str.charCodeAt(i) ^ Math.floor((prand / modu) * 255));
			    if(enc_chr < 16) {
			      enc_str += "0" + enc_chr.toString(16);
			    } else enc_str += enc_chr.toString(16);
			    prand = (mult * prand + incr) % modu;
			  }
			  salt = salt.toString(16);
			  while(salt.length < 8)salt = "0" + salt;
			  enc_str += salt;
			  return enc_str;
			},
			decrypt : function(str) {//解密
			  if(str == null || str.length < 8) {
			    alert("A salt value could not be extracted from the encrypted message because it's length is too short. The message cannot be decrypted.");
			    return;
			  }
			  var pwd = Conf.STRPWS;
			  var prand = "";
			  for(var i=0; i<pwd.length; i++) {
			    prand += pwd.charCodeAt(i).toString();
			  }
			  var sPos = Math.floor(prand.length / 5);
			  var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
			  var incr = Math.round(pwd.length / 2);
			  var modu = Math.pow(2, 31) - 1;
			  var salt = parseInt(str.substring(str.length - 8, str.length), 16);
			  str = str.substring(0, str.length - 8);
			  prand += salt;
			  while(prand.length > 10) {
			    prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
			  }
			  prand = (mult * prand + incr) % modu;
			  var enc_chr = "";
			  var enc_str = "";
			  for(var i=0; i<str.length; i+=2) {
			    enc_chr = parseInt(parseInt(str.substring(i, i+2), 16) ^ Math.floor((prand / modu) * 255));
			    enc_str += String.fromCharCode(enc_chr);
			    prand = (mult * prand + incr) % modu;
			  }
			  return decodeURIComponent(enc_str);
			},
			setCookie : function(keyname,value,expires){//存储cookie
				if ( typeof(expires) == 'undefined' || typeof(expires) == '' ) expires = -1;
				var options = {'expires':expires*1000};
				$.cookie.set(keyname,OO.encrypt(value),options);
			},
			getCookie : function(keyname){//获取cookie
				var strValue = $.cookie.get(keyname);
				var str = '';
				if(strValue != null){
					str = OO.decrypt(strValue);
				}
				return str;
			}
		}
})();

if ( ! $.cookie ){
	$.cookie = {
		set : function( $name , $value , $options ){
			$options = $.extend( {} , $options );
			if ( typeof($options.expires) == 'undefined' || typeof($options.expires) != 'number' ) $options.expires = -1;
			var $date = new Date();
			$date.setTime( $date.getTime() + $options.expires );
			var $expires = '; expires=' + $date.toUTCString();
			var $path = $options.path ? ';path=' + $options.path : ';path=/';
			var $domain = $options.domain ? ';domain=' + $options.domain : '';
			var $secure = $options.secure ? ';secure' : '';
			document.cookie = [$name , '=' , escape( $value ) , $expires , $path , $domain , $secure ].join('');
		},
		get : function( $name ){
			if ( document.cookie && document.cookie != '' ){
				var $arr = document.cookie.match( new RegExp( "(^| )"+$name+"=([^;]*)(;|$)" ) );
				if($arr != null){  
			        return unescape($arr[2]);  
			    }else{  
			        return null;  
			    }
			}
			return null;
		}
	}
}
