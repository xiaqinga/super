<style type="text/css">
  .sui-table.table-bordered-simple {
    border-collapse:initial;
  }
  .company_ajaxlist tr:hover{
    background-color: #2196f3;
    cursor: pointer;
  }
  .company_ajaxlist tr:hover span{
    color: white;
  }
</style>
<?php if ($list && is_array($list)):?>
    <table class="sui-table table-bordered-simple company_ajaxlist" id="page<?php echo $key+1;?>" <?php if($key+1 != 1){echo 'style="display:none;"';}?> >
      <thead>
        <tr class="thbk">
          <th class="center">运费模板名称</th>
          <th class="center">快递公司</th>
          <th class="center">源发送地</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($list as $k=>$item):?>
        <tr class="js_btn_item" data_id="<?php echo $item['id'];?>">
          <td style="text-align: center;">
            <span class="lname"><?php echo $item['logisticsName'];?></span>
          </td>
          <td style="text-align: center;">
            <span class="cname"><?php echo $item['expressCompanyName'];?></span>
          </td>
          <td style="text-align: center;">
            <span class="adr"><?php echo $item['sourceSendAddress'];?></span>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
<?php endif;?>