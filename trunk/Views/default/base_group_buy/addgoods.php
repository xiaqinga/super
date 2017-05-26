<style>
.sui-nav.nav-primary{
  margin-bottom: 0px;
}
.load-wrapper{
  margin-top: 30px;
}
.sui-btn.goback-btn {
  background: transparent;
}
.sui-breadcrumb{
  margin:0px;
}
</style>
<ul class="sui-breadcrumb">
    <li><a href="#">活动管理</a></li>
    <li class="active">团购管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-primary">
  <li onclick="s_navclick('edit');"><a>基本信息</a></li>
  <li class="active" onclick="s_navclick('addgoods');"><a>添加商品</a></li>
</ul>
<div class="load-wrapper">
<form id="base_group_buy-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="identifier" class="control-label v-top"><span class="required">*</span>添加商品：</label>
      <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="goodsType" id="goodsType" value="<?php echo $goodsType;?>">
      <input type="hidden" name="goodsIds" id="goodsIds" value="<?php echo $goodsIds;?>">
      <a href="javascript:void(0);" id="tirgger_goods_btn" class="sui-btn btn-xlarge btn-primary">添加商品</a>
    </div>
  </div>

  <div class="control-group">
    <label for="goodsName" class="control-label v-top">商品名称：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="goodsName1" name="goodsName1" value="<?php echo  $goodsName;?>">
    </div>
  </div>
  <div class="control-group">
    <label for="providerName" class="control-label">供应商:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName" disabled value="<?php echo  $list['providerName'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="preferentialPrice" class="control-label">价格:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="preferentialPrice" name="preferentialPrice" disabled value="<?php echo  $list['preferentialPrice'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="stockNum" class="control-label">库存量:</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="stockNum" name="stockNum" disabled value="<?php echo  $list['stockNum'];?>">
    </div>
  </div>

  <div align="center">
    <button type="button" class="sui-btn btn-xlarge " onclick="s_navclick('edit');">上一步</button>
    <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="addGoodsTosave();">保存</button>
  </div>
  </form>
  </div>

<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
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
  SAYIMO.go_url("<?php echo APP_URL;?>base_group_buy/"+url+"?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>");
}

$('#search').on('click','.sui-dropdown-menu li:eq(0)',function(){
  $("#key").attr('type','show');
  $("#key").val('');
  $(".downlist_providerList").hide();
})

$('#search').on('click','.sui-dropdown-menu li:eq(1)',function(){
  $("#key").attr('type','hidden');
  $(".downlist_providerList").show();
})

function changeKeyValue (n) {
  $("#key").val(n);
}

$(function(){
  if($("#goodsIds").val() == '0'){
    $('#goodsName1').val('');
    $('#providerName').val('');
    $('#preferentialPrice').val('');
    $('#stockNum').val('');
  }
  //供应商对话框远程加载页面
  //对话框回调函数
  var goods_callback = function(o){
  }
  SAYIMO.dialogView('js_add_goods','商品','tirgger_goods_btn','base_group_buy/viewGoods?goodsType='+$("#goodsType").val()+'&goodsIds='+$("#goodsIds").val(),'js_btn_item_disabled',goods_callback);

  //重新加载对话框内容
  $("#js_add_goods").on("hidden", function() {  
      $(this).removeData("modal");  
  });  
});

//保存
function addGoodsTosave(){
  var goodsIds = $("#goodsIds").val();
  var id = $("#id").val();
  var goodsName1 = $('#goodsName1').val();
  var goodsType = $('#goodsType').val();
  var canpost = true;
  if(!goodsIds){
    $.alert("还没有添加商品");
    return false;
  }

  $.ajax({
    type    : "post",
    async   : false,
    url     : '<?php echo APP_URL."base_group_buy/saveb";?>',
    data    : {"id":id, "goodsIds":goodsIds, "goodsName":goodsName1,"goodsType":goodsType },
    dataType: 'json',
    success : function (data){
      if (data['msg'] == true){
        $.alert('恭喜亲，保存成功');
        SAYIMO.go_url("<?php echo APP_URL.'base_group_buy/index';?>");
        //SAYIMO.go_url("<?php echo APP_URL;?>base_activity/addgoods?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>");
      }else{
        $.alert('亲，内容没有修改');
      }
    }
  });
}

function deleteId(o,id)
{
  $.confirm({
    body: '你确定要删除该商品吗?',
    okHide: function(e){
      //扩展数组原型
      Array.prototype.remove=function(dx) 
      { 
          if(isNaN(dx)||dx>this.length){return false;} 
          for(var i=0,n=0;i<this.length;i++) 
          { 
              if(this[i]!=this[dx]) 
              { 
                  this[n++]=this[i] 
              } 
          }
          this.length-=1 
      } 
      //删除DOM
      $(o).parents("tr").remove();
      //组合数组
      var goodsIds =  $("#goodsIds").val();
      var goodsArr = new Array();
      if(goodsIds.indexOf(",")>-1){
        goodsArr = goodsIds.split(",")
      }else{
        goodsArr[0] = goodsIds;
      }

      //删除数组元素
      for (var i = goodsArr.length - 1; i >= 0; i--) {
        if( goodsArr[i] ==  id){
          goodsArr.remove(i);
        }
      }
      $("#goodsIds").val(goodsArr.join(','));
    }
  })
}
</script>
<?php echo assets::$sayimo; ?>
<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'goodsName':
      return "商品名称";
      break;
    case 'providerId':
      return '供应商名称';
      break;
    default:
      return '请选择';
      break;
  }
}
function showKeyInput($key_type){
  switch ($key_type) {
    case 'goodsName':
      return 'text';
      break;
    case 'providerId':
      return 'hidden';
      break;
    default:
      return 'hidden';
      break;
  }
}
?>