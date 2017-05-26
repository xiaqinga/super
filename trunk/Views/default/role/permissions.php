<style>
	.ui-widget{
		margin: 0 10px 0 10px;
	}

	.role_right_menu{
		margin:0 10px 0 10px;
		padding-left:5px;
		height:30px;
		line-height:30px;
		background-color:#d9e4e9;
		border-left:1px solid #d9e4e9;
		border-right:1px solid #d9e4e9;
	}

	.role_right_menu_sub{
		margin:0 10px 0 10px;
		padding-left:15px;
		height:30px;
		line-height:30px;
		background-color:#f1fdfd;
		border-left:1px solid #d9e4e9;
		border-right:1px solid #d9e4e9;
		border-bottom:1px solid #d9e4e9;
	}

	.role_right_content{
		margin:0 10px 0 10px;
		padding-left:20px;
		line-height:30px;
		border-left:1px solid #d9e4e9;
		border-right:1px solid #d9e4e9;
		border-bottom:1px solid #d9e4e9;
	}
	.checkall{
		margin:0 10px 0 10px;
	}
</style>
<div class="ui-widget" style="display: none;">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Alert:</strong> <div class="msgbox"></div></p>
	</div>
</div>
<script type="text/javascript">
function CheckAll(form){
	for (var i=0;i<form.elements.length;i++){
		var e = form.elements[i];
		if (e.Name != 'chkAll'&&e.disabled==false)
		e.checked = form.chkAll.checked;
		}
}
$(document).ready(function() {
	$('input[name="menuIds[]"]').change(function(){
    	if($(this).parents('div.role_right_menu_sub').length>0){
    		if($(this).is(':checked')){
	    		$(this).parents('div.role_right_menu_sub').parents('div.role_right_menu_sub_list').prev('.role_right_menu').find('input[name="menuIds[]"]').prop('checked',true);
	    		$(this).parents('div.role_right_menu_sub').next('div.role_right_content').find('input[name="rightIds[]"]').prop('checked',true);
	    	}else{
	    		var allunchecked = true;
	    		$(this).parents('div.role_right_menu_sub').siblings().each(function(){
	    			if($(this).find('input[name="menuIds[]"]:checked').length>0){
	    				allunchecked = false;
	    				return false;
	    			}
	    		});
	    		
	    		if(allunchecked){
	    			$(this).parents('div.role_right_menu_sub').parents('div.role_right_menu_sub_list').prev('.role_right_menu').find('input[name="menuIds[]"]').prop('checked',false);
	    		}
	    		$(this).parents('div.role_right_menu_sub').next('div.role_right_content').find('input[name="rightIds[]"]').prop('checked',false);
	    	}
    	}else{
    		if($(this).is(':checked')){
    			$(this).parents('div.role_right_menu').next('div.role_right_menu_sub_list').find('input[name="menuIds[]"]').prop('checked',true);
    			$(this).parents('div.role_right_menu').next('div.role_right_menu_sub_list').find('input[name="rightIds[]"]').prop('checked',true);
    		}else{
    			$(this).parents('div.role_right_menu').next('div.role_right_menu_sub_list').find('input[name="menuIds[]"]').prop('checked',false);
    			$(this).parents('div.role_right_menu').next('div.role_right_menu_sub_list').find('input[name="rightIds[]"]').prop('checked',false);
    		}
    	}
    });
    $('input[name="rightIds[]"]').change(function(){
    	if($(this).is(':checked')){
    		$(this).parents('div.role_right_content').prev('.role_right_menu_sub').find('input[name="menuIds[]"]').prop('checked',true);
    		$(this).parents('div.role_right_content').parents('div.role_right_menu_sub_list').prev('.role_right_menu').find('input[name="menuIds[]"]').prop('checked',true);
    	}else{
    		var allunchecked = true;
    		$(this).parents('span:eq(0)').siblings().each(function(){
    			if($(this).find('input[name="rightIds[]"]:checked').length>0){
    				allunchecked = false;
    				return false;
    			}
    		});
    		
    		if(allunchecked){
    			$(this).parents('div.role_right_content').prev('.role_right_menu_sub').find('input[name="menuIds[]"]').click();
    		}
    	}
    });
});
</script>
<form id="set-permissions" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
<?php 
	if(array_key_exists(1,$menuItem) && is_array($menuItem[1]))
	{
		foreach ($menuItem[1] as $item)
		{
			$checked = (array_key_exists($item['id'],$roleMenuItem))?'checked':'';
			echo '<div class="role_right_menu">';
			echo '<span>';
			echo '<input type="checkbox"  class="menuId" '. $checked .' id="menuId_'.$item['id'].'" name="menuIds[]" value="'.$item['id'].'" />';
			echo '<label for="menuId">'.$item['menuName'].'</label>';
			echo '</span>';
			echo '</div>';
			echo '<div class="role_right_menu_sub_list">';
			if(array_key_exists($item['id'],$menuItem) && is_array($menuItem[$item['id']]))
			{
				if (array_key_exists($item['id'], $rightItem) && is_array($rightItem[$item['id']]))
				{
					foreach ($rightItem[$item['id']] as $menu_row)
					{
						$checked = (array_key_exists($menu_row['id'], $roleRightItem)) ? 'checked' : '';
	
						echo '<div class="role_right_menu_sub">';
						echo '<span>';
						echo '<input type="checkbox" class="rightId" ' . $checked . ' id="rightId_' . $menu_row['id'] . '" name="rightIds[]" value="' . $menu_row['id'] . '" />';
						echo '<label for="name">' . $menu_row['permissionsName'] . '</label>';
						echo '</span>';
						echo '</div>';
					}
				}
				foreach ($menuItem[$item['id']] as $subitem)
				{
					$checked = (array_key_exists($subitem['id'],$roleMenuItem))?'checked':'';
					//公共加载项为必选
					if($subitem['menuUrl']=='common')
					{
						$checked = 'checked';
					}
					echo '<div class="role_right_menu_sub">';
					echo '<span>';
					echo '<input type="checkbox" class="menuId" '. $checked .' id="menuId_'.$subitem['id'].'" name="menuIds[]" value="'.$subitem['id'].'" />';
					echo '<label for="menuId">'.$subitem['menuName'].'</label>';
					echo '</span>';
					echo '</div>';
					echo '<div class="role_right_content">';
					if(array_key_exists($subitem['id'],$rightItem) && is_array($rightItem[$subitem['id']]))
			        {
						foreach ($rightItem[$subitem['id']] as $row)
						{
							$checked = (array_key_exists($row['id'],$roleRightItem))?'checked':'';
							//公共加载项为必选
							if($subitem['menuUrl']=='common')
							{
								$checked = 'checked';
							}
							echo '<span>';
							echo '<input type="checkbox"  class="rightId" '.$checked.' id="rightId_'.$row['id'].'" name="rightIds[]" value="'.$row['id'].'" />';
							echo '<label for="name">'.$row['permissionsName'].'</label>';
							echo '</span>&nbsp;&nbsp;';
						}
			        }
			        echo '</div>';
				}
			}
			echo '</div>';
		}
	}
?>
<div class="checkall">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" >
	<input name='chkAll' type='checkbox' id='chkAll' onclick='CheckAll(this.form)' value='checkbox'>全选
</div>
</form>