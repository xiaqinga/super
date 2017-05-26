<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="3"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员账号</th>
      <th class="center">会员昵称</th>
      <th class="center">消费总金额</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo ($rs['allPay'])?$rs['allPay']:0;?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
  <tbody>
      <tr>
        <td class="center">亲，还没有商企订单统计!</td>
      </tr>
  </tbody>
</table>
<?php }?>