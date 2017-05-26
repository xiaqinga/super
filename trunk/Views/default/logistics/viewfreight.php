
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
    <div class="controls">
      <input type="text" id="logisticsName" name="logisticsName" class="input-large input-fat" value="<?php echo $logisticsName;?>" placeholder="按运费模板名称查询">
      <input type="text" id="expressCompanyName" name="expressCompanyName" class="input-large input-fat" value="<?php echo $expressCompanyName;?>" placeholder="按快递公司查询">
      <button type="submit" id="viewsearch-bn" data-url="logistics/viewfreight" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="freight_list" id="js_freight_list">

</div>
<?php if($page['total_page'] > 1){?>
    <div class="page"></div>
<?php }?>

<script type="text/javascript">
$(function(){
    //查找
    var _obs = {};
        _obs.btn = "#viewsearch-bn";
        _obs.modal_body = ".modal-body";
    SAYIMO.form.view_search(_obs);

    //分页
    var _pagedata = {};
    var logisticsName=$("#logisticsName").val();
    var expressCompanyName=$("#expressCompanyName").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "logistics/ajaxviewfreight?logisticsName="+logisticsName+"&expressCompanyName="+expressCompanyName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_freight_list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

 });
</script>