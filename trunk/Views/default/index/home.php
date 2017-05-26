<div class="navList">
	<ul>
		<li>
			<ol class="b72" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_goods_info/index?status=2');"><div><?php echo $orderNoSendCount;?><br />待发货(金)</div></ol>
			<ol class="b02" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_goods_info/index?status=4');"><div><?php echo $orderRefundCount;?><br />待退款(金)</div></ol>
			<ol class="bdf" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_goods_info/index?status=7');"><div><?php echo $orderCompleteCount;?><br />已完成(金)</div></ol>
			<ol class="bffb" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_silver_goods_info/index?status=2');"><div><?php echo $orderNoSendCountSilver;?><br />待发货(银)</div></ol>
			<ol class="b72" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_silver_goods_info/index?status=7');"><div><?php echo $orderCompleteCountSilver;?><br />已完成(银)</div></ol>
			<!-- <ol class="b72" style="cursor: pointer;" onclick="actionmenu('商城管理','29','orders_pre_goods_info/index?status=2');"><div><?php echo $preOrderCount;?><br />待确认预约订单</div></ol> -->
		</li>
		<li>
			<ol class="b02" style="cursor: pointer;" onclick="actionmenu('用户管理','3','base_supplier/index');"><div><?php echo $auditSupplier;?><br />待审核供应商</div></ol>
			<ol class="b73" style="cursor: pointer;" onclick="actionmenu('商城管理','29','goods_list/index');"><div><?php echo $auditGoods;?><br />商品待审核(金)</div></ol>
			<ol class="bffb" style="cursor: pointer;" onclick="actionmenu('商城管理','29','goods_list_silver/index');"><div><?php echo $auditGoodsSilver;?><br />商品待审核(银)</div></ol>
			<ol class="bdf" style="cursor: pointer;" onclick="actionmenu('用户管理','3','base_enterprise_info/index');"><div><?php echo $auditBusiness;?><br />待审核联盟商</div></ol>
		</li>					
	</ul>
</div>
<div class="customerstatis-list">
	<table class="sui-table table-bordered-simple">
	  <thead>
	    <tr class="thbk">
	      <th class="center">总销售金额</th>
	      <th class="center">供应商销售额</th>
	      <th class="center">联盟商销售额</th>
	      <th class="center">总销售商品</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<tr>
	  		<td class="center"><?php echo $sellAllTotal;?></td>
	  		<td class="center"><?php echo $supplierAllTotal;?></td>
	  		<td class="center"><?php echo $businessAllTotal;?></td>
	  		<td class="center"><?php echo $saleAllTotal;?></td>
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
					<button type="submit" id="search-bn" data-url="index/home" class="sui-btn btn-large btn-primary">查询</button>
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
	         		name : '供应商销售额',
	         		data:[<?php echo $supplierTotalMonth;?>]
	         	},
	         	{
	         		name : '联盟商销售额',
	         		data:[<?php echo $businessTotalMonth;?>]
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

<script type="text/javascript">
	function actionmenu(n,d,u){
		SAYIMO.menu(n,d);
		$("#sideNav").children("ul.nav-left").find("a").each(function(){
			var url = $(this).attr("data-ref");
			if(u.indexOf(url) >= 0 ){
				OO.loading(SAYIMO._MAINCONT);
				SAYIMO._MAINCONT.load(OO._SRVPATH + u);
				$(this).parent().addClass('active').siblings().removeClass('active');
				return false;
			}
		});
	}
</script>