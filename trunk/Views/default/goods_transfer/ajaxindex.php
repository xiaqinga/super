<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员昵称</th>
      <th class="center">物品名称</th>
      <th class="center">所属分类</th>
      <th class="center">联系人</th>
      <th class="center">联系方式</th>
      <th class="center">金额</th>
      <th class="center">创建时间</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['className'];?></td>
      <td class="center"><?php echo $rs['linkMan'];?></td>
      <td class="center"><?php echo $rs['linkInfo'];?></td>
      <td class="center"><?php echo $rs['price'];?></td>
      <td class="center"><?php echo $rs['createTime'];?></td>
      <td class="center"><?php if(1==$rs['status'] ){echo "上架中";}
                         else if(0==$rs['status']){echo "已删除";}
                         else if(2==$rs['status']){echo "已下架";}
                         else if(3==$rs['status']){echo "转让完成";};?>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'goods_transfer/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php $msg=(2==$rs['status'])?'上架':'下架'; $class=(2==$rs['status'])?'upstore':'downstore';?>
        <?php echo  form_a_auth(array('content'=>$msg,'class'=>'btn-link goods_transfer_class-'.$class,'url'=>'goods_transfer/edit','rid'=>$rs['id'],'img'=>'invalid.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有物品转让信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_transfer/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_transfer_class-delete',_delete);

var _upstore = {};
_upstore.body = '确认上架该物品么';
_upstore.form = $('#mainInfo');
_upstore.url = OO._SRVPATH + 'goods_transfer/upstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_transfer_class-upstore',_upstore);

var _downstore = {};
_downstore.body = '确认下架该物品么';
_downstore.form = $('#mainInfo');
_downstore.url = OO._SRVPATH + 'goods_transfer/downstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_transfer_class-downstore',_downstore);


</script>