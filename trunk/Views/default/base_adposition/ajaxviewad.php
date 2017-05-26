<?php if ($list && is_array($list)):?>
    <table class="sui-table table-bordered-simple" id="page<?php echo $key+1;?>" <?php if($key+1 != 1){echo 'style="display:none;"';}?> >
      <tbody>
        <tr>
            <?php foreach($list as $k=>$item):?>
          <td>
            <ul class="adlist" adpositionId="<?php echo $item['id'];?>" class="J_addlistAd">
              <li>
                <?php if($item['photoUrl']):?>
                  <img width="130" src="<?php echo $item['photoUrl'];?>"/>
                <?php else:?>
                  --
                <?php endif;?>
              </li>
              <li><span class="adlist_item"><?php echo $item['adName'];?></span></li>
            </ul>
            <br/>
          </td>
            <?php if(($k+1)%5 == 0){ echo "</tr><tr>";}?>
            <?php endforeach;?>
        </tr>
      </tbody>
    </table>
<?php endif;?>