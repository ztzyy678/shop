var uc={
	datagrid:function(obj){
		obj.children("tbody").children(":odd").addClass('even');
		var _tr = $('tbody tr', obj);
		_tr.each(function (index) {
			var _this = $(this);
			_this.click(function () {
				if (_this.hasClass('selected')) {
					_this.removeClass('selected');
				} else {
					_this.addClass('selected').siblings().removeClass('selected');
				}
			});
			_this.hover(function () {
				_this.addClass('on');
			}, function () {
				_this.removeClass('on');
			});
		});
	},
	proUpDownSlide:function(){
		/*热卖商品推荐上移动*/
		(function(){
			var _self=$(".uc_hotpro");
			var _trg=_self.find(".slide_trg");
			var _itm=_self.find(".uc_hotpro_itm");
			_trg.ygSwitch(_itm,{
				trigger:'a',
				currCls:'curr',
				effect:"scroll",
				steps: 1,
				visible: 1,
				vertical:true
			}).carousel().autoplay(3);
		})();
	},
	proLfSlide:function(className,step,visible){
		/*猜您喜欢左右移动*/
		(function(){
			var cname = className || ".uc_cnlike",c_step = step || 4,c_visible = visible || 4;
			var _self=$(cname);
			var _li=_self.find(".uc_hpro_lst li");
			var _prevBtn=_self.find(".slide_lf");
			var _nextBtn=_self.find(".slide_rt");
			var _page=_self.find(".slide_page");
			_self.ygSwitch(_li,{
				effect: "scroll",
				steps: c_step,
				visible: c_visible,
				nextBtn:_nextBtn,
				prevBtn:_prevBtn,
				pagenation:_page,
				circular:true
			}).carousel();
		})();
	},
	ucMyorder:function(){
		//分享
		$(".uc_share").each(function(){
			var _this=$(this);
			var _data=eval(_this.attr("data-proInfo"))[0];
			_this.jqShare({shareType:_data.shareType || 4,shareData:{
				url:_data.url,
				commodityName:_data.commodityName,
				pics:_data.pics,
				commodityUrl:_data.commodityUrl,
				salePrice:_data.salePrice,
				commodityNo:_data.commodityNo,
				source:_data.source,
				isComment:_data.isComment
			}});
		});
		
		uc.proUpDownSlide();
		uc.proLfSlide();
		
	}
}