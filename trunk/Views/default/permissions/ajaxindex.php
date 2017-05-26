<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th width="3%" class="center">ID</th>
      <th class="center">权限名</th>
      <th class="center">所属菜单</th>
      <th class="center">控制器名</th>
      <th class="center">函数名</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['id'];?></td>
      <td class="center"><?php echo $rs['permissionsName'];?></td>
      <td class="center"><?php echo $menulist[$rs['menuId']];?></td>
      <td class="center"><?php echo $rs['controller'];?></td>
      <td class="center"><?php echo $rs['action'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'permissions/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link permissions-delete','url'=>'permissions/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加权限</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该权限';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'permissions/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.permissions-delete',_delete);
</script>