<?php

/**
 * Mysql数据库类
 * @author janhve@163.com
 * @since   2014-05-19
 * @version 1.0
 */

class Mysql {
    //当前SQL指令
	public $query_str       = '';
    //最后插入ID
	public $last_id            = NULL;
    //返回或者影响记录数
	public $num_rows           = 0;
    //返回记录集
	public $result             = NULL;
    //错误信息
	protected $error           = '';
    //数据库连接ID 支持多个连接
	protected $link_id         = array();
    //当前连接ID
	protected $_link_id        = NULL;
    //当前查询ID
	protected $query_id        = NULL;
    //是否已经连接数据库
	protected $connected       = false;
	//数据库连接参数配置
	protected $db_config       = '';
	//响应数据对象
	public $response = NULL;
		
    /**
     * 连接数据库
     * @access public
     */
    public function connect($config = '', $linkNum = 0) {
		if (!isset($this->link_id[$linkNum])) {
			if (empty($config))
				$config = $this->db_config;

			$this->link_id[$linkNum] = @mysql_connect($config['hostname'] . ':' . $config['port'], $config['username'], $config['password']);

			if (!$this->link_id[$linkNum] || (!empty($config['database']) && !mysql_select_db($config['database'], $this->link_id[$linkNum]))){
				$this->response->code = 50;
				$this->response->data = 'Can`t connect mysql .' . mysql_error();
			}

			if (mysql_get_server_info($this->link_id[$linkNum]) >= '4.1')
				mysql_query("SET NAMES '" . $config['charset'] . "'", $this->link_id[$linkNum]);

			// 标记连接成功
			$this->connected = true;
		}
		$this->_link_id = $this->link_id[$linkNum]; //当前连接
		return $this->link_id[$linkNum];
	}

	/**
	 * 查询记录
	 *
	 * @access public
	 * @param string $sql sql指令
	 * @return mixed
	 */
	public function select($table = '', $field = '', $where = '')
	{
		$sql = '';
		if (stristr($table, 'select ') !== false)
		{
			$sql = $table;
		}
		else
		{
			if (empty($field))
			{
				$sql = 'SELECT * FROM ' . $table;
			}
			else
			{
				$sql = 'SELECT ' . $field . ' FROM ' . $table;
			}

			if (is_array($where) && !empty($where))
			{
				$q     = count($where);
				$w     = 1;
				$q_sql = '';

				foreach ($where as $where_key => $where_val)
				{
					$wheresql = '';
					/*
					if (is_array($where_val))
					{
						foreach ($where_val as $k => $v)
						{
							if ($v === '')
							{
								unset($where_val[$k]);
							}
						}
					}*/
					if ($w == 1 && !empty($where_val))
					{
						if (stristr($where_key, 'or') && $where_key != 'order')
						{
							$q_sql .= ' OR ';
						}
						elseif ($where_key != 'order' && $where_key != 'limit')
						{
							$q_sql .= ' WHERE ';
						}
						//$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' WHERE ' : '';
					}
					elseif (!empty($where_val))
					{
						if (stristr($where_key, 'or') && $where_key != 'order')
						{
							$q_sql .= ' OR ';
						}
						elseif ($where_key != 'order' && $where_key != 'limit')
						{
							$q_sql .= ' AND ';
						}
						//$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' AND ' : '';
					}
					$wheresql = $this->$where_key($where_val);
					$q_sql .= $wheresql;

					if ($w != $q)
					{
						$w++;
					}
				}
				$sql .= $q_sql;
			}
			else
			{
				if (!empty($where))
				{
					$sql .= " WHERE {$where}";
				}
			}
		}

		return $this->query($sql);
	}

	/**
	 * @param $query_val
	 *            array('字段名'=>'字段值')
	 *            或array('字段名 <'=>'字段值')
	 * @return string
	 */
	function where($query_val)
	{
		$e     = count($query_val);
		$r     = 1;
		$where = '';
		foreach ($query_val as $q_key => $q_val)
		{
			if ($q_val !== '')
			{
				if ($r == 1)
				{
					if (stristr($q_key, '<') || stristr($q_key, '>') || stristr($q_key, '=') || stristr($q_key, ' IN '))
					{
						if (stristr($q_key, ' IN '))
						{
							$where .= ' ' . $q_key . $q_val;
						}
						else
						{
							$where .= ' ' . $q_key . " '" . $q_val . "'";
						}
					}
					else
					{
						$where .= ' ' . $q_key . " = '" . $q_val . "'";
					}
				}
				else
				{
					if (stristr($q_key, '<') || stristr($q_key, '>') || stristr($q_key, '=') || stristr($q_key, ' IN '))
					{
						if (stristr($q_key, ' IN '))
						{
							$where .= ' AND ' . $q_key . $q_val;
						}
						else
						{
							$where .= ' AND ' . $q_key . " '" . $q_val . "'";
						}
					}
					else
					{
						$where .= ' AND ' . $q_key . " = '" . $q_val . "'";
					}
				}
				if ($r != $e)
				{
					$r++;
				}
			}
		}

		return $where;
	}

	/**
	 * @param $query_val
	 *            array('字段名'=>'字段值')
	 *            或array('字段名 <'=>'字段值')
	 * @return string
	 */
	function or_where($query_val)
	{
		$or_where = '';
		foreach ($query_val as $q_key => $q_val)
		{
			if ($q_val !== '')
			{
				if (stristr($q_key, '<') || stristr($q_key, '>') || stristr($q_key, '=') || stristr($q_key, ' IN '))
				{
					if (stristr($q_key, ' IN '))
					{
						$or_where .= ' ' . $q_key . $q_val;
					}
					else
					{
						$or_where .= ' ' . $q_key . " '" . $q_val . "'";
					}
				}
				else
				{
					$or_where = $q_key . " = '" . $q_val . "'";
				}
			}
		}

		return '(' . $or_where . ')';
	}

	/**
	 * @param $like_val
	 *            array('字段名'=>'字段值')
	 *            或array('字段名'=>'%字段值')
	 * @return string
	 */
	function like($like_val)
	{
		
		$like = '';
		foreach ($like_val as $l_key => $l_val)
		{
			if (is_array($l_val)) {
				$like .= $like?' AND '.$this->and_like($l_key,$l_val):$this->and_like($l_key,$l_val);
			}else{
				if ($l_val !== '')
			{
				if (!$like)
				{
					if (stristr($l_val, '%'))
					{
						$like .= ' ' . $l_key . " LIKE '" . $l_val . "'";
					}
					else
					{
						$like .= ' ' . $l_key . " LIKE '%" . $l_val . "%'";
					}
				}
				else
				{
					if (stristr($l_val, '%'))
					{
						$like .= ' OR ' . $l_key . " LIKE '" . $l_val . "'";
					}
					else
					{
						$like .= ' OR ' . $l_key . " LIKE '%" . $l_val . "%'";
					}
				}
			}
			}
			
		}
		if (!empty($like))
			$like = ' (' . $like . ') ';

		return $like;
	}

	public function and_like($key,$value){
		$str='';
		foreach ($value as $k => $v) {
			if ($v !== '')
			{
				if (!$str)
				{

						$str .= ' ' . $key . " LIKE '%" . $v . "%'";
				
				}
				else
				{
					
						$str .= ' AND ' . $key . " LIKE '%" . $v . "%'";
					
				}
				
			}
		}
		

		return $str;
	}

	/**
	 * @param $order
	 *            array('字段名'=>'asc')
	 *            或array('字段名'=>'desc')
	 * @return string
	 */
	function order($order)
	{
		$i         = count($order);
		$j         = 1;
		$order_sql = '';
		foreach ($order as $key => $order_val)
		{
			if (!empty($order_val))
			{
				if ($j == 1)
				{
					$order_sql .= ' ORDER BY ' . $key . ' ' . $order_val;
				}
				else
				{
					$order_sql .= ',' . $key . ' ' . $order_val;
				}
				if ($j != $i)
				{
					$j++;
				}
			}
		}

		return $order_sql;
	}
	
	/**
	 * @param $limit 0,10 (开始条数,显示条数)
	 * @return string
	 */
	function limit($limit)
	{
		if ($limit)
		{
			$limit_sql = ' LIMIT ' . $limit;
		}
		else
		{
			$limit_sql = '';
		}

		return $limit_sql;
	}
	
	public function total($table = '', $where = '')
	{
		$sql = '';
		if (stristr($table, 'select'))
		{
			$sql = $table;
		}
		else
		{
			$sql = 'SELECT 1 FROM ' . $table;

			if (is_array($where) && !empty($where))
			{
				$q     = count($where);
				$w     = 1;
				$q_sql = '';

				foreach ($where as $where_key => $where_val)
				{
					$wheresql = '';

					if ($w == 1 && !empty($where_val))
					{
						if (stristr($where_key, 'or') && $where_key != 'order')
						{
							$q_sql .= ' OR ';
						}
						elseif ($where_key != 'order' && $where_key != 'limit')
						{
							$q_sql .= ' WHERE ';
						}
						//$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' WHERE ' : '';
					}
					elseif (!empty($where_val))
					{
						if (stristr($where_key, 'or') && $where_key != 'order')
						{
							$q_sql .= ' OR ';
						}
						elseif ($where_key != 'order' && $where_key != 'limit')
						{
							$q_sql .= ' AND ';
						}
						//$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' AND ' : '';
					}
					$wheresql = $this->$where_key($where_val);
					$q_sql .= $wheresql;

					if ($w != $q)
					{
						$w++;
					}
				}
				$sql .= $q_sql;
			}
			else
			{
				if (!empty($where))
				{
					$sql .= " WHERE {$where}";
				}
			}
		}
		//print_r($sql);exit;
		$count_num = $this->count($sql);

		return $count_num;
	}
	
	/**
	 * 插入记录
	 *
	 * @access public
	 * @param string $sql sql指令
	 * @return false | integer
	 */
	public function insert($table, $query)
	{
		$sql = '';
		if (stristr($table, 'insert'))
		{
			$sql = $table;
		}
		else
		{
			if (count($query) > 0)
			{
				$queryitems = '';
				foreach ($query as $key => $val)
				{
					/*if ($val!='')
					{
						$queryitems[$key] = $val;
					}*/
					$queryitems[$key] = $val;
				}
				$i = count($queryitems);
				$j = 1;
				if ($i > 0 && !empty($queryitems))
				{
					$key_sql = '';
					$val_sql = '';
					foreach ($queryitems as $qkey => $qval)
					{
						if ($j == 1)
						{
							$key_sql .= '`'.$qkey.'`';
						}
						else
						{
							$key_sql .= ',`' . $qkey.'`';
						}
						if ($j == 1)
						{
							// if(stristr($qval, '+')){
							// 	$val_sql .= $qval;
							// }else{
								$val_sql .= "'" . $qval . "'";
							// }
						}
						else
						{
							// if(stristr($qval, '+')){
							// 	$val_sql .= "," . $qval;
							// }else{
								$val_sql .= ",'" . $qval . "'";
							// }
							
						}
						if ($j != $i)
						{
							$j++;
						}
					}
					$sql = "INSERT INTO " . $table . " (" . $key_sql . ") VALUES(" . $val_sql . ")";
				}
			}
		}

		return $this->execute($sql);
	}
	
	/**
	 * 更新记录
	 *
	 * @access public
	 * @param string $sql sql指令
	 * @return false | integer
	 */
	public function update($table, $query, $where)
	{
		$sql = '';
		if (stristr($table, 'update'))
		{
			$sql = $table;
		}
		else
		{
			if (count($query) > 0)
			{
				$queryitems = '';
				foreach ($query as $key => $val)
				{
					/*
					if ($val!=='')
					{
						$queryitems[$key] = $val;
					}
					*/
					$queryitems[$key] = $val;
				}
				$i = count($queryitems);
				$j = 1;
				if ($i > 0 && !empty($queryitems))
				{
					$sql .= "UPDATE " . $table . " SET ";
					foreach ($queryitems as $qkey => $qval)
					{
						if ($j == 1)
						{
							if($qval===null){
								$sql .= (stristr($qkey, '=')) ? $qkey . $qval : "`".$qkey . "`= NULL";
							}else{
								$sql .= (stristr($qkey, '=')) ? $qkey . $qval : "`".$qkey . "`='" . $qval . "'";
							}
						}
						else
						{
							if($qval===null){
								$sql .= (stristr($qkey, '=')) ? "," . $qkey . $qval : ",`" . $qkey . "`= NULL";
							}else{
								$sql .= (stristr($qkey, '=')) ? "," . $qkey . $qval : ",`" . $qkey . "`='" . $qval . "'";
							}
							
						}
						if ($j != $i)
						{
							$j++;
						}
					}
				}
			}
			if (!empty($where))
			{
				$q     = count($where);
				$w     = 1;
				$q_sql = '';
				foreach ($where as $where_key => $where_val)
				{
					if ($w == 1)
					{
						/*if (stristr($where_key, 'or'))
						{
							$q_sql .= $q_sql . ' OR ';
						}
						else
						{
							$q_sql .= $q_sql . ' WHERE ';
						}*/
						$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' WHERE ' : '';
					}
					else
					{
						/*if (stristr($where_key, 'or'))
						{
							$q_sql .= $q_sql . ' OR ';
						}
						else
						{
							$q_sql .= $q_sql . ' AND ';
						}*/
						$q_sql .= ($where_key != 'order' && $where_key != 'limit' && $where_key != 'group') ? ' AND ' : '';
					}
					$wheresql = $this->$where_key($where_val);
					$q_sql .= $wheresql;

					if ($w != $q)
					{
						$w++;
					}
				}

				$sql .= $q_sql;
			}
		}	
		return $this->execute($sql);
	}
	
	/**
	 * 删除记录
	 *
	 * @access public
	 * @param string $sql sql指令
	 * @return false | integer
	 */
	public function delete($table, $where)
	{
		$sql = '';
		if (stristr($table, 'DELETE'))
		{
			$sql = $table;
		}
		else
		{
			if (!empty($where))
			{
				$sql   = "DELETE FROM " . $table;
				$q     = count($where);
				$w     = 1;
				$q_sql = '';
				foreach ($where as $where_key => $where_val)
				{
					if ($w == 1)
					{
						/*if (stristr($where_key, 'or'))
						{
							$q_sql .= $q_sql . ' OR ';
						}
						else
						{
							$q_sql .= $q_sql . ' WHERE ';
						}*/
						$q_sql .= $q_sql . ' WHERE ';
					}
					else
					{
						$q_sql = $q_sql . ' AND ';
					}

					$wheresql = $this->$where_key($where_val);
					$q_sql .= $wheresql;

					if ($w != $q)
					{
						$w++;
					}
				}

				$sql .= $q_sql;
			}
		}

		return $this->execute($sql);
	}

    /**
     * 查询记录数
     * @access public
     * @param string $sql  sql指令
     * @return false | integer
     */
	public function count($sql) {
		if (!$this->_link_id)
			return false;
		$this->query_str = $sql;
		//释放前次的查询结果
		if ($this->query_id)
			$this->free();

		$this->query_id = mysql_query($sql, $this->_link_id);
		if (false === $this->query_id) {
			$this->error();
			return false;
		} else {
			return mysql_num_rows($this->query_id);
		}
	}

    /**
     * 执行查询 返回数据集
     * @access public
     * @param string $sql  sql指令
     * @return mixed
     */
	public function query($sql) {
		if (!$this->_link_id)
			return false;
		$this->query_str = $sql;
		//释放前次的查询结果
		if ($this->query_id)
			$this->free();

		$this->query_id = mysql_query($sql, $this->_link_id);
		if (false === $this->query_id) {
			$this->error();
			return false;
		} else {
			$this->num_rows = mysql_num_rows($this->query_id);
			$result = NULL;
			for ($i = 0; $i < $this->num_rows; $i++) {
				$result[$i] = mysql_fetch_array($this->query_id,MYSQL_ASSOC);
			}
			$this->result = $result;
			return $result;
		}
	}

	/**
     * 执行语句
     * @access public
     * @param string $sql  sql指令
     * @return integer
     */
	public function execute($sql) {
		if (!$this->_link_id)
			return false;
		$this->query_str = $sql;
		//释放前次的查询结果
		if ($this->query_id)
			$this->free();

		$result = mysql_query($sql, $this->_link_id);
		if (false === $result) {
			$this->error();
			return false;
		} else {
			$this->num_rows = mysql_affected_rows($this->_link_id);
			$this->last_id = mysql_insert_id($this->_link_id);
			return $this->num_rows;
		}
	}
	
	public function last_id(){
		return $this->last_id;
	}

	/**
     * 初始化
     * @access public
     * @param string $class  DB库文件名
     * @param string $db_config  自定义配置
     */
	public function init($class = 'Mysql', $db_config = '') {
		//初始化响应数据
		$this->response = json_decode(json_encode(array('code'=>200,'data'=>'')));
		
		// 读取数据库配置
		$db_config = $this->getDefaultConfig($db_config);

		if (file_exists(CORE_PATH . $class . '.php')) {
			$this->connect();
		}
		else{
			$this->response->code = 50;
			$this->response->data = '系统不支持'.$class.'数据库!';
		}
	}

    /**
     * 释放查询结果
     * @access public
     */
	public function free() {
		mysql_free_result($this->query_id);
		$this->query_id = 0;
	}

    /**
     * 获取数据库配置信息
     * @access private
     * @param mixed $db_config 数据库配置信息
     * @return string
     */
	private function getDefaultConfig($db_config = '') {
		if (empty($db_config)) {
			$db_config = array();
			$db_config['username'] = DB_USER;
			$db_config['password'] = DB_PWD;
			$db_config['hostname'] = DB_HOST;
			$db_config['port'] = DB_PORT;
			$db_config['database'] = DB_NAME;
			$db_config['charset'] = DB_CHARSET;
			$db_config['prefix'] = DB_PREFIX;
		}

		$this->db_config = $db_config;

		return $db_config;
	}

    /**
     * 关闭数据库
     * 并显示当前的SQL语句
     * @access public
     */
	public function close() {
		if (!empty($this->query_id))
			mysql_free_result($this->query_id);
		if ($this->_link_id && !mysql_close($this->_link_id)) {
			die($this->error());
		}
		$this->_link_id = 0;
	}

    /**
     * 数据库错误信息
     * 并显示当前的SQL语句
     * @access public
     * @return string
     */
	public function error($debug = true) {
		$this->error = mysql_error($this->_link_id);
		if ($debug && '' != $this->query_str) {
			$this->error .= "\n [ SQL语句 ] : " . $this->query_str;
		}
		@file_put_contents(LOG_PATH . date("Y-m-d",time()).'_sql_error.log', date("Y-m-d H:i:s",time())." : ".$this->error."\r\n", FILE_APPEND);
		return $this->error;
	}
	
	public function last_query(){
		return $this->query_str;
	}

    /**
     * SQL指令安全过滤
     * @access public
     * @param string $sql  SQL字符串
     * @return string
     */
	public function escapeString($sql) {
		if ($this->_link_id) {
			return mysql_real_escape_string($sql, $this->_link_id);
		} else {
			return mysql_escape_string($sql);
		}
	}

   /**
     * 析构方法
     * @access public
     */
	public function __destruct() {
		// 关闭连接
		$this->close();
	}

}