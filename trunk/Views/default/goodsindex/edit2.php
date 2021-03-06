<ul class="sui-breadcrumb">
    <li><a><?php echo ($id)?'修改':'添加';?>首页模板</a></li>
    <li><a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">返回</a></li>
</ul>
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
                        <img id="img0" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('0','640','200');" src="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']) && !empty($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn0"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName0" type="text" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relName']))?$indexs[0]['detail'][0]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(0);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['relId']))?$indexs[0]['detail'][0]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['id']))?$indexs[0]['detail'][0]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['type']))?$indexs[0]['detail'][0]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['url']))?$indexs[0]['detail'][0]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl0" type="hidden" value="<?php echo (isset($indexs[0]['detail'][0]['photoUrl']))?$indexs[0]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img1" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('1','640','200');" src="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']) && !empty($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn1"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName1" type="text" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relName']))?$indexs[0]['detail'][1]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relName]">
                        <img onclick="actionUrl(1);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['relId']))?$indexs[0]['detail'][1]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][relId]" style="width: 120px;">
                        <input id="detailId1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['id']))?$indexs[0]['detail'][1]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][id]" style="width: 120px;">
                        <input id="type1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['type']))?$indexs[0]['detail'][1]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][type]" style="width: 120px;">
                        <input id="url1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['url']))?$indexs[0]['detail'][1]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][url]" style="width: 120px;">
                        <input id="photoUrl1" type="hidden" value="<?php echo (isset($indexs[0]['detail'][1]['photoUrl']))?$indexs[0]['detail'][1]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][1][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img2" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('2','640','200');" src="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']) && !empty($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn2"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName2" type="text" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relName']))?$indexs[0]['detail'][2]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(2);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['relId']))?$indexs[0]['detail'][2]['relId']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['id']))?$indexs[0]['detail'][2]['id']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['type']))?$indexs[0]['detail'][2]['type']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['url']))?$indexs[0]['detail'][2]['url']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl2" type="hidden" value="<?php echo (isset($indexs[0]['detail'][2]['photoUrl']))?$indexs[0]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[0][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img3" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('3','640','200');" src="<?php echo (isset($indexs[0]['detail'][3]['photoUrl']) && !empty($indexs[0]['detail'][3]['photoUrl']))?$indexs[0]['detail'][3]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn3"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName3" type="text" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName3" type="hidden" value="<?php echo (isset($indexs[0]['detail'][3]['relName']))?$indexs[0]['detail'][3]['relName']:'';?>" name="goodsIndexs[0][goodsIndexDetails][3][relName]">
                        <img onclick="actionUrl(3);" align="right" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
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
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template2.png" alt="">
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
                        <img id="img18" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('18','320','320');" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']) && !empty($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn18"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName18" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(18);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*320px)</span>
                        <input id="relId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relId']))?$indexs[3]['detail'][0]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['id']))?$indexs[3]['detail'][0]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['type']))?$indexs[3]['detail'][0]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['url']))?$indexs[3]['detail'][0]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl18" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img19" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('19','320','160');" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']) && !empty($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn19"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName19" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(19);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*160px)</span>
                        <input id="relId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relId']))?$indexs[3]['detail'][0]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['id']))?$indexs[3]['detail'][0]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['type']))?$indexs[3]['detail'][0]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['url']))?$indexs[3]['detail'][0]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl19" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">
                    <div style="width: 133px;">
                        <img id="img20" style="width: 133px; height: 133px;border:1px solid #eaeaea;cursor: pointer;" onclick="uploadImg('20','320','160');" src="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']) && !empty($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn20"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName20" type="text" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relName']))?$indexs[3]['detail'][0]['relName']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relName]">
                        <img onclick="actionUrl(20);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(320*160px)</span>
                        <input id="relId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['relId']))?$indexs[3]['detail'][0]['relId']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][relId]" style="width: 120px;">
                        <input id="detailId20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['id']))?$indexs[3]['detail'][0]['id']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][id]" style="width: 120px;">
                        <input id="type20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['type']))?$indexs[3]['detail'][0]['type']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][type]" style="width: 120px;">
                        <input id="url20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['url']))?$indexs[3]['detail'][0]['url']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][url]" style="width: 120px;">
                        <input id="photoUrl20" type="hidden" value="<?php echo (isset($indexs[3]['detail'][0]['photoUrl']))?$indexs[3]['detail'][0]['photoUrl']:'';?>" name="goodsIndexs[3][goodsIndexDetails][0][photoUrl]" style="width: 120px;">
                    </div>
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
                        <img id="img21" style="width: 133px; height: 133px;border:1px solid #eaeaea;" onclick="uploadImg('21','640','200');" src="<?php echo (isset($indexs[4]['detail'][2]['photoUrl']) && !empty($indexs[4]['detail'][2]['photoUrl']))?$indexs[4]['detail'][2]['photoUrl']:ASSETS_URL.'images/default/indextemplate/add_img.png';?>" alt="">
                        <div style="display: none;" id="upload_btn21"></div>
                    </div>
                    <div style="width: 133px;margin-bottom: -2px;">
                        <input id="spanrelName21" type="text" value="<?php echo (isset($indexs[4]['detail'][2]['relName']))?$indexs[4]['detail'][2]['relName']:'';?>" style="width:60%;background:transparent; border:0px;border-left:1px solid #eaeaea;height:30px;margin-top:-4px;" placeholder="请选择跳转位置">
                        <input id="relName21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['relName']))?$indexs[4]['detail'][2]['relName']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][relName]">
                        <img onclick="actionUrl(21);" align="right" value="" name="relName0" placeholder="请选择跳转位置" style="width: 14px;height:15px;margin-right:-2px;border-right:1px solid #eaeaea;padding-right:10px;padding-top:7px;padding-bottom:5px;margin-top:1px;cursor:pointer;" src="<?php echo ASSETS_URL;?>images/default/update.png" >
                    </div>
                    <div style="border: 1px solid #eaeaea;width:133px;">
                        <span style="color: #ff9900;line-height:28px;"> 尺寸(640*200px)</span>
                        <input id="relId21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['relId']))?$indexs[4]['detail'][2]['relId']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][relId]" style="width: 120px;">
                        <input id="detailId21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['id']))?$indexs[4]['detail'][2]['id']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][id]" style="width: 120px;">
                        <input id="type21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['type']))?$indexs[4]['detail'][2]['type']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][type]" style="width: 120px;">
                        <input id="url21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['url']))?$indexs[4]['detail'][2]['url']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][url]" style="width: 120px;">
                        <input id="photoUrl21" type="hidden" value="<?php echo (isset($indexs[4]['detail'][2]['photoUrl']))?$indexs[4]['detail'][2]['photoUrl']:'';?>" name="goodsIndexs[4][goodsIndexDetails][2][photoUrl]" style="width: 120px;">
                    </div>
                </td>
                <td style="width: 20%">

                </td>
                <td style="width: 20%">

                </td>
                <td style="width: 20%">

                </td>
                <td valign="middle" rowspan="2" class="center" style="border-left: 1px solid #e6e6e6;">
                    <img style="width: 240px; height: 160px;" src="<?php echo ASSETS_URL;?>images/default/indextemplate/template5.png" alt="">
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
            'maxSize': [400,(400/ratio)],//裁剪最大尺寸 [width,height]
            'minSize': [100,(100/ratio)],//裁剪最小尺寸 [width,height]
            'picSize': [w,h],//最终保存图片尺寸 [width,height]
            'quality': 3,//裁剪完后图片压缩比例
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