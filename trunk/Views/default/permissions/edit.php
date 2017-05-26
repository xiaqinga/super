<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>权限</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="permissions-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">权限名：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="permissionsName" name="permissionsName" placeholder="权限名" data-rules="required" data-empty-msg="权限名不能为空！"  value="<?php echo $permissionsName;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputGender" class="control-label">所属菜单：</label>
    <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
          <input id="menuId" name="menuId" value="<?php echo ($menuId)?$menuId:'';?>" type="hidden" data-rules="required"><i class="caret"></i><span><?php echo ($menuId)?$menu_list[$menuId]:'请选择菜单';?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          	<?php foreach ($menulist[1] as $ml_key => $ml_val){?>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $ml_val['id']; ?>"><?php echo $ml_val['menuName']; ?></a></li>
				<?php if(isset($menulist[$ml_val['id']])){?>
					<?php foreach ($menulist[$ml_val['id']] as $mlz_key => $mlz_val){?>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $mlz_val['id']; ?>"><?php echo $mlz_val['menuName']; ?></a></li>
					<?php } ?>
				<?php }?>
			<?php } ?>
          </ul></span></span>
          <span class="required">*</span>
          </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">控制器名：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="controller" name="controller" placeholder="控制器名" data-rules="required" data-empty-msg="控制器名不能为空！"  value="<?php echo $controller;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">函数名：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="action" name="action" placeholder="函数名" data-rules="required" data-empty-msg="函数名不能为空！"  value="<?php echo $action;?>">
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
  _opts.url = OO._SRVPATH + 'permissions/save';
  SAYIMO.form.init('#permissions-form', _opts);
});
</script>