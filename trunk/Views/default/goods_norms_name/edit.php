<?php echo assets::$sayimo; ?>
<?php echo assets::$shop; ?>
<script type="text/javascript">
  //初始化
  var getValueIds  = new Array(); //获取[规格值]多个ID
  var saveValueIds = new Array(); //保存[规格值]多个ID
  var delValueIds  = new Array(); // 删除[规格值]多个ID = 获取ID - 保存ID 
</script>
<style type="text/css">
  .marks{
    line-height: 32px;
    color: gray;
  }
  .sui-form.form-horizontal .control-label {
      vertical-align: top;
  }
  .sui-form input[type="text"].input-large.key_value, .sui-form input[type="number"].input-medium.key_sort {
      margin-bottom: 10px;
  }
  .sui-form input[type="number"].input-medium.key_sort {
      margin-left: 5px;
  }
  .key-list i {
      display: inline-block;
      width: 24px;
      padding: 10px;
      border-radius: 6px;
      background-color: #FFFFF;
      font-size: 18px;
      color: red;
      cursor: pointer;
  }
</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>商品规格</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
<form id="goods_norms_name-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="normsName" class="control-label"><span class="required">*</span>规格名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="normsName" name="normsName" data-rules="required" data-empty-msg="规格名称不能为空！"  value="<?php echo  $attr['normsName'];?>">
      <br/><span class="marks">(请填写常用的产品规格的名称；例如：颜色、尺寸等。)</span>
    </div>
  </div>
  <div class="control-group">
    <label for="sort" class="control-label v-top"><span class="required">*</span>排序：</label>
    <div class="controls">
      <input min="0" type="number" class="input-small input-xfat" id="sort" name="sort" data-rules="required" data-empty-msg="排序不能为空！"  value="<?php echo  $attr['sort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="normsValueList" class="control-label v-top"><span class="required">*</span>规格值：</label>
    <div class="controls">
      <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary" onclick="backend.norms.add_value('',curCount());">添加规格值</a>
      <br/><span class="marks">(请按照规格名称填写相应的规格值；例如规格名为颜色，对应的规格值为：黑色、红色、蓝色；例如：规格名为尺码，对应的规格值为：36、37、38等。)</span>
      <input type="hidden" name="normsValueList" id="normsValueList" data-rules="required" data-empty-msg="规格值不能为空！" value='<?php echo json_encode($attr['normsValueList']);?>' >
      <input type="hidden" name="delValueIds" id="delValueIds" value='' >
    </div>
  </div>
  <div class="control-group">
    <label for="normsValueListShow" class="control-label v-top"></label>
    <div class="controls">
      <div class="js_input_wraper">
          <!--<input type="text" class="input-medium key_value" placeholder="输入规格值" /><span class="key-btn-close" onclick="backend.close();">&nbsp;&nbsp;&nbsp;</span>-->
      </div>
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

<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  //表单验证成功, 提交前处理
  var submitBefore = function(){

    //重置变量
    saveValueIds = [];
    delValueIds = [];  

    //隐藏规格值input[name='normsValueList']跟踪 .key-list input 变化
    var normsValueList = [];
    $('.key-list').each(function(){
      obj= {
          id: backend.comomn.save_json($(this).attr("data_id")),
          normsValue: backend.comomn.save_json($(this).find(".key_value").val()),
          displayOrder:backend.comomn.save_json($(this).find(".key_sort").val())
      }; 
      normsValueList.push(obj);
      saveValueIds.push(parseInt($(this).attr("data_id"))); //多个规格值ID
    })
    //生成漂亮格式的JSON字符串
    $("#normsValueList").val(JSON.stringify(normsValueList,null, 2)); //当前规格值列表 

    //计算删除规格值ID
    for (var i = getValueIds.length - 1; i >= 0; i--) {
        if( saveValueIds.indexOf(getValueIds[i]) < 0 ){
            delValueIds.push(getValueIds[i]);
        }
    }

    //删除的多个ID
    $("#delValueIds").val(JSON.stringify(delValueIds));

    return true;
  }
  _opts.url = OO._SRVPATH + 'goods_norms_name/save';
  SAYIMO.form.init('#goods_norms_name-form', _opts, submitBefore);
});

//编辑时规格值
$(document).ready(function(){
    <?php
    if(count($attr['normsValueList'])){
        foreach ($attr['normsValueList'] as $key => $value) {
            echo "backend.norms.add_value('".$value['normsValue']."',".$value['displayOrder'].",".$value['id'].");\n";
            echo "getValueIds.push(".$value['id'].");\n";
        }
    }
    ?>
});

//计算当前规格值数量
function curCount(){
  return parseInt(document.querySelectorAll('.key-list').length);
}
</script>