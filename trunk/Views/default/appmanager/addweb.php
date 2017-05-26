<ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'修改':'添加';?>WEB</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="appmanager-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate" style="float: left;">
    <div class="control-group">
        <label for="inputEmail" class="control-label">应用名称：</label>
        <div class="controls">
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
            <span class="sui-dropdown dropdown-bordered select" id="mobileSysTypeSelect" ><span class="dropdown-inner"><a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
	          <input value="<?php echo ($name)?$name:''?>"  data-rules="required" name="name" id="mobileSysType" type="hidden"><i class="caret"></i><span><?php echo ($mobileSysType)?$mobileSysTypelist[$mobileSysType]:'请选择'?></span></a>
	          <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
	          	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="未来梦客">未来梦客</a></li>

	          </ul></span></span>
             <span class="required">*</span>
        </div>
    </div>
    <div class="control-group">
        <label for="inputEmail" class="control-label">版本号：</label>
        <div class="controls">
            <input type="text" class="input-xlarge input-xfat" id="version" name="version" placeholder="版本号" data-rules="required"  value="<?php echo $version;?>">
            <span class="required">*</span>
        </div>
    </div>
    <div class="control-group">
        <label for="inputEmail" class="control-label">系统：</label>
        <div class="controls">
            <label data-toggle="radio" class="radio-pretty inline <?php echo($mobileSysType != 2)?'checked':''?>">
                <input type="radio" name="mobileSysType" id="mobileSysType" value="1" <?php echo($mobileSysType!=2)?'checked="checked"':''?> data-rules="required"><span>Android </span>
            </label>
            <label data-toggle="radio" class="radio-pretty inline <?php echo($mobileSysType == 2)?'checked':''?>">
                <input type="radio" name="mobileSysType" id="mobileSysType" value="2" <?php echo($mobileSysType==2)?'checked="checked"':''?> data-rules="required"><span>IOS</span>
            </label>
            <label data-toggle="radio" class="radio-pretty inline <?php echo($mobileSysType == 3)?'checked':''?>">
                <input type="radio" name="mobileSysType" id="mobileSysType" value="3" <?php echo($mobileSysType==3)?'checked="checked"':''?> data-rules="required"><span>共用</span>
            </label>
        </div>
    </div>



    <div class="control-group edit_localUrl">
        <label for="inputEmail" class="control-label">上传包：</label>
        <div class="controls">
            <input type="text" data-rules="required"  class="input-xlarge input-xfat" id="localUrl" name="localUrl" placeholder="本地下载" readonly value="<?php echo $localUrl;?>">
            <a  id="picker"  href="javascript:;" class="sui-btn  btn-success" style="position: relative;">
                上传<!--<input type="file" id="S-file" name="file" accept=".ipa,.apk">-->
            </a>
            <span id="upmsg" style="display: none;">正在上传<div class="sui-loading loading-xxsmall loading-inline"><i class="sui-icon icon-pc-loading"></i></div></span>
            <span class="required">*</span>

        </div>
    </div>

    <div class="control-group">
        <label for="inputEmail" class="control-label"></label>
        <div class="controls">
            <div id="thelist" class="uploader-list"></div>
        </div>
    </div>


    <div class="control-group">
        <label for="inputEmail" class="control-label">备注：</label>
        <div class="controls">
            <textarea id="detail" class="input-xlarge"  data-rules="required" placeholder="版本描述" name="detail"></textarea>
            <span class="required">*</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
        </div>
    </div>
</form>
<form id="appmanager-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate" style="float: left;margin-left: 150px;margin-top: 50px;">
    <div class="control-group">
        <div class="controls">
            <img id="a_thumb_preview" width="160" src="<?php echo $iconUrl;?>" style="position:relative;">
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>webUploader/js/webuploader.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL;?>webUploader/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL;?>webUploader/css/style.css">
<script language="javascript" type="text/javascript">


    $(function(){
        submitBefore=function(){

            var localUrl=$("#localUrl").val();
            if(!localUrl){

                $.alert('下载地址不能为空!');
                return false;
            }
            return true;

        };


        var _opts = {};
        _opts.url = OO._SRVPATH + 'appmanager/save';
        SAYIMO.form.init('#appmanager-form', _opts,submitBefore);
    });

    var $list = $('#thelist'),
        $btn = $('#ctlBtn');

    var uploader = WebUploader.create({
        auto: true,     //auto: false //选择文件后是否自动上传
        resize: false, // 不压缩image
        swf: '<?php echo ASSETS_URL;?>webUploader/js/uploader.swf', // swf文件路径
        server: '<?php echo FILE_SER;?>', // 文件接收服务端。
        pick: '#picker', // 选择文件的按钮。可选
        chunked: false, //是否要分片处理大文件上传
        //chunkSize:2*1024*1024, //分片上传，每片2M，默认是5M
        formData:{'filePath':'<?php echo APPPATH;?>',
            'imagePath':'<?php echo APPURL;?>'},
        fileVal:'file',

        // chunkRetry : 2, //如果某个分片由于网络问题出错，允许自动重传次数
        //runtimeOrder: 'html5,flash',
        /* accept: {
         title: 'intoTypes',
         extensions: 'ipa,apk',
         mimeTypes: '.ipa,.apk'
         },*/
        /* accept: {
         title: 'Images',
         extensions: 'gif,jpg,jpeg,bmp,png',
         mimeTypes: 'image/!*'
         }*/
        // multiple:false,
    });


    uploader.on( 'beforeFileQueued', function( file ) {
        if($list.html()){
            $.alert('有文件正在上传哦!');
            return false;
        }

        if(file.ext!='zip'){
            $.alert('只能上传.zip文件哦!');
            return false;
        }

    });

    // 当有文件被添加进队列的时候
    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">等待上传...</p>' +
            '</div>' );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');
        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo( $li ).find('.progress-bar');
        }else{
            $(".progress-striped").attr('display','block');
        };

        $li.find('p.state').text('上传中');

        $percent.css( 'width', percentage * 100 + '%' );
    });
    // 文件上传成功
    uploader.on( 'uploadSuccess', function( file ,response) {
        $( '#'+file.id ).find('p.state').text('已上传');
        if(1 == response.status){
            $("#localUrl").val(response.data[0].fileUrl);
        }else{
            $.alert({title: '提示',body: 'APP上传失败！'});
        }
    });

    // 文件上传失败，显示上传出错
    uploader.on( 'uploadError', function( file ) {
        $.alert('上传出错');
    });
    uploader.on('error', function(handler){
        switch (handler)
        {
            case 'Q_TYPE_DENIED':
                $.alert('上传文件类型不对!');
                break;
            case 'Q_EXCEED_SIZE_LIMIT':
                $.alert('上传文件太大了!');
                break;


        }

    })
    // 完成上传完
    uploader.on( 'uploadComplete', function( file ) {

        $list.html('');
    });

    $btn.on('click', function () {
        if ($(this).hasClass('disabled')) {
            return false;
        }
        uploader.upload();

    });



</script>