<style>
.sui-nav {
  margin-bottom: 0px; 
}
#date_chk{display: inline-block;}
</style>
<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li <?php echo !$status ? 'class="active"' : '';?> onclick="navclick();"><a>全部订单</a></li>
  <?php if (auth_check_permissions('orders_goods_info/tobe_paid')):?>
  <li <?php echo $status == '1' ? 'class="active"' : '';?> onclick="navclick(1);"><a>待支付</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/tobe_shipped')):?>
  <li <?php echo $status == '2' ? 'class="active"' : '';?> onclick="navclick(2);"><a>待发货</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/already_shipped')):?>
  <li <?php echo $status == '3' ? 'class="active"' : '';?> onclick="navclick(3);"><a>已发货</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/finish')):?>
  <li <?php echo $status == '7' ? 'class="active"' : '';?> onclick="navclick(7);"><a>订单完成</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/tobe_shipped')):?>
  <li <?php echo $status == '4' ? 'class="active"' : '';?> onclick="navclick(4);"><a>待退款</a></li>
  <?php endif;?>
</ul>

<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="ordersNo">订单号</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="goodsName">商品名称</a></li>
          <?php if($accouttype != 2){?>
          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName">供应商名称</a></li>
          <?php }?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="memberAlias">会员昵称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="realName">收货人姓名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="payMode">支付方式</a></li>
          <?php if( !($status==2 || $status==3 || $status==7) ) :?>
          <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="status">订单状态</a></li> -->
          <?php endif;?>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <!-- 发货状态下拉菜单-->   
      <?php
        if(isset($key_type) && $key_type=='status'){
          $display = '';
        }else{
          $display = "display:none";
        }
        if($statusList[$key]){
          $cur_name = $statusList[$key];
        }else{
          $cur_name = '请选择';
        }
      ?>
      <span class="sui-dropdown dropdown-bordered select downlist_class" style="<?php echo $display;?>"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $status;?>" name="status" id="status" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span><?php echo $cur_name;?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <?php foreach ($statusList as $k => $v) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $k;?>"><?php echo $v;?></a></li>
        <?php endforeach;?>
        </ul></span></span>

      <!-- 支付状态下拉菜单--> 
      <?php
        if(isset($key_type) && $key_type=='payMode'){
          $display = '';
        }else{
          $display = "display:none";
        }
        if($payList[$key]){
          $cur_name = $payList[$key];
        }else{
          $cur_name = '请选择';
        }
      ?>
      <span class="sui-dropdown dropdown-bordered select paylist_class" style="<?php echo $display;?>"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="" name="payMode" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span><?php echo $cur_name;?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <?php foreach ($payList as $k => $v) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $k;?>"><?php echo $v;?></a></li>
        <?php endforeach;?>
        </ul></span></span>
      <button type="button" id="search-bn" data-url="orders_goods_info/index" onclick="search()" class="sui-btn btn-large btn-primary">查询</button>
      <?php
        if($status == 2):
      ?>
       
        <?php echo form_a_auth(array('content'=>'批量发货','class'=>'btn-large','onclick'=>'sendGoods()','check'=>'orders_goods_info/bulk_shipment'));?>
      <?php 
        endif;
      ?>
      <?php
        if($status == 2 || $status == 3 || $status == 7 ):
      ?>
        <!--供应商菜单开始-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if($accouttype != 2){?>
        <span class="sui-dropdown dropdown-bordered select downlist_providerList"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
          <input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span><?php echo $providerName?trim($providerName):'按供应商';?></span></a>
          <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <?php foreach ($providerList as $key => $value) :?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $key;?>"><?php echo $value;?></a></li>
          <?php endforeach;?>
          </ul></span></span>
        <?php }else{?>
	      	<input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden">
	      <?php }?>
        <!--供应商菜单结束-->
        <div id="date_chk" class="control-group input-daterange">
          <label class="control-label"></label>
          <div class="controls">
            <input type="text" id="chkStartDate" name="chkStartDate" class="input-medium input-date"><span>-</span>
            <input type="text" id="chkEndDate" name="chkEndDate" class="input-medium input-date">
          </div>
        </div>
        <?php echo form_a_auth(array('content'=>'导出订单','class'=>'btn-large','onclick'=>'exportSendGoods()','check'=>'orders_goods_info/export_order'));?>
      <?php 
        endif;
      ?>

    </div>
  </form>
</div>

<div class="orders_goods_info-list">
</div>

<?php if($page['total_page'] > 1){?>
  <div class="page"></div>
<?php }?>

<script type="text/javascript">

document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];//获取event对象  
    var obj = e.target || e.srcElement;//获取事件源  
    var t = obj.type || obj.getAttribute('type');//获取事件源类型  
   
    /*if((t != "password" && t != "text")|| t == "textarea"){
       return  false;
    }*/
    if(e && e.keyCode==27){ // 按 Esc 
        //要做的事情
      }
    if(e && e.keyCode==113){ // 按 F2 
         //要做的事情
       }            
     if(e && e.keyCode==13&&(t == "password" || t == "text")){ // enter 键
        
       search();
    }
}; 

//搜索
function search() {
    var key_type = $("#key_type").val();
    var key = $("#key").val();
    var status = $("#status").val();
        
    var  page=$(".page-num").val();
      if(page==""||typeof(page)=="undefined"){
        page=1;
      }
    SAYIMO.go_url("<?php echo APP_URL;?>orders_goods_info/index?" + key_type + "=" + encodeURIComponent(key) + "&status=" + status+"&page="+page); 
}

var key_type = $("#key_type").val();
var key = $("#key").val();
var status = $("#status").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "orders_goods_info/ajaxIndex?" + key_type + "=" + encodeURIComponent(key) + "&status=" + status + "&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.orders_goods_info-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

<script type="text/javascript">
  $('#search').on('click','.downlist_type li',function(){
    $("#key").attr('type','text');
    $("#key").val('');
    $(".downlist_class").hide();
    $(".paylist_class").hide();
  })
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
    $(".downlist_class").hide();
    $(".paylist_class").hide();
  })
  $('#search').on('click','.downlist_type li:eq(7)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
    $(".downlist_class").show();
    $(".paylist_class").hide();
  })
  $('#search').on('click','.downlist_type li:eq(6)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
    $(".paylist_class").show();
    $(".downlist_class").hide();
  })
  function changeKeyValue (n) {
    $("#key").val(n);
  }

  //选项卡跳转
  function navclick(status)
  {
    if(status){
      SAYIMO.go_url(encodeURI("<?php echo APP_URL;?>orders_goods_info/index?status=" + status));
    }else{
      SAYIMO.go_url(encodeURI("<?php echo APP_URL;?>orders_goods_info/index?"));
    }
  }

  //导出商品
  function exportSendGoods(){
    var providerId = $("#providerId").val();
    var status = $("#status").val();
    var chkStartDate = $("#chkStartDate").val();
    var chkEndDate = $("#chkEndDate").val();
    var key_type = $("#key_type").val();
    var key = $("#key").val();
    var ids = new Array();
    $.each($('.orderTdbj1 .checkbox-pretty input:checkbox:checked'),function(n,inp){
      ids.push($(inp).val());
    });
    window.open("<?php echo APP_URL?>orders_goods_info/exportorder?providerId=" + providerId + "&status=" + status + "&chkStartDate=" + chkStartDate +"&ids=" + ids + "&chkEndDate=" + chkEndDate + "&" + key_type + "=" + encodeURIComponent(key));
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
</script>
<?php
//显示当前搜索选项
function downListCurName($key_type){
  switch ($key_type) {
    case 'ordersNo':
      return '订单号';
      break;
    case 'goodsName':
      return '商品名称';
      break;
    case 'providerName':
      return '供应商名称';
      break;
    case 'memberAlias':
      return '会员昵称';
      break;
    case 'realName':
      return '收货人姓名';
      break;
    case 'payMode':
      return '支付方式';
      break;
    case 'status':
      return '订单状态';
      break;
    default:
      return '请选择';
      break;
  }
}

//显示搜索框
function showKeyInput($key_type){
  switch ($key_type) {
    case 'ordersNo':
      return 'text';
      break;
    case 'goodsName':
      return 'text';
      break;
    case 'providerName':
      return 'text';
      break;
    case 'memberAlias':
      return 'text';
      break;
    case 'realName':
      return 'text';
      break;
    case 'payMode':
      return 'hidden';
      break;
    case 'status':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}

//显示下拉菜单
function showDown($key_type){
  switch ($key_type) {
    case 'ordersNo':
      return 'none';
      break;
    case 'goodsName':
      return 'none';
      break;
    case 'providerName':
      return 'none';
      break;
    case 'memberAlias':
      return 'none';
      break;
    case 'realName':
      return 'none';
      break;
    case 'payMode':
      return '';
      break;
    case 'status':
      return '';
      break;
    default:
      return 'none';
      break;
  }
}
?>