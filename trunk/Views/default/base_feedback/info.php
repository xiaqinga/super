<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-breadcrumb">
    <li><a>查看用户反馈信息</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="title" class="control-label">用户昵称:</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['alias']?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">反馈类型：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php if($attr['style'] == '1'){echo "默认类型";}?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">反馈内容：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['content'];?></span>
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">反馈时间：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['createDate'];?></span>
    </div>
  </div>
</form>
<?php echo assets::$sayimo; ?>