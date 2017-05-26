<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li onclick="s_navclick('index');"><a>创客大赛</a></li>
  <li class="active" onclick="s_navclick('submission');"><a>需求征集</a></li>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
     <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="identifier">标识符</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="subName">投稿征集名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="status">状态</a></li>
        </ul></span></span>
      </span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;">
      <span class="dropdown-inner">
        <input value="" name="" onchange="changeKeyValue(this.value);" type="hidden"></a>
      </span>
      </span>
      <span class="sui-dropdown dropdown-bordered select downlist_status" style="display: none;">
      <span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="" name="status" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span>请选择</span></a>
          <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">启用</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="-1">禁用</a></li>
          </ul>
      </span>
      </span>
    <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_submission/index" class="sui-btn btn-large btn-primary">查询</button>
    <?php echo form_a_auth(array('content'=>'添加需求','class'=>'btn-large','check'=>'base_submission/edit','url'=>APP_URL.'base_submission/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="base_submission-list">
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
_pagedata.url = "base_submission/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_submission-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  function s_navclick(url)
  {
    if(url == "index"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/index");
    }
    if(url == "submission"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/index");
    }
  }
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(2)',function(){
    $("#key").attr('type','text');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(3)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_status").show();
    $("#key").val('');
  })
</script>
 <?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'identifier':
      return "标识符";
      break;
    case 'subName':
      return "投稿征集名";
      break;
    case 'status':
      return '状态';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'identifier':
      return "hidden";
      break;
    case 'subName':
      return "hidden";
      break;
    case 'status':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>
