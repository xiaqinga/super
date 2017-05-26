<form id="viewsearch" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
<div class="control-group">
    <label for="inputEmail" class="control-label">选择类型：</label>
    <div class="controls">
    	<label data-toggle="radio" class="radio-pretty inline <?php echo($type==1)?'checked':''?>">
	        <input type="radio" onclick="showhidediv(1);" name="actionurltype" id="actionurltype" value="1" <?php echo($type==1)?'checked="checked"':''?>><span>指定栏目</span>
	    </label>
	    <label data-toggle="radio" class="radio-pretty inline <?php echo($type==2)?'checked':''?>">
	        <input type="radio" onclick="showhidediv(2);" name="actionurltype" id="actionurltype" value="2" <?php echo($type==2)?'checked="checked"':''?>><span>指定商品</span>
	    </label>
	    <label data-toggle="radio" class="radio-pretty inline <?php echo($type==3)?'checked':''?>">
	        <input type="radio" onclick="showhidediv(3);" name="actionurltype" id="actionurltype" value="3" <?php echo($type==3)?'checked="checked"':''?>><span>指定URL</span>
	    </label>
	    <input type="hidden" name="relId" id="actionrelId" value="<?php echo $relId;?>">
	    <input type="hidden" name="relName" id="actionrelName" value="<?php echo $relName;?>">
    </div>
</div>
<div class="control-group" style="width: 100%;">
	<div id="goodsclasslist">
		
	</div>
	<div id="goodslist">
		
	</div>
	<div id="urllist">
		<input type="text" class="input-xlarge input-xfat" id="actionurl" name="actionurl" placeholder="请输入URL地址"  value="<?php echo $url;?>">
	</div>
</div>
</form>
<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">
$(function(){
	$('#goodsclasslist').load(OO._SRVPATH+'goodsindex/goodsclass?relId=<?php echo $relId;?>');
	$('#goodslist').load(OO._SRVPATH+'goodsindex/goods?relId=<?php echo $relId;?>');
	var type = <?php echo($type)?$type:1;?>;
	var relId = '<?php echo $relId;?>';
	var url = '<?php echo $url;?>';
	if(type == 1){
		$('#goodsclasslist').show();
		$('#goodslist').hide();
		$('#urllist').hide();
	}else if(type == 2){
		$('#goodsclasslist').hide();
		$('#goodslist').show();
		$('#urllist').hide();
	}else{
		$('#goodsclasslist').hide();
		$('#goodslist').hide();
		$('#urllist').show();
	}
});
function showhidediv(t){
	if(t == 1){
		$('#goodsclasslist').show();
		$('#goodslist').hide();
		$('#urllist').hide();
	}else if(t == 2){
		$('#goodsclasslist').hide();
		$('#goodslist').show();
		$('#urllist').hide();
	}else{
		$('#goodsclasslist').hide();
		$('#goodslist').hide();
		$('#urllist').show();
	}
}
</script>