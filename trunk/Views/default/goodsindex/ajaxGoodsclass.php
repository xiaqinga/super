<?php if(!empty($list)){?>
<table id="classlist" class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">分类名称</th>
      <th class="center">分类级别</th>
      <th class="center">图片</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr onclick="goodsclassid(this,<?php echo $rs['id'];?>,'<?php echo $rs['className'];?>')" <?php echo ($relId == $rs['id'])?'class="trbg"':''?> style="cursor:pointer;">
      <td class="center"><?php echo $rs['className'];?></td>
      <td class="center"><?php echo $rs['class_rumbs'];?></td>
      <td class="center"><img width="75" src="<?php echo $rs['photoUrl']?$rs['photoUrl']:'--';?>" /></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加商品分类</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript">
function goodsclassid(b,id,name){
	$('#actionrelId').val(id);
	$('#actionrelName').val(name);
	$('#classlist tr').removeClass('trbg')
	$(b).addClass('trbg');
}
</script>