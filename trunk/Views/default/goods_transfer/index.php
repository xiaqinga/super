<style>
.nav-xlarge{
  margin-top: 10px;
  margin-bottom: 0px;
}
</style>

<ul class="sui-nav nav-tabs nav-xlarge">
  <li class="active" onclick="s_navclick('index');"><a>转让列表</a></li>
  <?php if (auth_check_permissions('goods_transfer_class/index')):?>
  <li onclick="s_navclick('goods_transfer_class');"><a>转让分类</a></li>
  <?php endif;?>
</ul>
<div class="content-top ">
	<form class="sui-form" id="search">
	 <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="customerName">会员昵称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="linkMan">联系人</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="goodsName">物品名称</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>goods_transfer/index" class="sui-btn btn-large btn-primary">查询</button>

    </div>
	</form>
</div>
<div class="goods_transfer-list">
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
_pagedata.url = "goods_transfer/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_transfer-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  //选项卡
  function s_navclick(url)
  {
    if(url == "index"){
      SAYIMO.go_url("<?php echo APP_URL;?>goods_transfer/index");
    }
    if(url == "goods_transfer_class"){
     SAYIMO.go_url("<?php echo APP_URL;?>goods_transfer_class/index");
    }

  }

  $('#search').on('click','.sui-dropdown-menu li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
  })
  $('#search').on('click','.sui-dropdown-menu li:eq(1)',function(){
    $("#key").attr('type','show');
    $("#key").val('');
  })

  $('#search').on('click','.sui-dropdown-menu li:eq(2)',function(){
    $("#key").attr('type','show');
  })
$('#search').on('click','.sui-dropdown-menu li:eq(3)',function(){
  $("#key").attr('type','show');
})
</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'activityName':
      return "名称";
      break;
    case 'identifier':
      return '标识符';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'activityName':
      return 'text';
      break;
    case 'identifier':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>