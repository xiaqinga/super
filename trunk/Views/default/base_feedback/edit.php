<style type="text/css">
  #upload_btn{margin-top: 10px;}
</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>赏金</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>需求名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="rewardName" name="rewardName" data-rules="required" data-empty-msg="需求名称不能为空！"  value="<?php echo  $attr['rewardName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="providerName" class="control-label v-top"><span class="required">*</span>所属企业：</label>
    <div class="controls">
      <input type="hidden" name="providerId" id="providerId" value="<?php echo $attr['providerId'];?>"  data-rules="required" data-empty-msg="所属企业不能为空！" >
      <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName" readonly placeholder="请选择供应商" value="<?php echo $attr['providerName'];?>">
    </div>
  </div>

  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>分类：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择分类！"  value="<?php echo $attr['classId']?$attr['classId']:'';?>" id="classId" name="classId" type="hidden"><i class="caret"></i><span><?php echo $attr['className']?$attr['className']:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
        <?php foreach ($classList as $key => $value) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'] ?>"><?php echo $value['className'] ?></a></li>
        <?php endforeach;?>
        </ul></span></span>
    </div>
  </div>
     <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>联系人：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="linkMan" name="linkMan" value="<?php echo $attr['linkMan'];?>" data-rules="required" data-empty-msg="联系人不能为空！" >
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>联系方式：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="linkInfo" name="linkInfo" value="<?php echo $attr['linkInfo'];?>" data-rules="required" data-empty-msg="联系方式不能为空！">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>原赏金：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="originalPrice" name="originalPrice" value="<?php echo $attr['originalPrice'];?>" data-rules="required" data-empty-msg="原赏金不能为空！">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>实际赏金：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="factPrice" name="factPrice" value="<?php echo $attr['factPrice'];?>" data-rules="required" data-empty-msg="实际赏金不能为空！">
    </div>
  </div>
  
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">宣传图：</label>
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
    <label for="inputDes" class="control-label v-top">简述需求：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="resume" name="resume" value="<?php echo $attr['resume'];?>">
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>需求起始时间：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['startDate']?>" id="startDate" data-rules="required" name="startDate" type="text">&nbsp;----&nbsp;
    <input data-toggle="datepicker" value="<?php echo $attr['endDate']?>" id="endDate" data-rules="required" name="endDate" type="text">
    </div>
  </div>

  <div class="control-group">
    <label for="inputDes" class="control-label v-top">详情：</label>
    <div class="controls">
      <textarea id="descrption" class="input-xlarge" name="descrption"><?php echo $attr['descrption'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>排序：</label>
    <div class="controls">
      <input min="0" type="number" data-rules="required" data-empty-msg="请输入正确的排序" class="input-xlarge input-xfat" id="displayOrder" name="displayOrder" value="<?php echo $attr['displayOrder'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>状态：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择分类！"  value="<?php echo $attr['status']?$attr['status']:'';?>" id="status" name="status" type="hidden"><i class="caret"></i><span>
        <?php 
          if($attr['status'] == '1'){echo "待中标";}elseif($attr['status'] =='2'){echo "已中标";}elseif($attr['status'] == '3'){echo "已完成";}elseif($attr['status'] == '-1'){echo "已失败";}else{echo "请选择";}
        ?></span></a>
        <ul role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">待中标</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">已中标</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="3">已完成</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="-1">已失败</a></li>
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
<?php echo assets::$sayimo;?>
<?php echo assets::$editor;?>

<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_reward/save';
  SAYIMO.form.init('#base_media-form', _opts);
});

$(function(){
  //供应商对话框远程加载页面
  //对话框回调函数
  var company_callback = function(o){
    $("#providerId").val(o.attr('data_id'));
    $("#providerCode").val(o.attr('data_code'));
    $("#providerName").val(o.find("span").html());
  }
  SAYIMO.dialogView('js_add_company','供应商','providerName','admin_provider/viewProvider','js_btn_item',company_callback);
});

//实例化编辑器
var $editor = $('#descrption').editor({initialFrameWidth : 780, initialFrameHeight : 260, autoHeightEnabled : false, wordCount : true, topOffset : 110, maximumWords : 3000, wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ', wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});


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