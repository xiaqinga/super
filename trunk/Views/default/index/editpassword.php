<form id="setPassWord-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
	<div class="control-group">
	    <label for="inputEmail" class="control-label">原密码：</label>
	    <div class="controls">
	      <input type="password" class="input-xlarge input-xfat" id="passWord" name="passWord" data-rules="required|passwordcheck" data-empty-msg="原密码不能为空！"  value="">
	      <span class="required">*</span>
	    </div>
	</div>
	<div class="control-group">
	    <label for="inputPassword" class="control-label">新密码：</label>
	    <div class="controls">
	      <input type="password" class="input-xlarge input-xfat" id="newpassword" name="newpassword" placeholder="新密码" data-rules="required"  data-empty-msg="新密码不能为空！" title="密码">
	      <span class="required">*</span>
	    </div>
	</div>
	<div class="control-group">
	    <label for="inputRepassword" class="control-label">确认新密码：</label>
	    <div class="controls">
	      <input type="password" class="input-xlarge input-xfat" id="newpassword" name="newpassword" placeholder="确认新密码"  data-empty-msg="确认新密码不能为空！" data-rules="required|match=newpassword">
	      <span class="required">*</span>
	    </div>
	</div>
	<button type="submit" id="savenewpassword" style="display: none;">确定</button>
</form>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
  var _opts = {};
  _opts.url = OO._SRVPATH + 'index/setPassword';
  var submitBefore=null;
  $('#setPassWord-form').validate({
		success: function(){
			if(submitBefore!==null){
				if(!submitBefore()){
					return false;
				}
			}
			_opts.data = $('#setPassWord-form').serialize();
			OO.form(_opts,function(d){
			    if( 1 == d.status )
			    {
			      $.alert({title: '提示', body: d.data.msg,
			        hidden: function(e){
			          location.reload();
			        }
			      });
			    }
			    else
			    {
			      $.alert({title: '提示',body: d.data.msg});
			    }
			});
			return false;
		}
	});
  
  SAYIMO.form.rule('passwordcheck',{opt:'remote',name: 'passWord', url: 'index/checkexistpass'},'原密码不正确！');
});
</script>