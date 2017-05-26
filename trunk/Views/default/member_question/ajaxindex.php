<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">姓名(昵称)</th>
      <th class="center">联系方式</th>
      <th class="center">提问内容</th>
      <th class="center">提问时间</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['realName']?:$rs['alias'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>

      <td class="center"><?php echo $rs['details'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center"><?php echo $statusList[$rs['status']];?></td>
      <td class="center">
      	<?php
        if($rs['status']==-1||$rs['status']=='0') {
            echo form_a_auth(array('content' => '启用', 'class' => 'btn-link member_question-upstore', 'url' => 'member_question/upstore', 'check' => 'member_question/upstore', 'rid' => $rs['id'], 'img' => 'activation.png')).'&nbsp;';
        }

         if($rs['status']==1||$rs['status']=='0'){
             echo form_a_auth(array('content'=>'禁用','class'=>'btn-link member_question-downstore','url'=>'member_question/downstore','check'=>'member_question/downstore','rid'=>$rs['id'],'img'=>'invalid.png'));
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
	      <td class="center">亲，还没有提问</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
    var _upstore = {};
    _upstore.body = '确认启用该问题';
    _upstore.form = $('#mainInfo');
    _upstore.url = OO._SRVPATH + 'member_question/upstore?ref=<?php echo urlencode($ref);?>';
    SAYIMO.form.dialog('.member_question-upstore',_upstore);

    var _downstore = {};
    _downstore.body = '确认禁用该问题';
    _downstore.form = $('#mainInfo');
    _downstore.url = OO._SRVPATH + 'member_question/downstore?ref=<?php echo urlencode($ref);?>';
    SAYIMO.form.dialog('.member_question-downstore',_downstore);

</script>