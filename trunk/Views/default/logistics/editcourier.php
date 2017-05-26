<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>快递公司</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="ems-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">快递公司编码：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="emsCode" name="emsCode" placeholder="快递公司编码" data-rules="required" data-empty-msg="快递公司编码不能为空！"  value="<?php echo $emsCode;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">快递公司名称：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="emsName" name="emsName" placeholder="快递公司名称" data-rules="required" data-empty-msg="快递公司名称不能为空！"  value="<?php echo $emsName;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">快递电话：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="emsTel" name="emsTel" placeholder="快递电话" data-rules="tel" data-empty-msg="快递电话不能为空！"  value="<?php echo $emsTel;?>">
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
  _opts.url = OO._SRVPATH + 'logistics/savecourier';
  SAYIMO.form.init('#ems-form', _opts);
});
</script>