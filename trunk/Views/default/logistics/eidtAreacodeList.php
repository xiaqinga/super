<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE> ZTREE DEMO </TITLE>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?php echo ASSETS_URL;?>js/z-tree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/z-tree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL;?>js/z-tree/js/jquery.ztree.excheck-3.5.js"></script>
<SCRIPT LANGUAGE="JavaScript">
   var zTreeObj;
   // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
   var setting = {
		check: {
			enable: true
		},
		data: {
			simpleData: {
				enable: true,
				idKey: "id",
				pIdKey: "pId",
				rootPId: 0
			}
		}
   };
   // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
   var zNodes = <?php echo $cityListTrees;?>;
   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#cityList"), setting, zNodes);
   });
</SCRIPT>
 </HEAD>
<BODY>
<div>
	<form id="cityList-form" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
		<ul id="cityList" class="ztree"></ul>
	</form>
</div>
</BODY>
</HTML>