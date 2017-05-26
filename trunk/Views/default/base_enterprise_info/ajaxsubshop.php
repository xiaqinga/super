<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">联盟商编号</th>
      <th class="center">联盟商名称</th>
      <th class="center">联系人</th>
      <th class="center">联系方式</th>
      <th class="center">折扣</th>
      <th class="center">地址</th>
      <th class="center">状态</th>
      <th class="center">创建时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['providerCode'];?></td>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center"><?php echo $rs['linkman'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['serviceCharge'];?></td>
      <td class="center"><?php echo $rs['address'];?></td>
      <td class="center"><?php echo $statuslist[$rs['status']];?></td>
      <td class="center"><?php echo $rs['createTime'];?></td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_enterprise_info/subshopinfo?id='.$id.'&uid='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
        <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_enterprise_info-delete','url'=>'base_enterprise_info/subshopdelete','rid'=>$rs['id'].','.$id,'img'=>'delete.png'));?>

      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">没有您要找的内容</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_enterprise_info/subshopdelete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_enterprise_info-delete',_delete);
</script>
