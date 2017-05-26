<div class="content-top ">
  <form class="sui-form" id="search">

      <input type="text" id="providerName" name="providerName" class="input-xlarge input-fat" value="<?php echo $providerName;?>">
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL ;?>base_enterprise_info/viewcompany" class="sui-btn btn-large btn-primary">查询</button>
  </form>
</div>
<!--对话框浏览器开始-->

<div class="company_list" id="js_company_list">

</div>
<?php if($page['total_page'] > 1){?>
    <div class="page"></div>
<?php }?>
<script type="text/javascript">
$(function(){
  var _obs = {};
        _obs.btn = "#search-bn";
        _obs.modal_body = ".modal-body";
    SAYIMO.form.view_search(_obs);

    var _pagedata = {};
    var providerName=$("#providerName").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_enterprise_info/ajaxviewcompany?providerName="+providerName+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_company_list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

});

</script>
<?php echo assets::$sayimo; ?>
