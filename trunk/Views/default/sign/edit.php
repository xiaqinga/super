<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  #upload_btn{margin-top: 10px;}
</style>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>

<ul class="sui-breadcrumb">
	<li><a>用户详情</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="goods_class-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">学校名称：</label>
    <div class="controls">
     <span  class="input-xlarge input-xfat" ><?php  echo  $schoolName ?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">真实姓名：</label>
    <div class="controls">
      <span  class="input-xlarge input-xfat" ><?php  echo  $realName ?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">手机号码：</label>
    <div class="controls">
      <span  class="input-xlarge input-xfat" ><?php  echo  $mobilePhone ?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">签到状态：</label>
    <div class="controls">
      <span  class="input-xlarge input-xfat" ><?php  echo  $signStatus==1?'已签到':'未签到'?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">签到时间：</label>
    <div class="controls">
      <span  class="input-xlarge input-xfat" ><?php  echo  $signDate?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">抽奖编号：</label>
    <div class="controls">
      <span  class="input-xlarge input-xfat" ><?php  echo  $lotteryCode?></span>
    </div>
  </div>

</form>

