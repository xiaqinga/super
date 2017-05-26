
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
    <input type="hidden" id="goodsIds" name="goodsIds" value="<?php echo $goodsIds;?>" >
      <?php
        if($goodsType==1){
          $cur_downlist_name = '普通商品';
        }elseif($goodsType!=null){
          $cur_downlist_name = '预约商品';
        }else{
          $cur_downlist_name = '商品类型';
        }
      ?>
      <span class="sui-dropdown dropdown-bordered select downlist_goodsType <?php if($goodsType!=null || $goodsType==1){echo "disabled";}?>">
        <span  class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
          <input value="<?php echo $goodsType;?>" name="goodsType" id="goodsType" type="hidden"><i class="caret"></i><span id="providerNameHtml"><?php echo $cur_downlist_name;?></span></a>
          <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="1">普通商品</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="0">预约商品</a></li>
          </ul>
        </span>
      </span>
      <input type="text" id="goodsName" name="goodsName" class="input-large input-fat" value="<?php echo $goodsName;?>" placeholder="商品名称">
      <button type="submit" id="viewsearch-bn" data-url="base_group_buy/viewGoods" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="goods_list" id="js_goods_list">

</div>
<?php if($page['total_page'] > 1){?>
    <div class="veiw_page"></div>
<?php }?>
<div align="center"><a href="javascript:void(0);" onclick="check_ok();" class="sui-btn btn-xlarge btn-primary">确认并返回</a></div>
<script type="text/javascript">
$(function(){
    //查找
    var _obs = {};
        _obs.btn = "#viewsearch-bn";
        _obs.modal_body = ".modal-body";
    SAYIMO.form.view_search(_obs);

    //分页
    var _pagedata = {};
    var goodsType=$("#goodsType").val();
    var goodsName=$("#goodsName").val();
    var goodsIds=$("#goodsIds").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_group_buy/ajaxGoods?goodsType="+goodsType+"&goodsName="+encodeURIComponent(goodsName)+"&goodsIds="+goodsIds+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_goods_list';
    _pagedata.labelname = '.veiw_page';
    SAYIMO.pagination(_pagedata);

 });

//勾选添加商品
function check_ok(){
  var backgoods = [];
  $.each($("#goodslist tr"), function(index, val) {
    var goods_item = {};
    if($(val).find("input[type=radio]").is(':checked')){
      goods_item.providerName = $(val).find(".js_providerName").text();
      goods_item.goodsName = $(val).find(".js_goodsName").text();
      goods_item.preferentialPrice = $(val).find(".js_preferentialPrice").text();
      goods_item.stockNum = $(val).find(".js_stockNum").text();
      goods_item.originalPrice = $(val).find(".js_originalPrice").text();
      goods_item.activityPrice = $(val).find(".js_activityPrice").text();
      goods_item.activityNum = $(val).find(".js_activityNum").text();
      goods_item.photoPath = $(val).find(".js_photoPath").text();
      goods_item.goodsId = $(val).find(".js_goodsId").text();

      backgoods.push(goods_item);
    }
  });
  render_goods(backgoods);
  $('#js_add_goods').modal('hide'); 
}

function render_goods(obj){
  $.each(obj, function(i, v) {
    $('#goodsName1').val(v.goodsName);
    $('#providerName').val(v.providerName);
    $('#preferentialPrice').val(v.preferentialPrice);
    $('#stockNum').val(v.stockNum);
     var goodsIds =  $("#goodsIds").val();

     if(goodsIds){
      if(goodsIds.indexOf('placeholder')>-1){
        $("#goodsIds").prop('value',v.goodsId);
      }else{
        $("#goodsIds").prop('value',v.goodsId);
      }
     }else{
      $("#goodsIds").prop('value',v.goodsId);
     }
  });
}
</script>