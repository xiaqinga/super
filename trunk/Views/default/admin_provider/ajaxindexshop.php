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
    <table class="sui-table table-bordered-simple company_ajaxlist" >
      <tbody>
        <tr>
            <?php foreach($list as $k=>$item):?>
          <td style="text-align: center;" class="js_btn_item" data_id="<?php echo $item['id'];?>" data_code="<?php echo $item['providerCode'];?>" data_bid="<?php echo $item['bid'];?>" data_type="2">
          <!-- data_bid="<?php echo $item['bid'];?>" -->
            <span><?php echo ($item['providerName'])?$item['providerName']:$item['providerCode'];?></span>
          </td>
            <?php if(($k+1)%1 == 0){ echo "</tr><tr>";}?>
            <?php endforeach;?>
        </tr>
      </tbody>
    </table>
<?php else:?>
  <table class="sui-table table-bordered-simple company_ajaxlist" >
      <tbody>
        <tr>
          
          <td style="text-align: center;" class="js_btn_item" data_id="<?php echo $item['id'];?>" data_code="">
            <span>未找到符合条件的供应商~</span>
          </td>
            
        </tr>
      </tbody>
    </table>
<?php endif;?>