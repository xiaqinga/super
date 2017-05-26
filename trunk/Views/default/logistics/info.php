<ul class="sui-breadcrumb">
	<li><a>查看运费规则</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">运费模板名称：</label>
    <div class="controls">
      <?php echo $logisticsName;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">发货地址：</label>
    <div class="controls">
      <?php echo $aeraCode;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">快递公司：</label>
    <div class="controls">
    	<?php echo ($logisticsCompanyId)?$emslist[$logisticsCompanyId]:'';?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">物流类型：</label>
    <div class="controls">
    	<?php if($logisticsType==1){?>
    		快递
    	<?php }elseif($logisticsType==2){?>
    		物流
    	<?php }else{?>
    		货运
    	<?php }?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">价格类型：</label>
    <div class="controls">
    	<?php if($logisticsType==1){?>
    		按件
    	<?php }else{?>
    		重量
    	<?php }?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">运送范围：</label>
    <div class="controls">
      <label class="inline">
      	除指定地区设置运费外，其余地区则表示不在运送范围内
      </label>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">创建时间：</label>
    <div class="controls">
      <label class="inline">
      	<?php echo $createDate;?>
      </label>
    </div>
  </div>
  <div class="control-group" style="width: 100%;">
  	<table class="sui-table table-bordered-simple" style="width: 55%;">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk" id="unitTr" style="display: <?php echo ($priceType==1 || empty($priceType))?'table-row':'none'?>;">
      	<th class="center">运送到</th>
		<th class="center" width="10%">首件（个）</th>
		<th class="center" width="10%">首费（元）</th>
		<th class="center" width="10%">续件（个）</th>
		<th class="center" width="10%">续费（元）</th>
		<th class="center" class="lastCol" width="10%">创建时间</th>
    </tr>
    <tr class="thbk" id="weightTr" style="display: <?php echo ($priceType==2)?'table-row':'none'?>;">
      	<th class="center">运送到</th>
		<th class="center" width="10%">首重（kg）</th>
		<th class="center" width="10%">首费（元）</th>
		<th class="center" width="10%">续重（kg）</th>
		<th class="center" width="10%">续费（元）</th>
		<th class="center" width="10%">创建时间</th>
    </tr>
  </thead>
  <tbody id="areacode-tr">
  	<?php if(count($areaCodeListStr)>0){?>
  		<?php foreach($areaCodeListStr as $acl_key=>$acl_val){?>
  			<tr>
		      <td class="center">
		      	<?php echo $acl_val['destinations'];?>
		      </td>
		      <td class="center"><?php echo $acl_val['firstItem'];?></td>
		      <td class="center"><?php echo $acl_val['firstCost'];?></td>
		      <td class="center"><?php echo $acl_val['addItem'];?></td>
		      <td class="center"><?php echo $acl_val['addCost'];?></td>
		      <td class="center"><?php echo $acl_val['createDate'];?></td>
		   	</tr>
  	<?php }}?>
  </tbody>
</table>
  </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>