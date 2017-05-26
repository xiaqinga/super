<style type="text/css">
  .goods_class a{ cursor: pointer; }
</style>
<div class="content-top">
	<form class="sui-form" id="search">
		<div class="controls">
      <input type="text" id="goodsCode" name="goodsCode" class="input-middle input-fat" placeholder="按商品编号查询" value="<?php echo $goodsCode;?>">
      <input type="text" id="goodsName" name="goodsName" class="input-middle input-fat" placeholder="按商品名称查询" value="<?php echo $goodsName;?>">
      <input value="<?php echo $goodsClassId;?>" id="goodsClassId" name="goodsClassId" type="hidden">
      <input value="<?php echo trim($className);?>" name="className" id="className" type="hidden">
      <input value="<?php echo trim($providerName);?>" name="providerName" id="providerName" type="hidden">

      <span class="sui-dropdown dropdown-bordered goods_class">
        <span class="dropdown-inner">
          <a role="button" data-toggle="dropdown" class="dropdown-toggle">
            <i class="caret"></i><?php echo $className?trim($className):'按分类名称';?></a>
          <ul role="menu" aria-labelledby="drop1" class="sui-dropdown-menu">
            <li>
              <a>按分类名称</a>
            </li>
            <li role="presentation" class="dropdown-submenu classA">
              <a role="menuitem" tabindex="-1" value="0">
                <i class="sui-icon icon-angle-right pull-right"></i>顶级</a>
              <ul class="sui-dropdown-menu">
                <li role="presentation">
                  <a role="menuitem" tabindex="-1">一级</a></li>
                <li role="presentation" class="dropdown-submenu classB">
                  <a role="menuitem" tabindex="-1">
                    <i class="sui-icon icon-angle-right pull-right"></i>二级</a>
                  <ul class="sui-dropdown-menu">
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1">三级</a></li>
                  </ul>
                </li>
                <li role="presentation">
                  <a role="menuitem" tabindex="-1">一级</a></li>
              </ul>
            </li>
          </ul>
        </span>
      </span>
			<?php if($accouttype != 2){?>
      &nbsp;&nbsp;&nbsp;供应商：
      <span class="sui-dropdown dropdown-bordered select downlist_providerList"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden"><i class="caret"></i><span><?php echo $providerName?trim($providerName):'请选择';?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        <?php foreach ($providerList as $key => $value) :?>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $key;?>"><?php echo $value;?></a></li>
        <?php endforeach;?>
        </ul></span></span>
      <?php }else{?>
      	<input value="<?php echo $providerId;?>" name="providerId" id="providerId" type="hidden">
      <?php }?>
      &nbsp;&nbsp;&nbsp;按状态：
      <span class="sui-dropdown dropdown-bordered select downlist_status"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $status;?>" name="status" id="status" type="hidden"><i class="caret"></i>
        <span>
          <?php 
            if($status==1){
              echo "上架";
            }elseif($status==2){
              echo "下架";
            }elseif($status==3){
              echo "待审核";
            }elseif($status==4){
              echo "已驳回";
            }else{
              echo "请选择";
            }
          ?>
        </span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">上架</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="2">下架</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="3">待审核</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="4">已驳回</a></li>
        </ul></span></span>
			<button type="submit" id="search-bn" data-url="goods_list_business/index" class="sui-btn btn-large btn-primary">查询</button>
			<?php echo form_a_auth(array('content'=>'添加商品','check'=>'goods_list_business/add','class'=>'btn-large','url'=>APP_URL.'goods_list_business/edit?ref='.$ref));?>
      <?php echo form_a_auth(array('content'=>'导出商品','check'=>'goods_list_business/export_order','class'=>'btn-large','onclick'=>'js_export()'));?>
      <!-- <a href="javascript:void(0);" onclick="js_export();" class="sui-btn btn-large">导出商品</a> -->
     	</div>
	</form>
</div>
<div class="goods_list_business-list">
</div>
<?php if($page['total_page'] > 1){?>
	<div class="page"></div>
<?php }?>

<script type="text/javascript">
$(function(){
	SAYIMO.form.search("#search-bn");
});
var goodsCode = $("#goodsCode").val();
var goodsName = $("#goodsName").val();
var goodsClassId = $("#goodsClassId").val();
var providerId = $("#providerId").val();
var status = $("#status").val();
var className = $("#className").val();
var providerName = $("#providerName").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "goods_list_business/ajaxIndex?goodsCode="+encodeURIComponent(goodsCode)+"&goodsName="+encodeURIComponent(goodsName)+"&goodsClassId="+goodsClassId+"&providerId="+providerId+"&status="+status+"&className="+className+"&providerName="+encodeURIComponent(providerName)+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.goods_list_business-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);
</script>

<script type="text/javascript">

//ajax 顶级-->一级分类
$(".goods_class").on('mouseenter','.classA',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classB"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})
//ajax 一级分类-->二级分类
$(".goods_class").on('mouseenter','.classB',function(){
  var _cur = $(this);
  if(!_cur.hasClass('hasLoad')){
    $.ajax({
      type:'post',
      url:'<?php echo APP_URL?>goods_class/getClassJson',
      data:{'id':_cur.find('a').attr('value')},
      dataType:"json",
      async:false,
      success:function(data){
        var ul = '<ul class="sui-dropdown-menu">';
        for (var i = data.length - 1; i >= 0; i--) {
          ul += '<li role="presentation" '+ (data[i].has_sub?'class="dropdown-submenu  classC"':'') +'><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="'+data[i].id+'">'+(data[i].has_sub?'<i class="sui-icon icon-angle-right pull-right"></i>':'')+data[i].className+'</a></li>\n';
        }
        _cur.append(ul);
        _cur.addClass("hasLoad");
      }
    })
  }
})

//隐藏goodsClassId和className跟踪当前选中的
$(".goods_class").on('click','li a',function(){
  var _cur = $(this).eq(0);
  $(".goods_class .dropdown-inner a:eq(0)").text(_cur.text());
  $("#goodsClassId").val(_cur.attr('value'));
  $("#className").val(_cur.text());
})

//隐藏providerName跟踪当前选中的
$(".downlist_providerList").on('click','li a',function(){
  var _cur_p = $(this).eq(0);
  $("#providerName").val(_cur_p.text());
})

//导出商品
function js_export(){
  var providerId = $("#providerId").val();
  if(providerId){
    window.open("<?php echo APP_URL?>goods_list_business/exportorder?providerId=" + providerId);
  }else{
    $.alert("请选择供应商");
  }
}

// //同步
$('#sync').on('click',function(){
    $.ajax({
      url:'<?php echo APP_URL?>goods_list_business/sync_goods',
      success:function(data){
          $.alert("同步成功");
      }
    });
    $('#sync').remove();
  })

function updatecahce(){
  $.confirm({
    title: '确认对话框',
    body: '确认更新缓存吗？',
    backdrop: false,
    okHide: function() {
      $.ajax({
          type    : "post",
          async   : false,
          url     : '<?php echo APP_URL;?>goods_class/updatecahce',
          data    : '',
          dataType: 'json',
          success : function (data)
          {
            console.log(data);
              if (data['data']['msg'] == true){
                  $.alert("更新分类缓存成功！");
              }else{
                  $.alert("更新失败！");
              }
          }
      });
    },
    hide: function() {}
  });
}
</script>