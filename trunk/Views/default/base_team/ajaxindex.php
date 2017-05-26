<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">参数团队名称</th>
      <th class="center">队长名称</th>
      <th class="center">联系方式</th>
      <th class="center">当前累计消费额</th>
      <th class="center">排名</th>
      <th class="center">活动有效期</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['teamName'];?></td>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['expense'];?></td>
      <td class="center"><?php echo $rs['expenseRank'];?></td>
      <td class="center"><?php echo $rs['startDate'].'---'.$rs['endDate']?>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加校企分类</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
