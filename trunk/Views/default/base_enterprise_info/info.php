<style type="text/css">
    .sui-dropdown.dropdown-bordered .dropdown-inner > .sui-dropdown-menu {
        overflow-y: scroll;
    }

    .sui-form.form-horizontal .control-label {
        width: 185px;
    }

    .sui-form input[type="text"], .sui-form input[type="email"], .sui-form input[type="tel"] {
        border: transparent;
        box-shadow: inset 0 0 0;
    }
</style>
<?php echo assets::$jcrop; ?>
<?php echo assets::$editor; ?>
<ul class="sui-breadcrumb">
    <li><a>企业信息详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref; ?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li class="active" onclick="s_navclick('edit');"><a>基本信息</a></li>
    <li><a href="#" onclick="s_navclick('check');">审核</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="tab1">
        <div class="control-group">
            <label for="name" class="control-label">企业名称：</label>
            <div class="controls">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <input type="hidden" name="ref" id="ref" value="<?php echo $ref; ?>">
                <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName"
                       data-rules="required" data-empty-msg="企业名称不能为空！" value="<?php echo $providerName; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="name" class="control-label">类型：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $providerTypes[$providerType]; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="name" class="control-label">店铺分类：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $unionshopClassName; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="photoId" class="control-label v-top">企业LOGO：</label>
            <div class="controls" id="upload_logo">
                <?php if ($photoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $photoUrl; ?>">
                <?php } ?>
            </div>
        </div>

        <div class="control-group">
            <label for="corporate" class="control-label v-top">法人代表：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $corporate; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="lockPhone" class="control-label v-top">法人手机：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $lockPhone; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="linkman" class="control-label v-top">负责人：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $linkman; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="linkinfo" class="control-label v-top">联系手机：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $mobilePhone; ?></span>
            </div>
        </div>


        <div class="control-group">
            <label for="email" class="control-label v-top">E-mail：</label>
            <div class="controls">

                <span class="input-xlarge input-xfat"><?php echo $email; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="telPhone" class="control-label v-top">企业固话：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $telPhone; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="fax" class="control-label v-top">传真：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $fax; ?></span>
            </div>
        </div>

        <!--选择省份城市县区 HTMl开始-->
        <div class="control-group">
            <label for="address" class="control-label v-top">地址：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $province_cur['name'] . $city_cur['name'] . $area_cur['name']; ?></span>

                <br/>

                <span class="input-xlarge input-xfat"><?php echo $address; ?></span>

            </div>
        </div>
        <!--选择省份城市县区 HTMl结束-->

        <div class="control-group">
            <label for="website" class="control-label v-top">官网：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $website; ?></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary"
                   onclick="s_navclick('check');">下一页</a>
            </div>
        </div>
    </div>
    <div class="tab2" style="display: none;">
        <div class="control-group">
            <label for="industry" class="control-label">所属行业：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $industry; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="product" class="control-label">主营产品：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $product; ?></span>
            </div>
        </div>

        <div class="control-group">
            <label for="creditCode" class="control-label">营业执照/信用代码：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $creditCode; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="crePhotoId" class="control-label v-top">上传营业执照/信用代码图片：</label>
            <div class="controls" id="upload_cre">

                <?php if ($crePhotoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $crePhotoUrl; ?>">
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="taxCode" class="control-label">税务登记证号：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $taxCode; ?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="taxPhotoId" class="control-label v-top">上传税务登记证号图片：</label>
            <div class="controls" id="upload_tax">
                <?php if ($taxPhotoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $taxPhotoUrl; ?>">
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="description" class="control-label">企业简介：</label>
            <div class="controls">
                <div id="description" name="description"
                     style="width: 550px;height:200px;"><?php echo $description; ?></div>
            </div>
        </div>

        <div class="control-group followRadio">
            <label for="status" class="control-label"><span class="required">*</span>状态：</label>
            <div class="controls">
                <?php if ($status == 1): ?>
                    <label class="radio-pretty inline <?php if (strrpos($status, '1') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '1') > -1) {
                            echo 'checked="checked"';
                        } ?> value="1" name="status_radio"><span>待审核</span>
                    </label>
                <?php elseif ($status == 2): ?>
                    <label class="radio-pretty inline <?php if (strrpos($status, '2') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '2') > -1) {
                            echo 'checked="checked"';
                        } ?> value="2" name="status_radio"><span>已审核</span>
                    </label>
                <?php elseif ($status == 3): ?>
                    <label class="radio-pretty inline <?php if (strrpos($status, '3') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '3') > -1) {
                            echo 'checked="checked"';
                        } ?> value="3" name="status_radio"><span>已驳回</span>
                    </label>
                <?php elseif ($status == 4): ?>
                    <label class="radio-pretty inline <?php if (strrpos($status, '4') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '4') > -1) {
                            echo 'checked="checked"';
                        } ?> value="3" name="status_radio"><span>已下架</span>
                    </label>
                <?php endif; ?>
                <input type="hidden" name="status" data-rules="required" id="status" value="<?php echo $status; ?>">
            </div>
        </div>
        <?php if ($status == 1 || $status == 3): ?>
            <div class="control-group">
                <label for="reject" class="control-label">驳回原因：</label>
                <div class="controls">
                    <textarea id="reject" name="reject"
                              style="width: 550px;height:100px;"><?php echo $reject; ?></textarea>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($status == 2): ?>
            <div class="control-group">
                <label for="inputDes" class="control-label v-top">模板配置地址：</label>
                <div class="controls">
                    <span class="input-xlarge input-xfat"><?php echo 'view/unionShop/sellerDetail.html?unionId=' . $id ?></span>
                </div>
            </div>
        <?php endif?>

    </div>
</form>

<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">

    $("input:text").each(function () {
        $(this).attr("disabled", 'disabled');
    })

    //隐藏status跟踪单选项
    $("#provider-form").on('click', ".followRadio", function () {
        setTimeout(function () {
            var status;
            $("label input:radio:checked").each(function (i, v) {
                status = $(v).val();
                $("input[name='status']").val(status);
            });
        }, 300);
    })

    //选项卡
    function s_navclick(tab) {
        if (tab == 'check') {
            $(".sui-nav.nav-tabs li").eq(0).removeClass('active');
            $(".sui-nav.nav-tabs li").eq(1).addClass('active');
            $(".tab1").hide();
            $(".tab2").show();
        } else if (tab == 'edit') {
            $(".sui-nav.nav-tabs li").eq(0).addClass('active');
            $(".sui-nav.nav-tabs li").eq(1).removeClass('active')
            $(".tab1").show();
            $(".tab2").hide();
        }
    }


</script>

