<?php

/**
 * 物品转让分类表模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-08
 * @version 1.0
 */

class goods_transfer_class_redis extends base_redis {
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

    public function getItem($param){

    }



    public function getJson($param){

    }



    /**
     * 添加
     * @return array
     */
    public function create($param){

    }

    /**
     * 编辑
     * @return array
     */
    public function update($param){

    }


    /**
     * 删除
     *
     * @param int $id
     * @return bool
     */
    function delete($param)
    {

     
    }





    /*
    查询分类命是否重复
     */
    public function findrepeat($param){

    }


}