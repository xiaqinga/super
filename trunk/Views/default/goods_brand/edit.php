<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  .sui-dropdown.dropdown-bordered>.dropdown-inner>.sui-dropdown-menu li:hover>a .checkbox-pretty.checked>span:before, .radio-pretty.checked>span:before{color: #FFFFFF;}
  .sui-dropdown.dropdown-bordered>.dropdown-inner>.sui-dropdown-menu li:hover>a .checkbox-pretty span:before, .radio-pretty span:before{color: #FFFFFF;}
  #upload_btn{margin-top: 10px;}
  .sui-tag.tag-bordered {
    border: 1px solid #FFF; 
    padding-left: 5px;
    margin-bottom:3px;
    border-radius: 2px;
    border: 1px solid #FFF;
  }
</style>
<script type="text/javascript">
  //初始化
  var classNames = new Array();
  var classIds = new Array(); 
  var checked = input_checked = '';
<?php foreach ($attr['classNames'] as $key => $value) :?>
    classNames.push("<?php echo $value;?>");
<?php endforeach; ?>
<?php
  $classIds = $attr['classIds'];
  if(strpos($classIds, ',')> -1 ){
    $classIds_arr = explode(',', $classIds);
  }else{
    $classIds_arr[] =$classIds;
  }
?>
<?php foreach ($classIds_arr as $key => $value) :?>
    classIds.push(<?php echo $value;?>);
<?php endforeach; ?>
</script>

<?php echo assets::$jcrop;?>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>商品品牌</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="goods_brand-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>品牌名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="brandName" name="brandName" data-rules="required" data-empty-msg="分品牌名称不能为空！"  value="<?php echo  $attr['brandName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">所属分类：</label>
    <div class="controls">
      <ul class="sui-tag tag-bordered" id="classNames">
  <?php foreach ($attr['classNames'] as $key => $value) :?>
        <li class="tag-selected"><?php echo $value;?></li>
  <?php endforeach; ?>
      </ul>
      <span class="sui-dropdown dropdown-bordered goods_brand">
        <span class="dropdown-inner">
          <a role="button" data-toggle="dropdown" class="dropdown-toggle">
            <i class="caret"></i>选择分类</a>
          <ul role="menu" aria-labelledby="drop1" class="sui-dropdown-menu">
            <li role="presentation" class="dropdown-submenu classA">
              <a role="menuitem" tabindex="-1" value="0">
                <label class="checkbox-pretty inline">
                  <input type="checkbox" name="classIds[]" value="100000011"><span></span>
                </label>
                <i class="sui-icon icon-angle-right pull-right"></i>顶级</a>
              <ul class="sui-dropdown-menu">
                <li role="presentation">
                  <a role="menuitem" tabindex="-1">一级</a></li>
                <li role="presentation" class="dropdown-submenu classB">
                  <a role="menuitem" tabindex="-1">
                    <i class="sui-icon icon-angle-right pull-right"></i>二级</a>
                  <ul class="sui-dropdown-menu">
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                  </ul>
                </li>
                <li role="presentation">
                  <a role="menuitem" tabindex="-1">一级</a></li>
              </ul>
            </li>
          </ul>
        </span>
      </span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">品牌图片：</label>
    <div class="controls">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传品牌图片</a>
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
  var _opts = {};
  var submitBefore = function(){
    var classLevel=$('#classLevel').val()*1+1;
    $('#classLevel').val(classLevel);
    return true;
  }
  _opts.url = OO._SRVPATH + 'goods_brand/save';
  SAYIMO.form.init('#goods_brand-form', _opts, submitBefore);
});


//ajax 顶级-->一级分类
$(".goods_brand").on('mouseenter','.classA',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          if(classIds.indexOf(parseInt(data[i].id))>-1){
            checked = "checked";
            input_checked = 'checked="checked"';
          }
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classB"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+
          '<label class="checkbox-pretty inline '+checked+'"><input type="checkbox" name="classIds[]" value="'+data[i].id+'" '+input_checked+'><span></span></label>'+
          (data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
          checked = input_checked = '';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})
//ajax 一级分类-->二级分类
$(".goods_brand").on('mouseenter','.classB',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          if(classIds.indexOf(parseInt(data[i].id))>-1){
            checked = "checked";
            input_checked = 'checked="checked"';
          }
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classC"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+
          '<label class="checkbox-pretty inline '+checked+'"><input type="checkbox" name="classIds[]" value="'+data[i].id+'" '+input_checked+'><span></span></label>'+
          (data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
          checked = input_checked = '';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})

//分类名称跟踪当前 选中的分类
$(".goods_brand").on('click','li a label',function(){
  // event.stopPropagation();
  var _cur = $(this);
  var _cur_name = $.trim($(this).parent('a').text());
  var li='';

  setTimeout(function function_name() {
    if(_cur.hasClass('checked')){
      if( classNames.indexOf(_cur_name) < 0 ){
        classNames.push(_cur_name);
      }
    }else{
      if( classNames.indexOf(_cur_name) >-1 ){
        //删除元素
        for (var i = classNames.length - 1; i >= 0; i--) {
          if(classNames[i] == _cur_name){
            classNames.splice(i,1)
          }
        }
      }
    }
    if(classNames.length>0){
      for (var i = classNames.length - 1; i >= 0; i--) {
        li += '<li class="tag-selected">' + classNames[i] + '</li>';
      }
      $("#classNames").html(li);
    }else{
       $("#classNames").html();
    }
  },300)
})

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
    $('#upload_photo').html('<img src="' + s + '" />');
    if(data.data[0].photoUrl!=undefined){
      $("#photoUrl").val(data.data[0].photoUrl);
    }
  }       
});
</script>