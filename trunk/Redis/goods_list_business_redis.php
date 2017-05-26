<?php

/**
 * 富媒体表REDIS
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class goods_list_business_redis extends base_redis {
	//后台用户数据表
	private $admin_user_table = 'base_media';
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

  public function getGoodsByProvider($param){
    
  }
  
  /**
   * 添加
   * @return array
   */
  public function create($param){
    $name_key = GOODSINDEX_PROVIDER.$param['providerId'];
    $data = json_encode($param['items'],JSON_UNESCAPED_UNICODE);
    $ret = $this->redis->set($name_key,$data);
    if($ret){
      $this->result['status'] = 1;
      $this->result['data'] = array('id' => $param['id'] );
    }
    else{
      $this->result['status'] = 0;
      $this->result['data'] = 'Redis数据存储失败';
    }
    return $this->result;
  }

  public function create_brokerage($param){
    
  }

  /**
   * 编辑
   * @return array
   */
  public function update($param){
    
    $this->delete(array('providerId' => $param['old_providerId']));

    $name_key = GOODSINDEX_PROVIDER.$param['providerId'];
    $data = json_encode($param['items'],JSON_UNESCAPED_UNICODE);
    $ret = $this->redis->set($name_key,$data);
    if($ret){
      $this->result['status'] = 1;
      $this->result['data'] = array('id' => $param['id'] );
    }
    else{
      $this->result['status'] = 0;
      $this->result['data'] = 'Redis数据存储失败';
    }
    return $this->result;
  }

  /**
   * 删除
   *
   * @param int $id
   * @return bool
   */
  function delete($param)
  {
    $name_key = GOODSINDEX_PROVIDER.$param['providerId'];
    $ret = $this->redis->del($name_key);
    if($ret){
      $this->result['status'] = 1;
      $this->result['data'] = array('id' => $param['id'] );
    }
    else{
      $this->result['status'] = 0;
      $this->result['data'] = 'Redis数据删除失败';
    }
    return $this->result;
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

    /**
     * 对象数组转为普通数组
     *
     * AJAX提交到后台的JSON字串经decode解码后为一个对象数组，
     * 为此必须转为普通数组后才能进行后续处理，
     * 此函数支持多维数组处理。
     * 303232810@qq.com 
     * 2016-08-22
     *
     * @param array
     * @return array
     */
    public function objarray_to_array($obj) {
       
    }

  /**
   * 存储组合商品
   *
   * @param array $param 参数组
   * @param int   $id    用户id
   * @return array
   */
  public function savesizegoods($param)
  {
     
  }

  public function findGoodsCode($goodsCode){
  }

}