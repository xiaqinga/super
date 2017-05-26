<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">秒抢名称</th>
      <th class="center">标识符</th>
      <th class="center">发布时间</th>
      <th class="center">秒抢时间</th>
      <th class="center">秒抢状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['seckillName'];?></td>
      <td class="center"><?php echo $rs['identifier'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center"><?php echo $rs['startDate']. ' 至 '.$rs['endDate'];?></td>
      <td class="center"><?php if($rs['startDate'] > Date('Y-m-d H:i:s')){echo"待开始";}
                         else if($rs['startDate'] < Date('Y-m-d H:i:s') && $rs['endDate'] > Date('Y-m-d H:i:s')){echo"秒抢中";}
                         else if($rs['endDate'] < Date('Y-m-d H:i:s')){echo"秒抢结束";} ;?>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_seckill/info?id='.$rs['id'].'&ref='.urlencode($ref).'&goodsType=0','img'=>'check.png'));?>
        <?php
          if($rs['startDate'] < Date('Y-m-d H:i:s') && $rs['endDate'] > Date('Y-m-d H:i:s')){
            
          }else{
            echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_seckill/addGoods?id='.$rs['id'].'&ref='.urlencode($ref).'&goodsType=0','img'=>'update.png'));
            echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_seckill_class-delete','url'=>'base_seckill/delete','rid'=>$rs['id'],'img'=>'delete.png'));
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
	      <td class="center">亲，暂无秒抢</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_seckill/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_seckill_class-delete',_delete);
</script>