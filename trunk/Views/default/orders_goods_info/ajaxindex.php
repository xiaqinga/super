
<style type="text/css">
.topChk .checkbox-pretty span:before{
    color: #FFFFFF;
}
</style>
<?php if(!empty($list)){?>
<form class="sui-form">
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <?php 
        switch ($status) {

          //待支付
          case 1:
            echo <<<END
              <th colspan="10"></th>
END;
            break;

          //待发货
          case 2:
            echo <<<END
              <th colspan="12"></th>
END;
            break;

          //已发货
          case 3:
            echo <<<END
              <th colspan="11"></th>
END;
            break;

          //订单完成
          case 7:
            echo <<<END
              <th colspan="11"></th>
END;
            break;

          //已退货
          case 8:
            echo <<<END
              <th colspan="11"></th>
END;

          //已退款处理
          case 4:
            echo <<<END
              <th colspan="11"></th>
END;
            break;
          
          //全部订单
          default:
            echo <<<END
              <th colspan="10"></th>
END;
            break;
        }
      ?>

    </tr>
    <tr class="thbk">
    <?php if($status ==2||$status ==3||$status ==7):?>
        <th width="5%" class="center topChk"><label class="checkbox-pretty inline all-chk" onclick="chkAll(this.querySelector('input'));"><input type="checkbox"><span></span></label></th>
    <?php endif;?>
    <?php if($status == 2||$status ==3||$status ==7):?>
      <th width="15%" class="center">商品名称</th>
    <?php else:?>
      <th width="15%" class="center" colspan="2" >商品名称</th>
    <?php endif;?>
      <th width="5%" class="center">单价（元）</th>
      <th width="5%" class="center">数量</th>
      <th width="10%" class="center">会员昵称</th>
      <th width="5%" class="center">收货人姓名</th>
      <?php 
        switch ($status) {

          //待支付
          case 1:
            echo <<<END
              <th width="5%" class="center">收货人联系方式</th>
              <th width="5%" class="center">应付(元)</th>
END;
            break;

          //待发货
          case 2:
            echo <<<END
              <th width="5%" class="center">收货人联系方式</th>
              <th width="15%" class="center">收货地址</th>
              <th width="5%" class="center">留言</th>
              <th width="5%" class="center">实收(元)</th>
END;
            break;

          //已发货
          case 3:
            echo <<<END
              <th width="5%" class="center">收货人联系方式</th>
              <th width="5%" class="center">实收(元)</th>
              <th width="10%" class="center">发货时间</th>
END;
            break;

          //订单完成
          case 7:
            echo <<<END
              <th width="5%" class="center">收货人联系方式</th>
              <th width="5%" class="center">实收(元)</th>
              <th width="10%" class="center">收货时间</th>
END;
            break;

          //已退货
          case 8:
            echo <<<END
              <th width="5%" class="center">收货人联系方式</th>
              <th width="5%" class="center">实收(元)</th>
              <th width="5%" class="center">发货时间</th>
END;
            break;
          
          //全部订单
          default:
            echo <<<END
              <th width="5%" class="center">支付方式</th>
              <th width="5%" class="center">订单状态</th>
END;
            break;
        }
      ?>
    <?php if($status == 3 || $status == 7 || $status == 4):?>
      <th width="10%" class="center" colspan="2" >操作</th>
    <?php else:?>
      <th width="5%" class="center" colspan="2" >操作</th>
    <?php endif;?>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $k => $rs):?>
      <?php switch ($status):

          //待支付
              case 1 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1"></td>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="3">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['sumMoney'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>
        <?php break; ?>

        <!-- 待发货 -->
        <?php case 2 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1 center"><label class="checkbox-pretty inline" onclick="delChkAll();"><input type="checkbox" value="<?php echo $rs['id'];?>"><span></span></label></td>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="4">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="5" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['allAddress'];?></td>
                <td class="center"><?php echo $rs['leaveWords'];?></td>
                <td class="center"><?php echo $rs['shouldPay'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>
                  <?php echo form_a_auth(array('content'=>'确认','class'=>'btn-link','url'=>'orders_goods_info/confirm?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/confirm','img'=>'confirm.png'));?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>
        <?php break; ?>

        <!-- 已发货 -->
        <?php case 3 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">

                <td class="orderTdbj1 center"><label class="checkbox-pretty inline" onclick="delChkAll();"><input type="checkbox" value="<?php echo $rs['id'];?>"><span></span></label></td>

                <td  align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="3">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['shouldPay'];?></td>
                <td class="center"><?php echo $rs['sendDate'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&status='.$status.'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>&nbsp;&nbsp;
                  <?php 
                    if($rs['ordersNo'] && $rs['emsName']){
                      echo form_a_auth(array('content'=>'查看物流','class'=>'btn-primary','url'=>'orders_goods_info/logistics?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/view_logistics','onclick'=>"kdniao.query('".$rs['emsNo']."','".$rs['emsName']."')"));
                    }else{
                      echo '不需要物流';
                    }
                  ?>
                </td>

              </tr>
        <?php break; ?>

        <!-- 订单完成 -->
        <?php case 7 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1 center"><label class="checkbox-pretty inline" onclick="delChkAll();"><input type="checkbox" value="<?php echo $rs['id'];?>"><span></span></label></td>

                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="3">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['shouldPay'];?></td>
                <td class="center"><?php echo $rs['receiveDate'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>
                  <?php 
                    if($rs['ordersNo'] && $rs['emsName']){
                      echo form_a_auth(array('content'=>'查看物流','class'=>'btn-primary','url'=>'orders_goods_info/logistics?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/view_logistics','onclick'=>"kdniao.query('".$rs['ordersNo']."','".$rs['emsName']."')"));
                    }else{
                      echo '不需要物流';
                    }
                  ?>
                </td>
               
              </tr>
        <?php break; ?>

        <!-- 确认退款 -->
        <?php case 4 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1"></td>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="4">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['shouldPay'];?></td>
                <td class="center"><?php echo $rs['sendDate'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>&nbsp;&nbsp;
                  <?php 
                    // echo form_a_auth(array('content'=>'确认退款','class'=>'btn-primary','url'=>'orders_goods_info/refund?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/view_logistics','onclick'=>"kdniao.query('".$rs['emsNo']."','".$rs['emsName']."')"));
                  ?>
                  <?php echo form_a_auth(array('content'=>'确认退款','class'=>'btn-primary orders_goods_info-refund','url'=>'orders_goods_info/refund','rid'=>$rs['id']));?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>
        <?php break; ?>

         <!-- 已退货 -->
        <?php case 8 : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1"></td>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="4">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php echo $rs['receivePeopleTelePhone'];?></td>
                <td class="center"><?php echo $rs['shouldPay'];?></td>
                <td class="center"><?php echo $rs['sendDate'];?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>
        <?php break; ?>

          <!--全部订单-->
        <?php default : ?>
              <?php if($rs['ordersNo'] != $lastOrderNo):?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1"></td>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['ordersNo']?></td>
                <td align="left" style="border: none;" colspan="3">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="4" style="border: none;text-align: right;">
                  <?php echo $rs['createDate']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="left">
                  <div width="40px" style="float:left">
                    <img width="40px" height="40px" align="middle" src="<?php echo $rs['photoPath']?>" alt="商品图片">
                  </div>
                  <div style="float:right;width: 70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;" title="<?php echo $rs['goodsName']?>">
                      <?php echo $rs['goodsName']?>
                    </span>
                  </div>
                  <div style="float:right;width:70%;height:20px;padding-left:20px">
                    <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                      <?php echo $rs['normsValue']?> 
                    </span>
                  </div>
                </td>
                <td class="center"><?php echo ($rs['isActivity'] != "" && $rs['isActivity'] != 0 && $rs['identifier'] != "" && strstr($rs['identifier'],"CYGHMZS"))?0:$rs['unitPrice']?></td>
                <td class="center">x<?php echo $rs['buyNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivePeople'])?$rs['receivePeople']:'--'?></td>
                <td class="center"><?php if($rs['payMode']=='weChatPay'){echo '微支付';}elseif($rs['payMode']=='sayimoPay'){echo '钱包支付';}else{echo '--';}?></td>
                <td class="center"<?php echo ($rs['status']==1)?' style="color:red;"':''?>><?php echo $statusList[$rs['status']]?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_goods_info/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'orders_goods_info/see','img'=>'check.png'));?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>
        <?php break; ?>
      <?php endswitch ?>
      <?php $lastOrderNo = $rs['ordersNo'];?>
    <?php endforeach;?>
  </tbody>
</table>
</form>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有商品订单</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认付款？';
_delete.form = $('#sui-form');
_delete.url = OO._SRVPATH + 'orders_goods_info/refund?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.orders_goods_info-refund',_delete);
</script>

<script type="text/javascript">
/*选中 或 取消 所有*/
  function chkAll(obj) {
    if(obj.checked){
      $('.orderTdbj1 .checkbox-pretty input').prop("checked", true);
      $('.orderTdbj1 .checkbox-pretty').addClass('checked');
    }else{
      $('.orderTdbj1 .checkbox-pretty input').prop("checked", false);
      $('.orderTdbj1 .checkbox-pretty').removeClass('checked')
    }
  }

  function delChkAll(){
    $(".all-chk input").prop("checked", false);
    $(".all-chk").removeClass('checked');
  }


/*批量发货*/
function sendGoods(){
  var ids = new Array();
  $.each($('.orderTdbj1 .checkbox-pretty input:checkbox:checked'),function(n,inp){
    ids.push($(inp).val());
  });
  if(ids.length<=0){
    $.alert("请选择发货订单");
    return false ;
  }
  $.confirm({
    title: '确认批量发货',
    body: '确认批量发货吗？',
    backdrop: true,
    okHide: function() {
      SAYIMO.go_url("<?php echo APP_URL?>orders_goods_info/confirmAll?ids="+JSON.stringify(ids));
    },
    hide: function() {}
  });
}
</script>
<script type="text/javascript" src="<?php echo WWW_RES_URL;?>plugins/kdniao/kdniao.js?v=<?php echo time();?>"></script>