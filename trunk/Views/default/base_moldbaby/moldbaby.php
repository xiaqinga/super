<ul class="sui-nav nav-tabs nav-xlarge">
  <li onclick="s_navclick('index');"><a>活动管理</a></li>
  <li class="active" onclick="s_navclick('moldbaby');"><a>爆款专区</a></li>
</ul>

<div class="content-top ">
	<form class="sui-form" id="search">
	 <div class="controls">
      爆款名称: <input type="text" id="name" name="name" class="input-xlarge input-fat" value="<?php echo $name;?>">
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_moldbaby/moldbaby" class="sui-btn btn-large btn-primary">查询</button>
      <?php echo form_a_auth(array('content'=>'添加爆款','class'=>'btn-large','url'=>APP_URL.'base_moldbaby/edit?ref='.$ref));?>
    </div>
	</form>
</div>
<div class="base_moldbaby-list">
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
var name = $("#name").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_moldbaby/ajaxIndex?key_type="+key_type+"&name="+name+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_moldbaby-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

<script type="text/javascript">
  //选项卡
  function s_navclick(url)
  {
    if(url == "index"){
     SAYIMO.go_url("<?php echo APP_URL;?>base_activity/"+url);
    }
    if(url == "lock"){
     SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/"+url);
    }
  }

  function changeKeyValue (n) {
    $("#key").val(n);
  }
</script>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'activityName':
      return "名称";
      break;
    case 'identifier':
      return '标识符';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'activityName':
      return 'hidden';
      break;
    case 'identifier':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>