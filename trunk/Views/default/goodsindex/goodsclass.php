<style>
	.trbg{
		background-color: #f0f0f0;
	}
</style>
<div class="content-top">
	<label for="inputEmail" class="control-label">商品分类名称：</label>
	<div class="controls">
      <input type="text" id="className" name="className" class="input-xlarge input-fat" placeholder="商品分类名称" value="<?php echo $className;?>">
      <button type="submit" id="search-bn" data-url="goodsindex/goodsclass" class="sui-btn btn-large btn-primary">查询</button>
    </div>
</div>
<div class="goods_class-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="goods_class-page"></div>
<?php }?>
<?php echo assets::$sayimo; ?>
<script type="text/javascript">
$(function(){
	var _classopt = {};
	_classopt.btn = '#search-bn';
	_classopt.modal_body = '#goodsclasslist';
	SAYIMO.form.view_search(_classopt);
});
var className = $("#className").val();
var relId = $("#actionrelId").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goodsindex/ajaxGoodsclass?relId="+relId+"&className="+className+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_class-list';
_pagedata.labelname = '.goods_class-page';
SAYIMO.pagination(_pagedata);
</script>