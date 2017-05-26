<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
    <li onclick="s_navclick('info');"><a>基本信息</a></li>
    <li onclick="s_navclick('teamlist');"><a>团队列表</a></li>
    <li class="active"><a>团队销售额</a></li>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
    <input type="hidden" id="gameId" name="gameId" value="<?php echo $id;?>">
     <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="teamName">团队名称</a></li>
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
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">禁用</a></li>
          </ul>
      </span>
      </span>
    <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_startup_game/teamlist" class="sui-btn btn-large btn-primary">查询</button>
		</div>
	</form>
</div>
<div class="base_startup_game-list">
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
_pagedata.url = "base_startup_game/ajaxteamlist?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_startup_game-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  function s_navclick(url)
  {
    if(url == "info"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/info?gameId=<?php echo $id;?>");
    }
    if(url == "teamlist"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/teamlist?gameId=<?php echo $id;?>");
    }
    if(url == "teamprice"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/teamprice?gameId=<?php echo $id;?>");
    }
  }
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
    $("#key").val('');
  })
</script>
 <?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'teamName':
      return "团队名称";
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'teamName':
      return "hidden";
      break;
    default:
      return 'hidden';
      break;
  }
}
?>
