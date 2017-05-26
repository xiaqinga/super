<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<input type="text" id="templateName" name="templateName" placeholder="模板名称" class="input-xlarge input-fat" value="<?php echo $templateName;?>">
			<button type="submit" id="search-bn" data-url="role/index" class="sui-btn btn-large btn-primary">查询</button>
		<!--	<?php /*echo form_a_auth(array('content'=>'添加模板','class'=>'btn-large','url'=>APP_URL.'goodsindex/edit?ref='.$ref));*/?>
		--></div>
	</form>
</div>
<div class="goodsindex-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var templateName = $("#templateName").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goodsindex/ajaxIndex?templateName="+templateName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goodsindex-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>