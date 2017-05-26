<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
    商品名称:<input placeholder="" class="input-xlarge input-fat" type="text" id="goodsName" name="goodsName" value="<?php echo $goodsName;?>">
			&nbsp;&nbsp;&nbsp;供应商：
      <span class="sui-dropdown dropdown-bordered select downlist_providerList"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span><?php echo $providerlist[$providerId]?$providerlist[$providerId]:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <?php foreach ($providerlist as $key => $value) :?>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $key;?>"><?php echo $value;?></a></li>
		<?php endforeach;?>

        </ul></span></span>
			&nbsp;&nbsp;&nbsp;
		<button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>goods_brokerage/index" class="sui-btn btn-large btn-primary">查询</button>
	
		</div>
	</form>
</div>
<div class="goods_brokerage-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>

<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var providerId = $("#providerId").val();
var goodsName = $("#goodsName").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goods_brokerage/ajaxIndex?providerId="+providerId+"&goodsName="+goodsName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_brokerage-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

