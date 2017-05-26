<?php if(!empty($list)){?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="9"></th>
    </tr>
    <tr class="thbk">
      <th class="center">企业名称</th>
      <th class="center">捆绑账号</th>
      <th class="center">法人代表</th>
      <th class="center">法人手机</th>
      <th class="center">状态</th>
      <th class="center">地址</th>
      <th class="center">创建时间</th>
      <th class="center">审核时间</th>
      <th class="center">其它操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($list as $rs){?>
    <tr>
      <td class="center"><?php echo $rs['providerName'];?></td>
      <td class="center"><?php echo ($rs['accout'])?$rs['accout']:'--';?></td>
      <td class="center"><?php echo ($rs['corporate'])?$rs['corporate']:'--';?></td>
      <td class="center"><?php echo ($rs['lockPhone'])?$rs['lockPhone']:'--';?></td>
      <td class="center"><?php echo $statuslist[$rs['status']];?></td>
      <td class="center"><?php echo ($rs['address'])?$rs['address']:'--';?></td>
      <td class="center"><?php echo $rs['createTime'];?></td>
      <td class="center"><?php echo $rs['updateTime'];?></td>
      <td class="center">
        <?php echo form_a_auth(array('content'=>'详情','class'=>'btn-link','url'=>APP_URL.'base_supplier/info?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'check.png'));?>
        <?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'base_supplier/edit?id='.$rs['id'].'&ref='.urlencode($ref),'img'=>'update.png'));?>
        <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link provider-delete','url'=>'base_supplier/delete','rid'=>$rs['id'],'img'=>'delete.png'));?>
        <?php echo form_a_auth(array('content'=>'查看绑定会员','class'=>'btn-link','url'=>'base_supplier_info/binding','onclick'=>'binding('.$rs['customerId'].');','img'=>'down.png'));?>

      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }else{?>
<table class="sui-table table-bordered-simple">
  <tbody>
      <tr>
        <td class="center">亲，你还没有添加企业</td>
      </tr>
  </tbody>
</table>
<?php }?>

<?php echo assets::$sayimo; ?>
<script type="text/javascript">

$(function(){

  var _delete = {};
  _delete.body = '确认删除该企业';
  _delete.form = $('#mainInfo');
  _delete.url = OO._SRVPATH + 'base_supplier/delete?ref=<?php echo urlencode($ref);?>';
  SAYIMO.form.dialog('.provider-delete',_delete);

});

function binding(id){
  $.alert({
    title:'绑定会员',
    body: '<div style="text-align:center;padding-top:30px;font-size:15px;"><img src="'+OO._ASSETS+'images/default/loading.gif"><br>努力加载中...</div>',
    remote:OO._SRVPATH+'base_enterprise_info/binding?customerId='+id,
    width: '700px',
    height: '400px',
    shown: function() {
      $(".sui-modal").attr('id',"juniorModal");
    },
    okHide: function() {
    }
  });
}
</script>