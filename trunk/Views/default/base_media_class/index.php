<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="classTitle">分类标题</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="mark">标识符</a></li>
        </ul></span></span>
			<input type="text" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>" <?php if(!$key):?> style="display: none;" <?php endif;?> >
			<button type="submit" id="search-bn" data-url="base_media_class/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加分类','class'=>'btn-large','check'=>'base_media_class/add','url'=>APP_URL.'base_media_class/edit?ref='.$ref));?>
		</div>
	</form>
</div>
<div class="base_media_class-list">
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
_pagedata.url = "base_media_class/ajaxIndex?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_media_class-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

$(".sui-dropdown-menu li:gt(0)").click(function(event) {
  $("#key").show();
});
$(".sui-dropdown-menu li:eq(0)").click(function(event) {
  $("#key").hide();
});
</script>

<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'classId':
      return '分类';
      break;
    case 'mark':
      return '标识符';
      break;
    default:
      return '请选择';
      break;
  }
}