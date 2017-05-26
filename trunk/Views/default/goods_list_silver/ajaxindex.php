<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="11"></th>
    </tr>
    <tr class="thbk">
      <th class="center">商品编号</th>
      <th class="center">商品名称</th>
      <th class="center">发货地址</th>
      <th class="center">供应商名称</th>
      <th class="center">是否支持退换货</th>
      <th class="center">分类</th>
      <th class="center">销量</th>
      <th class="center">发布时间</th>
      <th class="center">状态</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['goodsCode'];?></td>
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['sendAddress'];?></td>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center">
        <?php 
          if($rs['isTurnBack']=='Y'){
            echo "是";
          }elseif($rs['isTurnBack']=='N'){
            echo "<s style='color:red'>否</s>";
          }
        ?>
      </td>
      <td class="center"><?php echo $rs['goodsClassName'];?></td>
      <td class="center"><?php echo $rs['sellNum'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
        <?php 
          if($rs['status']==1){
            echo "上架";
          }elseif($rs['status']==2){
            echo "下架";
          }elseif($rs['status']==3){
            echo "待审核";
          }elseif($rs['status']==4){
            echo "已驳回";
          }

        ?>
      </td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'goods_list_silver/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link goods_list_silver-delete','url'=>'goods_list_silver/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
        <?php 
          if($rs['status']==2){
            echo form_a_auth(array('content'=>'上架','class'=>'btn-link goods_list_silver-upstore','url'=>'goods_list_silver/upstore','check'=>'goods_list_silver/upstore','rid'=>$rs['id'].','.$rs['goodsCode'],'img'=>'activation.png'));
          }elseif($rs['status']==1){
            echo form_a_auth(array('content'=>'下架','check'=>'goods_list_silver/downstore','class'=>'btn-link goods_list_silver-downstore','url'=>'goods_list_silver/downstore','rid'=>$rs['id'],'img'=>'invalid.png'));
          }elseif ($rs['status']==3) {
            echo form_a_auth(array('content'=>'审核','class'=>'btn-link goods_list_silver-upstore','url'=>'goods_list_silver/upstore','check'=>'goods_list_silver/check','rid'=>$rs['id'].','.$rs['goodsCode'],'img'=>'activation.png'));
          }
        ?>
        <?php 
          if($rs['status']==3){
            echo form_a_auth(array('content'=>'驳回','class'=>'btn-link goods_list_pre','onclick'=>'setReject('.$rs['id'].')','check'=>'goods_list/check','img'=>'reject.png'));
          }
        ?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加商品</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">

var _delete = {};
_delete.body = '确认删除该商品';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_list_silver/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_list_silver-delete',_delete);

var _upstore = {};
_upstore.body = '确认上架该商品';
_upstore.form = $('#mainInfo');
_upstore.url = OO._SRVPATH + 'goods_list_silver/upstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_list_silver-upstore',_upstore);

var _downstore = {};
_downstore.body = '确认下架该商品';
_downstore.form = $('#mainInfo');
_downstore.url = OO._SRVPATH + 'goods_list_silver/downstore?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_list_silver-downstore',_downstore);

</script>
<script type="text/javascript">
  function setReject(zz){
    $.confirm({
      title:'驳回原因',
      body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
      remote:OO._SRVPATH+'goods_list/editReject?mallType=2&id='+zz,
      width: '550px',
      height: '150px',
      okHide: function() {
        $('#savereject').click();
        var isok=true;
        return isok;
      }
    });
  }

</script>