<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">团队名称</th>
      <th class="center">缩略图</th>
      <th class="center">团队简述</th>
      <th class="center">创建时间</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['teamName'];?></td>
      <td class="center"><img width="80" src="<?php echo $rs['photoUrl'];?>" ></td>
      <td class="center"><?php echo $rs['brief']?></td>
      <td class="center"><?php echo $rs['ceateTime']?></td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_startup_game/infoteam?id='.$rs['id'].'&tid='.$id.'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_startup_game/editteam?id='.$rs['id'].'&tid='.$id.'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'解散','class'=>'btn-link base_position_demand-delete','url'=>'base_startup_game/deleteteam','rid'=>$rs['id'].','.$id,'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没添加团队。</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认解散团队';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_startup_game/deleteteam?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_position_demand-delete',_delete);
</script>