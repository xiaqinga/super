<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/sayimo.js"></script>
<script type="text/javascript">
//通过className获取文档对象
function getElementByClassName(objName)
{
	var obj = document.getElementsByTagName('tr');
	var arr = new Array();
	var i, j;
	for (i = 0, j = 0; i < obj.length; i++)
	{
		if (obj[i].className == objName)
		{
			arr[j++] = obj[i];
		}
	}
	return arr;
}

//显示和隐藏子栏目
function displaySubMenu(objName)
{
	//alert(this);
	var obj = getElementByClassName(objName);
	if (obj == null)
	{
		return;
	}
	for (var i in obj)
	{
		if (obj[i].style.display == "")
		{
			obj[i].style.display = "none";
			document.onclick = function (e)
			{
				var srcElement = e.srcElement || e.target;
				//alert(srcElement.innerHTML);
				//}
				if (srcElement.tagName == 'img')
					srcElement.src = "<?php echo $add_icon_src; ?>";
				else if (srcElement.tagName == 'td')
				{
					srcElement.getElementsByTagName('img')[0].src = "<?php echo $add_icon_src; ?>";
				}
			}
		}
		else
		{
			obj[i].style.display = "";
			document.onclick = function (e)
			{
				var srcElement = e.srcElement || e.target;
				if (srcElement.tagName == 'img')
					srcElement.src = "<?php echo $noadd_icon_src; ?>";
				else if (srcElement.tagName == 'td')
				{
					srcElement.getElementsByTagName('img')[0].src = "<?php echo $noadd_icon_src; ?>";
				}
			}
		}
	}
	SAYIMO.fixheight();
}
</script>
<div class="content-top">
  <form class="sui-form">
    <div class="controls">
      <?php echo form_a_auth(array('content'=>'添加一级菜单','check'=>'menu/add_one','class'=>'btn-large','url'=>APP_URL.'menu/edit?parentId='.$indexParentId));?>
    </div>
  </form>
</div>
<div class="weixin-menu-list">
<?php if($menu_list): ?>
<table class="sui-table table-bordered-simple">
  <thead>
    <tr class="thbg">
      <th colspan="6"></th>
    </tr>
    <tr class="thbk">
      <th width="3%" class="center">ID</th>
      <th class="center">菜单名称</th>
      <th class="center">菜单URL</th>
      <th class="center">序号</th>
      <th class="center">菜单状态</th>
      <th class="center">操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($menu_list as $key=>$item):?>
        <?php $trstyle = ($item['parentId']!=$indexParentId)?'style="display: none"':'';?>
        <?php $classid = ($item['parentId']!=$indexParentId)?"class='{$item['parentId']}'":'';?>
    <tr <?php echo $classid;?> class="modules" <?php echo $trstyle;?>>
      <td class="center"><?php echo $item['id'];?></td>
      <td onclick="displaySubMenu('<?php echo $item['id'];?>');" align="left"><?php echo $item['menuName'];?></td>
      <td class="center"><?php echo $item['menuUrl'];?></td>
      <td class="center"><?php echo $item['menuSort'];?></td>
      <td class="center"><?php echo $dictStatus[$item['menuStatus']];?></td>
      <td class="center">
      	<?php if ($item['parentId'] == $indexParentId){
			   echo form_a_auth(array('content'=>'添加二级菜单','check'=>'menu/add_one','class'=>'btn-link','url'=>APP_URL.'menu/edit?parentId='.$item['id'],'img'=>'add.png'));
      	}?>
        <?php echo form_a_auth(array('content'=>'修改','class'=>'btn-link','url'=>APP_URL.'menu/edit?id='.$item['id'].'&parentId='.$item['parentId'],'img'=>'update.png'));?>
        <?php echo form_a_auth(array('content'=>'删除','class'=>'btn-link','url'=>APP_URL.'menu/delete','onclick'=>'deleteId('. $item['id'] .');','img'=>'delete.png'));?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php else:?>
<table class="sui-table table-bordered-simple">
	<tbody>
	    <tr>
	      <td class="center">亲，你还没有添加菜单</td>
    	</tr>
	</tbody>
</table>
<?php endif;?>		
</div>
<script type="text/javascript">
  function deleteId(id)
  {
    $.confirm({
      body: '你确定要删除该菜单吗?',
      height: 165,
      okHide: function(e){true_delete(id)}
    })
  }
  function true_delete(id)
  {
    $.ajax({
      type    : "post",
      async   : false,
      url     : '<?php echo APP_URL.'menu/delete';?>',
      data    : "id=" + id,
      dataType: 'json',
      success : function (data)
      {
        if (data['msg'] == 1){
          $.alert('删除成功');
          SAYIMO.go_url('<?php echo APP_URL.'menu/index';?>');
        }else if (data['msg'] == 3){
          $.alert('亲，包含有子菜单喔，先删除子菜单吧');
        }else{
        	$.alert('删除失败');
        }
      }
    });
  }
</script>