<style>
.sui-nav {
  margin-bottom: 0px; 
}
#datepicker{
    display: inline-block;
}
</style>

<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li <?php echo !$statuses ? 'class="active"' : '';?> onclick="navclick('');"><a>全部退/换货</a></li>
  <?php if (auth_check_permissions('orders_return/return_audit')):?>
  <li <?php echo strpos($statuses, '1') >-1 ? 'class="active"' : '';?> onclick="navclick('1');"><a>退/换货待审核</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_return/return_determine')):?>
  <li <?php echo strpos($statuses, '2') >-1 || strpos($statuses, '3')>-1 ? 'class="active"' : '';?> onclick="navclick('2,3');"><a>退/换货确认</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_return/already_shipped')):?>
  <li <?php echo strpos($statuses, '4') >-1 ? 'class="active"' : '';?> onclick="navclick('4');"><a>已发货</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/rejected')):?>
  <li <?php echo strpos($statuses, '7') >-1 ? 'class="active"' : '';?> onclick="navclick('7');"><a>已驳回</a></li>
  <?php endif;?>
  <?php if (auth_check_permissions('orders_goods_info/finish')):?>
  <li <?php echo strpos($statuses, '5') >-1 || strpos($statuses, '6')>-1 ? 'class="active"' : '';?> onclick="navclick('5,6');"><a>订单完成</a></li>
  <?php endif;?>
 
</ul>

<div class="content-top">
  <form class="sui-form" id="search">
    <input type="hidden" id="statuses" name="statuses" value="<?php echo $statuses;?>">
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
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <button type="button" id="search-bn" data-url="orders_return/index" onclick="search()" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>

<div class="orders_return-list">
</div>
<?php if($page['total_page'] > 1){?>
  <div class="page"></div>
<?php }?>

<script type="text/javascript">

//搜索
function search() {
  var key_type = $("#key_type").val();
  var key = $("#key").val();
  var statuses = $("#statuses").val();
  SAYIMO.go_url("<?php echo APP_URL;?>orders_return/index?statuses="+statuses + "&" +key_type + "=" +  encodeURIComponent(key));
}

var key_type = $("#key_type").val();
var key = $("#key").val();
var statuses = $("#statuses").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "orders_return/ajaxIndex?statuses="+statuses + "&" + key_type + "=" + encodeURIComponent(key) + "&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.orders_return-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

<script type="text/javascript">
  $('#search').on('click','.downlist_type li',function(){
    $("#key").attr('type','text');
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $("#key").val('');
  })

  //选项卡跳转
  function navclick(statuses)
  {
    if(statuses){
      SAYIMO.go_url("<?php echo APP_URL;?>orders_return/index?statuses=" + statuses);
    }else{
      SAYIMO.go_url("<?php echo APP_URL;?>orders_return/index?");
    }
  }

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
    default:
      return 'hidden';
      break;
  }
}