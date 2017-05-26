<style>
 .len{
     width:200px;
     word-break: break-all !important;
 }
</style>

<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="10"></th>
    </tr>
    <tr class="thbk">
      <th class="center">用户账号</th>
      <th class="center">供应商\联盟商</th>
      <th class="center">会员昵称</th>
      <th class="center">真实姓名</th>
      <th class="center">捆绑手机号</th>
      <th class="center">会员类型</th>
      <th class="center">状态</th>

      <th class="center">其他操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['accout'];?></td>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center len"><?php echo $rs['alias'];?></td>
      <td class="center len"><?php echo $rs['realName'];?></td>
      <td class="center"><?php echo $rs['mobilePhone'];?></td>
      <td class="center">
              <?php echo ($rs['makerLevel']||$rs['providerType'])?'':'普通会员&nbsp;' ;?>
              <?php  if($rs['providerType']){ echo ($rs['providerType']==1?'供应':'联盟').'商&nbsp;' ; } ?>
              <?php  if($rs['makerLevel']){  echo ($rs['makerLevel']==1?'金':'银').'星创客' ;}?>
      </td>

      <td class="center"><?php echo $rs['status']==1?'正常':'注销';?></td>
      <td class="center">
		  <?php echo form_a_auth(array('content'=>'绑定店铺信息','class'=>'btn-link','url'=>'customer_list/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'setup.png'));?>
		  <?php echo form_a_auth(array('content'=>'二维码下载','class'=>'btn-link ','url'=>'customer_list/download','onclick'=>'downImg(\''.$rs['matrixUrl'].'\');','img'=>'download.png'));?>
      	<?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'customer_list/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'查看下级会员','class'=>'btn-link','url'=>'customer_list/parent','onclick'=>'junior('.$rs['id'].');','img'=>'down.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，还没有会员</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script language="javascript" type="text/javascript">
function junior(id){
	$.alert({
    	title:'下级会员',
    	body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
    	remote:OO._SRVPATH+'customer_list/junior?id='+id,
    	width: '700px',
    	height: '400px',
    	shown: function() {
    		$(".sui-modal").attr('id',"juniorModal");
    	},
    	okHide: function() {
    	}
	});
}

function downImg(url){
    if(''==url){
        $.alert('该会员没有二维码哦!');
        return false;
    }
    window.open('<?php echo APP_URL?>customer_list/imageDdownload?url='+url);

}


</script>