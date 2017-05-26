<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员昵称</th>
      <th class="center">姓名</th>
      <th class="center">联系方式</th>
      <th class="center">学校</th>
      <th class="center">加入时间</th>
      <th class="center">销售额</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['name'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['schoolName']?></td>
      <td class="center"><?php echo $rs['entryTime']?></td>
      <td class="center"><?php echo $rs['sellPrice']?></td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_startup_game/infoteamPes?id='.$rs['id'].'&gameId='.$gameId.'&teamId='.$id.'&ref='.urlencode($ref),'img'=>'member.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无团员</td>
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