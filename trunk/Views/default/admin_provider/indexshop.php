<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <li onclick="s_navclick('viewprovider');"><a>供应商</a></li>
  <li class="active" onclick="s_navclick('indexshop');"><a>联盟商</a></li>
</ul>
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
    <div class="controls">
      <input type="text" id="providerNames" name="providerName" class="input-large input-fat" value="<?php echo $providerName;?>" placeholder="按联盟商名字查询">
      
      <button type="submit" id="viewsearch-bn" data-url="admin_provider/viewprovider" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="company_list" id="js_company_list">

</div>
<?php if($page['total_page'] > 1){?>
    <div class="page"></div>
<?php }?>
<script type="text/javascript">
    //查找
    var _obs = {};
        _obs.btn = "#viewsearch-bn";
        _obs.modal_body = "#js_add_company .modal-body";
    SAYIMO.form.view_search(_obs);


    var _pagedata = {};
    var key=$("#providerNames").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "admin_provider/ajaxindexshop?providerName="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_company_list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

function s_navclick(url)
  {
    var container = $("#js_add_company").find("div .modal-body");
    OO.loading(container);
    container.load(OO._SRVPATH+"admin_provider/"+url);
    // return false;
    // if(url == "viewprovider"){

    //   SAYIMO.go_url("<?php echo APP_URL;?>admin_provider/viewprovider");
    // }
    // if(url == "indexshop"){
    //   SAYIMO.go_url("<?php echo APP_URL;?>admin_provider/indexshop");
    // }
  }
</script>
