<style>
	.trbg{
		background-color: #f0f0f0;
	}
</style>
<div class="content-top">
	<label for="inputEmail" class="control-label">商品名称：</label>
	<div class="controls">
      <input type="text" id="goodsName" name="goodsName" class="input-xlarge input-fat" placeholder="商品名称" value="<?php echo $goodsName;?>">
      <button type="submit" id="search-bn1" data-url="goodsindex/goods" class="sui-btn btn-large btn-primary">查询</button>
    </div>
</div>
<div class="goods-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<?php echo assets::$sayimo; ?>
<script type="text/javascript">
$(function(){
	var _classopt = {};
	_classopt.btn = '#search-bn1';
	_classopt.modal_body = '#goodslist';
	SAYIMO.form.view_search(_classopt);
});
var goodsName = $("#goodsName").val();
var relId = $("#actionrelId").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goodsindex/ajaxGoods?relId="+relId+"&goodsName="+goodsName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>