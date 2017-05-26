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
  .line{
      border-top: 1px solid #d4d4d4;
      border-bottom: 30px solid #f3f3f3;
  }
  .bottoms{
    margin-bottom: 60px;
  }
</style>
  <div class="addMarkettab">
  <form id="confirm-form" class="sui-form">
      <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <div style="float:left;border:1px solid #00a7db;margin:9px;height:15px;"></div><span class="iconSpan">批量发货</span>
        </div>
      </div>
<?php foreach ($list as $k => $rs) :?>
    <hr class="line" />
    <div class="Js_send_item">
      <table  class="formTable" style="display: block;">
        <input type="hidden" class="Js_id" value="<?php echo $rs['id'];?>">
        <tbody><tr>
          <td align="right" width="100">订单号：</td>
          <td width="300">
            <?php echo $rs['ordersNo'];?>
          </td>
        </tr>
        <tr>
          <td align="right">供应商名称：</td>
          <td width="300">
            <?php echo $rs['providerName'];?>
          </td>
        </tr>
        <tr>
          <td align="right">联系人：</td>
          <td width="300">
            <?php echo $rs['linkman'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo $rs['linkInfo'];?>
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
            <?php echo $rs['receivePeople'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo $rs['receivePeopleTelePhone'];?>
          </td>
        </tr>
        <tr>
          <td align="right">收货地址：</td>
          <td width="300">
            <?php echo $rs['address'];?>
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
          <?php foreach ($rs['orderGoods'] as $key => $value) :?>
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
            <td style="border:0px">运费：<?php echo $rs['logistcsCost'];?></td>
            <td colspan="1" style="border:0px" align="center">合计：
              <font color="red"><?php echo $rs['sumMoney'];?></font>
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
                  <input value="" class="Js_emsId" type="hidden" data-rules="required" data-empty-msg="快递公司不能为空！">
                  <i class="caret"></i>
                  <span><?php echo $rs['emsName']?$rs['emsName']:'请选择';?></span></a>
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
            <input type="text" value="<?php echo $rs['EMSNo'];?>" class="input-large Js_emsNo" data-rules="required" data-empty-msg="快递单号不能为空！">
            <input type="hidden" value="<?php echo $rs['customerId'];?>" class="input-large Js_customerId" />



          </td>
          <td><span class="addMcolor" id="emsNoErrorMsg"></span></td>
        </tr>
        
        
        <tr>
          <td align="right">支付方式：</td>
          <td width="300">
              <?php echo $payList[$rs['payMode']];?>
          </td>
          <td align="right">支付时间：</td>
          <td width="300">
            <?php echo $rs['createDate'];?>
          </td>
        </tr>
      </tbody></table>
      
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单附言：</span>
        </div>
      </div>
      <textarea rows="3" style="border:1px solid #DDDDDD;height:70px;width:53.5%;margin-left:32px" class="leaveWords"><?php echo $rs['leaveWords'];?></textarea>
      <div class="bottoms"></div>
    </div>
<?php endforeach; ?>

      <div style="width:60%; margin-top: 10px;" align="center">
        <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="confirm();">确认发货</button>
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
    go = true;
    sends = [];
    var id,emsId,emsNo,emsName,customerId,leaveWords;
    $.each($(".Js_send_item"), function(index, o) {
      id = $(o).find(".Js_id").val();
      emsId = $(o).find(".Js_emsId").val();
      emsNo = $(o).find(".Js_emsNo").val();
      customerId= $(o).find(".Js_customerId").val();
      emsName = $(o).find(".Js_emsName").find("a.dropdown-toggle span").html();
      leaveWords = $(o).find(".leaveWords").val();

      if(emsName == '请选择'){
        emsName = '';
      }
      if(emsId){
        if(!emsNo){
          $(o).find(".Js_emsNo").trigger('focus');
          $.alert("亲，请录入快递单号");
          go = false;
        }
      }
      sends.push({
                 "id":id,
                 "emsId":emsId,
                 "emsNo":emsNo,
                 "emsName":emsName,
                "customerId":customerId,
                "leaveWords":leaveWords
              });
    });

    if(go){
     $.ajax({
        type    : "post",
        async   : false,
        url     : '<?php echo APP_URL."orders_silver_goods_info/confirmAllSendGoods";?>',
        data    : "sends=" + JSON.stringify(sends) ,
        dataType: 'json',
        success : function (data){
          if (data['msg'] == true){

            $.alert({
              title: '对话框',
              body: '恭喜亲，发货成功',
              hide: function(e){
                SAYIMO.go_url($("#ref").val());
              }
            })
          }else{
            $.alert('亲，发货不成功');
          }
        }
      });
    }
  }
  //表单验证提交结束
</script>