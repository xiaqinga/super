<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">学校</th>
      <th class="center">姓名</th>
      <th class="center">联系方式</th>
      <th class="center">是否签到</th>
      <th class="center">签到时间</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['schoolName'];?></td>
      <td class="center"><?php echo $rs['realName'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['signStatus']==1?'是':'否'?></td>
      <td class="center"><?php echo $rs['signStatus']==1?$rs['signDate']:'--';?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'sign/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
     </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加用户</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
