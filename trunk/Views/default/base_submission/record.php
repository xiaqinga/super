<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li onclick="s_navclick('info');"><a>基本信息</a></li>
  <li class="active" ><a>投稿列表</a></li>
</ul>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
     <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="subName">投稿人姓名</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="telPhone">联系电话</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="schoolId">学校</a></li>
        </ul></span></span>
      </span></span>
      <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;">
      <span class="dropdown-inner">
        <input value="" name="" onchange="changeKeyValue(this.value);" type="hidden"></a>
      </span>
      </span>
      <span class="sui-dropdown dropdown-bordered select downlist_status" style="display: none;">
      <span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="" name="schoolId" onchange="changeKeyValue(this.value);" type="hidden"><i class="caret"></i><span>请选择</span></a>
          <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <?php foreach($school as $k=>$v):?>
           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $v['id'];?>"><?php echo $v['schoolName'];?></a></li>
          <?php endforeach;?>
          </ul>
      </span>
      </span>
    <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_submission/record?id=<?php echo $id;?>" class="sui-btn btn-large btn-primary">查询</button>
    <?php echo form_a_auth(array('content'=>'导出全部投稿','class'=>'btn-large','check'=>'base_submission/exportorder','onclick'=>'js_export()'));?>
		</div>
	</form>
</div>
<div class="base_submission-list">
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
_pagedata.url = "base_submission/ajaxRecord?id="+id+"&key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_submission-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

  function s_navclick(url)
  {
    if(url == "info"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/info?id=<?php echo $id;?>");
    }
  }
  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','text');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(2)',function(){
    $("#key").attr('type','text');
    $(".downlist_status").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(3)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_status").show();
    $("#key").val('');
  })

  //导出商品
function js_export(){
  var id = $('#id').val();
  window.open("<?php echo APP_URL?>base_submission/exportorder?id=" + id);
}
</script>
 <?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'subName':
      return "投稿人姓名";
      break;
    case 'telPhone':
      return "联系电话";
      break;
    case 'schoolId':
      return '学校';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'subName':
      return "hidden";
      break;
    case 'telPhone':
      return "hidden";
      break;
    case 'schoolId':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>
