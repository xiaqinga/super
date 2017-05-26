<?php
require_once(LIB_PATH."PHPExcel/PHPExcel.php");
require_once(LIB_PATH."PHPExcel/PHPExcel/IOFactory.php");
class PHPExcelToUp extends PHPExcel {
	var  $result = array(
		'status' => 0,
		'data'   => null
	);
	function __construct()
    {
        $this->result['status'] = 1;
    }
	//上传文件
	function _uploadFile($inputName, $listNameArr, $savePath, $returnPath = '') {
		if (count($_FILES) <= 0) {
			return false;
		}
		if ($_FILES[$inputName]["error"]) {
			return false;
		}
		$name = $_FILES[$inputName]["name"];
		$array = explode(".", $name);
		$nr = count($array);
		$ext = $array[$nr -1];
		if($ext=== "xlsx"){
			require_once (LIB_PATH."PHPExcel/PHPExcel/Reader/Excel2007.php");
		}else{
			require_once (LIB_PATH."PHPExcel/PHPExcel/Reader/Excel5.php");
		}
		$fileName = date('YmdHis') . sprintf('%03d', rand(0, 999)) . '.' . $ext;
		$saveFileName = $savePath . '/' . $fileName;
		$result=move_uploaded_file($_FILES[$inputName]['tmp_name'], $saveFileName);
		$strs = array();
		if($result) //如果上传文件成功，就执行导入excel操作
		{
			if($ext=== "xlsx"){
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}else{
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			}
			$objPHPExcel = $objReader->load($saveFileName);
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			foreach ($listNameArr as $key => $val) {
				$listNum = 1;
				$listname = $objPHPExcel->getActiveSheet()->getCell("$key$listNum")->getValue();
				if($listname != $val){
					return 2;
				}
			}
			for($j=2;$j<=$highestRow;$j++)
			{
				$str = '';
				for($k='A';$k<=$highestColumn;$k++)
				{
					$str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'\\';//读取单元格
				}
				$strlist = explode("\\",$str);
				if(!empty($strlist[0])){
					$strs[] = $strlist;
				}
			}
		}
		return $strs;
	}
	
	function uploadExcel($inputName,$listNameArr){
		$dirPath=dirname(dirname(__FILE__)).'/Tmp/';
		$result = $this->_uploadFile($inputName, $listNameArr, $dirPath, '');
		return $result;
	}
}
?>