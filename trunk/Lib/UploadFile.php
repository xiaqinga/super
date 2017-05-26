<?php
/*
+-----------------------------------------------------------------------------
| 文件上传类
| 文件上传：支持文件类型控制；自定义和重定义文件名；
| 图片上传：支持图片生成缩略图，可控；图片添加水印，可控；图片名自定义和重定义；
| By : huili46@gmail.com;
| Time:2007-09-10;
+-----------------------------------------------------------------------------
*/
class UploadFile {
 var $UploadType;                              //上传类型：;
 var $FormName;                                //上传表单字段名称
 var $FileExpArr;                              //允许上传的文件类型
 var $FileName;                                //上传文件名
 var $UpTmpFile;                               //上传临时文件；
 var $UploadError;                             //上传错误参数
 var $UpFileSize;                              //上传文件大小；
 var $NewFileName=array();                     //设置上传文件名，可自定义文件名；
 var $UpFileType;                              //上传文件类型；
 var $FileSaveDir;                             //文件保存路径；
 var $FileSaveName;                            //保存的文件名；
 var $MaxUpFileSize=20000;                      //允许最大上传文件大小，单位：K；
 var $ReturnMsg=0;                             //返回的信息，默认不可上传。
 var $ReturnText=array(0=>'文件不可上传',
 											 1=>'文件可上传',
											 2=>'不支持该类型的图片上传',
											 3=>'图片上传中出现错误',
											 4=>'上传文件超过规定大小',
											 5=>'暂不支持该文件格式，请用图片处理软件将图片转换为GIF、JPG、PNG格式',
											 6=>'需要加水印的图片不存在',
											 7=>'需要加水印的图片的长度或宽度比水印区域还小，无法生成水印',
											 8=>'水印文字颜色格式不正确',
											 9=>'不支持该类型背景图片',
											 10=>'不支持该类型的文件上传'
											 );
 
 var $is_Resize;                               //上传图片是否生成所略图，0 OR 1；
 var $w;                                       //生成所略图的宽；
 var $h;                                       //生成所略图的高；
 var $TmpFileName;                             //临时生成文件；
 var $TmpFile;                                 //生成缩略图时临时生成的文件；

 var $is_Watermark=0;                          //上传图片是否添加水印；默认不添加
 var $Quality=90;                              //生成的水印图片质量；
 var $waterPos=9;                              //水印起始位置：0随机位置；1顶端居左；2顶端居中；3顶端居右；4中部居左；5中部居中；6中部居右；7底端居左；8底端居中；9底端居右；
 var $waterImage="";                           //水印图片路径，以图片作为水印，只支持GIF,JPG,PNG格式；
 var $waterText="";             //水印文字；
 var $fontSize=18;                             //水印文字大小；
 var $textColor="#666666";                     //水印文字颜色；
 var $textFont='arialnbi.ttf';            //水印字体；
 var  $wAndh = array(
        'width' => 0,
        'height'   => 0
 );
 var  $result = array(
		'status' => 0,
		'data'   => null
 );
 
	/**
	 * 初始化，并检查中间错误
	 */
 public function __construct()
 {
	$this->result['status'] = 1;
 }
 
 /*参数:$uptype:array("image|file",是否生成缩略图,是否添加水印,生成缩略图的尺寸);$newname:array("自定义命名0|随机命名1","自定义文件名")*/
 function upload($uptype,$files,$newname,$filesavedir) {
    $this->UploadType     =$uptype[0];
		$this->FormName       =$files;
		$this->is_Watermark   =(empty($uptype[2])) ? 0 : $uptype[2];
    $this->FileName       =$this->FormName['name'];
    $this->UpFileSize     =$this->FormName['size'];
    $this->UpFileType     =$this->FormName['type'];
    $this->UploadError    =$this->FormName['error'];
    $this->UpTmpFile      =$this->FormName['tmp_name'];
		$this->NewFileName    =$newname;
		$this->FileSaveDir    =$filesavedir;
		if ($this->UploadType=="image") {
			 $this->is_Resize=$uptype[1];
			 $this->FileExpArr=array('image/jpeg','image/pjpeg','image/x-png','image/png','image/gif');
			 if ($this->is_Resize==1) {
					$sizes=explode("*",$uptype[3]);
				$this->w=$sizes[0];
				$this->h=$sizes[1];
			 }
		}
		if ($this->UploadType=="file") {
					$this->FileExpArr=array('image/jpeg','image/pjpeg','image/x-png','image/png','image/gif','application/octet-stream','.doc','application/x-shockwave-flash','.wmv','.asf','text/plain','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel');
		}
 }
 
 function image() {
    $this->check_img();
		$this->set_name();
    if ($this->ReturnMsg==1) {
	    $newimg=$this->copy_file();
	    if ($this->is_Watermark) {
           $this->imageWaterMark($newimg);	
	    }
		return $newimg;		
	} else {
	   return $this->ReturnMsg;
	}
 }

 function files() {
    $this->check_file();
	if ($this->ReturnMsg==1) {
	   $this->set_name();
	   return $this->copy_file();
    }
 }
  
 function check_img() {
   if ($this->UpFileSize>0 && $this->UpFileSize<=$this->MaxUpFileSize*1024) {
      if (in_array($this->UpFileType,$this->FileExpArr)) {
	     if ($this->UpFileType=="image/pjpeg" || $this->UpFileType=="image/jpeg") {
		    $this->TmpFileName = imagecreatefromjpeg($this->UpTmpFile); 
			$this->ReturnMsg=1;
		 } elseif ($this->UpFileType=="image/x-png" || $this->UpFileType=="image/png") {
		    $this->TmpFileName = imagecreatefrompng($this->UpTmpFile); 
			$this->ReturnMsg=1;
		 } elseif ($this->UpFileType=="image/gif") {
		    $this->TmpFileName = imagecreatefromgif($this->UpTmpFile); 
			$this->ReturnMsg=1;
		 } else {
		    $this->ReturnMsg=2;
		 }
		 if ($this->TmpFileName=="") {
		    $this->ReturnMsg=3;
		 }
	  } else {
	     $this->ReturnMsg=2;
	  }
   } elseif ($this->UpFileSize>$this->MaxUpFileSize*1024) {
      $this->ReturnMsg=4;
   }
 }

 function check_file() {
		if (!in_array($this->UpFileType,$this->FileExpArr)) {
			 $this->ReturnMsg=10;
		} else {
			 $this->ReturnMsg=1;
		}
 }
  
 function copy_file() {
		if ($this->UploadType=="image" && $this->is_Resize) {
			$this->ResizeImage();
			$newfilename=$this->TmpFile.'.jpg';
			$TmpFiles=$this->TmpFile.'.jpg';
		}else {
				$extendname=strrchr($this->FileName,".");
				$newfilename=$this->TmpFile.$extendname;
			$TmpFiles=$this->UpTmpFile;
		}

		$folder=date("Y-m-d",time());
		$this->createDir($this->FileSaveDir.$folder);
		$savetofile=$this->FileSaveDir.$folder.'/'.$newfilename;
		copy($TmpFiles, $savetofile);
                        $imginfo = getimagesize($savetofile);
                        $this->wAndh['width']  = $imginfo[0];
                        $this->wAndh['height'] = $imginfo[1];
		@unlink($TmpFiles);
		return $savetofile;
 }

 function getWidthHeight(){
    return $this->wAndh;
 }
 
 function ResizeImage(){
		$width  = imagesx($this->TmpFileName);
    $height = imagesy($this->TmpFileName);
    if(($this->w && $width > $this->w) || ($this->h && $height > $this->h)){
        if($this->w && $width > $this->w){
            $widthratio = $this->w/$width;
            $RESIZEWIDTH=true;
        }
        if($this->h && $height > $this->h){
            $heightratio = $this->h/$height;
            $RESIZEHEIGHT=true;
        }
        if($RESIZEWIDTH && $RESIZEHEIGHT){
            if($widthratio < $heightratio){
                $ratio = $widthratio;
            }else{
                $ratio = $heightratio;
            }
        }elseif($RESIZEWIDTH){
            $ratio = $widthratio;
        }elseif($RESIZEHEIGHT){
            $ratio = $heightratio;
        }
        $newwidth = $width * $ratio;
        $newheight = $height * $ratio;
        if(function_exists("imagecopyresampled")){
              $newim = imagecreatetruecolor($newwidth, $newheight);
							if($this->UpFileType=="image/x-png" || $this->UpFileType=="image/png"){
								$bg =imagecolorallocate($newim, 255, 255, 255);
								imagefill($newim, 0, 0, $bg);
							}
              imagecopyresampled($newim, $this->TmpFileName, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }else{
            $newim = imagecreate($newwidth, $newheight);
              imagecopyresized($newim, $this->TmpFileName, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }
        ImageJpeg ($newim,$this->TmpFile.".jpg");
        ImageDestroy ($newim);
		return true;
    }else{
        ImageJpeg ($this->TmpFileName,$this->TmpFile.".jpg");
		return true;
    }
 }

 function set_name() {
    $this->TmpFile=($this->NewFileName[0]==true) ? date('hs').substr(md5(rand(1,100000)),0,10) : $this->NewFileName[1];
 }
 
 function imageWaterMark($groundImage) { 
    $isWaterImage=false;
    //读取水印文件 
    if (!empty($this->waterImage) && file_exists($this->waterImage)) { 
        $isWaterImage=true;
		list($water_w, $water_h, $type, $attr) = getimagesize($this->waterImage);
        if ($type==1){ //1->gif
            $water_im=imagecreatefromgif($this->waterImage); 
        } elseif($type==2){ //2->jpg
            $water_im=imagecreatefromjpeg($this->waterImage); 
        } elseif($type==3){ //3->png
            $water_im=imagecreatefrompng($this->waterImage); 
        } else {
	        $this->ReturnMsg=5;exit;
	    }
    } 
    //读取背景图片 
    if(!empty($groundImage) && file_exists($groundImage)) { 
        list($ground_w, $ground_h, $type, $attr) = getimagesize($groundImage);
        if ($type==1){ //1->gif
            $ground_im=imagecreatefromgif($groundImage); 
        } elseif($type==2){ //2->jpg
            $ground_im=imagecreatefromjpeg($groundImage); 
        } elseif($type==3){ //3->png
            $ground_im=imagecreatefrompng($groundImage); 
        } else {
	        $this->ReturnMsg=5;
	    }

    } else { 
        $this->ReturnMsg=6; 
    } 
    //水印位置 
    if($isWaterImage==true) { //图片水印  
        $w = $water_w; 
        $h = $water_h; 
    } else {  //文字水印 
        //$lineNum = count(explode("\r\n",$this->waterText));
		$temp = imagettfbbox(ceil($this->fontSize),0,$this->textFont,$this->waterText);//取得使用 TrueType 字体的文本的范围 
        $w = $temp[4] - $temp[6]; 
        $h = $temp[1] - $temp[3]; 
        unset($temp); 
    } 
    if( ($ground_w<$w) || ($ground_h<$h) ) { 
        $this->ReturnMsg=7; 
    } 
    switch($this->waterPos) { 
        case 0://随机 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break; 
        case 1://1为顶端居左 
            $posX = 0; 
            $posY = 0;
            break; 
        case 2://2为顶端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = 0; 
            break; 
        case 3://3为顶端居右 
            $posX = $ground_w - $w; 
            $posY = 0; 
            break; 
        case 4://4为中部居左 
            $posX = 0; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 5://5为中部居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 6://6为中部居右 
            $posX = $ground_w - $w; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 7://7为底端居左 
            $posX = 0; 
            $posY = $ground_h - $h-5; 
            break; 
        case 8://8为底端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = $ground_h - $h-5; 
            break; 
        case 9://9为底端居右 
            $posX = $ground_w - $w; 
            $posY = $ground_h - $h-5; 
            break; 
        default://随机 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break;     
    } 
    //设定图像的混色模式 
    imagealphablending($ground_im, true); 
    if($isWaterImage==true) { //图片水印 
        imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件         
    } else {//文字水印
        if( !empty($this->textColor) && (strlen($this->textColor)==7) ) { 
            $R = hexdec(substr($this->textColor,1,2)); 
            $G = hexdec(substr($this->textColor,3,2)); 
            $B = hexdec(substr($this->textColor,5)); 
        } else { 
            $this->ReturnMsg=8; 
        } 
        imagefttext ($ground_im, $this->fontSize,0, $posX, $posY, imagecolorallocate($ground_im, $R, $G, $B),$this->textFont, $this->waterText);         
    }
    //生成水印后的图片 
    switch($type) {//取得背景图片的格式 
        case 1:
		  imagegif($ground_im,$groundImage);break; 
        case 2:
		  imagejpeg($ground_im,$groundImage);break; 
        case 3:
		  imagepng($ground_im,$groundImage);break; 
        default:
		  $this->ReturnMsg=9;
    } 
    @imagedestroy($water_im);unset($water_w);unset($water_h);unset($type);unset($attr);
	@imagedestroy($ground_im);unset($ground_w);unset($ground_h);
    @imagedestroy($water_im); 
 }

 function createDir($dir){
 	$dir = dirname(dirname(__FILE__)).'/'.$dir;
    if (file_exists($dir) && is_dir($dir)){
            return false;
    }else{
            mkdir ($dir,0777);return true;
    }
 }
 
}
?>