<style>
.sui-nav.nav-primary{
  margin-top: 12px;
  margin-bottom: 0px;
}
.load-wrapper{
  margin-top: 30px;
}
.sui-breadcrumb{
  margin:0px;
}
</style>

<ul class="sui-breadcrumb">
    <li><a href="#">活动管理</a></li>
    <li class="active">秒抢管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>

<div class="load-wrapper">
<form id="base_seckill-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>秒抢名称:</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $attr['id'];?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>">
      <input type="text" class="input-xlarge input-xfat" id="seckillName" name="seckillName" data-rules="required" data-empty-msg="秒抢名称不能为空！"  value="<?php echo  $attr['seckillName'];?>">
    </div>
  </div>
   <div class="control-group">
    <label for="identifier" class="control-label v-top"><span class="required">*</span>标识符：</label>
    <div class="controls">
      <input type="text" <?php if($attr['identifier']){echo 'readonly="true"';}?> class="input-xlarge input-xfat" id="identifier" name="identifier" data-rules="required" data-empty-msg="标识符不能为空！"  value="<?php echo $attr['identifier'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>每人限抢</label>
    <div class="controls">
      <input min="0" type="text" class="input-xlarge input-xfat" id="goodsRestrictions" name="goodsRestrictions" data-rules="required|number" data-empty-msg="限抢不能为空！" value="<?php echo $attr['goodsRestrictions']; ?>">（件/人）
    </div>
  </div>

  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动说明:</label>
    <div class="controls">
      <textarea name="activityExpalin" id="activityExpalin" style="width: 550px;height:200px;" data-rules="required" data-empty-msg="活动说明不能为空！"><?php echo $attr['activityExpalin'];?></textarea>
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
<?php echo assets::$editor;?>

<script type="text/javascript">

$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_seckill/save';
  SAYIMO.form.init('#base_seckill-form',_opts);
});

//实例化编辑器
var $editor = $('#activityExpalin').editor();
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