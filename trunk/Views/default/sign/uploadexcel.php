<form id="uploadexcel-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="control-group">
        <label for="inputEmail" class="control-label">导入用户数据：</label>
        <div class="controls">
            <a href="javascript:;" class="sui-btn btn-xlarge btn-success" style="position: relative;">
                上传<input type="file" id="S-file" name="file" accept=".xls,.xlsx">
            </a>
        </div>
    </div>
    <div class="control-group" style="width: 100%;">
  	<span id="upmsg" style="display: none;">正在上传...<div class="sui-progress progress-striped active">
  <div style="width: 100%;" class="bar"></div>
</div></span>
    </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
    $("#S-file").change(function(){
        $('#upmsg').show();
        var formData = new FormData($( "#uploadexcel-form" )[0]);
        $.ajax({
            type:'post',
            url:OO._SRVPATH+'sign/uploadexcelsave',
            data:formData,
            dataType:"json",
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success:function(d){
                $('#upmsg').hide();
                if(1 == d.status){
                    $(".upExcelmodal").modal('hide');
                    $.alert({
                        title: '提示',
                        backdrop:false,
                        body: d.data.msg,
                        okHide: function() {

                            OO.loading(SAYIMO._MAINCONT);
                            SAYIMO._MAINCONT.load("sign/index");
                        }
                    });
                }else{
                    $.alert({title: '提示',backdrop:false,body: d.data.msg});
                    $(".upExcelmodal").modal('hide');
                }
            }
        });
    });
</script>