<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'修改':'添加';?>快讯信息</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="title" class="control-label">标题:</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['title']?></span>
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">来源：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['source'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">作者：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['author'];?></span>
    </div>
  </div>

   <div class="control-group">
    <label for="inputDes" class="control-label v-top">标题缩略图：</label>
    <div class="controls">
    <img width="100" src="<?php echo $attr['photoUrl'];?>" alt="">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">发布时间：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['publishdate'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">资讯简介：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['instruction'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">详细内容：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['details'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">排序：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['sort'];?></span>
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">标识：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['mark'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">状态：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php if($attr['status'] == "1"){echo"启用";}else{echo"禁用";};?></span>
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
