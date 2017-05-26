<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="normsName">规格名称</a></li>
        </ul></span></span>
			<input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
			<button type="submit" id="search-bn" data-url="goods_norms_name/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加','check'=>'goods_norms_name/add','class'=>'btn-large','url'=>APP_URL.'goods_norms_name/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="goods_norms_name-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>

<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var key_type = $("#key_type").val();
var key = $("#key").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goods_norms_name/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_norms_name-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

<script type="text/javascript">
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
  })
</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'normsName':
      return '规格名称';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'normsName':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>