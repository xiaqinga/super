/**
 * fileName:sayimo.js
 * since:2015.12.20
 * author yinjh<janhve@163.com>
 */

$(function(){
	OO.init();
	
	SAYIMO.init();
	
});

var SAYIMO = (function(){
		return {			
			_MAINCONT : $('#mainInfo'),


			init : function(){
				SAYIMO.fixheight();
				SAYIMO.optbtn();
		
			},

			
			fixheight : function(){
				var _fix_h = $(window).height() - $('.sui-navbar').height() -$('.footer').height();
				/*var _m_fix_h = _fix_h-10;
				$('#sideNav').css('height',_fix_h + 'px');
				$('#sideNav1').css('min-height',_m_fix_h + 'px');*/
				$('#mainInfo').css('height',(_fix_h - 10) + 'px');
				$(window).resize(SAYIMO.fixheight);
			},
			menu : function(n,d){
				var _main = $('#mainInfo');
				var _nav = $('.sidebar');
				var _navlist = '';
				if(n == '首页'){
					_nav.html('');
					$('#sideNav').css('height',0);
					$('#sideNav1').css('min-height',0);
					OO.loading(_main);
					_main.load(OO._SRVPATH + 'index/home');
				}else{
					var url = OO._SRVPATH + 'common/getAllMenu';
					var data = {'parentId':d};
					var menudata = '';
					$.ajax({type:'post', url:url, data:data, dataType:"json", async:false,
						success:function(data){
							menudata = data;
						}
				});
				_navlist += '<div class="nav-header">'+n+'</div>';
				_navlist += '<ul class="sui-nav nav-list nav-xlarge nav-left" id="sideNav1">';
					var _i = 0;
					$.each(menudata,function(idx,val){
						var _cls = ( 0 == _i ) ? ' class="topli active"' : '';
						_navlist += '<li'+_cls+'><a href="javascript:;" data-ref="'+val.url+'">'+val.name+'</a></li>';
						_i++;
					});
					_navlist += '</ul>';
					_nav.html(_navlist);
					var _fix_h = $(window).height() - $('.sui-navbar').height() -$('.footer').height();
					var _m_fix_h = _fix_h-50;
					$('#sideNav').css('height',_fix_h + 'px');
					$('#sideNav1').css('min-height',_m_fix_h + 'px');
					$('a', _nav).each(function(index){
						$(this).click(function(){
							_url = $(this).attr('data-ref');
							OO.loading(_main);
							_main.load(OO._SRVPATH + _url);
							$(this).parent().addClass('active').siblings().removeClass('active');
						});
					});				
	
					var _url = $('a', _nav).eq(0).attr('data-ref');
					
					OO.loading(_main);
					_main.load(OO._SRVPATH + _url);
				}
			},
			optbtn : function(){
				$('a').each(function(){
					$(this).click(function(){
						if(typeof($(this).attr('data-url')) != 'undefined')
						{
							OO.loading(SAYIMO._MAINCONT);
							SAYIMO._MAINCONT.load($(this).attr('data-url'));
						}
					});
				});
			},
			go_url : function(url){
					OO.loading(SAYIMO._MAINCONT);
					SAYIMO._MAINCONT.load(url);
			},
			/**
			 * [对话框远程加载页面]
			 * @param  {[string]} dialog_id   [自定义对话框ID名]
			 * @param  {[string]} title       [自定义对话框标题名称]
			 * @param  {[string]} click_btn   [触发弹窗按钮ID名]
			 * @param  {[string]} remote_url  [远程页面URl]
			 * @param  {[string]} dialog_list [远程页面列表中,添加按钮样式名]
			 * @param  {[object]} callback [添加成功, 回调函数]
			 * @return {[string]}             [null]
			 */
			dialogView : function(dialog_id,title,click_btn,remote_url,dialog_list,callback){
				//sui对话框开始
				SAYIMO._MAINCONT.append('<div id="'+dialog_id+'" tabindex="-1" role="dialog" class="sui-modal hide fade">'+
																  '<div class="modal-dialog">'+
																    '<div class="modal-content">'+
																      '<div class="modal-header">'+
																        '<button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>'+
																        '<h4 id="myModalLabel" class="modal-title">'+title+'浏览器</h4></div>'+
																      '<div class="modal-body sui-form form-horizontal">'+
																      '</div>'+
																    '</div>'+
																  '</div>'+
																'</div>');
				//触发弹出sui对话框
				$("#"+click_btn).bind("click",function(){
				  $('#'+dialog_id).modal({
				    remote: OO._SRVPATH + remote_url,
				    width: 'large',
				  })
				})
				//sui对话框,添加图文
				$('#'+dialog_id).on('click', '.'+dialog_list, function(e) {
				  _cur = $(this);
				  $('#'+dialog_id).modal('shadeIn');
				  return $.confirm({
				    title: '确认',
				    body: '确认添加该'+title+'吗？',
				    backdrop: false,
				    okHide: function() {
				    	if(callback!==null){
				    		callback(_cur);
				    	}
				      $('#'+dialog_id).modal('hide'); 
				    },
				    hide: function() {
				       return $('#'+dialog_id).modal('shadeOut');
				    }
				  });
				});

			},		
			showHiddenSidebar : function(d){
				switch(d){
					case 'show': 
					$('#sideNav1').show();
					$('.left-slip').show();
					$('.right-slip').hide();
			    	break;
			    	case 'hidden': 
					$('#sideNav1').hide();
					$('.left-slip').hide();
					$('.right-slip').show();
			    	break;
			    	default: $('#sideNav1').show();
					$('.left-slip').show();
					$('.right-slip').hide();
					break;
				}
			},
			check_value : function(form,rmsg,msg,type){
				var value = $("#"+form).val();
				if(!$.trim(value)){
						OO.message(form,rmsg);
						return false;
				}else{
					var checkname = true;
					switch(type)
					{
						case 'mobphone':
							checkname = OO.check_mobphone($.trim(value));
							break;
						case 'idcard':
							checkname = OO.check_idcard($.trim(value));
							break;
						case 'email':
							checkname = OO.check_email($.trim(value));
							break;
						case 'password':
							var reg = /.*[\u4e00-\u9fa5]+.*$/
							checkname = !reg.test($.trim(value));
							break;
						case 'ischn':
							var reg = /^[\u4E00-\u9FA5]+$/; 
							checkname = reg.test($.trim(value));
							break;
						case 'isen':
							var reg = /^[a-zA-Z]+$/; 
							checkname = reg.test($.trim(value));
							break;
						case 'isennumxhx':
							var reg = /^[0-9a-zA-Z_]+$/; 
							checkname = reg.test($.trim(value));
							break;
					}
					if(!checkname){
						OO.message(form,msg);
						return false;
					}
				}
				return true;
			},
			remote : function(data){
				var _opts = {};
				_opts.url = OO._SRVPATH + 'auth/checkexist';
				_opts.data = data;
				return SAYIMO.form.remote(_opts);
			},
			form : {
				init : function(form, opts, submitBefore){
					$(form).validate({
						success: function(){
							if(typeof(submitBefore)!="undefined"){
								if(!submitBefore()){
									return false;
								}
							}
							if('' == $.trim(opts.tree)){
								opts.data = $(form).serialize();
							}else{
								var tree_data = $(opts.tree).data('tree').datas;
								opts.data = $(form).serialize()+"&"+opts.tree_name+"="+tree_data.value;
							}
							OO.form(opts,function(d){
							    if( 1 == d.status )
							    {
							      $.alert({title: '提示', body: d.data.msg,
							        hidden: function(e){
							          OO.loading(SAYIMO._MAINCONT);
							          SAYIMO._MAINCONT.load(unescape(d.data.ref));
							        }
							      });
							    }
							    else
							    {
							      $.alert({title: '提示',body: d.data.msg});
							    }
							});
							return false;
						},
						fail: function(){
							if(typeof(opts.failFun)!="undefined"){
								opts.failFun();
							}
						}
					});
				},
				rule : function(rulename, data, message){
					$.validate.setRule(rulename, function(value, element, param){
						switch(data.opt)
						{
							case 'mobphone':
								var reg = /^1[3|4|5|7|8]\d{9}$/;
								return reg.test($.trim(value));
								break;
							case 'enname':
								var reg = /^[a-zA-Z]+$/
								return reg.test($.trim(value));
								break;
							case 'password':
								var reg = /.*[\u4e00-\u9fa5]+.*$/
								return !reg.test($.trim(value));
								break;
							case 'isennumxhx':
								var reg = /^[0-9a-zA-Z_]+$/; 
								return reg.test($.trim(value));
								break;
							case 'remote':
								var _opts = {};
								_opts.url = OO._SRVPATH + data.url;
								_opts.data = data;
								_opts.data.id = $('#id').val();
								_opts.data.value = value;
								return SAYIMO.form.remote(_opts);
								break;
						}
					}, message);
				},
				tree : function(form,data){
					$(form).tree({
				          src : OO._SRVPATH + 'service/getcity',
				          placeholder : '-- 请选择 --',
				          val : data,
				          jsonp : false
				      });
				},
				remote : function(options){
					var _exist = 0;
					$.ajax({type:'post', url:options.url, data:options.data, dataType:"json", async:false,
						success:function(d){
							_exist = d.status;
						}
					});
					return ( 0 == _exist ) ? false : true;//false存在，true不存在
				},
				search : function(form){
					$(form).each(function(){
						$(this).click(function(){
							var data = $(this).closest('form').serialize();
							if(typeof($(this).attr('data-url')) != 'undefined')
							{
								OO.loading(SAYIMO._MAINCONT);
								SAYIMO._MAINCONT.load($(this).attr('data-url')+'?'+data);
							}
							return false;
						});
					});
				},
				/**
				 * [view_search 弹框中按关键字查询加载]
				 * @param  {[object]} obs [DOM元素对象组]
				 * @return {[HTML]}
				 */
				view_search : function(obs){
					$(obs.btn).each(function(){
						$(this).click(function(){
							var data = $('#viewsearch').serialize();
							if(typeof($(this).attr('data-url')) != 'undefined')
							{
					      var container = $(obs.modal_body);
					      OO.loading(container);
								container.load(OO._SRVPATH+$(this).attr('data-url')+'?'+data);
							}
							return false;
						});
					});
				},
				optbtn : function(form,options){
					$(form).each(function(){
						$(this).click(function(){
							if('' == $.trim(options.data)){
								options.data = 'ids='+$(this).attr('data-id');
							}
							$.ajax({type:'post', url:options.url, data:options.data, dataType:"json", async:false,
								success:function(d){
									if( 1 == d.status )
									{
										$.alert({title: '提示', body: d.data.msg,
										hidden: function(e){
										  OO.loading(SAYIMO._MAINCONT);
										  SAYIMO._MAINCONT.load(unescape(d.data.ref));
										}
										});
									}
									else
									{
										$.alert({title: '提示',body: d.data.msg});
									}
								}
							});
						});
					});
				},
				confirm :function(form,options){
					$(form).each(function(){
					 $(this).click(function(){
						options.bodyurl = $(this).attr('data-rem');
					    $.confirm({
					    	title:options.title,
					    	body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
					      remote:options.bodyurl,
					      width: 'large',
					      okHide: function() {
					      	var isOk = false;
					      	if('' == $.trim(options.data)){
								if('' == $.trim(options.formdata)){
									options.data = '';
								}else{
									options.data = $(options.formdata).serialize();
								}
							}
					      	$.ajax({type:'post', url:options.url, data:options.data, dataType:"json", async:false,
								success:function(d){
									if( 1 == d.status )
								    {
								      $.alert({title: '提示', body: d.data.msg,
								        hidden: function(e){
								          OO.loading(options.form);
								          options.form.load(unescape(d.data.ref));
								        }
								      });
								      isOk = true;
								    }
								    else
								    {
								      $.alert({title: '提示',body: d.data.msg});
								    }
								}
							});
						    return isOk;
					      }
					    });
					  });
					});
				},
				dialog :function(form,options){
					$(form).each(function(){
					 $(this).click(function(){
					 	var width = 'small';
						if(''==$.trim(options.body)){
							options.bodyurl = $(this).attr('data-rem');
							$.ajax({type:'post', url:options.bodyurl, data:options.bodydata, dataType:"html",async:false, success:function(d){
									width = 'large';
									options.body = d;
								}
							});
						}
						if('' == $.trim(options.data)){
							if('' == $.trim(options.formdata)){
								options.data = 'ids='+$(this).attr('data-id');
							}else{
								options.data = $(options.formdata).serialize();
							}
						}

					    $.confirm({
					    	title:options.title,
					      body: options.body,
					      width: width,
					      okHide: function() {
					      	var isOk = false;
					      	$.ajax({type:'post', url:options.url, data:options.data, dataType:"json", async:false,
								success:function(d){
									if( 1 == d.status )
								    {
								      $.alert({title: '提示', body: d.data.msg,
								        hidden: function(e){
								          OO.loading(options.form);
								          options.form.load(unescape(d.data.ref));
								        }
								      });
								      isOk = true;
								    }
								    else
								    {
										$.alert({title: '提示', body: d.data.msg,
											hidden: function(e){
												//OO.loading(options.form);
												//options.form.load(unescape(d.data.ref));
											}
										});
										options.data='';
										isOk = true;


								     // $.alert({title: '提示',body: d.data.msg,hidden: function(e){}});
								    }

								}
							});
						      return isOk;
					      }
					    });
					  });
					});
				},
			},
			pagination : function(options){
				if(parseInt(options.page) >1){
					$(options.labelname).pagination({
						currentPage: options.page,
					    itemsCount: options.total,
					    pageSize: options.pagesize,
					    styleClass: ['pagination-large'],
					    showCtrl: true,
					    displayPage: 6,
					    onSelect: function (num) {
					        	var container = $(options.container);
					        	OO.loading(container);
						container.load(OO._SRVPATH+options.url+num);
					    }    
					});
				}else{
					$(options.labelname).pagination({
					    itemsCount: options.total,
					    pageSize: options.pagesize,
					    styleClass: ['pagination-large'],
					    showCtrl: true,
					    displayPage: 6,
					    onSelect: function (num) {
					        	var container = $(options.container);
					        	OO.loading(container);
						container.load(OO._SRVPATH+options.url+num);
					    }    
					});
				}
				if(parseInt(options.page) >=1){
					var container = $(options.container); //首次加载页面
					OO.loading(container);
					container.load(OO._SRVPATH+options.url+options.page);
				}
			},
			editor :{
				init : function(form){
					form = $('#'+form).editor({textarea:form}); 
				},
				setContent : function(form,html,isAppendTo) {
			      	form.editor('setContent', html, isAppendTo)
				}
			}
		}
})();