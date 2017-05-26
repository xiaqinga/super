<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  #upload_btn{margin-top: 10px;}
</style>
<?php echo assets::$jcrop;?>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>预约商品分类</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="goods_class-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>分类名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="hidden" id="classLevel" name="classLevel" value="<?php echo $attr['classLevel'];?>">
      <input type="hidden" name="parentId" id="parentId" value="<?php echo $attr['parentId'];?>" >
      <input type="text" class="input-xlarge input-xfat" id="className" name="className" data-rules="required" data-empty-msg="分类标题不能为空！"  value="<?php echo  $attr['className'];?>">
    </div>
  </div>
  
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">分类图片：</label>
    <div class="controls">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传分类图片</a>
      <input type="hidden" name="photoUrl" id="photoUrl" value="<?php echo $attr['photoUrl'];?>"/>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;160*160px</span>
    </div>
  </div>
  <div class="control-group followRadio">
    <label for="status" class="control-label"><span class="required">*</span>是否显示分类栏显示：</label>
    <div class="isDisplay">
      <label class="radio-pretty inline <?php if($attr['isDisplay']==1){echo "checked";}?>">
        <input type="radio" <?php if($attr['isDisplay']==1){echo 'checked="checked"';}?> value="1" name="isDisplay"><span>是</span>
      </label>
      <label class="radio-pretty inline <?php if($attr['isDisplay']==0){echo "checked";}?>">
        <input type="radio" <?php if($attr['isDisplay']==0){echo 'checked="checked"';}?> value="0" name="isDisplay"><span>否</span>
      </label>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>排序：</label>
    <div class="controls">
      <input min="0" type="number" class="input-middle input-xfat" id="classSort" name="classSort" data-rules="required" data-empty-msg="排序不能为空！"  value="<?php echo $attr['classSort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>

<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'goods_class/saveb';
  SAYIMO.form.init('#goods_class-form', _opts);
});




/**
 * [图片裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo GOODSLISTIMGPATH;?>',
  'imagePath':'<?php echo GOODSLISTIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [160,160],//裁剪最大尺寸 [width,height]
  'minSize': [160,160],//裁剪最小尺寸 [width,height]
  'picSize': [160,160],//最终保存图片尺寸 [width,height]
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