<form id="setReject-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
	<div class="control-group">
	    <label for="inputEmail" class="control-label">驳回原因：</label>
	    <div class="controls">
	    	<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
	    	<input type="hidden" name="mallType" id="mallType" value="<?php echo $mallType;?>">
	    	<textarea class="input-xlarge input-xfat" name="reject" id="reject" value=""></textarea>
	    </div>
	</div>
	
	<button type="submit" id="savereject" style="display: none;">确定</button>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'goods_list/setReject';
  SAYIMO.form.init('#setReject-form', _opts);
 
});
</script>