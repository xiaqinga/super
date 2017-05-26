<style>
    .nav-xlarge{
        margin-top: 10px;
        margin-bottom: 0px;
    }
</style>

<ul class="sui-nav nav-tabs nav-xlarge">
    <?php if (auth_check_permissions('base_statement/index')):?>
        <li  onclick="s_navclick('index?providerType=1');"><a>供应商对账</a></li>
    <?php endif;?>
    <?php if (auth_check_permissions('base_statement/statistic')):?>
        <li  onclick="s_navclick('statistic?providerType=1');"><a>供应商对账统计</a></li>
    <?php endif;?>
    <?php if (auth_check_permissions('base_statement/index')):?>
        <li  onclick="s_navclick('index?providerType=2');"><a>联盟商对账</a></li>
    <?php endif;?>
    <?php if (auth_check_permissions('base_statement/statistic')):?>
        <li   onclick="s_navclick('statistic?providerType=2');"><a>联盟商对账统计</a></li>
    <?php endif;?>

        <li  class="active" onclick="s_navclick('fund');"><a>基金对账统计</a></li>

</ul>

<div class="customerstatis-list" style="margin: 8px 0">
    <table class="sui-table table-bordered-simple">
        <thead>
        <tr class="thbk">
            <th class="center">学校基金总数</th>
            <th class="center">尚一基金总数</th>
        
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">
                <?php foreach ($moneyCount as $item){
                     if($item['fundType']==1){
                         $schoolMoney=$item['money'];
                     }

                }?>
                <?php echo $schoolMoney?:'--';?>
            </td>
            <td class="center">
                <?php foreach ($moneyCount as $item){
                    if($item['fundType']==2){
                        $enterMoney=$item['money'];
                    }

                }?>
                <?php echo $enterMoney?:'--';?>
            </td>
          
        </tr>
        </tbody>
    </table>
</div>
<div class="content-top">
    <form class="sui-form" id="search">
        <div class="controls">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="">请选择</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="schoolName">学校名称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="providerName">尚一</a></li>
       </ul></span></span>
            <input type="<?php echo showKeyInput($key_type);?>" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">




            <button type="submit" id="search-bn" data-url="base_statement/fund" class="sui-btn btn-large btn-primary">查询</button>



        </div>
    </form>
</div>


<div class="base_statement-list">
</div>
<?php if($page['total_page'] > 1){?>
    <div class="page"></div>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
    $(function(){
        SAYIMO.form.search("#search-bn");
    });
    var key_type = $("#key_type").val();
    var key = $("#key").val();
    var _pagedata = {};
    _pagedata.total = "<?php echo $page['total']?>";
    _pagedata.pagesize = "<?php echo $page['pagesize']?>";
    _pagedata.page = "<?php echo $pageindex;?>";
    _pagedata.url = "base_statement/ajaxfund?key_type="+key_type+"&key="+key+"&pagesize=<?php echo $page['pagesize'];?>&page=";
    _pagedata.container = '.base_statement-list';
    _pagedata.labelname = '.page';
    SAYIMO.pagination(_pagedata);

    //查找状态
    $('#search').on('click','.downlist_type li:eq(0)',function(){

        $("#key").val('');
        $("#key").attr('type','hidden');
    })
    $('#search').on('click','.downlist_type li:eq(1)',function(){

        $("#key").val('');
        $("#key").attr('type','text');
    })
    $('#search').on('click','.downlist_type li:eq(2)',function(){

        $("#key").val('');
        $("#key").attr('type','hidden');
    })

    function changeKeyValue (n) {
        $("#key").val(n);
    }
</script>
<?php
function downListCurName($key_type){
    switch ($key_type) {
        case 'schoolName':
            return '学校名称';
            break;
        case 'providerName':
            return '尚一';
            break;

        default:
            return '请选择';
            break;
    }
}
function showKeyInput($key_type){
    switch ($key_type) {
        case 'schoolName':
            return 'text';
            break;
        case 'providerName':
            return 'hidden';
            break;

        default:
            return 'hidden';
            break;
    }
}
?>