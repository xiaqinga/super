<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">排序</th>
      <th class="center">分类名称</th>
      <th class="center">分类级别</th>
      <th class="center">图片</th>
      <th class="center">创建时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['classSort'];?></td>
      <td class="center"><?php echo $rs['className'];?></td>
      <td class="center"><?php echo '顶级->'.$rs['classLevelName'].$rs['className'];?></td>
      <td class="center"><?php echo $rs['photoUrl']?"<img width=\"75\" src=\"{$rs['photoUrl']}\" />":"--";?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_union_class/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_union_class-delete','url'=>'base_union_class/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加联盟商分类</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该联盟商分类';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_union_class/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_union_class-delete',_delete);
</script>