<style>
.nav-xlarge{
  margin-top: 10px;
  margin-bottom: 0px;
}
</style>

<ul class="sui-nav nav-tabs nav-xlarge">
  <?php if (auth_check_permissions('base_statement/index')):?>
    <li  onclick="s_navclick('index?providerType=1');"><a>供应商对账</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/statistic')):?>
    <li class="<?php echo $providerType==1?'active':''?>" onclick="s_navclick('statistic?providerType=1');"><a>供应商对账统计</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/index')):?>
    <li  onclick="s_navclick('index?providerType=2');"><a>联盟商对账</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/statistic')):?>
    <li  class="<?php echo $providerType==2?'active':''?>"  onclick="s_navclick('statistic?providerType=2');"><a>联盟商对账统计</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/fund')):?>
    <li onclick="s_navclick('fund');"><a>基金对账统计</a></li>
  <?php endif;?>
</ul>
<div class="content-top ">
	<form class="sui-form" id="search">
	 <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="pname">供应商名称</a></li>
        </ul></span></span>
       <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
       <input value="<?php echo $providerType;?>" name="providerType" id="providerType" type="hidden">


       <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_statement/statistic" class="sui-btn btn-large btn-primary">查询</button>
      <?php echo form_a_auth(array('content'=>'导出全部','class'=>'btn-large','onclick'=>'exportSendOrdersCount()','check'=>'base_statement/exportOrderCount'));?>
</span>
    </div>
	</form>
</div>
<div class="base_activity-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>

<script type="text/javascript">
document.onkeydown=function(evt){
    if(evt.keyCode ==13){
         return;
    }
    
    }
$(function(){
	SAYIMO.form.search("#search-bn");
});
var key_type = $("#key_type").val();
var key = $("#key").val();
var providerType=$("#providerType").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_statement/ajaxstatistic?key_type="+key_type+"&key="+key+"&providerType="+providerType+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_activity-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  //选项卡
  function s_navclick(url)
  {

     SAYIMO.go_url("<?php echo APP_URL;?>base_statement/"+url);

  }
  //导出商品
  function exportSendOrdersCount(){
    window.open("<?php echo APP_URL?>base_statement/exportOrderCount?providerType="+providerType);
  }


  $('#search').on('click','.sui-dropdown-menu li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $('.downlist_terminalStatus').hide();
    $('.paymode_list').hide();
    $("#key").val('');
  })
  $('#search').on('click','.sui-dropdown-menu li:eq(1)',function(){
    $("#key").attr('type','show');
    $('.downlist_terminalStatus').hide();
    $('.paymode_list').hide();
    $("#key").val('');
  })

  function changeKeyValue (n) {
    $("#key").val(n);
  }

</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'pname':
      return "供应商名称";
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'pname':
      return "text";
      break;
    default:
      return 'hidden';
      break;
  }
}
?>