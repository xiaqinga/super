<!-- <div class="market_dt10">
	<div class="market_b8">会员统计</div>
	<div class="market_b9">商企统计</div>
</div> -->
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
	<?php if(auth_check_permissions('customerstatis/index')){?>
	<li><a href="javascript:;" data-toggle="tab" data-url="<?php echo APP_URL.'customerstatis/index';?>" style="border-right: 1px solid #ddd;">
      <h3 style="font-size: 14px;line-height: 0;">会员统计</h3>
     </a>
    </li>
    <?php }?>
    <?php if(auth_check_permissions('customerstatis/indexbusiness')){?>
    <li class="active"><a href="javascript:;" data-url="<?php echo APP_URL.'customerstatis/indexbusiness';?>" data-toggle="tab">
      <h3 style="font-size: 14px;line-height: 0;">商企统计</h3>
     </a>
    </li>
    <?php }?>
</ul>
<div class="customerstatis-list">
	<table class="sui-table table-bordered-simple">
	  <thead>
	    <tr class="thbk">
	      <th class="center">供应商</th>
		  <th class="center">联盟商</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<tr>
	  		<td class="center"><?php echo $supplyCount;?></td>
	  		<td class="center"><?php echo $unionCount;?></td>
	  	</tr>
	  </tbody>
	</table>
</div>
<div class="market_dt10">
	<div class="market_b8">整体趋势</div>
	<div class="market_b9">
		<div class="content-top" style="margin: -3px auto;">
			<form class="sui-form" id="search">
				<div class="controls">
					<span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
			            <input value="<?php echo $year;?>" name="year" id="year" type="hidden"><i class="caret"></i><span><?php echo $year;?></span></a>
			          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
			            <?php if(count($yearlist)>0){?>
			            	<?php foreach($yearlist as $yl_key=>$yl_val){?>
			            		<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $yl_val;?>"><?php echo $yl_val;?></a></li>
			            <?php }}?>
			          </ul></span></span>
					<button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>customerstatis/indexbusiness" class="sui-btn btn-large btn-primary">查询</button>
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
	SAYIMO.form.search("#search-bn");
	var datas = [
	         	{
	         		name : '供应商',
	         		data:[<?php echo $providerTotalMonth;?>]
	         	},
	         	{
	         		name : '联盟商',
	         		data:[<?php echo $customerTotalMonth;?>]
	         	}	         	
	         ];
	$('#canvasDiv').highcharts({
		chart : {
			type : 'column'
		},
		title : {
			text : '会员统计'
		},
		xAxis : {
			categories : ['1月', '2月', '3月', '4月', '5月', '6月', '7月',
					'8月', '9月', '10月', '11月', '12月']
		},
		yAxis : {
			min : 0,
			title : {
				text : '数量(个)'
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