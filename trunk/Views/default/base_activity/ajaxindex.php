<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">活动名称</th>
      <th class="center">标识符</th>
      <th class="center">商品名称</th>
      <th class="center">发布时间</th>
      <th class="center">有效期</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['activityName'];?></td>
      <td class="center"><?php echo $rs['identifier'];?></td>
      <td class="center"><?php echo $rs['first_goodsname'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center"><?php echo $rs['startDate']. ' 至 '.$rs['endDate'];?></td>
      <td class="center"><?php if($rs['startDate'] > Date('Y-m-d')){echo"活动待开始";}
                         else if($rs['startDate'] < Date('Y-m-d') && $rs['endDate'] > Date('Y-m-d')){echo"活动中";}
                         else if($rs['endDate'] < Date('Y-m-d')){echo"活动结束";} ;?>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_activity/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
        <?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_activity/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_activity_class-delete','url'=>'base_activity/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有活动管理</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_activity/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_activity_class-delete',_delete);
</script>