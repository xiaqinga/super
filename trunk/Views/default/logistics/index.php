<ul class="sui-nav nav-tabs nav-large nav-primary" style="margin-top: 10px;">
  <li class="active"><a>运费列表</a></li>
   <?php if (auth_check_permissions('logistics/strategy')):?>
  <li><a href="javascript:;" data-url="<?php echo APP_URL.'logistics/strategy'?>">运费策略配置</a></li>
  <?php endif;?>
   <?php if (auth_check_permissions('logistics/courier')):?>
  <li><a href="javascript:;" data-url="<?php echo APP_URL.'logistics/courier'?>">快递公司列表</a></li>
  <?php endif;?>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnamelist[$searchname]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="" onclick="hideSearch('');">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="logisticsName" onclick="hideSearch('logisticsName');">运费模板名称</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="expressCompanyName" onclick="hideSearch('expressCompanyName');">快递公司</a></li>
	          </ul></span></span>
			<input type="text" id="name" name="name" placeholder="运费模板名称/快递公司" class="input-xlarge input-fat" value="<?php echo $name;?>"style="<?php echo (!empty($searchname))?'':'display:none';?>">
			<button type="submit" id="search-bn" data-url="logistics/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加运费规则','class'=>'btn-large','url'=>APP_URL.'logistics/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="logistics-list">
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
var name = $("#name").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "logistics/ajaxIndex?searchname="+searchname+"&name="+name+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.logistics-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
function hideSearch(name){
	if(name == 'logisticsName'){
		$('#name').show();
	}else if(name == 'expressCompanyName'){
		$('#name').show();
	}else{
		$('#name').hide();
	}
}
</script>