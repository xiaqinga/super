<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>角色</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="role-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">角色名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="roleName" name="roleName" placeholder="角色名称" data-rules="required" data-empty-msg="角色名称不能为空！"  value="<?php echo $roleName;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">描述：</label>
    <div class="controls">
      <textarea id="remarks" class="input-xlarge" name="remarks" placeholder="描述"><?php echo $remarks;?></textarea>
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
  _opts.url = OO._SRVPATH + 'role/save';
  SAYIMO.form.init('#role-form', _opts);
});
</script>