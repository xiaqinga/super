<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<input type="text" id="accout" name="accout" placeholder="会员账号" class="input-xlarge input-fat" value="<?php echo $accout;?>">
			<button type="submit" id="search-bn" data-url="customerperformance/index" class="sui-btn btn-large btn-primary">查询</button>
		</div>
	</form>
</div>
<div class="customerperformance-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var accout = $("#accout").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "customerperformance/ajaxIndex?accout="+accout+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.customerperformance-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>