//初始化后台对象
var backend = {}; 

/**
 * 通用函数[comomn]模块
 * ------------------------------------------------------------------
 * 模块描述说明:通用函数
 * ------------------------------------------------------------------
 * @param {string} 
 * @param {object} 
 * @returns void
 *
 * @date 2016-08-6
 * @author 303232810@QQ.com>
**/
backend.comomn = (function(duplication) {
    var _private = '';//private variable here
    var duplication = {};

    /**
     * 过滤字符串, 确保json格式正确
     * -------------------------------
    */
    duplication.save_json = function(str) {
        if(str!='' && str!=undefined){
            if(str.indexOf('nbsp')>-1){
                str = str.replace(/nbsp/g,"");
            }
            if(str.indexOf('\;')>-1){
                str = str.replace(/\;/g,"");
            }
            if(str.indexOf('\&')>-1){
                str = str.replace(/\&/g,"");
            }
            if(str.indexOf('\"')>-1){
                str = str.replace(/\"/g,"");
            } 
            if(str.indexOf('\:')>-1){
                str = str.replace(/\:/g,"");
            }
            if(str.indexOf('\[')>-1){
                str = str.replace(/\[/g,"");
            }
            if(str.indexOf('\]')>-1){
                str = str.replace(/\]/g,"");
            }
            if(str.indexOf('\{')>-1){
                str = str.replace(/\{/g,"");
            }
            if(str.indexOf('\}')>-1){
                str = str.replace(/\}/g,"");
            }
            str=str.replace(/<\/?[^>]*>/gim,"");//去掉所有的html标记
            str=str.replace(/(^\s+)|(\s+$)/g,"");//去掉前后空格
            str=str.replace(/\s/g,"");//去除中间空格
            return str;
        }else{
            return '';
        }
    };

    duplication.objectLength = function(o){  
       var n, count = 0;  
       for(n in o){  
          if(o.hasOwnProperty(n)){  
             count++;  
          }  
       }  
       return count;  
    }

    return duplication;//return the public variable
} (backend.comomn || {}));


/**
 * 添加规格值[norms]模块
 * ------------------------------------------------------------------
 * 模块描述说明:点击添加按钮,增加input
 * ------------------------------------------------------------------
 * @param {string} val:传入的规格值
 * @param {inter} sort:排序 normsValueId:规格ID
 * @param {object} norms模块
 * @returns void
 *
 * @date 2016-08-6
 * @author 303232810@QQ.com>
**/
backend.norms = (function(duplication) {
    var _private = '';//private variable here
    var duplication = {};

    /**
     * 初始化图片src值, 隐藏域值
     * -------------------------------
    */
    duplication.add_value = function(val, sort, normsValueId) {
        if(typeof(val)=="undefined") val='';
        if(typeof(sort)=="undefined") sort=0;
        if(typeof(normsValueId)=="undefined") normsValueId=0;

        var id = $("#id").val();
        if(!parseInt(id)){
            $.alert('请先保存再添加');
            return;
        }
        var wraper = document.querySelector(".js_input_wraper");

        //创建div
        var div=document.createElement("div");
        //创建div class属性
        var att=document.createAttribute("class");
        att.value="key-list";
        div.setAttributeNode(att);

        //创建div data_id属性
        var att=document.createAttribute("data_id");
        att.value=normsValueId;
        div.setAttributeNode(att);

        //创建span
        var span=document.createElement("i");
        //创建span class属性
        var att=document.createAttribute("class");
        att.value="sui-icon icon-remove-sign key-btn-close";
        span.setAttributeNode(att);
        //创建span onclick属性
        var att=document.createAttribute("onclick");
        att.value="backend.norms.close(this.parentNode);";
        span.setAttributeNode(att);

        //创建input
        var input=document.createElement("input");

        //添加type属性
        var att=document.createAttribute("type");
        att.value="text";
        input.setAttributeNode(att);

        //添加class属性
        var att=document.createAttribute("class");
        att.value="input-large input-fat key_value";
        input.setAttributeNode(att);

        //添加placeholder属性
        var att=document.createAttribute("placeholder");
        att.value="输入规格值";
        input.setAttributeNode(att);

        //添加title属性
        var att=document.createAttribute("title");
        att.value="输入规格值";
        input.setAttributeNode(att);

        //添加value属性
        var att=document.createAttribute("value");
        att.value=val;
        input.setAttributeNode(att);

        //创建排序input
        var input_s=document.createElement("input");

        //添加type属性
        var att=document.createAttribute("type");
        att.value="number";
        input_s.setAttributeNode(att);

        //添加class属性
        var att=document.createAttribute("class");
        att.value="input-medium input-fat key_sort";
        input_s.setAttributeNode(att);

        //添加placeholder属性
        var att=document.createAttribute("placeholder");
        att.value="输入排序";
        input_s.setAttributeNode(att);

        //添加title属性
        var att=document.createAttribute("title");
        att.value="输入排序";
        input_s.setAttributeNode(att);

        //添加value属性
        var att=document.createAttribute("value");
        att.value=sort;
        input_s.setAttributeNode(att);

        div.appendChild(input);
        div.appendChild(input_s);
        div.appendChild(span);
        wraper.appendChild(div);

    };

    /**
     * 关闭规格值
     * -------------------------------
    */
    duplication.close = function(o) {
        var wraper = document.querySelector(".js_input_wraper");
        wraper.removeChild(o);
    };

    return duplication;//return the public variable
} (backend.norms || {}));

/**
 * 图片移动和删除
 * ------------------------------------------------------------------
 * 模块描述说明:图片左右移动和删除
 * ------------------------------------------------------------------
 * @param {string} main_photos php后台json传入的对象
 * @returns void
 *
 * @date 2016-8-15
 * @author 303232810@QQ.com>
**/
backend.photo = (function(duplication) {
    var _private = '';//private variable here
    var duplication = {};

    /**
     * 左右移动通用函数
     * -------------------------------
    */

    duplication.mvcommon = function($d,$t) {
        items_length = parseInt(backend.comomn.objectLength(main_photos));
        index=$t.parent('.Js_item').index();
        index=parseInt(index)+1;
        old_o=$t.parent().children(".Js_img");
        if($d=='left'){
          if(index == 1){return false;}
          new_o=$t.parent().prev().children(".Js_img");
          new_index = parseInt($t.parent().prev().index())+1;
        }else if($d=='right'){
          if(index == items_length){return false;}
          new_o=$t.parent().next().children(".Js_img");
          new_index = parseInt($t.parent().next().index())+1;
        }

        old_src=old_o.attr('src');
        new_src=new_o.attr('src');
        old_o.attr('src',new_src);
        new_o.attr('src',old_src);

        //交换对象
        old_object =  main_photos[index];
        new_object =  main_photos[new_index];
        main_photos[index] = new_object;
        main_photos[new_index] = old_object;

        //console.log(main_photos);
        //console.log(index,new_index);
        //console.log(old_object, new_object);
        
        //按对象实际排序 displayOrder
        main_photos[index].displayOrder = index;
        main_photos[new_index].displayOrder = new_index;

    }

    /**
     * 触发左右移动事件
     * -------------------------------
    */
    duplication.mv = function() {

      $(".photo_main").on('click', '.Js_item .Js_move_left', function(){
        backend.photo.mvcommon('left',$(this));
      })

      $(".photo_main").on('click', '.Js_item .Js_move_right', function(){
        backend.photo.mvcommon('right',$(this));
      })
    };

    return duplication;//return the public variable
} (backend.photo || {}));


/**
 * 规格
 * ------------------------------------------------------------------
 * 模块描述说明:选择规格,生成规格值; 勾选规格,生成组合商品和删除规格值
 * ------------------------------------------------------------------
 * @param {string} 
 * @param {array} 
 * @returns void
 *
 * @date 2016-8-18
 * @author 303232810@QQ.com>
**/
var org_select_a_id=null; //规格1上一次选项ID
var org_select_b_id=null; //规格2上一次选项ID
var sizeItem = new Object();
    sizeItem.A = [];  // 规格1已勾选的值
    sizeItem.B = [];  // 规格2已勾选的值
    sizeItem.Cur = []; //当前(取消/勾选)的值
var Size = (function(duplication) {
    var _private = '';//private variable here

    var duplication = {};

    Array.prototype.remove=function(dx) //扩展数组原型
    { 
        if(isNaN(dx)||dx>this.length){return false;} 
        for(var i=0,n=0;i<this.length;i++) 
        { 
            if(this[i]!=this[dx]) 
            { 
                this[n++]=this[i] 
            } 
        }
        this.length-=1 
    } 

    /**
     * 点击规格选项, ajax获取规格值,生成列表值
     * -------------------------------
    */
    duplication.qq = function(dd){
        var ee = $(dd).val();
        // console.log($(dd).parent().parent().find("input[name='js_preferentialPrice']").val());
        var oo='';
        var isGiveScore=$("#isGiveScore").val();
        var aa;
        oo=$(dd).parent().parent().find("input[name='js_preferentialPrice']").val();
        if(1==isGiveScore){
            if(oo&&ee){
                aa= (ee/oo).toFixed(2);
            }
            if(aa<2||aa>5){
                // $(dd).val('');
                $(dd).parent().parent().find("input[name='js_originalPrice']").val('');
                $.alert('倍数范围值只能为2-5,例:销售价10元,进货价范围为2-5元（倍数=销售价/进货价)');
                return;
            }           
        }else{
            if(oo&&ee){
                hh= (oo/ee*100).toFixed(2);
                aa= 100-hh;
                if(aa>100||aa<0){
                    $(dd).parent().parent().find("input[name='js_originalPrice']").val('');
                    $.alert('折率范围值只能为0%-100%(折率=(1-进货价/销售价)*100%)');
                    return
                }

            }
        }
        $(dd).parent().parent().find("input[name='js_originalPrice']").val(aa);
    }
    duplication.zz = function(dd){
        var ee = $(dd).val();

        var oo = $(dd).parent().parent().find("input[name='js_restockPrice']").val();
        var aa;
        var isGiveScore=$("#isGiveScore").val();
        if(1==isGiveScore){
            
            if(oo&&ee){
                aa= (oo/ee).toFixed(2);
            }
            if(aa<2||aa>5){
                // $(dd).val('');
                $(dd).parent().parent().find("input[name='js_originalPrice']").val('');
                $.alert('倍数范围值只能为2-5,例:销售价10元,进货价范围为2-5元（倍数=销售价/进货价)');
                return;
            }
            $(dd).parent().parent().find("input[name='js_originalPrice']").val(aa);
        }else{
            if(oo&&ee){
                hh= (ee/oo*100).toFixed(2);
                aa=100-hh;
                if(aa>100||aa<0){
                    $(dd).parent().parent().find("input[name='js_originalPrice']").val('');
                    $.alert('折率范围值只能为0%-100%(折率=(1-进货价/销售价)*100%)');
                    return
                }

            }
            $(dd).parent().parent().find("input[name='js_originalPrice']").val(aa);
        }

        // $(dd).parent().parent().find("input[name='js_preferentialPrice']").val(aa);
    }

    duplication.get_size_attr = function(o,k) {
        if(o.classList.contains("disabled")){return false;}

        check_label = document.querySelectorAll("li.checkbox-item label.checkbox-pretty");

        for (var i = check_label.length - 1; i >= 0; i--) {
            check_label[i].classList.remove("checked");
        }
        check_input = document.querySelectorAll("li.checkbox-item label.checkbox-pretty input");

        for (var i = check_input.length - 1; i >= 0; i--) {
            check_input[i].checked=false;
        }
        sizeItem.A = [];  // 重设规格1已勾选的值
        sizeItem.B = [];  // 重设规格2已勾选的值
        sizeItem.Cur = []; //重设当前(取消/勾选)的值

        var idata = eval(o.getAttribute("data"));

        idata = idata[0];

        var org_th = document.getElementById("th_"+idata.size);  //列表头部DOM

        var ul = document.querySelectorAll('.js_attr_list');
        var btn_submit = document.querySelectorAll('.js_btn_submit');


        if(idata.size==1 ){
            org_select_a_id = true;
            $("#normsaId").val(idata.id);
        }
        if(idata.size==2 ){
            org_select_b_id = true;
            $("#normsbId").val(idata.id);
        }
        


        //当前选择规格1还是规格2
       /* if(idata.size==1 && idata.id >0 && !org_select_a_id){
            org_select_a_id = true;
            $("#normsaId").val(idata.id);
        }
        if(idata.size==2 && idata.id >0 && !org_select_b_id){
            org_select_b_id = true;
            $("#normsbId").val(idata.id);
        }*/
        //显示提交区域
        if(org_select_a_id || (org_select_a_id && org_select_b_id)){
            for (var i = btn_submit.length - 1; i >= 0; i--) {
                btn_submit[i].style.display="";
            }
        }
        ///隐藏提交区域
        if(idata.size==1 && idata.id ==0){
            for (var i = btn_submit.length - 1; i >= 0; i--) {
                btn_submit[i].style.display="none";
            }
        }

        if(!org_select_a_id){
            $.alert("规格一为必填项！");
            //重设规格
            var liall_opposite=document.querySelectorAll(".selectSizeA ul li");
            for (var i = liall_opposite.length - 1; i >= 0; i--) {
                liall_opposite[i].style.display="";
            }
            var liall_opposite=document.querySelectorAll(".selectSizeB ul li");
            for (var i = liall_opposite.length - 1; i >= 0; i--) {
                liall_opposite[i].style.display="";
            }

            setTimeout(function(){
                var sizebBodyLi = $("#selectSizeB ul li");
                var sizebtitle = $("#selectSizeB #citem_size_b");
                sizebtitle.attr('ids',sizebBodyLi.eq(0).attr('id'));
                sizebtitle.html(sizebBodyLi.eq(0).html());
            }, 300);
            return;
        }

        //规格1不同选择,删除组合规格的商品
        if(idata.size==1){
            if( idata.id!==org_select_a_id ){
                var org_tr = document.querySelectorAll('.js_sizes tr');
                var tbody = document.querySelector('.js_sizes');
                if(org_tr){
                    for (var i = org_tr.length - 1; i >= 0; i--) {
                        tbody.removeChild(org_tr[i]);
                    }
                }
                sizeItem.A = []; //不同的选择, 设置为空
            }else{
                return; //相同选择
            }

            //点击规格1选项
            if(idata.id==0 && idata.size==1) { 
                //删除标题栏
                if(org_th) thead.removeChild(org_th);
                //删除规格值
                var ul_child = ul[0].childNodes;
                if(ul_child){
                    for (var i = ul_child.length - 1; i >= 0; i--) {
                        ul[0].removeChild(ul_child[i]);
                    }
                }
                org_select_a_id = null; //标记上一次选项ID为空
                return;
            }
            org_select_a_id = idata.id; //标记上一次规格一选项ID

        }

        //规格2不同选择,删除组合规格的商品
        if(idata.size==2){
            if( idata.id!==org_select_b_id ){
                var org_tr = document.querySelectorAll('.js_sizes tr');
                var tbody = document.querySelector('.js_sizes');
                if(org_tr){
                    for (var i = org_tr.length - 1; i >= 0; i--) {
                        tbody.removeChild(org_tr[i]);
                    }
                }
                sizeItem.B = []; //不同的选择, 设置为空
            }else{
                return; //相同选择
            }
            org_select_b_id = idata.id; //标记上一次规格一选项ID

            //选择规格2选项首值
            if(idata.id==0 && idata.size==2) { 

                //删除标题栏
                if(org_th) thead.removeChild(org_th);
                //删除规格值
                var ul_child = ul[1].childNodes;
                if(ul_child){
                    for (var i = ul_child.length - 1; i >= 0; i--) {
                        ul[1].removeChild(ul_child[i]);
                    }
                }
                org_select_b_id = null; //标记上一次选项ID为空

                //生成规格1组合的商品
                if(org_select_a_id && !org_select_b_id){  //仅勾选选项1的值
                    for (var i = sizeItem.A.length - 1; i >= 0; i--) {
                        tr = document.createElement('tr'); 

                        var att=document.createAttribute("partgoods_id");
                        att.value=0;
                        tr.setAttributeNode(att);

                        att=document.createAttribute("normsvalue_a_add");
                        att.value=sizeItem.A[i].add;
                        tr.setAttributeNode(att);

                        att=document.createAttribute("norms_a");
                        att.value=sizeItem.A[i].id;
                        tr.setAttributeNode(att);

                        tr.classList.add("js_sizes_1_"+sizeItem.A[i].id+'_'+sizeItem.A[i].order+" normsvalue_a_add="+sizeItem.A[i].add);
                        tr.innerHTML =  '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.A[i].value+'</td>'+
                                        '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" type="text" value="" ></td>'+
                                        '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value=""></td>'+
                                        '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value=""></td>'+
                                        '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_originalPrice" type="text" value="" placeholder="2-5之间的数值"></td>'+
                                        '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" value=""></td>';
                        // <input min="0" class="input-medium js_originalPrice" type="text" value="">
                        tbody.appendChild(tr);
                    }
                }
                Size.delSizeItem(2,idata.id);
                return;
            }
        }
        $.ajax({
            type    : "post",
            async   : false,
            url     : OO._SRVPATH+'goods_list/sizeAttr',
            data    : "id=" + idata.id,
            dataType: 'json',
            success : function (data)
            {
                var fragment = document.createDocumentFragment();
                var li;
                var t=k;

                var thead_out = document.querySelector('.js_header');  //列表头部
                thead = document.querySelector('.js_header tr.thbk');  //列表头部
                var th = document.createElement('th'); 
                var text = document.createTextNode(idata.value);
                th.appendChild(text);
                var att_class=document.createAttribute("class");
                    att_class.value="center";
                var att=document.createAttribute("style");
                    att.value="";
                var att_id=document.createAttribute("id");
                    att_id.value="th_"+t;
                th.setAttributeNode(att_class);
                th.setAttributeNode(att);
                th.setAttributeNode(att_id);

                if(t==1){
                    for (n in data) {
                        li = document.createElement('li'); 
                        li.className = 'checkbox-item';
                        li.innerHTML =  '<label class="checkbox-pretty inline">'+
                                          '<input id="val_1_'+data[n].id+'_'+data[n].order+'" data='+'[{"size":"1","id":"'+data[n].id+'","value":"'+backend.comomn.save_json(data[n].value)+'","order":"'+data[n].order+'"}]'+' type="checkbox" onclick="Size.autoSizesGoods(this);"><span><input disabled id="val_input_1_'+n+'" type="text" value="'+data[n].value+'" onkeyup="Size.fixAttrItem(this.parentNode,this);" class="input-medium norms-input"></span>'+
                                        '</label>'+
                                        '<i data='+'[{"size":"1","id":"'+data[n].id+'","value":"'+backend.comomn.save_json(data[n].value)+'","order":"'+data[n].order+'"}]'+' onclick="Size.delAttrItem(this.parentNode,this);" class="sui-icon icon-remove-sign"></i>';
                        fragment.appendChild(li);
                    }

                    ul[0].innerHTML ='<li class="checkbox-item"></li>';
                    ul[0].replaceChild(fragment,ul[0].childNodes[0]);
                }else{
                    for (n in data) {
                        li = document.createElement('li'); 
                        li.className = 'checkbox-item';
                        li.innerHTML =  '<label class="checkbox-pretty inline">'+
                                          '<input id="val_2_'+data[n].id+'_'+data[n].order+'" data='+'[{"size":"2","id":"'+data[n].id+'","value":"'+backend.comomn.save_json(data[n].value)+'","order":"'+data[n].order+'"}]'+' type="checkbox" onclick="Size.autoSizesGoods(this);"><span><input disabled id="val_input_1_'+n+'" type="text" value="'+data[n].value+'" onkeyup="Size.fixAttrItem(this.parentNode,this);" class="input-medium norms-input"></span>'+
                                        '</label>'+
                                        '<i data='+'[{"size":"2","id":"'+data[n].id+'","value":"'+backend.comomn.save_json(data[n].value)+'","order":"'+data[n].order+'"}]'+' onclick="Size.delAttrItem(this.parentNode,this);" class="sui-icon icon-remove-sign"></i>';
                        fragment.appendChild(li);
                    }
                    ul[1].innerHTML ='<li class="checkbox-item"></li>';
                    ul[1].replaceChild(fragment,ul[1].childNodes[0]);
                }

                if(org_th){
                    thead.removeChild(org_th);
                }
                if(thead.querySelector('th').hasAttribute('id')){
                    thead.insertBefore(th,thead.childNodes[1]);
                }else{
                    thead.insertBefore(th,thead.childNodes[0]);
                }
                thead_out.style.display="";
                Size.delSizeItem(t,idata.id);  //当选择选项时, 在没选规格中, 删除当前规格选项
            }
        });

    };
    
    /**
     * 当选择选项时, 在没选规格中, 删除当前规格选项
     * -------------------------------
    */
    var org_li;
    duplication.delSizeItem = function(k,id) {

        if (id==1) return;
        var h = k==1 ? 'B' : 'A';       //反选selectSize
        var e = k==1 ? 2 : 1;           //反选selectSize ul.invisible li
        var ul_opposite=document.querySelector(".selectSize"+h+" ul");
        var liall_opposite=document.querySelectorAll(".selectSize"+h+" ul li");

        var li_opposite=document.getElementById("size_"+e+"_"+id);

        for (var i = liall_opposite.length - 1; i >= 0; i--) {
            liall_opposite[i].classList.remove('disabled')
        }
        if(li_opposite) li_opposite.classList.add('disabled');




    };

    /**
     * 规格列表, 更改规格值
     * -------------------------------
    */
    duplication.fixAttrItem = function(parentO,o) {
        var input_obj = parentO.parentNode.querySelector('input');
        var idata = eval(input_obj.getAttribute("data"));
        idata = idata[0];
        var js_size_letter = idata.size == 1 ? " .js_sizes_a" : " .js_sizes_b";
        var autosizes_obj = document.querySelectorAll('.js_sizes_'+idata.size+'_'+idata.id+'_'+idata.order+js_size_letter); //组合商品规格标题
        var new_val = backend.comomn.save_json(o.value);
        var org_val = backend.comomn.save_json(idata.value);
        //替换data原值
        if(new_val){
            var replace_input_data = input_obj.getAttribute("data").replace("\"value\":\""+org_val+"\"", "\"value\":\""+new_val+"\""); //正则替换value值
            //设置data
            input_obj.setAttribute("data",replace_input_data);
            if(autosizes_obj){
                // 替换标题
                for (var i = autosizes_obj.length - 1; i >= 0; i--) {
                    autosizes_obj[i].innerHTML = new_val;
                    /*if(idata.size == 1){
                        autosizes_obj[i].parentNode.setAttribute("f_val",new_val);
                    }else{
                        autosizes_obj[i].parentNode.setAttribute("s_val",new_val);
                    }*/
                }
                // 更换对象数组sizeItem.A/sizeItem.B中的value
                if(idata.size == 1){ //替换规格1的值
                    for (var i = sizeItem.A.length - 1; i >= 0; i--) {
                        if(sizeItem.A[i].id == idata.id){
                            sizeItem.A[i].value = new_val;
                        }
                    }
                }else if(idata.size == 2){ //替换规格2的值
                    for (var i = sizeItem.B.length - 1; i >= 0; i--) {
                        if(sizeItem.B[i].id == idata.id){
                            sizeItem.B[i].value = new_val
                        }
                    }
                }
                //console.log(sizeItem.A, sizeItem.B);
            }
        }


    };

    /**
     * 删除规格值
     * -------------------------------
    */
    duplication.delAttrItem = function(parentO,o) {
        $(".js_btn_submit").show(); //显示确认
        parentO.parentNode.removeChild(parentO); //删除规格值
        var idata = eval(o.getAttribute("data"));
        idata = idata[0];
        //从选项1对象变量删除元素
        if(idata.size==1){
            for (var i = sizeItem.A.length - 1; i >= 0; i--) {
                if( sizeItem.A[i].id ==  idata.id){
                    sizeItem.A.remove(i);
                }
            }
        }
        //从选项2对象变量删除元素
        if(idata.size==2){
            for (var i = sizeItem.B.length - 1; i >= 0; i--) {
                if( sizeItem.B[i].id ==  idata.id){
                    sizeItem.B.remove(i);
                }
            }
        }
        //删除组合商品
        var org_tr = document.querySelectorAll(".js_sizes_"+idata.size+"_"+idata.id+"_"+idata.order);
        tbody = document.querySelector('.js_sizes');   //列表
        if(org_tr){
            for (var i = org_tr.length - 1; i >= 0; i--) {
                tbody.removeChild(org_tr[i]);
            }
        }
    };

    /**
     * 添加规格值
     * -------------------------------
    */
    duplication.addAttrItem = function(k) {
        if(k == 1){
            if(!org_select_a_id){
                $.alert("亲，先选择规格1(注意：更改规格组合,会清空当前组合商品！)");
                return false;
            }
        }
        if(k == 2){
            if(!org_select_b_id){
                $.alert("亲，先选择规格2(注意：更改规格组合,会清空当前组合商品！)");
                return false;
            }
        }
        var ul = document.querySelectorAll('.js_attr_list');
        //获取最后规格值ID
        if(ul[k-1].hasChildNodes()){
          var idata = eval(ul[k-1].lastChild.querySelector('input').getAttribute('data'));
          idata = idata[0];
          var j = (parseInt(idata.order)+1);
        }else{
          var j =1
        }

        li = document.createElement('li'); 
        li.className = 'checkbox-item Js_addNorms';
        li.innerHTML =  '<label class="checkbox-pretty inline">'+
                          '<input id="val_'+k+'_0_'+j+'" data='+'[{"size":"'+k+'","id":"0","value":"","order":"'+j+'"}]'+' type="checkbox" onclick="Size.autoSizesGoods(this);"><span><input id="val_input_'+k+'_'+j+'" type="text" value="" onkeyup="Size.fixAttrItem(this.parentNode,this);" class="input-medium norms-input"></span>'+
                        '</label>'+
                        '<i data='+'[{"size":"'+k+'","id":"0","value":"","order":"'+j+'"}]'+' onclick="Size.delAttrItem(this.parentNode,this);" class="sui-icon icon-remove-sign"></i>';
        if(k==1){
            ul[0].appendChild(li);
        }else{
            ul[1].appendChild(li); 
        }
        j++;
    };

    /**
     * 勾选规格值自动生成组合列表
     * -------------------------------
    */
    duplication.autoSizesGoods = function(o) {

        if($(o).parents("li.checkbox-item").hasClass("Js_addNorms")){
          var addNorms=1;
        }else{
          var addNorms=0;
        }

        var idata = eval(o.getAttribute("data"));
        idata = idata[0];
        tbody = document.querySelector('.js_sizes');   //列表
        //当前(取消/勾选)的值
        sizeItem.Cur = [{
                   "size":idata.size,
                   "id":idata.id,
                   "value":idata.value,
                   "order":idata.order,
                   "add":addNorms
                }];
        if(idata.size==1){ //规格1
            if (o.checked){
                //添加元素到选项1
                sizeItem.A.push({
                           "id":idata.id,
                           "value":idata.value,
                           "order":idata.order,
                           "add":addNorms
                        });
                //按ID值排序数组
                sizeItem.A.sort(function(a,b){
                    return a.id-b.id;
                });
                if(org_select_a_id && !org_select_b_id){  //仅勾选选项1的值
                    tr = document.createElement('tr'); 

                    var att=document.createAttribute("partgoods_id");
                    att.value=0;
                    tr.setAttributeNode(att);

                    att=document.createAttribute("normsvalue_a_add");
                    att.value=sizeItem.Cur[0].add;
                    tr.setAttributeNode(att);

                    att=document.createAttribute("norms_a");
                    att.value=sizeItem.Cur[0].id;
                    tr.setAttributeNode(att);

                    tr.classList.add("js_sizes_1_"+sizeItem.Cur[0].id+'_'+sizeItem.Cur[0].order);
                    tr.innerHTML =  '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.Cur[0].value+'</td>'+
                                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" name="js_restockPrice" type="text" value="" onchange="Size.qq(this);"></td>'+
                                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value=""></td>'+
                                    '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value=""></td>';
                    var isGiveScore=$("#isGiveScore").val();
                    if(1==isGiveScore){
                        tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" placeholder="2-5之间的数值" class="input-medium js_originalPrice" name="js_originalPrice" readonly="readonly" type="text" value="" ></td>';
                        tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" name="js_preferentialPrice" type="text" value="" onchange="Size.zz(this);"></td>';
                    }else{
                        tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input placeholder="0-100之间" class="input-medium js_originalPrice" readonly="readonly"  name="js_originalPrice" type="text" value="" >&nbsp;%</td>';
                        tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" onchange="Size.zz(this);" name="js_preferentialPrice" type="text" value=""></td>';
                    }


                    // tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" name="js_preferentialPrice" type="text" readonly="readonly" value=""></td>';
                    // <input min="0" class="input-medium js_originalPrice" type="text" value="">
                    tbody.appendChild(tr);
                }

                if(org_select_a_id && org_select_b_id){ //勾选选项1的值和选项2的值
                    for (var i = sizeItem.B.length - 1; i >= 0; i--) {
                        for (var j = sizeItem.Cur.length - 1; j >= 0; j--) {
                            tr = document.createElement('tr'); 

                            att=document.createAttribute("partgoods_id");
                            att.value=0;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("normsvalue_a_add");
                            att.value=sizeItem.Cur[0].add;
                            tr.setAttributeNode(att);


                            att=document.createAttribute("normsvalue_b_add");
                            att.value=sizeItem.B[i].add;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("norms_a");
                            att.value=sizeItem.Cur[0].id;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("norms_b");
                            att.value=sizeItem.B[i].id;
                            tr.setAttributeNode(att);

                            tr.classList.add("js_sizes_1_"+sizeItem.Cur[0].id+'_'+sizeItem.Cur[0].order);
                            tr.classList.add("js_sizes_2_"+sizeItem.B[i].id+'_'+sizeItem.B[i].order);

                            tr.innerHTML =  '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.Cur[0].value+'</td>'+
                                            '<td class="js_sizes_b" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.B[i].value+'</td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" name="js_restockPrice" type="text" value="" onchange="Size.qq(this);"></td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value=""></td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value=""></td>';

                            var isGiveScore=$("#isGiveScore").val();
                            if(1==isGiveScore){
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" placeholder="2-5之间的数值" class="input-medium js_originalPrice" name="js_originalPrice" readonly="readonly" type="text" value=""></td>';
                                tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" name="js_preferentialPrice" type="text" value="" onchange="Size.zz(this);"></td>';
                            }else{
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input placeholder="0-100之间" class="input-medium js_originalPrice" name="js_originalPrice" readonly="readonly"  type="text" value="" >&nbsp;%</td>';
                                tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" name="js_preferentialPrice" type="text"  onchange="Size.zz(this);" value=""></td>';
                            }


                             // tr.innerHTML += '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" name="js_preferentialPrice" type="text" value=""></td>';
                            // <input min="0" class="input-medium js_originalPrice" type="text" value="">
                            tbody.appendChild(tr);
                        }
                    }
                }
            }else{
                //删除规格组合商品
                var org_tr = document.querySelectorAll(".js_sizes_1_"+sizeItem.Cur[0].id+'_'+sizeItem.Cur[0].order);
                for (var i = org_tr.length - 1; i >= 0; i--) {
                    if(org_tr[i]) tbody.removeChild(org_tr[i]);
                }
                //从选项1删除元素
                for (var i = sizeItem.A.length - 1; i >= 0; i--) {
                    if( sizeItem.A[i].id ==  idata.id){
                        sizeItem.A.remove(i);
                    }
                }
            }
        }else{ //规格2
            if (o.checked){
                //添加元素到选项2
                sizeItem.B.push({
                           "id":idata.id,
                           "value":idata.value,
                           "order":idata.order,
                           "add":addNorms
                        });
                //按ID值排序数组
                sizeItem.B.sort(function(a,b){
                    return a.id-b.id;
                });
                if(org_select_a_id && org_select_b_id){ //勾选选项1的值和选项2的值
                    for (var i = sizeItem.A.length - 1; i >= 0; i--) {
                        for (var j = sizeItem.Cur.length - 1; j >= 0; j--) {
                            tr = document.createElement('tr'); 

                            att=document.createAttribute("partgoods_id");
                            att.value=0;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("normsvalue_a_add");
                            att.value=sizeItem.A[i].add;
                            tr.setAttributeNode(att);


                            att=document.createAttribute("normsvalue_b_add");
                            att.value=sizeItem.Cur[0].add;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("norms_a");
                            att.value=sizeItem.A[i].id;
                            tr.setAttributeNode(att);

                            att=document.createAttribute("norms_b");
                            att.value=sizeItem.Cur[j].id;
                            tr.setAttributeNode(att);

                            tr.classList.add("js_sizes_1_"+sizeItem.A[i].id+'_'+sizeItem.A[i].order);
                            tr.classList.add("js_sizes_2_"+sizeItem.Cur[j].id+'_'+sizeItem.Cur[j].order);

                            tr.innerHTML =  '<td class="js_sizes_a" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.A[i].value+'</td>'+
                                            '<td class="js_sizes_b" style="word-break: break-all;word-wrap:break-word;">'+sizeItem.Cur[j].value+'</td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_restockPrice" name="js_restockPrice" type="text" value="" onchange="Size.qq(this);"></td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_stockNum" type="text" value=""></td>'+
                                            '<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_weight" type="text" value=""></td>';

                            var isGiveScore=$("#isGiveScore").val();
                            if(1==isGiveScore){
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" placeholder="2-5之间的数值" class="input-medium js_originalPrice" type="text" name="js_originalPrice" readonly="readonly" value=""></td>';
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" name="js_preferentialPrice" value="" onchange="Size.zz(this);" ></td>';
                            }else{
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input placeholder="0-100之间" class="input-medium js_originalPrice" readonly="readonly"  name="js_originalPrice" type="text" value="" >&nbsp;%</td>';
                                tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" name="js_preferentialPrice" onchange="Size.zz(this);"  value=""></td>';
                            }


                               // tr.innerHTML +='<td style="word-break: break-all;word-wrap:break-word;"><input min="0" class="input-medium js_preferentialPrice" type="text" name="js_preferentialPrice" value=""></td>';
                            // <input min="0" class="input-medium js_originalPrice" type="text" value="">
                            tbody.appendChild(tr);
                        }
                    }
                }

            }else{
                //删除规格组合商品
                var org_tr = document.querySelectorAll(".js_sizes_2_"+sizeItem.Cur[0].id+'_'+sizeItem.Cur[0].order);
                for (var i = org_tr.length - 1; i >= 0; i--) {
                    if(org_tr[i]) tbody.removeChild(org_tr[i]);
                }
                //从选项2删除元素
                for (var i = sizeItem.B.length - 1; i >= 0; i--) {
                    if( sizeItem.B[i].id ==  idata.id){
                        sizeItem.B.remove(i);
                    }
                }
            }
        }
    };


    /**
     * 保存组合商品
     * -------------------------------
    */
    duplication.saveSizeGoods = function() {
      $.confirm({
        title: '确认',
        body: '确认要保存？保存后不能恢复之前数据！',
        backdrop: true,
        okHide: function() {
        //    $('body').append("<div class='sui-modal-backdrop fade in' style='background:#000'><div style='margin-top: 20%' class='sui-loading loading-xxlarge'><i class='sui-icon icon-pc-loading'></i><br>努力加载中...</div></div>");

            //保存组合商品
          var formsizeGoods = document.querySelectorAll(".js_sizes tr")
          var postSizes=new Array();
          if(!formsizeGoods.length){
              alert("至少有一个组合商品!");
              return;
          }
          for (var i = formsizeGoods.length - 1; i >= 0; i--) {

              savePartIds.push(parseInt(formsizeGoods[i].getAttribute("partgoods_id"))); //保存组合商品的多个ID, 以数组保存

              var sizeItems = {};
                  sizeItems.id = formsizeGoods[i].getAttribute("partgoods_id"); //组合商品ID
                  sizeItems.goodsId = $("#id").val(); //商品ID
                  sizeItems.stockNum = backend.comomn.save_json(formsizeGoods[i].querySelector(".js_stockNum").value);
                  sizeItems.weight = backend.comomn.save_json(formsizeGoods[i].querySelector(".js_weight").value);
                  sizeItems.discount = backend.comomn.save_json(formsizeGoods[i].querySelector(".js_originalPrice").value);
                  sizeItems.preferentialPrice = backend.comomn.save_json(formsizeGoods[i].querySelector(".js_restockPrice").value);
                  sizeItems.restockPrice = backend.comomn.save_json(formsizeGoods[i].querySelector(".js_preferentialPrice").value);

                  if(formsizeGoods[i].hasAttribute("normsvalue_a_add")){ //商品添加的规格值 或者还是 标准的规格值
                    sizeItems.normsvalue_a_add = formsizeGoods[i].getAttribute("normsvalue_a_add"); 
                    sizeItems.normsvalue_a_val = formsizeGoods[i].querySelector(".js_sizes_a").textContent; 
                  }
                  if(formsizeGoods[i].hasAttribute("normsvalue_b_add")){
                    sizeItems.normsvalue_b_add = formsizeGoods[i].getAttribute("normsvalue_b_add"); 
                    sizeItems.normsvalue_b_val = formsizeGoods[i].querySelector(".js_sizes_b").textContent; 
                  }

                  if(formsizeGoods[i].hasAttribute("norms_a")){  //规格值ID
                    sizeItems.norms_a = formsizeGoods[i].getAttribute("norms_a"); 
                  }
                  if(formsizeGoods[i].hasAttribute("norms_b")){
                    sizeItems.norms_b = formsizeGoods[i].getAttribute("norms_b"); 
                  }
                  if($("#normsaId").val()){
                    sizeItems.normsaId = $("#normsaId").val(); 
                  }
                  if($("#normsbId").val()){
                    sizeItems.normsbId = $("#normsbId").val(); 
                  }
                  if(!sizeItems.restockPrice) {
                      $.alert("请输入销售价!");
                      $(formsizeGoods[i].querySelector(".js_restockPrice")).trigger("focus");
                      return;
                  }else if(!sizeItems.stockNum) {
                      $.alert("请输入库存数量!");  
                      $(formsizeGoods[i].querySelector(".js_stockNum")).trigger("focus");
                      return;
                  }else if(!sizeItems.weight) {
                      $.alert("请输入商品重量!");
                      $(formsizeGoods[i].querySelector(".js_weight")).trigger("focus");
                      return;
                  }else if(!sizeItems.discount) {
                      $.alert("请输入倍数或折扣!");
                      $(formsizeGoods[i].querySelector(".js_originalPrice")).trigger("focus");
                      return;
                  }

                  postSizes.push(sizeItems);
          }

          for (var i = getPartIds.length - 1; i >= 0; i--) {
              if( savePartIds.indexOf(getPartIds[i]) < 0 ){
                  delPartIds.push(getPartIds[i]);
              }
          }

          //反馈成功,再保存自定义的规格
          if(!Size.saveSize()){
            return false;
          }
            $.ajax({
              type    : "post",
              async   : false,
              url     : OO._SRVPATH+'goods_list/savesizegoods', 
              data    : {'id':$("#id").val(),'postsizes':JSON.stringify(postSizes),'delpartids':JSON.stringify(delPartIds)},
              dataType: 'json',
              success : function (data)
              {
                //  $('.sui-modal-backdrop.fade.in').remove();
                canupdate = data['msg'];
                  $.alert("保存成功");
                  SAYIMO.go_url(OO._SRVPATH+"goods_list/normsedit?id="+$("#id").val()+"&isGiveScore="+$("#isGiveScore").val());
              }
          });
         // console.log(postSizes);
          /*console.log(getPartIds);
          console.log(savePartIds);
          console.log(delPartIds);*/
          savePartIds = new Array();
          delPartIds = new Array();
        },
        hide: function() {}
      });
    };


    /**
     * 保存商品自定义规格
     * -------------------------------
    */
    duplication.saveSize = function() {
        var size_list = document.querySelectorAll(".js_attr_list");
        var form_f_sizes = size_list[0].querySelectorAll("li label input[type='checkbox']");
        var form_s_sizes = size_list[1].querySelectorAll("li label input[type='checkbox']");
        var post_f_vals = new Array();
        var post_s_vals = new Array();
        var f_chk = new Array();
        var s_chk = new Array();
        for (var i = form_f_sizes.length - 1; i >= 0; i--) {
            if(!form_f_sizes[i].nextSibling.querySelector('input').value){
                $.alert("规格一值不能为空!");
                $(form_f_sizes[i]).trigger("focus");
                return false;
            }
            post_f_vals.push(JSON.parse(form_f_sizes[i].getAttribute('data')));
            if(form_f_sizes[i].checked){
               f_chk.push(JSON.parse(form_f_sizes[i].getAttribute('data'))); 
            }
        }
        for (var i = form_s_sizes.length - 1; i >= 0; i--) {
            if(!form_s_sizes[i].nextSibling.querySelector('input').value){
                $.alert("规格二值不能为空!");
                $(form_s_sizes[i]).trigger("focus");
                return false;
            }
            post_s_vals.push(JSON.parse(form_s_sizes[i].getAttribute('data')));
            if(form_s_sizes[i].checked){
               s_chk.push(JSON.parse(form_s_sizes[i].getAttribute('data'))); 
            }
        }
       
        

        $.ajax({
            type    : "post",
            async   : false,
            url     : OO._SRVPATH+'goods_list/savesize', 
            data    : {'goods_id':$("#id").val(),'normsaId':$("#normsaId").val(),'normsbId':$("#normsbId").val(),'f_vals':post_f_vals,'s_vals':post_s_vals},
            dataType: 'json',
            success : function (data)
            {
                null
            }
        });
        return true;
    };


    return duplication;//return the public variable
} (Size || {}));





