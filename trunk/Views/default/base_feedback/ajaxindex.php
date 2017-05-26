<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">用户昵称</th>
      <th class="center">反馈类型</th>
      <th class="center">反馈内容</th>
      <th class="center">反馈时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['contentType']==1?'意见':'问题';?></td>
      <td class="center"><?php echo mb_substr($rs['content'],0,15);?></td>
	    <td class="center"><?php echo $rs['createTime'];?>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_feedback/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，暂无反馈信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该赏金信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_reward/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_maker_news-delete',_delete);
</script>