<style type="text/css">
  .sui-dropdown.dropdown-bordered .dropdown-inner>.sui-dropdown-menu {
    overflow-y: scroll;
  }
  .sui-form.form-horizontal .control-label {
      width: 185px;
  }
</style>
<style type="text/css">
  .formTable {
    padding: 10px 30px;
    font-size: 12px;
    border: 0px solid #ccc;
    margin-top: 10px;
  }
  .iconSpan {
      float: left;
      font-size: 14px;
      color: #636363;
      text-decoration: none;
      background-color: #fff;
      padding: 8px;
      font-weight: bold;
  }
  .goodsListClass tr td {
      border-bottom: 1px solid #DDDDDD;
  }
</style>
<?php echo assets::$jcrop;?>
<?php echo assets::$editor;?>
<?php echo assets::$shop;?>
<!-- <ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'企业信息详情':'添加企业';?></a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul> -->
<ul class="sui-nav nav-tabs nav-xlarge">
  <li class="active" onclick="s_navclick('edit');"><a>金星创客</a></li>
  <li><a href="#" onclick="s_navclick('check');">银星创客</a></li>
  <li><a href="#" onclick="s_navclick('check_all');">公共配置</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="tab1">
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">申请成为金星创客</span>
      </div>
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      <input type="text" name="sysValue" data_id="<?php echo $attr['GOLD_UPGRADE_SLIVER_SCORE']['GOLD_UPGRADE_SLIVER_SCORE'];?>" value="<?php echo $attr['GOLD_UPGRADE_SLIVER_SCORE']['sysKey'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展创客赠送</span>
      </div>
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" name="sysValue" data_id="<?php echo $attr['GOLD_MAKER_CASH']['GOLD_MAKER_CASH'];?>" value="<?php echo $attr['GOLD_MAKER_CASH']['sysKey'];?>">&nbsp;&nbsp;&nbsp;元/个
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      <input type="text" name="sysValue" data_id="<?php echo $attr['GOLD_MAKER_SLIVER_SCORE']['GOLD_MAKER_SLIVER_SCORE'];?>" value="<?php echo $attr['GOLD_MAKER_SLIVER_SCORE']['sysKey'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展联盟商赠送</span>
      </div>
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">现金奖励模式：</h5></span>
    <div style="padding-left: 50px;"> 
      <input type="text" value="<?php echo $attr['GOLD_UNION_MIN_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_MIN_CASH']['GOLD_UNION_MIN_CASH'];?>">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $attr['GOLD_UNION_MAX_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_MAX_CASH']['GOLD_UNION_MAX_CASH'];?>">&nbsp;&nbsp;&nbsp;元
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_SLIVER_SCORE']['GOLD_UNION_COMMISSION_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">提成奖励模式：</h5></span>
    <div style="padding-left: 50px;"> 
      商品折扣 <= <input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_LT']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_LT']['GOLD_UNION_COMMISSION_LT'];?>">&nbsp;&nbsp;%&nbsp;&nbsp; = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_SALES']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_SALES']['GOLD_UNION_COMMISSION_SALES'];?>">&nbsp;&nbsp;%（销售额提成）
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      商品折扣 > <input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_GT']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_GT']['GOLD_UNION_COMMISSION_GT'];?>">&nbsp;&nbsp;%&nbsp;&nbsp; = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_EQUALLY']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_EQUALLY']['GOLD_UNION_COMMISSION_EQUALLY'];?>">&nbsp;&nbsp;%（销售额提成,且多出的收入五五分成）
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['GOLD_UNION_COMMISSION_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_UNION_COMMISSION_SCORE']['GOLD_UNION_COMMISSION_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展供应商赠送</span>
      </div>
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">现金奖励模式：</h5></span>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['GOLD_PROVIDER_MIN_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_PROVIDER_MIN_CASH']['GOLD_PROVIDER_MIN_CASH'];?>">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $attr['GOLD_PROVIDER_MAX_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_PROVIDER_MAX_CASH']['GOLD_PROVIDER_MAX_CASH'];?>">&nbsp;&nbsp;&nbsp;元
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['GOLD_PROVIDER_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_PROVIDER_SLIVER_SCORE']['GOLD_PROVIDER_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">提成奖励模式：</h5></span>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      上级会员商品销售提成 = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['GOLD_PROVIDER_COMMISSION_SALES']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_PROVIDER_COMMISSION_SALES']['GOLD_PROVIDER_COMMISSION_SALES'];?>">&nbsp;&nbsp;&nbsp;%（销售额）
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['GOLD_PROVIDER_COMMISSION_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['GOLD_PROVIDER_COMMISSION_SLIVER_SCORE']['GOLD_PROVIDER_COMMISSION_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <br/>
    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary" onclick="s_navclick('check');">下一步</a>
      </div>
    </div>
  </div>
  <div class="tab2" style="display: none;">
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">申请成为银星创客</span>
      </div>
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      <input type="text" name="sysValue" data_id="<?php echo $attr['SILVER_UPGRADE_SLIVER_SCORE']['SILVER_UPGRADE_SLIVER_SCORE'];?>" value="<?php echo $attr['SILVER_UPGRADE_SLIVER_SCORE']['sysKey'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展创客赠送</span>
      </div>
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_MAKER_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_MAKER_CASH']['SILVER_MAKER_CASH'];?>">&nbsp;&nbsp;&nbsp;元/个
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_MAKER_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_MAKER_SLIVER_SCORE']['SILVER_MAKER_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展联盟商赠送</span>
      </div>
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">现金奖励模式：</h5></span>
    <div style="padding-left: 50px;"> 
      <input type="text" value="<?php echo $attr['SILVER_UNION_MIN_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_MIN_CASH']['SILVER_UNION_MIN_CASH'];?>">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_UNION_MAX_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_MAX_CASH']['SILVER_UNION_MAX_CASH'];?>">&nbsp;&nbsp;&nbsp;元
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_COMMISSION_SCORE']['SILVER_UNION_COMMISSION_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">提成奖励模式：</h5></span>
    <div style="padding-left: 50px;"> 
      商品折扣 <= <input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_LT']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_COMMISSION_LT']['SILVER_UNION_COMMISSION_LT'];?>">&nbsp;&nbsp;%&nbsp;&nbsp; = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_SALES']['sysKey'];?>" name="sysValue"  data_id="<?php echo $attr['SILVER_UNION_COMMISSION_SALES']['SILVER_UNION_COMMISSION_SALES'];?>">&nbsp;&nbsp;%（销售额提成）
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      商品折扣 > <input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_GT']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_COMMISSION_GT']['SILVER_UNION_COMMISSION_GT'];?>">&nbsp;&nbsp;%&nbsp;&nbsp; = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_EQUALLY']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_COMMISSION_EQUALLY']['SILVER_UNION_COMMISSION_EQUALLY'];?>">&nbsp;&nbsp;%（销售额提成,且多出的收入五五分成）
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_UNION_COMMISSION_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_UNION_COMMISSION_SCORE']['SILVER_UNION_COMMISSION_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <div class="market_dt5">
      <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
        <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">发展供应商赠送</span>
      </div>
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">现金奖励模式：</h5></span>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_PROVIDER_MIN_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_MIN_CASH']['SILVER_PROVIDER_MIN_CASH'];?>">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_PROVIDER_MAX_CASH']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_MAX_CASH']['SILVER_PROVIDER_MAX_CASH'];?>">&nbsp;&nbsp;&nbsp;元
    </div>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_PROVIDER_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_SLIVER_SCORE']['SILVER_PROVIDER_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <span><h5 style="padding-left: 30px;padding-top: -20px;">提成奖励模式：</h5></span>
    <div style="padding-left: 50px;padding-top: 10px;"> 
      上级会员商品销售提成 = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SALES']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SALES']['SILVER_PROVIDER_COMMISSION_SALES'];?>">&nbsp;&nbsp;&nbsp;%（销售额）
    </div>
    <!-- <div style="padding-left: 50px;padding-top: 10px;"> 
      商品倍率 > <input type="text" value="<?php echo $attr['SILVER_PROVIDER_COMMISSION_GT']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_COMMISSION_GT']['SILVER_PROVIDER_COMMISSION_GT'];?>">&nbsp;&nbsp;倍&nbsp;&nbsp; = &nbsp;&nbsp;<input type="text" value="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SALES_MOVE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SALES_MOVE']['SILVER_PROVIDER_COMMISSION_SALES_MOVE'];?>">&nbsp;&nbsp;&nbsp;%（销售额提成,且多出的收入五五分成）
    </div> -->
    
    <div style="padding-left: 50px;padding-top: 10px;"> 
      <input type="text" value="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SLIVER_SCORE']['sysKey'];?>" name="sysValue" data_id="<?php echo $attr['SILVER_PROVIDER_COMMISSION_SLIVER_SCORE']['SILVER_PROVIDER_COMMISSION_SLIVER_SCORE'];?>">&nbsp;&nbsp;&nbsp;银积分
    </div>
    <br/>
    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary" onclick="s_navclick('edit');">上一步</a>
        <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary" onclick="s_navclick('check_all');">下一步</a>
      </div>
    </div>
  </div>
  <div class="tab3" style="display: none;">
    <div style="padding-left: 50px;padding-top: 10px;">
      会员在联盟商消费赠送积分：<input type="text" name="sysValue" data_id="<?php echo $attr['UNION_CONSUMER_SCORE']['UNION_CONSUMER_SCORE'];?>" value="<?php echo $attr['UNION_CONSUMER_SCORE']['sysKey'];?>">&nbsp;&nbsp;&nbsp;%
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      会员发展下线赠送积分：<input type="text" name="sysValue" data_id="<?php echo $attr['MEMBER_DEVELOP_DOWN']['MEMBER_DEVELOP_DOWN'];?>" value="<?php echo $attr['MEMBER_DEVELOP_DOWN']['sysKey'];?>">&nbsp;&nbsp;&nbsp;积分
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      学校基金比例：<input type="text" name="sysValue" data_id="<?php echo $attr['FUND_SCHOOL_PERCENT']['FUND_SCHOOL_PERCENT'];?>" value="<?php echo $attr['FUND_SCHOOL_PERCENT']['sysKey'];?>">&nbsp;&nbsp;&nbsp;%
    </div>
    <div style="padding-left: 50px;padding-top: 10px;">
      尚一基金比例：<input type="text" name="sysValue" data_id="<?php echo $attr['FUND_SAYIMO_PERCENT']['FUND_SAYIMO_PERCENT'];?>" value="<?php echo $attr['FUND_SAYIMO_PERCENT']['sysKey'];?>">&nbsp;&nbsp;&nbsp;%
    </div>
      <input type="hidden" name="data_config" id="data_config" value=""> 
      <div class="control-group" style="padding-left: 50px;padding-top: 10px;">
        <label class="control-label"></label>
        <div class="controls">
          <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
        </div>
      </div>
  </div>
</form>

<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>

<script language="javascript" type="text/javascript">



$(function(){
  var submitBefore = function(){
    var listtime = $('input[name="sysValue"]');
    // control.log(listtime);
    var sysValue=new Array;
    listtime.each(function(){
        var newItem = {};
        newItem.status = $(this).attr('data_id');
        newItem.time = $(this).val();
        sysValue.push(newItem) ;//添加新对象
    });
    $('#data_config').val(JSON.stringify(sysValue));
    return true;
  }

  
  var _opts = {};
  _opts.url = OO._SRVPATH + 'base_config/save';  
  _opts.failFun = function(){
    errors = document.querySelectorAll("#provider-form .input-error")
    for (var i = errors.length - 1; i >= 0; i--) {
      $(errors[i]).trigger('focus');
      var arr=["providerName","corporate","lockPhone","address"]; 
      if(arr.toString().indexOf(errors[i].id)>-1){
        $(".sui-nav.nav-tabs li").eq(0).addClass('active');
        $(".sui-nav.nav-tabs li").eq(1).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(2).removeClass('active');
        $(".tab1").show();
        $(".tab2").hide();
        $(".tab3").hide();
      }
    }
  }

  SAYIMO.form.init('#provider-form', _opts, submitBefore);


});


//选项卡
function s_navclick(tab)
{
    if(tab=='check'){
        $(".sui-nav.nav-tabs li").eq(0).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(1).addClass('active');
        $(".sui-nav.nav-tabs li").eq(2).removeClass('active');
        $(".tab1").hide();
        $(".tab2").show();
        $(".tab3").hide();
    }else if(tab=='edit'){
        $(".sui-nav.nav-tabs li").eq(0).addClass('active');
        $(".sui-nav.nav-tabs li").eq(1).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(2).removeClass('active');
        $(".tab1").show();
        $(".tab2").hide();
        $(".tab3").hide();
    }else if(tab=='check_all'){
        $(".sui-nav.nav-tabs li").eq(0).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(1).removeClass('active');
        $(".sui-nav.nav-tabs li").eq(2).addClass('active');
        $(".tab1").hide();
        $(".tab2").hide();
        $(".tab3").show();
    }

}
</script>