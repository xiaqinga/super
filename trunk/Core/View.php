<?php

/**
 * View 视图类
 * @author janhve@163.com
 * @date   2014-05-19
 * @version 1.0
 */

class View {
    protected $tVar        =  array(); // 模板输出变量

    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name,$value=''){
        if(is_array($name)) {
            $this->tVar   =  array_merge($this->tVar,$name);
        }elseif(is_object($name)){
            foreach($name as $key =>$val)
                $this->tVar[$key] = $val;
        }else {
            $this->tVar[$name] = $value;
        }
    }

    /**
     * 取得模板变量的值
     * @access public
     * @param string $name
     * @return mixed
     */
    public function get($name){
        if(isset($this->tVar[$name]))
            return $this->tVar[$name];
        else
            return false;
    }

    /* 取得所有模板变量 */
    public function getAllVar(){
        return $this->tVar;
    }

    // 调试页面所有的模板变量
    public function traceVar(){
        foreach ($this->tVar as $name=>$val){
            echo ($val.'['.$name.']<br/>');
        }
    }

    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param string $templateFile 模板文件名
	 * @param array $data 模板变量
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return mixed
     */
    public function display($data=array(),$templateFile='',$charset='',$contentType='') {
		// 解析并获取模板内容
        $content = $this->fetch($templateFile,$data);
        // 输出模板内容
        $this->show($content,$charset,$contentType);
    }

    /**
     * 输出内容文本可以包括Html
     * @access public
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return mixed
     */
    public function show($content,$charset='',$contentType='text/html'){
        // 输出模板文件
        echo $content;
    }

    /**
     * 解析和获取模板内容 用于输出
     * @access public
     * @param string $templateFile 模板文件名
	 * @param array $data 模板变量
     * @return string
     */
    public function fetch($templateFile='',$data=array()) {
        // 自动定位模板
		if ($templateFile == '')
			$templateFile = $this->parseTemplateFile();
		else {
			$paths = explode('/', $templateFile);
			$module_name = array_shift($paths);
			$module_action = array_shift($paths);
			$templateFile = VIEW_PATH . DEFAULT_THEME . '/' . $module_name . '/' . $module_action . '.php';
		}
		// 模板文件不存在直接返回
        if(!is_file($templateFile))
        {
            App::response(11,'视图文件不存在['.$templateFile.']');
        }
		//模板变量赋值
		$this->assign($data);
        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        // 视图解析标签
        //$params = array('var'=>$this->tVar,'file'=>$templateFile);
        // 采用PHP原生模板 模板阵列变量分解成为独立变量
        extract($this->tVar, EXTR_OVERWRITE);
        // 直接载入PHP模板
        include $templateFile;
        // 获取并清空缓存
        $content = ob_get_clean();
        // 输出模板文件
        return $content;
    }
		
    /**
     * 自动定位模板文件
     * @access private
     * @param string $templateFile 文件名
     * @return string
     */
    private function parseTemplateFile() {
        $templateFile = VIEW_PATH.DEFAULT_THEME.'/'.MODULE_NAME.'/'.ACTION_NAME.'.php';
        if(!file_exists($templateFile))
            App::response(11,'视图文件不存在['.$templateFile.']');
        return $templateFile;
    }
		
}