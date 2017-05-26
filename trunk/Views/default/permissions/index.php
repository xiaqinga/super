<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<input type="text" id="permissionsName" name="permissionsName" placeholder="权限名称" class="input-xlarge input-fat" value="<?php echo $permissionsName;?>">
			<button type="submit" id="search-bn" data-url="permissions/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加权限','check'=>'permissions/add','class'=>'btn-large','url'=>APP_URL.'permissions/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="permissions-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var permissionsName = $("#permissionsName").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "permissions/ajaxIndex?permissionsName="+permissionsName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.permissions-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>