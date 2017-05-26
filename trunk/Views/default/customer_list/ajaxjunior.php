<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="10"></th>
    </tr>
    <tr class="thbk">
       <th class="center">下级会员帐号</th>
       <th class="center">下级会员昵称</th>
       <th class="center">会员类型</th>
       <th class="center">加入时间</th>
       <th class="center">状态</th>
       <th class="center">奖励规则</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo  $rs['accout'];?></td>
      <td class="center"><?php echo  $rs['alias']?$rs['alias']:'--';?></td>
      <td class="center">
          <?php echo ($rs['makerLevel']||$rs['providerType'])?'':'普通会员&nbsp;' ;?>
          <?php  if($rs['providerType']){ echo ($rs['providerType']==1?'供应':'联盟').'商&nbsp;' ; } ?>
          <?php  if($rs['makerLevel']){  echo ($rs['makerLevel']==1?'金':'银').'星创客' ;}?>
    </td>
      <td class="center"><?php echo $rs['createDate'];?></td>
      <td class="center"><?php echo $rs['status']==1?'正常':'注销';?></td>
      <td class="center">
        <select name="awardRule" class="awardRule">
            <?php  foreach($awardRule_list as $key=>$val):?>
            <option value="<?php  echo $key?>"  <?php  echo   ($key==$rs['awardRule'])?'selected':''?>   ><?php echo  $val?></option>
            <?php  endforeach; ?>
        </select>
        <input  type="hidden" value="<?php  echo $rs['id']?>" />
      
      </td>
    </tr>
    <?php }?>
  </tbody>
 </table>

    <div id="tips" style="text-align:center;padding-top:30px;font-size:15px;display: none">
        <div class="sui-loading loading-inline"><i class="sui-icon icon-pc-loading"></i></div>
        <br>努力加载中...</div>

<!--  <div id="tips" style="text-align:center;padding-top:30px;font-size:15px;display: none">
      <img src="<?php /*echo ASSETS_URL;*/?>images/default/loading.gif">
      <br>努力加载中...</div>,-->

<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，该会员还没有下级会员</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
    $('.awardRule').on('change',function(){
        var _cur=$(this);
        $.confirm({
            title:'提示',
            body:'确定修改该下级会员的奖励规则吗',
            okHide: function() {
                $('#tips').show();
                 var id=_cur.next('input').val();
                 var awardRule=_cur.val();
                $.post(OO._SRVPATH+'customer_list/save',{id:id,awardRule:awardRule},function(d){
                    $('#tips').hide(); 
                    if(1==d.status){
                        $.alert('修改成功');
                    }else{
                        $.alert('修改失败');
                    }
                },'json')
            }
        });


    })
</script>