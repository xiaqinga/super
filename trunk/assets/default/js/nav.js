/**
 * FileName: nav.css
 * Date: 2016.06.21
 * Author: hexiaohui@sayimo.cn
 */
;(function(a){
	a.fn.nav = function(setting){
		setting = a.extend({speed: 300,callback: new Object},setting || {});
		var self = $(this),
			ul = self.find('ul'),
			li = ul.find("li"),
			liH = li.height(),
			bar = self.find('.bar')
			i = 0;		
		li.each(function(){
			if($(this).hasClass('active')){
				i = $(this).index();
				bar.css('top',i * liH);
			}					
		});	
		ul.on('mouseover',function(e){
			var y = Math.floor((e.pageY - ul.offset().top)/liH);
			bar.stop(true,true).animate({'top': y * liH},setting.speed);				
		}).on('mouseleave',function(){
			bar.stop(true,true).animate({'top': i * liH},setting.speed);
		});
	}
})(jQuery);
$(".nav-list").nav();