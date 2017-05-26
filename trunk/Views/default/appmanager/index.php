<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnamelist[$searchname]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="" onclick="hideSearch('');">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="mobileSysType" onclick="hideSearch('mobileSysType');">操作系统</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="version" onclick="hideSearch('version');">版本</a></li>
	          </ul></span></span>
			<input type="text" id="version" name="version" placeholder="版本" class="input-xlarge input-fat" value="<?php echo $version;?>" style="<?php echo ($searchname == 'version' && !empty($searchname))?'':'display:none';?>">
			<span class="sui-dropdown dropdown-bordered select" id="mobileSysTypeSelect" style="<?php echo ($searchname == 'mobileSysType')?'':'display:none';?>"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	          <input value="<?php echo ($mobileSysType)?$mobileSysType:''?>" name="mobileSysType" id="mobileSysType" type="hidden"><i class="caret"></i><span><?php echo ($mobileSysType)?$mobileSysTypelist[$mobileSysType]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">Android</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">IOS</a></li>
	          </ul></span></span>
			<button type="submit" id="search-bn" data-url="appmanager/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加APP','check'=>'appmanager/add','class'=>'btn-large','url'=>APP_URL.'appmanager/edit?ref='.$ref));?>
			<?php echo form_a_auth(array('content'=>'添加WEB','check'=>'appmanager/addWeb','class'=>'btn-large','url'=>APP_URL.'appmanager/addWeb?ref='.$ref));?>

		</div>
	</form>
</div>
<div class="appmanager-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var searchname = $("#searchname").val();
var mobileSysType = $("#mobileSysType").val();
var version = $("#version").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "appmanager/ajaxIndex?searchname="+searchname+"&mobileSysType="+mobileSysType+"&version="+version+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.appmanager-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
function hideSearch(name){
	if(name == 'mobileSysType'){
		$('#version').hide();
		$('#mobileSysTypeSelect').show();
	}else if(name == 'version'){
		$('#version').show();
		$('#mobileSysTypeSelect').hide();
	}else{
		$('#version').hide();
		$('#mobileSysTypeSelect').hide();
	}
}
</script>