<style>
.nav-xlarge{
  margin-top: 10px;
  margin-bottom: 0px;
}
</style>

<ul class="sui-nav nav-tabs nav-xlarge">
  <?php if (auth_check_permissions('base_statement/index')):?>
  <li class="<?php echo $providerType==1?'active':''?>" onclick="s_navclick('index?providerType=1');"><a>供应商对账</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/statistic')):?>
  <li  onclick="s_navclick('statistic?providerType=1');"><a>供应商对账统计</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/index')):?>
    <li class="<?php echo $providerType==2?'active':''?>"  onclick="s_navclick('index?providerType=2');"><a>联盟商对账</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('base_statement/statistic')):?>
    <li onclick="s_navclick('statistic?providerType=2');"><a>联盟商对账统计</a></li>
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
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="ordersNo">订单号</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName">供应商名称</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
    
    <span class="sui-dropdown dropdown-bordered select downlist_terminalStatus" style="<?php echo ($key_type=='type')?'':'display:none;';?>">
    </span>
    </span>




      <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_statement/index" class="sui-btn btn-large btn-primary">查询</button>

      <!--供应商菜单开始-->
     
      <span class="sui-dropdown dropdown-bordered select downlist_providerList"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $providerName;?>" name="providerName" id="providerName" type="hidden"><i class="caret"></i><span><?php echo $providerName?trim($providerName):'按公司名称';?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <?php foreach ($providerList as $key => $value) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $key;?>"><?php echo $value;?></a></li>
        <?php endforeach;?>
        </ul></span></span>
      
        <input value="<?php echo $providerName;?>" name="providerName" id="providerName" type="hidden">
        <input value="<?php echo $providerType;?>" name="providerType" id="providerType" type="hidden">

      <!--供应商菜单结束-->
      <span data-toggle="datepicker" class="control-group input-daterange">
          <input type="text" id="chkStartDate" name="chkStartDate" class="input-medium input-date"><span>-</span>
          <input type="text" id="chkEndDate" name="chkEndDate" class="input-medium input-date">
      </span>
      <?php echo form_a_auth(array('content'=>'导出订单','class'=>'btn-large','onclick'=>'exportSendOrders()','check'=>'base_statement/exportOrder'));?>
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
_pagedata.url = "base_statement/ajaxIndex?key_type="+key_type+"&key="+key+"&providerType="+providerType+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_activity-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  //选项卡
  function s_navclick(url)
  {

     SAYIMO.go_url("<?php echo APP_URL;?>base_statement/"+url);

    
  }

  //导出商品
  function exportSendOrders(){
    var providerName = $("#providerName").val();
    var chkStartDate = $("#chkStartDate").val();
    var chkEndDate = $("#chkEndDate").val();
    window.open("<?php echo APP_URL?>base_statement/exportOrder?providerName=" + providerName  + "&chkStartDate=" + chkStartDate + "&chkEndDate=" + chkEndDate + "&providerType=" + providerType);
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
  

  function changeKeyValue (n) {
    $("#key").val(n);
  }

</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'ordersNo':
      return "订单号";
      break;
    case 'providerName':
      return '公司名称';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'ordersNo':
      return "text";
      break;
    case 'providerName':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>