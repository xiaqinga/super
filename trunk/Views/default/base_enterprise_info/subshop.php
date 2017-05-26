
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerCode">联盟商编号</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName">联盟商名称</a></li> -->
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="linkman">联系人</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput();?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">

      <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_enterprise_info/subshop?id=<?php echo $id;?>" class="sui-btn btn-large btn-primary">查询</button>
      <?php echo form_a_auth(array('content'=>'添加子店','class'=>'btn-large','check'=>'base_enterprise_info/subshopedit','url'=>APP_URL.'base_enterprise_info/subshopedit?id='.$id.'&ref='.$ref));?>
    </div>
  </form>
</div>
<div class="base_enterprise_info-list">
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
var id = <?php echo $id;?>;
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_enterprise_info/ajaxsubShop?key="+key+"&id="+id+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_enterprise_info-list';
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
  // $('#search').on('click','.downlist_type li:eq(2)',function(){
  //   $("#key").attr('type','text');
  //   $("#key").val('');
  // })
  // $('#search').on('click','.downlist_type li:eq(3)',function(){
  //   $("#key").attr('type','text');
  //   $("#key").val('');

  // })
  function changeKeyValue (n) {
    $("#key").val(n);
  }


</script>

<?php
function downListCurName($key_type){
  switch ($key_type) {
    // case 'providerCode':
    //   return '联盟商编号';
    //   break;
    // case 'providerName':
    //   return '联盟商名称';
    //   break;
    case 'linkman':
      return '联系人';
      break;
    default:
      return '请选择';
      break;
  }
}

//显示搜索框
function showKeyInput($key_type){
  switch ($key_type) {
    // case 'providerCode':
    //   return 'text';
    //   break;
    // case 'providerName':
    //   return 'text';
    //   break;
    case 'linkman':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}









