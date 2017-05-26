<div class="content-top">
	<form class="sui-form" id="viewsearch">
		<div class="controls">
			<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname1" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnamelist[$searchname]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="" onclick="hideSearch('');">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout" onclick="hideSearch('accout');">用户账号</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="customerType" onclick="hideSearch('customerType');">会员类型</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias" onclick="hideSearch('alias');">昵称</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="createDate" onclick="hideSearch('createDate');">加入时间</a></li>
	          </ul></span></span>
			<input type="text" id="accout1" name="accout" placeholder="用户账号" class="input-xlarge input-fat" value="<?php echo $accout;?>" style="<?php echo ($searchname == 'accout' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="alias1" name="alias" placeholder="昵称" class="input-xlarge input-fat" value="<?php echo $alias;?>" style="<?php echo ($searchname == 'alias' && !empty($searchname))?'':'display:none';?>">
			<span class="sui-dropdown dropdown-bordered select" id="customerTypeSelect1" style="<?php echo ($searchname == 'customerType')?'':'display:none';?>"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	          <input value="<?php echo ($customerType)?$customerType:''?>" name="customerType" id="customerType1" type="hidden"><i class="caret"></i><span><?php echo ($customerType)?$customerTypelist[$customerType]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">普通会员</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">金星创客</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="3">银星创客</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="4">供应商</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="5">联盟商</a></li>

			  </ul></span></span>

	        <input type="text" id="startDate1" name="startDate" placeholder="开始时间" class="input-medium input-fat" value="<?php echo $startDate;?>" style="<?php echo ($searchname=='createDate')?'':'display:none;'?>">
	        <input type="text" id="endDate1" name="endDate" placeholder="结束时间" class="input-medium input-fat" value="<?php echo $endDate;?>" style="<?php echo ($searchname=='createDate')?'':'display:none;'?>">
			<button type="submit" id="search-bn1" data-url="customer_list/junior" class="sui-btn btn-large btn-primary">查询</button>
		</div>
	</form>
</div>
<div class="customerjunior-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="juniorpage"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	var _obs = [];
	_obs.btn = "#search-bn1";
	_obs.modal_body = "#juniorModal .modal-body"
	SAYIMO.form.view_search(_obs);
});
$('#startDate1').datepicker({format:'yyyy-mm-dd'});
$('#endDate1').datepicker({format:'yyyy-mm-dd'});
var searchname = $("#searchname1").val();
var accout = $('#accout1').val();
var customerType = $('#customerType1').val();
var alias = $('#alias1').val();
var startDate = $('#startDate1').val();
var endDate = $('#endDate1').val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "customer_list/ajaxjunior?id=<?php echo $id;?>&searchname="+searchname+"&accout="+accout+"&customerType="+customerType+"&alias="+alias+"&startDate="+startDate+"&endDate="+endDate+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.customerjunior-list';
_pagedata.labelname = '.juniorpage';
SAYIMO.pagination(_pagedata);
function hideSearch(name){
	if(name == 'createDate'){
		$('#accout1').hide();
		$('#customerTypeSelect1').hide();

		$('#alias1').hide();
		$('#startDate1').show();
		$('#endDate1').show();
	}else if(name == 'accout'){
		$('#accout1').show();
		$('#customerTypeSelect1').hide();

		$('#alias1').hide();
		$('#startDate1').hide();
		$('#endDate1').hide();
	}else if(name == 'customerType'){
		$('#accout1').hide();
		$('#customerTypeSelect1').show();

		$('#alias1').hide();
		$('#startDate1').hide();
		$('#endDate1').hide();
	}else if(name == 'alias'){
		$('#accout1').hide();
		$('#customerTypeSelect1').hide();

		$('#alias1').show();
		$('#startDate1').hide();
		$('#endDate1').hide();
	}else{
		$('#accout1').hide();
		$('#customerTypeSelect1').hide();

		$('#alias1').hide();
		$('#startDate1').hide();
		$('#endDate1').hide();
	}
}
</script>