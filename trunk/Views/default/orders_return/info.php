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
            <?php echo $attr['orderNo'];?>
          </td>
          <td align="right">类型：</td>
          <td width="300">
            <?php if( $rs['type']==1 ):?>
              退货
            <?php else:?>
              换货
            <?php endif;?>
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
            <?php echo $attr['linkman'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo $attr['mobilePhone'];?>
          </td>
        </tr>
      </tbody></table>
      
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;买家信息</span>
        </div>
      </div>
    
      <table class="formTable">
        <tbody><tr>
          <td align="right" width="100">收货人姓名：</td>
          <td width="300">
            <?php echo $attr['receivingPeople'];?>
          </td>
          <td align="right" width="100">联系方式：</td>
          <td width="300">
            <?php echo $attr['telePhone'];?>
          </td>
        </tr>
        <tr>
          <td align="right">收货地址：</td>
          <td width="300">
            <?php echo $attr['address'];?>
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
          <tr align="center">
            <td align="center"><?php echo $attr['goodsName'];?></td>
            <td align="center"><?php echo $attr['normsValues'];?> </td>
            <td align="center"><?php echo $attr['returnGoodsNum'];?></td>
            <td align="center"><?php echo $attr['transactionPrice'];?></td>
            <td align="center"><?php echo $attr['totalMoeny'];?></td>
          </tr>


      </tbody></table>

    <?php if ($attr['orderReturnStatus'] == 3 ) :?>
      <table class="formTable">
        <tr>
          <td align="right" width="100">快递公司名称：</td>
          <td width="300" style="border: 1px solid #DDDDDD;"><?php echo $attr['emsName'];?></td>
          <td align="right" width="100">快递单号：</td>
          <td width="300" style="border: 1px solid #DDDDDD;"><?php echo $attr['emsNo'];?></td>
        </tr>
      </table>
    <?php endif;?>
    <br />
    <div class="market_dt5">
      <div style="height: 30px; background-color: #fff; margin: 0px; padding: 0px; padding-bottom: 5px;">
        <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;买家留言</span>
      </div>
    </div>
    
    <div style="border: 1px solid #DDDDDD; height: 70px; width: 53.5%; margin-left: 32px">
      <span style="font-size: 12px; color: #636363;"><?php echo $attr['applyExplain'];?></span>
    </div>
    
    <table id="ct" class="formTable" style="display: block;">
      <tr>
        <td align="right" width="100">状态：</td>
        <td width="300"><?php echo $ctrl->setStatus($attr['orderReturnStatus'], $attr['type'])?></td>
      </tr>
    </table>
      
    <div align="center" style="width: 60%;">
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
      url     : '<?php echo APP_URL."orders_return/confirmSendGoods";?>',
      data    : "id=" + id + "&emsId=" + emsId + "&emsNo=" + emsNo + "&emsName=" + emsName,
      dataType: 'json',
      success : function (data){
        if (data['msg'] == true){

          $.alert({
            title: '对话框',
            body: '恭喜亲，发货成功',
            okHide: function(e){
              SAYIMO.go_url($("#ref").val());
            }
          })
        }else{
          $.alert('亲，发货不成功');
        }
      }
    });
  }
  //表单验证提交结束
</script>