<style>
.sui-nav.nav-primary{
  margin-top: 12px;
  margin-bottom: 0px;
}
.load-wrapper{
  margin-top: 30px;
}
.sui-breadcrumb{
  margin:0px;
}
#upload_btn{margin-top: 10px;}
</style>
<ul class="sui-breadcrumb">
    <li><a href="#">活动管理</a></li>
    <li class="active">爆款专区</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-primary">
  <li class="active" onclick="s_navclick('edit');"><a>基本信息</a></li>
  <li onclick="s_navclick('addgoods');"><a>添加商品</a></li>
</ul>

<div class="load-wrapper">
<form id="base_moldbaby-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>爆款名称:</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="name" name="name" data-rules="required" data-empty-msg="名称不能为空！"  value="<?php echo  $attr['name'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="identifier" class="control-label v-top"><span class="required">*</span>标识符：</label>
    <div class="controls">
      <input type="text" <?php if($attr['identifier']){echo 'readonly="true"';}?> class="input-xlarge input-xfat" id="identifier" name="identifier" data-rules="required" data-empty-msg="标识符不能为空！"  value="<?php echo $attr['identifier'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">爆款缩略图：</label>
    <div class="controls">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传缩略图</a>
      <input type="hidden" name="photoUrl" id="photoUrl" value="<?php echo $attr['photoUrl'];?>"/>
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>爆款有效时间:</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['startDate']?>" id="startDate" name="startDate" data-rules="required" type="text"> 至
    <input data-toggle="datepicker" value="<?php echo $attr['endDate']?>" id="endDate" name="endDate" data-rules="required" type="text">
    </div>
  </div>
  <div class="control-group">
   <label for="marketAmount" class="control-label v-top"><span class="required">*</span>单品限购:</label>
    <div class="controls">
      <input min="0" type="number" class="input-medium input-xfat" id="marketAmount" name="marketAmount" data-rules="required" data-empty-msg="单个商品限购不能为空！"  value="<?php echo $attr['marketAmount'];?>">（人/件）
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>爆款描述:</label>
    <div class="controls">
      <textarea name="description" id="description" style="width: 550px;height:200px;" data-rules="required"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="button" class="sui-btn btn-xlarge " onclick="goback();">关闭</button>
      <button type="submit" class="sui-btn btn-xlarge btn-primary">下一步</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>
<?php echo assets::$jcrop;?>

<script type="text/javascript">

function s_navclick(url)
{ 
  $(".sui-nav.nav-tabs").removeClass('active');
  if(url=='edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }
  if(url == 'addgoods'){
    $(".sui-nav.nav-tabs").eq(1).addClass('active');
  }
  if(!$("#id").val() && !$("#goodsType").val()){
    $.alert("请先保存基本信息");
    return false;
  }
  SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/"+url+"?id="+$("#id").val());
}

function goback(){
  SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/index");
}

$("#base_moldbaby-form").validate({
  success: function() {
    save();
    return false;
  }
})

function save()
{
  putdata = $("#base_moldbaby-form").serialize();
  $.ajax({
    type    : "post",
    async   : false,
    url     : '<?php echo APP_URL."base_moldbaby/save";?>',
    data    : putdata,
    dataType: 'json',
    success : function (data){
      if(data['id']){
        SAYIMO.go_url('<?php echo APP_URL."base_moldbaby/addgoods";?>'+"?id="+data['id']);
      }else{
        SAYIMO.go_url('<?php echo APP_URL."base_moldbaby/addgoods";?>'+"?id="+$("#id").val());
      }
    }
  })
}

//实例化编辑器
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

/**
 * [图片裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [160,160],//裁剪最大尺寸 [width,height]
  'minSize': [160,160],//裁剪最小尺寸 [width,height]
  'picSize': [160,160],//最终保存图片尺寸 [width,height]
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