<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="4"></th>
    </tr>
    <tr class="thbk">
      <th class="center">商品名称</th>
      <th class="center">自有银积分</th>
      <th class="center">自有银积分百分比(%)</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['points'];?></td>
      <td class="center"><?php echo $rs['pointsPercent'];?></td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'goods_brokerage/info?id='.$rs['id'].'&ref='.urlencode($ref),'check'=>'goods_brokerage/detail','img'=>'check.png'));?>
        <?php if($rs['isGiveScore'] == 1):?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'goods_brokerage/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      <?php endif;?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无积分信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除佣金信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_brokerage/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_brokerage-delete',_delete);
</script>