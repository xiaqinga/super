<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  #freightTmplateName, #providerName{
    cursor: pointer;
  }
</style>
<?php echo assets::$jcrop;?>
<?php echo assets::$shop;?>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>商品</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
  <li onclick="navclick('edit');"><a>基本信息</a></li>
  <li class="active" onclick="navclick('photoedit');"><a>图片参数</a></li>
  <li onclick="navclick('normsedit');"><a>规格设定</a></li>
</ul>
<div class="load-wrapper">
<form id="goods_photo-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
  <div class="control-group">
    <label for="photoId" class="control-label v-top">商品列表图：</label>
    <div class="controls thumb_photo_controls">
      <div class="photo_thumb">
        <?php if($thumb_photos):
          $thumb_photoid = $thumb_photos[0]['id'];
        ?>
          <div class="photo_item Js_item">
            <img class="photo_img" width=130 hieght=130 src="<?php echo $thumb_photos[0]['photoPath'];?>">
            <div class="photo_del Js_upload" photoid="<?php echo $thumb_photos[0]['id'];?>" index="2"><i class="sui-icon icon-upload-alt"></i></div>
              <div class="photo_bg"></div>
          </div>
        <?php else:?>
          <a style="margin-top: 5px;" href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary Js_upload">上传列表图</a>
        <?php endif;?>
      </div>
      <input type="hidden" name="thumb_photoid" id="thumb_photoid" value="<?php echo $thumb_photoid;?>" >
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;220*220px</span>
    </div>
  </div>
  <div class="control-group">
    <label for="photoId" class="control-label v-top">商品轮播图：</label>
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
      <a style="margin-top: 5px;" href="javascript:void(0);" id="upload_main" class="sui-btn btn-xlarge btn-primary">上传商品轮播图</a>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;640*480px</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="button" class="sui-btn btn-xlarge " onclick="navclick('edit');">上一步</button>
      <button type="submit" class="sui-btn btn-xlarge btn-primary" >保存并下一步</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$sayimo; ?>

<script type="text/javascript">
$(document).ready(function(){
    if(!$("#id").val()){
      $.alert({
        title:'温馨提示',
        body: '亲，先完善商品基本信息',
        okHidden: function(e){
          SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/edit");
        }
      })
    }
});

//选项卡跳转
function navclick(action)
{
  $(".sui-nav.nav-tabs").removeClass('active');
  if( action == 'edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }else if( action == 'photoedit' ){
    $(".sui-nav.nav-tabs").eq(1).addClass('active')
  }
  SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/"+action+"?id="+$("#id").val());
}

//当前商品列表图对象
<?php if($thumb_photos):?>
var thumb_photos = $.parseJSON('<?php echo json_encode($thumb_photos);?>');
<?php else:?>
var thumb_photos ={};
<?php endif;?>

//当前商品轮廓图对象
<?php if($main_photos):?>
var main_photos = $.parseJSON('<?php echo json_encode($main_photos);?>');
<?php else:?>
var main_photos ={};
<?php endif;?>
//表单验证提交
$("#goods_photo-form").validate({
  success: function() {
    photo_save();
    return false;
  }
})

function photo_save()
{
  var id = $("#id").val();
  var ref = $("#ref").val();
  var photos = $("#photos").val();

  if(parseInt(backend.comomn.objectLength(thumb_photos))<1){
    $.alert("亲，请上传商品列表图");
    return false;
  }
  if(parseInt(backend.comomn.objectLength(main_photos))<1){
    $.alert("亲，请上传商品轮廓图");
    return false;
  }
  $.ajax({
    type    : "post",
    async   : false,
    url     : '<?php echo APP_URL."goods_list_business/photosave";?>',
    data    : "id=" + id + "&thumb_photos=" + JSON.stringify(thumb_photos) + "&main_photos=" + JSON.stringify(main_photos),
    dataType: 'json',
    success : function (data){
      if (data['status'] == true){

        $.alert({
          title: '对话框',
          body: '恭喜亲，图片保存成功',
          okHide: function(e){
            SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/normsEdit?id="+$("#id").val());
          }
        })
      }else{
        $.alert({
          title: '对话框',
          body: '亲，图片没有更新',
          okHide: function(e){
            SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/normsEdit?id="+$("#id").val());
          }
        })
      }
    }
  });
}
//表单验证提交结束

//删除轮播图片
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
        url     : '<?php echo APP_URL."goods_list_business/photodelete";?>',
        data    : "id=" + delItem.attr('photoId') + "&goodsId=" + $("#id").val(),
        dataType: 'json',
        success : function (data){
          if (data['data']['status'] == 1){
            $.alert(data['data']['msg']);
            SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/photoEdit?id="+$("#id").val());
          }else{
            $.alert(data['data']['msg']);
          }
        }
      });
    }
  })
})

/**
 * [主图裁剪上传]
 */
$(".thumb_photo_controls").on("click", ".Js_upload", function(){

  $(".Js_upload").J_jcorp({
    'filePath':'<?php echo GOODSLISTIMGPATH;?>',
    'imagePath':'<?php echo GOODSLISTIMGURL;?>',
    'aspectRatio': 1,//裁剪宽高比
    'maxSize': [220,220],//裁剪最大尺寸 [width,height]
    'minSize': [220,220],//裁剪最小尺寸 [width,height]
    'picSize': [220,220],//最终保存图片尺寸 [width,height]
    'quality': 3,//裁剪完后图片压缩比例
    'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
    'callback': function(s,data){//接口成功回调
      $('.photo_thumb').html('<div class="photo_item Js_item">'+
                                '<img class="photo_img" width=130 hieght=130 src="' + s + '">'+
                                '<div class="photo_del Js_upload" photoid="'+ $("#thumb_photoid").val() +'" index="2"><i class="sui-icon icon-upload-alt"></i></div>'+
                                  '<div class="photo_bg"></div>'+
                              '</div>');
      if(data.data[0].photoUrl){
        //新建对象
        var newItem = {};
        newItem.id = $("#thumb_photoid").val();
        newItem.goodsId = $("#id").val();
        newItem.displayOrder = 0;
        newItem.photoName = '';
        newItem.photoPath = data.data[0].photoUrl;
        newItem.status = 1;
        thumb_photos[0] = newItem//添加新对象
        //console.log(thumb_photos);
        $('#thumb_photos').removeClass("input-error");
        $(".sui-msg.msg-error").remove()
      }
    }       
  });

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
  'filePath':'<?php echo GOODSIMGPATH;?>',
  'imagePath':'<?php echo GOODSIMGURL;?>',
  'aspectRatio': 1.33,//裁剪宽高比
  'maxSize': [640,480],//裁剪最大尺寸 [width,height]
  'minSize': [640,480],//裁剪最小尺寸 [width,height]
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
                            '</div>')
    if(data.data[0].photoUrl){
      //新建对象
      var newItem = {};
      newItem.id = '';
      newItem.goodsId = $("#id").val();
      newItem.displayOrder = objectNewLength();
      newItem.photoName = '';
      newItem.photoPath = data.data[0].photoUrl;
      newItem.status = 1;
      main_photos[objectNewLength()] = newItem//添加新对象
      //console.log(objectNewLength());
      //console.log(main_photos);
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
</script>