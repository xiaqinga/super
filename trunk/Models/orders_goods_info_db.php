<?php

/**
 * 商品订单模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-23
 * @version 1.0
 */
 
class orders_goods_info_db{
	//Db
	private $db = NULL;
	//database table
	private $table = 'v_order_info';
  private $table_list = "orders_list";
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = 'v_order_info';
    $this->table_list = DB_PREFIX.'orders_list';
    $this->table_flow = DB_PREFIX.'orders_flow';
	}

  public function getlist($param){
    $where = ' a.mallType ='.$param['mallType'];

    if(!empty($param['ordersNo'])){
      $where .= " and a.ordersNo LIKE '%".$param['ordersNo']."%' ";
    }

    if(!empty($param['goodsName'])){
      $where .= " and a.goodsName LIKE '%".$param['goodsName']."%' ";
    }

    if(!empty($param['providerName'])){
      $where .= " and a.providerName LIKE '%".$param['providerName']."%' ";
    }

    if(!empty($param['realName'])){
      $where .= " and a.receivePeople LIKE '%".$param['realName']."%' ";
    }

    if(!empty($param['memberAlias'])){
      $where .= " and a.alias LIKE '%".$param['memberAlias']."%' ";
    }

    if(!empty($param['payMode'])){
      $where .= " and a.payMode LIKE '%".$param['payMode']."%' ";
    }
    
    if(!empty($param['startDate'])){
    	$where .= " and a.createDate >= '".date('Y-m-d 00:00:00',strtotime($param['startDate']))."' ";
    }

    if(!empty($param['endDate'])){
    	$where .= " and a.createDate <= '".date('Y-m-d 23:59:59',strtotime($param['endDate']))."' ";
    }
    if(!empty($param['ids'])){
          $where .= " and a.id IN(".$param['ids'].")";
    } 


      if(!empty($param['status'])){
          if($param['status'] == 7){
              $where .= " and a.status IN (6,7)";
          }else{
              $where .= " and a.status = ".$param['status'];
          }

      }


      if($param['status']==null){
          $where .= " and a.status IN (1,2,3,4,6,7,8)";
      }
	
	  if(!empty($param['providerId'])){
      $where .= " and a.providerId = ".$param['providerId'];
    }
    
    $total = $this->db->total($this->table.' a LEFT JOIN t_orders_receiving_address t5 on t5.ordersId=a.id ', $where);
    $this->result['data']['total'] = $total;

    if(!empty($param['id'])){
      $where .= " and a.id = ".$param['status'];

    }
    $where .= " ORDER BY a.id DESC ";
    if( isset($param['limit']) )
    {
      $where .= " limit ".$param['limit'];

    }
    $data  = $this->db->select($this->table.' a LEFT JOIN t_orders_receiving_address t5 on t5.ordersId=a.id', 'a.id,a.ordersNo,a.providerName,a.linkman,a.createDate,a.goodsName,a.normsValueId,a.isActivity,a.identifier,a.totalAmount,a.photoPath,a.unitPrice,a.buyNum,a.alias,a.realName,a.payMode,a.status,a.receivePeople,a.receivePeopleTelePhone,func_getNormsValueByNormsValueId(a.normsValueId) as normsValue,a.sumMoney,a.leaveWords,a.shouldPay,CONCAT(IFNULL(func_receiveAddress(t5.areaCode),"")," ",t5.address) allAddress,a.emsNo,(select b.emsCode from t_ems_list b where b.id=a.emsId) emsCode,(select b1.emsName from t_ems_list b1 where b1.id=a.emsId) emsName,(select of.actionDate from t_orders_flow of where of.ordersId=a.id and of.status=3) sendDate, (select of.actionDate from t_orders_flow of where of.ordersId=a.id and of.status=6) receiveDate,(select DATE_FORMAT(of.actionDate,"%Y-%m-%d  %T") from t_orders_flow of where of.ordersId=a.id and of.status=2 limit 0,1) payDate, (select mobilePhone from t_base_enterprise_info t1 where t1.id=a.providerId) as linkInfo, (select corporate from t_base_enterprise_info t1 where t1.id=a.providerId) as corporate, (select lockPhone from t_base_enterprise_info t1 where t1.id=a.providerId) as lockPhone', $where);

 //print_R($this->db->last_query());die();
    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']['list']   = $data;
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data']   = 'No Data';
    }
    return $this->result;
  }

   public function getinfo($param){
    if(!empty($param['id'])){
      $data = $this->db->select("select t1.id,t1.ordersNo,t1.payMode,t1.EMSNo,t1.customerId,t1.leaveWords,t1.createDate,t1.isActivity,t2.logistcsCost,t4.providerName,
                                    t4.linkman,t4.mobilePhone as linkInfo,t4.corporate,t4.lockPhone,t5.receivingPeople as receivePeople,t5.telePhone as receivePeopleTelePhone,t5.address,t6.emsName,
                                    CONCAT(IFNULL(func_receiveAddress(t5.areaCode),''),'',t5.address) allAddress,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=2 ORDER BY of.id limit 1) payDate,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=3) sendDate,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=6) receiveDate,
                                    t1.totalAmount,t1.identifier,t1.sumMoney
                                from t_orders_list t1
                                LEFT JOIN t_orders_goods_info t2 on t1.id=t2.ordersId
                                LEFT JOIN t_goods_list t3 on t2.goodsId=t3.id
                                LEFT JOIN t_base_provider_ref t9 on t3.providerId=t9.id
                                LEFT JOIN t_base_enterprise_info t4 on t4.id=t9.refId
                                LEFT JOIN t_orders_receiving_address t5 on t5.ordersId=t1.id
                                LEFT JOIN t_ems_list t6 on t6.id=t1.emsId
                                LEFT JOIN t_orders_flow t7 on t1.id=t7.ordersId
                                where t1.id=".$param['id']."  group by t1.id");
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']   = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data']   = 'No Data';
    }
    return $this->result;
  }

   public function getAllinfo($param){
    $ids = json_decode($param['ids']);
    if(count($ids)>0){
      $ids = implode(',', $ids);
      $data = $this->db->select("select t1.id,t1.ordersNo,t1.payMode,t1.EMSNo,t1.customerId,t1.leaveWords,t1.createDate,t1.isActivity,t2.logistcsCost,t4.providerName,
                                    t4.linkman,t4.mobilePhone as linkInfo,t4.corporate,t4.lockPhone,t5.receivingPeople as receivePeople,t5.telePhone as receivePeopleTelePhone,t5.address,t6.emsName,
                                    CONCAT(IFNULL(func_receiveAddress(t5.areaCode),''),'',t5.address) allAddress,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=2 ORDER BY of.id limit 1) payDate,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=3) sendDate,
                                    (select of.actionDate from t_orders_flow of where of.ordersId=t1.id and of.status=7) receiveDate,
                                    t1.totalAmount,t1.identifier,t1.sumMoney
                                from t_orders_list t1
                                LEFT JOIN t_orders_goods_info t2 on t1.id=t2.ordersId
                                LEFT JOIN t_goods_list t3 on t2.goodsId=t3.id
                                LEFT JOIN t_base_enterprise_info t4 on t4.id=t3.providerId
                                LEFT JOIN t_orders_receiving_address t5 on t5.ordersId=t1.id
                                LEFT JOIN t_ems_list t6 on t6.id=t1.emsId
                                LEFT JOIN t_orders_flow t7 on t1.id=t7.ordersId
                                where t1.id IN (".$ids.")  group by t1.id");
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']['list']   = $data;
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data']   = 'No Data';
    }
    return $this->result;
  }

  //根据订单ID查询订单中的商品
   public function getOrderGoodsIdByOrdersId($param){
    if(!empty($param['id'])){
      $data = $this->db->select("select b.goodsName,func_getNormsValueByNormsValueId(a.normsValueId) normsValue,a.buyNum,a.transactionPrice as unitPrice,
                                (a.transactionPrice * a.buyNum) AS shouldPay, c.isActivity,c.identifier, c.totalAmount,c.sumMoney,(select of.actionDate from t_orders_flow of where of.ordersId=c.id and of.status=2 ORDER BY of.id limit 1) payDate
                                from t_orders_goods_info a
                                LEFT JOIN t_orders_list c on a.ordersId = c.id
                                LEFT JOIN t_goods_list b on b.id=a.goodsId
                                where a.ordersId=".$param['id']);
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']['list'] = $data;
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }

  public function confirmSendGoods($param){

    if(!empty($param['emsName'])){
      $param_update['emsName'] = $param['emsName'];
    }
    if(!empty($param['emsNo'])){
      $param_update['emsNo'] = $param['emsNo'];
    }
    if(!empty($param['emsId'])){
      $param_update['emsId'] = $param['emsId'];
    }
    if(!empty($param['leaveWords'])){
      $param_update['leaveWords'] = $param['leaveWords'];
    }
    $param_update['status'] = 3;

    if(!empty($param['id'])){
      $where['where']['id'] = $param['id'];
    }
    if(!empty($param['id'])){
      $data = $this->db->update($this->table_list, $param_update, $where);
      $param_insert = array(
        'ordersId' => $param['id'],
        'status' => 3, 
        'actionUser' => $param['user'],
        'actionDate' => date('Y-m-d H:i:s'),
        'actionUserType' => 1
      );
      $this->db->insert($this->table_flow, $param_insert);
    }

    if($data!==false)
    {
      $this->result['status'] = 1;
      $this->result['data']   = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data']   = 'No Data';
    }
    return $this->result;
  }

  public function confirmAllSendGoods($param){

    if(!empty($param['sends'])){
      $sends = json_decode($param['sends']);
      if(count($sends)>0){
        foreach ($sends as $key => $value) {
          $value = $this->objarray_to_array($value);
          if(!empty($value['emsName'])){
            $param_update['emsName'] = $value['emsName'];
          }
          if(!empty($value['emsNo'])){
            $param_update['emsNo'] = $value['emsNo'];
          }
          if(!empty($value['emsId'])){
            $param_update['emsId'] = $value['emsId'];
          }
          if(!empty($value['leaveWords'])){
            $param_update['leaveWords'] = $value['leaveWords'];
          }
          $param_update['status'] = 3;

          if(!empty($value['id'])){
            $where['where']['id'] = $value['id'];
            $data = $this->db->update($this->table_list, $param_update, $where);
            $param_insert = array(
              'ordersId' => $value['id'],
              'status' => 3, 
              'actionUser' => $param['user'],
              'actionDate' => date('Y-m-d H:i:s'),
              'actionUserType' => 1
            );
            $this->db->insert($this->table_flow, $param_insert);
          }
        }
      }
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data']   = $data[0];
    }
    else
    {
      $this->result['status'] = 1;
      $this->result['data']   = 'No Data';
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

    public function updateChangeInfo($param){
        if(!empty($param['emsName'])){
          $param_update['emsName'] = $param['emsName'];
        }
        if(!empty($param['emsNo'])){
          $param_update['emsNo'] = $param['emsNo'];
        }
        if(!empty($param['emsId'])){
          $param_update['emsId'] = $param['emsId'];
        }
        if(!empty($param['leaveWords'])){
          $param_update['leaveWords'] = $param['leaveWords'];
        }
        
        if(!empty($param['id'])){
          $where['where']['id'] = $param['id'];
        }
        if(!empty($param['id'])){
          $data = $this->db->update($this->table_list, $param_update, $where);
        }

        if(!empty($data))
        {
          $this->result['status'] = 1;
          $this->result['data']   = $data[0];
        }
        else
        {
          $this->result['status'] = 0;
          $this->result['data']   = 'No Data';
        }
        return $this->result;
    }

    public function umengInfoKey($param){
      $where['where']['id'] = $param;
      $resp = $this->db->select('t_member_customer','deviceToken,deviceType',$where);
      if($resp){
        $this->result['status'] = 1;
        $this->result['data']   = $resp[0];
      }else{
        $this->result['status'] = 1;
        $this->result['data']   = 'No Data';
      }
      return $this->result;
    }
}