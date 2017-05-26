<style>
.nav-xlarge{
  margin-top: 10px;
  margin-bottom: 0px;
}
</style>

<ul class="sui-nav nav-tabs nav-xlarge">
  <li onclick="s_navclick('index');"><a>活动管理</a></li>
  <?php if (auth_check_permissions('base_moldbaby/index')):?>
  <li onclick="s_navclick('moldbaby');"><a>爆款专区</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_seckill/index')):?>
  <li onclick="s_navclick('seckill');"><a>秒抢专区</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_group_buy/index')):?>
  <li onclick="s_navclick('groupbuy');"><a>团购专区</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_cut_price/index')):?>
  <li class="active" onclick="s_navclick('cut');"><a>砍价专区</a></li>
  <?php endif;?>
</ul>
<div class="content-top ">
  <form class="sui-form" id="search">
   <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="goodsName">商品名称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="name">活动名称</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_cut_price/index" class="sui-btn btn-large btn-primary">查询</button>
      <?php echo form_a_auth(array('content'=>'添加活动','class'=>'btn-large','url'=>APP_URL.'base_cut_price/edit?ref='.$ref));?>
    </div>
  </form>
</div>
<div class="base_activity-list">
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
_pagedata.url = "base_cut_price/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_activity-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  //选项卡
  function s_navclick(url)
  {
    if(url == "index"){
     SAYIMO.go_url("<?php echo APP_URL;?>base_activity/index");
    }
    if(url == "moldbaby"){
     SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/index");
    }
    if(url == "seckill"){
     SAYIMO.go_url("<?php echo APP_URL;?>base_seckill/index");
    }
    if(url == "groupbuy"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_group_buy/index");
    }
    if(url == "cut"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_cut_price/index");
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
    $("#key").val('');
  })

</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'goodsName':
      return "商品名称";
      break;
    case 'name':
      return '活动名称';
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
    case 'name':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>