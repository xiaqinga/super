<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员账号</th>
      <th class="center">会员昵称</th>
      <th class="center">待支付</th>
      <th class="center">待发货</th>
      <th class="center">待收货</th>
      <th class="center">订单完成</th>
      <th class="center">已退货</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo ($rs['noPay'])?$rs['noPay']:0;?></td>
      <td class="center"><?php echo ($rs['noSend'])?$rs['noSend']:0;?></td>
      <td class="center"><?php echo ($rs['sended'])?$rs['sended']:0;?></td>
      <td class="center"><?php echo ($rs['finished'])?$rs['finished']:0;?></td>
      <td class="center"><?php echo ($rs['returned'])?$rs['returned']:0;?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有会员订单统计!</td>
    	</tr>
	</tbody>
</table>
<?php }?>