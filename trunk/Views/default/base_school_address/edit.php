<style>
  .province{left:3px}
  .city{left:103px}
  .area{left:203px}

</style>
<?php echo assets::$jcrop;?>
<?php echo assets::$editor;?>
<?php echo assets::$sayimo;?>
<ul class="sui-breadcrumb">
  <li><a><?php echo ($item['id'])?'修改':'添加';?>学校</a></li>
  <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="school-address-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="name" class="control-label">学校编号：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="schoolCode" name="schoolCode"   value="<?php echo $schoolCode;?>" >
    </div>
  </div>
  <div class="control-group">
    <label for="name" class="control-label"><span class="required">*</span>学校名称：</label>
    <div class="controls">


      <input type="text" class="input-xlarge input-xfat" id="schoolName" name="schoolName" data-rules="required" data-empty-msg="学校名称不能为空！"  value="<?php echo $schoolName;?>">
    </div>
  </div>


  <div class="control-group">
    <label for="photoUrl" class="control-label v-top">学校LOGO：</label>
    <div class="controls" id="upload_logo">
      <?php if($photoUrl){?>
        <img style="width: 105px; height: 105px;" src="<?php echo $photoUrl;?>">
      <?php }?>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传LOGO</a>
      <input type="hidden" name="photoUrl" id="photoUrl" value="<?php echo $photoUrl;?>"/>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;180*180px</span>
    </div>
  </div>



  <!--选择省份城市县区 HTMl开始-->
  <div class="control-group">
    <label for="address" class="control-label v-top"><span class="required">*</span>学校地址：</label>
    <div class="controls parent_location">

        <span class="sui-dropdown dropdown-bordered select province son_location_1200">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $provinceCode;?>" name="provinceCode" type="hidden">
              <i class="caret"></i>
              <span id="province_Name"><?php echo $province_cur['name']?$province_cur['name']:'省份';?></span></a>
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

        <span class="sui-dropdown dropdown-bordered select city son_location_1200">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $cityCode;?>" name="cityCode" type="hidden">
              <i class="caret"></i>
              <span id="city_Name"><?php echo $city_cur['name']?$city_cur['name']:'城市';?></span></a>
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

        <span class="sui-dropdown dropdown-bordered select area son_location_1200">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $areaCode;?>" name="areaCode" type="hidden">
              <i class="caret"></i>
              <span id="area_Name"><?php echo $area_cur['name']?$area_cur['name']:'城市';?></span></a>
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
      <input data-rules="required" data-empty-msg="地址不能为空！"  style="margin-top: 12px;" type="text" class="input-xlarge input-xfat" id="fullAddress" name="fullAddress" value="<?php echo $fullAddress;?>">

    </div>
  </div>
  <!--选择省份城市县区 HTMl结束-->

  <div class="control-group">
    <label for="website" class="control-label v-top">学校介绍：</label>
    <div class="controls">
      <textarea id="description" name="description"  style="width: 550px;height:200px;"><?php echo $description;?></textarea>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>





<script language="javascript" type="text/javascript">
  //当前商品轮廓图对象



  $(function(){


    var _opts = {};
    _opts.url = OO._SRVPATH + 'base_school_address/save';


    SAYIMO.form.init('#school-address-form', _opts);


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








  //BUG修复
  $(document).ready(function(){
    $(".Js_upload").trigger("click"); // $.on绑定, 点击一次才生效
  });


</script>