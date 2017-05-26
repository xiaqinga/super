<style type="text/css">
    .sui-dropdown.dropdown-bordered .dropdown-inner > .sui-dropdown-menu {
        overflow-y: scroll;
    }

    .sui-form.form-horizontal .control-label {
        width: 185px;
    }
</style>
<?php echo assets::$jcrop; ?>
<?php echo assets::$editor; ?>
<?php echo assets::$shop; ?>
<ul class="sui-breadcrumb">
    <li><a><?php echo ($id) ? '企业信息详情' : '添加企业'; ?></a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref; ?>">返回</a></li>
</ul>
<ul class="sui-nav nav-tabs nav-xlarge">
    <li class="active" onclick="s_navclick('edit');"><a>基本信息</a></li>
    <li><a href="#" onclick="s_navclick('check');">审核</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="tab1">
        <div class="control-group">
            <label for="name" class="control-label"><span class="required">*</span>企业编号：</label>
            <div class="controls">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <input type="hidden" name="ref" id="ref" value="<?php echo $ref; ?>">
                <input type="text" class="input-xlarge input-xfat" id="providerCode" name="providerCode"
                       data-empty-msg="企业编号不能为空！" value="<?php echo $providerCode; ?>" readonly>
            </div>
        </div>
        <div class="control-group">
            <label for="name" class="control-label"><span class="required">*</span>企业名称：</label>
            <div class="controls">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <input type="hidden" name="ref" id="ref" value="<?php echo $ref; ?>">
                <input type="text" class="input-xlarge input-xfat" id="providerName" name="providerName"
                       data-rules="required" data-empty-msg="企业名称不能为空！" value="<?php echo $providerName; ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="inputDes" class="control-label v-top"><span class="required">*</span>类型:</label>
            <div class="controls">
                <select name="providerType" class="providerType">
                    <?php foreach ($providerTypes as $key => $val): ?>
                        <option value="<?php echo $key ?>" <?php echo $key == $providerType ? 'selected' : '' ?> ><?php echo $val ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
        <div class="control-group">
            <label for="inputDes" class="control-label v-top">店铺分类:</label>
            <div class="controls">
                <select name="unionshopClassId" class="unionshopClassId">
                    <?php foreach ($shopClasss as $key => $val): ?>
                        <option value="<?php echo $key ?>" <?php echo $key == $unionshopClassId ? 'selected' : '' ?> ><?php echo $val ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>


        <div class="control-group">
            <label for="photoUrl" class="control-label v-top">企业LOGO：</label>
            <div class="controls" id="upload_logo">
                <?php if ($photoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $photoUrl; ?>">
                <?php } ?>
                <a href="javascript:void(0);" id="upload_btn" class="sui-btn btn-xlarge btn-primary">上传LOGO</a>
                <input type="hidden" name="photoUrl" id="photoUrl" value="<?php echo $photoUrl; ?>"/>
                <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;180*180px</span>
            </div>
        </div>
        <div class="control-group">
            <label for="photoId" class="control-label v-top">企业形像照片：</label>
            <div class="controls">
                <div class="photo_wraper photo_main">
                    <?php foreach ($main_photos as $key => $value) : ?>
                        <div class="photo_item Js_item">
                            <img class="photo_img Js_img" id="iconImg" src="<?php echo $value['photoPath']; ?>"
                                 alt="标题缩略图" style="width:130px;">
                            <div class="photo_del Js_delphoto" photoId="<?php echo $value['id']; ?>"
                                 index="<?php echo $key; ?>"><i class="sui-icon icon-tb-delete"></i></div>
                            <div class="photo_mvleft Js_move_left"><i class="sui-icon icon-pc-chevron-left"></i></div>
                            <div class="photo_mvright Js_move_right"><i class="sui-icon icon-pc-chevron-right"></i>
                            </div>
                            <div class="photo_bg"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" id="photos" name="photos" value="">
                <input type="hidden" id="listphote" name="listphote" value="<?php echo json_encode($main_photos); ?>">
                <a style="margin-top: 5px;" href="javascript:void(0);" id="upload_main"
                   class="sui-btn btn-xlarge btn-primary">上传商品轮播图</a>
                <span style="color:#ff9900;">&nbsp;&nbsp;图片尺寸&nbsp;&nbsp;640*480px</span>
            </div>
        </div>

        <div class="control-group">
            <label for="corporate" class="control-label v-top"><span class="required">*</span>法人代表：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="corporate" name="corporate" data-rules="required"
                       data-empty-msg="法人代表不能为空！" value="<?php echo $corporate; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="lockPhone" class="control-label v-top"><span class="required">*</span>法人手机：</label>
            <div class="controls">
                <input type="tel" class="input-xlarge input-xfat" id="lockPhone" name="lockPhone"
                       data-rules="required|mobile" data-empty-msg="法人手机不能为空！" value="<?php echo $lockPhone; ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="saleman" class="control-label v-top">负责人：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="linkman" name="linkman"
                       value="<?php echo $linkman; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="saleman" class="control-label v-top">联系手机：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="mobilePhone" name="mobilePhone"
                       data-rules="mobile" value="<?php echo $mobilePhone; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="email" class="control-label v-top">E-mail：</label>
            <div class="controls">
                <input type="email" class="input-xlarge input-xfat" id="email" name="email"
                       value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="telPhone" class="control-label v-top">企业固话：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="telPhone" name="telPhone" data-rules="tel"
                       value="<?php echo $telPhone; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="fax" class="control-label v-top">传真：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="fax" name="fax" value="<?php echo $fax; ?>">
            </div>
        </div>

        <!--选择省份城市县区 HTMl开始-->
        <div class="control-group">
            <label for="address" class="control-label v-top"><span class="required">*</span>地址：</label>
            <div class="controls">

        <span class="sui-dropdown dropdown-bordered select province">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $provinceCode; ?>" name="provinceCode" type="hidden">
              <i class="caret"></i>
              <span id="province_Name"><?php echo $province_cur['name'] ? $province_cur['name'] : '省份'; ?></span></a>
              <input value="" id="provinceName" name="provinceName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($provinceList as $key => $value):
                  $k = $key + 1;
                  ?>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                             value="<?php echo $value['code']; ?>"><?php echo $value['name']; ?></a></li>
              <?php if ($k % 3 == 0): ?>
                  <li role="presentation" class="divider"></li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </span>
        </span>

                <span class="sui-dropdown dropdown-bordered select city">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $cityCode; ?>" name="cityCode" type="hidden">
              <i class="caret"></i>
              <span id="city_Name"><?php echo $city_cur['name'] ? $city_cur['name'] : '城市'; ?></span></a>
              <input value="" id="cityName" name="cityName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($cityList as $key => $value):
                  $k = $key + 1;
                  ?>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                             value="<?php echo $value['code']; ?>"><?php echo $value['name']; ?></a></li>
              <?php if ($k % 3 == 0): ?>
                  <li role="presentation" class="divider"></li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </span>
        </span>

                <span class="sui-dropdown dropdown-bordered select area">
          <span class="dropdown-inner">
            <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
              <input value="<?php echo $areaCode; ?>" name="areaCode" type="hidden">
              <i class="caret"></i>
              <span id="area_Name"><?php echo $area_cur['name'] ? $area_cur['name'] : '城市'; ?></span></a>
              <input value="" id="areaName" name="areaName" type="hidden">
            <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
              <?php foreach ($areaList as $key => $value):
                  $k = $key + 1;
                  ?>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                             value="<?php echo $value['code']; ?>"><?php echo $value['name']; ?></a></li>
              <?php if ($k % 3 == 0): ?>
                  <li role="presentation" class="divider"></li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </span>
        </span>
                <br/>
                <input data-rules="required" data-empty-msg="地址不能为空！" style="margin-top: 5px;" type="text"
                       class="input-xlarge input-xfat" id="address" name="address" value="<?php echo $address; ?>">

            </div>
        </div>
        <!--选择省份城市县区 HTMl结束-->

        <div class="control-group">
            <label for="website" class="control-label v-top">官网：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="website" name="website"
                       value="<?php echo $website; ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary"
                   onclick="s_navclick('check');">下一步</a>
            </div>
        </div>
    </div>
    <div class="tab2" style="display: none;">
        <div class="control-group">
            <label for="industry" class="control-label"><span class="required">*</span>所属行业：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="industry" name="industry"
                       value="<?php echo $industry; ?>" data-rules="required" data-empty-msg="主营产品不能为空！">
                <input id="industryCode" type="hidden" name="industryCode" value="<?php echo $industryCode; ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label for="product" class="control-label"><span class="required">*</span>主营产品：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="product" name="product" data-rules="required"
                       data-empty-msg="主营产品不能为空！" value="<?php echo $product; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="product" class="control-label"><span class="required">*</span>营业执照/信用代码：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="creditCode" name="creditCode"
                       data-rules="required" data-empty-msg="营业执照/信用代码不能为空！" value="<?php echo $creditCode; ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="crePhotoUrl" class="control-label v-top"><span class="required">*</span>上传营业执照/信用代码图片：</label>
            <div class="controls" id="upload_cre">
                <?php if ($crePhotoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $crePhotoUrl; ?>">
                <?php } ?>
                <a href="javascript:void(0);" id="upload_cre_btn" class="sui-btn btn-xlarge btn-primary">上传证件</a>
                <a href="javascript:void(0);" id="bigPhoto" class="sui-btn btn-xlarge btn-primary"
                   onclick="listphoto();">查看大图</a>
                <input type="hidden" name="crePhotoUrl" id="crePhotoUrl" value="<?php echo $crePhotoUrl; ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label for="taxCode" class="control-label">税务登记证号：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="taxCode" name="taxCode"
                       value="<?php echo $taxCode; ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="taxPhotoUrl" class="control-label v-top">上传税务登记证号图片：</label>
            <div class="controls" id="upload_tax">
                <?php if ($taxPhotoUrl) { ?>
                    <img style="width: 105px; height: 105px;" src="<?php echo $taxPhotoUrl; ?>">
                <?php } ?>
                <a href="javascript:void(0);" id="upload_tax_btn" class="sui-btn btn-xlarge btn-primary">上传证件</a>
                <a href="javascript:void(0);" id="bigPhoto1" class="sui-btn btn-xlarge btn-primary"
                   onclick="listphoto1();">查看大图</a>
                <input type="hidden" name="taxPhotoUrl" id="taxPhotoUrl" value="<?php echo $taxPhotoUrl; ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label for="description" class="control-label"><span class="required">*</span>企业简介：</label>
            <div class="controls">
                <textarea id="description" name="description" data-rules="required" data-empty-msg="企业简介不能为空！"
                          style="width: 550px;height:200px;"><?php echo $description; ?></textarea>
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
                    <label class="radio-pretty inline <?php if (strrpos($status, '2') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '2') > -1) {
                            echo 'checked="checked"';
                        } ?> value="2" name="status_radio"><span>已审核</span>
                    </label>
                    <label class="radio-pretty inline <?php if (strrpos($status, '3') > -1) {
                        echo "checked";
                    } ?>">
                        <input type="radio" <?php if (strrpos($status, '3') > -1) {
                            echo 'checked="checked"';
                        } ?> value="3" name="status_radio"><span>驳回</span>
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
        <?php if ($id && $status == 2) ?>
        <div class="control-group">
            <label for="inputDes" class="control-label v-top">模板配置地址：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo 'view/unionShop/sellerDetail.html?unionId=' . $id ?></span>
            </div>
        </div>
        <?php ?>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
            </div>
        </div>
    </div>
</form>

<?php echo assets::$jcrop; ?>
<?php echo assets::$sayimo; ?>

<script language="javascript" type="text/javascript">
    //当前商品轮廓图对象
    <?php if($main_photos):?>
    var main_photos = $.parseJSON('<?php echo json_encode($main_photos);?>');
    <?php else:?>
    var main_photos = {};
    <?php endif;?>
    $(function () {

        //供应商对话框远程加载页面
        //对话框回调函数
        var goods_callback = function (o) {
        }
        SAYIMO.dialogView('js_add_goods', '商品', 'tirgger_goods_btn', 'base_enterprise_info/viewstudents', 'js_btn_item_disabled', goods_callback);

        //重新加载对话框内容
        $("#js_add_goods").on("hidden", function () {
            $(this).removeData("modal");
        });
    });


    $(function () {
        var submitBefore = function () {

            var province_Name = document.getElementById("province_Name").innerHTML;
            var city_Name = document.getElementById("city_Name").innerHTML;
            var area_Name = document.getElementById('area_Name').innerHTML;
            $('#provinceName').val(province_Name);
            $('#cityName').val(city_Name);
            $('#areaName').val(area_Name);
            // var qq = $('#areaName').val();
            // $.alert(qq);
            // return false;
            // var listphote = $('#listphote').val();
            var crePhotoUrl = $('#crePhotoUrl').val();
            // if (listphote == 'null') {
            //   $.alert('轮播图不能为空');
            // }else
            var providerType = $("#providerType").val();
            var discount = $("#discount").val();
            var providerName = $("#providerName").val();
            var cq = 1;
            $.ajax({
                type: 'post',
                url: '<?php echo APP_URL?>base_supplier/setProviderName',
                data: {'providerName': providerName, 'id':<?php echo $id;?>},
                dataType: "json",
                async: false,
                success: function (data) {
                    if (data['msg'] == 1) {
                        $.alert('该企业名称已被占用。');
                        cq = 2;
                    }
                }
            });
            if (cq == 2) {
                return false;
            }
            if (providerType == 2 && discount == '') {
                $.alert('折扣不能为空');
                return false;
            }
            if (crePhotoUrl == null) {
                $.alert('上传营业执照/信用代码图片');
                return false;
            }

            $('provinceName').val();
            return true;


        }

        var _opts = {};
        _opts.url = OO._SRVPATH + 'base_enterprise_info/save';
        _opts.failFun = function () {
            errors = document.querySelectorAll("#provider-form .input-error")
            for (var i = errors.length - 1; i >= 0; i--) {
                $(errors[i]).trigger('focus');
                var arr = ["providerName", "corporate", "lockPhone", "address"];
                if (arr.toString().indexOf(errors[i].id) > -1) {
                    $(".sui-nav.nav-tabs li").eq(0).addClass('active');
                    $(".sui-nav.nav-tabs li").eq(1).removeClass('active');
                    $(".tab1").show();
                    $(".tab2").hide();
                }
            }
        }

        SAYIMO.form.init('#provider-form', _opts, submitBefore);


    });

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

    function listphoto() {
        var pto = $('#crePhotoUrl').val();
        window.open(pto);
    }
    function listphoto1() {
        var pto = $('#taxPhotoUrl').val();
        window.open(pto);
    }

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
    //实例化编辑器

    UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
    UE.Editor.prototype.getActionUrl = function (action) {
        if (action == 'uploadimage' || action == 'uploadscrawl' || action == 'uploadimage') {
            return "<?php echo IMAGE_FILE_SER?>";
        } else if (action == 'uploadvideo') {
            return "<?php echo IMAGE_FILE_SER?>";
        } else {
            return this._bkGetActionUrl.call(this, action);
        }
    }

    var editorA = UE.getEditor('description', {
        initialFrameWidth: 720,
        initialFrameHeight: 260,
        autoHeightEnabled: false,
        wordCount: true,
        topOffset: 110,
        maximumWords: 3000,
        wordCountMsg: '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ',
        wordOverFlowMsg: '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'
    });

    /**
     * [选择省份城市县区]
     * @param  {[intger]} curId [当前选项code]
     * @param  {[intger]} clickId[当前选中code]
     * @return {[json]} 加载到选项UL中
     * wsbnet@qq.com
     */
    $(function () {
        //选择省份
        $(".province").on('click', 'ul li', function () {
            var curId = $(".province").find("input").val();
            var clickId = $(this).find("a").attr("value");
            if (curId !== clickId) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo APP_URL?>base_enterprise_info/getCityJsonList',
                    data: {'provinceCode': clickId},
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        var li = '';
                        for (var i = data.length - 1; i >= 0; i--) {
                            li += '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="' + data[i].code + '">' + data[i].name + '</a></li>\n';
                        }
                        $(".city").find("ul").html(li);
                        $(".city").find("a span").html("城市");
                        $(".area").find("a span").html("县区");
                    }
                })
            }
        })
        //选择城市
        $(".city").on('click', 'ul li', function () {
            var curId = $(".city").find("input").val();
            var clickId = $(this).find("a").attr("value");
            if (curId !== clickId) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo APP_URL?>base_enterprise_info/getAreaJsonList',
                    data: {'cityCode': clickId},
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        var li = '';
                        for (var i = data.length - 1; i >= 0; i--) {
                            li += '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="' + data[i].code + '">' + data[i].name + '</a></li>\n';
                        }
                        $(".area").find("ul").html(li);
                        $(".area").find("a span").html("县区");
                    }
                })
            }
        })


    });
    /*[选择省份城市县区]结束*/

    /**
     * [LOGO裁剪上传]
     */
    $("#upload_btn").J_jcorp({
        'filePath': '<?php echo OTHERIMGPATH;?>',
        'imagePath': '<?php echo OTHERIMGURL;?>',
        'aspectRatio': 1,//裁剪宽高比
        'maxSize': [180, 180],//裁剪最大尺寸 [width,height]
        'minSize': [180, 180],//裁剪最小尺寸 [width,height]
        'picSize': [180, 180],//最终保存图片尺寸 [width,height]
        'quality': 3,//裁剪完后图片压缩比例
        'AjaxData': ['<?php echo RES_SER;?>', 'json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
        'callback': function (s, data) {//接口成功回调
            $('#upload_logo').children('img').remove();
            $('#upload_logo').prepend('<img src="' + s + '" />');
            if (data.data[0].photoUrl != undefined) {
                $("#photoUrl").val(data.data[0].photoUrl);
            }
        }
    });


    $(".photo_main").on('click', '.Js_item .Js_delphoto', function () {
        var delItem = $(this);
        $.confirm({
            title: '确认',
            body: '您确认删除轮播图吗？',
            okHidden: function () {
                delete main_photos[parseInt(delItem.attr('index'))];
                delItem.parent(".Js_item").remove();
                $.ajax({
                    type: "post",
                    async: false,
                    url: '<?php echo APP_URL . "base_enterprise_info/photodelete";?>',
                    data: "id=" + delItem.attr('photoId') + "&infoid=" + $("#id").val(),
                    dataType: 'json',
                    success: function (data) {
                        if (data['data']['status'] == 1) {
                            $.alert(data['data']['msg']);
                            // SAYIMO.go_url("<?php echo APP_URL;?>base_enterprise_info/edit?id="+$("#id").val());
                        } else {
                            $.alert(data['data']['msg']);
                        }
                    }
                });
            }
        })
    })

    /**
     * [轮廓图裁剪上传]
     */
    function objectNewLength() {
        if (main_photos) {
            return (parseInt(backend.comomn.objectLength(main_photos)) + 1); //图片对象组长度
        } else {
            return 1 //当对象空返回长度为1, 让图片对象组下标为1插入新对象元素
        }
    }
    $("#upload_main").J_jcorp({
        'filePath': '<?php echo OTHERIMGPATH;?>',
        'imagePath': '<?php echo OTHERIMGURL;?>',
        'aspectRatio': 1.33,//裁剪宽高比
        'maxSize': [340, 256],//裁剪最大尺寸 [width,height]
        'minSize': [240, 180],//裁剪最小尺寸 [width,height]
        'picSize': [640, 480],//最终保存图片尺寸 [width,height]
        'quality': 3,//裁剪完后图片压缩比例
        'AjaxData': ['<?php echo RES_SER;?>', 'json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
        'callback': function (s, data) {//接口成功回调
            $('.photo_main').append('<div class="photo_item Js_item">' +
                '<img class="photo_img Js_img" id="iconImg" src="' + s + '" />' +
                '<div class="photo_del Js_delphoto" index="' + objectNewLength() + '"><i class="sui-icon icon-tb-delete"></i></div>' +
                '<div class="photo_mvleft Js_move_left"><i class="sui-icon icon-pc-chevron-left"></i></div>' +
                '<div class="photo_mvright Js_move_right"><i class="sui-icon icon-pc-chevron-right"></i></div>' +
                '<div class="photo_bg"></div>' +
                '</div>');
            if (data.data[0].photoUrl) {
                //新建对象
                var newItem = {};
                newItem.id = '';
                newItem.goodsId = $("#id").val();
                newItem.displayOrder = objectNewLength();
                newItem.photoName = '';
                newItem.photoPath = data.data[0].photoUrl;
                newItem.status = 1;
                main_photos[objectNewLength()] = newItem//添加新对象
                //console.log(objectNewLength());
                //console.log(main_photos);
                $('#listphote').val(JSON.stringify(main_photos));
                $('#main_photos').removeClass("input-error");
                $(".sui-msg.msg-error").remove();
            }
        }
    });

    //触发图片移动和删除
    $(document).ready(function () {
        backend.photo.mv();
    });

    //BUG修复
    $(document).ready(function () {
        $(".Js_upload").trigger("click"); // $.on绑定, 点击一次才生效
    });

    /**
     * 营业执照裁剪上传]
     */
    $("#upload_cre_btn").J_jcorp({
        'filePath': '<?php echo OTHERIMGPATH;?>',
        'imagePath': '<?php echo OTHERIMGURL;?>',
        'aspectRatio': 1.5,//裁剪宽高比
        'maxSize': [600, 400],//裁剪最大尺寸 [width,height]
        'minSize': [150, 100],//裁剪最小尺寸 [width,height]
        'picSize': [0, 0],//最终保存图片尺寸 [width,height]
        'quality': 1,//裁剪完后图片压缩比例
        'AjaxData': ['<?php echo RES_SER;?>', 'json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
        'callback': function (s, data) {//接口成功回调
            $('#upload_cre').children('img').remove();
            $('#upload_cre').prepend('<img src="' + s + '" style="width: 105px; height: 105px;" />');
            if (data.data[0].photoUrl != undefined) {
                $("#crePhotoUrl").val(data.data[0].photoUrl);
            }
        }
    });

    /**
     * 证件裁剪上传]
     */
    $("#upload_tax_btn").J_jcorp({
        'filePath': '<?php echo OTHERIMGPATH;?>',
        'imagePath': '<?php echo OTHERIMGURL;?>',
        'aspectRatio': 1.5,//裁剪宽高比
        'maxSize': [600, 400],//裁剪最大尺寸 [width,height]
        'minSize': [150, 100],//裁剪最小尺寸 [width,height]
        'picSize': [0, 0],//最终保存图片尺寸 [width,height]
        'quality': 1,//裁剪完后图片压缩比例
        'AjaxData': ['<?php echo RES_SER;?>', 'json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
        'callback': function (s, data) {//接口成功回调
            $('#upload_tax').children('img').remove();
            $('#upload_tax').prepend('<img src="' + s + '" style="width: 105px; height: 105px;" />');
            if (data.data[0].photoUrl != undefined) {
                $("#taxPhotoUrl").val(data.data[0].photoUrl);
            }
        }
    });

    $(function () {
        //对话框远程加载页面(说明, ID名:js_add_view,providerName; class名:J_addlistAd)
        SAYIMO.dialogView('js_add_industry', '所选择的行业（您最多能选择5项）', 'industry', 'base_enterprise_info/viewIndustry', 'js_btn_item', callback_dialog);
    });
    //对话框回调函数
    function callback_dialog(o) {
        var industryCodes = '';
        $("[name='industryCodelist[]']").each(function () {
            if (industryCodes == '') {
                industryCodes = $(this).val();
            } else {
                industryCodes += ',' + $(this).val();
            }
        });
        var industrys = '';
        $("[name='industryNamelist[]']").each(function () {
            if (industrys == '') {
                industrys = $(this).val();
            } else {
                industrys += ',' + $(this).val();
            }
        });
        $("#industry").val(industrys);
        $("#industryCode").val(industryCodes);
        $("#industry").focus();
        $("#industry").blur();
    }
</script>