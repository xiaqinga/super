<style>
  .sui-nav {
    margin-bottom: 0px;
  }
  #date_chk{display: inline-block;}
</style>
<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li <?php if($transferStatus=='1'){echo 'class="active"';}?> onclick="s_navclick(1);"><a>待转账</a></li>
  <li <?php if($transferStatus=='2'){echo 'class="active"';}?> onclick="s_navclick(2);"><a>转账中</a></li>
  <li <?php if($transferStatus=='3'){echo 'class="active"';}?> onclick="s_navclick(3);"><a>转账完成</a></li>
  <li <?php if($transferStatus=='4'){echo 'class="active"';}?> onclick="s_navclick(4);"><a>转账失败</a></li>

</ul>
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout">申请账号</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="realName">姓名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="bankBranchName">来源银行</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">

      <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>transfer/index" class="sui-btn btn-large btn-primary">查询</button>
      <?php if(1==$transferStatus||4==$transferStatus):?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
        <span class="sui-dropdown dropdown-bordered select downlist_providerList"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
          <input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span><?php echo $providerName?trim($providerName):'请选择类型';?></span></a>
          <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <?php foreach ($transferType as $key => $value) :?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $key;?>"><?php echo $value;?></a></li>
          <?php endforeach;?>
          </ul></span></span>
    
    
      <div id="date_chk" class="control-group input-daterange">
        <label class="control-label"></label>
        <div class="controls">
          <input type="text" id="chkStartDate" name="chkStartDate" class="input-medium input-date"><span>-</span>
          <input type="text" id="chkEndDate" name="chkEndDate" class="input-medium input-date">
        </div>
      </div>

      <?php  endif;?>

      <?php if(2==$transferStatus):?>
        <input type="text" id="transferBatchCode" placeholder="请输入批次号" name="transferBatchCode" class="input-xlarge input-fat" value="<?php echo $transferBatchCode;?>">
       <?php echo form_a_auth(array('content'=>'确认到帐','class'=>'btn-large','onclick'=>'confirmAccount()','check'=>'transfer/confirmaccount'));?>
      <?php  endif;?>
      <?php if(1==$transferStatus||2==$transferStatus||4==$transferStatus):?>
        <?php echo form_a_auth(array('content'=>'导出','class'=>'btn-large','onclick'=>'exportSendGoods()','check'=>'transfer/export_order'));?>
      <?php endif;?>
      <input type="hidden" value="<?php echo $transferStatus?>" name="transferStatus" id="transferStatus"  />

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
var transferStatus=$("#transferStatus").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "transfer/ajaxIndex?transferStatus="+transferStatus+"&key_type="+key_type+"&key="+key+"&startDate="+startDate+"&endDate="+endDate+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_comment-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

//导出商品
function exportSendGoods(){
  var providerId = $("#providerId").val();
  var transferStatus=$("#transferStatus").val();
  var transferBatchCode=$('#transferBatchCode').val();
  var chkStartDate = $("#chkStartDate").val();
  var chkEndDate = $("#chkEndDate").val();
  var key_type = $("#key_type").val();
  var key = $("#key").val();
 
  window.open("<?php echo APP_URL?>transfer/exportorder?providerId=" + providerId + "&transferStatus=" + transferStatus +"&transferBatchCode=" + transferBatchCode + "&chkStartDate=" + chkStartDate + "&chkEndDate=" + chkEndDate + "&" + key_type + "=" + encodeURIComponent(key));
  $('#mainInfo').find("div.goods_comment-list").load('<?php echo $ref?>');
}
//
function confirmAccount(){
  var transferStatus=$("#transferStatus").val();
 var transferBatchCode=$('#transferBatchCode').val();
 if(!transferBatchCode){
   $.alert('请先输入批次号');
   return ;
  }
  $.get('<?php echo APP_URL."transfer/setTransferStatusByCode";?>',{'transferBatchCode':transferBatchCode},
  function (data) {
      if(1==data.status){
        $.alert({
          title: '对话框',
          body: '确认到帐成功',
          okHide: function(e){
            SAYIMO.go_url("<?php echo APP_URL;?>transfer/index?transferStatus="+transferStatus);
          }
        })
      }else{
        $.alert('确认到帐失败！没有该批次的帐单');
      }
  },'json')
}


//时间
$('#date_chk.input-daterange').datepicker({
  beforeShowDay: function (date){
    if (date.getMonth() == (new Date()).getMonth())
      switch (date.getDate()){
        case 4:
          return {
            tooltip: 'Example tooltip',
            classes: 'active'
          };
        case 8:
          return false;
        case 12:
          return "green";
      }
  }
});

  function s_navclick(url)
  {

      SAYIMO.go_url("<?php echo APP_URL;?>transfer/index?transferStatus="+url);

  }



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
 $('#search').on('click','.downlist_type li:eq(4)',function(){
    $("#key").attr('type','text');
    $("#key").val('');
    
  })
  function changeKeyValue (n) {
    $("#key").val(n);
  }


</script>

<?php
function downListCurName($key_type){
  
  switch ($key_type) {
    case 'accout':
      return '申请账号';
      break;
    case 'realName':
      return '姓名';
      break;
    case 'bankBranchName':
      return '来源银行';
      break;
    default:
      return '请选择';
      break;
  }
}

//显示搜索框
function showKeyInput($key_type){
  switch ($key_type) {
    case 'accout':
      return 'text';
      break;
    case 'realName':
      return 'text';
      break;
    case 'bankBranchName':
      return 'text';
      break;

    default:
      return 'hidden';
      break;
  }


  
}









