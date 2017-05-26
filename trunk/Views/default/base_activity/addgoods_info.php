<style>
.sui-nav.nav-primary{
  margin-bottom: 0px;
}
.load-wrapper{
  margin-top: 30px;
}
.sui-btn.goback-btn {
  background: transparent;
}
.sui-breadcrumb{
  margin:0px;
}
</style>
<ul class="sui-breadcrumb">
    <li class="active">活动管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-primary">
  <li onclick="s_navclick('edit');"><a>基本信息</a></li>
  <li class="active" onclick="s_navclick('addgoods');"><a>添加商品</a></li>
</ul>

<div class="content-top ">
	<form class="sui-form" id="search">
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <input type="hidden" name="goodsIds" id="goodsIds" value="<?php echo $goodsIds;?>">
  <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >

  <span class="sui-dropdown dropdown-bordered select">
    <span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
      <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
      <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="goodsName">商品名称</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerId">供应商名称</a></li>
      </ul>
    </span>
  </span>

  <span class="sui-dropdown dropdown-bordered select downlist_providerList" style="<?php if($key_type =='providerId'){ echo "display: ;"; }else{ echo "display: none;"; }?>">
    <span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
      <input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span id="providerNameHtml"><?php echo $providerId?trim($providerList[$providerId]):'按供应商';?></span></a>
      <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
      <?php foreach ($providerList as $k => $v) :?>
        <li role="presentation"><a onclick="changeKeyValue(<?php echo $k;?>);" role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $k;?>"><?php echo $v;?></a></li>
      <?php endforeach;?>
      </ul>
    </span>
  </span>

  <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
  <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_activity/addgoods" class="sui-btn btn-large btn-primary">查询</button>

	</form>
</div>

<div class="base_activity-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
  <div align="center">
    <button type="button" class="sui-btn btn-xlarge " onclick="s_navclick('edit');">上一步</button>
  </div>
<script type="text/javascript">
//查找
$(function(){
	SAYIMO.form.search("#search-bn");
});
var key_type = $("#key_type").val();
var key = $("#key").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_activity/ajaxaddgoods_info?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>&key_type="+key_type+"&key="+encodeURIComponent(key)+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_activity-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

function s_navclick(url)
{ 
  $(".sui-nav.nav-tabs").removeClass('active');
  if(url=='edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }
  if(url == 'addgoods'){
    $(".sui-nav.nav-tabs").eq(1).addClass('active');
  }
  SAYIMO.go_url("<?php echo APP_URL;?>base_activity/"+url+"?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>");
}

$('#search').on('click','.sui-dropdown-menu li:eq(0)',function(){
  $("#key").attr('type','show');
  $("#key").val('');
  $(".downlist_providerList").hide();
})

$('#search').on('click','.sui-dropdown-menu li:eq(1)',function(){
  $("#key").attr('type','hidden');
  $(".downlist_providerList").show();
})

function changeKeyValue (n) {
  $("#key").val(n);
}

$(function(){
  //供应商对话框远程加载页面
  //对话框回调函数
  var goods_callback = function(o){

  }
  SAYIMO.dialogView('js_add_goods','商品','tirgger_goods_btn','base_activity/viewGoods?goodsType=<?php echo $goodsType;?>&goodsIds='+$("#goodsIds").val(),'js_btn_item_disabled',goods_callback);

  //重新加载对话框内容
  $("#js_add_goods").on("hidden", function() {  
      $(this).removeData("modal");  
  });  
});

</script>
<?php echo assets::$sayimo; ?>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'goodsName':
      return "商品名称";
      break;
    case 'providerId':
      return '供应商名称';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'goodsName':
      return 'text';
      break;
    case 'providerId':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>