<style type="text/css">
  .J_addlistAd{cursor: pointer;}
  #show_ad_image{margin-bottom: 8px; display: block;}
  .adlist{list-style: none;}
  .adlist li{line-height: 32px; text-align: center;}
</style>


<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>广告位</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_adposition_config-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="configName" class="control-label"><span class="required">*</span>广告名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="configName" name="configName" data-rules="required" data-empty-msg="广告名称不能为空！"  value="<?php echo  $attr['configName'];?>">
    </div>
  </div>
  <div class="control-group edit_url">
    <label for="tag" class="control-label v-top"><span class="required">*</span>标识符:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="tag" name="tag" data-rules="required" data-empty-msg="标识符不能为空！"  value="<?php echo $attr['tag'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">广告素材：</label>
    <div class="controls">
      <input type="hidden" class="input-xlarge input-xfat" id="adpositionId" name="adpositionId" value="<?php echo $attr['adpositionId']?$attr['adpositionId']:0;?>">
      <div class="js_photo_list">
        <?if($attr['photoUrl']):?>
          <img width="150" src="<?php echo $attr['photoUrl']?>"/>
        <?endif;?>
      </div>
      
      <a href="javascript:void(0);" id="click_open_ad" class="sui-btn btn-primary">打开广告素材</a>
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

<?php echo assets::$sayimo; ?>

<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_adposition_config/save';
  SAYIMO.form.init('#base_adposition_config-form', _opts);

  //对话框回调函数
  function callback_dialog(o){
    $("#adpositionId").val(o.attr('adpositionId'));
    $("#js_photo_list").html('<img width="150" src="'+o.find("img").attr('src')+'"/>');
  }
  //对话框远程加载页面(说明, ID名:js_add_ad,click_open_ad; class名:J_addlistAd)
  SAYIMO.dialogView('js_add_ad','广告素材','click_open_ad','base_adposition/viewad','J_addlistAd', callback_dialog);
});
</script>