<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">会员昵称</th>
      <th class="center">会员头像</th>
      <th class="center">真实姓名</th>
      <th class="center">联系方式</th>
      <th class="center">下级会员数</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($list as $rr){?>
  <tr>

    <td class="center"><?php echo $rr['teamName'];?></td>
    <td class="center">队长:<?php echo $rr['alias'];?></td>
    <td class="center"><?php echo $rr['realName'];?></td>
    <td class="center"><?php echo $rr['mobilePhone'];?></td>
    <td class="center"><?php echo $rr['ceateTime'];?></td>
  </tr>
  <?php }?>
  	<?php foreach($list as $rs){?>

    <tr>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><img width="80" src="<?php echo $rs['headPhoto'];?>"/></td>
      <td class="center"><?php echo $rs['realName'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center"><?php echo $rs['subMemberNum'];?>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加团队列表</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
