<?php

/**
 * Appredis
 * @author janhve@163.com
 * @since   2016-09-10
 * @version 1.0
 */
class appmass_redis extends base_redis {
    //后台用户数据表
    private $admin_user_table = 'app_mass';
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

    public function create($param){

    }
    public function find($param){

    }


    public function delete($param){

    }
}