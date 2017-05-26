<?php

/**
 * 无限极分类-二维无限分类数组处理类
 **/

class Category
{
    //无限分类数组，其中必须要有id和pid
    public static $list = [];
    //id => pid 数组
    private static $_sp_list = [];
    //子分类key
    private static $_sk;
    //父分类key
    private static $_pk;

    /**
     * 处理结果
     */
    public $result = array(
        'status' => 0,
        'data'   => null
    );

    /**
     *对数组进行初始化处理
     * $cat_list 无限分类数组
     * $skey 数组中子分类的key值
     * $pkey 数组中父分类的key值
     * @return mixed array
     **/
    public function __construct($param)
    {
        $this->result['status'] = 1;
        self::$_sk = $param['skey'];
        self::$_pk = $param['pkey'];
        $this->init($param['cat_list']);
    }

    /**
     *对数组进行初始化处理
     * @return mixed array
     **/
    public function init($cat_list)
    {
        if (empty($cat_list))
        {
            return false;
        }
        //对数组进行预处理
        foreach ($cat_list as $key => $val)
        {
            //生成sid => pid 数组
            self::$_sp_list[$val[self::$_sk]] = $val[self::$_pk];
            //以数组的子分类值作为索引
            self::$list[$val[self::$_sk]] = $val;
        }
        unset($cat_list);
    }

    /**
     * 获取格式化的树形数据
     * @param $pid int $list中顶级分类id
     * @param $level int $list中顶级分类的层级
     * @param $html string 上下层级之间的标示符号
     * @return mixed
     **/
    public static function sort($pid = 0, $level = 0, $html = '-------')
    {
        if (empty(self::$list))
        {
            return false;
        }
        static $tree = array();
        foreach (self::$list as $v)
        {
            if ($v[self::$_pk] == $pid)
            {
                $v['sort'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $tree[$v[self::$_sk]] = $v;
                self::sort($v[self::$_sk], $level + 1);
            }
        }
        return $tree;
    }

    /**
     * 获取分类的无限极子分类，以树型结构显示
     * @param $son string 子节点节点名
     * @return mixed
     **/
    public static function tree($son = 'son')
    {
        if (empty(self::$list))
        {
            return false;
        }
        $list = self::$list;
        foreach ($list as $item)
        {
            $list[$item[self::$_pk]][$son][] = &$list[$item[self::$_sk]];
        }
        return isset($list[0][$son]) ? $list[0][$son] : array();
    }

    /**
     * 获取分类的祖先分类
     * @param $id int 分类id
     * @param $type bool true-返回祖先分类数组 false-返回祖先分类id
     * @return mixed
     **/
    public static function ancestor($id, $type = true)
    {
        if (empty(self::$list) || empty(self::$_sp_list))
        {
            return false;
        }
        while (self::$_sp_list[$id])
        {
            $id = self::$_sp_list[$id];
        }
        return $type && isset(self::$list[$id]) ? self::$list[$id] : $id;
    }

    /**
     * 获取所有父级分类对应层级关系
     * @param $id int 分类id
     * @param $type bool true-返回分类数组 false-返回分类id
     * @return mixed
     **/
    public static function parents($id, $type = true)
    {
        if (empty(self::$list))
        {
            return false;
        }
        $info = [];
        while (isset(self::$_sp_list[$id]))
        {
            $info[] = $type ? self::$list[$id] : $id;
            $id = self::$_sp_list[$id];
        }
        return $info;
    }

    /**
     * 获取所有子级分类对应层级关系
     * @param $id int 子分类id
     * @param $type bool true-返回分类数组 false-返回分类id
     * @return mixed
     **/
    public static function sons($id, $type = true)
    {
        if (empty(self::$list))
        {
            return false;
        }
        static $info = [];
        foreach (self::$list as $val)
        {
            if ($val[self::$_pk] == $id)
            {
                $info[$val[self::$_sk]] = $type ? $val : $val[self::$_sk];
                if (self::has_son($val[self::$_sk]))
                {
                    self::sons($val[self::$_sk], $type);
                }
            }
        }
        return $info;
    }

    /**
     * 获取所有儿子分类
     * @param $p_id int 父id
     * @param $type bool true-返回分类数组 false-返回分类id
     * @return mixed
     **/
    public static function son($p_id = 0, $type = true)
    {
        if (empty(self::$list))
        {
            return false;
        }
        $_arr = [];
        foreach (self::$list as $val)
        {
            if ($val[self::$_pk] == $p_id)
            {
                $_arr[$val[self::$_sk]] = $type ? $val : $val[self::$_sk];
            }
        }
        return $_arr;
    }

    /**
     * 是否含有子分类，是否是叶子节点
     * @param $pid int 父分类id
     * @return mixed
     **/
    public static function has_son($pid)
    {
        if (empty(self::$list) || empty(self::$_sp_list))
        {
            return false;
        }
        return in_array($pid, array_values(self::$_sp_list));
    }
}