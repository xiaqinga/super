<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_submission/record?id=<?php echo $id;?>">返回</a></li>
</ul>

<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputDes" class="control-label">姓名：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="subName" name="subName" value="<?php echo $attr['subName']?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">联系方式：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="telPhone" name="telPhone" value="<?php echo $attr['telPhone'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">学校：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="schoolName" name="schoolName" value="<?php echo $attr['schoolName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">所属系：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="department" name="department" value="<?php echo $attr['department'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">班级：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="classGrade" name="classGrade" value="<?php echo $attr['classGrade'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">主题：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="subject" name="subject" value="<?php echo $attr['subject'];?>">
    </div>
  </div>

  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top">描述：</label>
    <div class="controls">
      <textarea name="description" data-rules="required" id="description" style="width: 550px;height:200px;" placeholder="从这里开始写正文"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <?php foreach($photoUrl as $v):?>
  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top">活动图片：</label>
    <div class="controls">
      <img src="<?php echo $v;?>" style="width: 100px;">
      <a href="javascript:void(0);" id="upload_btn" onclick="on_photo('<?php echo $v;?>');" class="sui-btn btn-xlarge btn-primary">查看大图</a>
    </div>
  </div>
<?php endforeach;?>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">状态：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="status" name="status" value="<?php if($attr['status'] == 1){echo "未入围";}elseif($attr['status'] == '2'){echo "已入围";}?>">
    </div>
  </div>


</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
<?php echo assets::$editor;?>
<script language="javascript" type="text/javascript">
function on_photo(p){
  window.open(p);
}

$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
})
var $editor = $('#description').editor();
//解决富文本编辑器BUG
setTimeout(
  function() {
    //覆盖分类层BUG
    $(".edui-container").css('z-index', 0);
    //全屏缩小BUG编辑器高度自动变高
    $(".edit_content").on('click', '.edui-btn-fullscreen', function(){
      $(".edui-container").css('z-index', 0);
      if( $(this).parents('.edui-container').width() < 800 ){
        $editorA.editor("setHeight", 260);
        $editorB.editor("setHeight", 130);
      }
    })
  }, 1000);

</script>
