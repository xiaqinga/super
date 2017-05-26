<style type="text/css">
  #upload_btn{margin-top: 10px;}
</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>校讯资讯</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>文章标题：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="title" name="title" data-rules="required" data-empty-msg="标题不能为空！"  value="<?php echo  $attr['title'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">来源：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="source" name="source" value="<?php echo $attr['source'];?>">
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">作者：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="author" name="author" value="<?php echo $attr['author'];?>">
    </div>
  </div>

  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>发布时间：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['publishdate']?>" id="publishdate" data-rules="required" name="publishdate" type="text">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">标题缩略图：</label>
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
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">资讯简介：</label>
    <div class="controls">
      <textarea id="instruction" class="input-xlarge" name="instruction"><?php echo $attr['instruction'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"></label>
    <div class="controls edit_click_btn">
        <label class="radio-pretty inline <?php if($attr['showType']=='image' || !$attr['showType']){ echo 'checked';}?> ">
          <input type="radio" <?php if( $attr['showType']=='image' || !$attr['showType'] ){ echo 'checked="checked"';}?> name="showType" value="image"><span>图文资讯</span>
        </label>

        <label class="radio-pretty inline <?php if($attr['showType']=='url'){ echo 'checked';}?> ">
          <input type="radio" <?php if($attr['showType']=='url'){ echo 'checked="checked"';}?> name="showType" value="url"><span>Url</span>
        </label>
        <input type="hidden" name="materailId" id="materailId" value="<?php echo $attr['materailId'];?>" >
    </div>
  </div>
  <div class="control-group edit_url" <?php if( $attr['showType']=='image' ||  !$attr['showType']):?> style="display: none;" <?php endif;?> >
    <label for="inputDes" class="control-label v-top">Url地址:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="urlPath" name="urlPath" value="<?php echo $attr['urlPath'];?>">
    </div>
  </div>
  <div class="control-group edit_content" <?php if( $attr['showType']=='news' || $attr['showType']=='url' ):?> style="display: none;" <?php endif;?>>
    <label for="inputDes" class="control-label v-top">详细内容：</label>
    <div class="controls">
      <textarea name="details" id="details" style="width: 550px;height:200px;" placeholder="从这里开始写正文"><?php echo $attr['details'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">排序：</label>
    <div class="controls">
      <input min="0" type="number" class="input-xlarge input-xfat" id="sort" name="sort" value="<?php echo $attr['sort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">标识：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="mark" name="mark" value="<?php echo $attr['mark'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>状态：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择状态！" value="<?php echo $attr['status'];?>" id="status" name="status" type="hidden"><i class="caret"></i><span><?php echo $statuslist[$attr['status']]?$statuslist[$attr['status']]:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
        <?php foreach ($statuslist as $s_key => $s_val){?>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $s_key; ?>"><?php echo $s_val; ?></a></li>
        <?php }?>     
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



<script type="text/javascript">



$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_school_news/save';
  SAYIMO.form.init('#base_media-form', _opts);
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

var editorA=UE.getEditor('details',
    {initialFrameWidth : 720,
      initialFrameHeight : 260,
      autoHeightEnabled : false,
      wordCount : true, topOffset : 110,
      maximumWords : 3000,
      wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ',
      wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！',
      allowLinkProtocols: ['http:', 'https:', '#', '/', 'ftp:', 'mailto:', 'tel:','javascript:', 'git:', 'svn:']



    });



 //图文,  微信素材  url
$(".edit_click_btn").on('click','input',function(){
  if($(this).val()=='image'){
    $(".edit_url").hide();
    $(".edit_content").show();
  }else if($(this).val()=='url'){
    $(".edit_url").show();
    $(".edit_content").hide();
  }
})

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
</script>