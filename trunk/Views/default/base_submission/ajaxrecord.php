<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th class="center">姓名</th>
      <th class="center">联系方式</th>
      <th class="center">学校</th>
      <th class="center">投稿内容</th>
      <th class="center">状态</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['subName'];?></td>
      <td class="center"><?php echo $rs['telPhone'];?></td>
      <td class="center"><?php echo $rs['schoolName']?></td>
      <td class="center"><?php echo $rs['subject'];?></td>
      <td class="center"><?php if($rs['status'] == "1"){echo"未入围";}elseif($rs['status'] == '2'){echo"已入围";};?>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_submission/inforecord?id='.$rs['id'].'&sid='.$id.'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php 
          if($rs['status'] == '1'){
            echo form_a_auth(array('content'=>'同意入围','class'=>'btn-link base_position_demand-delete','url'=>'base_submission/upstatus','rid'=>$rs['id'].','.$id,'img'=>'activation.png'));
          }
          ?>
          <?php 
            if($rs['enableStatus'] == '1'){
              echo form_a_auth(array('content'=>'禁用','class'=>'btn-link base_maker_news-delete','url'=>'base_submission/disable','rid'=>$rs['id'].','.$id.',2','img'=>'invalid.png'));
            }else if($rs['enableStatus'] == '2'){
              echo form_a_auth(array('content'=>'启用','class'=>'btn-link base_maker_news-delete','url'=>'base_submission/disable','rid'=>$rs['id'].','.$id.',1','img'=>'confirm.png'));
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
	      <td class="center">亲，暂无投稿记录</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认入围';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_submission/upstatus?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_position_demand-delete',_delete);
</script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认更改?';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_submission/disable?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_maker_news-delete',_delete);
</script>