<ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'修改':'添加';?>模板</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
<?php if($id==1):?>
<form id="goodsindex-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="control-group">
        <label for="inputEmail" class="control-label">模板名称：</label>
        <div class="controls">
            <input type="hidden" name="id" id="id" value="<?php echo ($id)?$id:'';?>">
            <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
            <input type="text" class="input-xlarge input-xfat" id="templateName" name="templateName" placeholder="模板名称" data-rules="required" data-empty-msg="模板名称不能为空！"  value="<?php echo ($templateName)?$templateName:'';?>">
            <span class="required">*</span>
        </div>
        <label for="inputEmail" class="control-label">模板标识符：</label>
        <div class="controls">
            <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" placeholder="模板标识符" data-rules="required|identifier|identifiercheck" data-empty-msg="模板标识符不能为空！"  value="<?php echo ($identifier)?$identifier:'';?>">
            <span class="required">*</span>
        </div>
    </div>
    <div class="control-group">
        <label for="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  inputEmail" class="control-label">位置说明：</label>
        <div class="controls">
            <input type="text" class="input-xlarge input-xfat" id="description" name="description" placeholder="位置说明"  value="<?php echo ($description)?$description:'';?>">
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
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[0][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[0]['templateName']))?$indexs[0]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[0][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[0]['forUrl']))?$indexs[0]['forUrl']:'';?>">
                    </div>

                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[0]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[0]['status']<2?'checked':'' ?>  name="goodsIndexs[0][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[0]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[0]['status']==2?'checked':'' ?> name="goodsIndexs[0][status]" value="2"><span></span>禁用
                        </label>

                    </div>

                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img0" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('0','640','336');" src="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']) && !empty($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn0"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName0" type="text" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(0);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                        <input id="relId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relId']))?$indexs[0]['detail'][0]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['id']))?$indexs[0]['detail'][0]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['type']))?$indexs[0]['detail'][0]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['url']))?$indexs[0]['detail'][0]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img1" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('1','640','336');" src="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']) && !empty($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn1"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName1" type="text" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(1);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                        <input id="relId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relId']))?$indexs[0]['detail'][1]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['id']))?$indexs[0]['detail'][1]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['type']))?$indexs[0]['detail'][1]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['url']))?$indexs[0]['detail'][1]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img2" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('2','640','336');" src="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']) && !empty($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn2"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName2" type="text" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(2);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                        <input id="relId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relId']))?$indexs[0]['detail'][2]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['id']))?$indexs[0]['detail'][2]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['type']))?$indexs[0]['detail'][2]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['url']))?$indexs[0]['detail'][2]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img3" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('3','640','336');" src="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']) && !empty($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn3"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName3" type="text" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relName]">
                        <img onclick="actionUrl(3);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                        <input id="relId3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relId']))?$indexs[0]['detail'][3]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relId]" style="width: 120px;">
                        <input id="detailId3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['id']))?$indexs[0]['detail'][3]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][id]" style="width: 120px;">
                        <input id="type3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['type']))?$indexs[0]['detail'][3]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][type]" style="width: 120px;">
                        <input id="url3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['url']))?$indexs[0]['detail'][3]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][url]" style="width: 120px;">
                        <input id="photoUrl3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template1.png" alt="">
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
                        <input type="hidden" name="goodsIndexs[1][id]" id="id" value="<?php echo (isset($indexs[1]['id']))?$indexs[1]['id']:'';?>">
                        <input type="hidden" name="goodsIndexs[1][sort]" id="sort" value="2">
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[1][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[1]['templateName']))?$indexs[1]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[1][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[1]['forUrl']))?$indexs[1]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[1]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[1]['status']<2?'checked':'' ?>  name="goodsIndexs[1][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[1]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[1]['status']==2?'checked':'' ?> name="goodsIndexs[1][status]" value="2"><span></span>禁用
                        </label>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img5" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('5','150','150');" src="<?php echo (isset($indexs[1]['detail'][0]['photoUrl']) && !empty($indexs[1]['detail'][0]['photoUrl']))?$indexs[1]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn5"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName5" type="text" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(5);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['relId']))?$indexs[1]['detail'][0]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['id']))?$indexs[1]['detail'][0]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['type']))?$indexs[1]['detail'][0]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['url']))?$indexs[1]['detail'][0]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['photoUrl']))?$indexs[1]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img6" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('6','150','150');" src="<?php echo (isset($indexs[1]['detail'][1]['photoUrl']) && !empty($indexs[1]['detail'][1]['photoUrl']))?$indexs[1]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn6"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName6" type="text" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(6);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['relId']))?$indexs[1]['detail'][1]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['id']))?$indexs[1]['detail'][1]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['type']))?$indexs[1]['detail'][1]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['url']))?$indexs[1]['detail'][1]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['photoUrl']))?$indexs[1]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img7" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('7','150','150');" src="<?php echo (isset($indexs[1]['detail'][2]['photoUrl']) && !empty($indexs[1]['detail'][2]['photoUrl']))?$indexs[1]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn7"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName7" type="text" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(7);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['relId']))?$indexs[1]['detail'][2]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['id']))?$indexs[1]['detail'][2]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['type']))?$indexs[1]['detail'][2]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['url']))?$indexs[1]['detail'][2]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['photoUrl']))?$indexs[1]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img8" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('8','150','150');" src="<?php echo (isset($indexs[1]['detail'][3]['photoUrl']) && !empty($indexs[1]['detail'][3]['photoUrl']))?$indexs[1]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn8"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName8" type="text" value="<?php echo (isset($indexs[1]['detail'][3]['relName']))?$indexs[1]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['relName']))?$indexs[1]['detail'][3]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][relName]">
                        <img onclick="actionUrl(8);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['relId']))?$indexs[1]['detail'][3]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][relId]" style="width: 120px;">
                        <input id="detailId8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['id']))?$indexs[1]['detail'][3]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][id]" style="width: 120px;">
                        <input id="type8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['type']))?$indexs[1]['detail'][3]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][type]" style="width: 120px;">
                        <input id="url8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['url']))?$indexs[1]['detail'][3]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][url]" style="width: 120px;">
                        <input id="photoUrl8" type="hidden" value="<?php echo (isset($indexs[1]['detail'][3]['photoUrl']))?$indexs[1]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template2.png" alt="">
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img9" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('9','150','150');" src="<?php echo (isset($indexs[1]['detail'][4]['photoUrl']) && !empty($indexs[1]['detail'][4]['photoUrl']))?$indexs[1]['detail'][4]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn9"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName9" type="text" value="<?php echo (isset($indexs[1]['detail'][4]['relName']))?$indexs[1]['detail'][4]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['relName']))?$indexs[1]['detail'][4]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][relName]">
                        <img onclick="actionUrl(9);" align="right" value="" name="relName9" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['relId']))?$indexs[1]['detail'][4]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][relId]" style="width: 120px;">
                        <input id="detailId9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['id']))?$indexs[1]['detail'][4]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][id]" style="width: 120px;">
                        <input id="type9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['type']))?$indexs[1]['detail'][4]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][type]" style="width: 120px;">
                        <input id="url9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['url']))?$indexs[1]['detail'][4]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][url]" style="width: 120px;">
                        <input id="photoUrl9" type="hidden" value="<?php echo (isset($indexs[1]['detail'][4]['photoUrl']))?$indexs[1]['detail'][4]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][4][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img10" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('10','150','150');" src="<?php echo (isset($indexs[1]['detail'][5]['photoUrl']) && !empty($indexs[1]['detail'][5]['photoUrl']))?$indexs[1]['detail'][5]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn10"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName10" type="text" value="<?php echo (isset($indexs[1]['detail'][5]['relName']))?$indexs[1]['detail'][5]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['relName']))?$indexs[1]['detail'][5]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][relName]">
                        <img onclick="actionUrl(10);" align="right" value="" name="relName10" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['relId']))?$indexs[1]['detail'][5]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][relId]" style="width: 120px;">
                        <input id="detailId10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['id']))?$indexs[1]['detail'][5]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][id]" style="width: 120px;">
                        <input id="type10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['type']))?$indexs[1]['detail'][5]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][type]" style="width: 120px;">
                        <input id="url10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['url']))?$indexs[1]['detail'][5]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][url]" style="width: 120px;">
                        <input id="photoUrl10" type="hidden" value="<?php echo (isset($indexs[1]['detail'][5]['photoUrl']))?$indexs[1]['detail'][5]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][5][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img11" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('11','150','150');" src="<?php echo (isset($indexs[1]['detail'][6]['photoUrl']) && !empty($indexs[1]['detail'][6]['photoUrl']))?$indexs[1]['detail'][6]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn11"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName11" type="text" value="<?php echo (isset($indexs[1]['detail'][6]['relName']))?$indexs[1]['detail'][6]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['relName']))?$indexs[1]['detail'][6]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][relName]">
                        <img onclick="actionUrl(11);" align="right" value="" name="relName11" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['relId']))?$indexs[1]['detail'][6]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][relId]" style="width: 120px;">
                        <input id="detailId11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['id']))?$indexs[1]['detail'][6]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][id]" style="width: 120px;">
                        <input id="type11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['type']))?$indexs[1]['detail'][6]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][type]" style="width: 120px;">
                        <input id="url11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['url']))?$indexs[1]['detail'][6]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][url]" style="width: 120px;">
                        <input id="photoUrl11" type="hidden" value="<?php echo (isset($indexs[1]['detail'][6]['photoUrl']))?$indexs[1]['detail'][6]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][6][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img12" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('12','150','150');" src="<?php echo (isset($indexs[1]['detail'][7]['photoUrl']) && !empty($indexs[1]['detail'][7]['photoUrl']))?$indexs[1]['detail'][7]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn12"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName12" type="text" value="<?php echo (isset($indexs[1]['detail'][7]['relName']))?$indexs[1]['detail'][7]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['relName']))?$indexs[1]['detail'][7]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][relName]">
                        <img onclick="actionUrl(12);" align="right" value="" name="relName12" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(150*150px)</span>
                        <input id="relId12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['relId']))?$indexs[1]['detail'][7]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][relId]" style="width: 120px;">
                        <input id="detailId12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['id']))?$indexs[1]['detail'][7]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][id]" style="width: 120px;">
                        <input id="type12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['type']))?$indexs[1]['detail'][7]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][type]" style="width: 120px;">
                        <input id="url12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['url']))?$indexs[1]['detail'][7]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][url]" style="width: 120px;">
                        <input id="photoUrl12" type="hidden" value="<?php echo (isset($indexs[1]['detail'][7]['photoUrl']))?$indexs[1]['detail'][7]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][7][photoUrl]" style="width: 120px;">
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
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[2][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[2]['templateName']))?$indexs[2]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[2][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[2]['forUrl']))?$indexs[2]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[2]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[2]['status']<2?'checked':'' ?>  name="goodsIndexs[2][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[2]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[2]['status']==2?'checked':'' ?> name="goodsIndexs[2][status]" value="2"><span></span>禁用
                        </label>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img13" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('13','240','350');" src="<?php echo (isset($indexs[2]['detail'][0]['photoUrl']) && !empty($indexs[2]['detail'][0]['photoUrl']))?$indexs[2]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn13"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName13" type="text" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(13);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
                        <input id="relId13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['relId']))?$indexs[2]['detail'][0]['relId']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['id']))?$indexs[2]['detail'][0]['id']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['type']))?$indexs[2]['detail'][0]['type']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['url']))?$indexs[2]['detail'][0]['url']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['photoUrl']))?$indexs[2]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img14" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('14','240','350');" src="<?php echo (isset($indexs[2]['detail'][1]['photoUrl']) && !empty($indexs[2]['detail'][1]['photoUrl']))?$indexs[2]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn14"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName14" type="text" value="<?php echo (isset($indexs[2]['detail'][1]['relName']))?$indexs[2]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['relName']))?$indexs[2]['detail'][1]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(14);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
                        <input id="relId14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['relId']))?$indexs[2]['detail'][1]['relId']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['id']))?$indexs[2]['detail'][1]['id']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['type']))?$indexs[2]['detail'][1]['type']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['url']))?$indexs[2]['detail'][1]['url']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl14" type="hidden" value="<?php echo (isset($indexs[2]['detail'][1]['photoUrl']))?$indexs[2]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[2][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img15" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('15','240','350');" src="<?php echo (isset($indexs[2]['detail'][2]['photoUrl']) && !empty($indexs[2]['detail'][2]['photoUrl']))?$indexs[2]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn15"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName15" type="text" value="<?php echo (isset($indexs[2]['detail'][2]['relName']))?$indexs[2]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['relName']))?$indexs[2]['detail'][2]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(15);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(240*350px)</span>
                        <input id="relId15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['relId']))?$indexs[2]['detail'][2]['relId']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['id']))?$indexs[2]['detail'][2]['id']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['type']))?$indexs[2]['detail'][2]['type']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['url']))?$indexs[2]['detail'][2]['url']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl15" type="hidden" value="<?php echo (isset($indexs[2]['detail'][2]['photoUrl']))?$indexs[2]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[2][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img16" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('16','640','180');" src="<?php echo (isset($indexs[2]['detail'][3]['photoUrl']) && !empty($indexs[2]['detail'][3]['photoUrl']))?$indexs[2]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn16"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName16" type="text" value="<?php echo (isset($indexs[2]['detail'][3]['relName']))?$indexs[2]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['relName']))?$indexs[2]['detail'][3]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][relName]">
                        <img onclick="actionUrl(16);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*180px)</span>
                        <input id="relId16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['relId']))?$indexs[2]['detail'][3]['relId']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][relId]" style="width: 120px;">
                        <input id="detailId16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['id']))?$indexs[2]['detail'][3]['id']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][id]" style="width: 120px;">
                        <input id="type16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['type']))?$indexs[2]['detail'][3]['type']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][type]" style="width: 120px;">
                        <input id="url16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['url']))?$indexs[2]['detail'][3]['url']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][url]" style="width: 120px;">
                        <input id="photoUrl16" type="hidden" value="<?php echo (isset($indexs[2]['detail'][3]['photoUrl']))?$indexs[2]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[2][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template9.png" alt="">
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
                        <input type="hidden" name="goodsIndexs[3][id]" id="id" value="<?php echo (isset($indexs[3]['id']))?$indexs[3]['id']:'';?>">
                        <input type="hidden" name="goodsIndexs[3][sort]" id="sort" value="4">
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[3][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[3]['templateName']))?$indexs[3]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[3][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[3]['forUrl']))?$indexs[3]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[3]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[3]['status']<2?'checked':'' ?>  name="goodsIndexs[3][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[3]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[3]['status']==2?'checked':'' ?> name="goodsIndexs[3][status]" value="2"><span></span>禁用
                        </label>

                    </div>

                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img18" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('18','320','400');" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']) && !empty($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn18"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName18" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(18);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*400px)</span>
                        <input id="relId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relId']))?$indexs[3]['detail'][0]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['id']))?$indexs[3]['detail'][0]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['type']))?$indexs[3]['detail'][0]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['url']))?$indexs[3]['detail'][0]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img19" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('19','320','240');" src="<?php echo (isset($indexs[3]['detail'][1]['photoUrl']) && !empty($indexs[3]['detail'][1]['photoUrl']))?$indexs[3]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn19"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName19" type="text" value="<?php echo (isset($indexs[3]['detail'][1]['relName']))?$indexs[3]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['relName']))?$indexs[3]['detail'][1]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(19);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*240px)</span>
                        <input id="relId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['relId']))?$indexs[3]['detail'][1]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['id']))?$indexs[3]['detail'][1]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['type']))?$indexs[3]['detail'][1]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['url']))?$indexs[3]['detail'][1]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['photoUrl']))?$indexs[3]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img20" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('20','160','160');" src="<?php echo (isset($indexs[3]['detail'][2]['photoUrl']) && !empty($indexs[3]['detail'][2]['photoUrl']))?$indexs[3]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn20"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName20" type="text" value="<?php echo (isset($indexs[3]['detail'][2]['relName']))?$indexs[3]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['relName']))?$indexs[3]['detail'][2]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(20);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(160*160px)</span>
                        <input id="relId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['relId']))?$indexs[3]['detail'][2]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['id']))?$indexs[3]['detail'][2]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['type']))?$indexs[3]['detail'][2]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['url']))?$indexs[3]['detail'][2]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['photoUrl']))?$indexs[3]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img21" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('21','160','160');" src="<?php echo (isset($indexs[3]['detail'][3]['photoUrl']) && !empty($indexs[3]['detail'][3]['photoUrl']))?$indexs[3]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn21"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName21" type="text" value="<?php echo (isset($indexs[3]['detail'][3]['relName']))?$indexs[3]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['relName']))?$indexs[3]['detail'][3]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][relName]">
                        <img onclick="actionUrl(21);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(160*160px)</span>
                        <input id="relId21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['relId']))?$indexs[3]['detail'][3]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][relId]" style="width: 120px;">
                        <input id="detailId21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['id']))?$indexs[3]['detail'][3]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][id]" style="width: 120px;">
                        <input id="type21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['type']))?$indexs[3]['detail'][3]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][type]" style="width: 120px;">
                        <input id="url21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['url']))?$indexs[3]['detail'][3]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][url]" style="width: 120px;">
                        <input id="photoUrl21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['photoUrl']))?$indexs[3]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
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
                        <input type="hidden" name="goodsIndexs[4][id]" id="id" value="<?php echo (isset($indexs[4]['id']))?$indexs[4]['id']:'';?>">
                        <input type="hidden" name="goodsIndexs[4][sort]" id="sort" value="5">
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[4][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[4]['templateName']))?$indexs[4]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[4][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[4]['forUrl']))?$indexs[4]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[4]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[4]['status']<2?'checked':'' ?>  name="goodsIndexs[4][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[4]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[4]['status']==2?'checked':'' ?> name="goodsIndexs[4][status]" value="2"><span></span>禁用
                        </label>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img22" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('22','640','200');" src="<?php echo (isset($indexs[4]['detail'][0]['photoUrl']) && !empty($indexs[4]['detail'][0]['photoUrl']))?$indexs[4]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn22"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName22" type="text" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(22);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['relId']))?$indexs[4]['detail'][0]['relId']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['id']))?$indexs[4]['detail'][0]['id']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['type']))?$indexs[4]['detail'][0]['type']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['url']))?$indexs[4]['detail'][0]['url']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['photoUrl']))?$indexs[4]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">

                </td>
                <td style="width: 20%">

                </td>
                <td style="width: 20%">

                </td>
                <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
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
                        <input type="hidden" name="goodsIndexs[5][id]" id="id" value="<?php echo (isset($indexs[5]['id']))?$indexs[5]['id']:'';?>">
                        <input type="hidden" name="goodsIndexs[5][sort]" id="sort" value="6">
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[5][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[5]['templateName']))?$indexs[5]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[5][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[5]['forUrl']))?$indexs[5]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[5]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[5]['status']<2?'checked':'' ?>  name="goodsIndexs[5][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[5]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[5]['status']==2?'checked':'' ?> name="goodsIndexs[5][status]" value="2"><span></span>禁用
                        </label>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img23" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('23','320','320');" src="<?php echo (isset($indexs[5]['detail'][0]['photoUrl']) && !empty($indexs[5]['detail'][0]['photoUrl']))?$indexs[5]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn23"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName23" type="text" value="<?php echo (isset($indexs[5]['detail'][0]['relName']))?$indexs[5]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['relName']))?$indexs[5]['detail'][0]['relName']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(23);" align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*320px)</span>
                        <input id="relId23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['relId']))?$indexs[5]['detail'][0]['relId']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['id']))?$indexs[5]['detail'][0]['id']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['type']))?$indexs[5]['detail'][0]['type']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['url']))?$indexs[5]['detail'][0]['url']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl23" type="hidden" value="<?php echo (isset($indexs[5]['detail'][0]['photoUrl']))?$indexs[5]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[5][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img24" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('24','320','160');" src="<?php echo (isset($indexs[5]['detail'][1]['photoUrl']) && !empty($indexs[5]['detail'][1]['photoUrl']))?$indexs[5]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn24"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName24" type="text" value="<?php echo (isset($indexs[5]['detail'][1]['relName']))?$indexs[5]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['relName']))?$indexs[5]['detail'][1]['relName']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(24);" align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*160px)</span>
                        <input id="relId24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['relId']))?$indexs[5]['detail'][1]['relId']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['id']))?$indexs[5]['detail'][1]['id']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['type']))?$indexs[5]['detail'][1]['type']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['url']))?$indexs[5]['detail'][1]['url']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl24" type="hidden" value="<?php echo (isset($indexs[5]['detail'][1]['photoUrl']))?$indexs[5]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[5][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img25" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('25','320','160');" src="<?php echo (isset($indexs[5]['detail'][2]['photoUrl']) && !empty($indexs[5]['detail'][2]['photoUrl']))?$indexs[5]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn25"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName25" type="text" value="<?php echo (isset($indexs[5]['detail'][2]['relName']))?$indexs[5]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['relName']))?$indexs[5]['detail'][2]['relName']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(25);" align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*160px)</span>
                        <input id="relId25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['relId']))?$indexs[5]['detail'][2]['relId']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['id']))?$indexs[5]['detail'][2]['id']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['type']))?$indexs[5]['detail'][2]['type']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['url']))?$indexs[5]['detail'][2]['url']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl25" type="hidden" value="<?php echo (isset($indexs[5]['detail'][2]['photoUrl']))?$indexs[5]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[5][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">

                </td>
                <td valign="middle" rowspan="1" class="center" style="border-left: 1px solid #e6e6e6;">
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template3.png" alt="">
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
                        <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[6][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[6]['templateName']))?$indexs[6]['templateName']:'';?>">
                        <span class="required">*</span>
                    </div>
                    <label for="inputEmail" class="control-label">URL：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[6][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[6]['forUrl']))?$indexs[6]['forUrl']:'';?>">
                    </div>
                    <label for="inputEmail" class="control-label">模板状态：</label>
                    <div class="controls">
                        <label class="radio-pretty inline <?php echo $indexs[6]['status']<2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[6]['status']<2?'checked':'' ?>  name="goodsIndexs[6][status]" value="1"><span></span>正常
                        </label>
                        <label class="radio-pretty inline <?php echo $indexs[6]['status']==2?'checked':'' ?>">
                            <input type="radio" <?php echo $indexs[6]['status']==2?'checked':'' ?> name="goodsIndexs[6][status]" value="2"><span></span>禁用
                        </label>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img27" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('27','640','200');" src="<?php echo (isset($indexs[6]['detail'][0]['photoUrl']) && !empty($indexs[6]['detail'][0]['photoUrl']))?$indexs[6]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn27"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName27" type="text" value="<?php echo (isset($indexs[6]['detail'][0]['relName']))?$indexs[6]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['relName']))?$indexs[6]['detail'][0]['relName']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(27);" align="right" value="" name="relName" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['relId']))?$indexs[6]['detail'][0]['relId']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['id']))?$indexs[6]['detail'][0]['id']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['type']))?$indexs[6]['detail'][0]['type']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['url']))?$indexs[6]['detail'][0]['url']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl27" type="hidden" value="<?php echo (isset($indexs[6]['detail'][0]['photoUrl']))?$indexs[6]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[6][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
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
        <label class="control-label"></label>
        <div class="controls">
            <button type="submit" class="sui-btn btn-xlarge btn-primary">保存</button>
        </div>
    </div>
</form>

<?php else:?>
    <form id="goodsindex-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
        <div class="control-group">
            <label for="inputEmail" class="control-label">模板名称：</label>
            <div class="controls">
                <input type="hidden" name="id" id="id" value="<?php echo ($id)?$id:'';?>">
                <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
                <input type="text" class="input-xlarge input-xfat" id="templateName" name="templateName" placeholder="模板名称" data-rules="required" data-empty-msg="模板名称不能为空！"  value="<?php echo ($templateName)?$templateName:'';?>">
                <span class="required">*</span>
            </div>
            <label for="inputEmail" class="control-label">模板标识符：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="identifier" name="identifier" placeholder="模板标识符" data-rules="required|identifier|identifiercheck" data-empty-msg="模板标识符不能为空！"  value="<?php echo ($identifier)?$identifier:'';?>">
                <span class="required">*</span>
            </div>
        </div>
        <div class="control-group">
            <label for="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  inputEmail" class="control-label">位置说明：</label>
            <div class="controls">
                <input type="text" class="input-xlarge input-xfat" id="description" name="description" placeholder="位置说明"  value="<?php echo ($description)?$description:'';?>">
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
                            <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[0][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[0]['templateName']))?$indexs[0]['templateName']:'';?>">
                            <span class="required">*</span>
                        </div>
                        <label for="inputEmail" class="control-label">URL：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[0][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[0]['forUrl']))?$indexs[0]['forUrl']:'';?>">
                        </div>

                        <label for="inputEmail" class="control-label">模板状态：</label>
                        <div class="controls">
                            <label class="radio-pretty inline <?php echo $indexs[0]['status']<2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[0]['status']<2?'checked':'' ?>  name="goodsIndexs[0][status]" value="1"><span></span>正常
                            </label>
                            <label class="radio-pretty inline <?php echo $indexs[0]['status']==2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[0]['status']==2?'checked':'' ?> name="goodsIndexs[0][status]" value="2"><span></span>禁用
                            </label>

                        </div>

                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img0" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('0','640','336');" src="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']) && !empty($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn0"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName0" type="text" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relName]">
                            <img onclick="actionUrl(0);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                            <input id="relId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relId']))?$indexs[0]['detail'][0]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relId]" style="width: 120px;">
                            <input id="detailId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['id']))?$indexs[0]['detail'][0]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][id]" style="width: 120px;">
                            <input id="type0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['type']))?$indexs[0]['detail'][0]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][type]" style="width: 120px;">
                            <input id="url0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['url']))?$indexs[0]['detail'][0]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][url]" style="width: 120px;">
                            <input id="photoUrl0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img1" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('1','640','336');" src="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']) && !empty($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn1"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName1" type="text" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relName]">
                            <img onclick="actionUrl(1);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                            <input id="relId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relId']))?$indexs[0]['detail'][1]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relId]" style="width: 120px;">
                            <input id="detailId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['id']))?$indexs[0]['detail'][1]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][id]" style="width: 120px;">
                            <input id="type1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['type']))?$indexs[0]['detail'][1]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][type]" style="width: 120px;">
                            <input id="url1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['url']))?$indexs[0]['detail'][1]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][url]" style="width: 120px;">
                            <input id="photoUrl1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img2" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('2','640','336');" src="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']) && !empty($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn2"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName2" type="text" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relName]">
                            <img onclick="actionUrl(2);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                            <input id="relId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relId']))?$indexs[0]['detail'][2]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relId]" style="width: 120px;">
                            <input id="detailId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['id']))?$indexs[0]['detail'][2]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][id]" style="width: 120px;">
                            <input id="type2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['type']))?$indexs[0]['detail'][2]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][type]" style="width: 120px;">
                            <input id="url2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['url']))?$indexs[0]['detail'][2]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][url]" style="width: 120px;">
                            <input id="photoUrl2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img3" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('3','640','336');" src="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']) && !empty($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn3"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName3" type="text" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relName]">
                            <img onclick="actionUrl(3);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*336px)</span>
                            <input id="relId3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relId']))?$indexs[0]['detail'][3]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relId]" style="width: 120px;">
                            <input id="detailId3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['id']))?$indexs[0]['detail'][3]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][id]" style="width: 120px;">
                            <input id="type3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['type']))?$indexs[0]['detail'][3]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][type]" style="width: 120px;">
                            <input id="url3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['url']))?$indexs[0]['detail'][3]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][url]" style="width: 120px;">
                            <input id="photoUrl3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                        <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template1.png" alt="">
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
                            <input type="hidden" name="goodsIndexs[1][id]" id="id" value="<?php echo (isset($indexs[1]['id']))?$indexs[1]['id']:'';?>">
                            <input type="hidden" name="goodsIndexs[1][sort]" id="sort" value="2">
                            <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[1][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[1]['templateName']))?$indexs[1]['templateName']:'';?>">
                            <span class="required">*</span>
                        </div>
                        <label for="inputEmail" class="control-label">URL：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[1][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[1]['forUrl']))?$indexs[1]['forUrl']:'';?>">
                        </div>
                        <label for="inputEmail" class="control-label">模板状态：</label>
                        <div class="controls">
                            <label class="radio-pretty inline <?php echo $indexs[1]['status']<2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[1]['status']<2?'checked':'' ?>  name="goodsIndexs[1][status]" value="1"><span></span>正常
                            </label>
                            <label class="radio-pretty inline <?php echo $indexs[1]['status']==2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[1]['status']==2?'checked':'' ?> name="goodsIndexs[1][status]" value="2"><span></span>禁用
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img5" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('5','220','220');" src="<?php echo (isset($indexs[1]['detail'][0]['photoUrl']) && !empty($indexs[1]['detail'][0]['photoUrl']))?$indexs[1]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn5"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName5" type="text" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['relName']))?$indexs[1]['detail'][0]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][relName]">
                            <img onclick="actionUrl(5);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(220*220px)</span>
                            <input id="relId5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['relId']))?$indexs[1]['detail'][0]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][relId]" style="width: 120px;">
                            <input id="detailId5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['id']))?$indexs[1]['detail'][0]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][id]" style="width: 120px;">
                            <input id="type5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['type']))?$indexs[1]['detail'][0]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][type]" style="width: 120px;">
                            <input id="url5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['url']))?$indexs[1]['detail'][0]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][url]" style="width: 120px;">
                            <input id="photoUrl5" type="hidden" value="<?php echo (isset($indexs[1]['detail'][0]['photoUrl']))?$indexs[1]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img6" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('6','220','220');" src="<?php echo (isset($indexs[1]['detail'][1]['photoUrl']) && !empty($indexs[1]['detail'][1]['photoUrl']))?$indexs[1]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn6"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName6" type="text" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['relName']))?$indexs[1]['detail'][1]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][relName]">
                            <img onclick="actionUrl(6);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(220*220px)</span>
                            <input id="relId6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['relId']))?$indexs[1]['detail'][1]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][relId]" style="width: 120px;">
                            <input id="detailId6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['id']))?$indexs[1]['detail'][1]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][id]" style="width: 120px;">
                            <input id="type6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['type']))?$indexs[1]['detail'][1]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][type]" style="width: 120px;">
                            <input id="url6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['url']))?$indexs[1]['detail'][1]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][url]" style="width: 120px;">
                            <input id="photoUrl6" type="hidden" value="<?php echo (isset($indexs[1]['detail'][1]['photoUrl']))?$indexs[1]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img7" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('7','220','220');" src="<?php echo (isset($indexs[1]['detail'][2]['photoUrl']) && !empty($indexs[1]['detail'][2]['photoUrl']))?$indexs[1]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn7"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName7" type="text" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['relName']))?$indexs[1]['detail'][2]['relName']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][relName]">
                            <img onclick="actionUrl(7);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(220*220px)</span>
                            <input id="relId7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['relId']))?$indexs[1]['detail'][2]['relId']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][relId]" style="width: 120px;">
                            <input id="detailId7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['id']))?$indexs[1]['detail'][2]['id']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][id]" style="width: 120px;">
                            <input id="type7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['type']))?$indexs[1]['detail'][2]['type']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][type]" style="width: 120px;">
                            <input id="url7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['url']))?$indexs[1]['detail'][2]['url']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][url]" style="width: 120px;">
                            <input id="photoUrl7" type="hidden" value="<?php echo (isset($indexs[1]['detail'][2]['photoUrl']))?$indexs[1]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[1][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">

                    </td>
                    <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                        <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template10.png" alt="">
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
                            <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[2][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[2]['templateName']))?$indexs[2]['templateName']:'';?>">
                            <span class="required">*</span>
                        </div>
                        <label for="inputEmail" class="control-label">URL：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[2][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[2]['forUrl']))?$indexs[2]['forUrl']:'';?>">
                        </div>
                        <label for="inputEmail" class="control-label">模板状态：</label>
                        <div class="controls">
                            <label class="radio-pretty inline <?php echo $indexs[2]['status']<2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[2]['status']<2?'checked':'' ?>  name="goodsIndexs[2][status]" value="1"><span></span>正常
                            </label>
                            <label class="radio-pretty inline <?php echo $indexs[2]['status']==2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[2]['status']==2?'checked':'' ?> name="goodsIndexs[2][status]" value="2"><span></span>禁用
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img13" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('13','640','200');" src="<?php echo (isset($indexs[2]['detail'][0]['photoUrl']) && !empty($indexs[2]['detail'][0]['photoUrl']))?$indexs[2]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn13"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName13" type="text" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['relName']))?$indexs[2]['detail'][0]['relName']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][relName]">
                            <img onclick="actionUrl(13);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                            <input id="relId13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['relId']))?$indexs[2]['detail'][0]['relId']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][relId]" style="width: 120px;">
                            <input id="detailId13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['id']))?$indexs[2]['detail'][0]['id']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][id]" style="width: 120px;">
                            <input id="type13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['type']))?$indexs[2]['detail'][0]['type']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][type]" style="width: 120px;">
                            <input id="url13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['url']))?$indexs[2]['detail'][0]['url']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][url]" style="width: 120px;">
                            <input id="photoUrl13" type="hidden" value="<?php echo (isset($indexs[2]['detail'][0]['photoUrl']))?$indexs[2]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[2][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">

                    </td>
                    <td style="width: 20%">

                    </td>
                    <td style="width: 20%">

                    </td>
                    <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
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
                            <input type="hidden" name="goodsIndexs[3][id]" id="id" value="<?php echo (isset($indexs[3]['id']))?$indexs[3]['id']:'';?>">
                            <input type="hidden" name="goodsIndexs[3][sort]" id="sort" value="4">
                            <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[3][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[3]['templateName']))?$indexs[3]['templateName']:'';?>">
                            <span class="required">*</span>
                        </div>
                        <label for="inputEmail" class="control-label">URL：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[3][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[3]['forUrl']))?$indexs[3]['forUrl']:'';?>">
                        </div>
                        <label for="inputEmail" class="control-label">模板状态：</label>
                        <div class="controls">
                            <label class="radio-pretty inline <?php echo $indexs[3]['status']<2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[3]['status']<2?'checked':'' ?>  name="goodsIndexs[3][status]" value="1"><span></span>正常
                            </label>
                            <label class="radio-pretty inline <?php echo $indexs[3]['status']==2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[3]['status']==2?'checked':'' ?> name="goodsIndexs[3][status]" value="2"><span></span>禁用
                            </label>

                        </div>

                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img18" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('18','320','400');" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']) && !empty($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn18"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName18" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
                            <img onclick="actionUrl(18);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(240*400px)</span>
                            <input id="relId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relId']))?$indexs[3]['detail'][0]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relId]" style="width: 120px;">
                            <input id="detailId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['id']))?$indexs[3]['detail'][0]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][id]" style="width: 120px;">
                            <input id="type18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['type']))?$indexs[3]['detail'][0]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][type]" style="width: 120px;">
                            <input id="url18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['url']))?$indexs[3]['detail'][0]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][url]" style="width: 120px;">
                            <input id="photoUrl18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img19" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('19','320','240');" src="<?php echo (isset($indexs[3]['detail'][1]['photoUrl']) && !empty($indexs[3]['detail'][1]['photoUrl']))?$indexs[3]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn19"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName19" type="text" value="<?php echo (isset($indexs[3]['detail'][1]['relName']))?$indexs[3]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['relName']))?$indexs[3]['detail'][1]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][relName]">
                            <img onclick="actionUrl(19);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(320*240px)</span>
                            <input id="relId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['relId']))?$indexs[3]['detail'][1]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][relId]" style="width: 120px;">
                            <input id="detailId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['id']))?$indexs[3]['detail'][1]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][id]" style="width: 120px;">
                            <input id="type19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['type']))?$indexs[3]['detail'][1]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][type]" style="width: 120px;">
                            <input id="url19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['url']))?$indexs[3]['detail'][1]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][url]" style="width: 120px;">
                            <input id="photoUrl19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][1]['photoUrl']))?$indexs[3]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img20" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('20','160','160');" src="<?php echo (isset($indexs[3]['detail'][2]['photoUrl']) && !empty($indexs[3]['detail'][2]['photoUrl']))?$indexs[3]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn20"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName20" type="text" value="<?php echo (isset($indexs[3]['detail'][2]['relName']))?$indexs[3]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['relName']))?$indexs[3]['detail'][2]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][relName]">
                            <img onclick="actionUrl(20);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(160*160px)</span>
                            <input id="relId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['relId']))?$indexs[3]['detail'][2]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][relId]" style="width: 120px;">
                            <input id="detailId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['id']))?$indexs[3]['detail'][2]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][id]" style="width: 120px;">
                            <input id="type20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['type']))?$indexs[3]['detail'][2]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][type]" style="width: 120px;">
                            <input id="url20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['url']))?$indexs[3]['detail'][2]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][url]" style="width: 120px;">
                            <input id="photoUrl20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][2]['photoUrl']))?$indexs[3]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img21" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('21','160','160');" src="<?php echo (isset($indexs[3]['detail'][3]['photoUrl']) && !empty($indexs[3]['detail'][3]['photoUrl']))?$indexs[3]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn21"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName21" type="text" value="<?php echo (isset($indexs[3]['detail'][3]['relName']))?$indexs[3]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['relName']))?$indexs[3]['detail'][3]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][relName]">
                            <img onclick="actionUrl(21);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(160*160px)</span>
                            <input id="relId21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['relId']))?$indexs[3]['detail'][3]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][relId]" style="width: 120px;">
                            <input id="detailId21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['id']))?$indexs[3]['detail'][3]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][id]" style="width: 120px;">
                            <input id="type21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['type']))?$indexs[3]['detail'][3]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][type]" style="width: 120px;">
                            <input id="url21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['url']))?$indexs[3]['detail'][3]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][url]" style="width: 120px;">
                            <input id="photoUrl21" type="hidden" value="<?php echo (isset($indexs[3]['detail'][3]['photoUrl']))?$indexs[3]['detail'][3]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][3][photoUrl]" style="width: 120px;">
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
                            <input type="hidden" name="goodsIndexs[4][id]" id="id" value="<?php echo (isset($indexs[4]['id']))?$indexs[4]['id']:'';?>">
                            <input type="hidden" name="goodsIndexs[4][sort]" id="sort" value="5">
                            <input type="text" class="input-xlarge input-xfat" id="templateName" name="goodsIndexs[4][templateName]" placeholder="子模板名称" data-rules="required" data-empty-msg="子模板名称不能为空！"  value="<?php echo (isset($indexs[4]['templateName']))?$indexs[4]['templateName']:'';?>">
                            <span class="required">*</span>
                        </div>
                        <label for="inputEmail" class="control-label">URL：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge input-xfat" id="forUrl" name="goodsIndexs[4][forUrl]" placeholder="请输入网址"  value="<?php echo (isset($indexs[4]['forUrl']))?$indexs[4]['forUrl']:'';?>">
                        </div>
                        <label for="inputEmail" class="control-label">模板状态：</label>
                        <div class="controls">
                            <label class="radio-pretty inline <?php echo $indexs[4]['status']<2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[4]['status']<2?'checked':'' ?>  name="goodsIndexs[4][status]" value="1"><span></span>正常
                            </label>
                            <label class="radio-pretty inline <?php echo $indexs[4]['status']==2?'checked':'' ?>">
                                <input type="radio" <?php echo $indexs[4]['status']==2?'checked':'' ?> name="goodsIndexs[4][status]" value="2"><span></span>禁用
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>

                    <td style="width: 20%">
                        <div style="width: 133px;">
                            <img id="img22" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('22','640','200');" src="<?php echo (isset($indexs[4]['detail'][0]['photoUrl']) && !empty($indexs[4]['detail'][0]['photoUrl']))?$indexs[4]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                            <div style="display: none;" id="upload_btn22"></div>
                        </div>
                        <div style="width: 133px;margin-bottom: -2px;">
                            <input id="spanrelName22" type="text" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                            <input id="relName22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['relName']))?$indexs[4]['detail'][0]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][relName]">
                            <img onclick="actionUrl(22);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                        </div>
                        <div style="border: 1px solid #eaeaea;width:133px;">
                            <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                            <input id="relId22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['relId']))?$indexs[4]['detail'][0]['relId']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][relId]" style="width: 120px;">
                            <input id="detailId22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['id']))?$indexs[4]['detail'][0]['id']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][id]" style="width: 120px;">
                            <input id="type22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['type']))?$indexs[4]['detail'][0]['type']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][type]" style="width: 120px;">
                            <input id="url22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['url']))?$indexs[4]['detail'][0]['url']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][url]" style="width: 120px;">
                            <input id="photoUrl22" type="hidden" value="<?php echo (isset($indexs[4]['detail'][0]['photoUrl']))?$indexs[4]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[4][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                        </div>
                    </td>
                    <td style="width: 20%">

                    </td>
                    <td style="width: 20%">

                    </td>
                    <td style="width: 20%">

                    </td>
                    <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                        <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template8.png" alt="">
                    </td>
                </tr>

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
<?php endif;?>
<?php echo assets::$jcrop;?>
<?php echo assets::$sayimo; ?>
<script language="javascript" type="text/javascript">
    $(function(){
        var _opts = {};
        _opts.url = OO._SRVPATH + 'goodsindex/save';
        SAYIMO.form.init('#goodsindex-form', _opts);

        SAYIMO.form.rule('identifier',{opt:'isennumxhx'},'主模板标识符只能由英文，数字或下划线组成');
        SAYIMO.form.rule('identifiercheck',{opt:'remote',name: 'identifier', url: 'goodsindex/checkexist'},'主模板标识符已存在');
    });
    function uploadImg(b,w,h){
        var ratio = w/h;
        /**
         * [图片裁剪上传]
         */
        $('#upload_btn'+b).J_jcorp({
            'filePath':'<?php echo OTHERIMGPATH;?>',
            'imagePath':'<?php echo OTHERIMGURL;?>',
            'aspectRatio': ratio,//裁剪宽高比
            'maxSize': [w,h],//裁剪最大尺寸 [width,height]
            'minSize': [w,h],//裁剪最小尺寸 [width,height]
            'picSize': [w,h],//最终保存图片尺寸 [width,height]
            'quality': 1,//裁剪完后图片压缩比例
            'AjaxData': ['<?php echo RES_SER;?>','json'],// [0,1] 0:接口地址 1:dataType(json，jsonp)(必填项)
            'callback': function(s,data){//接口成功回调
                $('#img'+b).attr('src',data.data[0].photoUrl);
                $('#photoUrl'+b).val(data.data[0].photoUrl);
            }
        });
        $('#upload_btn'+b).click();
    }
    function actionUrl(n){

        var relId = $('#relId'+n).val();
        var type = $('#type'+n).val();
        var url = $('#url'+n).val();
        $.confirm({
            title:'选择',
            body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
            remote:OO._SRVPATH+'goodsindex/actionurl?relId='+relId+'&type='+type+'&url='+encodeURIComponent(url),
            width: '700px',
            height: '400px',
            okHide: function() {
                var type = $("input[name='actionurltype']:checked").val();
                var actionrelId = $("#actionrelId").val();
                var actionurl = $("#actionurl").val();
                var actionrelName = $("#actionrelName").val();
                if(type==3){
                    $('#spanrelName'+n).val(actionurl);
                    $('#relName'+n).val(actionurl);
                    $('#relId'+n).val(actionrelId);
                    $('#url'+n).val(actionurl);
                }else{
                    $('#spanrelName'+n).val(actionrelName);
                    $('#relName'+n).val(actionrelName);
                    $('#relId'+n).val(actionrelId);
                    $('#url'+n).val('');
                }
                $('#type'+n).val(type);
            }
        });

    }
</script>