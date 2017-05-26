<style>
  .sui-form.form-horizontal .control-label {
    width:110px;
  }
</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>群发</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="user-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"> <span class="required">*</span>群发对象：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <select  name="type">
        <?php foreach($mass_type as $key=>$value):?>
        <option value="<?php echo $key?>" <?php echo ($key==$type)?'selected':''?> ><?php  echo $value ;?></option>
        <?php endforeach ;?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>通知栏提示文字：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="ticker" name="ticker" placeholder="通知栏提示文字" data-rules="required" data-empty-msg="通知栏提示文字不能为空！"  value="<?php echo $ticker;?>">

    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>通知标题：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="title" name="title" placeholder="通知标题" data-rules="required" data-empty-msg="通知标题不能为空！"  value="<?php echo $title;?>">

    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>通知文字描述：</label>
    <div class="controls">
     <textarea name="text" class="input-xlarge input-xfat" data-rules="required" data-empty-msg="通知文字描述不能为空！"><?php echo $text?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required"></span>url：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="url" name="url" placeholder="url"   value="<?php echo $url;?>">

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
  _opts.url = OO._SRVPATH + 'appmass/save';
  SAYIMO.form.init('#user-form', _opts);

 /* SAYIMO.form.rule('accout',{opt:'enname'},'用户账号只能为英文字母');*/

});
</script>