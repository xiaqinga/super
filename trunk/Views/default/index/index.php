<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<title><?php echo APP_NAME;?></title>
		<link rel="shortcut icon" href="<?php echo WWW_RES_URL;?>favicon.ico"/>
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/sui.min.css" />
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/sui-append.min.css" />
		<link rel="stylesheet" href="<?php echo ASSETS_URL;?>css/base.css" />
		<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/jquery-1.12.0.min.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sui.min.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/base.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
	    <script type="text/javascript" src="<?php echo ASSETS_URL;?>js/highcharts.js" ></script>
	</head>
	<body>
		<div class="sui-navbar">
			<div class="navbar-inner">
		    <ul class="sui-nav">
		    	<?php if(count($topmenulist)>0){?>
		    		<?php foreach($topmenulist as $tmval){?>
		    			<li class="<?php echo $tmval['style'];?>"  onclick="SAYIMO.menu('<?php echo $tmval['name'];?>','<?php echo $tmval['id'];?>');"><a href="javascript:;"><?php echo $tmval['name'];?></a></li>
		    	<?php }}?>
		    </ul>
		    <div class="sui-nav positionBar pull-right">
		      <div class="menuControl"><?php echo INDEX_TITLE;?></div>
		      <ul class="official_link">
		      	<li class="a"><img class="mi mi_16 mt-3" src="<?php echo ASSETS_URL;?>images/default/icon_contact.png">欢迎您，<?php echo $name;?> ！ </li>
		      	<li>|</li>
		      	<li class="a" onclick="SAYIMO.menu('首页','2');"><img class="mi mi_16 mt-3" src="<?php echo ASSETS_URL;?>images/default/home.png">首页</li>
		      	<li>|</li>
		      	<li class="a" onclick="setPassWord();"><img class="mi mi_16 mt-3" src="<?php echo ASSETS_URL;?>images/default/updatepassword.png">密码修改</li>
		      	<li>|</li>
		      	<li class="a" onclick="logout();"><img class="mi mi_14 mt-3" src="<?php echo ASSETS_URL;?>images/default/exit.png">退出</li>
		      	<div style="clear:both;"></div>
		      </ul>
		    </div>
		  </div>
		</div>
		<div class="sui-layout">
		  <div class="sidebar" id="sideNav">
		    
		    
		  </div>
		
		  <div class="content">

			  <div class="content-main" id="mainInfo"></div>
		  </div>
		</div>
		<div class="footer">
			<div class="copyright">&copy;2008-2028 <a target="_blank" class="fw_b" href="">ShangYiID</a>, Powered by <span class="fc_b fw_b">ShangYiID</span></div>
		</div>
	<!--<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/auth/index.js"></script>-->
	
	<!-- alpha div -->
	<div id="maskLayer" style="display:none">
	<iframe id="maskLayer_iframe" frameBorder=0 scrolling=no style="filter:alpha(opacity=50)"></iframe>
	<div id="alphadiv" style="filter:alpha(opacity=50);-moz-opacity:0.5;opacity:0.5"></div>
	  <div id="drag">
	    <h3 id="drag_h"></h3>
	    <div id="drag_con"></div><!-- drag_con end -->
	  </div>
	</div>
	<div id="sublist" style="display:none"></div>
	<!-- alpha div end -->

		



	</body>
</html>
<script type="text/javascript">
$(function(){
    SAYIMO.menu('首页','2');
});
function setPassWord(){
	$.confirm({
    	title:'修改密码',
    	body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
    	remote:OO._SRVPATH+'index/editpassword',
    	width: '550px',
    	height: '150px',
    	okHide: function() {
    		$('#savenewpassword').click();
    		var isok=false;
    		return isok;
    	}
	});
}
function logout(){
	$.ajax({type:'post', url:OO._SRVPATH+'auth/logout', data:'', dataType:"json", async:false,
		success:function(d){
			if( 1 == d.status )
		    {
		      $.alert({title: '提示', body: d.data.msg,
		        hidden: function(e){
		          location.reload();
		        }
		      });
		    }
		    else
		    {
		      $.alert({title: '提示',body: '退出失败'});
		    }
		}
	});
}
</script>
