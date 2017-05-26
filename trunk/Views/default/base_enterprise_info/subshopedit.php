<style type="text/css">
  .sui-dropdown.dropdown-bordered .dropdown-inner>.sui-dropdown-menu {
    overflow-y: scroll;
  }
  .sui-form.form-horizontal .control-label {
      width: 185px;
  }
</style>
<?php echo assets::$jcrop;?>
<?php echo assets::$editor;?>
<?php echo assets::$shop;?>
<ul class="sui-breadcrumb">
    <li><a>添加子店</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
  <li class="active"><a>基本信息</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="tab1">
    <div class="control-group">
      <label for="name" class="control-label"><span class="required">*</span>企业编号：</label>
      <div class="controls">
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
        <input type="text" class="input-xlarge input-xfat" id="providerCode" name="providerCode" value="<?php echo $providerCode;?>" readonly>
      </div>
    </div>
    <div class="control-group">
      <label for="name" class="control-label"><span class="required">*</span>企业名称：</label>
      <div class="controls">
        <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName" value="<?php echo $providerName;?>" readonly>
      </div>
    </div>

    <div class="control-group" >
     <label for="inputDes" class="control-label v-top"><span class="required">*</span>联盟商星级:</label>
      <div class="controls">
        <select name="star" class="star">
          <option value="1" <?php if($star=='1'){echo "selected";}?>>一星</option>
          <option value="2" <?php if($star=='2'){echo "selected";}?>>二星</option>
          <option value="3" <?php if($star=='3'){echo "selected";}?>>三星</option>
          <option value="4" <?php if($star=='4'){echo "selected";}?>>四星</option>
          <option value="5" <?php if($star=='5'){echo "selected";}?>>五星</option>
        </select>
      </div>
    </div>
    <div class="control-group" >
     <label for="inputDes" class="control-label v-top">店铺分类:</label>
      <div class="controls">
          <select name="unionshopClassId" class="dropdown-inner">
            <?php foreach($className as $k=>$v):?>
            <option value="<?php echo $v['id'];?>" <?php if($v['id']==$unionshopClassId){echo "selected";}?> ><?php echo $v['className'];?></option>
          <?php endforeach;?>
          </select>
      </div>
    </div>

    <div class="control-group">
      <label for="photoId" class="control-label v-top">企业形像照片：</label>
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
      <label for="saleman" class="control-label v-top">负责人：</label>
      <div class="controls">
        <input type="text" class="input-xlarge input-xfat" id="linkman" name="linkman" value="<?php echo $linkman;?>">
      </div>
    </div>
    <div class="control-group">
      <label for="saleman" class="control-label v-top">联系手机：</label>
      <div class="controls">
        <input type="text" class="input-xlarge input-xfat" id="mobilePhone" name="mobilePhone" data-rules="mobile" value="<?php echo $mobilePhone;?>">
      </div>
    </div>
    <div class="control-group">
      <label for="email" class="control-label v-top">E-mail：</label>
      <div class="controls">
        <input type="email" class="input-xlarge input-xfat" id="email" name="email" value="<?php echo $email;?>">
      </div>
    </div>
    <div class="control-group">
      <label for="telPhone" class="control-label v-top">企业固话：</label>
      <div class="controls">
        <input type="text" class="input-xlarge input-xfat" id="telPhone" name="telPhone" data-rules="tel" value="<?php echo $telPhone;?>">
      </div>
    </div>
    <div class="control-group">
      <label for="fax" class="control-label v-top">传真：</label>
      <div class="controls">
        <input type="text" class="input-xlarge input-xfat" id="fax" name="fax" value="<?php echo $fax;?>">
      </div>
    </div>

    <!--选择省份城市县区 HTMl开始-->
    <div class="control-group">
      <label for="address" class="control-label v-top"><span class="required">*</span>地址：</label>
      <div class="controls">

        <span class="sui-dropdown dropdown-bordered select province">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $provinceCode;?>" name="provinceCode" type="hidden">
              <i class="caret"></i>
              <span id="province_Name"><?php echo $province_cur['name']?$province_cur['name']:'省份';?></span></a>
              <input value="" id="provinceName" name="provinceName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($provinceList as $key => $value):
                $k = $key+1;
              ?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['code'];?>"><?php echo $value['name'];?></a></li>
              <?php if ($k%3==0):?>
                <li role="presentation" class="divider"></li>
              <?php endif;?>
              <?php endforeach;?>
            </ul>
          </span>
        </span>

        <span class="sui-dropdown dropdown-bordered select city">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $cityCode;?>" name="cityCode" type="hidden">
              <i class="caret"></i>
              <span id="city_Name"><?php echo $city_cur['name']?$city_cur['name']:'城市';?></span></a>
              <input value="" id="cityName" name="cityName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($cityList as $key => $value):
                $k = $key+1;
              ?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['code'];?>"><?php echo $value['name'];?></a></li>
              <?php if ($k%3==0):?>
                <li role="presentation" class="divider"></li>
              <?php endif;?>
              <?php endforeach;?>
            </ul>
          </span>
        </span>

        <span class="sui-dropdown dropdown-bordered select area">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $areaCode;?>" name="areaCode" type="hidden">
              <i class="caret"></i>
              <span id="area_Name"><?php echo $area_cur['name']?$area_cur['name']:'城市';?></span></a>
              <input value="" id="areaName" name="areaName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($areaList as $key => $value):
                $k = $key+1;
              ?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['code'];?>"><?php echo $value['name'];?></a></li>
              <?php if ($k%3==0):?>
                <li role="presentation" class="divider"></li>
              <?php endif;?>
              <?php endforeach;?>
            </ul>
          </span>
        </span>
        <br/>
        <input data-rules="required" data-empty-msg="地址不能为空！"  style="margin-top: 5px;" type="text" class="input-xlarge input-xfat" id="address" name="address" value="<?php echo $address;?>">

      </div>
    </div>
    <!--选择省份城市县区 HTMl结束-->

    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
      </div>
    </div>
  </div>
  
</form>

<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>

<script language="javascript" type="text/javascript">
//当前商品轮廓图对象
<?php if($main_photos):?>
var main_photos = $.parseJSON('<?php echo json_encode($main_photos);?>');
<?php else:?>
var main_photos ={};
<?php endif;?>
$(function(){

  //供应商对话框远程加载页面
  //对话框回调函数
  var goods_callback = function(o){
  }
  SAYIMO.dialogView('js_add_goods','商品','tirgger_goods_btn','base_enterprise_info/viewstudents','js_btn_item_disabled',goods_callback);

  //重新加载对话框内容
  $("#js_add_goods").on("hidden", function() {  
      $(this).removeData("modal");  
  });  
});


$(function(){
  var submitBefore = function(){

    var province_Name = document.getElementById("province_Name").innerHTML;
    var city_Name = document.getElementById("city_Name").innerHTML;
    var area_Name = document.getElementById('area_Name').innerHTML;
    $('#provinceName').val(province_Name);
    $('#cityName').val(city_Name);
    $('#areaName').val(area_Name);
  //   // var qq = $('#areaName').val();
    // $.alert(province_Name);
  //   // return false;
  //   // var listphote = $('#listphote').val();
  //   var crePhotoUrl = $('#crePhotoUrl').val();
  //   // if (listphote == 'null') {
  //   //   $.alert('轮播图不能为空');
  //   // }else
  //    var providerType=$("#providerType").val();
  //    var discount   =$("#discount").val();
  //    var providerName = $("#providerName").val();
  //    var cq=1 ;
  //    $.ajax({
  //       type:'post',
  //       url:'<?php echo APP_URL?>base_supplier/setProviderName',
  //       data:{'providerName':providerName,'id':<?php echo $id;?>},
  //       dataType:"json",
  //       async:false,
  //       success:function(data){
  //         if(data['msg'] == 1){
  //           $.alert('该企业名称已被占用。');
  //           cq=2;
  //         }
  //       }
  //     });
  //    if(cq == 2){
  //     return false;
  //    }
  //    if(providerType==2&&discount==''){
  //      $.alert('折扣不能为空');
  //      return false;
  //    }
  //    if (crePhotoUrl == null) {
  //       $.alert('上传营业执照/信用代码图片');
  //       return false;
  //    }

  //    $('provinceName').val();
      return true;

    
  }

  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_enterprise_info/subshopsave?id='+<?php echo $id;?>;
  _opts.failFun = function(){
    errors = document.querySelectorAll("#provider-form .input-error")
    for (var i = errors.length - 1; i >= 0; i--) {
      $(errors[i]).trigger('focus');
      var arr=["providerName","corporate","lockPhone","address"]; 
      if(arr.toString().indexOf(errors[i].id)>-1){
        $(".sui-nav.nav-tabs li").eq(0).addClass('active');
        $(".sui-nav.nav-tabs li").eq(1).removeClass('active');
        $(".tab1").show();
        $(".tab2").hide();
      }
    }
  }

  SAYIMO.form.init('#provider-form', _opts,submitBefore);


});

//隐藏status跟踪单选项
$("#provider-form").on('click', ".followRadio", function(){
  setTimeout(function() {
    var status;  
    $("label input:radio:checked").each(function(i,v){
      status = $(v).val();
      $("input[name='status']").val(status);
    });
  }, 300);
})

function listphoto(){
  var pto = $('#crePhotoUrl').val();
  window.open(pto);
}
function listphoto1(){
  var pto = $('#taxPhotoUrl').val();
  window.open(pto);
}

//选项卡
function s_navclick(tab)
{
    if(tab=='check'){
        $(".sui-nav.nav-tabs li").eq(0).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(1).addClass('active');
        $(".tab1").hide();
        $(".tab2").show();
    }else if(tab=='edit'){
        $(".sui-nav.nav-tabs li").eq(0).addClass('active');
        $(".sui-nav.nav-tabs li").eq(1).removeClass('active')
        $(".tab1").show();
        $(".tab2").hide();
    }
}
//实例化编辑器
var $editor = $('#description').editor();

/**
 * [选择省份城市县区]
 * @param  {[intger]} curId [当前选项code]
 * @param  {[intger]} clickId[当前选中code]
 * @return {[json]} 加载到选项UL中
 * wsbnet@qq.com
 */
$(function(){
  //选择省份
  $(".province").on('click', 'ul li', function(){
    var curId = $(".province").find("input").val();
    var clickId = $(this).find("a").attr("value");
    if( curId !== clickId ){
      $.ajax({
        type:'post',
        url:'<?php echo APP_URL?>base_enterprise_info/getCityJsonList',
        data:{'provinceCode':clickId},
        dataType:"json",
        async:false,
        success:function(data){
          var li = '';
          for (var i = data.length - 1; i >= 0; i--) {
            li += '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].code+'">'+data[i].name+'</a></li>\n';
          }
          $(".city").find("ul").html(li);
          $(".city").find("a span").html("城市");
          $(".area").find("a span").html("县区");
        }
      })
    }
  })
  //选择城市
  $(".city").on('click', 'ul li', function(){
    var curId = $(".city").find("input").val();
    var clickId = $(this).find("a").attr("value");
    if( curId !== clickId ){
      $.ajax({
        type:'post',
        url:'<?php echo APP_URL?>base_enterprise_info/getAreaJsonList',
        data:{'cityCode':clickId},
        dataType:"json",
        async:false,
        success:function(data){
          var li = '';
          for (var i = data.length - 1; i >= 0; i--) {
            li += '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].code+'">'+data[i].name+'</a></li>\n';
          }
          $(".area").find("ul").html(li);
          $(".area").find("a span").html("县区");
        }
      })
    }
  })





});
/*[选择省份城市县区]结束*/

/**
 * [LOGO裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [180,180],//裁剪最大尺寸 [width,height]
  'minSize': [180,180],//裁剪最小尺寸 [width,height]
  'picSize': [180,180],//最终保存图片尺寸 [width,height]
  'quality': 3,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_logo').children('img').remove();
    $('#upload_logo').prepend('<img src="' + s + '" />');
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
        url     : '<?php echo APP_URL."base_enterprise_info/photodelete";?>',
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
      newItem.displayOrder = objectNewLength();
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

/**
 * 营业执照裁剪上传]
 */
$("#upload_cre_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1.5,//裁剪宽高比
  'maxSize': [600,400],//裁剪最大尺寸 [width,height]
  'minSize': [150,100],//裁剪最小尺寸 [width,height]
  'picSize': [0,0],//最终保存图片尺寸 [width,height]
  'quality': 1,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_cre').children('img').remove();
    $('#upload_cre').prepend('<img src="' + s + '" style="width: 105px; height: 105px;" />');
    if(data.data[0].photoUrl!=undefined){
      $("#crePhotoUrl").val(data.data[0].photoUrl);
    }
  }       
});

/**
 * 证件裁剪上传]
 */
$("#upload_tax_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1.5,//裁剪宽高比
  'maxSize': [600,400],//裁剪最大尺寸 [width,height]
  'minSize': [150,100],//裁剪最小尺寸 [width,height]
  'picSize': [0,0],//最终保存图片尺寸 [width,height]
  'quality': 1,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_tax').children('img').remove();
    $('#upload_tax').prepend('<img src="' + s + '" style="width: 105px; height: 105px;" />');
    if(data.data[0].photoUrl!=undefined){
      $("#taxPhotoUrl").val(data.data[0].photoUrl);
    }
  }       
});

$(function(){
  //对话框远程加载页面(说明, ID名:js_add_view,providerName; class名:J_addlistAd)
  SAYIMO.dialogView('js_add_industry','所选择的行业（您最多能选择5项）','industry','base_enterprise_info/viewIndustry','js_btn_item',callback_dialog);
});
//对话框回调函数
function callback_dialog(o){
	var industryCodes = '';
  $("[name='industryCodelist[]']").each(function(){ 
		if(industryCodes == ''){
			industryCodes = $(this).val();
		}else{
			industryCodes += ','+$(this).val();
		}
	});
	var industrys = '';
  $("[name='industryNamelist[]']").each(function(){ 
		if(industrys == ''){
			industrys = $(this).val();
		}else{
			industrys += ','+$(this).val();
		}
	});
	$("#industry").val(industrys);
	$("#industryCode").val(industryCodes);
	$("#industry").focus();
	$("#industry").blur();
}
</script>