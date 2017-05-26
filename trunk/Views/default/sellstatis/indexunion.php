<style>
.sui-nav.nav-tabs.tab-wraped > li{
	width:100px;
}
.sui-nav.nav-tabs.tab-wraped > li.active > a {
	padding-top: 2px;
}
.sui-nav.nav-tabs.tab-wraped > li > a {
    padding: 4px;
}
</style>
<ul class="sui-nav nav-tabs tab-wraped">
	<?php if(auth_check_permissions('sellstatis/index')){?>
	<li><a href="javascript:;" data-toggle="tab"  data-url="<?php echo APP_URL.'sellstatis/index';?>">
      <h3 style="font-size: 14px;line-height: 0;">供应商</h3>
     </a>
    </li>
    <?php }?>
    <?php if(auth_check_permissions('sellstatis/indexunion')){?>
    <li class="active"><a href="javascript:;" data-toggle="tab" >
      <h3 style="font-size: 14px;line-height: 0;">联盟商</h3>
     </a>
    </li>
    <?php }?>
</ul>
<div class="market_dt10">
	<div class="market_b8">销售统计</div>
	<div class="market_b9">
		<div class="content-top" style="margin: -3px auto;">
			<form class="sui-form" id="search">
				<div class="controls">
					<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
			            <input value="<?php echo ($providerId)?$providerId:'';?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span><?php echo ($providerId)?$providerList[$providerId]:'所有供应商';?></span></a>
			          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
			            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">所有供应商</a></li>
			            <?php if(count($providerList)>0){?>
			            	<?php foreach($providerList as $pl_key=>$pl_val){?>
			            		<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $pl_key;?>"><?php echo $pl_val;?></a></li>
			            <?php }}?>
			          </ul></span></span>
					<button type="submit" id="pr-search-bn" data-url="sellstatis/indexunion" class="sui-btn btn-large btn-primary">查询</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="customerstatis-list">
	<table class="sui-table table-bordered-simple">
	  <thead>
	    <tr class="thbk">
	      <th class="center">总销售金额</th>
	      <th class="center">总收入金额</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<tr>
	  		<td class="center"><?php echo $sellAllTotal;?></td>
	  		<td class="center"><?php echo $brokerageAllTotal;?></td>
	  	</tr>
	  </tbody>
	</table>
</div>
<div class="market_dt10">
	<div class="market_b8">整体趋势</div>
	<div class="market_b9">
		<div class="content-top" style="margin: -3px auto;">
			<form class="sui-form" id="search">
				<input type="hidden" name="providerId" id="providerId" value="<?php echo $providerId;?>">
				<div class="controls">
					<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
			            <input value="<?php echo $year;?>" name="year" id="year" type="hidden"><i class="caret"></i><span><?php echo $year;?></span></a>
			          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
			            <?php if(count($yearlist)>0){?>
			            	<?php foreach($yearlist as $yl_key=>$yl_val){?>
			            		<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $yl_val;?>"><?php echo $yl_val;?></a></li>
			            <?php }}?>
			          </ul></span></span>
					<button type="submit" id="search-bn" data-url="sellstatis/indexunion" class="sui-btn btn-large btn-primary">查询</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="customerstatis-list">
	<div id="canvasDiv"></div>
</div>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#pr-search-bn");
	SAYIMO.form.search("#search-bn");
	var datas = [
	         	{
	         		name : '总销售金额',
	         		data:[<?php echo $sellTotalMonthMonth;?>]
	         	},
	         	{
	         		name : '总收入金额',
	         		data:[<?php echo $brokerageTotalMonth;?>]
	         	}	         	
	         ];
	$('#canvasDiv').highcharts({
		chart : {
			type : 'column'
		},
		title : {
			text : '销售统计'
		},
		xAxis : {
			categories : ['1月', '2月', '3月', '4月', '5月', '6月', '7月',
					'8月', '9月', '10月', '11月', '12月']
		},
		yAxis : {
			min : 0,
			title : {
				text : '金额(元)'
			}
		},
		credits: { enabled: false },
		plotOptions : {
			column : {
				pointPadding : 0.2,
				borderWidth : 0
			}
		},
		series : datas
	});
});
</script>