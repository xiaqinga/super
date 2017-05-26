<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th class="center">广告位名称</th>
      <th class="center">标识符</th>
      <th class="center">广告图</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['configName'];?></td>
      <td class="center"><?php echo $rs['tag']?$rs['tag']:'--';?></td>
      <td class="center">
        <?php if($rs['photoUrl']):?>
          <img width="100" src="<?php echo $rs['photoUrl'];?>"/>
        <?php else:?>
        <?php endif;?>
      </td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_adposition_config/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_adposition_config-delete','url'=>'base_adposition_config/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加广告位</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该广告位';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_adposition_config/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_adposition_config-delete',_delete);
</script>