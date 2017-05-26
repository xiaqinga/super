<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员账号</th>
      <th class="center">会员昵称</th>
      <th class="center">已预约</th>
      <th class="center">预约完成</th>
      <th class="center">预约失败</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo ($rs['receivedOrders'])?$rs['receivedOrders']:0;?></td>
      <td class="center"><?php echo ($rs['complete'])?$rs['complete']:0;?></td>
      <td class="center"><?php echo ($rs['fail'])?$rs['fail']:0;?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有会员预约订单统计!</td>
    	</tr>
	</tbody>
</table>
<?php }?>