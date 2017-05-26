
<style type="text/css">
  .sui-form.form-horizontal .control-label {
      width: 110px;
  }
  .sui-form.form-horizontal .control-label{
    text-align: left;
    padding-left: 20px;
  }
  .checkbox-pretty input.norms-input{
    opacity: 100; 
    position: relative;
    z-index: 0;
    left: 0;
    top: 0;
  }
 .sui-form.form-horizontal .control-group {
    margin-bottom: 5px;
}
.sui-form .uneditable-input{
  border: none;
}
.sui-form input[disabled]{background-color: #d4d4d4;}
</style>
<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>商品</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
  <li onclick="navclick('edit');"><a>基本信息</a></li>
  <li onclick="navclick('photoedit');"><a>图片参数</a></li>
  <li class="active" onclick="navclick('normsedit');"><a>规格设定</a></li>
</ul>
<div class="load-wrapper norms-wrapper">
<form id="norms_edit-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
  <input type="hidden" name="normsaId" id="normsaId" value="<?php echo $normsaId;?>" >
  <input type="hidden" name="normsbId" id="normsbId" value="<?php echo $normsbId;?>" >
  <div class="control-group">
    <label for="photoId" class="control-label v-top">
      <span class="sui-dropdown dropdown-bordered select">
        <span class="dropdown-inner selectSizeA">
          <a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
            <i class="caret"></i>
            <span>请选择</span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          <?php foreach ($normslist as $key => $value) :?>
            <li role="presentation" id="size_1_<?php echo $value['id']; ?>" data='[{"size":"1","id":"<?php echo $value['id']; ?>","value":"<?php echo $value['normsName']; ?>","order":"<?php echo $value['displayOrder']; ?>"}]' onclick="Size.get_size_attr(this,1);">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'];?>"><?php echo $value['normsName'];?></a></li>
          <?php endforeach;?>
          </ul>
        </span>
      </span>
    </label>
    <div class="controls">
      <ul class="attr_list js_attr_list"></ul>
      <div class="btn-add-attr" onclick="Size.addAttrItem(1);"><i class="sui-icon icon-pc-plus-circle"></i></div>
    </div>
  </div>
  <div class="control-group">
    <label for="photoId" class="control-label v-top">
      <span class="sui-dropdown dropdown-bordered select">
        <span class="dropdown-inner selectSizeB">
          <a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
            <i class="caret"></i>
            <span>请选择</span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          <li role="presentation" id="size_2_0" data='[{"size":"2","id":"0","value":"无","order":"0"}]' onclick="Size.get_size_attr(this,2);" class="none"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">无</a></li>
          <?php foreach ($normslist as $key => $value) :?>
            <li role="presentation" id="size_2_<?php echo $value['id']; ?>" data='[{"size":"2","id":"<?php echo $value['id']; ?>","value":"<?php echo $value['normsName']; ?>","order":"<?php echo $value['displayOrder']; ?>"}]' onclick="Size.get_size_attr(this,2);">
              <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'];?>"><?php echo $value['normsName'];?></a></li>
          <?php endforeach;?>
          </ul>
        </span>
      </span>
    </label>
    <div class="controls">
      <ul class="attr_list js_attr_list"></ul>
      <div class="btn-add-attr" onclick="Size.addAttrItem(2);"><i class="sui-icon icon-pc-plus-circle"></i></div>
    </div>
  </div>
  <div class="norms-list">
    <table class="sui-table table-bordered-simple">
      <thead class="js_header" style="display: none;">
        <!-- <tr class="thbg">
          <th colspan="8"></th>
        </tr> -->
        <tr class="thbk">
          <th class="center">销售价（元）</th>
          <th class="center">库存数量</th>
          <th class="center">商品重量（千克）</th>
          <!-- <th class="center">市场价（元）</th> -->
          <!--<th class="center">优惠价（元）</th>-->
        </tr>
      </thead>
      <tbody class="js_sizes">
        <!-- <tr>
          <td class="center">80g</td>
          <td class="center"><input type="text" class="input-medium"></td>
          <td class="center"><input type="text" class="input-medium"></td>
          <td class="center"><input type="text" class="input-medium"></td>
          <td class="center"><input type="text" class="input-medium"></td>
          <td class="center"><input type="text" class="input-medium"></td>
        </tr> -->
      </tbody>
    </table>
  </div>
  <div class="control-group js_btn_submit" style="display: none;">
    <label class="control-label"></label>
    <div class="controls">
      <button type="button" class="sui-btn btn-xlarge " onclick="navclick('photoedit');">上一步</button>
      <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="Size.saveSizeGoods()">保存</button>
      <button type="button" class="sui-btn btn-xlarge " onclick="navclick('normsedit');">重设</button>
    </div>
  </div>
</form>
</div>

<?php echo assets::$shop_business;?>
<?php echo assets::$sayimo; ?>

<script type="text/javascript">

$(document).ready(function(){
    if(!$("#id").val()){
      $.alert({
        title:'温馨提示',
        body: '亲，先完善商品基本信息',
        okHidden: function(e){
          SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/edit");
        }
      })
    }
});

//编辑时获取数据库中组合的商品
$.post("<?php echo APP_URL;?>goods_list_business/getpartgoods?random=" + (new Date()),
    {'goodsId': $("#id").val()},
    function (data)
    {
      $(".js_sizes").empty().append(data); //加载 列印组合商品js 
    }
);

//选项卡跳转
function navclick(action)
{
  $(".sui-nav.nav-tabs").removeClass('active');
  if( action == 'edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }else if( action == 'normsedit' ){
    $(".sui-nav.nav-tabs").eq(1).addClass('active')
  }
  SAYIMO.go_url("<?php echo APP_URL;?>goods_list_business/"+action+"?id="+$("#id").val());
}

</script>