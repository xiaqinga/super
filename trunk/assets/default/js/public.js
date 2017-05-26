//分配类型选择
$(".cation-list .c li").each(function(){
	var self = $(this);
	self.hover(function(){
		$(this).find('dl').stop(true,true).slideDown(100);
		$(this).find('.arrows-b').addClass('tr');
	},function(){
		$(this).find('dl').stop(true,true).slideUp(100);
		$(this).find('.arrows-b').removeClass('tr');
	});	
	self.find('dl dt').each(function(){
		$(this).click(function(){
			self.find('.te').html($(this).html());
			self.find('.te').attr('dataid',$(this).attr('dataid'));
			self.find('dl dt').eq(0).show();
			if($(this).index() == 0){
				$(this).hide();
			}
		});
	});
});
//select选择
function BugSelect(val,tname,name,id){$("#" + name).val(tname);$("#" + id).val(val);}
//修改密码
