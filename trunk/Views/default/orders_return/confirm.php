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
            <?php if( $attr['type']==1 ):?>
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
      

      <table style="width:53.4%;font-size: 12px;line-height: 30px;margin-left:32px;border:1px solid #DDDDDD;border-bottom:none;margin-left:32px;" class="goodsListClass" cellspacing="0">
          <tbody><tr style="font-weight: bold;font-size: 14px; background-color: #f2f2f2;" align="center"> 
            <td width="20%">商品名称</td>
            <td width="10%">规格</td>
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
          <?php if($attr['type'] == 2 && ( $attr['orderReturnStatus'] == 3 || ( $attr['orderReturnStatus'] == 4 || $attr['orderReturnStatus'] == 5 ))):?>
          <tr align="center">
            <td align="center"><?php echo $attr['goodsName'];?></td>
            <td align="center">
              <?php if( $attr['orderReturnStatus'] == 4 || $attr['orderReturnStatus'] == 5):?>
                <?php echo $attr['newNormsValue'];?>
              <?php else:?>
                  <span class="sui-dropdown dropdown-bordered select" style="margin-bottom: 10px;  margin-top: 10px;">
                    <span class="dropdown-inner">
                      <a id="drop12" role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <input value="" name="newNormsValueId" id="newNormsValueId" type="hidden">
                        <i class="caret"></i>
                        <span>请选择</span></a>
                      <ul id="menu12" role="menu" aria-labelledby="drop12" class="sui-dropdown-menu">
                      <?php foreach ($goodsNormsValueStocks as $k => $v) :?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" value="<?php echo $v['goodsNormsValueId'];?>" preferentialPrice="<?php echo $v['preferentialPrice'];?>"><?php echo $v['normsValue'];?></a></li>
                      <?php endforeach;?>
                      </ul>
                    </span>
                  </span>
              <?php endif;?>
            </td>
            <td align="center" id="returnGoodsNumTd"><?php echo $attr['returnGoodsNum'];?></td>
            <td align="center" id="transactionPriceTd">
              <?php if( $attr['orderReturnStatus'] == 4 || $attr['orderReturnStatus'] == 5):?>
                <?php echo $attr['newNormsPreferentialPrice'];?>
              <?php else:?>
                  <?php echo $goodsNormsValueStocks[0]['preferentialPrice'];?>
              <?php endif;?>
            </td>
            <td align="center" id="totalMoenyTd">
              <?php if( $attr['orderReturnStatus'] == 4 || $attr['orderReturnStatus'] == 5):?>
                <?php echo $attr['newNormsPreferentialPrice'] * $attr['returnGoodsNum'];?>
              <?php else:?>
                  <?php echo $goodsNormsValueStocks[0]['preferentialPrice'] * $attr['returnGoodsNum'];?>
              <?php endif;?>
            </td>
          </tr>
          <?php endif;?>
      </tbody></table>

      <?php if( $attr['orderReturnStatus'] == 3):?>
        <table class="formTable">
          <tr>
            <td align="right" width="100">快递公司名称：</td>
            <input type="hidden" value="<?php echo $attr['newEmsId'];?>">
            <td width="300"><input disabled type="text" class="input-large input-fat" value="<?php echo $attr['newEmsName'];?>"></td>
            <td align="right" width="100">快递单号：</td>
            <td width="300"><input disabled type="text" class="input-large input-fat" value="<?php echo $attr['newEmsNo'];?>"></td>
          </tr>
        </table>
      <?php endif;?>

 <!--      <table class="formTable">
        
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
            <input id="emsNo" type="text" value="<?php echo $attr['EMSNo'];?>" class="input-large" data-rules="required" data-empty-msg="快递单号不能为空！">
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
            <?php echo $attr['createDate'];?>
          </td>
        </tr>
      </tbody></table> -->
      
      <div class="market_dt5">
        <div style="height:30px;background-color:#fff;margin:0px;padding:0px;padding-bottom:5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;买家留言</span>
        </div>
      </div>

      <div style="border: 1px solid #DDDDDD; height: 70px; width: 52%; margin-left: 32px; padding: 10px;">
        <span style="font-size: 12px; color: #636363;"><?php echo $attr['applyExplain'];?></span>
      </div>

      <table id="ct" class="formTable" style="display: block;">
        <tr>
          <td align="right" width="100">状态：</td>
          <td width="300"><?php echo $ctrl->setStatus($attr['orderReturnStatus'], $attr['type'])?></td>
        </tr>
      </table>

    <!-- 审核 -->
      <div class="market_dt5" id="approveTitle">
        <div style="height: 30px; background-color: #fff; margin: 0px; padding: 0px; padding-bottom: 5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;审核</span>
          <input type="hidden" name="orderReturnRef.check.returnRefId" value="<?php $attr['id'];?>">
        </div>
      </div>
      
      <table id="approveTable" style="display: block;" class="formTable">
        <tr>
          <td align="right" width="100">审核：</td>
          <td width="300">
            <?php if( $attr['orderReturnStatus'] == 1):?>
              <select name="status" id="status">
                <option value="1">同意申请</option>
                <option value="2">申请驳回</option>
              </select>
            <?php else:?>
              <?php if( $attr['checkStatus'] == 1 ):?>
                    同意申请
              <?php else:?>
                    申请驳回
              <?php endif;?>
            <?php endif;?>
          </td>
        </tr>
        <tr>
          <td align="right" width="100">审批说明：</td>
          <td width="880">
            <?php if( $attr['orderReturnStatus'] == 1):?>
              <textarea rows="3" cols="50" size="50" style="height: 90px;" id="auditExplain" name="auditExplain"></textarea>
            <?php else:?>
                <?php echo $attr['auditExplain'];?>
            <?php endif;?>
          </td>
        </tr>
      </table>
    
    <!-- 换货商家确认收货后，生成新的订单，选择物流信息 -->
    <?php if( $attr['orderReturnStatus'] == 3 && $attr['type'] ==2 ):?>
      <div class="market_dt5" id="approveTitle">
        <div style="height: 30px; background-color: #fff; margin: 0px; padding: 0px; padding-bottom: 5px;">
          <span class="iconSpan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发货</span>
        </div>
      </div>
      
      <table id="ct" class="formTable" style="display: block;">
        <tr>
          <td align="right" width="100">物流公司：</td>
          <td width="300">
            <select id="emsSelect">
              <?php foreach ($ems as $k => $v) :?>
                <option value="<?php echo $v['id'];?>">
                  <?php echo $v['emsName'];?>
                </option>
              <?php endforeach;?>
            </select>
          </td>
          <td align="right" width="100">物流单号：</td>
          <td width="300">
            <input type="text" id="emsNo">
          </td>
        </tr>
      </table>
    <?php endif;?>
    
    <div align="center" style="width: 60%;">
      <button type="button" class="sui-btn btn-xlarge" onclick="gourl();">关闭</button>
      <!-- 审核-->
      <?php if( $attr['orderReturnStatus'] == 1 ):?>
          <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="confirmA();">审核</button>
      <?php else:?>
          <button type="button" class="sui-btn btn-xlarge btn-primary" onclick="confirmB();">确认<?php if($attr['type']==1){echo "退货";}else{echo "换货";}?></button>
      <?php endif;?>
    </div>

  </form>
  </div>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
  function gourl() {
    SAYIMO.go_url($("#ref").val());
  }
  function confirmA()
  {
    var id = $("#id").val();
    var auditExplain = $("#auditExplain").val();
    var status = $('#status option:selected') .val();

    $.ajax({
      type    : "post",
      async   : false,
      url     : '<?php echo APP_URL."orders_return/approveOrder";?>',
      data    : "id=" + id + "&auditExplain=" + auditExplain + "&status=" + status,
      dataType: 'json',
      success : function (data){
        if (data['error'] == false){

          $.alert({
            title: '对话框',
            body: data['msg'],
            hide: function(e){
              SAYIMO.go_url($("#ref").val());
            }
          })
        }else{
          $.alert(data['msg']);
        }
      }
    });
  }
  function confirmB()
  {
    var id = $("#id").val();
    var newOrderNormsValueId = $("#newNormsValueId").val();
    var emsNo = $("#emsNo").val();
    var emsName = $('#emsSelect option:selected') .text();
    var emsId = $('#emsSelect option:selected') .val();
    var ordersNo = "<?php echo $attr['orderNo'];?>";

    <?php
      if($attr['type']!=1): //换货
    ?>
      if(!newOrderNormsValueId){
        $.alert("亲，选择换货的规格");
        return false;
      }
      if(!emsId){
        $.alert("亲，选择换货的快递");
        return false;
      }
    <?php endif;?>
    $.ajax({
      type    : "post",
      async   : false,
      url     : '<?php echo APP_URL."orders_return/updateReceipt";?>',
      data    : "id=" + id + '&newOrderNormsValueId=' + newOrderNormsValueId + '&emsNo=' + emsNo + '&emsName=' + emsName + '&emsId=' + emsId + '&ordersNo=' + ordersNo,
      dataType: 'json',
      success : function (data){
        if (data['error'] == false){

          $.alert({
            title: '对话框',
            body: data['msg'],
            hide: function(e){
              SAYIMO.go_url($("#ref").val());
            }
          })
        }else{
          $.alert(data['msg']);
        }
      }
    });
  }
</script>