<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <?php if(2==$transferStatus||4==$transferStatus):?>
        <th colspan="10"></th>
      <?php else:?>
      <th colspan="<?php echo ($transferStatus!=1)?9:8 ;?>"></th>
      <?php endif;?>
    </tr>
    <tr class="thbk">
      <?php if($transferStatus!=1):?>
      <th class="center">批次号</th>
      <?php endif;?>
      <th class="center">申请账号</th>
      <th class="center">订单号</th>
      <th class="center">姓名</th>
      <th class="center">来源支行</th>
      <th class="center">银行卡号</th>
      <th class="center">申请金额</th>
      <th class="center">类型</th>
      <?php if($transferStatus==4):?>
        <th class="center">失败原因</th>
      <?php endif ?>
      <th class="center">创建时间</th>
      <?php if($transferStatus==2):?>
        <th class="center">其他操作</th
      <?php endif ?>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <?php if($transferStatus!=1):?>
      <td class="center"><?php echo $rs['transferBatchCode'];?></td>
      <?php endif;?>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['emsNo'];?></td>
      <td class="center"><?php echo $rs['bankBindUserName'];?></td>
      <td class="center"><?php echo $rs['bindType']==1?'支付宝':$rs['bankBranchName'];?></td>
      <td class="center"><?php echo $rs['bankCodeNo'];?></td>
      <td class="center"><?php echo $rs['money'];?></td>
      <td class="center"><?php if($rs['infotype']=='1'){echo "供应商提现";}elseif($rs['infotype']=='2'){echo "联盟商提现";}elseif($rs['infotype']=='3'){echo "个人提现";}?></td>
      <?php if($transferStatus==4):?>
        <td class="center">
          <?php echo $rs['failureCause'];?>
      </td>
      <?php endif;?>

      <td class="center"><?php echo $rs['createDate'];?></td>


      <?php if($transferStatus==2):?>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'转帐失败','class'=>'btn-link goods_list-delete','check'=>'transfer/fail','onclick'=>'transferFail('.$rs['infotype'].','.$rs['id'].')','img'=>'invalid.png'));?>
      </td>
      <?php endif;?>

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
  function  transferFail(infotype,id){
    $.confirm({
      title: '确认',
     body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
     remote:OO._SRVPATH+'transfer/failure?infotype='+infotype+'&id='+id,
     width: '550px',
     height: '150px',
     shown: function(){
        $(".sui-modal").addClass("failuremodal");
      },
     okHide: function() {

       $('#savereject').click();
       var failureCause=$('.failureCause').val();

       if(''==failureCause){
         return  false;
       }
       $(".failuremodal").remove();
      }

    });

  }
</script>
