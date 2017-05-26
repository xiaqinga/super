<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  #upload_btn{margin-top: 10px;}
</style>
<?php echo assets::$jcrop;?>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>转让分类</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="goods_transfer_class-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>分类标题：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="hidden" name="parentId" id="parentId" value="<?php echo $attr['parentId'];?>" >
      <input type="text" class="input-xlarge input-xfat" id="className" name="className" data-rules="required" data-empty-msg="分类标题不能为空！"  value="<?php echo  $attr['className'];?>">
    </div>
  </div>
  <!--<div class="control-group">
    <label for="inputDes" class="control-label v-top">上级分类：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered goods_transfer_class">
        <span class="dropdown-inner">
          <a role="button" data-toggle="dropdown" class="dropdown-toggle">
            <i class="caret"></i><?php /*echo $attr['class_parent']?$attr['class_parent']:'请选择'*/?></a>
          <ul role="menu" aria-labelledby="drop1" class="sui-dropdown-menu">
            <li role="presentation" class="dropdown-submenu classA">
              <a role="menuitem" tabindex="-1"  value="0">
                <i class="sui-icon icon-angle-right pull-right"></i>顶级</a>
            </li>
          </ul>
        </span>
      </span>
    </div>
  </div>-->
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>分类图片：</label>
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
  var submitBefore = function(){
    var listphote = $('#photoUrl').val();
    if (listphote == '') {
      $.alert('分类图片不能为空');
      return false;
    }

    return true;
  }

  var _opts = {};
  _opts.url = OO._SRVPATH + 'goods_transfer_class/save';
  SAYIMO.form.init('#goods_transfer_class-form', _opts, submitBefore);



});


//ajax 顶级-->一级分类
$(".goods_transfer_class").on('mouseenter','.classA',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_transfer_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classB"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);"  value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})
//ajax 一级分类-->二级分类
$(".goods_transfer_class").on('mouseenter','.classB',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_transfer_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classC"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" classLevelId="3" value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})

//跟踪当前 选中的分类
$(".goods_transfer_class").on('click','li a',function(){
  var _cur = $(this).eq(0);
  $(".goods_transfer_class .dropdown-inner a:eq(0)").text(_cur.text());
  $('#classLevel').val(_cur.attr('classLevelId'));
  $("#parentId").val(_cur.attr('value'));
})

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
  'quality': 1,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_photo').html('<img src="' + s + '" />');
    if(data.data[0].photoUrl!=undefined){
      $("#photoUrl").val(data.data[0].photoUrl);
    }
  }       
});
</script>