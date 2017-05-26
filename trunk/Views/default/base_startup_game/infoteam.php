<ul class="sui-nav nav-tabs nav-xlarge">
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/teamindex?id=<?php echo $tid;?>">返回</a></li>
</ul>

<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="teamName" class="control-label"><span class="required">*</span>团队名称：</label>
    <div class="controls">
      <input type="hidden" name="tid" id="tid" value="<?php echo $tid;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="teamName" name="teamName" value="<?php echo $attr['teamName']?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">缩略图：</label>
    <div class="controls">
      <img style="width: 180px;" src="<?php echo $attr['photoUrl'];?>">
      <!-- <input type="text" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl'];?>"> -->
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">团队人数：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="maxNumberCount" name="maxNumberCount" value="<?php echo $attr['maxNumberCount'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队描述：</label>
    <div class="controls">
      <textarea id="description" class="input-xlarge input-xfat" name="description" data-rules="required" data-empty-msg="技能不能为空!"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  
</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
<script language="javascript" type="text/javascript">


$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
})


</script>
