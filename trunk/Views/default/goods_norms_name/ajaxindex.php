<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk"></th>
      <th width="5%" class="center">规格名称</th>
      <th class="center">规格值 </th>
      <th width="5%" class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['normsName'];?></td>
      <td class="center"><?php echo $rs['normsValueListJion'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'goods_norms_name/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link goods_norms_name-delete','url'=>'goods_norms_name/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加规则</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该规格值';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_norms_name/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_norms_name-delete',_delete);
</script>