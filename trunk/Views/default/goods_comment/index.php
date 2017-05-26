<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li class="active" onclick="s_navclick('index');"><a>供应商评论</a></li>
  <?php if(auth_check_permissions(goods_comment_appointment/index)):?>
  <li onclick="s_navclick('appointment');"><a>联盟商评论</a></li>
  <?php  endif;?>
</ul>
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="commentContent">评论内容</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias">用户</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="commentLevel">星级</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="goodsName">商品名称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="createDate">创建时间</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput();?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">

      <!-- 星级状态下拉菜单--> 
      <?php
        if(isset($key_type) && $key_type=='commentLevel'){
          $display = '';
        }else{
          $display = "display:none";
        }
      ?>
  <span class="sui-dropdown dropdown-bordered select downlist_commentLevel" style="<?php echo $display;?>">
  <span class="dropdown-inner">
  <a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $commentLevel ;?>" name="commentLevel" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span>请选择</span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="4,5">好评</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2,3">中评</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">差评</a></li>
        </ul>
  </span>
  </span>
 <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;">
 <span class="dropdown-inner">
      <input data-toggle="datepicker" value="<?php echo $startDate;?>" id="startDate" name="startDate" data-rules="required" type="text">  ---
      <input data-toggle="datepicker" value="<?php echo $endDate;?>" id="endDate" name="endDate" data-rules="required" type="text">
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu"></ul>
  </span>
  </span>
      
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>goods_comment/index" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="goods_comment-list">
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
var startDate = $("#startDate").val();
var endDate = $("#endDate").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goods_comment/ajaxIndex?key_type="+key_type+"&key="+key+"&startDate="+startDate+"&endDate="+endDate+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_comment-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

 

  function s_navclick(url)
  {
    if(url == "index"){
      SAYIMO.go_url("<?php echo APP_URL;?>goods_comment/index");
    }
    if(url == "appointment"){
      SAYIMO.go_url("<?php echo APP_URL;?>goods_comment_appointment/index");
    }
  }
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_class").hide();
    $(".downlist_commentLevel").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
    $(".downlist_class").hide();
    $(".downlist_commentLevel").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(2)',function(){
    $("#key").attr('type','text');
    $(".downlist_class").hide();
    $(".downlist_commentLevel").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(3)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_class").hide();
    $(".downlist_commentLevel").show();
    $("#key").val('');

  })
 $('#search').on('click','.downlist_type li:eq(4)',function(){
    $("#key").attr('type','text');
    $(".downlist_class").hide();
    $(".downlist_commentLevel").hide();
    $("#key").val('');
    
  })
$('#search').on('click','.downlist_type li:eq(5)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_class").show();
    $(".downlist_commentLevel").hide();
    $("#key").val('');
    
  })
  function changeKeyValue (n) {
    $("#key").val(n);
  }


</script>

<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'commentContent':
      return '评论内容';
      break;
    case 'alias':
      return '用户';
      break;
    case 'commentLevel':
      return '星级';
      break;
    case 'goodsName':
      return '商品名称';
      break;
    case 'createDate':
      return '创建时间';
      break;
    default:
      return '请选择';
      break;
  }
}

//显示搜索框
function showKeyInput($key_type){
  switch ($key_type) {
    case 'commentContent':
      return 'text';
      break;
    case 'alias':
      return 'text';
      break;
    case 'commentLevel':
      return 'hidden';
      break;
    case 'goodsName':
      return 'text';
      break;
    case 'createDate':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}









