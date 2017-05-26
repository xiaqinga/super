<form id="industry-form" class="sui-form form-horizontal sui-validate">
  <div class="control-group">
    <label for="inputEmail" class="control-label" style="color: #f90;font-size: 14px;font-weight: bold;text-align: left;">已选行业：</label>
    <div class="controls" id="industrychecklist">
      
    </div>
  </div>
</form>
<form class="sui-form">
	<div class="sui-row">
	<?php if($industry_list){?>
	<?php foreach($industry_list as $key=>$val){?>
	<div class="span2">
		<label id="industrybt<?php echo $key;?>" onclick="checkOn('<?php echo $key;?>','<?php echo $val;?>');" class="checkbox-pretty inline">
		    <input id="industrychk_<?php echo $key;?>" type="checkbox" value="<?php echo $key;?>"><span id="industrychkName_<?php echo $key;?>"><?php echo $val;?></span>
		</label>
	</div>
	<?php }}?>
	</div>
</form>
<form class="sui-form">
	<label for="inputEmail" class="control-label"></label>
    <div class="controls" style="padding-left: 125px;">
      <a href="javascript:void(0);" class="sui-btn btn-xlarge btn-primary js_btn_item">确定</a>
    </div>
</form>
<div id="returnModal" tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
        <h4 id="myModalLabel" class="modal-title">提示</h4>
      </div>
      <div class="modal-body">您最多能选择5项！</div>
      <div class="modal-footer">
        <button type="button" onclick="closeReturnModal();" class="sui-btn btn-primary btn-large">确定</button>
        <button type="button" onclick="closeReturnModal();" class="sui-btn btn-default btn-large">取消</button>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
	var industryCode = $('#industryCode').val();
	if(industryCode != ''){
		var industryCodeList= new Array();
		industryCodeList = industryCode.split(',');
		for (i=0;i<industryCodeList.length ;i++ )   
    {   
    	var n = industryCodeList[i];
    	var s = $('#industrychkName_'+n).text();
    	var $checkbox = $('#industrybt'+n).checkbox();
        $checkbox.checkbox("check");
        var checkhtml = '<div id="industrylist_'+n
		+'" style="float:left;margin: 10px;">'+'<label onclick="checkOut(\''+n+'\');" class="checkbox-pretty inline checked">'
		+'<input id="industryCodelist'+n+'"  name="industryCodelist[]" value="'+n+'" type="checkbox" checked="checked"><span>'+s+'</span>'
		+'<input id="industryNamelist'+n+'" type="hidden" value="'+s+'" name="industryNamelist[]">'
		+'</label>'
		+'</div>';
		$("#industrychecklist").append(checkhtml);
    }
	}
	
    function checkOn(n,s){
    	if($("#industrylist_"+n).length > 0){
    		var ischk = $("#industrychk_"+n).is(':checked');
    		if(!ischk){
    			$("#industrylist_"+n).remove();
    		}
    	}else{
    		var chkbox_num = $("#industrychecklist").children("div").length;
	    	if(chkbox_num >= 5){
	    		$('#industrybt'+n).checkbox("uncheck");
	    		$('#returnModal').modal('show');
	    		return false;
	    	}else{
	    		var checkhtml = '<div id="industrylist_'+n
	    		+'" style="float:left;margin: 10px;">'+'<label onclick="checkOut(\''+n+'\');" class="checkbox-pretty inline checked">'
	    		+'<input id="industryCodelist'+n+'"  name="industryCodelist[]" value="'+n+'" type="checkbox" checked="checked"><span>'+s+'</span>'
	    		+'<input id="industryNamelist'+n+'" type="hidden" value="'+s+'" name="industryNamelist[]">'
				+'</label>'
	    		+'</div>';
	    		$("#industrychecklist").append(checkhtml);
	    	}
			}
    }
    function checkOut(n){
    	$("#industrylist_"+n).remove();
    	var $checkbox = $('#industrybt'+n).checkbox();
        $checkbox.checkbox("uncheck");
    }
    function closeReturnModal(){
    	$('#returnModal').modal('hide');
    }
</script>