<style>
.sui-nav.nav-tabs.tab-wraped > li{
	width:100px;
}
.sui-nav.nav-tabs.tab-wraped > li.active > a {
	padding-top: 2px;
}
.sui-nav.nav-tabs.tab-wraped > li > a {
    padding: 4px;
}
</style>
<ul class="sui-nav nav-tabs tab-wraped">
	
	<li><a href="javascript:;" data-url="<?php echo APP_URL.'customerorders/index';?>" data-toggle="tab">
      <h3 style="font-size: 14px;line-height: 0;">金商城</h3>
     </a>
    </li>
   
    <li class="active"><a href="javascript:;" data-toggle="tab" style="border-right: 1px solid #ddd;">
      <h3 style="font-size: 14px;line-height: 0;">银商城</h3>
     </a>
   </li>
 
   
    <li><a href="javascript:;" data-url="<?php echo APP_URL.'customerorders/indexbusiness';?>" data-toggle="tab" style="border-right: 1px solid #ddd;">
      <h3 style="font-size: 14px;line-height: 0;">商企订单</h3>
     </a>
   </li>
  
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<input type="text" id="accout" name="accout" placeholder="会员账号" class="input-xlarge input-fat" value="<?php echo $accout;?>">
			<button type="submit" id="search-bn" data-url="customerorders/indexsilver" class="sui-btn btn-large btn-primary">查询</button>
		</div>
	</form>
</div>
<div class="customerorders-list">
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
_pagedata.url = "customerorders/ajaxIndexsilver?accout="+accout+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.customerorders-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>