<ul class="sui-nav nav-tabs nav-large nav-primary" style="margin-top: 10px;">
  <li><a href="javascript:;" data-url="<?php echo APP_URL.'logistics/index'?>">运费列表</a></li>
  <li class="active"><a href="javascript:;">运费策略配置</a></li>
  <li><a href="javascript:;" data-url="<?php echo APP_URL.'logistics/courier'?>">快递公司列表</a></li>
</ul>
<form id="freeMinConsumption-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="freeMinConsumption" class="control-label"><span class="required">*</span>最低消费金额：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="text" class="input-medium input-xfat" id="freeMinConsumption" name="freeMinConsumption" placeholder="最低消费金额" data-rules="required" data-empty-msg="最低消费金额不能为空！"  value="<?php echo $freeMinConsumption;?>">
      <span>元</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <span>非活动商品，最低消费金额达到设定值，免运费</span>
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
  _opts.url = OO._SRVPATH + 'logistics/saveCostconfig';
  SAYIMO.form.init('#freeMinConsumption-form', _opts);
});
</script>