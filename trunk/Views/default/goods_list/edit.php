<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 150px;
  }
  #freightTmplateName, #providerName{
    cursor: pointer;
  }

</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>商品</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $goback;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
  <li class="active" onclick="navclick('edit');"><a>基本信息</a></li>
  <li onclick="navclick('photoedit');"><a>图片参数</a></li>
  <li onclick="navclick('normsedit');"><a>规格设定</a></li>
</ul>
<div class="load-wrapper">
<form id="goods_list-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="goodsCode" class="control-label"><span class="required">*</span>商品编号：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="goodsCode" name="goodsCode" data-rules="required" data-empty-msg="商品编号不能为空！" value="<?php echo  $attr['goodsCode'];?>" <?php if($attr['status']==1||$attr['status']==2||$attr['status']==4){echo "readonly";}else{echo "";}?>>
    </div>
  </div>
  <div class="control-group">
    <label for="goodsName" class="control-label"><span class="required">*</span>商品名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="goodsName" name="goodsName" data-rules="required" data-empty-msg="商品名称不能为空！"  value="<?php echo  $attr['goodsName'];?>">
    </div>
  </div>

  <!-- <div class="control-group followChkBtn">
    <label for="type" class="control-label v-top"><span class="required">*</span>所属商城：</label>
    <div class="controls type_chk">

      <label class="checkbox-pretty inline <?php if(strrpos($attr['mallType'],'1')>-1){echo "checked";}?>">
        <input type="checkbox" <?php if(strrpos($attr['mallType'],'1')>-1){echo 'checked="checked"';}?> name="type_chk" value="1" data-rules="required"><span>金商城</span>
      </label>
      <label class="checkbox-pretty inline <?php if(strrpos($attr['mallType'],'2')>-1){echo "checked";}?>">
        <input type="checkbox" <?php if(strrpos($attr['mallType'],'2')>-1){echo 'checked="checked"';}?> name="type_chk" value="2" data-rules="required"><span>银商城</span>
      </label>
      <label class="checkbox-pretty inline <?php if(strrpos($attr['mallType'],'3')>-1){echo "checked";}?>">
        <input type="checkbox" <?php if(strrpos($attr['mallType'],'3')>-1){echo 'checked="checked"';}?> name="type_chk" value="3" data-rules="required"><span>全返商城</span>
      </label>
      <input type="hidden" name="mallType" id="mallType" value="<?php echo $attr['mallType'];?>" >
    </div>
  </div> -->
  <div class="control-group">
    <label for="providerName" class="control-label v-top"><span class="required">*</span>所属供应商：</label>
    <div class="controls">
      <input type="hidden" name="providerCode" id="providerCode" value="<?php echo $attr['providerCode'];?>">
      <input type="hidden" name="providerId" id="providerId" value="<?php echo $attr['providerId'];?>"  data-rules="required" data-empty-msg="所属供应商不能为空！" >
      <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName" readonly placeholder="请选择供应商" value="<?php echo $attr['providerName'];?>">
    </div>
  </div>
  <div class="control-group isGiveScoreRadio">
    <label for="isGiveScore" class="control-label v-top"><span class="required">*</span>是否支持积分赠送：</label>
    <div class="controls">
      <?php if($id):?>
        <label class="radio-pretty inline checked">
          <input type="radio" checked  value="<?php echo $attr['isGiveScore']?>" name="isGiveScore_radio"><span><?php echo $attr['isGiveScore']==1?'是':'否';?></span>
        </label>

      <?php else:?>
      <label class="radio-pretty inline <?php echo $attr['isGiveScore']==2?'':'checked';?>">
        <input type="radio"  <?php echo $attr['isGiveScore']==2?'':'checked';?> value="1" name="isGiveScore_radio"><span>是</span>
      </label>
      <label class="radio-pretty inline <?php echo $attr['isGiveScore']==2?'checked':'';?>">
        <input type="radio" <?php echo $attr['isGiveScore']==2?'checked':'';?> value="2" name="isGiveScore_radio"><span>否</span>
      </label>
      <?php endif;?>
      <input type="hidden" name="isGiveScore" data-rules="required" data-empty-msg="积分赠送不能为空！" id="isGiveScore" value="<?php echo $attr['isGiveScore']?$attr['isGiveScore']:1;?>" >
    </div>
  </div>
  

  <div class="control-group">
    <label for="goodsClassName" class="control-label v-top"><span class="required">*</span>所属分类：</label>
    <div class="controls parent_location" >
      <input type="hidden" name="goodsClassId" id="goodsClassId" data-rules="required" data-empty-msg="所属分类不能为空！" value="<?php echo $attr['goodsClassId'];?>" >
      <span class="sui-dropdown dropdown-bordered goods_class son_location_1200">
        <span class="dropdown-inner">
          <a role="button" data-toggle="dropdown" class="dropdown-toggle">
            <i class="caret"></i><?php echo $attr['goodsClassName']?$attr['goodsClassName']:'请选择'?></a>
          <ul role="menu" aria-labelledby="drop1" class="sui-dropdown-menu">
            <li role="presentation" class="dropdown-submenu classA">
              <a role="menuitem" tabindex="-1" value="0">
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

  <div class="control-group dropdown_goodsBrandId">
    <label for="goodsBrandId" class="control-label v-top">商品品牌:</label>
    <div class="controls parent_location">
      <span class="sui-dropdown dropdown-bordered select son_location_1000">
        <span class="dropdown-inner">
          <a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
            <input id="goodsBrandId" name="goodsBrandId" value="<?php echo $attr['goodsBrandId'];?>" type="hidden">
            <i class="caret"></i>
            <span><?php echo $attr['goodsBrandName']?$attr['goodsBrandName']:'请选择';?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          <?php foreach ($attr['goodsBrandList'] as $key => $value) :?>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'];?>"><?php echo $value['brandName'];?></a></li>
          <?php endforeach;?>
          <!--li role="presentation">
            <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="bj">北京</a></li>
            <li role="presentation">
            <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="sb">圣彼得堡</a></li> -->
          </ul>
        </span>
      </span>
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="intro" class="control-label v-top"><span class="required">*</span>商品描述：</label>
    <div class="controls">
      <textarea name="intro" id="intro" placeholder="" data-rules="required" data-empty-msg="商品描述不能为空！"><?php echo $attr['intro'];?></textarea>
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="goodsAttribute" class="control-label v-top"><span class="required">*</span>商品属性：</label>
    <div class="controls">
      <textarea name="goodsAttribute" id="goodsAttribute" placeholder="" data-rules="required" data-empty-msg="商品属性不能为空！"><?php echo $attr['goodsAttribute'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label for="description" class="control-label v-top">补充说明：</label>
    <div class="controls">
      <textarea rows="3" cols="100" id="description" class="input-block-level" name="description"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group isTurnBackRadio">
    <label for="isTurnBack" class="control-label v-top"><span class="required">*</span>是否支持退换货：</label>
    <div class="controls">
      <label class="radio-pretty inline <?php if(strrpos($attr['isTurnBack'],'N')>-1){echo "checked";}elseif(!$attr['isTurnBack']){echo 'checked';}?>">
        <input type="radio" <?php if(strrpos($attr['isTurnBack'],'N')>-1){echo 'checked="checked"';}elseif(!$attr['isTurnBack']){echo 'checked="checked"';}?> value="N" name="isTurnBack_radio"><span>否</span>
      </label>
      <label class="radio-pretty inline <?php if(strrpos($attr['isTurnBack'],'Y')>-1){echo "checked";}?>">
        <input type="radio" <?php if(strrpos($attr['isTurnBack'],'Y')>-1){echo 'checked="checked"';}?> value="Y" name="isTurnBack_radio"><span>是</span>
      </label>
      <input type="hidden" name="isTurnBack" data-rules="required" data-empty-msg="退换货不能为空！" id="isTurnBack" value="<?php echo $attr['isTurnBack']?$attr['isTurnBack']:'N';?>" >
    </div>
  </div>
  <div class="control-group isFreightRadio">
    <label for="isFreight" class="control-label v-top"><span class="required">*</span>是否有运费：</label>
    <div class="controls">
      <label class="radio-pretty inline <?php if(strrpos($attr['isFreight'],'N')>-1){echo "checked";}elseif(!$attr['isFreight']){echo 'checked';}?>">
        <input type="radio" <?php if(strrpos($attr['isFreight'],'N')>-1){echo 'checked="checked"';}elseif(!$attr['isFreight']){echo 'checked="checked"';}?> value="N" name="isFreight_radio"><span>否</span>
      </label>
      <label class="radio-pretty inline <?php if(strrpos($attr['isFreight'],'Y')>-1){echo "checked";}?>">
        <input type="radio" <?php if(strrpos($attr['isFreight'],'Y')>-1){echo 'checked="checked"';}?> value="Y" name="isFreight_radio"><span>是</span>
      </label>
      <input type="hidden" name="isFreight" data-rules="required" data-empty-msg="运费不能为空！" id="isFreight" value="<?php echo $attr['isFreight']?$attr['isFreight']:'N';?>" >
    </div>
  </div>
  <div class="control-group js_freightTmplateName" <?php if(strrpos($attr['isFreight'],'Y')>-1){echo 'style="display: ;"';}else{ echo 'style="display: none;"';}?>>
    <label for="freightTmplateName" class="control-label v-top"></label>
    <div class="controls">
      <input name="freightTmplateId" id="freightTmplateId" type="hidden" value="<?php echo $attr['logisticsCostId'];?>">
      <input type="text" class="input-xxlarge input-xfat" id="freightTmplateName" name="freightTmplateName" readonly placeholder="请选择运费模板" value="<?php echo $attr['freightTmplateName'];?>">
    </div>
  </div>
  <div class="control-group js_sendAddress" <?php if(strrpos($attr['isFreight'],'N')>-1){echo 'style="display: ;"';}else{ echo 'style="display: none;"';}?>>
    <label for="sendAddress" class="control-label v-top"><span class="required">*</span>发货地点：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="sendAddress" name="sendAddress" value="<?php echo $attr['sendAddress'];?>" data-rules="<?php echo $attr['sendAddress']?'required':'';?>" data-empty-msg="发货地点不能为空！">
    </div>
  </div>
  <!-- <div class="control-group statusRadio">
    <label for="status" class="control-label v-top"><span class="required">*</span>商品状态：</label>
    <div class="controls">
      <label class="radio-pretty inline <?php if(strrpos($attr['status'],'2')>-1){echo "checked";}elseif(!$attr['status']){echo 'checked';}?>">
        <input type="radio" <?php if(strrpos($attr['status'],'2')>-1){echo 'checked="checked"';}elseif(!$attr['status']){echo 'checked';}?> value="2" name="status_radio"><span>下架</span>
      </label>
      <label class="radio-pretty inline <?php if(strrpos($attr['status'],'1')>-1){echo "checked";}?>">
        <input type="radio" <?php if(strrpos($attr['status'],'1')>-1){echo 'checked="checked"';}?> value="1" data-rules="required" name="status_radio"><span>上架</span>
      </label>
      <input type="hidden" name="status" data-rules="required" id="status" value="<?php echo $attr['status']?$attr['status']:2;?>" >
    </div>
  </div> -->
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary" onclick="">保存并下一步</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$sayimo; ?>

<?php echo assets::$editor;?>


<script type="text/javascript">
$(function(){
  
  var submitBefore = function(){
    var goodsCode = $('#goodsCode').val();
    var id = $('#id').val();
    var cq =1;
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_list/setgoodscode',
      data:{'goodsCode':goodsCode,'id':id},
      dataType:"json",
      async:false,
      success:function(resp){
        if(resp['msg'] == 1){
          $.alert('该编号已被占用。');
          cq=2;
        }
      }
    });
    if(cq == 1){
      return false;
    }else{
      return true;
    }
    
  }
  $(".js_sendAddress").show();
  var _opts = {};
  _opts.url = OO._SRVPATH + 'goods_list/save';
  SAYIMO.form.init('#goods_list-form', _opts, submitBefore);
});

//隐藏type跟踪多选table
$("#goods_list-form").on('click', ".followChkBtn", function(){
  setTimeout(function() {
    var type = [];    //帐号类型
    $("label input:checkbox:checked").each(function(i,v){
      type.push($(v).val());
      $("input[name='mallType']").val(type.join(','));
    });
  }, 300);
})

//选项卡跳转
function navclick(action)
{
  $(".sui-nav.nav-tabs").removeClass('active');
  if( action == 'edit' ){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }else if( action == 'photoedit' || action == 'normsedit' ){
    if(!$("#id").val()){
      $.alert("亲，先完善商品基本信息");
      return false;
    }
    $(".sui-nav.nav-tabs").eq(1).addClass('active')
  }
  SAYIMO.go_url("<?php echo APP_URL;?>goods_list/"+action+"?id="+$("#id").val()+"&isGiveScore="+$("#isGiveScore").val());
}

//ajax 顶级-->一级分类
$(".goods_class").on('mouseenter','.classA',function(){
  var _cur = $(this);
  // var ajaxMallType = $("#mallType").val();
    $.ajax({
      type:'get',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value'),'mallType':1},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu" >';
        for (var i = data.length - 1; i >= 0; i--){
          ul += '<li role="presentation"  class="disabled '+ (data[i].has_sub?'dropdown-submenu  classB':'') +' " ><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        // _cur.find('ul').remove();
        _cur.append(ul);
      }
    })
})
//ajax 一级分类-->二级分类
$(".goods_class").on('mouseenter','.classB',function(){
  var _cur = $(this);
  // var ajaxMallType = $("#mallType").val();
  if(!_cur.hasClass('hasLoad')){
  
    $.ajax({
      type:'get',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value'),'mallType':1},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classC"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        // _cur.find('ul').remove();
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})

//跟踪当前 选中的分类
$(".goods_class").on('click','li a',function(){
  var _cur = $(this).eq(0);
  var _has_submenu = $(this).eq(0).parent("li").hasClass("dropdown-submenu");
  var _has_disabled = $(this).eq(0).parent("li").hasClass("disabled");
 
  if(!_has_submenu&&!_has_disabled){//含有子类不能点击
    $(".goods_class .dropdown-inner a:eq(0)").text(_cur.text());
    $("#goodsClassId").val(_cur.attr('value'));
    //品牌跟踪 当前分类
    $.ajax({
      type:'get',
      url:'<?php echo APP_URL?>goods_brand/jsonGoodsBrand',
      data:{'id':_cur.attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var li ='';
        for (var i = data.length - 1; i >= 0; i--) {
          li += '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+data[i].brandName+'</a></li>\n';
        }
        $(".dropdown_goodsBrandId").find(".sui-dropdown-menu").html(li);
        $("#goodsBrandId").val('');
        $(".dropdown_goodsBrandId").find(".dropdown-toggle span").html("请选择");
      }
    })
    //品牌跟踪 当前分类 end
  }
})
//隐藏isTurnBack跟踪单选项
$("#goods_list-form").on('click', ".isGiveScoreRadio", function(){
  setTimeout(function() {
    var isGiveScore;  
    $(".isGiveScoreRadio label input:radio:checked").each(function(i,v){
      isGiveScore = $(v).val();
      $("input[name='isGiveScore']").val(isGiveScore);
    });
  }, 100);
})
//隐藏isTurnBack跟踪单选项
$("#goods_list-form").on('click', ".isTurnBackRadio", function(){
  setTimeout(function() {
    var isTurnBack;  
    $(".isTurnBackRadio label input:radio:checked").each(function(i,v){
      isTurnBack = $(v).val();
      $("input[name='isTurnBack']").val(isTurnBack);
    });
  }, 100);
})
//隐藏isGiveScore跟踪单选项
$("#goods_list-form").on('click', ".isGiveScoreRadio", function(){
  setTimeout(function() {
    var isGiveScore;
    $(".isGiveScoreRadio label input:radio:checked").each(function(i,v){
      isGiveScore = $(v).val();
      $("input[name='isGiveScore']").val(isGiveScore);
    });
  }, 100);
})
//隐藏isFreight跟踪单选项
$("#goods_list-form").on('click', ".isFreightRadio", function(){
  setTimeout(function() {
    var isFreight;  
    $(".isFreightRadio label input:radio:checked").each(function(i,v){
      isFreight = $(v).val();
      //console.log(isFreight);
      $("input[name='isFreight']").val(isFreight);
      if(isFreight=="Y"){
        $(".js_sendAddress").hide();
        $(".js_sendAddress").find("input").attr("data-rules",'');
        $(".js_freightTmplateName").show();
      }else if(isFreight=="N"){
        $(".js_sendAddress").show();
        $(".js_sendAddress").find("input").attr("data-rules",'required');
        $(".js_freightTmplateName").hide();
      }
    });
  }, 100);
})

//隐藏status跟踪单选项
$("#goods_list-form").on('click', ".statusRadio", function(){
  setTimeout(function() {
    var status;  
    $("label input:radio:checked").each(function(i,v){
      status = $(v).val();
      $("input[name='status']").val(status);
    });
  }, 100);
})

$(function(){

  //物流对话框远程加载页面
  //[参数说明: {string}生成对话框ID名, {string}对话框标题, {string}触发弹框ID名, {string}远程加载URL, {string}对话框中触发添加样式名]
  var freight_callback = function(o){
    $("#freightTmplateId").val(o.attr('data_id'));
    $("#freightTmplateName").val(o.find(".lname").html()+" / "+o.find(".cname").html()+" / "+o.find(".adr").html()+"");
  }
  SAYIMO.dialogView('js_add_freight','运费模板','freightTmplateName','logistics/viewfreight','js_btn_item',freight_callback);

  //供应商对话框远程加载页面
  //对话框回调函数
  var company_callback = function(o){
    $("#providerId").val(o.attr('data_bid'));
    $("#providerCode").val(o.attr('data_code'));
    $("#providerName").val(o.find("span").html());
  }
  SAYIMO.dialogView('js_add_company','供应商','providerName','admin_provider/viewProvider?mallType=1','js_btn_item',company_callback);
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

var editorA=UE.getEditor('intro',{initialFrameWidth : 720, initialFrameHeight : 260, autoHeightEnabled : false, wordCount : true, topOffset : 110, maximumWords : 3000, wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ', wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});
var editorB=UE.getEditor('goodsAttribute',{initialFrameWidth : 720, initialFrameHeight : 260, autoHeightEnabled : false, wordCount : true, topOffset : 110, maximumWords : 3000, wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ', wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});





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