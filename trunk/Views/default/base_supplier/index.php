<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
			<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	      <input value="<?php echo ($searchname)?$searchname:''?>" name="searchname" id="searchname" type="hidden"><i class="caret"></i><span><?php echo ($searchname)?$searchnamelist[$searchname]:'请选择'?></span></a>
	      <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	      	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="" onclick="hideSearch('');">请选择</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName" onclick="hideSearch('providerName');">企业名称</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="corporate" onclick="hideSearch('corporate');">法人代表</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="address" onclick="hideSearch('address');">地址</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="accout" onclick="hideSearch('accout');">捆绑账号</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="status" onclick="hideSearch('status');">状态</a></li>
	      </ul></span></span>

			<input type="text" id="providerName" name="providerName" placeholder="企业名称" class="input-large" value="<?php echo $providerName;?>" style="<?php echo ($searchname == 'providerName' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="corporate" name="corporate" placeholder="法人代表" class="input-large" value="<?php echo $corporate;?>" style="<?php echo ($searchname == 'corporate' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="address" name="address" placeholder="地址" class="input-large" value="<?php echo $address;?>" style="<?php echo ($searchname == 'address' && !empty($searchname))?'':'display:none';?>">
			<input type="text" id="accout" name="accout" placeholder="捆绑账号" class="input-large" value="<?php echo $accout;?>" style="<?php echo ($searchname == 'accout' && !empty($accout))?'':'display:none';?>">
			<span class="sui-dropdown dropdown-bordered select" id="status" style="<?php echo ($searchname == 'status' && !empty($searchname))?'':'display:none';?>"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
			
	      <input value="<?php echo ($status)?$status:''?>" name="status" id="status" type="hidden"><i class="caret"></i><span><?php echo ($status)?$statuslist[$status]:'请选择'?></span></a>
	      <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	      	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">已审核</a></li>
	        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">待审核</a></li>
	      </ul></span></span>
			<button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_supplier/index" class="sui-btn btn-large btn-primary">查询</button>
		<!--	<?php /*echo form_a_auth(array('content'=>'添加供应商 ','class'=>'btn-large','check'=>'base_supplier/add','url'=>APP_URL.'base_supplier/edit?ref='.$ref));*/?>
		--></div>
	</form>
</div>
<div class="provider-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>


<?php echo assets::$sayimo; ?>
<script type="text/javascript">

$(function(){
	//供应商跳转到详情
	<?php if($providerIdCur):?>
		SAYIMO.go_url("<?php echo APP_URL.'base_supplier/edit?id='.$providerIdCur.'&ref='.$ref;?>");
	<?php endif;?>

	//查找
	SAYIMO.form.search("#search-bn");

	//分页
	var  parameter = $('#search').serialize();
	var _pagedata = {};
	_pagedata.total = "<?php echo $page['total']?>";
	_pagedata.pagesize = "<?php echo $page['pagesize']?>";
	_pagedata.page = "<?php echo $pageindex;?>";
	_pagedata.url = "base_supplier/ajaxIndex?"+parameter+"&pagesize=<?php echo $page['pagesize'];?>&page=";
	_pagedata.container = '.provider-list';
	_pagedata.labelname = '.page';
	SAYIMO.pagination(_pagedata);

});

function hideSearch(name){
	if(name == 'providerName'){
		$('#providerName').show();
		$('#corporate').hide();
		$('#address').hide();
		$('#accout').hide();
		$('#status').hide();
	}else if(name == 'corporate'){
		$('#providerName').hide();
		$('#corporate').show();
		$('#address').hide();
		$('#accout').hide();
		$('#status').hide();
	}else if(name == 'address'){
		$('#providerName').hide();
		$('#corporate').hide();
		$('#address').show();
		$('#accout').hide();
		$('#status').hide();
	}else if(name == 'accout'){
		$('#providerName').hide();
		$('#corporate').hide();
		$('#address').hide();
		$('#accout').show();
		$('#status').hide();
	}else if(name == 'status'){
		$('#providerName').hide();
		$('#corporate').hide();
		$('#address').hide();
		$('#accout').hide();
		$('#status').show();
	}else{
		$('#providerName').hide();
		$('#corporate').hide();
		$('#address').hide();
		$('#accout').hide();
		$('#status').hide();
	}
}
</script>
