<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-breadcrumb">
    <li><a>积分信息</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="alias" class="control-label">商品名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="alias" name="goodsName" value="<?php echo $attr['goodsName']?>">
    </div>
  </div>
 <div class="control-group">
    <label for="inputDes" class="control-label v-top">自有积分：</label>
    <div class="controls">
     <input  class="input-medium" type="text" id="points" name="points" value="<?php echo $attr['points']?>">元
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">百分比积分：</label>
    <div class="controls">
     <input  class="input-medium" type="text" id="pointsPercent" name="pointsPercent" value="<?php echo $attr['pointsPercent']?>"> % 
    </div>
  </div>

 
</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
<script language="javascript" type="text/javascript">

$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
})

//隐藏type跟踪多选table
$("#provider-form").on('click', ".followChkBtn", function(){
  setTimeout(function() {
    var type = [];    //帐号类型
    $("label input:checkbox:checked").each(function(i,v){
      type.push($(v).val());
      $("input[name='type']").val(type.join(','));
    });
  }, 300);
})

</script>
