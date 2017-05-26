<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'修改':'添加';?>评论信息</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="alias" class="control-label"><span class="required">*</span>评论用户:</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="alias" name="alias" value="<?php echo $attr['alias']?>">
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">商品名称：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="goodsName" name="goodsName" value="<?php echo $attr['goodsName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">评论内容：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="commentContent" name="commentContent" value="<?php echo $attr['commentContent'];?>">
    </div>
  </div>
 <div class="control-group">
    <label for="inputDes" class="control-label v-top">星级：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="commentLevel" name="commentLevel" value="<?php if($attr['commentLevel'] == 1){echo "差评";}
                else if($attr['commentLevel'] == 2 || $attr['commentLevel'] == 3){echo "中评";}
                else if($attr['commentLevel'] == 4 || $attr['commentLevel'] == 5){echo "好评";}
                ;?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">评论时间：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="createDate" name="createDate" value="<?php echo $attr['createDate'];?>">
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
