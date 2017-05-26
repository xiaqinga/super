
<?php echo assets::$sayimo;?>
<?php echo assets::$editor;?>
<ul class="sui-breadcrumb">
    <li><a>学校详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="school-address-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="control-group">
        <label for="name" class="control-label">学校编号：</label>
        <div class="controls">
            <span  class="input-xlarge input-xfat"><?php echo $schoolCode ?></span>
       </div>
    </div>
    <div class="control-group">
        <label for="name" class="control-label">学校名称：</label>
        <div class="controls">

            <span  class="input-xlarge input-xfat"><?php echo $schoolName ?></span>
        </div>
    </div>


    <div class="control-group">
        <label for="photoUrl" class="control-label v-top">学校LOGO：</label>
        <div class="controls" id="upload_logo">
            <?php if($photoUrl){?>
                <img style="width: 105px; height: 105px;" src="<?php echo $photoUrl;?>">
            <?php }?>

        </div>
    </div>

    <div class="control-group">
        <label for="photoUrl" class="control-label v-top">学校地址：</label>
        <div class="controls" id="upload_logo">

            <span  class="input-xlarge input-xfat"><?php echo $addressPrefix[$areaCode]['name'].$fullAddress ?></span>
        </div>
    </div>


    <!--选择省份城市县区 HTMl结束-->

    <div class="control-group">
        <label for="website" class="control-label v-top">学校介绍：</label>
        <div class="controls">
            <textarea id="description" name="description"   style="width: 550px;height:200px;"><?php echo $description;?></textarea>
        </div>
    </div>

</form>
<script>
    var editorA=UE.getEditor('description',
        {
            toolbars: [
                ['fullscreen']
            ],
            initialFrameWidth : 720,
            initialFrameHeight : 260,
            autoHeightEnabled : false,
            wordCount : true,
            topOffset : 110,
            maximumWords : 3000,
            wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ',
            wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});

</script>