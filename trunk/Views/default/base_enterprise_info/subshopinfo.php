<style type="text/css">
  .sui-dropdown.dropdown-bordered .dropdown-inner>.sui-dropdown-menu {
    overflow-y: scroll;
  }
  .sui-form.form-horizontal .control-label {
      width: 185px;
  }
  .sui-form input[type="text"],.sui-form input[type="email"],.sui-form input[type="tel"]{
        border:transparent;
        box-shadow:inset 0 0 0;
  }
</style>
<?php echo assets::$jcrop;?>
<?php echo assets::$editor;?>
<ul class="sui-breadcrumb">
    <li><a>子店信息详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="tab1">
    <div class="control-group">
      <label for="name" class="control-label">子店名称：</label>
      <div class="controls">
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
        <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName" data-rules="required" data-empty-msg="企业名称不能为空！"  value="<?php echo $providerName;?>">
      </div>
    </div>
    <div class="control-group">
      <label for="name" class="control-label">类型：</label>
      <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $providerTypes[$providerType];?></span>
      </div>
    </div>
    <div class="control-group">
      <label for="name" class="control-label">店铺分类：</label>
      <div class="controls">
      <span class="input-xlarge input-xfat"><?php echo $shopClasss[$unionshopClassId];?></span>
      </div>
    </div>
    <!-- <div class="control-group">
      <label for="photoId" class="control-label v-top">企业LOGO：</label>
      <div class="controls" id="upload_logo">
        <?php if($photoUrl){?>
        <img style="width: 105px; height: 105px;" src="<?php echo $photoUrl;?>">
        <?php }?>
      </div>
    </div> -->
   
    <div class="control-group">
      <label for="corporate" class="control-label v-top">法人代表：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $corporate;?></span>
    </div>
    </div>
    <div class="control-group">
      <label for="lockPhone" class="control-label v-top">法人手机：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $lockPhone;?></span>
     </div>
    </div>
    <div class="control-group">
      <label for="linkman" class="control-label v-top">负责人：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $linkman;?></span>
     </div>
    </div>
    <div class="control-group">
      <label for="linkinfo" class="control-label v-top">联系手机：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $mobilePhone;?></span>
    </div>
    </div>


    <div class="control-group">
      <label for="email" class="control-label v-top">E-mail：</label>
      <div class="controls">

        <span class="input-xlarge input-xfat"><?php echo $email;?></span>
      </div>
    </div>
    <div class="control-group">
      <label for="telPhone" class="control-label v-top">企业固话：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $telPhone;?></span>
   </div>
    </div>
    <div class="control-group">
      <label for="fax" class="control-label v-top">传真：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $fax;?></span>
    </div>
    </div>

    <!--选择省份城市县区 HTMl开始-->
    <div class="control-group">
      <label for="address" class="control-label v-top">地址：</label>
      <div class="controls">
        <span class="input-xlarge input-xfat"><?php echo $province_cur['name'].$city_cur['name'].$area_cur['name'];?></span>

        <br/>

        <span class="input-xlarge input-xfat"><?php echo $address;?></span>

      </div>
    </div>
    <!--选择省份城市县区 HTMl结束-->

  </div>

  </div>
</form>

<?php echo assets::$sayimo; ?>
