<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="userName" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span>姓名</span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="userName">姓名</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout">账号</a></li>
	          </ul></span></span>
			<input type="text" id="name" name="name" placeholder="名称" class="input-xlarge input-fat" value="<?php echo $name;?>">
			<button type="submit" id="search-bn" data-url="user/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加用户','check'=>'user/add','class'=>'btn-large','url'=>APP_URL.'user/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="user-list">
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
_pagedata.url = "user/ajaxIndex?searchname="+searchname+"&name="+name+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.user-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>