<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">团队名称</th>
      <th class="center">标题缩略图</th>
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
        <?php echo form_a_auth(array('content'=>'查看成员','class'=>'btn-link','url'=>APP_URL.'base_startup_game/teammember?id='.$rs['id'].'&gameId='.$id.'&ref='.urlencode($ref),'img'=>'member.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无团队</td>
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