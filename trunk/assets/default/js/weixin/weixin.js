    /**
     * 微信上传图片
     * ------------------------------------------------------------------
     * 模块描述说明:调用微信上传接口
     * ------------------------------------------------------------------
     * @param {string} flag 请求结果:以标记来的参数调用函数
     * @param {string} targetUrl 提交URL
     * @param {json} json 回传json
     * @returns callbackfun()回调函数定义在触发页面
     *
     * @date 2016-07-26
     * @author wsbnet@QQ.com>
    **/
    var wxUplodModule = (function(duplication) {
        var _private = '';//private variable here
        var duplication = {};
        /*上传照片开始*/
        var avtivity_img_db = new Array(); //上传图片数组
        var xhr;
        var _flag //接收标记;

        /**
         * http请求开始
         * -------------------------------
        */
        duplication.createXMLHttpRequest = function() {
            if(window.ActiveXObject){
              xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }else if(window.XMLHttpRequest){
              xhr = new XMLHttpRequest();
            }
        };

        /**
         * http请求结果
         * -------------------------------
        */
        duplication.handleStateChange = function() {
          if(xhr.readyState == 4 ){
              if (xhr.status == 200 || xhr.status == 0){
                  var result = xhr.responseText;
                  var json = eval("(" + result + ")");
                  if(parseInt(json.status)==0){
                    $.alert('错误:'+json.msg);
                  }else if (parseInt(json.status)==1){
                    $(".edui-close").trigger("click");
                    callbackfun(_flag,json);
                  }
              }
          }
        };


        /**
         * 触发上传
         * -------------------------------
        */
        duplication.uploadFile = function(flag, targetUrl) {
          $.alert("正在上传中...请稍等...");
          var fileObj = document.getElementById("uploadBinput").files;
          var FileController = targetUrl;
          var form = new FormData();//新建上传组件 form
          if(fileObj.length > 3 || avtivity_img_db.length >= 3){
              alert("最多只能上传三张照片！");
              return;
          }
          for (var i in fileObj) {
              form.append(i, fileObj[i]);//新建上传组件 mfile
          }
          _flag = flag;
          wxUplodModule.createXMLHttpRequest();
          xhr.onreadystatechange = wxUplodModule.handleStateChange;
          xhr.open("post", FileController, true);
          xhr.send(form);
        };

        return duplication;//return the public variable
    } (wxUplodModule || {}));


