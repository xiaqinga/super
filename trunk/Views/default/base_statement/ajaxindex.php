<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th class="center">订单号</th>
      <th class="center">供应商名称</th>
      <th class="center">消费金额</th>
      <th class="center">收入手续费</th>
      <th class="center">结算金额</th>
      <th class="center">支出手续费</th>
      <th class="center">提款方式</th>
      <th class="center">完成时间</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['ordersNo'];?></td>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center"><?php echo $rs['turnover'];?></td>
      <td class="center"><?php echo $rs['turnover']*0.006;?></td>
      <td class="center"><?php echo $rs['inCome'];?></td>
      <td class="center"><?php echo $rs['inCome']*0.006;?></td>
      <td class="center"><?php if($rs['fromType']==1){echo "银行卡支付";}elseif($rs['fromType']==5){echo "支付宝支付";}?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有对账管理</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_activity/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_activity_class-delete',_delete);
</script>