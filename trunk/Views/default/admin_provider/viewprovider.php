<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
  <?php if($lm!=1):?>
  <li class="<?php echo  $providerType==1?'active':''?>" <?php if(empty($mallType)){echo "onclick=s_navclick('1');";}?>><a>供应商</a></li>
<?php endif;?>
  <?php if(empty($mallType)){?>
  <li class="<?php echo  $providerType==2?'active':''?>" onclick="s_navclick('2');"><a>联盟商</a></li>
  <?php }?>
</ul>
<!--对话框浏览器开始-->
<div class="content-top">
  <form class="sui-form" id="viewsearch">
    <div class="controls">
        <input  type='hidden' name="providerType" id='providerType' value='<?php  echo   $providerType ?>'>
        <input  type='hidden' name=" customerId" id='customerId' value='<?php  echo   $customerId ?>'>
        <input type="text" id="providerNames" name="providerName" class="input-large input-fat" value="<?php echo $providerName;?>" placeholder="按供应商名字查询">
       
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
    var  customerId=$("#customerId").val();
    var providerType=$("#providerType").val();
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "admin_provider/ajaxviewprovider?providerName="+key+"&customerId="+customerId+"&providerType="+providerType+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_company_list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

function s_navclick(type)
  {
    var container = $("#js_add_company").find("div .modal-body");
    var providerNames=$("#providerNames").val();
    var  customerId=$("#customerId").val();
    OO.loading(container);
    container.load(OO._SRVPATH+"admin_provider/viewprovider?providerType="+type+"&providerName="+providerNames+"&customerId="+customerId);
    
  }
</script>
