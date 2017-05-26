<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th width="3%" class="center">ID</th>
      <th class="center">角色名称</th>
      <th class="center">角色描述</th>
      <th class="center">创建时间</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['id'];?></td>
      <td class="center"><?php echo $rs['roleName'];?></td>
      <td class="center"><?php echo $rs['remarks'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>'role/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link role-delete','url'=>'role/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改权限','class'=>'btn-link setpermissions','url'=>'role/permissions','rem'=>'role/permissions?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'setup.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加角色</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _setPermissions = {};
_setPermissions.formdata = '#set-permissions';
_setPermissions.form = $('#mainInfo');
_setPermissions.url = OO._SRVPATH + 'role/save_role_right?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.confirm('.setpermissions',_setPermissions);
var _delete = {};
_delete.body = '确认删除该角色';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'role/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.role-delete',_delete);
</script>