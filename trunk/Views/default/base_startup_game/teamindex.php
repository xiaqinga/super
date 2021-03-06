<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li onclick="s_navclick('index');"><a><?php echo ($id)?'修改':'添加';?>大赛</a></li>
  <li class="active" ><a>团队列表</a></li>
  <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/index">返回</a></li>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="teamName">团队名称</a></li>
        </ul></span></span>
      </span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      
    <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_startup_game/teamindex" class="sui-btn btn-large btn-primary">查询</button>
    <?php echo form_a_auth(array('content'=>'添加团队','class'=>'btn-large','check'=>'base_startup_game/editTeam','url'=>APP_URL.'base_startup_game/editteam?tid='.$id.'&ref='.$ref));?>
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
var id = $("#id").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_startup_game/ajaxteamindex?id="+id+"&key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_startup_game-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  function s_navclick(url)
  {
    if(url == "index"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/edit?id=<?php echo $id;?>");
    }
    if(url == "teamindex"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/teamindex?id=<?php echo $id;?>");
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
