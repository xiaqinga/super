<ul class="sui-nav nav-tabs nav-xlarge">
    <li onclick="s_navclick('info');"><a>基本信息</a></li>
    <li onclick="s_navclick('Team');"><a>团队列表</a></li>
    <li onclick="s_navclick('consumption');"><a>团队消费额</a></li>
    <li class="active" onclick="s_navclick('welfare');"><a>团队公益金</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/index">返回</a></li>
</ul>
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
    <input type ="hidden" id="gameId" name="gameId" value="<?php echo $gameId?>">
      <span class="sui-dropdown dropdown-bordered select downlist_type"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="alias">会员昵称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="Date">日期</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="fundationRank">基金排名</a></li>
        </ul></span></span>
      <input type="text" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
 <span class="sui-dropdown dropdown-bordered select downlist_class" style="display: none;"><span class="dropdown-inner">
        
      <input data-toggle="datepicker" value="<?php echo $startDate;?>" id="startDate" name="startDate" data-rules="required" type="text">  ---
      <input data-toggle="datepicker" value="<?php echo $endDate;?>" id="endDate" name="endDate" data-rules="required" type="text">
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
        </ul></span></span>
      
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>member_customer/welfare" class="sui-btn btn-large btn-primary">查询</button>
    </div>
  </form>
</div>
<div class="base_media_class-list">
</div>
<?php if($page['total_page'] > 1){?>
  <div class="page"></div>
<?php }?>

<script type="text/javascript">
$(function(){
  SAYIMO.form.search("#search-bn");
});
var key_type = $("#key_type").val();
var key = $("#key").val();
var startDate = $("#startDate").val();
var endDate = $("#endDate").val();
var gameId = $("#gameId").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "member_customer/ajaxIndex?key_type="+key_type+"&key="+key+"&gameId="+gameId+"&startDate="+startDate+"&endDate="+endDate+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_media_class-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);


  $('#search').on('click','.downlist_type li:eq(0)',function(){
    $("#key").attr('type','text');
    $(".downlist_class").hide();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(1)',function(){
    $("#key").attr('type','hidden');
    $(".downlist_class").show();
    $("#key").val('');
  })
  $('#search').on('click','.downlist_type li:eq(2)',function(){
    $("#key").attr('type','text');
    $(".downlist_class").hide();
    $("#key").val('');
  })
  function changeKeyValue (n) {
    $("#key").val(n);
  }

function s_navclick(url)
  { 
    $(".sui-nav.nav-tabs").removeClass('active');
    if(url=='info'){
        $(".sui-nav.nav-tabs").eq(0).addClass('active');
        SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/"+url+"?id=<?php echo $gameId?>");
    }
    if(url == 'Team'){
        $(".sui-nav.nav-tabs").eq(1).addClass('active');
      SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game_detail/"+url+"?gameId=<?php echo $gameId?>");
    }
    if(url == 'consumption'){
        $(".sui-nav.nav-tabs").eq(2).addClass('active');
       SAYIMO.go_url("<?php echo APP_URL;?>base_team/"+url+"?gameId=<?php echo $gameId?>");
    }
    if(url ==  'welfare'){
        $(".sui-nav.nav-tabs").eq(3).addClass('active');
    }
    
  }

</script>

<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'alias':
      return '会员昵称';
      break;
    case 'startDate':
      return '日期';
      break;
    case 'fundationRank':
      return '基金排名';
      break;
    default:
      return '请选择';
      break;
  }
}










