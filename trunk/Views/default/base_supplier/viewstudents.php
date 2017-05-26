
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
      <input type="text" id="realName" name="realName" class="input-large input-fat" value="<?php echo $realName;?>" placeholder="真实姓名">
      <button type="submit" id="viewsearch-bn" data-url="base_supplier/viewstudents" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="goods_list" id="js_goods_list">
  <?php echo $page['total_page'];?>
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
    var realName=$("#realName").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_supplier/ajaxStudents?realName="+encodeURIComponent(realName)+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_goods_list';
    _pagedata.labelname = '.veiw_page';
    SAYIMO.pagination(_pagedata);

 });

//勾选添加学生
function check_ok(){
  var backgoods = [];
  $.each($("#goodslist tr"), function(index, val) {
    var customer_item = {};
    if($(val).find("input[type=radio]").is(':checked')){
      customer_item.customerId = $(val).find(".js_customerId").text();

      backgoods.push(customer_item);
    }
  });
  render_goods(backgoods);
  $('#js_add_goods').modal('hide'); 
}

function render_goods(obj){
  $.each(obj, function(i, v) {
    // $('#goodsName1').val(v.goodsName);
    // $('#providerName').val(v.providerName);
    // $('#preferentialPrice').val(v.preferentialPrice);
    // $('#stockNum').val(v.stockNum);
     var customerId =  $("#customerId").val();

     if(customerId){
      if(customerId.indexOf('placeholder')>-1){
        $("#customerId").prop('value',v.customerId);
      }else{
        $("#customerId").prop('value',v.customerId);
      }
     }else{
      $("#customerId").prop('value',v.customerId);
     }
  });
}
</script>