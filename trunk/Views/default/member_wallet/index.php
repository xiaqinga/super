<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias">会员昵称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout">账号</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="realName">姓名</a></li>
        </ul></span></span>
      </span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;">
      <span class="dropdown-inner">
        <input value="" name="name" onchange="changeKeyValue(this.value);" type="hidden"></a>
      </span>
      </span>
			<button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>member_wallet/index" class="sui-btn btn-large btn-primary">查询</button>

		</div>
	</form>
</div>
<div class="base_media-list">
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
_pagedata.url = "member_wallet/ajaxIndex?&key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_media-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);


    $('#search').on('click','.downlist_type li:eq(0)',function(){
      $("#key").attr('type','hidden');
      $(".downlist_class").hide();
      $("#key").val('');
    })
    $('#search').on('click','.downlist_type li:eq(1)',function(){
      $("#key").attr('type','text');
      $(".downlist_class").show();
      $("#key").val('');
    })
    $('#search').on('click','.downlist_type li:eq(2)',function(){
      $("#key").attr('type','text');
      $(".downlist_class").show();
      $("#key").val('');
    })
    $('#search').on('click','.downlist_type li:eq(3)',function(){
      $("#key").attr('type','text');
      $(".downlist_class").show();
      $("#key").val('');
    })

  function changeKeyValue (n) {
    $("#key").val(n);
  }


</script>

 <?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'alias':
      return "会员昵称";
      break;
    case 'accout':
      return '账号';
      break;
    case 'realName':
      return '姓名';
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
    case 'accout':
      return 'hidden';
      break;
    case 'realName':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>