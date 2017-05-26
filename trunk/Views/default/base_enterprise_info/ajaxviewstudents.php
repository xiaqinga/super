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
          <th class="center">昵称</th>
          <th class="center">真实姓名</th>
          <th class="center">性别</th>
          <th class="center">手机号码</th>
          <th class="center">身份证号码</th>
        </tr>
      </thead>
      <tbody id="goodslist">
        <?php foreach($list as $k=>$item):?>
        <tr data_id="<?php echo $item['id'];?>">
          <td style="text-align: center;">
            <label class="checkbox-pretty inline">
              <input type="radio" name="chk[]" value="<?php echo $item['id'];?>"><span>&nbsp;&nbsp;&nbsp;</span>
            </label>
            <ul class="js_data" style="display: none;">
              <li class="js_customerId"><?php echo $item['id'];?></li>
            </ul>
          </td>
          <td style="text-align: center;">
            <span><img src="<?php echo $item['headPhoto'];?>" alt="" width="30px" height="30px"><?php echo $item['alias'];?></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['realName'];?></span>
          </td>
          <td style="text-align: center;">
            <span><?php if($item['sex'] =='M'){echo "男";}elseif($item['sex']=='W'){echo "女";}?></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['mobilePhone'];?></span>
          </td>
          <td style="text-align: center;">
            <span><?php echo $item['peopleCode'];?></span>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </form>
<?php endif;?>