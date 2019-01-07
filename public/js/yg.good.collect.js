var ygDialog, favorite, waitFavoriteMap;
(function($) {
	bindCollectEvent();
})(jQuery);

function bindCollectEvent() {
	$(".collect").bind('click', function() {
		var commodityNo = $(this).attr("id");
		var url = $(this).attr("url");
		var src = $(this).attr("src");
		var price = $(this).attr("price");
		if (_gaq) {
			_gaq.push([ '_trackPageview', '/PageAction/collect/detail/' + commodityNo ]);
			_gaq.push([ '_trackPageview', '/PageAction/detail/add_to_favorite' ]);
		}
		if (!showLoginPop('toFavorite')) {// 先判断登陆再执行收藏
			if (!ygDialog) {
				loadjs($('#jsYgDialog').val(), favorite);
			} else {
				favorite(commodityNo, 1, url, src, price, "addCollection");
			}
		} else {
			waitFavoriteMap = {};
			waitFavoriteMap['commodityNo'] = commodityNo;
			waitFavoriteMap['url'] = url;
			waitFavoriteMap['src'] = src;
			waitFavoriteMap['price'] = price;
		}
		return false;
	});
}

function clickCollectEvent(e) {
	var commodityNo = $(e).attr("id");
	var url = $(e).attr("url");
	var src = $(e).attr("src");
	var price = $(e).attr("price");
	if (_gaq) {
		_gaq.push([ '_trackPageview', '/PageAction/collect/detail/' + commodityNo ]);
		_gaq.push([ '_trackPageview', '/PageAction/detail/add_to_favorite' ]);
	}
	if (!showLoginPop('toFavorite')) {// 先判断登陆再执行收藏
		if (!ygDialog) {
			loadjs($('#jsYgDialog').val(), favorite);
		} else {
			favorite(commodityNo, 1, url, src, price, "addCollection");
		}
	} else {
		waitFavoriteMap = {};
		waitFavoriteMap['commodityNo'] = commodityNo;
		waitFavoriteMap['url'] = url;
		waitFavoriteMap['src'] = src;
		waitFavoriteMap['price'] = price;
	}
	return false;
}

function toFavorite() {
	favorite(waitFavoriteMap['commodityNo'], 1, waitFavoriteMap['url'], waitFavoriteMap['src'], waitFavoriteMap['price'], "addCollection");
	waitFavoriteMap = null;
}

// 判断登陆并且弹窗
function showLoginPop(callback) {
	var callback = callback ? callback : '';
	var showLoginDialog = function() {
		var refreshTopWin = callback ? false : true;
		YouGou.Biz.loginPop({
			title : '您尚未登录',
			lock : true,
			closable : true,
			refreshTopWin : refreshTopWin,
			callback : callback,
			closeWin : true
		});
	};
	if (!checkUserLogin()) {
		if (!ygDialog) {
			loadjs($('#jsYgDialog').val(), showLoginDialog);
		} else {
			showLoginDialog();
		}
		return true;
	}
	return false;
}

// 检查是否登录
function checkUserLogin() {
	var isLogin = false;
	$.ajax({
		type : "POST",
		async : false,
		url : '/api/checkUserLogin.jhtml',
		success : function(data) {
			if (data == "true") {
				isLogin = true;
			}
		}
	});
	return isLogin;
}

// 商品收藏
function favorite(commodityNo, commodityNum, url, src, price, type) {
	var collectionCommodity = '<li style="width:88px; float:left; margin:10px 0px 0px 10px; display:inline; text-align:center;">' + '<a href="' + url
			+ '" style="display:block;"><img style="border:1px solid #D1D1D1;" src="' + src + '" style="border:1px solid #D1D1D1;" width="90" height="90" /></a>'
			+ '<p style="margin-top:8px;"><em class="ygprc15">&yen;<i>' + price + '</i></em></p>' + '</li>';
	var collectionContent = "";
	var collectionend = '</ul></div>';
	var minHeight = 290;
	$.ajax({
		type : "POST",
		url : '/api/addCommodityFavorite.jhtml',
		data : {
			"commodityNo" : commodityNo,
			"productSize" : 1
		},
		dataType : "json",
		async : false,
		success : function(data) {
			var flag = parseInt(data.flag);
			var collectionSuccess = getCollectionContentPart(flag);
			var funCollectionMoreGood = getCollectionMoreGood();
			if (flag == 2) {
				var count = $("#favorite").attr('count') - 0 + 1;
				$("#favorite").text('(' + count + ')').attr('count', count);
			}
			if (!collectionCommodity) {
				minHeight = "160";
				collectionContent = collectionSuccess + collectionend;
			} else {
				collectionContent = collectionSuccess + funCollectionMoreGood + collectionCommodity + collectionend;
			}
			yg_dialog_bind = new ygDialog({
				close : function() {// 对话框关闭前执行的函数
					clearInterval(timer);
				},
				loaded : null,// url加载完成回调
				lock : true, // 是否锁屏
				closable : true, // 是否允许关闭
				fixed : true,
				minHeight : minHeight,
				minWidth : 430,
				skin : 3,
				drag : false
			});
			yg_dialog_bind.content(collectionContent);
		}
	});
	var i = 10;
	var fn = function() {
		if (i <= 0) {
			yg_dialog_bind.close();
		}
		$("#bind_tip").text("倒计时" + i + "秒后自动关闭");
		i--;
	};
	timer = setInterval(fn, 1000);
	fn();
	if ($("em[id='" + commodityNo + "']").length > 0) {
		$("em[id='" + commodityNo + "']").addClass("hobby");
	}
	if ($("div[id='" + commodityNo + "']").length > 0) {
		$("em[id='" + commodityNo + "']").addClass("active");
	}
	return false;
}

// 获取收藏弹出框前部分
function getCollectionContentPart(flag) {
	var collection = "";
	if (flag = 1) {
		collection = "已经收藏";
	} else {
		collection = "成功加入收藏夹！";
	}
	var funCollectionContentPart = '<div>' + '<p style="margin-left:20px;">' + '<img style="width:33px;height:33px;" src="../template/common/images/ubg14.png">'
			+ '<em style="margin-left:10px;font-size:14px;font-weight:bold;">' + collection + '</em>' + '</p>'
			+ '<p style="margin-left:63px;margin-top:5px;"><em>您可以</em>&nbsp;&nbsp;<a target="_blank" href="/my/favorites.jhtml" class="cblue">查看收藏夹</a></p>'
			+ '<p style="margin-left:63px;margin-top:5px;"><em id="bind_tip" style="color: #AAA;">倒计时10秒后自动关闭</em></p>' + '</div>'
			+ '<div style="margin:10px 20px 5px 20px;border-bottom:1px dotted #D1D1D1;"></div>' + '<div>';
	return funCollectionContentPart;
};
// 获取收藏弹出框换一批
function getCollectionMoreGood() {
	var funCollectionMoreGood = '<p style="margin-left:22px;"><em">收藏此商品的还喜欢</em><a style="margin-left:208px;" id="change_collection" href="javascript:void(0)" class="cblue">换几个更好的</a></p>'
			+ '<ul id="ul_collection" style="list-style:none;margin-left:13px;">';
	return funCollectionMoreGood;
}