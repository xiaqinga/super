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
  <form class="sui-form">
    <table class="sui-table table-bordered-simple company_ajaxlist" id="page<?php echo $key+1;?>" <?php if($key+1 != 1){echo 'style="display:none;"';}?> >
      <thead>
        <tr class="thbk">
          <th></th>
          <th class="center">商品名称</th>
          <th class="center">最高价格</th>
          <th class="center">最低价格</th>
          <th class="center">状态</th>
        </tr>
      </thead>
      <tbody id="goodslist">
        <?php foreach($list as $k=>$item):?>
        <tr data_id="<?php echo $item['id'];?>">
          <td style="text-align: center;">
            <label class="checkbox-pretty inline">
              <input type="checkbox" name="chk[]" value="<?php echo $item['id'];?>"><span>&nbsp;&nbsp;&nbsp;</span>
            </label>
            <ul class="js_data" style="display: none;">
              <li class="js_providerName"><?php echo $item['providerName'];?></li>
              <li class="js_goodsName"><?php echo $item['goodsName'];?></li>
              <li class="js_preferentialPrice"><?php echo $item['highestPrice'];?></li>
              <li class="js_stockNum"><?php echo $item['stockNum'];?></li>
              <li class="js_originalPrice"><?php echo $item['originalPrice'];?></li>
              <li class="js_activityPrice"><?php echo $item['highestPrice'];?></li>
              <li class="js_activityNum"><?php echo $item['stockNum'];?></li>
              <li class="js_photoPath"><?php echo $item['photoPath'];?></li>
              <li class="js_goodsId"><?php echo $item['id'];?></li>
            </ul>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['goodsName'];?><img src="<?php echo $item['photoPath'];?>" alt="" width="30px" height="30px"></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['highestPrice'];?></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['lowestPrice'];?></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $statusList[(int)$item['status']];?></span>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </form>
<?php endif;?>