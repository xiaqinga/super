
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
      <th colspan="12"></th>
    </tr>
    <tr class="thbk">
      <th width="1%" class="center"></th>
      <th width="15%" class="center">商品名称</th>
      <th width="5%" class="center">单价（元）</th>
      <th width="5%" class="center">退货数量</th>
      <th width="10%" class="center">会员昵称</th>
      <th width="5%" class="center">退货人姓名</th>
      <th width="5%" class="center">退货人联系方式</th>
      <th width="5%" class="center">收货地址</th>
      <th width="5%" class="center">附加信息</th>
      <th width="5%" class="center">状态</th>
      <th width="5%" class="center" >操作</th>
      <th width="1%" class="center"></th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $k => $rs):?>

              <?php if($rs['orderNo'] != $orderNo):?>
                <?php 
                  $orderTime='';
                  if(!empty($rs['orderScheduleDate'])){
                    $orderScheduleDate = $rs['orderScheduleDate'];
                    $orderTime = $orderScheduleDate . ' ' . $rs['startTime'] . '--' . $rs['endTime'];
                  }else{
                    $orderTime = $rs['endTime'];
                  }
                ?>
              <tr class="orderTr1" style="margin-top: 8px;">
                <td class="orderTdbj1"></td>
                <td align="left" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号&nbsp;:&nbsp;<?php echo $rs['orderNo']?></td>
                <td align="left" style="border: none;" colspan="2">
                  <img src="<?php echo ASSETS_URL;?>images/default/sygys.png">&nbsp;&nbsp;<?php echo $rs['providerName']?>
                </td>
                <td align="right" colspan="5" style="border: none;text-align: right;">
                  <?php echo $rs['createTime']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td class="orderTdbj2"></td>
              </tr>
              <?php endif;?>
              <tr class="orderTr">
                <td class="orderTdbj1"></td>
                <td align="center"><?php echo $rs['goodsName']?></td>
                <td class="center"><?php echo $rs['transactionPrice'];?></td>
                <td class="center">x<?php echo $rs['returnGoodsNum']?></td>
                <td class="center"><?php echo $rs['alias']?></td>
                <td class="center"><?php echo ($rs['receivingPeople'])?$rs['receivingPeople']:'--'?></td>
                <td class="center"><?php echo ($rs['telePhone'])?$rs['telePhone']:'--'?></td>
                <td class="center"><?php echo $rs['address']?></td>
                <td class="center"><?php echo $rs['applyExplain']?></td>
                <td class="center"><?php echo $ctrl->setStatus($rs['orderReturnStatus'], $rs['type'])?></td>
                <td class="center">
                  <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'orders_return/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
                  <?php if( $rs['status']==1 ):?>
                    <?php echo form_a_auth(array('content'=>'审核','class'=>'btn-link','url'=>'orders_return/confirm?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'confirm.png'));?>
                  <?php endif;?>
                  <?php if( $rs['status']==3 ):?>
                    <?php echo form_a_auth(array('content'=>'确认退换货','check'=>'orders_return/determined_return','class'=>'btn-link','url'=>'orders_return/confirm?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'confirm.png'));?>
                  <?php endif;?>
                </td>
                <td class="orderTdbj2"></td>
              </tr>

      <?php $orderNo = $rs['orderNo'];?>
    <?php endforeach;?>
  </tbody>
</table>
</form>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有退换货</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>

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
      SAYIMO.go_url("<?php echo APP_URL?>orders_return/confirmAll?ids="+JSON.stringify(ids));
    },
    hide: function() {}
  });
}
</script>
<script type="text/javascript" src="<?php echo WWW_RES_URL;?>plugins/kdniao/kdniao.js?v=<?php echo time();?>"></script>