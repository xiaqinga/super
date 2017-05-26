<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>用户</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="user-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">账号：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="accout" name="accout" placeholder="账号" data-rules="required|accout|accoutcheck" data-empty-msg="账号不能为空！"  value="<?php echo $accout;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">姓名：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="userName" name="userName" placeholder="姓名" data-rules="required" data-empty-msg="姓名不能为空！"  value="<?php echo $userName;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">手机号码：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="phoneNumber" name="phoneNumber" placeholder="手机号码" data-rules="required|mobphone|phonecheck" data-empty-msg="手机号码不能为空！"  value="<?php echo $phoneNumber;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">邮箱：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="eMail" name="eMail" placeholder="邮箱" data-rules="required|email" data-empty-msg="邮箱不能为空！"  value="<?php echo $eMail;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputGender" class="control-label">角色：</label>
    <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
          <input id="roleId" name="roleId" value="<?php echo ($roleId)?$roleId:'';?>" type="hidden" data-rules="required"><i class="caret"></i><span><?php echo ($roleId)?$rolelist[$roleId]:'请选择角色';?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          	<?php foreach ($rolelist as $r_key => $r_val){?>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $r_key; ?>"><?php echo $r_val; ?></a></li>
			<?php } ?>
          </ul></span></span>
          <span class="required">*</span>
          </div>
  </div>
 
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'user/save';
  SAYIMO.form.init('#user-form', _opts);

  SAYIMO.form.rule('accout',{opt:'enname'},'用户账号只能为英文字母');
  SAYIMO.form.rule('accoutcheck',{opt:'remote',name: 'accout', url: 'user/checkexist'},'用户账号已存在');
  SAYIMO.form.rule('mobphone',{opt:'mobphone'},'请填写正确的手机号');
  SAYIMO.form.rule('phonecheck',{opt:'remote',name: 'phoneNumber', url: 'user/checkexist'},'手机号码已存在');
});
</script>