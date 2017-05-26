<ul class="sui-breadcrumb">
	<li><a>日志详情</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">操作员：</label>
    <div class="controls">
      <?php echo $userName;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">类型：</label>
    <div class="controls">
      <?php echo $actionTypeList[$actionType];?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">操作时间：</label>
    <div class="controls">
    	<?php echo $actionDate;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">组件ID：</label>
    <div class="controls">
    	<?php echo $moduleId;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">备注：</label>
    <div class="controls">
    	<?php echo $actionContent;?>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">IP地址：</label>
    <div class="controls">
      <label class="inline">
      	<?php echo $actionIp;?>
      </label>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>