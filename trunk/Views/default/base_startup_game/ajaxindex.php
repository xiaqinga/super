<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th class="center">标示符</th>
      <th class="center">大赛名称</th>
      <th class="center">标题缩略图</th>
      <th class="center">规则简述</th>
      <th class="center">有效期</th>
      <th class="center">创建时间</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['identifier'];?></td>
      <td class="center"><?php echo $rs['activityName'];?></td>
      <td class="center"><img width="80" src="<?php echo $rs['photoUrl'];?>" ></td>
      <td class="center"><?php echo $rs['brief']?></td>
      <td class="center"><?php echo $rs['startDate']."----".$rs['endDate'];?></td>
      <td class="center"><?php echo $rs['createTime']?></td>
      <td class="center"><?php if($rs['status'] == "1"){echo"启用";}else{echo"禁用";};?>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_startup_game/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_startup_game/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_position_demand-delete','url'=>'base_startup_game/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没添加创客大赛</td>
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