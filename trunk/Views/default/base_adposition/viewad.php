
<!--对话框浏览器开始-->

<div class="ad_list" id="js_ad_list">

</div>
<?php if($page['total_page'] > 1){?>
    <div class="page"></div>
<?php }?>
<script type="text/javascript">
    var _pagedata = {};
    var key='';
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_adposition/ajaxviewad?key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '#js_ad_list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

</script>
