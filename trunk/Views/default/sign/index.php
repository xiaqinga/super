
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="realName">姓名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="schoolName">学校</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="signStatus">是否签到</a></li>
        </ul></span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <span class="sui-dropdown dropdown-bordered select paylist_class"  <?php echo  ($key_type=='signStatus')?:'style="display: none"'?>><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="" name="payMode" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span><?php echo $signStatusList[$key]?:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">是</a></li>
           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">否</a></li>

        </ul></span></span>



      <button type="submit" id="search-bn" data-url="sign/index" class="sui-btn btn-large btn-primary">查询</button>

      <?php echo form_a_auth(array('content'=>'导出','class'=>'btn-large','onclick'=>'exportSigns()','check'=>'sign/exportSigns'));?>

      <?php echo form_a_auth(array('content'=>'导入用户','class'=>'btn-large','onclick'=>'uploadExcel()','check'=>'sign/uploadExcel'));?>


    </div>
  </form>
</div>
<div class="base_union_class-list">
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
_pagedata.url = "sign/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_union_class-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

//查找状态
$('#search').on('click','.downlist_type li:eq(0)',function(){
  $(".paylist_class").hide();
  $("#key").val('');
  $("#key").attr('type','hidden');
})
$('#search').on('click','.downlist_type li:eq(1)',function(){
  $(".paylist_class").hide();
  $("#key").val('');
  $("#key").attr('type','text');
})
$('#search').on('click','.downlist_type li:eq(2)',function(){
  $(".paylist_class").hide();
  $("#key").val('');
  $("#key").attr('type','text');
})
$('#search').on('click','.downlist_type li:eq(3)',function(){
  $("#key").attr('type','hidden');
  $("#key").val('');
  $(".paylist_class").show();
})
function changeKeyValue (n) {
  $("#key").val(n);
}

function uploadExcel(){
  $.confirm({
    title:'选择',
    body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
    remote:OO._SRVPATH+'sign/uploadexcel',
    width:  '500px',
    height: '100px',
    shown: function(){
      $(".sui-modal").addClass("upExcelmodal");
    },
    okHide: function() {
      OO.loading(SAYIMO._MAINCONT);
      SAYIMO._MAINCONT.load("sign/index");
    }
  });
}


//导出
function exportSigns(){

  var key_type = $("#key_type").val();
  var key = $("#key").val();

  window.open("<?php echo APP_URL?>sign/exportorder?key_type=" + key_type + "&key=" + encodeURIComponent(key));
}
  
</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'realName':
      return '姓名';
      break;
    case 'schoolName':
      return '学校';
      break;
    case 'signStatus':
      return '是否签到';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'realName':
      return 'text';
      break;
    case 'schoolName':
      return 'text';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>