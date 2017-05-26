<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="7"></th>
    </tr>
    <tr class="thbk">
      <th class="center">学校编号</th>
      <th class="center">学校名称</th>
      <th class="center">学校地址</th>
      <th class="center">学校简介</th>
      <th class="center">创建时间</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['schoolCode']?:'--';?></td>
      <td class="center"><?php echo $rs['schoolName'];?></td>

      <td class="center"><?php echo $addressPrefix[$rs['areaCode']]['name'].$rs['fullAddress'];?></td>
      <td class="center"><?php echo $rs['description']?:"--";?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
          <?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>APP_URL.'base_school_address/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
          <?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_school_address/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
          <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link appmanager-delete','url'=>'base_school_address/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>

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
    var _delete = {};
    _delete.body = '确认删除该学校';
    _delete.form = $('#mainInfo');
    _delete.url = OO._SRVPATH + 'base_school_address/delete?ref=<?php echo urlencode($ref);?>';
    SAYIMO.form.dialog('.appmanager-delete',_delete);

</script>