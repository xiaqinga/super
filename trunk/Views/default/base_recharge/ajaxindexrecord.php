<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">账号</th>
      <th class="center">姓名</th>
      <th class="center">消费来源</th>
      <th class="center">消费金额</th>
      <th class="center">消费时间</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['realName'];?></td>
      <td class="center"><?php echo $fromTypes[$rs['fromType']]?></td>
      <td class="center"><?php echo $rs['exPend']?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无消费记录</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除大赛';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_startup_game/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_position_demand-delete',_delete);
</script>