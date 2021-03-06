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
    <li class="active">爆款专区</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-primary">
  <li class="active" onclick="s_navclick('info');"><a>基本信息</a></li>
  <li onclick="s_navclick('addgoods_info');"><a>添加商品</a></li>
</ul>

<div class="load-wrapper">
<form id="base_moldbaby-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>活动名称:</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="activityName" name="activityName" data-rules="required" data-empty-msg="名称不能为空！"  value="<?php echo  $attr['activityName'];?>">
    </div>
  </div>
   <div class="control-group">
    <label for="identifier" class="control-label v-top"><span class="required">*</span>标识符：</label>
    <div class="controls">
      <input type="text" <?php if($attr['identifier']){echo 'readonly="true"';}?> class="input-xlarge input-xfat" id="identifier" name="identifier" data-rules="required" data-empty-msg="标识符不能为空！"  value="<?php echo $attr['identifier'];?>">
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动有效时间:</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['startDate']?>" id="startDate" name="startDate" data-rules="required" type="text"> 至
    <input data-toggle="datepicker" value="<?php echo $attr['endDate']?>" id="endDate" name="endDate" data-rules="required" type="text">
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>商品类型:</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select <?php if($attr['goodsType']!=null || $attr['goodsType']==1){echo "disabled";}?>">
        <span class="dropdown-inner">
          <a id="drop4" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
            <input data-rules="required" value="<?php if($attr['goodsType']==1){echo 1;}elseif($attr['goodsType']!=null){echo 0;}else{echo "";}?>" name="goodsType" id="goodsType" type="hidden">
            <i class="caret"></i>
            <span><?php if($attr['goodsType']==1){echo "普通商品";}elseif($attr['goodsType']!=null){echo "预约商品";}else{echo "请选择";}?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
            <li role="presentation" class="active">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">普通商品</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">预约商品</a></li>
          </ul>
        </span>
      </span>
    </div>
  </div>
  <div class="control-group">
   <label for="goodsBuy" class="control-label v-top"><span class="required">*</span>单个商品限购:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="goodsBuy" name="goodsBuy" data-rules="required" data-empty-msg="单个商品限购不能为空！"  value="<?php echo $attr['goodsBuy'];?>">（人/件）
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动说明:</label>
    <div class="controls">
      <textarea name="activityExpalin" id="activityExpalin" style="width: 550px;height:200px;" data-rules="required"><?php echo $attr['activityExpalin'];?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="button" class="sui-btn btn-xlarge " onclick="goback();">关闭</button>
      <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="next();">下一步</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>

<script type="text/javascript">

function s_navclick(url)
{ 
  $(".sui-nav.nav-tabs").removeClass('active');
  if(url=='edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }
  if(url == 'addgoods'){
    $(".sui-nav.nav-tabs").eq(1).addClass('active');
  }
  if(!$("#id").val() && !$("#goodsType").val()){
    $.alert("请先保存基本信息");
    return false;
  }
  SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/"+url+"?id="+$("#id").val()+"&goodsType="+$("#goodsType").val());
}

function goback(){
  SAYIMO.go_url("<?php echo APP_URL;?>base_moldbaby/index");
}

function next()
{
  SAYIMO.go_url('<?php echo APP_URL."base_moldbaby/addgoods_info";?>'+"?id="+$("#id").val()+"&goodsType="+$("#goodsType").val());
}

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