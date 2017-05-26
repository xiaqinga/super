<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>广告</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_adposition-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="adName" class="control-label"><span class="required">*</span>广告名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="adName" name="adName" data-rules="required" data-empty-msg="广告名称不能为空！"  value="<?php echo  $attr['adName'];?>">
    </div>
  </div>
  <div class="control-group edit_url">
    <label for="adLink" class="control-label v-top">广告链接:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="adLink" name="adLink" value="<?php echo $attr['adLink'];?>">
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="sort" class="control-label v-top">排序：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="sort" name="sort" value="<?php echo $attr['sort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="details" class="control-label v-top">详情：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="details" name="details" value="<?php echo $attr['details'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">广告图片：</label>
    <div class="controls">
      <input type="hidden" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl']?$attr['photoUrl']:0;?>">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传图片</a>

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

<?php echo assets::$sayimo; ?>
<?php echo assets::$jcrop;?>

<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_adposition/save';
  SAYIMO.form.init('#base_adposition-form', _opts);
});

/**
 * [图片裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [320,320],//裁剪最大尺寸 [width,height]
  'minSize': [320,320],//裁剪最小尺寸 [width,height]
  'picSize': [0,0],//最终保存图片尺寸 [width,height]
  'quality': 3,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_photo').html('<img src="' + s + '" />');
    if(data.data[0].photoUrl!=undefined){
      $("#photoUrl").val(data.data[0].photoUrl);
    }
  }       
});
</script>