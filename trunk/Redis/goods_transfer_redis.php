<?php

/**
 * 转让物品表
 *
 * @author wsbnet@qq.com
 * @since   2016-11-18
 * @version 1.0
 */

class goods_transfer_redis extends base_redis {
    private $admin_user_table = '';
    //后台用户表字段
    private $admin_user_field = array();

    /**
     * 初始化
     */
    public function __construct(&$redis){
        parent::__construct($redis);
    }

    public function getlist($param){

    }
    /**
     * 上架
     *
     * @param int $id
     * @return bool
     */
    function upstore($param)
    {
    }

    /**
     * 下架
     *
     * @param int $id
     * @return bool
     */
    function downstore($param)
    {

    }



}