<ul class="sui-breadcrumb">
	<li><a>查看首页模板</a></li>
	<li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<form id="goodsindex-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
  <div class="control-group">
    <label for="inputEmail" class="control-label">模板名称：</label>
    <div class="controls">
      <input type="hidden" name="id" id="id" value="<?php echo ($id)?$id:'';?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <input type="text" class="input-xlarge input-xfat" id="templateName" name="templateName" placeholder="模板名称" data-rules="required" data-empty-msg="模板名称不能为空！"  value="<?php echo ($templateName)?$templateName:'';?>" readonly="true">
      <span class="required">*</span>
    </div>
    <label for="inputEmail" class="control-label">模板标识符：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" placeholder="模板标识符" data-rules="required|identifier|identifiercheck" data-empty-msg="模板标识符不能为空！"  value="<?php echo ($identifier)?$identifier:'';?>" readonly="true">
      <span class="required">*</span>
    </div>
  </div>
  <div class="control-group">
    <label for="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  inputEmail" class="control-label">位置说明：</label>
    <div class="controls">
      <input type="text" class="input-xlarge input-xfat" id="description" name="description" placeholder="位置说明"  value="<?php echo ($description)?$description:'';?>" readonly="true">
    </div>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[0][id]" id="id" value="<?php echo (isset($indexs[0]['id']))?$indexs[0]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[0][sort]" id="sort" value="1">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[0][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[0]['templateName']))?$indexs[0]['templateName']:'';?>" readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[0][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[0]['forUrl']))?$indexs[0]['forUrl']:'';?>" readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img0" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn0"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName0" type="text" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*380px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img1" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn1"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName1" type="text" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*380px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img2" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn2"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName2" type="text" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relName]">
	      		<img align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*380px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img3" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn3"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName3" type="text" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relName]">
	      		<img align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*380px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template1.png" alt="">
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img4" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[0]['detail'][4]['photoUrl']))?$indexs[0]['detail'][4]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn4"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName4" type="text" value="<?php echo (isset($indexs[0]['detail'][4]['relName']))?$indexs[0]['detail'][4]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName4" type="hidden" value="<?php echo (isset($indexs[0]['detail'][4]['relName']))?$indexs[0]['detail'][4]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][4][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*380px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%"></td>
	      <td style="width: 20%"></td>
	      <td style="width: 20%"></td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[1][id]" id="id" value="<?php echo (isset($indexs[1]['id']))?$indexs[1]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[1][sort]" id="sort" value="2">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[1][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[1]['templateName']))?$indexs[1]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[1][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[1]['forUrl']))?$indexs[1]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img5" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][0]['photoUrl']))?$indexs[1]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn5"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName5" type="text" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img6" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][1]['photoUrl']))?$indexs[1]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn6"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName6" type="text" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img7" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][2]['photoUrl']))?$indexs[1]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn7"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName7" type="text" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img8" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][3]['photoUrl']))?$indexs[1]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn8"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName8" type="text" value="<?php echo (isset($indexs[1]['detail'][3]['relName']))?$indexs[1]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['relName']))?$indexs[1]['detail'][3]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template2.png" alt="">
	      </td>
	   </tr>
	   <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img9" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][4]['photoUrl']))?$indexs[1]['detail'][4]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn9"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName9" type="text" value="<?php echo (isset($indexs[1]['detail'][4]['relName']))?$indexs[1]['detail'][4]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['relName']))?$indexs[1]['detail'][4]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][relName]">
	      		<img align="right" value="" name="relName9" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img10" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][5]['photoUrl']))?$indexs[1]['detail'][5]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn10"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName10" type="text" value="<?php echo (isset($indexs[1]['detail'][5]['relName']))?$indexs[1]['detail'][5]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['relName']))?$indexs[1]['detail'][5]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][relName]">
	      		<img align="right" value="" name="relName10" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img11" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][6]['photoUrl']))?$indexs[1]['detail'][6]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn11"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName11" type="text" value="<?php echo (isset($indexs[1]['detail'][6]['relName']))?$indexs[1]['detail'][6]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['relName']))?$indexs[1]['detail'][6]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][relName]">
	      		<img align="right" value="" name="relName11" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img12" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[1]['detail'][7]['photoUrl']))?$indexs[1]['detail'][7]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn12"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName12" type="text" value="<?php echo (isset($indexs[1]['detail'][7]['relName']))?$indexs[1]['detail'][7]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['relName']))?$indexs[1]['detail'][7]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][relName]">
	      		<img align="right" value="" name="relName12" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
				
			</div>
	      </td>
	    </tr>
	</tbody>
	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[2][id]" id="id" value="<?php echo (isset($indexs[2]['id']))?$indexs[2]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[2][sort]" id="sort" value="3">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[2][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[2]['templateName']))?$indexs[2]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[2][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[2]['forUrl']))?$indexs[2]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img13" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[2]['detail'][0]['photoUrl']))?$indexs[2]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn13"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName13" type="text" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*360px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img14" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[2]['detail'][1]['photoUrl']))?$indexs[2]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn14"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName14" type="text" value="<?php echo (isset($indexs[2]['detail'][1]['relName']))?$indexs[2]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['relName']))?$indexs[2]['detail'][1]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img15" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[2]['detail'][2]['photoUrl']))?$indexs[2]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn15"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName15" type="text" value="<?php echo (isset($indexs[2]['detail'][2]['relName']))?$indexs[2]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['relName']))?$indexs[2]['detail'][2]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][relName]">
	      		<img align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img16" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[2]['detail'][3]['photoUrl']))?$indexs[2]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn16"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName16" type="text" value="<?php echo (isset($indexs[2]['detail'][3]['relName']))?$indexs[2]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['relName']))?$indexs[2]['detail'][3]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][relName]">
	      		<img align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template3.png" alt="">
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img17" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[2]['detail'][4]['photoUrl']))?$indexs[2]['detail'][4]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn17"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName17" type="text" value="<?php echo (isset($indexs[2]['detail'][4]['relName']))?$indexs[2]['detail'][4]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName17" type="hidden" value="<?php echo (isset($indexs[2]['detail'][4]['relName']))?$indexs[2]['detail'][4]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][4][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%"></td>
	      <td style="width: 20%"></td>
	      <td style="width: 20%"></td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[3][id]" id="id" value="<?php echo (isset($indexs[3]['id']))?$indexs[3]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[3][sort]" id="sort" value="4">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[3][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[3]['templateName']))?$indexs[3]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[3][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[3]['forUrl']))?$indexs[3]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img18" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn18"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName18" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*230px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template4.png" alt="">
	      </td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[4][id]" id="id" value="<?php echo (isset($indexs[4]['id']))?$indexs[4]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[4][sort]" id="sort" value="5">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[4][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[4]['templateName']))?$indexs[4]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[4][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[4]['forUrl']))?$indexs[4]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img19" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][0]['photoUrl']))?$indexs[4]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn19"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName19" type="text" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName19" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img20" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][1]['photoUrl']))?$indexs[4]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn20"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName20" type="text" value="<?php echo (isset($indexs[4]['detail'][1]['relName']))?$indexs[4]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName20" type="hidden" value="<?php echo (isset($indexs[4]['detail'][1]['relName']))?$indexs[4]['detail'][1]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img21" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][2]['photoUrl']))?$indexs[4]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn21"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName21" type="text" value="<?php echo (isset($indexs[4]['detail'][2]['relName']))?$indexs[4]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['relName']))?$indexs[4]['detail'][2]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img22" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][3]['photoUrl']))?$indexs[4]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn22"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName22" type="text" value="<?php echo (isset($indexs[4]['detail'][3]['relName']))?$indexs[4]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][3]['relName']))?$indexs[4]['detail'][3]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][3][relName]">
	      		<img align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template5.png" alt="">
	      </td>
	   </tr>
	   <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img23" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][4]['photoUrl']))?$indexs[4]['detail'][4]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn23"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName23" type="text" value="<?php echo (isset($indexs[4]['detail'][4]['relName']))?$indexs[4]['detail'][4]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName23" type="hidden" value="<?php echo (isset($indexs[4]['detail'][4]['relName']))?$indexs[4]['detail'][4]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][4][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img24" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][5]['photoUrl']))?$indexs[4]['detail'][5]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn24"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName24" type="text" value="<?php echo (isset($indexs[4]['detail'][5]['relName']))?$indexs[4]['detail'][5]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName24" type="hidden" value="<?php echo (isset($indexs[4]['detail'][5]['relName']))?$indexs[4]['detail'][5]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][5][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:24px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img25" style="width: 133px; height: 133px;border:1px solid #eaeaea;" src="<?php echo (isset($indexs[4]['detail'][6]['photoUrl']))?$indexs[4]['detail'][6]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn25"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName25" type="text" value="<?php echo (isset($indexs[4]['detail'][6]['relName']))?$indexs[4]['detail'][6]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName25" type="hidden" value="<?php echo (isset($indexs[4]['detail'][6]['relName']))?$indexs[4]['detail'][6]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][6][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      </td>
	    </tr>
	</tbody>
	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[5][id]" id="id" value="<?php echo (isset($indexs[5]['id']))?$indexs[5]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[5][sort]" id="sort" value="6">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[5][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[5]['templateName']))?$indexs[5]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[5][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[5]['forUrl']))?$indexs[5]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img26" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[5]['detail'][0]['photoUrl']))?$indexs[5]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn26"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName26" type="text" value="<?php echo (isset($indexs[5]['detail'][0]['relName']))?$indexs[5]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName26" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['relName']))?$indexs[5]['detail'][0]['relName']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*230px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template6.png" alt="">
	      </td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[6][id]" id="id" value="<?php echo (isset($indexs[6]['id']))?$indexs[6]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[6][sort]" id="sort" value="7">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[6][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[6]['templateName']))?$indexs[6]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[6][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[6]['forUrl']))?$indexs[6]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img27" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[6]['detail'][0]['photoUrl']))?$indexs[6]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn27"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName27" type="text" value="<?php echo (isset($indexs[6]['detail'][0]['relName']))?$indexs[6]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['relName']))?$indexs[6]['detail'][0]['relName']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*360px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img28" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[6]['detail'][1]['photoUrl']))?$indexs[6]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn28"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName28" type="text" value="<?php echo (isset($indexs[6]['detail'][1]['relName']))?$indexs[6]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName28" type="hidden" value="<?php echo (isset($indexs[6]['detail'][1]['relName']))?$indexs[6]['detail'][1]['relName']:'';?>" name="goodsIndexs[6][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(360*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img29" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[6]['detail'][2]['photoUrl']))?$indexs[6]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn29"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName29" type="text" value="<?php echo (isset($indexs[6]['detail'][2]['relName']))?$indexs[6]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName29" type="hidden" value="<?php echo (isset($indexs[6]['detail'][2]['relName']))?$indexs[6]['detail'][2]['relName']:'';?>" name="goodsIndexs[6][goodsIndexDetails][2][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(180*180px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img30" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[6]['detail'][3]['photoUrl']))?$indexs[6]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn30"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName30" type="text" value="<?php echo (isset($indexs[6]['detail'][3]['relName']))?$indexs[6]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName30" type="hidden" value="<?php echo (isset($indexs[6]['detail'][3]['relName']))?$indexs[6]['detail'][3]['relName']:'';?>" name="goodsIndexs[6][goodsIndexDetails][3][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(180*180px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template7.png" alt="">
	      </td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[7][id]" id="id" value="<?php echo (isset($indexs[7]['id']))?$indexs[7]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[7][sort]" id="sort" value="8">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[7][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[7]['templateName']))?$indexs[7]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[7][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[7]['forUrl']))?$indexs[7]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img31" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[7]['detail'][0]['photoUrl']))?$indexs[7]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn31"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName31" type="text" value="<?php echo (isset($indexs[7]['detail'][0]['relName']))?$indexs[7]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName31" type="hidden" value="<?php echo (isset($indexs[7]['detail'][0]['relName']))?$indexs[7]['detail'][0]['relName']:'';?>" name="goodsIndexs[7][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*230px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td style="width: 20%">
	      	
	      </td>
	      <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template8.png" alt="">
	      </td>
	    </tr>
	</tbody>
  	</table>
  </div>
<div class="control-group">
  	<table class="sui-table table-bordered-simple" style="margin-left: 10px;">
  	<tbody>
	    <tr>
	      <td colspan="5">
	      	<label for="inputEmail" class="control-label">子模板名称：</label>
		    <div class="controls">
		      <input type="hidden" name="goodsIndexs[8][id]" id="id" value="<?php echo (isset($indexs[8]['id']))?$indexs[8]['id']:'';?>">
		      <input type="hidden" name="goodsIndexs[8][sort]" id="sort" value="9">
		      <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[8][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[8]['templateName']))?$indexs[8]['templateName']:'';?>"  readonly="true">
		      <span class="required">*</span>
		    </div>
		    <label for="inputEmail" class="control-label">URL：</label>
		    <div class="controls">
		      <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[8][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[8]['forUrl']))?$indexs[8]['forUrl']:'';?>"  readonly="true">
		    </div>
	      </td>
	    </tr>
	    <tr>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img32" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[8]['detail'][0]['photoUrl']))?$indexs[8]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn32"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName32" type="text" value="<?php echo (isset($indexs[8]['detail'][0]['relName']))?$indexs[8]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName32" type="hidden" value="<?php echo (isset($indexs[8]['detail'][0]['relName']))?$indexs[8]['detail'][0]['relName']:'';?>" name="goodsIndexs[8][goodsIndexDetails][0][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img33" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[8]['detail'][1]['photoUrl']))?$indexs[8]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn33"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName33" type="text" value="<?php echo (isset($indexs[8]['detail'][1]['relName']))?$indexs[8]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName33" type="hidden" value="<?php echo (isset($indexs[8]['detail'][1]['relName']))?$indexs[8]['detail'][1]['relName']:'';?>" name="goodsIndexs[8][goodsIndexDetails][1][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img34" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[8]['detail'][2]['photoUrl']))?$indexs[8]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn34"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName34" type="text" value="<?php echo (isset($indexs[8]['detail'][2]['relName']))?$indexs[8]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName34" type="hidden" value="<?php echo (isset($indexs[8]['detail'][2]['relName']))?$indexs[8]['detail'][2]['relName']:'';?>" name="goodsIndexs[8][goodsIndexDetails][2][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
				
			</div>
	      </td>
	      <td style="width: 20%">
	      	<div style="width: 133px;">
	      		<img id="img35" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" src="<?php echo (isset($indexs[8]['detail'][3]['photoUrl']))?$indexs[8]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
	      		<div style="display: none;" id="upload_btn35"></div>
	      	</div>
	      	<div style="width: 133px;margin-bottom: -2px;">
	      		<input id="spanrelName35" type="text" value="<?php echo (isset($indexs[8]['detail'][3]['relName']))?$indexs[8]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置" readonly="true">
	      		<input id="relName35" type="hidden" value="<?php echo (isset($indexs[8]['detail'][3]['relName']))?$indexs[8]['detail'][3]['relName']:'';?>" name="goodsIndexs[8][goodsIndexDetails][3][relName]">
	      		<img align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;" src="<?php echo ASSETS_URL;?>images/default/update.png" readonly="true">
	      	</div>
	      	<div style="border: 1px solid #eaeaea;width:133px;">
				<span style="color: #ff9900;line-height:28px;"> 尺寸(720*230px)</span>
				
			</div>
	      </td>
	      <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
	      	<img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template9.png" alt="">
	      </td>
	    </tr>
	</tbody>
  	</table>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">关闭</a>
    </div>
  </div>
</form>
<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>