<?php 
/*
 *编辑组合商品时,获取商品组合开始
 *303232810@qq.com
 *2016-08-20
*/
//显示组合商品
//
if ( $items && is_array($items) && count($items)):
    foreach($items as $key=>$item):
        if(!empty($item['normsValueA']) && !empty($item['normsValueB'])):
            echo '<tr partgoods_id="'.$item['id'].'" norms_a="'.$item['normsValueAId'].'" norms_b="'.$item['normsValueBId'].'" normsvalue_b_add="'.$item['normsvalue_b_add'].'" normsvalue_a_add="'.$item['normsvalue_a_add'].'" class="js_sizes_1_'.$item['normsValueAId'].'_'.$item['normsValueAOrder'].' js_sizes_2_'.$item['normsValueBId'].'_'.$item['normsValueBOrder'].'">'.
                    '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'.$item['normsValueA'].'</td>'.
                    '<td class="js_sizes_b" style="word-break: break-all;word-wrap:break-word;">'.$item['normsValueB'].'</td>'.
                   // '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" type="text" value="'.$item['restockPrice'].'"></td>'.
                '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" value="'.$item['preferentialPrice'].'"></td>'.
                '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value="'.$item['stockNum'].'"></td>'.
                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value="'.$item['weight'].'"></td>'.
                    // '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_originalPrice" type="text" value="'.$item['originalPrice'].'"></td>'.
               '</tr>';
        elseif(!empty($item['normsValueA'])):
            echo '<tr partgoods_id="'.$item['id'].'" norms_a="'.$item['normsValueAId'].'" normsvalue_a_add="'.$item['normsvalue_a_add'].'" class="js_sizes_1_'.$item['normsValueAId'].'_'.$item['normsValueAOrder'].'">'.
                    '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'.$item['normsValueA'].'</td>'.
                    //'<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" type="text" value="'.$item['restockPrice'].'"></td>'.
                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" value="'.$item['preferentialPrice'].'"></td>'.
                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value="'.$item['stockNum'].'"></td>'.
                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value="'.$item['weight'].'"></td>'.
                    // '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_originalPrice" type="text" value="'.$item['originalPrice'].'"></td>'.
                      '</tr>';
        endif;
    endforeach;
endif;
?>
<script type="text/javascript">

  var thead_out = document.querySelector('.js_header');  //列表头部
  org_select_b_id = false; // 初始化未选择A项目
  org_select_b_id = false; // 初始化未选择B项目
  $("#norms_edit-form").on('keyup', 'input', function(){
    $(".js_btn_submit").show(); //显示确认
  })
  $("#norms_edit-form").on('change', 'input', function(){
    $(".js_btn_submit").show(); //显示确认
  })


  var getPartIds = new Array();
  var savePartIds = new Array();
  var delPartIds = new Array();
<?php 
    if ( $items && is_array($items)):
        foreach(array_reverse($items) as $key=>$item):
            echo "getPartIds.push(".$item['id'].");\n";
        endforeach;
    endif;
?>

<?php if( count($sizesitems['titleB'])>0 ):?>
    //--->显示规格B标题
    var thead = document.querySelector('.js_header tr.thbk');  //列表头部 tr
    thead_out.style.display="";
    var th = document.createElement('th'); 
    var text = document.createTextNode('<?php echo $sizesitems['titleB']['name'];?>');
    th.appendChild(text);
    var att=document.createAttribute("class");
        att.value="center";
    var att_id=document.createAttribute("id");
        att_id.value="th_2";
    th.setAttributeNode(att);
    th.setAttributeNode(att_id);
    thead.insertBefore(th,thead.childNodes[0]);
    //<---显示规格A标题结束
    
    //当前规格选项
    <?php if($sizesitems['titleB']['id']):?>
            Size.delSizeItem(2,<?php echo $sizesitems['titleB']['id'];?>); 
            $(".selectSizeB").find(".dropdown-toggle").find("span").html("<?php echo $sizesitems['titleB']['name'];?>");
            org_select_b_id = true; // 已选规格B项目
            $("#normsbId").val(<?php echo $sizesitems['titleB']['id'];?>);
    <?php endif;?>
<?php endif;?>

<?php if( count($sizesitems['titleA'])>0 ):?>
    //--->显示规格A标题
    var thead = document.querySelector('.js_header tr.thbk');  //列表头部 tr
    thead_out.style.display="";
    var th = document.createElement('th'); 
    var text = document.createTextNode('<?php echo $sizesitems['titleA']['name'];?>');
    th.appendChild(text);
    var att=document.createAttribute("class");
        att.value="center";
    var att_id=document.createAttribute("id");
        att_id.value="th_1";
    th.setAttributeNode(att);
    th.setAttributeNode(att_id);
    thead.insertBefore(th,thead.childNodes[0]);
    //<---显示规格A标题结束

    //当前规格选项
    <?php if($sizesitems['titleA']['id']):?>
            Size.delSizeItem(1,<?php echo $sizesitems['titleA']['id'];?>); 
            $(".selectSizeA").find(".dropdown-toggle").find("span").html("<?php echo $sizesitems['titleA']['name'];?>");
            org_select_a_id = true; // 已选规格A项目
            $("#normsaId").val(<?php echo $sizesitems['titleA']['id'];?>);
    <?php endif;?>
<?php endif;?>

<?php if( count($sizesitems['sizesA'])>0 ):?>
   //--->输出规格A的值
  var fragment = document.createDocumentFragment();
  var ul = document.querySelectorAll('.js_attr_list');
  <?php foreach ($sizesitems['sizesA'] as $key => $value):?>
          <?php if($value['chk']):?>
                  checked = 'checked';
                  //当前规格A
                  //添加元素到当前选项A
                  sizeItem.A.push({
                             "id":<?php echo $value['id'];?>,
                             "value":"<?php echo $value['value'];?>",
                             "order":"<?php echo $value['order'];?>",
                             "add":<?php echo $value['add'];?>
                          });
          <?php else:?>
                  checked = '';
          <?php endif;?>
          li = document.createElement('li');
          li.className = 'checkbox-item <?php echo $value['add'] ? "Js_addNorms" : "";?>';
          li.innerHTML =  '<label class="checkbox-pretty inline '+checked+'">'+
                            '<input <?php echo $value['chk'] ? 'checked="checked"' : "";?> id="val_1_<?php echo $value['id'];?>_<?php echo $value['order'];?>" data='+'[{"size":"1","id":"<?php echo $value['id'];?>","value":"<?php echo $controller->strfilter($value['value']);?>","order":"<?php echo $value['order'];?>"}]'+' type="checkbox" onclick="Size.autoSizesGoods(this);"><span><input <?php echo $value['add'] ? "" : "disabled";?> id="val_input_1_<?php echo $value['order'];?>" type="text" value="<?php echo $value['value'];?>" onkeyup="Size.fixAttrItem(this.parentNode,this);" class="input-medium norms-input"></span>'+
                          '</label>'+
                          '<i data='+'[{"size":"1","id":"<?php echo $value['id'];?>","value":"<?php echo $value['value'];?>","order":"<?php echo $value['order'];?>"}]'+' onclick="Size.delAttrItem(this.parentNode,this);" class="sui-icon icon-remove-sign"></i>';

          fragment.appendChild(li);
  <?php endforeach;?>
          ul[0].insertBefore(fragment,ul[0].childNodes[0]);
  //<---输出规格A的值结束
<?php endif;?>

<?php if( count($sizesitems['sizesB'])>0 ):?>
   //--->输出规格B的值
  var fragment = document.createDocumentFragment();
  var ul = document.querySelectorAll('.js_attr_list');
  <?php foreach ($sizesitems['sizesB'] as $key => $value):?>
          <?php if($value['chk']):?>
                  checked = 'checked';
                  //当前规格B
                  //添加元素到当前选项B
                  sizeItem.B.push({
                             "id":<?php echo $value['id'];?>,
                             "value":"<?php echo $value['value'];?>",
                             "order":"<?php echo $value['order'];?>",
                             "add":<?php echo $value['add'];?>
                          });
          <?php else:?>
                  checked = '';
          <?php endif;?>

          li = document.createElement('li'); 
          li.className = 'checkbox-item <?php echo $value['add'] ? "Js_addNorms" : "";?>';
          li.innerHTML =  '<label class="checkbox-pretty inline '+checked+'">'+
                            '<input <?php echo $value['chk'] ? 'checked="checked"' : "";?> id="val_2_<?php echo $value['id'];?>_<?php echo $value['order'];?>" data='+'[{"size":"2","id":"<?php echo $value['id'];?>","value":"<?php echo $controller->strfilter($value['value']);?>","order":"<?php echo $value['order'];?>"}]'+' type="checkbox" onclick="Size.autoSizesGoods(this);"><span><input <?php echo $value['add'] ? "" : "disabled";?> id="val_input_2_<?php echo $value['order'];?>" type="text" value="<?php echo $value['value'];?>" onkeyup="Size.fixAttrItem(this.parentNode,this);" class="input-medium norms-input"></span>'+
                          '</label>'+
                          '<i data='+'[{"size":"2","id":"<?php echo $value['id'];?>","value":"<?php echo $value['value'];?>","order":"<?php echo $value['order'];?>"}]'+' onclick="Size.delAttrItem(this.parentNode,this);" class="sui-icon icon-remove-sign"></i>';

          fragment.appendChild(li);
  <?php endforeach;?>
          ul[1].insertBefore(fragment,ul[1].childNodes[0]);
  //<---输出规格B的值结束
<?php endif;?>


var record = {
    num: ""
}
var checkDecimal = function(n) {
    var decimalReg = /^\d{0,8}\.{0,1}(\d{1,2})?$/;
    if (n.value != "" && decimalReg.test(n.value)) {
        record.num = n.value
    } else {
        if (n.value != "") {
            n.value = record.num
        }
    }
}

//控制价格输入
$(".js_sizes").on('keyup', 'input', function(event) {
  checkDecimal(this)
});

//数量只能是整数
$(".js_sizes").on('keyup', 'input.js_stockNum', function(event) {
  event.preventDefault();
  if(this.value.length==1){
    this.value=this.value.replace(/[^0-9]/g,'')
  }else{
    this.value=this.value.replace(/\D/g,'')
  }
});
</script>