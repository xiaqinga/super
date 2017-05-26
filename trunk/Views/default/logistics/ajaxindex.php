<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center" width="20%">运费模板名称</th>
      <th class="center" width="10%">快递公司</th>
      <th class="center" width="20%">源发送地</th>
      <th class="center" width="20%">发送目的地</th>
      <th class="center" width="5%">首件(重)</th>
      <th class="center" width="5%">首费(元)</th>
      <th class="center" width="5%">续件(重)</th>
      <th class="center" width="5%">续费(元)</th>
      <th class="center" width="10%">其它操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['logisticsName'];?></td>
      <td class="center"><?php echo $rs['expressCompanyName'].'('.$logisticsTypeList[$rs['logisticsType']].')';?></td>
      <td class="center"><?php echo $rs['sourceSendAddress'];?></td>
      <td class="center" colspan="5">
      	<?php if(count($rs['areaCodeListStr']>0)){?>
      		<table class="sui-table table-bordered-simple" width="100%">
      			<tbody>
      		<?php foreach($rs['areaCodeListStr'] as $key=>$val){?>
      				<tr>
      					<td class="center" width="50%"><?php echo $val['destinations'];?></td>
      					<td class="center" width="12%"><?php echo $val['firstItem'];?></td>
					      <td class="center" width="12%"><?php echo $val['firstCost'];?></td>
					      <td class="center" width="12%"><?php echo $val['addItem'];?></td>
					      <td class="center" width="12%"><?php echo $val['addCost'];?></td>
      				</tr>
      		<?php }?>
      			</tbody>
      		</table>
      	<?php }?>
      </td>
      <td class="center">
      	<?php echo form_a_auth(array('content'=>'查看','class'=>'btn-link','url'=>'logistics/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
      	<?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>'logistics/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
      	<?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link logistics-delete','url'=>'logistics/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加运费规则</td>
    	</tr>
	</tbody>
</table>
<?php }?>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
var _delete = {};
_delete.body = '确认删除该运费模板';
_delete.form = $('#mainInfo');
_delete.url = OO._SRVPATH + 'logistics/delete?ref=<?php echo urlencode($ref);?>';
SAYIMO.form.dialog('.logistics-delete',_delete);
</script>