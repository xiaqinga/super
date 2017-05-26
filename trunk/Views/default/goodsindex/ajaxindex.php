<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="5"></th>
    </tr>
    <tr class="thbk">
      <th class="center">模板名称</th>
      <th class="center">模板标识符</th>
      <th class="center">位置说明</th>
      <th class="center">创建时间</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['templateName'];?></td>
      <td class="center"><?php echo $rs['identifier'];?></td>
      <td class="center"><?php echo $rs['description'];?></td>
      <td class="center"><?php echo $rs['createTime'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>APP_URL.'goodsindex/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'goodsindex/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
    <!--  	<?php /*echo form_a_auth(array('content'=>'删除','class'=>'btn-link goodsindex-delete','url'=>'goodsindex/delete','rid'=>$rs['id'],'img'=>'delete.png'));*/?>
     --> </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加首页模板</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该首页模板';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goodsindex/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goodsindex-delete',_delete);
</script>