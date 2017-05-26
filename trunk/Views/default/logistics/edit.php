<ul class="sui-breadcrumb">
	<li><a><?php echo ($id)?'修改':'添加';?>运费规则</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>运费模板名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="logisticsName" name="logisticsName" placeholder="运费模板名称" data-rules="required" data-empty-msg="运费模板名称不能为空！"  value="<?php echo $logisticsName;?>">
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">发货地址：</label>
    <div class="controls">
      <div id="aeraCode" class="sui-tree-group"></div></div>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">快递公司：</label>
    <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
          <input id="logisticsCompanyId" name="logisticsCompanyId" value="<?php echo ($logisticsCompanyId)?$logisticsCompanyId:'';?>" type="hidden" data-rules="required"><i class="caret"></i><span><?php echo ($logisticsCompanyId)?$emslist[$logisticsCompanyId]:'请选择快递公司';?></span></a>
          <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
          	<?php foreach ($emslist as $e_key => $e_val){?>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $e_key; ?>"><?php echo $e_val; ?></a></li>
			<?php } ?>
          </ul></span></span>
          <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">物流类型：</label>
    <div class="controls">
          <label data-toggle="radio" class="radio-pretty inline <?php echo ($logisticsType==1 || empty($logisticsType))?'checked':''?>">
		    <input type="radio" <?php echo ($logisticsType==1 || empty($logisticsType))?'checked="checked"':''?> name="logisticsType" value="1"><span>快递 </span>
		  </label>
		  <label data-toggle="radio" class="radio-pretty inline <?php echo ($logisticsType==2)?'checked':''?>">
		    <input type="radio" <?php echo ($logisticsType==2)?'checked="checked"':''?> name="logisticsType" value="2"><span>物流</span>
		  </label>
		  <label data-toggle="radio" class="radio-pretty inline <?php echo ($logisticsType==3)?'checked':''?>">
		    <input type="radio" <?php echo ($logisticsType==3)?'checked="checked"':''?> name="logisticsType" value="3"><span>货运</span>
		  </label>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label">价格类型：</label>
    <div class="controls">
          <label data-toggle="radio" class="radio-pretty inline <?php echo ($priceType!=2)?'checked':''?>">
		    <input type="radio" <?php echo ($priceType!=2)?'checked="checked"':''?> name="priceType" value="1" onclick="changePriceType(this.value)"><span>按件 </span>
		  </label>
		  <label data-toggle="radio" class="radio-pretty inline <?php echo ($priceType==2)?'checked':''?>">
		    <input type="radio" <?php echo ($priceType==2)?'checked="checked"':''?> name="priceType" value="2" onclick="changePriceType(this.value)"><span>重量</span>
		  </label>
    </div>
  </div>
  <div class="control-group">
    <label for="inputEmail" class="control-label"><span class="required">*</span>运送范围：</label>
    <div class="controls">
      <label class="inline">
      	除指定地区设置运费外，其余地区则表示不在运送范围内
      </label>
      <a href="javascript:void(0);" onclick="appendRow();" class="sui-btn btn-xlarge">添加行 </a>
    </div>
  </div>
  <div class="control-group" style="width: 100%;">
  	<table class="sui-table table-bordered-simple" style="width: 55%;">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk" id="unitTr" style="display: <?php echo ($priceType==1 || empty($priceType))?'table-row':'none'?>;">
      	<th class="center">运送到</th>
		<th class="center" width="10%">首件（个）</th>
		<th class="center" width="10%">首费（元）</th>
		<th class="center" width="10%">续件（个）</th>
		<th class="center" width="10%">续费（元）</th>
		<th class="center" class="lastCol" width="10%">操作</th>
    </tr>
    <tr class="thbk" id="weightTr" style="display: <?php echo ($priceType==2)?'table-row':'none'?>;">
      	<th class="center">运送到</th>
		<th class="center" width="10%">首重（kg）</th>
		<th class="center" width="10%">首费（元）</th>
		<th class="center" width="10%">续重（kg）</th>
		<th class="center" width="10%">续费（元）</th>
		<th class="center" class="lastCol" width="10%">操作</th>
    </tr>
  </thead>
  <tbody id="areacode-tr">
  	<?php if(count($areaCodeListStr)>0){?>
  		<?php foreach($areaCodeListStr as $acl_key=>$acl_val){?>
  			<tr>
		      <td class="center">
		      	<input type="hidden" name="areaCodeListKey[]" id="areaCodeListKey" value="<?php echo $acl_key+1;?>">
		      	<input type="hidden" name="areaCodeListId<?php echo $acl_key+1;?>" id="areaCodeListId<?php echo $acl_key+1;?>" value="<?php echo $acl_val['id'];?>">
		      	<input type="hidden" name="areaCodeList<?php echo $acl_key+1;?>" id="areaCodeList<?php echo $acl_key+1;?>" value="<?php echo $acl_val['areaCodeList'];?>">
		      	<textarea name="destinations<?php echo $acl_key+1;?>" id="destinations<?php echo $acl_key+1;?>" class="input-large" onclick="eidtAreacodeList(<?php echo $acl_val['id'];?>,<?php echo $acl_key+1;?>);"><?php echo $acl_val['destinations'];?></textarea>
		      </td>
		      <td class="center"><input type="type" class="input-medium input-fat" name="firstItem<?php echo $acl_key+1;?>" id="firstItem<?php echo $acl_key+1;?>" data-rules="required" data-empty-msg="不能为空！" value="<?php echo $acl_val['firstItem'];?>"></td>
		      <td class="center"><input type="type" class="input-medium input-fat" name="firstCost<?php echo $acl_key+1;?>" id="firstCost<?php echo $acl_key+1;?>" data-rules="required" data-empty-msg="不能为空！" value="<?php echo $acl_val['firstCost'];?>"></td>
		      <td class="center"><input type="type" class="input-medium input-fat" name="addItem<?php echo $acl_key+1;?>" id="addItem<?php echo $acl_key+1;?>" data-rules="required" data-empty-msg="不能为空！" value="<?php echo $acl_val['addItem'];?>"></td>
		      <td class="center"><input type="type" class="input-medium input-fat" name="addCost<?php echo $acl_key+1;?>" id="addCost<?php echo $acl_key+1;?>" data-rules="required" data-empty-msg="不能为空！" value="<?php echo $acl_val['addCost'];?>"></td>
		      <td class="center">
		      	<a class="sui-btn btn-link areacode-delete" title="删除" data-id="93" href="javascript:void(0);" onclick="removeRow(this);">
					<img class="imgtable" src="<?php echo ASSETS_URL;?>images/default/delete.png">
				</a>
		      </td>
		   	</tr>
  	<?php }}?>
  </tbody>
</table>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
    </div>
  </div>
</form>
<!--<script type="text/javascript" src="<?php /*echo ASSETS_URL;*/?>js/jquerysession.js"></script>-->
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
   SAYIMO.form.tree('#aeraCode',[<?php echo $aeraCode;?>]);
});
/*价格类型改变*/
function changePriceType(type){
	
	if(type=='1'){
		$("#unitTr").show();
		$("#weightTr").hide();
	}else if(type=='2'){
		$("#unitTr").hide();
		$("#weightTr").show();
	}
}
function appendRow(){
	var trNum = $("#areacode-tr").find("tr").last().find("#areaCodeListKey").val();
	if(typeof(trNum) == 'undefined'){
		trNum = 1;
	}else{
		trNum++;
	}
	var trHtml = '<tr>'+
		      '<td class="center">'+
		      	'<input type="hidden" name="areaCodeListKey[]" id="areaCodeListKey" value="'+trNum+'">'+
		      	'<input type="hidden" name="areaCodeListId'+trNum+'" id="areaCodeListId'+trNum+'" value="">'+
		      	'<input type="hidden" name="areaCodeList'+trNum+'" id="areaCodeList'+trNum+'" value="">'+
		      	'<textarea name="destinations'+trNum+'" id="destinations'+trNum+'" class="input-large" onclick="eidtAreacodeList(\'\','+trNum+')"></textarea>'+
		      '</td>'+
		      '<td class="center"><input type="type" class="input-medium input-fat" name="firstItem'+trNum+'" id="firstItem'+trNum+'" data-rules="required" data-empty-msg="不能为空！" value=""></td>'+
		      '<td class="center"><input type="type" class="input-medium input-fat" name="firstCost'+trNum+'" id="firstCost'+trNum+'" data-rules="required" data-empty-msg="不能为空！" value=""></td>'+
		      '<td class="center"><input type="type" class="input-medium input-fat" name="addItem'+trNum+'" id="addItem'+trNum+'" data-rules="required" data-empty-msg="不能为空！" value=""></td>'+
		      '<td class="center"><input type="type" class="input-medium input-fat" name="addCost'+trNum+'" id="addCost'+trNum+'" data-rules="required" data-empty-msg="不能为空！" value=""></td>'+
		      '<td class="center">'+
		      	'<a class="sui-btn btn-link areacode-delete" title="删除" data-id="93" href="javascript:void(0);" onclick="removeRow(this);">'+
					'<img class="imgtable" src="<?php echo ASSETS_URL;?>images/default/delete.png">'+
				'</a>'+
		      '</td>'+
		   	'</tr>';
	$("#areacode-tr").append(trHtml);
}
function removeRow(obj){
	$(obj).closest('tr').remove();
}
function eidtAreacodeList(id,trNum){
	var areaCodes = $('#areaCodeList'+trNum).val();
	$.ajax({type:'post', url:OO._SRVPATH + 'service/setSession', data:{'key_data':'areacodes','val_data':areaCodes}, dataType:"json", async:false,
	success:function(data){
	}
	});
	$.confirm({
      body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
      remote: OO._SRVPATH + 'logistics/eidtAreacodeList?id='+id,
      okHide:   function(e){
		var treeObj = $.fn.zTree.getZTreeObj("cityList");
		var nodes = treeObj.getCheckedNodes(true);
		var tree_id = '';
		var tree_name = '';
		//alert(JSON.stringify(nodes));
		$.each(nodes,function(n,value){
			if(tree_id == ''){
				tree_id += value.id;
			}else{
				tree_id += ','+value.id;
			}
			if(tree_name == ''){
				if(value.level==0 && value.check_Child_State==2){
					tree_name += value.name;
				}else if(value.level==1 && value.check_Child_State==2){
					var pnode = value.getParentNode();
					if(pnode.level==0 && pnode.check_Child_State!=2){
						tree_name += value.name;
					}
				}else if(value.level==2 && value.check_Child_State == -1){
					var pnode = value.getParentNode();
					if(pnode.level==1 && pnode.check_Child_State!=2){
						tree_name += value.name;
					}
				}
			}else{
				if(value.level==0 && value.check_Child_State==2){
					tree_name += ','+value.name;
				}else if(value.level==1 && value.check_Child_State==2){
					var pnode = value.getParentNode();
					if(pnode.level==0 && pnode.check_Child_State!=2){
						tree_name += ','+value.name;
					}
				}else if(value.level==2 && value.check_Child_State == -1){
					var pnode = value.getParentNode();
					if(pnode.level==1 && pnode.check_Child_State!=2){
						tree_name += ','+value.name;
					}
				}
			}
		});
		$('#areaCodeList'+trNum).val(tree_id);
		$('#destinations'+trNum).val(tree_name);
      }
    })
}
var _opts = {};
  _opts.tree = '#aeraCode';
  _opts.tree_name = 'aeraCode';
  _opts.url = OO._SRVPATH + 'logistics/save';
  SAYIMO.form.init('#ems-form', _opts);
</script>