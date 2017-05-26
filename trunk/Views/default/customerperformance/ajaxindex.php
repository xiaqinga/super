<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员帐号</th>
      <th class="center">会员昵称</th>
      <th class="center">下级会员数量</th>
      <th class="center">销售额</th>
      <th class="center">消费金额</th>
      <th class="center">总公益基金</th>
      <th class="center">活跃度</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo ($rs['lowerLevelCount'])?$rs['lowerLevelCount']:0;?></td>
      <td class="center"><?php echo ($rs['Sales'])?$rs['Sales']:0;?></td>
      <td class="center"><?php echo ($rs['totalAmount'])?$rs['totalAmount']:0;?></td>
      <td class="center"><?php echo ($rs['fund'])?$rs['fund']:0;?></td>
      <td class="center"><?php echo ($rs['loginTimes'])?$rs['loginTimes']:0;?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有会员业绩!</td>
    	</tr>
	</tbody>
</table>
<?php }?>