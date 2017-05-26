
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
    <input type="hidden" id="goodsId" name="goodsId" value="<?php echo $goodsId;?>" >
      <input type="text" id="goodsName" name="goodsName" class="input-large input-fat" value="<?php echo $goodsName;?>" placeholder="商品名称">
      <button type="submit" id="viewsearch-bn" data-url="base_moldbaby/viewGoods" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="goods_list" id="js_v_goods_list">

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
    var goodsName=$("#goodsName").val();
    var goodsId=$("#goodsId").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_moldbaby/ajaxGoods?goodsName="+encodeURIComponent(goodsName)+"&goodsId="+goodsId+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_v_goods_list';
    _pagedata.labelname = '.veiw_page';
    SAYIMO.pagination(_pagedata);

 });

//勾选添加商品
function check_ok(){
  var backgoods = [];
  $.each($("#goodslist tr"), function(index, val) {
    var goods_item = {};
    if($(val).find("input[type=checkbox]").is(':checked')){
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
     $("#addgoods_list").append("<tr>"+
      "<td><input name=\"addgoods_id\" value=\""+v.goodsId+"\" type=\"hidden\"></td>"+
      "<td align=\"left\">"+
        "<div width=\"85px\" style=\"float:left;\">"+
          "<img src=\""+v.photoPath+"\" alt=\"\" align=\"middle\" width=\"85px\" height=\"85px\"></div>"+
        "<div style=\"float:right;width: 70%;height:20px;padding-left:20px\">"+
          "<span style=\"display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;\" title=\""+v.providerName+"\">"+v.providerName+"</span></div>"+
        "<div style=\"float:right;width:70%;height:20px;padding-left:20px\">"+
          "<span style=\"display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;\">"+v.goodsName+"</span></div>"+
        "<div style=\"float:right;width: 70%;height:20px;padding-left:20px\">"+
          "<span style=\"display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;\">价&nbsp;&nbsp;&nbsp;格："+
            "<font style=\"color:red;\">¥"+v.preferentialPrice+"</font></span>"+
        "</div>"+
        "<div style=\"float:right;width: 70%;height:20px;padding-left:20px\">"+
          "<span style=\"display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;\">库存量："+v.stockNum+"</span></div>"+
      "</td>"+
      "<td class=\"center\"><input type=\"text\" name=\"addgoods_goodsName\" class=\"input-large input-fat\" value=\""+v.goodsName+"\"></td>"+
      "<td class=\"center\"><input type=\"number\" name=\"addgoods_originalPrice\" class=\"input-medium\" value=\""+v.originalPrice+"\"></td>"+
      "<td class=\"center\"><input type=\"text\" name=\"addgoods_activityPrice\" class=\"input-medium\" value=\""+v.activityPrice+"\"></td>"+
      "<td class=\"center\"><input type=\"number\" name=\"addgoods_activityNum\" class=\"input-medium\" value=\""+v.activityNum+"\"></td>"+
      "<td class=\"center\">"+
        "<a href=\"javascript:void(0);\" class=\"sui-btn btn-link base_moldbaby-delete\" data-id=\"2\" title=\"删除\"><img class=\"imgtable\" src=\"<?php echo ASSETS_URL;?>images/default/delete.png\"></a></td>"+
      "<td></td>"+
    "</tr>")
     var goodsId =  $("#goodsId").val();
     if(goodsId){
      if(goodsId.indexOf('placeholder')>-1){
        $("#goodsId").val(v.goodsId);
      }else{
        $("#goodsId").val(goodsId+','+v.goodsId);
      }
     }else{
      $("#goodsId").val(v.goodsId);
     }
  });
}
</script>