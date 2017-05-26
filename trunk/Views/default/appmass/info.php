<style>
    .sui-form.form-horizontal .control-label {
        width:110px;
    }
</style>
<ul class="sui-breadcrumb">
    <li><a>群发详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="user-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="control-group">
        <label for="inputEmail" class="control-label"> 群发对象：</label>
        <div class="controls">
           <span class="input-xlarge input-xfat"> <?php echo  $mass_type[$type];?></span>

        </div>
    </div>
    <div class="control-group">
        <label for="inputEmail" class="control-label">通知栏提示文字：</label>
        <div class="controls">
          <span class="input-xlarge input-xfat"> <?php echo  $ticker;?></span>
        </div>
    </div>
    <div class="control-group">
        <label for="inputEmail" class="control-label">通知标题：</label>
        <div class="controls">
         <span class="input-xlarge input-xfat"> <?php echo  $title;?></span>
        </div>
    </div>
    <div class="control-group">
        <label for="inputEmail" class="control-label">通知文字描述：</label>
        <div class="controls">
            <span class="input-xlarge input-xfat"> <?php echo  $text;?></span>
        </div>
    </div>


</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
