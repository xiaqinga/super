<?php

/**
 * 商品集合模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-10
 * @version 1.0
 */
 
class goods_list_db{
	//Db
	private $db = NULL;
	//database table
	private $table = 'v_goods_info';
	private $t_table = 'goods_list';
	private $table_logisticsCost = 'base_logisticscost';
	private $table_provider = 'base_enterprise_info';
	private $table_class = 'goods_class';
	private $table_stock = 'goods_normsvalue_stock';
	private $table_goods_stock = 'goods_norms_stock';
	private $table_ref = 'goods_norms_values_ref';
	private $table_brokerage = 'goods_brokerage';
	private $table_add_norms = 'goods_add_norms_value';
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = 'v_goods_info';
		$this->t_table = DB_PREFIX . 'goods_list';
		$this->table_logisticsCost = DB_PREFIX . 'base_logisticscost';
		$this->table_provider = DB_PREFIX . 'base_enterprise_info';
		$this->table_class = DB_PREFIX . 'goods_class';
		$this->table_stock = DB_PREFIX . 'goods_normsvalue_stock';
		$this->table_goods_stock = DB_PREFIX . 'goods_norms_stock';
		$this->table_ref = DB_PREFIX . 'goods_norms_values_ref';
		$this->table_brokerage = DB_PREFIX . 'goods_brokerage';
		$this->table_add_norms = DB_PREFIX . 'goods_add_norms_value';
	}
	
	public function getlist($param){
		// var_dump($param);die();
		$where = array();
		if(!empty($param['mallType'])){
			$where['where']['a.mallType'] = $param['mallType'];
		}
		
		if(!empty($param['goodsCode'])){
			$where['like']['a.goodsCode'] = $param['goodsCode'];
		}

		if(!empty($param['goodsName'])){
			$where['like']['a.goodsName']  = $param['goodsName'];
		}

		if(!empty($param['goodsClassId'])){
			//找子分类
			if(count($param['childClass']) > 0){
					$inIDs = implode($param['childClass'],',');
				$where['where']['a.goodsClassId  IN '] ='('. $inIDs.')';
			}else{
				$where['where']['a.goodsClassId'] = $param['goodsClassId'];
			}
		}

		if(!empty($param['providerId'])){
			$where['where']['a.providerId'] = $param['providerId'];
		}

		if(!empty($param['status'])){
			$where['where']['a.status'] = $param['status'];
		}

		$total = $this->db->total($this->table.' a LEFT JOIN '.$this->table_logisticsCost.' b on a.logisticsCostId=b.id ', $where);
		$this->result['data']['total'] = $total;

		if(!empty($param['id'])){
			$where['where']['a.id'] = $param['id'];
		}
		$where['order']['a.id'] = 'DESC';
		if( isset($param['limit']) )
		{
			$where['limit'] = $param['limit'];
		}
		$data  = $this->db->select($this->table.' a LEFT JOIN '.$this->table_logisticsCost.' b on a.logisticsCostId=b.id ', 'a.*, a.className as goodsClassName, a.providerName as providerName, func_receiveAddress(b.aeraCode) as sourceSendAddress', $where);
		// var_dump($this->db->last_query());die();
		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}

	public function getGoodsByProvider($param){
		$where = '';
		if(!empty($param['providerId'])){
			$where .= " and a.providerId = ".$param['providerId'];
		}
		if(!empty($param['mallType'])){
			$where .= " and a.mallType = ".$param['mallType'];
		}
		$data  = $this->db->select("select a.id,a.goodsName,
																CASE WHEN a.status = 1 
																	THEN '上架' 
																WHEN a.status = 2 
																	THEN '下架' 
																ELSE '删除' 
																END status,

													    	CASE WHEN a.isTurnBack='Y' 
													    		THEN '是' 
													    	ELSE '否' 
													    	END  isTurnBack,

													    	CASE WHEN a.isFreight='Y' 
													    		THEN '是' 
													    	ELSE '否' 
													    	END  isFreight,

													    	b.providerName,c.className,d.originalPrice,d.restockPrice,d.preferentialPrice,f.normsValueIds
																from ".$this->t_table." a 
																LEFT JOIN t_base_provider_ref h on h.id=a.providerId 
																LEFT JOIN ".$this->table_provider." b on b.id=h.refId
																LEFT JOIN ".$this->table_class." c on c.id=a.goodsClassId
																LEFT JOIN ".$this->table_stock." d on d.goodsId=a.id
																LEFT JOIN ".$this->table_ref." f on f.id=d.goodsNormsValueId
																WHERE 1=1 ".$where);




		if(!empty($data))
		{
			$this->result['status'] = 1;
			$this->result['data']['list']   = $data;
		}
		else
		{
			$this->result['status'] = 0;
			$this->result['data']   = '获取数据失败';
		}
		return $this->result;
	}
	
	/**
	 * 添加
	 * @return array
	 */
	public function create($param){
		$ret = $this->db->insert($this->t_table, $param);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']['id'] = $this->db->last_id;
		}else{
			$this->result['status'] = 0;
		}
		// $id = $param['id'] = $this->db->last_id;
		// $brokerage['goodsId'] = $id;
		// if($ret){

		// 	$this->result['status'] = 1;
		// 	$where = array(
		// 		'where' => array(
		// 			'id' => $param['id']
		// 		)
		// 	);
		// 	$data = $this->db->select($this->t_table,'goodsClassId, providerId', $where);

  //     $providerClass = $this->db->select("SELECT goodsClassId FROM t_goods_list WHERE status = 1 AND providerId=".$data[0]['providerId']." group by goodsClassId ");
  //     if(count($providerClass)>0){
  //       foreach ($providerClass as $k => $v) {
  //         $where = array(
  //           'where' => array(
  //             'id' => $v['goodsClassId']
  //           )
  //         );
  //         $class_data = $this->db->select($this->table_class, 'id, className, photoUrl', $where);
  //         $itemsArr[] = array(
  //                         'id' => $class_data[0]['id'],
  //                         'className' => $class_data[0]['className'],
  //                         'photoPath' => $class_data[0]['photoUrl']
  //                       );
  //       }
  //     }

		// 	$getredis = array(
		// 		'providerId' => $data[0]['providerId'],
		// 		'items' => $itemsArr,
		// 		'id' =>$id
		// 	);
		// 	$this->result['data']  = $getredis;

		// }
		return $this->result;
	}

	public function create_brokerage($param){
		$ret = $this->db->insert('t_goods_brokerage', $param);
		$param['id'] = $this->db->last_id;

		if($ret){
			$this->result['status'] = 1;
			$this->result['data']   = $param;
		}
		return $this->result;
	}

	/**
	 * 编辑
	 * @return array
	 */
	public function update($param){
		$where = array(
			'where' => array(
				'id' => $param['id']
			)
		);
    $id = $param['id'];
		unset($param['id']);
		
    // $old_data = $this->db->select($this->t_table, 'goodsClassId, providerId', $where);
		$ret = $this->db->update($this->t_table, $param, $where);
		if($ret){
			$this->result['status'] = 1;
			$this->result['data']['id'] = $id;
		}else{
			$this->result['status'] = 0;
		}
		// if($ret){
		// 	$this->result['status'] = 1;
		// 	$data = $this->db->select($this->t_table, 'goodsClassId, providerId', $where);

  //     $providerClass = $this->db->select("SELECT goodsClassId FROM t_goods_list WHERE status = 1 AND providerId=".$data[0]['providerId']." group by goodsClassId ");
  //     if(count($providerClass)>0){
  //       foreach ($providerClass as $k => $v) {
  //         $where = array(
  //           'where' => array(
  //             'id' => $v['goodsClassId']
  //           )
  //         );
  //         $class_data = $this->db->select($this->table_class, 'id, className, photoUrl', $where);
  //         $itemsArr[] = array(
  //                         'id' => $class_data[0]['id'],
  //                         'className' => $class_data[0]['className'],
  //                         'photoPath' => $class_data[0]['photoUrl']
  //                       );
  //       }
  //     }

		// 	$getredis = array(
  //               'old_providerId' => $old_data[0]['providerId'],
		// 		'providerId' => $data[0]['providerId'],
		// 		'items' => $itemsArr,
		// 		'id' => $id
		// 	);

		// 	$this->result['data']   = $getredis;
		// }

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
		if (!empty($param['id']))
		{
			$where = array(
				'where' => array(
					'id' => $param['id']
				)
			);

      		$status['status'] = 0;
			$ret   = $this->db->update($this->t_table,$status,$where);
			if ($ret)
			{
				$where_inner = array(
					'where' => array(
						'goodsId' => $param['id']
					)
				);
				$ret   = $this->db->update($this->table_brokerage,$status, $where_inner);
				$this->result['status'] = 1;

			}
			else
			{
				$this->result['status'] = 0;
			}
		}
		else
		{
			$this->result['status'] = 0;
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
    if (!empty($param['id']))
    {
      $up_param = array(
        'status' => 1
      );
      $where = array(
        'where' => array(
          'id' => $param['id']
        )
      );
      $ret   = $this->db->update($this->t_table, $up_param, $where);
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else
    {
      $this->result['status'] = 0;
    }

    return $this->result;
  }

  /**
   * 下架
   *
   * @param int $id
   * @return bool
   */
  function downstore($param)
  {
    if (!empty($param['id']))
    {
      $up_param = array(
        'status' => 2
      );
      $where = array(
        'where' => array(
          'id' => $param['id']
        )
      );
      $ret   = $this->db->update($this->t_table, $up_param, $where);
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else
    {
      $this->result['status'] = 0;
    }

    return $this->result;
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
        $ret = array();
        foreach ($obj as $key => $value) {
        if (gettype($value) == "array" || gettype($value) == "object"){
                $ret[$key] =  $this->objarray_to_array($value);
        }else{
            $ret[$key] = $value;
        }
        }
        return $ret;
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
      if($param['postsizes']){
      		$a_val = array();
      		$b_val = array();
          $param['postsizes'] = stripslashes($param['postsizes']); //先去掉反斜杠
          $postsizes = json_decode($param['postsizes'],true);
          $param['delpartids'] = stripslashes($param['delpartids']); 
          $delpartids = json_decode($param['delpartids'],true);



          if( count($delpartids) > 0 ){
              //删除规格组合商品
              $delpartids = implode(',', $delpartids);
              $where = array(
                  'where' => array(
                      'id IN ' => '('.$delpartids.')'
                  )
              );
              $this->db->update($this->table_stock, array('status' => 0) , $where);
          }

          foreach (array_reverse($postsizes) as $key => $value) {
              $value = $this->objarray_to_array($value);
              if (!empty($value['goodsId']) && !empty($value['normsvalue_a_val']) && !empty($value['normsvalue_b_val']))  //二个规格
              {
                  $where  = array(
                      'where' => array(
                          'id' => $value['id']
                      )
                  );
                  $hasdata   = $this->db->select($this->table_stock, '', $where);
                  if($hasdata[0]['id']){

                    	$param_update = " b.stockNum = ".$value['stockNum'].",  a.weight = ".$value['weight'].",  a.discount = ".$value['discount'].",  a.preferentialPrice = ".$value['preferentialPrice'].",  a.restockPrice = ".$value['restockPrice'];
											$ret = $this->db->update("UPDATE ".$this->table_stock." a left join ".$this->table_goods_stock." b on b.id=a.stockId  SET ".$param_update." WHERE a.id = ".$value['id']);

                  }else{

                      $insert_data = array(
                    		'stockNum' => $value['stockNum']
                      );
                      $ret = $this->db->insert($this->table_goods_stock, $insert_data);
                      $stockId = $this->db->last_id();

                      if($value['norms_a']){
                     
							$norms_a = $value['norms_a'];

                      }elseif($value['norms_a']==0){ //新添加的规格值, 插入数据库[商品添加的规格]

                          $parama_data['where']=[
							  'goodsId'=>$value['goodsId'],
							  'normsId'=>$value['normsaId'],
							  'normsValue'=>$value['normsvalue_a_val'],
						  ];
						  $norms_a =-$this->db->select($this->table_add_norms,'id', $parama_data)['0']['id'];


                      	/*if(!in_array($value['normsvalue_a_val'],$a_val)){
		                      $insert_data = array(
		                      	'goodsId' =>$value['goodsId'],
		                      	'normsId' => $value['normsaId'],
		                    		'normsValue' => $value['normsvalue_a_val'],
		                      );
	                  			$ret = $this->db->insert($this->table_add_norms, $insert_data);
	                  			$norms_a = -$this->db->last_id();
	                  			$a_val[]=$value['normsvalue_a_val'];
	                      }*/
                  		}

                      if($value['norms_b']){

						  $norms_b = $value['norms_b'];
                      }elseif($value['norms_b']==0){ //新添加的规格值, 插入数据库[商品添加的规格]


						  $paramb_data['where']=[
							  'goodsId'=>$value['goodsId'],
							  'normsId'=>$value['normsbId'],
							  'normsValue'=>$value['normsvalue_b_val'],
						  ];
						  $norms_b  =-$this->db->select($this->table_add_norms,'id', $paramb_data)['0']['id'];




						 /* if(!in_array($value['normsvalue_b_val'],$b_val)){
		                      $insert_data = array(
		                      	'goodsId' =>$value['goodsId'],
		                      	'normsId' => $value['normsbId'],
		                    		'normsValue' => $value['normsvalue_b_val'],
		                      );
	                  			$ret = $this->db->insert($this->table_add_norms, $insert_data);
	                  			$norms_b = -$this->db->last_id();
	                  			$b_val[]=$value['normsvalue_b_val'];
                  			}*/
                  		}
       
                      $insert_data = array(
                    		'normsValueIds' => $norms_a.','.$norms_b,
                      );


                      $ret = $this->db->insert($this->table_ref, $insert_data);
                      $goodsNormsValueId = $this->db->last_id();

                      $insert_data = array(
                      	'goodsNormsValueId' =>$goodsNormsValueId,
                      	'goodsId' => $value['goodsId'],
                    		'stockId' => $stockId,
                        'weight' => $value['weight'],
                        'discount' => $value['discount'],
                        'preferentialPrice' => $value['preferentialPrice'],
                        'restockPrice' => $value['restockPrice'],
                      );
                      $ret = $this->db->insert($this->table_stock, $insert_data);


                  }
              }else if(!empty($value['goodsId']) && !empty($value['normsvalue_a_val'])){   //仅一个规格
                  $where  = array(
                      'where' => array(
                          'id' => $value['id']
                      )
                  );
                  $hasdata   = $this->db->select($this->table_stock, '', $where);
                  if($hasdata[0]['id']){

                    $param_update = " b.stockNum = ".$value['stockNum'].",  a.weight = ".$value['weight'].",  a.discount = ".$value['discount'].",  a.preferentialPrice = ".$value['preferentialPrice'].",  a.restockPrice = ".$value['restockPrice'];
                    $ret = $this->db->update("UPDATE ".$this->table_stock." a left join ".$this->table_goods_stock." b on b.id=a.stockId  SET ".$param_update." WHERE a.id = ".$value['id']);
                    $ret = 1;
                      
                  }else{
                      $insert_data = array(
                    		'stockNum' => $value['stockNum']
                      );
                      $ret = $this->db->insert($this->table_goods_stock, $insert_data);
                      $stockId = $this->db->last_id();

                      if($value['norms_a']){

						  $norms_a = $value['norms_a'];
                      }elseif($value['norms_a']==0){ //新添加的规格值, 插入数据库[商品添加的规格]
						  

                  		
						  $paramb_data['where']=[
							  'goodsId'=>$value['goodsId'],
							  'normsId'=>$value['normsaId'],
							  'normsValue'=>$value['normsvalue_a_val'],
						  ];
						  $norms_a  =-$this->db->select($this->table_add_norms,'id', $paramb_data)['0']['id'];


					  }


						  $insert_data = array(
                    		'normsValueIds' => $norms_a.',0',
                      );
                      $ret = $this->db->insert($this->table_ref, $insert_data);
                      $goodsNormsValueId = $this->db->last_id();

                      $insert_data = array(
                      	'goodsNormsValueId' =>$goodsNormsValueId,
                      	'goodsId' => $value['goodsId'],
                    	'stockId' => $stockId,
                        'weight' => $value['weight'],
                        'discount' => $value['discount'],
                        'preferentialPrice' => $value['preferentialPrice'],
                        'restockPrice' => $value['restockPrice'],
                      );
                      $ret = $this->db->insert($this->table_stock, $insert_data);
                  }
              }
          }
      }

      if($ret){
          $this->result['status'] = 1;
          $this->result['data']   = $postsizes; //返回完整的记录信息
      }else{
          $this->result['status'] = 0;
      }


      return $this->result;
  }

  /**
   * 存储自定义商品规格
   *
   * @param array $param 参数组
   * @param int   $id    用户id
   * @return array
   */
  public function savesize($param)
  {

    $updateids = array();
	$satus=false;
    if(count($param['f_vals'])>0){

      foreach ($param['f_vals'] as $key => $value) {
		  if(!$value[0]['id']){
			  $satus=true;
			  $param_insert=[
				  'goodsId'=>$param['goods_id'],
				  'normsId'=>$param['normsaId'],
				  'normsValue'=>$value[0]['value'],
			  ];
			  $ret = $this->db->insert($this->table_add_norms, $param_insert);
			  $updateids[]=$this->db->last_id();
		  }
		  if($value[0]['id']<0){
			  $updateids[]=abs($value[0]['id']);
			  $f_param_update=['normsValue'=>$value[0]['value']];
			  $f_where['where']['id']=abs($value[0]['id']);
			  $this->db->update($this->table_add_norms, $f_param_update, $f_where);
		  }

      }
    }
    if(count($param['s_vals'])>0){
      foreach ($param['s_vals'] as $key => $value) {
		 
		  if(!$value[0]['id']){
			  $satus=true;
			  $param_insert=[
				  'goodsId'=>$param['goods_id'],
				  'normsId'=>$param['normsbId'],
				  'normsValue'=>$value[0]['value'],
			  ];
			  $ret = $this->db->insert($this->table_add_norms, $param_insert);
			  $updateids[]=$this->db->last_id();
		  }
		  
		  if($value[0]['id']<0){
			  $updateids[]=abs($value[0]['id']);
			  $s_param_update=['normsValue'=>$value[0]['value']];
			  $s_where['where']['id']=abs($value[0]['id']);
			  $this->db->update($this->table_add_norms, $s_param_update, $s_where);

		  }
		 

      }
    }

	  if($satus){
		  $updateids_str = implode(',', $updateids);
		  $this->db->delete("DELETE FROM {$this->table_add_norms} WHERE goodsId={$param['goods_id']} AND id NOT IN($updateids_str)");

	  }



	  if($ret){
      $this->result['status'] = 1;
    //  $data = $this->db->select($this->t_table, '', $where);
    // $this->result['data']   = $data[0];
    }
    return $this->result;
  }

  /**
   * 商品编号唯一
   */
    public function findGoodsCode($goodsCode){
	    $where['where']['goodsCode']=$goodsCode;
	    $rest = $this->db->select('t_goods_list','',$where);

	    if($rest){
		  $this->result['status'] = 1;
	    }else{
		  $this->result['status'] = 0;
	    }

	    return $this->result;
    } 

    public function setReject($param){
    	$where = array(
    		'where' => array(
    			'id' => $param['id']
    		)
    	);
    	unset($param['id']);
    	$resp = $this->db->update('t_goods_list', $param, $where);
    	if($resp){
		  $this->result['status'] = 1;
	    }else{
		  $this->result['status'] = 0;
	    }
	    return $this->result;
    }

    public function setgoodscode($param){
    	$where['where']['goodsCode'] = $param['goodsCode'];
    	$where['where']['id !='] = $param['id'];
    	$resp = $this->db->select('t_goods_list','',$where);
    	if ($resp) {
    		$this->result['status'] = 1;
    	}else{
    		$this->result['status'] = 0;
    	}
    	return $this->result;
    }
}