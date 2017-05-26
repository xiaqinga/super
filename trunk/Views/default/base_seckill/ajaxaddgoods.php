<form class="sui-form addgoods_form" id="mainInfo">
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th width="2%"></th>
      <th class="center" width="30%">商品信息</th>
      <th class="center">活动商品名称</th>
      <th class="center">秒抢价(可按%设置价格)</th>
      <th class="center">秒抢数量</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
      <th width="2%"></th>
    </tr>
  </thead>
  <tbody id="addgoods_list">
  <?php if(!empty($list)){?>
  	<?php foreach($list as $rs){?>
    <tr>
      <td><input name="addgoods_id" value="<?php echo $rs['goodsId'];?>" type="hidden"></td>
      <td align="left">
        <div width="85px" style="float:left;">
          <img src="<?php echo $rs['photoPath'];?>" alt="商品图片" align="middle" width="85px" height="85px"></div>
        <div style="float:right;width: 70%;height:20px;padding-left:20px">
          <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" title="<?php echo $rs['providerName'];?>"><?php echo $rs['providerName'];?></span></div>
        <div style="float:right;width:70%;height:20px;padding-left:20px">
          <span style="display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color:#ff9900;"><?php echo $rs['goodsName'];?></span></div>
        <div style="float:right;width: 70%;height:20px;padding-left:20px">
          <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">价&nbsp;&nbsp;&nbsp;格：
            <font style="color:red;">¥<?php echo $rs['preferentialPrice'];?></font></span>
        </div>
        <div style="float:right;width: 70%;height:20px;padding-left:20px">
          <span style="display: inline-block;width: 85%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">库存量：<?php echo $rs['stockNum'];?></span></div>
      </td>
      <td class="center"><input type="type" name="addgoods_goodsName" class="input-large input-fat" value="<?php echo $rs['agname'];?>"></td>
      <td class="center" hidden="hidden"><input min="0" type="number" name="addgoods_originalPrice" class="input-medium" value="<?php echo $rs['originalPrice'];?>"></td>
      <td class="center"><input min="0" type="text" name="addgoods_activityPrice" class="input-medium" value="<?php echo $rs['seckillPrice'];?>"></td>
      <td class="center"><input min="0" type="number" name="addgoods_activityNum" class="input-medium" value="<?php echo $rs['seckillNum'];?>"></td>
      <td class="center"><?php if($rs['status']==1){echo "启用";}elseif($rs['status']==0){echo "禁用";}?></td>
      <td class="center">

        <?php 
          if($rs['status']==0){
            echo form_a_auth(array('content'=>'启用','class'=>'btn-link goods_list_pre-upstore','url'=>'base_seckill/upstore','rid'=>$rs['id'].','.$goodsType.','.$id,'img'=>'activation.png'));
          }elseif($rs['status']==1){
            echo form_a_auth(array('content'=>'禁用','class'=>'btn-link goods_list_pre-downstore','url'=>'base_seckill/downstore','rid'=>$rs['id'].','.$goodsType.','.$id,'img'=>'invalid.png'));
          }
        ?>
      </td>
      <td></td>
    </tr>
    <?php }?>
    <?php }else{?>
    <?php }?>
  </tbody>
</table>
</form>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">

var _upstore = {};
_upstore.body = '确认启用该商品';
_upstore.form = $('#mainInfo');
_upstore.url = OO._SRVPATH + 'base_seckill/upstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_list_pre-upstore',_upstore);

var _downstore = {};
_downstore.body = '确认禁用该商品';
_downstore.form = $('#mainInfo');
_downstore.url = OO._SRVPATH + 'base_seckill/downstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_list_pre-downstore',_downstore);

</script>