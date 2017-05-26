<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">操作员</th>
      <th class="center">类型</th>
      <th class="center">操作时间</th>
      <th class="center">操作内容</th>
      <th class="center">IP地址</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['userName'];?></td>
      <td class="center"><?php echo $actionTypeList[$rs['actionType']];?></td>
      <td class="center"><?php echo $rs['actionDate'];?></td>
      <td class="center"><?php echo $rs['actionContent'];?></td>
      <td class="center"><?php echo $rs['actionIp'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'actionLog/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有操作日志</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>