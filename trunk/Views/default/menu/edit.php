<ul class="sui-breadcrumb">
	<li><a><?php echo ($item['id'])?'修改':'添加';?>菜单</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="menu-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">菜单名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $item['id'];?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="hidden" name="parentId" id="parentId" value="<?php echo $item['parentId'];?>" >
      <input type="text" class="input-xlarge input-xfat" id="menuName" name="menuName" placeholder="菜单名称" data-rules="required" data-empty-msg="菜单名称不能为空！"  value="<?php echo $item['menuName'];?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">菜单URL：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="menuUrl" name="menuUrl" placeholder="菜单URL" value="<?php echo $item['menuUrl'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">菜单样式名称：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="menuStyle" name="menuStyle" placeholder="菜单样式名称" value="<?php echo $item['menuStyle'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">序号：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="menuSort" name="menuSort" placeholder="序号" value="<?php echo $item['menuSort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputGender" class="control-label">菜单状态：</label>
    <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
          <input id="menuStatus" name="menuStatus" value="<?php echo ($item['menuStatus'])?$item['menuStatus']:1;?>" type="hidden" data-rules="required"><i class="caret"></i><span><?php echo ($item['menuStatus'])?$dictStatusSelect[$item['menuStatus']]:$dictStatusSelect[1];?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          	<?php foreach ($dictStatusSelect as $qt_key => $qt_val){?>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $qt_key; ?>"><?php echo $qt_val; ?></a></li>
			<?php } ?>
          </ul></span></span></div>
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
  _opts.url = OO._SRVPATH + 'menu/save';
  SAYIMO.form.init('#menu-form', _opts);
});
</script>