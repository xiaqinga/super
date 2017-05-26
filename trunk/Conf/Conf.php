<?php

/**
 * 应用配置
 * @author  janhve@163.com
 * @since   2015-04-07
 * @version 1.0
 */

/*
 *  应用基本配置
 */
//application名称
define("APP_NAME", '创客空间管理平台');

//application version
define("APP_VERSION", 'V2.8.0');

//copyright
define("APP_COPYRIGHT", '创客空间管理平台');

//index title
define("INDEX_TITLE", '创客空间管理平台');

//keyword
define("APP_KEYWORD", '创客空间管理平台');

//description
define("APP_DESCRIPTION", '创客空间管理平台');


/*
 *  应用系统配置
<<<<<<< .mine
 */
//项目入口地址
define("APP_URL", 'http://www.markersuper.com/index.php/');


//用户认证令牌KEY
define("USER_AUTH_KEY", 'schoolmaker_auth_passed');

//默认认证网关
define("USER_AUTH_GATEWAY", 'auth/login');


//资源地址
define("WWW_RES_URL", 'http://www.markersuper.com/');


//assets地址
define("ASSETS_URL", 'http://www.markersuper.com/assets/default/');


//运行环境,development:开发;production:生产
define("ENVIRONMENT", 'development');

//content类型,支持html,json
define("CONTENT_TYPE", 'html');

//content编码
define("CONTENT_CHARSET", 'UTF-8');

//header cache
define("CACHE_CONTROL", 'private');

//默认时区,北京时区可用Asia/Shang,Asia/Chongqing,Etc/GMT+8,PRC中任意一种
define("DEFAULT_TIMEZONE", 'PRC');

//默认主题.配置当前应用视图所在目录的目录名称
define("DEFAULT_THEME", 'default');

//默认启动的控制器
define("DEFAULT_CONTROLLER", 'index');

//模块默认调用的方法
define("DEFAULT_METHOD", 'index');

//默认加密关键字
define("ENCRYPTION_KEY", "S#L28!Y5m)9A$3|I");

//是否开启全局XSS过滤(GET, POST or COOKIE)
define("GLOBAL_XSS_FILTERING", false);

//内部接口调用
define("ACCESS_TOKEN", '123');


// define("DB_PREFIX" , 't_');

/*//Database类型
	define("DB_TYPE" , 'Mysql');
	//Database主机地址
	define("DB_HOST" , 'rds0c3k2pp7878k462wio.mysql.rds.aliyuncs.com');
	//Database主机端口
	define("DB_PORT" , '3306');
	//Database名称
	define("DB_NAME" , 'sayimo_maker');
	//Database用户名
	define("DB_USER" , 'school_test');
	//Database密码
	define("DB_PWD" , 'School_Db_20160802_Test');
	//Database编码
	define("DB_CHARSET" , 'utf8');
	//是否自动启用Database
	define("DB_AUTO_ON" , TRUE);
	//Database表前缀
	define("DB_PREFIX" , 't_');*/
//Database类型
define("DB_TYPE", 'Mysql');
//Database主机地址
define("DB_HOST", '192.168.0.204');
//Database主机端口
define("DB_PORT", '3306');
//Database名称
define("DB_NAME", 'sayimo_maker');
//Database用户名
define("DB_USER", 'sayimo_school');
//Database密码
define("DB_PWD", 'sayimo@DB');
//Database编码
define("DB_CHARSET", 'utf8');
//是否自动启用Database
define("DB_AUTO_ON", true);
//Database表前缀
define("DB_PREFIX", 't_');

/*
 *  Redis 配置
 */
//Redis主机地址
define("REDIS_HOST", '127.0.0.1');
//Redis端口
define("REDIS_PORT", '6379');
//Redis密码
define("REDIS_PASSWORD", null);
//Redis key前缀
define("OPT_KEY_PREFIX", '$REDIS_CACHE_PROD_MAKER_');
//是否自动启用Redis
define("REDIS_AUTO_ON", false);
//Redis缓存有效时长，单位：秒
define("REDIS_CACHE_TIME", 600);

//首页模板Redis缓存KEY
define("GOODSINDEX_KEY", OPT_KEY_PREFIX . '$GOODSINDEX_');
define("GOODSINDEX_GOODS", OPT_KEY_PREFIX . '$GOODSCLASS_');
define("GOODSINDEX_PROVIDER", OPT_KEY_PREFIX . '$CLASSIDS_');
define("GOODSCLASS_CACHE", OPT_KEY_PREFIX . '$GOODSCLASS_');

/*
 *  Session 配置
 */
//session 存储方式(default,mysql,redis)
define("SESSION_STORER_TYPE", 'default');
//cookie 名称
define("SESSION_COOKIE_NAME", 'PHPSESSID');
//session 过期时间，单位：秒
define("SESSION_EXPIRATION", '7200');
//关闭浏览器时session是否自动过期
define("SESSION_EXPIRE_ON_CLOSE", true);
//是否加密cookie数据
define("SESSION_ENCRYPT_COOKIE", true);
//是否启用数据库保存session数据
define("SESSION_USE_DATABASE", false);
//当启用数据库保存数据时，session数据保存所在的数据表名称
define("SESSION_TABLE_NAME", 't_bug_session');
//计算session时是否匹配IP
define("SESSION_MATCH_IP", false);
//计算session时是否匹配useragent
define("SESSION_MATCH_USERAGENT", false);
//刷新session数据的时间周期,单位：秒
define("SESSION_TIME_TO_UPDATE", 300);
/*
 * 友盟设置
 */
define("UMENG_IOS_APP_KEY", "58bcba74a325112467000598");             //ios key  secret
define("UMENG_IOS_SECRET", "kzifrbn7iupoltfrczgtusxd8y2lb0kd");
define("UMENG_ANDROID_APP_KEY", "58ad478d82b6356ccc000e0e");         //android key secret    
define("UMENG_ANDROID_SECRET", "ulvybkmfoghsam9gyxszssoobbergcrh");


define("UMENG_ANDROID_TICEKER", "哈哈");
define("UMENG_ANDROID_TITLE", "你妹没");         //android key secret    
define("UMENG_ANDROID_TEXT", "哈哈哈");
define("UMENG_IOS_TEXT", "哈哈哈");


/*
 * 微信设置
 */
define("APPID", "wx97b6917b6e39cb25");
define("APPSECRET", "c0b89490351120d32f121d8ece521c79");

/*
 * 上传图片服务器
 */
define("RES_SER", "http://testapi.sayimo.cn/makerapi/base/uploadfilebackurl");

/*
 * 图片服务器
 */
define("RES_SER_URL", "http://testapi.sayimo.cn/img");

/*
 * 商品列表图片保存目录/浏览目录
 */
define("GOODSLISTIMGPATH", "cy_files/goodslist");
define("GOODSLISTIMGURL", "cy_goodslist");

/*
 * 商品图片保存目录/浏览目录
 */
define("GOODSIMGPATH", "cy_files/goods");
define("GOODSIMGURL", "cy_goods");

/*
 * 编辑器图片保存目录/浏览目录
 */
define("EDITORIMGPATH", "cy_files/editor");
define("EDITORIMGURL", "cy_editor");

/*
 * 其他图片保存目录/浏览目录
 */
define("OTHERIMGPATH", "cy_files/other");
define("OTHERIMGURL", "cy_other");

/*
 * 上传文件服务器
 */

define("FILE_SER", "http://testapi.sayimo.cn/schoolapi/base/uploadfile");
define("IMAGE_FILE_SER", "https://ggschool.sayimo.cn/schoolmaker/base/uploadnewfile");
/*define("IMAGE_FILE_SER", "http://120.77.42.50/php/controller.php?action=uploadimage");*/
//音频资源保存目录/浏览目录
define("AUDIOPATH", "cy_files/audio");
define("AUDIOURL", "cy_audio");

//音频资源地址
define("AUDIO_RES_URL", 'http://schollsuper/cy_audio/');

/*
 * App编辑基本配置
 */
define("APPNAME", "彩虹梦客人才");
define("APPSIGN", "com.shangyi.supplier");
define("APPICONURL", "http://sayimo.cn/img/ShangYi_logo.png");
define("APPPATH", "cy_files/app");
define("APPURL", "cy_app");

//define("SCHOOLAPI",'http://testapi.sayimo.cn/makerapi/');


