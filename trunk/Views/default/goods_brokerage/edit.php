<ul class="sui-breadcrumb">
  <li><a><?php echo ($id)?'修改':'添加';?>积分</a></li>
  <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">商品名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="hidden" name="goodsid" id="goodsid" value="<?php echo $attr['goodsId'];?>">
        <span class="input-xlarge uneditable-input"><?php echo $attr['goodsName']?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">积分类型：</label>
    <div class="controls">
      <select name="pointsType" class="input-medium" onchange="change_points();">
        <option value="1" <?php if($attr['pointsType']=='1'){echo 'selected';}?>>自有积分</option>
        <option value="2" <?php if($attr['pointsType']=='2'){echo 'selected';}?>>百分比积分</option>
      </select>
    </div>
  </div>
  <div class="control-group" name="pointsclass" <?php if($attr['pointsType'] == '2'){echo 'hidden="hidden"';}?>>
    <label for="inputDes" class="control-label v-top">自有积分：</label>
    <div class="controls">
     <input  class="input-medium" type="text" id="points" name="points" data-rules="number" value="<?php echo $attr['points'];?>">
    </div>
  </div>
  <div class="control-group" name="pointspercent" <?php if($attr['pointsType'] == '1'){echo 'hidden="hidden"';}?>>
    <label for="inputDes" class="control-label v-top">百分比积分：</label>
    <div class="controls">
     <input  class="input-medium" type="text" id="pointsPercent" name="pointsPercent" data-rules="number" value="<?php echo $attr['pointsPercent'];?>"> % 
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary" onclick="loadXMLDoc()">保存</button>
    </div>
  </div>
</form>
</div>
<?php echo assets::$html5upload;?>
<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>
<?php echo assets::$wx_msg_key; ?>



<script type="text/javascript">


function change_points(){
  var points = $("#pointsType").val();
  if(points == '1'){
    $('#pointsclass').attr("hidden","");
  }
  if(points == '2'){
    $('#pointspercent').attr("hidden","");
  }
}


$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'goods_brokerage/save';
  SAYIMO.form.init('#base_media-form', _opts);
});


</script>