<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th width="3%" class="center">ID</th>
      <th class="center">系统账号</th>
      <th class="center">姓名</th>
      <th class="center">手机号码</th>
      <th class="center">邮箱</th>
      <th class="center">角色</th>
      <th class="center">所属部门</th>
      <th class="center">创建时间</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['id'];?></td>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['userName'];?></td>
      <td class="center"><?php echo $rs['phoneNumber'];?></td>
      <td class="center"><?php echo $rs['eMail'];?></td>
      <td class="center"><?php echo ($rs['roleId'])?$rolelist[$rs['roleId']]:'';?></td>
      <td class="center"><?php echo ($rs['deptId'])?$deptlist[$rs['deptId']]:'';?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'user/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php if($rs['status'] == 0){?>
      		<?php echo form_a_auth(array('content'=>'启用','class'=>'btn-link user-qstatus','url'=>APP_URL.'user/setStatus','rid'=>$rs['id'],'img'=>'invalid.png'));?>
      	<?php }else{?>
      		<?php echo form_a_auth(array('content'=>'关闭','class'=>'btn-link user-gstatus','url'=>APP_URL.'user/setStatus','rid'=>$rs['id'],'img'=>'activation.png'));?>
      	<?php }?>
      	<?php echo form_a_auth(array('content'=>'密码重置','class'=>'btn-link user-repassword','url'=>APP_URL.'user/rePassword','rid'=>$rs['id'],'img'=>'passwordReset.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link user-delete','url'=>APP_URL.'user/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加用户</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该用户';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'user/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.user-delete',_delete);
var _qstatus = {};
_qstatus.body = '确认启用该用户';
_qstatus.form = $('#mainInfo');
_qstatus.url = OO._SRVPATH + 'user/setStatus?status=1&ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.user-qstatus',_qstatus);
var _gstatus = {};
_gstatus.body = '确认关闭该用户';
_gstatus.form = $('#mainInfo');
_gstatus.url = OO._SRVPATH + 'user/setStatus?status=0&ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.user-gstatus',_gstatus);
var _repassword = {};
_repassword.body = '确认重置该用户密码';
_repassword.form = $('#mainInfo');
_repassword.url = OO._SRVPATH + 'user/rePassword?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.user-repassword',_repassword);
</script>