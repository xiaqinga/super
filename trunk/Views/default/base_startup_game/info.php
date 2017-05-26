<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li class="active" onclick="s_navclick('info');"><a>基本信息</a></li>
    <?php if($attr['identifier'] == 'XYGQBS'){?>
    <li onclick="s_navclick('teamlist');"><a>团队列表</a></li>
    <?php }else{?>
    <li onclick="s_navclick('Team');"><a>团队列表</a></li>
    <li onclick="s_navclick('consumption');"><a>团队消费额</a></li>
    <li onclick="s_navclick('welfare');"><a>团队公益金</a></li>
    <?php }?>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo APP_URL;?>base_startup_game/index">返回</a></li>
</ul>

<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="activityName" class="control-label"><span class="required">*</span>大赛名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="activityName" name="activityName" value="<?php echo $attr['activityName']?>">
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">大赛标识符：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" value="<?php echo $attr['identifier'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">标题缩略图：</label>
    <div class="controls">
      <img src="<?php echo $attr['photoUrl'];?>">
      <!-- <input type="text" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl'];?>"> -->
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">团队人数：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="teamMaxCount" name="teamMaxCount" value="<?php echo $attr['teamMaxCount'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>规则简述：</label>
    <div class="controls">
      <textarea id="brief" class="input-xlarge" name="brief" data-rules="required" data-empty-msg="技能不能为空!"><?php echo $attr['brief'];?></textarea>
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>报名时间：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['applyStartDate']?>" id="applyStartDate" data-rules="required" name="applyStartDate" type="text"> ---
    <input data-toggle="datepicker" value="<?php echo $attr['applyEndDate']?>" id="applyEndDate" data-rules="required" name="applyEndDate" type="text">
    </div>
  </div>
  <div class="control-group">
   <label for="inputDes" class="control-label v-top"><span class="required">*</span>有效期：</label>
    <div class="controls">
    <input data-toggle="datepicker" value="<?php echo $attr['startDate']?>" id="startDate" data-rules="required" name="startDate" type="text"> ---
    <input data-toggle="datepicker" value="<?php echo $attr['endDate']?>" id="endDate" data-rules="required" name="endDate" type="text">
    </div>
  </div>
  <div class="control-group edit_content">
    <label for="inputDes" class="control-label v-top"><span class="required">*</span>详细内容：</label>
    <div class="controls">
      <textarea name="description" data-rules="required" id="description" style="width: 550px;height:200px;" placeholder="从这里开始写正文"><?php echo $attr['description'];?></textarea>
    </div>
  </div>
   <div class="control-group">
    <label for="inputDes" class="control-label v-top">排序：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="sort" name="sort" value="<?php echo $attr['sort'];?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">状态：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="status" name="status" value="<?php if($attr['status'] == 1){echo "启用";}else{echo"禁用";}?>">
    </div>
  </div>


</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
<script language="javascript" type="text/javascript">

function s_navclick(url)
  { 
    $(".sui-nav.nav-tabs").removeClass('active');
    if(url=='info'){
        $(".sui-nav.nav-tabs").eq(0).addClass('active');  

    }
    if(url == 'Team'){
        $(".sui-nav.nav-tabs").eq(1).addClass('active');
         SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game_detail/"+url+"?gameId=<?php echo $attr['id']?>");
    }
    if(url == 'consumption'){
        $(".sui-nav.nav-tabs").eq(2).addClass('active');
         SAYIMO.go_url("<?php echo APP_URL;?>base_team/"+url+"?gameId=<?php echo $attr['id']?>");
    }
    if(url ==  'welfare'){
        $(".sui-nav.nav-tabs").eq(3).addClass('active');
         SAYIMO.go_url("<?php echo APP_URL;?>member_customer/"+url+"?gameId=<?php echo $attr['id']?>");
    }

    if(url == 'teamlist'){
        $(".sui-nav.nav-tabs").eq(1).addClass('active');
         SAYIMO.go_url("<?php echo APP_URL;?>base_startup_game/"+url+"?gameId=<?php echo $attr['id']?>");
    }
  
  }



$("input:text").each(function(){
  $(this).attr("disabled",'disabled');
})


</script>
