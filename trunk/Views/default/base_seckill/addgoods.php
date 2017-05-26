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
    <li class="active">秒抢管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>

<ul class="sui-nav nav-tabs nav-primary">
  <li class="active"><a>添加时间段</a></li>

</ul>

<div class="content-top ">
	<form class="sui-form" id="search">
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <input type="hidden" name="goodsType" name="goodsType" value="<?php echo $goodsType;?>">
  <input type="hidden" name="goodsIds" id="goodsIds" value="<?php echo $goodsIds;?>">
  <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
  <span class="required">*</span>秒抢有效时间:
      <input class="input-xlarge input-fat" style="width:180px;" id="startDate" name="startDate" value="<?php echo $startDate;?>" <?php if(empty($startDate)){echo "data-toggle='datepicker' data-date-timepicker='true'";}else{echo "readonly='true'";}?>>&nbsp;至&nbsp;<input class="input-xlarge input-fat" style="width:180px;" id="endDate" name="endDate" value="<?php echo $endDate;?>" <?php if(empty($endDate)){echo "data-toggle='datepicker' data-date-timepicker='true'";}else{echo "readonly='true'";}?>>
  <?php echo form_a_auth(array('content'=>'添加商品','class'=>'btn-large','id'=>'tirgger_goods_btn'));?>

	</form>
</div>

<div class="base_seckill-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>
  <div align="center">
    <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="addGoodsTosave();">保存</button>
  </div>
<script type="text/javascript">
//查找
$(function(){
	SAYIMO.form.search("#search-bn");
});
var key_type = $("#key_type").val();
var key = $("#key").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_seckill/ajaxaddgoods?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>&key_type="+key_type+"&key="+encodeURIComponent(key)+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_seckill-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);

function s_navclick(url)
{ 
  $(".sui-nav.nav-tabs").removeClass('active');
  if(url=='edit'){
    $(".sui-nav.nav-tabs").eq(0).addClass('active');
  }
  if(url == 'addgoods'){
    $(".sui-nav.nav-tabs").eq(1).addClass('active');
  }
  SAYIMO.go_url("<?php echo APP_URL;?>base_seckill/"+url+"?id="+$("#id").val()+"&goodsType=<?php echo $goodsType;?>");
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
  //供应商对话框远程加载页面
  //对话框回调函数
  var goods_callback = function(o){

  }
  SAYIMO.dialogView('js_add_goods','商品','tirgger_goods_btn','base_seckill/viewGoods?goodsType=<?php echo $goodsType;?>&goodsIds='+$("#goodsIds").val(),'js_btn_item_disabled',goods_callback);

  //重新加载对话框内容
  $("#js_add_goods").on("hidden", function() {  
      $(this).removeData("modal");  
  });  
});

//保存
function addGoodsTosave(){
  var goodsIds = $("#goodsIds").val();
  var startDate = $('#startDate').val();
  var endDate = $('#endDate').val();
  var id = $("#id").val();
  var goodsType = $('#goodsType').val();
  var canpost = true;
  var startDate_t = startDate.substring(0,10);
  var endDate_t = endDate.substring(0,10);

  if(!startDate){
    $.alert('还没有填写有效时间');
    return false;
  }
  if(!endDate){
    $.alert('还没有填写有效时间');
    return false;
  }
  if(endDate < startDate){
    $.alert('请填写正确的有效时间');
    return false;
  }
  if (startDate_t != endDate_t) {
    $.alert('秒抢有效时间只能当天');
    return false;
  }
  if(!goodsIds){
    $.alert("还没有添加商品");
    return false;
  }
  if(document.querySelectorAll("#addgoods_list tr").length<=0){
    $.alert("还没有添加商品");
    return false;
  }
  $('input[name="addgoods_activityPrice"]').each(function(){
    var res=/^\d{1,}(\.\d{1,2})?(%)?$/;
    if ($(this).val() == '') {
      $.alert('活动价不能为空');
      tmp=false;
      $(this).focus().select().css("borderColor", "red");
      canpost = false;
    }else if(!res.test($(this).val())){
      $.alert('活动价格式不正确');
      tmp=false;
      $(this).focus().select().css("borderColor", "red");
      canpost = false;
    }
  });
  $('input[name="addgoods_goodsName"]').each(function(){
    if ($(this).val() == '') {
      $.alert('商品活动名称不能为空');
      tmp=false;
      $(this).focus().select().css("borderColor", "red");
      canpost = false;
    }
  });

  if(!canpost){
    return false;
  }

  var itemsArr = new Array();
  $.each($("#addgoods_list tr"), function(index, val) {
      var obj={};
      obj.goodsId = $(val).find("input[name='addgoods_id']").val();
      obj.goodsName = $(val).find("input[name='addgoods_goodsName']").val();
      obj.originalPrice = $(val).find("input[name='addgoods_originalPrice']").val();
      obj.activityPrice = $(val).find("input[name='addgoods_activityPrice']").val();
      obj.activityNum = $(val).find("input[name='addgoods_activityNum']").val();
      obj.startDate = startDate;
      obj.endDate = endDate;
      itemsArr.push(obj);
  });

  //console.log(itemsArr);

  $.ajax({
    type    : "post",
    async   : false,
    url     : '<?php echo APP_URL."base_seckill/saveb";?>',
    data    : {"id":id,"goodsType":goodsType ,"goodsIds":goodsIds, "startDate":startDate, "endDate":endDate, "itemsArr":JSON.stringify(itemsArr)},
    dataType: 'json',
    success : function (data){   
      if (data['msg'] == true){
        $.alert('恭喜亲，保存成功');
        if(data['goodsType'] == '0'){
          SAYIMO.go_url("<?php echo APP_URL;?>base_seckill/index");
        }else{
          SAYIMO.go_url("<?php echo APP_URL;?>base_seckill/ordinary");
        }
        
      }else if(data['rec'] == true){
        $.alert('该时段已有秒抢活动');
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