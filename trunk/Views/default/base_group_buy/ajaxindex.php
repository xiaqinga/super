<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">活动名称</th>
      <th class="center">商品名称</th>
      <th class="center">团购价格</th>
      <th class="center">团购人数</th>
      <th class="center">团购时间</th>
      <th class="center">发布时间</th>
      <th class="center">状态</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
     
      <td class="center"><?php echo $rs['name'];?></td>
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['price'];?></td>
      <td class="center"><?php echo $rs['number'];?></td>
      <td class="center"><?php echo $rs['startDate'].'至'.$rs['endDate'];?></td>
      <td class="center"><?php echo $rs['createTime'];?></td>
      <td class="center">
         <?php if($rs['startDate'] > Date('Y-m-d H:i:s')){echo"待开始";}
               else if($rs['startDate'] < Date('Y-m-d H:i:s') && $rs['endDate'] > Date('Y-m-d H:i:s')){echo"活动中";}
               else if($rs['endDate'] < Date('Y-m-d H:i:s')){echo"活动结束";} ;?>
      </td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_group_buy/info?id='.$rs['id'].'&goodsType='.$rs['goodsType'].'&goodsId='.$rs['goodsId'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
        <?php 
          if($rs['endDate']<Date('Y-m-d H:i:s')){}else{
          echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>'base_group_buy/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));}?>
        <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_group_buy-delete','url'=>'base_group_buy/delete','rid'=>$rs['id'].','.$rs['identifier'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{ ?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没添加团购信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除团购';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_group_buy/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_group_buy-delete',_delete);
</script>