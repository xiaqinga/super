<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="8"></th>
    </tr>
    <tr class="thbk">

      <th class="center">评论用户</th>
      <th class="center">评论商品</th>
      <th class="center">订单号</th>
      <th class="center">评论内容</th>
      <th class="center">评论图片</th>
      <th class="center">评论星级</th>
      <th class="center">评论时间</th>
      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['alias'];?></td>
      <td class="center"><?php echo $rs['goodsName'];?></td>
      <td class="center"><?php echo $rs['ordersNo'];?></td>
      <td class="center"><?php echo $rs['commentContent'];?></td>
      <td class="center">
        <?php 
          if(is_array($rs['photoPath'])){
            foreach ($rs['photoPath'] as $key => $value) {
              if($value){
                echo "<a href='$value' target='_blank'><img src='$value' width='80'/></a>";
              }else{
                echo "--";
              }
            }
          }
        ?>
      </td>
      <td class="center"><?php if($rs['commentLevel'] == 1){echo "差评";}
                else if($rs['commentLevel'] == 2 || $rs['commentLevel'] == 3){echo "中评";}
                else if($rs['commentLevel'] == 4 || $rs['commentLevel'] == 5){echo "好评";}
                ;?>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center">
        <a href="javascript:void(0);" class="sui-btn btn-link" data-url="goods_comment/info?id=<?php echo $rs['id']?>&ref=<?php echo $ref?>" title="详情">
          <img class="imgtable" src="<?php echo ASSETS_URL?>images/default/check.png">
        </a>
        <a href="javascript:void(0);" class="sui-btn btn-link" data-url="goods_comment/edit?id=<?php echo $rs['id']?>&ref=<?php echo $ref?>" title="评论回复">
          <img class="imgtable" src="<?php echo ASSETS_URL?>images/default/update.png">
        </a>
        <!-- <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link goods_comment-delete','url'=>'goods_comment/delete','rid'=>$rs['id'],'img'=>'delete.png'));?> -->
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">没有您要找的内容</td>
    	</tr>
	</tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该信息';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'goods_comment/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.goods_comment-delete',_delete);
</script>
