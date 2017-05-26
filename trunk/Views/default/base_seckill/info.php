<style>
.sui-nav.nav-primary{
  margin-top: 12px;
  margin-bottom: 0px;
}
.load-wrapper{
  margin-top: 30px;
}
.sui-breadcrumb{
  margin:0px;
}
</style>
<ul class="sui-breadcrumb">
    <li><a href="#">活动管理</a></li>
    <li class="active">秒抢管理</li>
    <li><a href="javascript:void(0);" class="sui-btn" data-url="<?php echo $ref;?>">返回</a></li>
</ul>


<ul class="sui-nav nav-tabs nav-primary">
  <li class="active"><a>查看</a></li>
</ul>

<div class="content-top ">
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <input type="hidden" name="goodsIds" id="goodsIds" value="<?php echo $goodsIds;?>">
  <input type="hidden" name="ref" id="ref" value="<?php echo $ref;?>" >
  秒抢有效时间:
      <input class="input-medium" readonly="true" value='<?php echo $startDate;?>'>&nbsp;至&nbsp;<input readonly="true" class="input-medium" value="<?php echo $endDate;?>">
</div>

<div class="base_seckill-list">
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th width="2%"></th>
      <th class="center" width="30%">商品信息</th>
      <th class="center">商品活动名称</th>
      <th class="center">秒抢价</th>
      <th class="center">秒抢数量</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
      <th width="2%"></th>
    </tr>
  </thead>
  <tbody id="addgoods_list">
  <?php foreach ($goods as $rs) {?> 
    <tr>
      <td></td>
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
      <td class="center"><input type="type" name="addgoods_goodsName" class="input-large input-fat" value="<?php echo $rs['goodsName'];?>"></td>
      <td class="center" hidden="hidden"><input min="0" type="number" readonly="true" name="addgoods_originalPrice" class="input-medium" value="<?php echo $rs['originalPrice'];?>"></td>
      <td class="center"><input min="0" type="text" readonly="true" name="addgoods_activityPrice" class="input-medium" value="<?php echo $rs['seckillPrice'];?>"></td>
      <td class="center"><input min="0" type="number" readonly="true" name="addgoods_activityNum" class="input-medium" value="<?php echo $rs['seckillNum'];?>"></td>
      <td class="center"><?php if($rs['status']==1){echo "启用";}elseif($rs['status']==0){echo "禁用";}?></td>
      <td class="center">
        <?php 
          if($rs['status']==1){
            echo form_a_auth(array('content'=>'已启用','class'=>'btn-link goods_list_pre-upstore','img'=>'activation.png'));
          }elseif($rs['status']==0){
            echo form_a_auth(array('content'=>'已禁用','class'=>'btn-link goods_list_pre-downstore','img'=>'invalid.png'));
          }
        ?>
      </td>
      <td></td>
    </tr>
     <?php
  }
  ?>
  </tbody>
</table>
</div>




<?php echo assets::$sayimo; ?>
