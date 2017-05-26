
<ul class="sui-breadcrumb">
    <li><a>评论详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">

    <div class="control-group">
        <label for="inputDes" class="control-label v-top">评论商品：</label>
        <div class="controls">
            <input  type="hidden" name="commentId" value="<?php echo $id?>" />
            <input  type="hidden" name="ref" value="<?php echo $ref?>" />
            <span class="input-xlarge input-xfat"><?php echo $goodsName?></span>
        </div>
    </div>
    <div class="control-group">
        <label for="alias" class="control-label">评论用户:</label>
        <div class="controls">
            <span class="input-xlarge input-xfat"><?php echo $alias?$alias:'--' ?></span>
        </div>
    </div>
    <div class="control-group">
        <label for="inputDes" class="control-label v-top">评论内容：</label>
        <div class="controls">
            <span class="input-xlarge input-xfat"><?php echo $commentContent ?></span>
        </div>
    </div>

    <div class="control-group">
        <label for="inputDes" class="control-label v-top">星级：</label>
        <div class="controls">
        <span class="input-xlarge input-xfat">
            <?php if($commentLevel == 1){echo "差评";}
            else if($commentLevel == 2 || $commentLevel == 3){echo "中评";}
            else if($commentLevel == 4 || $commentLevel == 5){echo "好评";}
            ;?>
        </span>

        </div>
    </div>
    <div class="control-group">
        <label for="inputDes" class="control-label v-top">评论时间：</label>
        <div class="controls">
            <span class="input-xlarge input-xfat"><?php echo $createDate ?></span>
        </div>
    </div>

    <div class="control-group">
        <label for="description" class="control-label"><span class="required">*</span>回复内容：</label>
        <div class="controls">
            <input type="hidden" name="id" value="<?php echo  $replyContent['id'] ?>" />
            <textarea id="replyContent" name="replyContent" data-rules="required" data-empty-msg="回复内容不能为空！" style="width: 550px;height:200px;"><?php echo $replyContent['replyContent'];?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
        </div>
    </div>
</form>
<?php echo assets::$sayimo; ?>
<?php echo assets::$editor;?>

<script language="javascript" type="text/javascript">

UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
UE.Editor.prototype.getActionUrl = function(action) {
    if (action == 'uploadimage' || action == 'uploadscrawl' || action == 'uploadimage') {
        return "<?php echo IMAGE_FILE_SER?>";
    } else if (action == 'uploadvideo') {
        return "<?php echo IMAGE_FILE_SER?>";
    } else {
        return this._bkGetActionUrl.call(this, action);
    }
}

var editor=UE.getEditor('replyContent',{initialFrameWidth : 720, initialFrameHeight : 260, autoHeightEnabled : false, wordCount : true, topOffset : 110, maximumWords : 3000, wordCountMsg : '当前已输入{#count}个字符, 您还可以输入{#leave}个字符。 ', wordOverFlowMsg : '你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！'});

var _opts = {};
_opts.url = OO._SRVPATH + 'goods_comment/save';
SAYIMO.form.init('#provider-form', _opts);

</script>
