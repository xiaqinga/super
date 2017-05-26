<ul class="sui-breadcrumb">
	<li><a>查看APP</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="appmanager-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">应用名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="appName" id="appName" value="<?php echo $appName;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" disabled="" class="input-xlarge input-xfat" id="name" name="name" placeholder="应用名称" data-rules="required" data-empty-msg="应用名称不能为空！"  value="<?php echo $name;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">appSign：</label>
    <div class="controls">
      <input type="text" disabled="" class="input-xlarge input-xfat" id="appSign" name="appSign" placeholder="appSign" data-rules="required" data-empty-msg="appSign不能为空！"  value="<?php echo $appSign;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">应用图标：</label>
    <div class="controls">
      <input type="text" disabled="" class="input-xlarge input-xfat" id="iconUrl" name="iconUrl" placeholder="应用图标" data-rules="required" data-empty-msg="应用图标不能为空！"  value="<?php echo $iconUrl;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">系统：</label>
    <div class="controls">
    <?php echo($mobileSysType!=2)?'Android':'IOS'?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">版本号：</label>
    <div class="controls">
      <input type="text" disabled="" class="input-xlarge input-xfat" id="version" name="version" placeholder="版本号" data-rules="required"  value="<?php echo $version;?>">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">下载方式：</label>
    <div class="controls">
      <?php echo($networkType!=1)?'本地下载地址':'网络下载地址'?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">本地下载地址：</label>
    <div class="controls">
      <input type="text" disabled="" class="input-xlarge input-xfat" id="localUrl" name="localUrl" placeholder="本地下载"  value="<?php echo $localUrl;?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">网络下载地址：</label>
    <div class="controls">
      <input type="text" disabled="" class="input-xlarge input-xfat" id="networkUrl" name="networkUrl" placeholder="网络下载地址"  value="<?php echo $networkUrl;?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">应用/升级说明：</label>
    <div class="controls">
      <textarea id="detail" disabled="" class="input-xlarge" placeholder="应用/升级说明" name="detail"></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">关闭</a>
    </div>
  </div>
</form>
<form id="appmanager-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate" style="float: left;margin-left: 150px;margin-top: 50px;">
  <div class="control-group">
    <div class="controls">
      <img id="a_thumb_preview" width="160" src="<?php echo $iconUrl;?>" style="position:relative;">
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
