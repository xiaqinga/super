<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">名称</th>
      <th class="center">所属分类</th>
      <th class="center">图片</th>
      <th class="center">创建时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['brandName'];?></td>
      <td class="center"><?php echo $rs['classNames'];?></td>
      <td class="center">
      <?php if($rs['photoUrl']):?>
        <img width="75" src="<?php echo $rs['photoUrl'];?>" />
      <?php else:?>
        --
      <?php endif;?>
      </td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'goods_brand/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link goods_brand-delete','url'=>'goods_brand/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加商品品牌</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该商品品牌';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_brand/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_brand-delete',_delete);
</script>