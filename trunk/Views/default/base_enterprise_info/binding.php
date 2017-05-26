
<div class="customerjunior-list">


    <?php if(!empty($id)){?>
        <table class="sui-table table-bordered-simple">
            <thead>
            <tr class="thbg">
                <th colspan="10"></th>
            </tr>
            <tr class="thbk">
                <th class="center">绑定会员帐号</th>
                <th class="center">绑定会员昵称</th>
                <th class="center">状态</th>
               <!-- <th class="center">其他操作</th>-->
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center"><?php echo   $accout;?></td>
                    <td class="center"><?php echo   $alias?$alias:'--';?></td>
                    <td class="center"><?php echo   $status==1?'正常':'注销';?></td>
                    <!--<td class="center">
                        <a href="javascript:void(0);" class="sui-btn btn-link"  onclick="bindingSave('<?php /*echo $id*/?>','<?php /*echo $refId*/?>')" title="取消绑定">
                            <img class="imgtable" src="<?php /*echo  ASSETS_URL*/?>images/default/update.png">
                        </a>
                    
                    </td>-->
                </tr>
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
                <td class="center">亲，该企业没有绑定的会员</td>
            </tr>
            </tbody>
        </table>
    <?php }?>

</div>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
   function bindingSave(customer_id,enterprise_id){
       $.confirm({
           title:'提示',
           body:'确定解绑该会员吗',
           okHide: function() {
               $('#tips').show();
               $.post(OO._SRVPATH+'base_enterprise_info/bindingSave',{customer_id:customer_id,enterprise_id:enterprise_id},function(d){
                   $('#tips').hide();
                   if(1==d.status){
                       var container = $("#juniorModal").find("div .modal-body");
                       OO.loading(container);
                       container.load(OO._SRVPATH+"base_enterprise_info/binding");
                      $('#mainInfo').find("div.provider-list").load('<?php echo $ref?>');
                      /* OO.loading(mainInfo);
                       mainInfo.load('<?php echo $ref?>');*/

                   }else{
                       $.alert('修改失败');
                   }
               },'json')
           }
       });
       
       
       
   }
</script>