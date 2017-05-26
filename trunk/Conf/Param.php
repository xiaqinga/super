<?php

/**
 * 合法参数表
 * 已在表中定义的参数，才会被系统处理，其他非定义参数均自动过滤
 * 
 * @author janhve@163.com
 * @date   2015-04-15
 * @version 1.0
 */

/*
 *  有效参数配置，区分int,string及bool类型
 */
$in_request_param = array(
	'int'    => array(
		'id',
		'uuid',
		'cid',
		'mid',
		'orders',
		'status',
		'starttime',
		'endtime',
		'createID',
		'createtime',
		'updateID',
		'updatetime',
		'pid',
		'limit',
		'offset',
		'total',
		'remember',
		'is_booking'
	),
	'string' => array(
		'access_token',
		'username',
		'password',
		'mobphone',
		'account',
		'account_type',
		'verifycode',
		'timestamp',
		'time',
		'name',
		'merchant',
		'province',
		'city',
		'area',
		'street',
		'address',
		'phone',
		'descript',
		'promise',
		'opt',
		'mark',
		'price',
		'consumeno',
		'orderno',
		'verify',
		'tel',
		'email',
		'catename',
		'icon',
		'imgurl',
		'banner',
		'content',
		'free_time',
		'booking_time',
		'detail',
		'notice',
		'orders',
		'title',
		'keyword',
		'newpassword',
		'start_hour',
		'start_minute',
		'end_hour',
		'end_minute',
		'lat',
		'lng',
		'photo',
		'gender',
		'skill'
	),
	'bool'   => array(),
	'array'  => array(
		'menuIds',
		'rightIds',
		'areaCodeListKey',
		'classIds',
		'pickType',
		's_vals',
		'f_vals',
	)
);

define("IN_REQUEST_PARAM", serialize($in_request_param));
/**
 * 企业行业列表
 */
$industry_list=array();
$industry_list['01']='计算机软件';
$industry_list['37']='计算机硬件';
$industry_list['38']='计算机服务(系统、数据服务，维修)';
$industry_list['31']='通信/电信/网络设备';
$industry_list['39']='通信/电信运营、增值服务';
$industry_list['32']='互联网/电子商务';
$industry_list['40']='网络游戏';
$industry_list['02']='电子技术/半导体/集成电路';
$industry_list['35']='仪器仪表/工业自动化';
$industry_list['41']='会计/审计';
$industry_list['03']='金融/投资/证券';
$industry_list['42']='银行';
$industry_list['43']='保险';
$industry_list['04']='贸易/进出口';
$industry_list['22']='批发/零售';
$industry_list['05']='快速消费品(食品,饮料,化妆品)';
$industry_list['06']='服装/纺织/皮革';
$industry_list['44']='家具/家电/工艺品/玩具';
$industry_list['45']='办公用品及设备';
$industry_list['14']='机械/设备/重工';
$industry_list['33']='汽车及零配件';
$industry_list['08']='制药/生物工程';
$industry_list['46']='医疗/护理/保健/卫生';
$industry_list['47']='医疗设备/器械';
$industry_list['12']='广告';
$industry_list['48']='公关/市场推广/会展';
$industry_list['49']='影视/媒体/艺术';
$industry_list['13']='文字媒体/出版';
$industry_list['15']='印刷/包装/造纸';
$industry_list['26']='房地产开发';
$industry_list['09']='建筑与工程';
$industry_list['50']='家居/室内设计/装潢';
$industry_list['51']='物业管理/商业中心';
$industry_list['34']='中介服务';
$industry_list['07']='专业服务(咨询，人力资源)';
$industry_list['52']='检测，认证';
$industry_list['18']='法律';
$industry_list['23']='教育/培训';
$industry_list['24']='学术/科研';
$industry_list['11']='餐饮业';
$industry_list['53']='酒店/旅游';
$industry_list['17']='娱乐/休闲/体育';
$industry_list['54']='美容/保健';
$industry_list['27']='生活服务';
$industry_list['21']='交通/运输/物流';
$industry_list['55']='航天/航空';
$industry_list['19']='石油/化工/矿产/地质';
$industry_list['16']='采掘业/冶炼';
$industry_list['36']='电力/水利';
$industry_list['56']='原材料和加工';
$industry_list['28']='政府';
$industry_list['57']='非盈利机构';
$industry_list['20']='环保';
$industry_list['29']='农业/渔业/林业';
$industry_list['58']='多元化业务集团公司';
$industry_list['30']='其他行业';
/*
 *  系统公共数据词典
 */
$public_dict = array(
	'gender' => array(0=>'保密',1=>'男',2=>'女'),
	'menu_status' => array(0=>'关闭',1=>'开启'),
	'order_status' => array(
		'1'=>'待支付',
		'2'=>'待发货',
		'3'=>'已发货',
		'4'=>'退货中',
		'5'=>'换货中',
		'6'=>'处理中',
		'7'=>'已收货',
		'8'=>'已退货',
		'-1'=>'已取消'
	),
	'logisticsType' => array(
		'1'=>'快递',
		'2'=>'物流'
	),
	'industry_list' => $industry_list,
	'mass_type'=>array(
		1=>'全体APP用户'
	),
	'providerTypes'=>array(
		1=>'供应商',
		2=>'联盟商'
	),
	'awardRule_list'=>array(
		'3'=>'无',
		'1'=>'现金奖励',
		'2'=>'提成奖励'
	),
	'customerTypelist'=>array(
		'0'=>'请选择',
		'1'=>'普通会员',
		'2'=>'金星创客',
		'3'=>'银星创客',
		'4'=>'供应商',
		'5'=>'联盟商',
	),
	'mallTypes'=>array(
		'1'=>'金商城',
		'2'=>'银商城',
		'3'=>'全返商城',
		'4'=>'商企商品'
	
	),
	'fromTypes'=>array(
		'1'=>'银行卡支付',
		'2'=>'钱包支付（现金）',
		'3'=>'钱包支付（银积分）',
		'4'=>'微信支付',
		'5'=>'支付宝支付',
		'6'=>'系统退款',
		'7'=>'系统返现'
	),
	'orderTypes'=>array(
		'0'=>'代表普通订单',
		'1'=>'代表预约订单',
		'2'=>'代表课程订单',
		'3'=>'充值银积分',
		'4'=>'申请创客',
		'5'=>'扫描联盟商二维码',
		'6'=>'佣金收入',
		'7'=>'现金提现'
	),
	'shopClass'=>array(
		'1'=>'餐饮美食',
		'2'=>'酒店住宿',
		'3'=>'休息娱乐',
		'4'=>'美容美发',
		'5'=>'其他'
	),
	'transferType'=>array(
		'0'=>'全部类型',
		'1'=>'供应商',
		'2'=>'联盟商',
		'3'=>'个人',
		
	),
	'schoolNewsStatus'=>array(
	      '0'=>'禁用',
		  '1'=>'启用',
	),
	'orderStatusList'=>array(
		1 => '待支付',
		2 => '待发货',
		3 => '已发货',
		4 => '待退款',
		5 => '已退款',
		6 => '待评论',
		7 => '已收货',
		-1 => '已取消',
		8 => '已退货'
	),
	'info_type'=>array(
		'1'=>'供应商',
		'2'=>'联盟商',
		'3'=>'个人'

	)


);
define("PUBLIC_DICT", serialize($public_dict));
