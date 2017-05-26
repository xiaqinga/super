<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/teamlist?gameId=<?php echo $gameId;?>">返回</a></li>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <input type="hidden" id="gameId" name="gameId" value="<?php echo $gameId;?>">
      <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
     <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias">会员昵称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="name">姓名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="mobilePhone">联系方式</a></li>
        </ul></span></span>
      </span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;">
      <span class="dropdown-inner">
        <input value="" name="" onchange="changeKeyValue(this.value);" type="hidden"></a>
      </span>
      </span>
    <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_startup_game/teammember" class="sui-btn btn-large btn-primary">查询</button>
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
var gameId = $('#gameId').val();
var id = $('#id').val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_startup_game/ajaxteammember?id="+id+"&gameId="+gameId+"&key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_startup_game-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(2)',function(){
    $("#key").attr('type','text');
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(3)',function(){
    $("#key").attr('type','text');
    $("#key").val('');
  })
</script>
 <?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'alias':
      return "会员昵称";
      break;
    case 'realName':
      return "姓名";
      break;
    case 'mobilePhone':
      return "联系方式";
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'alias':
      return "hidden";
      break;
    case 'realName':
      return "hidden";
      break;
    case 'mobilePhone':
      return "hidden";
      break;
    default:
      return 'hidden';
      break;
  }
}
?>
