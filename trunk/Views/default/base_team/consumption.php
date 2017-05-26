<ul class="sui-nav nav-tabs nav-xlarge">
    <li onclick="s_navclick('info');"><a>基本信息</a></li>
    <li onclick="s_navclick('Team');"><a>团队列表</a></li>
    <li class="active" onclick="s_navclick('consumption');"><a>团队消费额</a></li>
    <li onclick="s_navclick('welfare');"><a>团队公益金</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/index">返回</a></li>
</ul>
<div class="content-top">
  <form class="sui-form" id="search">
    <div class="controls">
    <input type ="hidden" id="gameId" name="gameId" value="<?php echo $gameId?>">
      <span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a id="select" role="button" href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
        <input value="<?php echo $key_type;?>" id="key_type" name="key_type" type="hidden"><i class="caret"></i><span><?php echo downListCurName($key_type);?></span></a>
        <ul role="menu" aria-labelledby="drop2" class="sui-dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="teamName">团队名称</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="expenseRank">排名</a></li>
        </ul></span></span>
      <input type="text" id="key" name="key" class="input-xlarge input-fat" value="<?php echo $key;?>">
      
      <button type="submit" id="search-bn" data-url="<?php echo APP_URL;?>base_team/consumption" class="sui-btn btn-large btn-primary">查询</button>
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
var gameId = $("#gameId").val();
var _pagedata = {};
_pagedata.total = "<?php echo $page['total']?>";
_pagedata.pagesize = "<?php echo $page['pagesize']?>";
_pagedata.page = "<?php echo $pageindex;?>";
_pagedata.url = "base_team/ajaxIndex?key_type="+key_type+"&key="+key+"&gameId="+gameId+"&pagesize=<?php echo $page['pagesize'];?>&page=";
_pagedata.container = '.base_media_class-list';
_pagedata.labelname = '.page';
SAYIMO.pagination(_pagedata);



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
  
    }
    if(url ==  'welfare'){
        $(".sui-nav.nav-tabs").eq(3).addClass('active');
         SAYIMO.go_url("<?php echo APP_URL;?>member_customer/"+url+"?gameId=<?php echo $gameId?>");
    } 
  }

</script>

<?php
function downListCurName($key_type){
  switch ($key_type) {
    case 'teamName':
      return '团队名称';
      break;
    case 'expenseRank':
      return '排名';
      break;
    default:
      return '请选择';
      break;
  }
}










