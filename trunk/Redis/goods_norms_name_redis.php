<?php

/**
 * 规格值REDIS
 *
 * @author wsbnet@qq.com
 * @since   2016-07-28
 * @version 1.0
 */
 
class goods_norms_name_redis extends base_redis {
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

	public function getlistpre($param){

	}

	//查询规格名称和规格值
	public function getNormsNameValue($param){

	}

	//查询自定义的 规格名称和规格值
	public function getNormsNameAddValue($param){

	}

	//查询规格预约名称和规格值
	public function getPreNormsNameValue($param){

	}

	//查询自定义的 规格名称和规格值
	public function getPreNormsNameAddValue($param){

	}

	//查询规格名称和规格值
	public function getNormsNameRefValue($param){

	}

	//查询预约规格名称和规格值
	public function getPreNormsNameRefValue($param){

	}

	//查询标准规格名称
	public function getNorms($param){

	}

	//获取所有规格值
	public function getAllNormsValue($param){

	}

	//获取预约所有规格值
	public function getAllPreNormsValue($param){

	}

	//查询标准规格值
	public function getNormsValue($param){

	}

	//查询预约标准规格值
	public function getPreNormsValue($param){

	}

	//查询对应商品的规格值
	public function getNormsAddValue($param){

	}

	//查询对应预约商品的规格值
	public function getPreNormsAddValue($param){

	}

	//根据商品Id查询商品的规格、库存、价格
	public function getGoodsNormsValueStock($param){

	}

	//根据商品Id查询预约商品的规格、库存、价格
	public function getPreGoodsNormsValueStock($param){

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