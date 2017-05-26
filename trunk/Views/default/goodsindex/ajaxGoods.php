<?php if(!empty($list)){?>
<table id="goodslist" class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">商品名称</th>
      <th class="center">发货地址</th>
      <th class="center">所属商城</th>
      <th class="center">供应商名称</th>
      <th class="center">分类</th>
      <th class="center">销量</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr onclick="goodsid(this,<?php echo $rs['id'];?>,'<?php echo $rs['goodsName'];?>')" <?php echo ($relId == $rs['id'])?'class="trbg"':''?> style="cursor:pointer;">
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['sourceSendAddress'];?></td>
      <td class="center"><?php echo $mallTypes[$rs['mallType']];?></td>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center"><?php echo $rs['goodsClassName'];?></td>
      <td class="center"><?php echo $rs['sellNum'];?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加商品</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript">
function goodsid(b,id,name){
	$('#actionrelId').val(id);
	$('#actionrelName').val(name);
	$('#goodslist tr').removeClass('trbg')
	$(b).addClass('trbg');
}
</script>