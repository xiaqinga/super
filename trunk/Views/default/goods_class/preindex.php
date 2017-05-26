<ul class="sui-nav nav-tabs nav-xlarge">
  <?php if (auth_check_permissions('goods_class/index')):?>
  <li onclick="s_navclick('index');"><a>普通商品分类</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('goods_class/preindex')):?>
  <li class="active" onclick="s_navclick('preClss');"><a>预约商品分类</a></li>
  <?php endif;?>
</ul>
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="className">分类名称</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <button type="submit" id="search-bn" data-url="goods_class/preindex" class="sui-btn btn-large btn-primary">查询</button>
      <?php echo form_a_auth(array('content'=>'添加','class'=>'btn-large','check'=>'goods_class/add','url'=>APP_URL.'goods_class/preedit?ref='.$ref));?>
      <!-- <?php echo form_a_auth(array('content'=>'更新分类缓存','class'=>'btn-large','onclick'=>'updatecahce();','check'=>'goods_class/edit_cache'));?> -->
    </div>
  </form>
</div>
<div class="goods_class-list">
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
_pagedata.url = "goods_class/preajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_class-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
function s_navclick(url)
  {
    if(url == "index"){
     SAYIMO.go_url("<?php echo APP_URL;?>goods_class/index");
    }
    if(url == "preClss"){
     SAYIMO.go_url("<?php echo APP_URL;?>goods_class/preindex");
    }
  }
//查找状态
$('#search').on('click','.downlist_type li:eq(0)',function(){
  $("#key").attr('type','hidden');
})
$('#search').on('click','.downlist_type li:eq(1)',function(){
  $("#key").attr('type','text');
})

function updatecahce(){
  $.confirm({
    title: '确认对话框',
    body: '确认更新缓存吗？',
    backdrop: false,
    okHide: function() {
      $.ajax({
          type    : "post",
          async   : false,
          url     : '<?php echo APP_URL;?>goods_class/updatecahce',
          data    : '',
          dataType: 'json',
          success : function (data)
          {
            console.log(data);
              if (data['data']['msg'] == true){
                  $.alert("更新分类缓存成功！");
              }else{
                  $.alert("更新失败！");
              }
          }
      });
    },
    hide: function() {}
  });
}
</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'className':
      return '分类名称';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'className':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>