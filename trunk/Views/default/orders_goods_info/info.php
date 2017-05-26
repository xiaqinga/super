<style type="text/css">
  .formTable {
    padding: 10px 30px;
    font-size: 12px;
    border: 0px solid #ccc;
    margin-top: 10px;
  }
  .iconSpan {
      float: left;
      font-size: 14px;
      color: #636363;
      text-decoration: none;
      background-color: #fff;
      padding: 8px;
      font-weight: bold;
  }
  .goodsListClass tr td {
      border-bottom: 1px solid #DDDDDD;
  }
</style>
  <div class="addMarkettab">
  <form id="confirm-form" class="sui-form">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">订单详情</span>
        </div>
      </div>
      <table id="ct" class="formTable" style="display: block;">
        <tbody><tr>
          <td align="right" width="100">订单号：</td>
          <td width="300">
            <?php echo $attr['ordersNo'];?>
          </td>
        </tr>
        <tr>
          <td align="right">供应商名称：</td>
          <td width="300">
            <?php echo $attr['providerName'];?>
          </td>
        </tr>
        <tr>
          <td align="right">联系人：</td>
          <td width="300">
            <?php echo ($attr['linkman'])?$attr['linkman']:$attr['corporate'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo ($attr['linkInfo'])?$attr['linkInfo']:$attr['lockPhone'];?>
          </td>
        </tr>
        <tr>
          <td align="right">订单生成时间：</td>
          <td width="300">
            <?php echo $attr['createDate'];?>
          </td>
        </tr>
        <tr>
          <td align="right">
          <?php
            if($attr['receiveDate']){
              echo "确认收货时间：";
            }elseif($attr['sendDate']){
              echo "发货时间：";
            }
          ?> 
          </td>
          <td width="300">
          <?php
            if($attr['receiveDate']){
              echo $attr['receiveDate'];
            }elseif($attr['sendDate']){
              echo $attr['sendDate'];
            }
          ?> 
          </td>
        </tr>
      </tbody></table>
      
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收货人信息</span>
        </div>
      </div>
    
      <table class="formTable">
        <tbody><tr>
          <td align="right" width="100">收货人姓名：</td>
          <td width="300">
            <?php echo $attr['receivePeople'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo $attr['receivePeopleTelePhone'];?>
          </td>
        </tr>
        <tr>
          <td align="right">收货地址：</td>
          <td width="300">
            <?php echo $attr['allAddress'];?>
          </td>
        </tr>
      </tbody></table>
      

      <table style="width:53.4%;font-size: 12px;line-height: 30px;margin-left:32px;border:1px solid #DDDDDD;margin-left:32px;" class="goodsListClass" cellspacing="0">
          <tbody><tr style="font-weight: bold;font-size: 14px; background-color: #f2f2f2;" align="center"> 
            <td width="20%">商品名称</td>
            <td width="10%">型号</td>
            <td width="10%">数量</td>
            <td width="10%">单价</td>
            <td width="10%">总计</td>
            
          </tr>
          
          <?php foreach ($goods as $key => $value) :?>
            <tr align="center">
              <td align="center"><?php echo $value['goodsName'];?></td>
              <td align="center"><?php echo $value['normsValue'];?> </td>
              <td align="center"><?php echo $value['buyNum'];?></td>
              <td align="center"><?php echo $value['unitPrice'];?></td>
              <td align="center"><?php echo $value['shouldPay'];?></td>
            </tr>
          <?php endforeach;?>
          
          <tr>
            <td colspan="3" style="border:0px"></td>
            <td style="border:0px">运费：<?php echo $attr['logistcsCost'];?></td>
            <td colspan="1" style="border:0px" align="center">合计：
              <font color="red"><?php echo $attr['sumMoney'];?></font>
            </td>
          </tr>
      </tbody></table>
      <table class="formTable">
        
        <tbody><tr>
          <td align="right" width="100">快递公司名称：</td>
          <td  width="300">
            <span class="sui-dropdown dropdown-bordered select Js_emsName">
              <span class="dropdown-inner">
                <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle" >
                  <input value="" id="emsId" name="emsId" type="hidden" data-rules="required" data-empty-msg="快递公司不能为空！">
                  <i class="caret"></i>
                  <span><?php echo $attr['emsName']?$attr['emsName']:'请选择';?></span></a>
                <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">

                  <?php foreach ($ems as $key => $value) :?>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $value['id'];?>"><?php echo $value['emsName'];?></a></li>
                  <?php endforeach;?>
                </ul>
              </span>
            </span>
          </td>
          <td align="right" width="100">快递单号：</td>
          <td width="300">
            <input id="emsNo" type="text" value="<?php echo $attr['EMSNo'];?>" class="input-large" data-rules="required" data-empty-msg="快递单号不能为空！" >
          </td>
          <td><span class="addMcolor" id="emsNoErrorMsg"></span></td>
        </tr>
        
        <tr>
          <td align="right">支付方式：</td>
          <td width="300">
              <?php echo $payList[$attr['payMode']];?>
          </td>
          <td align="right">支付时间：</td>
          <td width="300">
            <?php echo $attr['payDate'];?>
          </td>
        </tr>
      </tbody></table>
      
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单附言：</span>
        </div>
      </div>
      <textarea rows="3" style="border:1px solid #DDDDDD;height:70px;width:53.5%;margin-left:32px"><?php echo $attr['leaveWords'];?></textarea>
      <div style="width:60%; margin-top: 10px;" align="center">
        <?php if($status==3):?>
        <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="confirm();">修改信息</button>
        <?php endif ?>
        <button type="button" class="sui-btn btn-xlarge" onclick="gourl();">关闭</button>
      </div>
  </form>
  </div>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
  function gourl() {
    SAYIMO.go_url($("#ref").val());
  }
  function confirm()
  {
    var id = $("#id").val();
    var emsId = $("#emsId").val();
    var emsNo = $("#emsNo").val();
    var emsName = $(".Js_emsName").find("a.dropdown-toggle span").html();
    var leaveWords = $(".leaveWords").val();

    if(emsName == '请选择'){
      emsName = '';
    }

    if(emsId){
      if(!emsNo){
        $.alert("亲，请录入快递单号");
        return false;
      }
    }
    $.ajax({
      type    : "post",
      async   : false,
      url     : '<?php echo APP_URL."orders_goods_info/confirmChangeInfo";?>',
      data    : "id=" + id + "&emsId=" + emsId + "&emsNo=" + emsNo + "&emsName=" + emsName + "&leaveWords=" + leaveWords,
      dataType: 'json',
      success : function (data){
        if (data['msg'] == true){

          $.alert({
            title: '对话框',
            body: '恭喜亲，修改成功',
            okHide: function(e){
              SAYIMO.go_url($("#ref").val());
            }
          })
        }else{
          $.alert('亲，修改不成功');
        }
      }
    });
  }
  //表单验证提交结束
</script>