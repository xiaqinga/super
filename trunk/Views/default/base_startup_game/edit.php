<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li class="active" onclick="s_navclick('index');"><a><?php echo ($id)?'修改':'添加';?>大赛</a></li>
  <?php if($attr['teamType'] == '2'){?>
  <li onclick="s_navclick('teamindex');"><a>团队列表</a></li>
  <?php }?>
  <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>大赛名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="activityName" name="activityName" data-rules="required"  value="<?php echo  $attr['activityName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>大赛标识符：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" data-rules="required" value="<?php echo $attr['identifier'];?>">
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
  <?php if($id){?>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队类型：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner">
      <a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择" value="<?php echo $attr['teamType']?$attr['teamType']:'';?>" id="teamType" name="teamType" type="hidden"><i class="caret"></i><span><?php echo $teamTypelist[$attr['teamType']];?></span>
      </a>   
    </div>
  </div>
  <?php }else{?>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队类型：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择"  onchange="onChangeteamType();"  value="<?php echo $attr['teamType']?$attr['teamType']:'';?>" id="teamType" name="teamType" type="hidden"><i class="caret"></i><span><?php echo $teamTypelist[$attr['teamType']]?$teamTypelist[$attr['teamType']]:'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
        <?php foreach ($teamTypelist as $s_key => $s_val){?>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $s_key; ?>"><?php echo $s_val; ?></a></li>
        <?php }?>     
    </div>
  </div>
  <?php }?>
  <?php if(($attr['teamType'] == '1') || empty($attr['teamType'])){?>
  <div class="control-group" id="teamMaxCountClass">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>团队人数：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="teamMaxCount" name="teamMaxCount" <?php if(($attr['teamType'] == '1') || empty($attr['teamType'])){echo 'data-rules="required"';}?> value="<?php echo $attr['teamMaxCount'];?>">
    </div>
  </div>
  <?php }?>
  <div class="control-group">
    <label for="photoId" class="control-label v-top"><span class="required">*</span>轮播图：</label>
    <div class="controls">
      <div class="photo_wraper photo_main">
      <?php foreach ($main_photos as $key => $value) :?>
        <div class="photo_item Js_item">
            <img class="photo_img Js_img" id="iconImg" src="<?php echo $value['photoPath'];?>" alt="标题缩略图" style="width:130px;">
            <div class="photo_del Js_delphoto" photoId="<?php echo $value['id'];?>" index="<?php echo $key;?>"><i class="sui-icon icon-tb-delete"></i></div>
            <div class="photo_mvleft Js_move_left"><i class="sui-icon icon-pc-chevron-left"></i></div>
            <div class="photo_mvright Js_move_right"><i class="sui-icon icon-pc-chevron-right"></i></div>
            <div class="photo_bg"></div>
        </div>
      <?php endforeach;?>
      </div>
      <input type="hidden" id="photos" name="photos" value="">
      <input type="hidden" id="listphote" name="listphote" value="<?php echo json_encode($main_photos);?>">
      <a style="margin-top: 5px;" href="javascript:void(0);" id="upload_main" class="sui-btn btn-xlarge btn-primary">上传商品轮播图</a>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;640*480px</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>规则简述：</label>
    <div class="controls">
      <textarea id="brief" class="input-xlarge" name="brief" data-rules="required" data-empty-msg="技能不能为空!"><?php echo $attr['brief'];?></textarea>
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>报名时间：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['applyStartDate']?>" id="applyStartDate" data-rules="required" name="applyStartDate" type="text"> ---
    <input data-toggle="datepicker" style="width:135px;" value="<?php echo $attr['applyEndDate']?>" id="applyEndDate" data-rules="required" name="applyEndDate" type="text">
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
      <textarea name="description" data-rules="required" id="description" style="width: 550px;height:200px;" placeholder="从这里开始写正文"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">排序：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="sort" name="sort" value="<?php echo $attr['sort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>状态：</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input data-rules="required" data-empty-msg="请选择分类！"  value="<?php echo $attr['status']?$attr['status']:'';?>" id="status" name="status" type="hidden"><i class="caret"></i><span><?php echo $statuslist[$attr['status']]?$statuslist[$attr['status']]:'请选择';?></span></a>
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
<?php echo assets::$shop;?>
<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>

<!--sui对话框, 图文浏览器开始-->
<div id="J_add_appDialog" tabindex="-1" role="dialog" class="sui-modal hide fade" data-addsupplierurl="http://" data-getsuppliersurl="http://xxx">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
        <h4 id="myModalLabel" class="modal-title">图文浏览器</h4></div>
      <div class="modal-body sui-form form-horizontal">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//当前商品轮廓图对象
<?php if($main_photos):?>
var main_photos = $.parseJSON('<?php echo json_encode($main_photos);?>');
<?php else:?>
var main_photos ={};
<?php endif;?>

function s_navclick(url)
  {
    if(url == "index"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/edit?id=<?php echo $id;?>");
    }
    if(url == "teamindex"){
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/teamindex?id=<?php echo $id;?>");
    }
  }
//sui对话框, 图文浏览器添加图文
$suiDialog = $('#J_add_appDialog')
$suiDialog.on('click', '.Js_appmsg', function(e) {
  _cur = $(this);
  $suiDialog.modal('shadeIn');
  return $.confirm({
    title: '确认',
    body: '确认添加图文吗？',
    backdrop: false,
    okHide: function() {
      appmsgUrl = _cur.find(".js_news").attr("href");
      mid = _cur.find(".js_news").attr("mid");
      $('#materailId').val(mid);
      $('#urlPath').val(appmsgUrl);
      $suiDialog.modal('hide');  //手动关闭一个模态对话框。
    },
    hide: function() {
       return $suiDialog.modal('shadeOut');
    }
  });
});
</script>
<!--sui对话框, 图文浏览器结束-->

<script language="javascript" type="text/javascript">
function onChangeteamType(){
  var teamType = $("#teamType").val();
  if(teamType == '2'){
    $('#teamMaxCountClass').hide();
    $('#teamMaxCount').removeAttr('data-rules');
  }
  if (teamType == '1') {
    $('#teamMaxCountClass').show();
    $('#teamMaxCount').attr('data-rules','required');
  }
}

$(function(){
  var submitBefore = function(){
    var applyStartDate = $('#applyStartDate').val();
    var applyEndDate = $('#applyEndDate').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    var listphote = $('#listphote').val();
    if (applyEndDate < applyStartDate) {
      $.alert('请选择正确的报名时间。');
    }else if(endDate < startDate){
      $.alert('请选择正确的有效期。');
    }else if (listphote == 'null') {
      $.alert('轮播图不能为空');
    }else{
      return true;
    } 
  };
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_startup_game/save';
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




 //图文,  微信素材  url
$(".edit_click_btn").on('click','input',function(){
  if($(this).attr("t")=='image'){
    $(".edit_url").hide();
    $(".edit_content").show();
  }else if($(this).attr("t")=='news'){
    $(".edit_url").show();
    $(".edit_content").hide();
  }else if($(this).attr("t")=='url'){
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
$(".photo_main").on('click', '.Js_item .Js_delphoto', function(){
  var delItem = $(this);
  $.confirm({
    title: '确认',
    body: '您确认删除轮播图吗？',
    okHidden: function() {
      delete main_photos[parseInt(delItem.attr('index'))];
      delItem.parent(".Js_item").remove();
      $.ajax({
        type    : "post",
        async   : false,
        url     : '<?php echo APP_URL."base_startup_game/photodelete";?>',
        data    : "id=" + delItem.attr('photoId') + "&infoid=" + $("#id").val(),
        dataType: 'json',
        success : function (data){
          if (data['data']['status'] == 1){
            $.alert(data['data']['msg']);
            // SAYIMO.go_url("<?php echo APP_URL;?>base_enterprise_info/edit?id="+$("#id").val());
          }else{
            $.alert(data['data']['msg']);
          }
        }
      });
    }
  })
})

/**
 * [轮廓图裁剪上传]
 */
function objectNewLength (){
  if(main_photos){
      return (parseInt(backend.comomn.objectLength(main_photos))+1); //图片对象组长度
  }else{
      return 1 //当对象空返回长度为1, 让图片对象组下标为1插入新对象元素
  }
} 
$("#upload_main").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1.33,//裁剪宽高比
  'maxSize': [340,256],//裁剪最大尺寸 [width,height]
  'minSize': [240,180],//裁剪最小尺寸 [width,height]
  'picSize': [640,480],//最终保存图片尺寸 [width,height]
  'quality': 3,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('.photo_main').append('<div class="photo_item Js_item">'+
                                '<img class="photo_img Js_img" id="iconImg" src="' + s + '" />'+
                                '<div class="photo_del Js_delphoto" index="'+ objectNewLength() +'"><i class="sui-icon icon-tb-delete"></i></div>'+
                                '<div class="photo_mvleft Js_move_left"><i class="sui-icon icon-pc-chevron-left"></i></div>'+
                                '<div class="photo_mvright Js_move_right"><i class="sui-icon icon-pc-chevron-right"></i></div>'+
                                '<div class="photo_bg"></div>'+
                            '</div>');                   
    if(data.data[0].photoUrl){
      //新建对象
      var newItem = {};
      newItem.id = '';
      newItem.goodsId = $("#id").val();
      // newItem.displayOrder = objectNewLength();
      newItem.photoName = '';
      newItem.photoPath = data.data[0].photoUrl;
      newItem.status = 1;
      main_photos[objectNewLength()] = newItem//添加新对象
      //console.log(objectNewLength());
      //console.log(main_photos);
      $('#listphote').val(JSON.stringify(main_photos));
      $('#main_photos').removeClass("input-error");
      $(".sui-msg.msg-error").remove();
    }
  }      
});

//触发图片移动和删除
$(document).ready(function(){
    backend.photo.mv();
});

//BUG修复
$(document).ready(function(){
  $(".Js_upload").trigger("click"); // $.on绑定, 点击一次才生效
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
