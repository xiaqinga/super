<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员昵称</th>
      <th class="center">账号</th>
      <th class="center">姓名</th>
      <th class="center">联系方式</th>
      <th class="center">钱包余额</th>
      <th class="center">累计消费</th>
      <th class="center">可用金额</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
     
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['realName'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['remainingMoney'];?></td>
      <td class="center"><?php echo $rs['exPend'];?></td>
      <td class="center"><?php echo $rs['availableMoney']?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除简历';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_resume/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_resume-delete',_delete);
</script>