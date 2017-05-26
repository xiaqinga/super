<?php



class base_school_news_redis extends base_redis {
    //后台用户数据表
    private $admin_user_table = 'user';
    //后台用户表字段
    private $admin_user_field = array('');

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

}