
<ul class="sui-breadcrumb">
    <li><a>评论详情</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="provider-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">

   <div class="control-group">
    <label for="inputDes" class="control-label v-top">评论商品：</label>
    <div class="controls">
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
        <label for="inputDes" class="control-label v-top">回复内容：</label>
        <div class="controls">
            <span class="input-xlarge input-xfat"><?php echo $replyContent?$replyContent:'未回复！' ?></span>
        </div>
    </div>
 <div class="control-group">
    <label for="inputDes" class="control-label v-top">星级：</label>
    <div class="controls">
        <span class="input-xlarge input-xfat">
            <?php if($attr['commentLevel'] == 1){echo "差评";}
            else if($attr['commentLevel'] == 2 || $attr['commentLevel'] == 3){echo "中评";}
            else if($attr['commentLevel'] == 4 || $attr['commentLevel'] == 5){echo "好评";}
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

 
</form>
<?php echo assets::$sayimo; ?>




</script>
