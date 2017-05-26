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
    <li class="active">砍价管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-primary">
  <li class="active" onclick="s_navclick('edit');"><a>基本信息</a></li>
  <li onclick="s_navclick('addgoods');"><a>添加砍价</a></li>
</ul>

<div class="load-wrapper">
<form id="base_cut_price-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>活动名称:</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $attr['id'];?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>">
      <input type="text" class="input-xlarge input-xfat" id="name" name="name" data-rules="required" data-empty-msg="活动名称不能为空！"  value="<?php echo  $attr['name'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动图：</label>
    <div class="controls">
      <input type="hidden" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" data-rules="required" data-empty-msg="活动图不能为空！" value="<?php echo $attr['photoUrl']?$attr['photoUrl']:0;?>">
      <div id="upload_photo">
        <?php if($attr['photoUrl']):?>
          <img width="130" src="<?php echo $attr['photoUrl']?>"/><br/>
        <?php endif;?>
      </div>
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传图片</a>
      <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;320*320px</span>
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
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>起砍价</label>
    <div class="controls">
      <input min="0" type="number" class="input-xlarge input-xfat" id="preferentialPrice" name="preferentialPrice" data-rules="required" data-empty-msg="销售价不能为空！" value="<?php echo $attr['preferentialPrice']; ?>"> 
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>最低金额：</label>
    <div class="controls">
      <input min="0" type="number" class="input-xlarge input-xfat" id="minPrice" name="minPrice" data-rules="required|number" data-empty-msg="最低金额不能为空！" value="<?php echo $attr['minPrice']; ?>">（元）
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>商品数量：</label>
    <div class="controls">
      <input min="0" type="number" class="input-xlarge input-xfat" id="number" name="number" data-rules="required|number" data-empty-msg="商品数量不能为空！" value="<?php echo $attr['number']; ?>">（件/人）
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>砍价次数：</label>
    <div class="controls">
      <input min="0" type="number" class="input-xlarge input-xfat" id="cutTimes" name="cutTimes" data-rules="required|number" data-empty-msg="砍价次数不能为空！" value="<?php echo $attr['number']; ?>">（次）
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动时间：</label>
    <div class="controls">
      <input class="input-xlarge input-fat" style="width:180px;" id="startDate" name="startDate" value="<?php echo $attr['startDate'];?>" data-toggle='datepicker' data-date-timepicker='true' data-rules="required">
      &nbsp;&nbsp;至&nbsp;&nbsp;
      <input class="input-xlarge input-fat" style="width:180px;" id="endDate" name="endDate" value="<?php echo $attr['endDate'];?>" data-toggle='datepicker' data-date-timepicker='true' data-rules="required">
    </div>
  </div>

  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>活动描述:</label>
    <div class="controls">
      <textarea name="description" id="description" style="width: 550px;height:200px;" data-rules="required" data-empty-msg="活动描述不能为空！"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>状态:</label>
    <div class="controls">
      <span class="sui-dropdown dropdown-bordered select ">
        <span class="dropdown-inner">
          <a id="drop4" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
            <input data-rules="required" value="<?php if($attr['status']==1){echo 1;}elseif($attr['status']==2){echo 2;}else{echo "";}?>" name="status" id="status" type="hidden">
            <i class="caret"></i>
            <span><?php if($attr['status']==1){echo "正常";}elseif($attr['status']==2){echo "禁用";}else{echo "请选择";}?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
            <li role="presentation" class="active">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">正常</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">禁用</a></li>
          </ul>
        </span>
      </span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="button" class="sui-btn btn-xlarge " onclick="goback();">关闭</button>
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存并下一步</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>

<script type="text/javascript">

function s_navclick(url)
{ 
  var startDate = $('#startDate').val();
  var endDate = $('#endDate').val();
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
  SAYIMO.go_url("<?php echo APP_URL;?>base_cut_price/"+url+"?id="+$("#id").val()+"&goodsType="+$("#goodsType").val());
}

function goback(){
  SAYIMO.go_url("<?php echo APP_URL;?>base_cut_price/index");
}

$("#base_cut_price-form").validate({
  success: function() {
    var startDate_val = $("#startDate").val();
    var endDate_val = $("#endDate").val();
    if(typeof(startDate_val)!='undefined' && typeof(endDate_val)!='undefined' ){
      var startDate = totimestamp(startDate_val);
      var endDate = totimestamp(endDate_val);
      if( startDate>=endDate ){
        $.alert("开始时间要小于结束时间");
        return false;
      }
    } 
    save();
    return false;
  }
})

function save()
{
  putdata = $("#base_cut_price-form").serialize();
  $.ajax({
    type    : "post",
    async   : false,
    url     : '<?php echo APP_URL."base_cut_price/save";?>',
    data    : putdata,
    dataType: 'json',
    success : function (data){
      if(data['id'] && data['goodsType']){
        SAYIMO.go_url('<?php echo APP_URL."base_cut_price/addGoods";?>'+"?id="+data['id']+"&goodsType="+data['goodsType']);
      }else{
        SAYIMO.go_url('<?php echo APP_URL."base_cut_price/addGoods";?>'+"?id="+$("#id").val()+"&goodsType="+$("#goodsType").val());
      }
    }
  })
}

//实例化编辑器
var $editor = $('#description').editor();
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


// 获取某个时间格式的时间戳
function totimestamp(timestr){
  var stringTime = timestr ;
  var timestamp2 = Date.parse(new Date(stringTime));
  timestamp2 = timestamp2 / 1000;
  return timestamp2;
}

/**
 * [图片裁剪上传]
 */
$("#upload_btn").J_jcorp({
  'filePath':'<?php echo OTHERIMGPATH;?>',
  'imagePath':'<?php echo OTHERIMGURL;?>',
  'aspectRatio': 1,//裁剪宽高比
  'maxSize': [320,320],//裁剪最大尺寸 [width,height]
  'minSize': [320,320],//裁剪最小尺寸 [width,height]
  'picSize': [320,320],//最终保存图片尺寸 [width,height]
  'quality': 3,//裁剪完后图片压缩比例
  'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
  'callback': function(s,data){//接口成功回调
    $('#upload_photo').html('<img src="' + s + '" />');
    if(data.data[0].photoUrl!=undefined){
      $("#photoUrl").val(data.data[0].photoUrl);
    }
  }       
});
</script>

<script type="text/javascript">
$(function(){
  //供应商对话框远程加载页面
  //对话框回调函数
  var goods_callback = function(o){

  }
  SAYIMO.dialogView('js_add_goods','商品','tirgger_goods_btn','base_cut_price/viewGoods?goodsType='+$("#goodsType").val()+'&goodsIds='+$("#goodsIds").val(),'js_btn_item_disabled',goods_callback);

  //重新加载对话框内容
  $("#js_add_goods").on("hidden", function() {  
      $(this).removeData("modal");  
  });  
});

$(function(){
  var submitBefore = function(){
      var preferentialPrice_val = $("#preferentialPrice").val();
      var minPrice_val = $("#minPrice").val();
      if(preferentialPrice_val < minPrice_val){
        $.alert("销售价要大于最金额");
      }else{
        return true;
      } 
  };
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_cut_price/save';
  SAYIMO.form.init('#base_cut_price-form',_opts,submitBefore);
});

</script>