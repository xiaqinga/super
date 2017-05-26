<style type="text/css">
  .show_item{line-height: 25px;}
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<ul class="sui-breadcrumb">
    <li><a>团购详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>

<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="name" class="control-label">活动名称:</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['name']?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">商品类型：</label>
    <div class="controls">
      <span class="input-xlarge input-xfat"><?php if($attr['goodsType'] == '1'){echo "普通商品";}else if( $attr['goodsType'] == '0' ){echo "预约商品";};?></span>
    </div>
  </div>
  <div class="control-group">
  
    <label for="inputDes" class="control-label v-top">活动头像：</label>
    <div class="controls">
      <img src="<?php echo $attr['photoUrl'];?>" alt="">
    </div>
  </div>
  <div class="control-group">
      <label for="address" class="control-label v-top">供应商：</label>
      <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['providerName'];?></span>
      </div>
    </div>
  <div class="control-group">
      <label for="address" class="control-label v-top">商品图片：</label>
      <div class="controls">
      <img src="<?php echo $attr['photoPath'];?>" alt="">
    </div>
    </div>
  <div class="control-group">
      <label for="address" class="control-label v-top">商品价格：</label>
      <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['preferentialPrice'];?>&nbsp;&nbsp;元</span>
      </div>
    </div>
  <div class="control-group">
      <label for="address" class="control-label v-top">商品库存：</label>
      <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $attr['fNum'];?>&nbsp;&nbsp;个/件</span>
      </div>
    </div>
 <div class="control-group">
    <label for="inputDes" class="control-label v-top">团购价：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php echo $attr['price'];?>&nbsp;&nbsp;元</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">团购库存：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php echo $attr['stockNum'];?>&nbsp;&nbsp;个/件</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">团购数量：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php echo $attr['number'];?>&nbsp;&nbsp;人/次</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">活动时间：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php echo $attr['startDate'].'至'.$attr['endDate'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">限购次数：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php if ($attr['maxBuy'] == '0'){echo '不限购';}else{echo $attr['maxBuy'].'&nbsp;&nbsp;人/件';}?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">活动描述：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php echo $attr['description'];?></span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputDes" class="control-label v-top">状态：</label>
    <div class="controls">
    <span class="input-xlarge input-xfat"><?php if($attr['status'] == '1'){echo '正常';}else{echo '禁用';}?></span>
    </div>
  </div>
  
</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$base64; ?>
