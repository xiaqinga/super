<?php

/**
 * 投稿征集
 *
 */
class base_submission_redis extends base_redis 
{
    //后台用户数据表
    private $admin_user_table = 'user';
    //后台用户表字段
    private $admin_user_field = array('user_id','user_name','password','name','tel','email','role_id','status','created_time','updated_time');
    
    /**
     * 初始化
     */
    public function getlist($param){
        
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

    //投稿列表
    public function recordlist($param){
       
    }

    //学校列表
    public function schoollist($param){
        
    }

    public function upstatus($param){
        
    }

    public function exportorder($param){
        
    }

    public function findrecord($param){
        
    }

    public function findSubId($param){
        
    }

    public function findSubIds($param){
        
    }
    public function disabled($param){
        
    }

    public function findPhoto($param){
        
    }
}
?>