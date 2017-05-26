<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">群发对象</th>
      <th width="50%" class="center">群发内容</th>
      <th class="center">创建时间</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $mass_type[$rs['type']];?></td>
      <td class="center"><?php echo $rs['text'];?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'appmass/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link appmass-delete','url'=>'appmass/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加群发信息</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该群发信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'appmass/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.appmass-delete',_delete);
</script>