<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li class="active"><a>基本信息</a></li>
    <li onclick="s_navclick('record');"><a>投稿列表</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_submission/index">返回</a></li>
</ul>

<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputDes" class="control-label">名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="subName" name="subName" value="<?php echo $attr['subName']?>">
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">标识符：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" value="<?php echo $attr['identifier'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">缩略图：</label>
    <div class="controls">
      <img src="<?php echo $attr['photoUrl'];?>">
      <!-- <input type="text" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl'];?>"> -->
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>规则简述：</label>
    <div class="controls">
      <textarea id="brief" class="input-xlarge input-xfat" name="description" data-rules="required" data-empty-msg="技能不能为空!"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>有效期：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['startDate']?>" id="startDate" data-rules="required" name="startDate" type="text"> ---
    <input data-toggle="datepicker" value="<?php echo $attr['endDate']?>" id="endDate" data-rules="required" name="endDate" type="text">
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>详细内容：</label>
    <div class="controls">
      <textarea name="detail" data-rules="required" id="detail" style="width: 550px;height:200px;" placeholder="从这里开始写正文"><?php echo $attr['detail'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">状态：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="status" name="status" value="<?php if($attr['status'] == 1){echo "启用";}else{echo"禁用";}?>">
    </div>
  </div>


</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
<?php echo assets::$editor;?>
<script language="javascript" type="text/javascript">

function s_navclick(url)
  { 
    if(url == "record"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_submission/record?id=<?php echo $id;?>");
    }
  
  }



$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
})
var $editor = $('#detail').editor();
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
