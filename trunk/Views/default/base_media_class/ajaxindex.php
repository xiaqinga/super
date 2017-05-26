<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">分类ID</th>
      <th class="center">分类标题</th>
      <th class="center">标识符</th>
      <th class="center">父级分类名称</th>
      <th class="center">创建时间</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['id'];?></td>
      <td class="center"><?php echo $rs['classTitle'];?></td>
      <td class="center"><?php echo $rs['mark'];?></td>
      <td class="center"><?php echo $rs['parentClassTitle']?$rs['parentClassTitle']:'--';?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_media_class/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_media_class-delete','url'=>'base_media_class/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加富媒体分类</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该富媒体分类';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_media_class/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_media_class-delete',_delete);
</script>