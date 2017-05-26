<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>富媒体分类</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="base_media_class-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>分类标题：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="classTitle" name="classTitle" data-rules="required" data-empty-msg="分类标题不能为空！"  value="<?php echo  $attr['classTitle'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">父级分类：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $attr['parentId']?$attr['parentId']:0;?>" id="parentId" name="parentId" type="hidden"><i class="caret"></i><span><?php echo $attr['parentClassTitle']?$attr['parentClassTitle']:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
        <?php foreach ($classTitles as $key => $value) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'] ?>"><?php echo $value['classTitle'] ?></a></li>
        <?php endforeach;?>
        </ul></span></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">标识符：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="mark" name="mark" data-rules="required" data-empty-msg="标识符不能为空！"  value="<?php echo $attr['mark'];?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>

<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_media_class/save';
  SAYIMO.form.init('#base_media_class-form', _opts);
});
</script>