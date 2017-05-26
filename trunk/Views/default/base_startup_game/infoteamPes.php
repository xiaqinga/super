<style type="text/css">
  /*.show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }*/
</style>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li class="active" onclick="s_navclick('info');"><a>基本信息</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/teammember?id=<?php echo $id;?>&gameId=<?php echo $gameId;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="realName" class="control-label">姓名：</label>
    <div class="controls">
      <input type="hidden" name="memberId" id="memberId" value="<?php echo $attr['id'];?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="realName" name="realName" value="<?php echo $attr['realName']?>">
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">联系方式：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="mobilePhone" name="mobilePhone" value="<?php echo $attr['mobilePhone'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">学校：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="schoolName" name="schoolName" value="<?php echo $attr['schoolName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">所在系：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="department" name="department" value="<?php echo $attr['department'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">班级：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="classes" name="classes" value="<?php echo $attr['classes'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">学生证号：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="studentCard" name="studentCard" value="<?php echo $attr['studentCard'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">身份证号：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="idCardCode" name="idCardCode" value="<?php echo $attr['idCardCode'];?>">
    </div>
  </div>

  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>销售额：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="sellPrice" name="sellPrice" data-rules="required|number" value="<?php echo $attr['sellPrice'];?>">
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

<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">
$(function(){
  var id = <?php echo $id;?>;
  var gameId = <?php echo $gameId;?>;
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_startup_game/savePrice?id='+id+'&gameId='+gameId;
  SAYIMO.form.init('#provider-form', _opts);
});

function s_navclick(url)
  { 
    $(".sui-nav.nav-tabs").removeClass('active');
    if(url=='info'){
        $(".sui-nav.nav-tabs").eq(0).addClass('active');  

    } 
  }



$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
  $("#sellPrice").removeAttr("disabled");
})



</script>
