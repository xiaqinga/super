<?php

/**
 * 商品品牌
 *
 * @author wsbnet@qq.com
 * @since   2016-08-12
 * @version 1.0
 */

class goods_comment_redis extends base_redis {
    //后台用户数据表
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
     * 删除
     *
     * @param int $id
     * @return bool
     */
    function delete($param)
    {

    }

    /**
     * 修改
     *
     * @param int $id
     * @return bool
     */
    function update($param)
    {
        
    }
    /**
     * 获取评论回复
     *
     * @param int $id
     * @return string
     */
     function getRereplyContent($param){
        
     }
    /**
     * 新增/修改评论回复
     *
     * @param array
     * @return bool
     */
    function setRereplyContent($param){
         
    }
}