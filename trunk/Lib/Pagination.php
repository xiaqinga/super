<?php

/**
 * 分页
 *
 * @author janhve@163.com
 * @since   2015-05-20
 * @version 1.0
 */

class Pagination
{
	
	/**
	 * 每页显示数目
	 */
	public $pageSize = '10';
	
	/**
	 * 当前页码
	 */
	public $currentPage = '1';
	
	/**
	 * 跳转页码
	 */
	public $directPage = '';

	/**
	 * 记录总条数
	 */
	public $recorderNum;

	/**
	 * 总页数
	 */
	public $totalPages;

	/**
	 * 页目显示数
	 */
	public $pageSignCount = 10;

	/**
	 * 页目自动缩动数
	 */
	public $pageSpace = 2;

	/**
	 * 传递页数的参数，默认为page
	 */
	public $pageVal = 'page';

	/**
	 * 页码url
	 */
	public $url = '';

	/**
	 * 页码url设置方式
	 */
	public $url_type = 1;
	
	/**
	 * 处理结果
	 */
	public $result = array(
		'status' => 0,
		'data'   => null
	);
	
	/**
	 * 初始化
	 */
	public function __construct()
	{		
		$this->result['status'] = 1;
	}

	/**
	 * 生成页码
	 * @param int $total  记录总条数
	 * @param int $pagesize  每页显示的条目数
	 * @return string
	 */
	public function page($total, $pagesize=10, $url='' ,$pageVal='page')
	{
		$this->recorderNum    = $total;
		$this->pageSize       = $pagesize;
		$this->pageVal        = $pageVal;
		$this->directPage     = (isset($_REQUEST['ys'])) ? $_REQUEST['ys'] : '';
		$this->url        	  = $url;

		//获取总页数
		$this->_getTotalPages();
		//获取当前页
		$this->_getCurrentPage();
		//返回分页数据
		return $this->getPageData();
	}

	/**
	 * 获取分页数据
	 * @return void
	 */
	public function getPageData()
	{	
		$data = array();

		$data['total']   	 = $this->recorderNum;//总记录数
		$data['curr_page']   = $this->currentPage;//当前页
		$data['total_page']  = $this->totalPages;//总页数
		$data['pagesize']    = $this->pageSize;//每页显示数
		$data['pagelink']    = $this->_getPageLink();//分页链接

		return $data;
	}

	/**
	 * 获取总页数
	 * @return void
	 */
	private function _getTotalPages()
	{	
		$pages = intval($this->recorderNum/$this->pageSize);
		
		if ($this->recorderNum % $this->pageSize) $pages++;
		
		$this->totalPages = $pages;
	}

	/**
	 * 获取当前页码
	 * @return void
	 */
	private function _getCurrentPage()
	{			
		$this->currentPage = (!isset($_REQUEST[$this->pageVal]))
							 ? 1 : (($_REQUEST[$this->pageVal] > $this->totalPages) ? $this->totalPages : (($_REQUEST[$this->pageVal] < 1) ? 1 : $_REQUEST[$this->pageVal]));
		
		if ($this->directPage<>'')
		{
			$this->currentPage = ($this->directPage > $this->totalPages) ? $this->totalPages : $this->directPage;
		}
	}

	/**
	 * 获取页码
	 * @param string $result  短信发送结果
	 * @return string
	 */
	private function _getPageLink()
	{		
		if('' == $this->url)
		{
			$request_uri= explode('?',$_SERVER['REQUEST_URI']);
			$page_url   = $request_uri[0] . ( (isset($request_uri[1]) && '' <> $request_uri[1]) ? '?' : '');
			$parse 		= parse_url($page_url);
			$request 	= ( empty($_POST) ) ? $_GET : $_POST;
			
			//自动处理REQUEST提交的参数
			if(!empty($request))
			{
				if(isset($parse['query']))
				{
					parse_str($parse['query'],$params);
					foreach($request as $key=>$val)
					{
						//if(!array_key_exists($key,$params))
						$params[$key] = $val;
					}
					$parse['query'] = http_build_query($params);
				}
				else
				{
					$parse['query'] = http_build_query($request);
				}	
			}

			if(isset($parse['query']))
			{
				parse_str($parse['query'],$params);
				//去除REQUEST提交自带的input按钮值
				unset($params['submit'],$params['Submit'],$params['SUBMIT']);
				unset($params[$this->pageVal]);
				$page_url =  (empty($params)) ? $parse['path'] : $parse['path'].'?'.http_build_query($params);
			}
			$this->url_type = 1;
		}
		else
		{
			$page_url = $this->url;
			$this->url_type = 2;
		}
		
		$first_page = 1;
		$prev_page  = $this->currentPage-1;
		$next_page  = $this->currentPage+1;
		$last_page  = $this->totalPages;
		$prev_page  = (0 == $prev_page) ? 1 : $prev_page;
		
		if ($this->totalPages < $this->pageSignCount) 
		{			
			$endpage   = $this->totalPages;
			$startpage = 1;	
		}
		else
		{
			if ($this->currentPage > $this->pageSpace)
			{	
				$startpage = $this->currentPage - $this->pageSpace;
				$endpage   = $startpage + $this->pageSignCount - 1;			
				if ($endpage > $this->totalPages)
				{
					$endpage = $this->totalPages;
					$startpage = $endpage - $this->pageSignCount + 1;
				}
			}
			else
			{
				$startpage = 1;
				$endpage = $this->pageSignCount;
			}
		}

		if ($this->recorderNum && $this->totalPages > 1)
		{
			return $this->_signPageUrl($first_page,$prev_page,$next_page,$last_page,$startpage,$endpage,$page_url);
		}
		else
		{
			return ;
		}
	}

	/**
	 * 设置分页显示方式
	 * @return string
	 */
	private function _signPageUrl($first,$prev,$next,$last,$sp,$ep,$url)
	{
		$page_str = '';
        
		if ($this->currentPage > 1)
		{
			$url_first = $this->_setPageUrl($url,$first);
			$url_prev  = $this->_setPageUrl($url,$prev);
			$page_str .= '<a href="'.$url_prev.'" title="上一页">&lt;&lt;</a>';
		}
		else
		{
			$page_str .= '<a class="no">&lt;&lt;</a>';
		}
		
		if($sp > 1)
		{
			$url_this = $this->_setPageUrl($url,1);
			$page_str .= '<a href="'.$url_first.'">1</a>';
		}
		
		if ($sp > 2)
		{
			$p = ( ($sp-10) > 0 ) ? ($sp-10) : 1;
			$url_p = $this->_setPageUrl($url,$p);
			$page_str .= '<a href="'.$url_p.'">...</a>';
		}
		
		for ($i = $sp;$i <= $ep;$i++)
		{
			$url_this = $this->_setPageUrl($url,$i);
			if ($i == $this->currentPage)
			{
				$page_str .= '<a  class="focus">'.$i.'</a>';
			}
			else
			{
				$page_str .= '<a href="'.$url_this.'">'.$i.'</a>';
			}
		}
		
		if (($this->totalPages - $ep) > 1)
		{
			$p = ( ($ep+1) > $this->totalPages ) ? $this->totalPages : ($ep+1);
			$url_p = $this->_setPageUrl($url,$p);
			$page_str .= '<a href="'.$url_p.'" >...</a>';
		}
		
		if ($ep < $this->totalPages)
		{
			$url_this = $this->_setPageUrl($url,$this->totalPages);
			$page_str .= '<a href="'.$url_this.'">'.$this->totalPages.'</a>';
		}
		
		if ($this->currentPage < $this->totalPages)
		{
			$url_next = $this->_setPageUrl($url,$next);
			$page_str .= '<a href="'.$url_next.'" title="下一页">&gt;&gt;</a>';
		}
		else
		{
			$page_str .= '<a class="no">&gt;&gt;</a>';
		}
		
        $page_str .= '';
		
		return $page_str;
	}

	/**
	 * 设置分页页数
	 * @return string
	 */
	private function _setPageUrl($url,$p)
	{
		if( 1 == $this->url_type )
		{
			return ( false === strpos($url,'?') ) ? $url.'?'.$this->pageVal.'='.$p : $url.'&'.$this->pageVal.'='.$p;
		}
		elseif( 2 == $this->url_type )
		{
			return str_replace($this->pageVal,$p,$url);
		}	
	}

}