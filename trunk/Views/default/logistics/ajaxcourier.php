<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">快递公司编码</th>
      <th class="center">快递公司名称</th>
      <th class="center">快递公司电话</th>
      <th class="center">添加时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['emsCode'];?></td>
      <td class="center"><?php echo $rs['emsName'];?></td>
      <td class="center"><?php echo $rs['emsTel'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>'logistics/editcourier?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link logistics-delete','url'=>'logistics/deletecourier','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加快递公司</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该快递公司';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'logistics/deletecourier?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.logistics-delete',_delete);
</script>