<style>
.controls{vertical-align: middle;padding-left: 10px}
</style>
<ul class="sui-breadcrumb">
    <li><a>转让详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
    <form id="base_adposition-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">


        <div class="control-group">
            <label for="title" class="control-label">名称:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo  $goodsName?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="title" class="control-label">会员昵称:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo  $alias?></span>
            </div>
        </div>
       
        <div class="control-group">
            <label for="title" class="control-label">所属分类:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo  $className?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="title" class="control-label">新旧率:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $depreciation?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="title" class="control-label">联系人:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $linkMan?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="title" class="control-label">联系电话:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $linkInfo?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="title" class="control-label">转让金额:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $price?></span>
            </div>
        </div>




        <div class="control-group">
            <label for="inputDes" class="control-label v-top">宣传图：</label>
            <div class="controls">
                <input type="hidden" class="input-xlarge input-xfat" id="photoUrl" name="photoUrl" value="<?php echo $attr['photoUrl']?$attr['photoUrl']:0;?>">
                <div id="upload_photo">

                        <img width="130" src="<?php echo $photoUrl ?>"/><br/>

                </div>
                <!--<a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传图片</a>
                <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;320*320px</span>-->

            </div>
        </div>


        <div class="control-group">
            <label for="title" class="control-label">区域:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $provinceCurList.$cityCurList?></span>
            </div>
        </div>


        <div class="control-group">
            <label for="title" class="control-label">有效期:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $expiration?></span>
            </div>
        </div>

        <div class="control-group">
            <label for="title" class="control-label">详情:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo   $description?></span>
            </div>
        </div>

    </form>
</div>

<?php echo assets::$sayimo; ?>
<?php echo assets::$jcrop;?>

