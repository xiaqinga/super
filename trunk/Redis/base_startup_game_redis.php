<?php

/**
 * 创客大赛表模型
 */
class base_startup_game_redis extends base_redis 
{
    //后台用户数据表
    private $admin_user_table = 'user';
    //后台用户表字段
    private $admin_user_field = array('user_id','user_name','password','name','tel','email','role_id','status','created_time','updated_time');
    
    /**
     * 初始化
     */
    public function __construct(&$redis){
        parent::__construct($redis);
    }

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

    public function findrotation($id){
        
    }

    /**
     * 团队列表
     */
    public function getTeamlist($param){
        
    }

    public function teamlist($param){
        
    }

    /**
     * 添加
     * @return array
     */
    public function createteam($param){
        
    }

    /**
     * 编辑
     * @return array
     */
    public function updateteam($param){
        
    }

    /**
     * 删除
     *
     * @param int $id
     * @return bool
     */
    function deleteteam($param)
    {
        
    }

    public function teamlistId($param){
        
    }

    public function teamlistmember($param){
       
    }

    public function updatePrice($param){
        
    }
}
?>