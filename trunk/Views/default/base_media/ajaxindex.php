<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th width="3%" class="center">ID</th>
      <th class="center">标题</th>
      <th class="center">标题缩略图</th>
      <th class="center">所属分类</th>
      <th class="center">标识符</th>
      <th class="center">创建时间</th>
      <th class="center">排序</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['id'];?></td>
      <td class="center"><?php echo $rs['title'];?></td>
      <td class="center">
        <?php if($rs['photoUrl']):?>
          <img width="75" src="<?php echo $rs['photoUrl'];?>" />
        <?php else:?>
          --
        <?php endif;?>
      </td>
      <td class="center"><?php echo $classList[$rs['classId']]?$classList[$rs['classId']]:'--';?></td>
      <td class="center"><?php echo $rs['mark']?$rs['mark']:'--';?></td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center"><?php echo $rs['sort'];?></td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_media/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_media-delete','url'=>'base_media/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加富媒体</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该富媒体';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_media/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_media-delete',_delete);
</script>