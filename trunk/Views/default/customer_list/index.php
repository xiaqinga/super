<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	            <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnamelist[$searchname]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="" onclick="hideSearch('');">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout" onclick="hideSearch('accout');">用户账号</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="customerType" onclick="hideSearch('customerType');">会员类型</a></li>
	           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias" onclick="hideSearch('alias');">昵称</a></li>
	           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName" onclick="hideSearch('providerName');">供应商\联盟商</a></li>
	           <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="mobilePhone" onclick="hideSearch('mobilePhone');">捆绑手机</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="createDate" onclick="hideSearch('createDate');">加入时间</a></li>
	          </ul></span></span>
			<input type="text" id="accout" name="accout" placeholder="用户账号" class="input-xlarge input-fat" value="<?php echo $accout;?>" style="<?php echo ($searchname == 'accout' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="alias" name="alias" placeholder="昵称" class="input-xlarge input-fat" value="<?php echo $alias;?>" style="<?php echo ($searchname == 'alias' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="providerName" name="providerName" placeholder="供应商\联盟商" class="input-xlarge input-fat" value="<?php echo $providerName;?>" style="<?php echo ($searchname == 'providerName' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="mobilePhone" name="mobilePhone" placeholder="捆绑手机" class="input-xlarge input-fat" value="<?php echo $mobilePhone;?>" style="<?php echo ($searchname == 'mobilePhone' && !empty($searchname))?'':'display:none';?>">
			<span class="sui-dropdown dropdown-bordered select" id="customerTypeSelect" style="<?php echo ($searchname == 'customerType')?'':'display:none';?>"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	          <input value="<?php echo ($customerType)?$customerType:''?>" name="customerType" id="customerType" type="hidden"><i class="caret"></i><span><?php echo ($customerType)?$customerTypelist[$customerType]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">普通会员</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">金星创客</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="3">银星创客</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="4">供应商</a></li>
	            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="5">联盟商</a></li>
            </ul></span></span>
	      
	        <input type="text" id="startDate" name="startDate" placeholder="开始时间" class="input-medium input-fat" value="<?php echo $startDate;?>" style="<?php echo ($searchname=='createDate')?'':'display:none;'?>">
	        <input type="text" id="endDate" name="endDate" placeholder="结束时间" class="input-medium input-fat" value="<?php echo $endDate;?>" style="<?php echo ($searchname=='createDate')?'':'display:none;'?>">
			<button type="submit" id="search-bn" data-url="customer_list/index" class="sui-btn btn-large btn-primary">查询</button>
		</div>
	</form>
</div>
<div class="customer-list">
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
var accout = $('#accout').val();
var customerType = $('#customerType').val();
var alias = $('#alias').val();
var startDate = $('#startDate').val();
var endDate = $('#endDate').val();
var providerName = $('#providerName').val();
var mobilePhone = $('#mobilePhone').val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "customer_list/ajaxIndex?searchname="+searchname+"&accout="+accout+"&customerType="+customerType+"&alias="+alias+"&startDate="+startDate+"&endDate="+endDate+"&providerName="+providerName+"&mobilePhone="+mobilePhone+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.customer-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
function hideSearch(name){
	if(name == 'createDate'){
		$('#accout').hide();
		$('#customerTypeSelect').hide();
		$('#alias').hide();
		$('#providerName').hide();
		$('#mobilePhone').hide();
		$('#startDate').show();
		$('#endDate').show();
	}else if(name == 'accout'){
		$('#accout').show();
		$('#customerTypeSelect').hide();
		
		$('#alias').hide();
		$('#providerName').hide();
		$('#mobilePhone').hide();
		$('#startDate').hide();
		$('#endDate').hide();
	}else if(name == 'customerType'){
		$('#accout').hide();
		$('#customerTypeSelect').show();
		
		$('#alias').hide();
		$('#providerName').hide();
		$('#mobilePhone').hide();
		$('#startDate').hide();
		$('#endDate').hide();
	}else if(name == 'alias'){
		$('#accout').hide();
		$('#customerTypeSelect').hide();
		
		$('#alias').show();
		$('#providerName').hide();
		$('#mobilePhone').hide();
		$('#startDate').hide();
		$('#endDate').hide();
	}else if(name == 'providerName'){
		$('#accout').hide();
		$('#customerTypeSelect').hide();
		
		$('#alias').hide();
		$('#providerName').show();
		$('#mobilePhone').hide();
		$('#startDate').hide();
		$('#endDate').hide();
	}else if(name == 'mobilePhone'){
		$('#accout').hide();
		$('#customerTypeSelect').hide();
		
		$('#alias').hide();
		$('#providerName').hide();
		$('#mobilePhone').show();
		$('#startDate').hide();
		$('#endDate').hide();
	}else{
		$('#accout').hide();
		$('#customerTypeSelect').hide();
		
		$('#alias').hide();
		$('#providerName').hide();
		$('#mobilePhone').hide();
		$('#startDate').hide();
		$('#endDate').hide();
	}
}
</script>