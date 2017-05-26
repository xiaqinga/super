<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">
      <th class="center">文章标题</th>
      <th class="center">标题缩略图</th>
      <th class="center">来源</th>
      <th class="center">创建时间</th>
      <th class="center">排序</th>
	  <th class="center">状态</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['title'];?></td>
      <td class="center">
        <?php if($rs['photoUrl']):?>
          <img width="75" src="<?php echo $rs['photoUrl'];?>" />
        <?php else:?>
          --
        <?php endif;?>
      </td>
     
	  <td class="center"><?php echo $rs['source'];?>
      <td class="center"><?php echo $rs['createDate'];?></td>
	  <td class="center"><?php echo $rs['sort'];?></td>
	  <td class="center"><?php if($rs['status'] == 1){echo "启用";}else{echo "禁用";};?>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','check'=>'base_school_news/detail','url'=>APP_URL.'base_school_news/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_school_news/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link base_school_news-delete','url'=>'base_school_news/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加校企快讯</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该快讯';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'base_school_news/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.base_school_news-delete',_delete);
</script>