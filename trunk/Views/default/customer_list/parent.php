<div class="customerjunior-list">
	<table class="sui-table table-bordered-simple">
	  <thead>
	    <tr class="thbg">
	      <th colspan="5"></th>
	    </tr>
	    <tr class="thbk">
	      <th class="center">会员账号</th>
	      <th class="center">会员昵称</th>
	      <th class="center">会员类型</th>
	      <th class="center">加入时间</th>
	      <th class="center">状态</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if($id){?>
	  	<tr>
	      <td class="center"><?php echo $accout;?></td>
	      <td class="center"><?php echo $alias;?></td>
	      <td class="center"><?php echo $customerTypelist[$customerType];?></td>
	      <td class="center"><?php echo $createDate;?></td>
	      <td class="center"><?php echo ($status)?'正常':'注销';?></td>
	    </tr>
	    <?php }else{?>
	    	<td class="center" colspan="5">该会员没有上级会员</td>
	    <?php }?>
	  </tbody>
	</table>
</div>