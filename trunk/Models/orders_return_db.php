<?php

/**
 * 退换货模型
 *
 * @author wsbnet@qq.com
 * @since   2016-08-23
 * @version 1.0
 */
 
class orders_return_db{
	//Db
	private $db = NULL;
	//database table
	private $table = 'v_orders_return';
  private $table_list = "order_return_ref";
	//数据结果
	private $result = array('status'=>0,'data'=>NULL);
	
	/**
	 * 初始化
	 */
	public function __construct(&$db){
		$this->db = $db;
		$this->table = 'v_orders_return';
    $this->table_list = DB_PREFIX.'order_return_ref';
	}
	
  //获取所有
  public function getlist($param){
    $where = '1 ';

    if(!empty($param['statuses'])){
      $where .= " and v.status IN (".$param['statuses'].") ";
    }

    if(!empty($param['ordersNo'])){
      $where .= " and v.ordersNo = ".$param['ordersNo'];
    }

    if(!empty($param['goodsName'])){
      $where .= " and v.goodsName LIKE '%".$param['goodsName']."%' ";
    }

    if(!empty($param['providerName'])){
      $where .= " and v.providerName LIKE '%".$param['providerName']."%' ";
    }
    
    if(!empty($param['providerId'])){
      $where .= " and v.providerId = ".$param['providerId'];
    }

    if(!empty($param['memberAlias'])){
      $where .= " and v.alias = ".$param['memberAlias'];
    }

    $total = $this->db->total($this->table.' v ', $where);
    $this->result['data']['total'] = $total;

    $where .= " ORDER BY v.id DESC ";
    if( isset($param['limit']) )
    {
      $where .= " limit ".$param['limit']." ";
    }
    $data  = $this->db->select($this->table.' v ', 'v.*', $where);

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
      $where['where']['v.id'] = $param['id'];
      $data = $this->db->select($this->table.' v LEFT JOIN t_order_return_check t1 ON v.id = t1.returnRefId LEFT JOIN t_order_return_mode t2 ON v.id = t2.returnRefId LEFT JOIN t_base_area t3 ON v.areaCode = t3.code LEFT JOIN t_base_city t4 ON t3.cityCode = t4.code LEFT JOIN t_base_province t5 ON t4.provinceCode = t5.code', ' v.*, t1.status checkStatus,t1.auditExplain,t2.emsId,t2.emsName,t2.emsNo,t2.type orderReturnModeType,t3.name areaName,t4.name cityName,t5.name provinceName', $where);
    }

    if(!empty($data))
    {
      $data[0]['address'] = $data[0]['provinceName'].$data[0]['cityName'].$data[0]['areaName'].$data[0]['address'];
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

   public function getOrderReturnById($param){
    if(!empty($param['id'])){
      $where['where']['id'] = $param['id'];
      $data = $this->db->select('t_order_return_ref','id, orderNo, orderId, `status`, applyExplain, photoIds, createTime, customerId, type, totalMoeny, newOrderId, returnGoodsNum, goodsId, normsValueId,transactionPrice', $where);
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
      $data = $this->db->select("select t1.id,t1.ordersNo,t1.payMode,t1.EMSNo,t1.leaveWords,t1.createDate,t1.isActivity,t2.logistcsCost,t4.providerName,
                                    t4.linkman,t4.mobilePhone as linkInfo,t5.receivingPeople as receivePeople,t5.telePhone as receivePeopleTelePhone,t5.address,t6.emsName,
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
                                (a.transactionPrice * a.buyNum) AS shouldPay, c.isActivity,c.identifier, c.totalAmount,c.sumMoney
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
    $param_update['status'] = 3;

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

  public function confirmAllSendGoods($param){

    if(!empty($param['sends'])){
      $sends = json_decode($param['sends']);
      if(count($sends)>0){
        foreach ($sends as $key => $value) {
          $value = $this->objarray_to_array($value);
          if(!empty($param['emsName'])){
            $param_update['emsName'] = $value['emsName'];
          }
          if(!empty($param['emsNo'])){
            $param_update['emsNo'] = $value['emsNo'];
          }
          if(!empty($param['emsId'])){
            $param_update['emsId'] = $value['emsId'];
          }
          $param_update['status'] = 3;

          if(!empty($value['id'])){
            $where['where']['id'] = $value['id'];
            $data = $this->db->update($this->table_list, $param_update, $where);
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

    // 根据商品Id查询商品的规格、库存、价格
   public function selectGoodsNormsValueStockGoodsId($param){
    if(!empty($param['id'])){
      $data = $this->db->select("SELECT a.id,a.goodsId,a.goodsNormsValueId,a.stockId,a.originalPrice,a.preferentialPrice,a.restockPrice,b.stockNum as stockNum, c.normsValueIds,a.weight
                                FROM t_goods_normsvalue_stock a join t_goods_norms_stock b on b.id=a.stockId
                                join t_goods_norms_values_ref c on a.goodsNormsValueId = c.id
                                WHERE a.status>0 and a.goodsId = ".$param['id']);
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

    //换货商品
   public function getNormsValueStockByMap($param){
    if(!empty($param['goodsId']) && !empty($param['goodsNormsValueId'])){

      $data = $this->db->select("SELECT t2.id, t1.sendAddress,t2.originalPrice,t2.preferentialPrice,t3.normsValueIds,t2.stockId FROM t_goods_list t1, t_goods_normsvalue_stock t2, t_goods_norms_values_ref t3 WHERE t1.id = t2.goodsId AND t2.goodsNormsValueId = t3.id AND t1.id = ".$param['goodsId']." AND t2.goodsNormsValueId = ".$param['goodsNormsValueId']);

    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data'] = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }

  public function queryOrdersNormsInfoById($param){
    if(!empty($param['ordersId'])){
      $data = $this->db->select("select t1.id ordersId, t1.ordersNo, t1.sumMoney, t1.totalAmount, t2.* from t_orders_list t1, t_orders_goods_info t2 where t1.id = t2.ordersId and t1.id = ".$param['ordersId']." and t2.status = 1");
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data'] = $data;
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }

  public function insertOrderReturnCheck($param){
    $ret = $this->db->insert('t_order_return_check', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function insertReturnFlow($param){
    $ret = $this->db->insert('t_order_return_flow', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function updateOrderReturnRef($param){
    $ret = $this->db->update('t_order_return_ref', $param['field'], $param['where']);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function updateOrderGoodsInfo($param){
    $ret = $this->db->update('t_orders_goods_info', $param['field'], $param['where']);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function updateOrdersById($param){
    $ret = $this->db->update('t_orders_list', $param['field'], $param['where']);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function insertOrdersFlow($param){
    $ret = $this->db->insert('t_orders_flow', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function insertIncomeExpendRecord($param){
    $ret = $this->db->insert('t_member_wallet_income_expend_record', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function updateWallet($param){
    $ret = $this->db->update("UPDATE t_member_wallet SET remainingMoney = remainingMoney+".$param['remainingMoney'].", availableMoney = availableMoney+".$param['availableMoney']." where customerId = ".$param['customerId']);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function selectGoodsNormsStock($param){
    if(!empty($param['stockId'])){
      $data = $this->db->select("SELECT id,stockNum FROM t_goods_norms_stock  WHERE  id=".$param['stockId']);
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data'] = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }

  public function updateGoodsNormsStock($param){
    $ret = $this->db->update('t_goods_norms_stock', $param['field'], $param['where']);
    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }
  
  public function insertOrdersList($param){
    $ret = $this->db->insert('t_orders_list', $param);
    $param['id'] = $this->db->last_id();

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function insertOrdersGoodsInfo($param){
    $ret = $this->db->insert('t_orders_goods_info', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }

  public function insertOrdersReceivingAddress($param){
    $ret = $this->db->insert('t_orders_receiving_address', $param);

    if($ret){
      $this->result['status'] = 1;
      $this->result['data']   = $param;
    }
    else{
      $this->result['status'] = 0;
      $this->result['data']   = '';
    }
    return $this->result;
  }
  
  public function queryReceivingAddressByOrdersId($param){
    if(!empty($param['ordersId'])){
      $data = $this->db->select("SELECT * FROM t_orders_receiving_address WHERE ordersId =".$param['ordersId']);
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data'] = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }

  public function queryOrderById($param){
    if(!empty($param['id'])){
      $data = $this->db->select("select * from t_orders_list where id = ".$param['id']);
    }

    if(!empty($data))
    {
      $this->result['status'] = 1;
      $this->result['data'] = $data[0];
    }
    else
    {
      $this->result['status'] = 0;
      $this->result['data'] = 'No Data';
    }
    return $this->result;
  }
}