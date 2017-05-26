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
      <tbody>
        <tr>
            <?php foreach($list as $k=>$item):
              $json_telPhone = htmlspecialchars(strip_tags($item['telPhone']));
              $json_industry = htmlspecialchars(strip_tags($item['industry']));
              $json_address = htmlspecialchars(strip_tags($item['address']));
              $json_description = htmlspecialchars(strip_tags($item['description']));
              $json_website = htmlspecialchars(strip_tags($item['website']));
              $json_hrman = htmlspecialchars(strip_tags($item['hrman']));
              $json_hrPhone = htmlspecialchars(strip_tags($item['hrPhone']));
            ?>
          <td style="text-align: center;" class="js_btn_item" data_id="<?php echo $item['id'];?>">
            <div style="display: none;">
              <span class="json_name"><?php echo $item['providerName'];?></span>
              <span class="json_telPhone"><?php echo $json_telPhone;?></span>
              <span class="json_industry"><?php echo $json_industry;?></span>
              <span class="json_address"><?php echo $json_address;?></span>
              <span class="json_description"><?php echo $json_description;?></span>
              <span class="json_website"><?php echo $json_website;?></span>

              <span class="json_hrman"><?php echo $json_hrman;?></span>
              <span class="json_hrPhone"><?php echo $json_hrPhone;?></span>
            </div>
            <span><?php echo $item['providerName'];?></span>
          </td>
            <?php if(($k+1)%1 == 0){ echo "</tr><tr>";}?>
            <?php endforeach;?>
        </tr>
      </tbody>
    </table>
<?php endif;?>