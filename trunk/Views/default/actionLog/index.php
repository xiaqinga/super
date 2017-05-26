<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnameList[$searchname]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	            <?php foreach ($searchnameList as $sl_key => $sl_val){?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $sl_key; ?>" onclick="showDiv('<?php echo $sl_key; ?>');"><?php echo $sl_val; ?></a></li>
				<?php } ?>
	          </ul></span></span>
			<input type="text" id="userName" name="userName" placeholder="操作员名称" class="input-xlarge input-fat" value="<?php echo $userName;?>" style="<?php echo ($searchname=='userName')?'':'display:none;'?>">
			<span id="actionTypediv" class="sui-dropdown dropdown-bordered select" style="<?php echo ($searchname=='actionType')?'':'display:none;'?>"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($actionType)?$actionType:''?>" name="actionType" id="actionType" type="hidden"><i class="caret"></i><span><?php echo ($actionType)?$actionTypeList[$actionType]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	            <?php foreach ($actionTypeList as $al_key => $al_val){?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $al_key; ?>"><?php echo $al_val; ?></a></li>
				<?php } ?>
	          </ul></span></span>
	        <input type="text" id="startDate" name="startDate" placeholder="开始时间" class="input-medium input-fat" value="<?php echo $startDate;?>" style="<?php echo ($searchname=='actionDate')?'':'display:none;'?>">
	        <input type="text" id="endDate" name="endDate" placeholder="结束时间" class="input-medium input-fat" value="<?php echo $endDate;?>" style="<?php echo ($searchname=='actionDate')?'':'display:none;'?>">
			<button type="submit" id="search-bn" data-url="actionLog/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'获得当前日志','class'=>'btn-large','check'=>'actionLog/current_log','url'=>APP_URL.'actionLog/index'));?>
			 <?php echo form_a_auth(array('content'=>'更新搜索引擎','check'=>'actionLog/updateAction','class'=>'btn-large','id'=>'uplog','name'=>'uplog'));?>
			<input type="text" id="startDate1" name="startDate1" placeholder="开始时间" class="input-medium input-fat" value="">
	        <input type="text" id="endDate1" name="endDate1" placeholder="结束时间" class="input-medium input-fat" value="">
	        <button type="button" id="btDelete" name="btDelete" class="sui-btn btn-large btn-primary" >删除时间段</button>
		</div>
	</form>
</div>
<div class="actionlog-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
$('#startDate').datepicker({format:'yyyy-mm-dd'});
$('#endDate').datepicker({format:'yyyy-mm-dd'});

var searchname = $("#searchname").val();
var userName = $("#userName").val();
var actionType = $("#actionType").val();
var startDate = $("#startDate").val();
var endDate = $("#endDate").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "actionLog/ajaxIndex?searchname="+searchname+"&userName="+userName+"&actionType="+actionType+"&startDate="+startDate+"&endDate="+endDate+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.actionlog-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
function showDiv(divname){
	$("#userName").hide();
	$("#actionTypediv").hide();
	$("#startDate").hide();
	$("#endDate").hide();
	if(divname == 'userName'){
		$("#userName").show();
	}else if(divname == 'actionType'){
		$("#actionTypediv").show();
	}else if(divname == 'actionDate'){
		$("#startDate").show();
		$("#endDate").show();
	}
}
// //同步
$('#uplog').on('click',function(){
    $.ajax({
      url:'<?php echo APP_URL?>actionLog/updateAction',
      dataType: 'json',
      success:function(data){
      	if(data['msg'] == 1)
          $.alert("更新成功");
      	else
      	  $.alert("更新失败");
      }
    });
  })

$('#startDate1').datepicker({format:'yyyy-mm-dd'});
$('#endDate1').datepicker({format:'yyyy-mm-dd'});
$('#btDelete').on('click',function(){
	var startDate1 = $('#startDate1').val();
	var endDate1 = $('#endDate1').val();
	if(startDate1 =='' || endDate1 == ''){
		$.alert('请填写日期区间');
		return false;
	}
	if(startDate1 > endDate1){
		$.alert('请填写正确的日期区间');
		return false;
	}
    $.ajax({
      // url:'<?php echo APP_URL?>actionLog/delete?startDate='+startDate1+'&endDate='.endDate1,
      type    : "post",
	  async   : false,
	  url     : '<?php echo APP_URL."actionLog/delete";?>',
	  data    : {'startDate':startDate1,'endDate':endDate1},
	  dataType: 'json',
      success:function(data){
      	if (data['msg'] == 1) {
	  		$.alert("删除成功");
	  		SAYIMO.go_url('<?php echo APP_URL."actionLog/index";?>');
      	}else{
          	$.alert("删除失败");
          	SAYIMO.go_url('<?php echo APP_URL."actionLog/index";?>');
      	}
      }
    });
  })

</script>
