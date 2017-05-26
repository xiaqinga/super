<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li class="active"><a><?php echo ($attr['id'])?'修改':'添加';?>团队</a></li>
  <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/teamindex?id=<?php echo $tid;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>团队名称：</label>
    <div class="controls">
      <input type="hidden" name="tid" id="tid" value="<?php echo $tid;?>">
      <input type="hidden" name="id" id="id" value="<?php echo $attr['id'];?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="teamName" name="teamName" data-rules="required"  value="<?php echo  $attr['teamName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>缩略图：</label>
    <div class="controls">
      <input type="hidden" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl']?$attr['photoUrl']:0;?>">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传图片</a>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;320*320px</span>
    </div>
  </div>
  
  <div class="control-group" id="teamMaxCountClass">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队人数：</label>
    <div class="controls">
      <input type="number" class="input-xlarge input-xfat" id="maxNumberCount" name="maxNumberCount"data-rules="required" value="<?php echo $attr['maxNumberCount'];?>">&nbsp;&nbsp;(0表示不限制)
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>团队简述：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="brief" name="brief" data-rules="required"  value="<?php echo  $attr['brief'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队描述：</label>
    <div class="controls">
      <textarea id="description"  style="width: 550px;height:200px;" name="description" data-rules="required" data-empty-msg="团队描述不能为空!"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>团队简述：</label>
    <div class="controls">
      <input type="number" class="input-xlarge input-xfat" id="sort" name="sort" data-rules="required"  value="<?php echo  $attr['sort'];?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>
</div>
<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>

<script language="javascript" type="text/javascript">


$(function(){
  var submitBefore = function(){
    var photoUrl = $('#photoUrl').val();
    if (photoUrl == '0') {
      $.alert('缩略图不能为空');
    }else{
      return true;
    } 
  };
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_startup_game/saveteam';
  SAYIMO.form.init('#base_media-form', _opts, submitBefore);
});

//实例化编辑器

UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
UE.Editor.prototype.getActionUrl = function(action) {
  if (action == 'uploadimage' || action == 'uploadscrawl' || action == 'uploadimage') {
    return "<?php echo IMAGE_FILE_SER?>";
  } else if (action == 'uploadvideo') {
    return "<?php echo IMAGE_FILE_SER?>";
  } else {
    return this._bkGetActionUrl.call(this, action);
  }
}

var editorA=UE.getEditor('description',{initialFrameWidth : 720, initialFrameHeight : 260, autoHeightEnabled : false, wordCount : true, topOffset : 110, maximumWords : 3000, wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ', wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});


/**
 * [图片裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [320,320],//裁剪最大尺寸 [width,height]
  'minSize': [320,320],//裁剪最小尺寸 [width,height]
  'picSize': [320,320],//最终保存图片尺寸 [width,height]
  'quality': 3,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_photo').html('<img src="' + s + '"  />');
    if(data.data[0].photoUrl!=undefined){
      $("#photoUrl").val(data.data[0].photoUrl);
    }
  }       
});


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
