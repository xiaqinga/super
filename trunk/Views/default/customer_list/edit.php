<style type="text/css">

    .sui-form input[disabled]{background-color: #d4d4d4;}
</style>
<ul class="sui-breadcrumb">
    <li><a>绑定店铺</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<div class="load-wrapper">
    <form id="base_media-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
        <div class="control-group">
            <label for="inputDes" class="control-label v-top">会员帐号：</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $accout ;?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="inputEmail" class="control-label"><span class="required">*</span>会员昵称:</label>
            <div class="controls">
                <span class="input-xlarge input-xfat"><?php echo $alias?$alias:'--' ;?></span>
            </div>
        </div>
        <div class="control-group">
            <label for="inputEmail" class="control-label"><span class="required">*</span>真实姓名:</label>
            <span class="input-xlarge input-xfat"><?php echo $realName?$realName:'--' ;?></span>
            <div class="controls">
            </div>
        </div>
            <div class="control-group">
                <!--<label for="enterpriseName" class="control-label v-top"><span class="required">*</span>企业名称：</label>
                <div class="controls">
                    <input type="text" class="input-large input-fat" id="providerName" value="<?php /*echo $providerName;*/?>">
                    <input type="hidden" name="providerRefId" id="providerRefId" value="<?php /*echo $providerRefId;*/?>" />
                    <input type="hidden" name="id" id="id" value="<?php /*echo $id;*/?>" />
                    <input type="hidden" name="supplier_id" id="supplier_id" value="<?php /*echo $supplier_id;*/?>" />
                </div>-->

                <label for="industry" class="control-label v-top"><span class="required">*</span>所属行业：</label>
                <div class="controls">
                    <input id="industry"   disabled=""  type="text" value="<?php echo $providerName?>">
                </div>
            </div>
            <div class="control-group">
                <label for="industry" class="control-label v-top"><span class="required">*</span>所属行业：</label>
                <div class="controls">
                    <input id="industry"   disabled=""  type="text" value="<?php echo $industry?>">
                </div>
            </div>
            <div class="control-group">
                <label for="hrman" class="control-label v-top"><span class="required">*</span>法人代表：</label>
                <div class="controls">
                    <input id="linkman"    disabled="" type="text" value="<?php echo $linkman ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="hrPhone" class="control-label v-top"><span class="required">*</span>法人手机：</label>
                <div class="controls">
                    <input id="mobilePhone"   disabled="" type="text" value="<?php  echo $mobilePhone?>">
                </div>
            </div>








        <!--<div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
            </div>
        </div>-->
    </form>
</div>

<?php echo assets::$sayimo;?>
<?php echo assets::$editor;?>
<?php echo assets::$resume;?>


<script language="javascript" type="text/javascript">
    /*$(function(){
        var _opts = {};
        _opts.url = OO._SRVPATH + 'customer_list/save';
        SAYIMO.form.init('#base_media-form', _opts);
    });*/

    //实例化编辑器




    //供应商对话框远程加载页面
    //对话框回调函数
   /* var company_callback = function(o){
        $("#supplier_id").val(o.attr('data_id'));
        $("#providerRefId").val(o.attr('data_bid'));
        $("#providerName").val(o.find(".json_providerName").html());
        $("#linkman").val(o.find(".json_linkman").text());
        $("#mobilePhone").val(o.find(".json_mobilePhone").text());
        $("#industry").val(o.find(".json_industry").text());
    }
    SAYIMO.dialogView('js_add_company','企业','providerName','admin_provider/viewProvider?customerId=NO','js_btn_item',company_callback);
    */


    //重载对话框远程加载页面
   /* $("#providerName").click(function(){

        var container = $("#js_add_company .modal-body");
        OO.loading(container);
        container.load(encodeURI("<?php echo APP_URL;?>admin_provider/viewProvider?customerId=NO"));

    })
*/


</script>
