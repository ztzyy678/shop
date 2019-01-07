$(function() {
	// 初始化页面数据判断
	var initArr = [];
	var checkedArr = initArr.concat([ 'check1-2', 'check2-2' ]);// 选中数据

	$('input[type="checkbox"]').each(function(i, item) {
		// 判断菜单展示项
		for (var i = 0; i < checkedArr.length; i++) {
			if (checkedArr[i] === item.id) {
				;
				$(this).attr("checked", true)
				$(this).parents("li").children("p").addClass("active");
				$(this).parents("li").children("div").show();
			}
		}
	});

	// 多选超出10个部分隐藏，点击更多显示
	$("ul.filter-list-wrap li.checkbox").each(function(i, item) {
		var l = $(this).find("ul").children("li").size();
		if (l > 9) {
			$(this).find(".more").show();
			$(this).find("ul").children("li:gt(9)").hide();
		} else {
			$(this).find(".more").hide();
		}
	});

	// 点击更多，展示全部
	$(".more").click(function() {
		$(this).hide();
		$(this).parent("div").parent("li").find("ul").children("li:gt(3)").show();
	});

	// 筛选条件点击删除
	$("ul.filter-result-list li").click(function() {
		$(this).remove();
		window.location.href = $(this).children("a").attr('href');
	});

    // 侧边栏菜单
	// 第一级分类交互
	$("ul.filter-list-wrap > li > p").click(function() {
		// var _index = $(this).parent("li").index();
		if ($(this).parent("li").hasClass("active")) {
			$(this).parent("li").removeClass("active");

		} else {
			$(this).parent("li").addClass("active");

		}
	});

	// 第二级交互
	$(".radio-item > p").click(function() {
		if ($(this).parent("li").hasClass("active")) {
			$(this).parent("li").removeClass("active");
			$(this).parent("li").children("ul").hide();
		} else {
			$(this).parent("li").addClass("active");
			$(this).parent("li").children("ul").show();
		}
	});

	// 单选框样式
	$('input[type="radio"]').click(function(e) {
		var _index = $(this).parent("li").index();
		$(this).parent("li").siblings().children("label").removeClass("active");
		$(this).parent("li").children("label").addClass("active");
		// $("form").submit();
	});

	// 筛选列表取消按钮
	$(".btn-wrap .cancel").click(function() {
		$(this).parents("li.checkbox").addClass("hideDefault");
		$(this).parent(".btn-wrap").hide();
		$(this).parent(".btn-wrap").prev().show();
		$(this).prev().addClass("gray");
		$(this).parents(".checkbox").find("input[type='checkbox']").each(function(i, item) {
			$(this).attr("checked", false);
			$(this).parent("li").removeClass("active");
		})
	});

	$('label', $('.filter-list-wrap')).bind('click', function() {
		if ($(".multiple-btn").is(":visible") == true && $(".btn-wrap").is(":visible") == false) {
			window.location.href = $(this).attr('href');
		}
	});

	// 多选按钮
	$(".multiple-btn").click(function() {
		$(this).parents(".checkbox").removeClass("hideDefault");
		$(this).next().show();
		$(this).hide();
	});
	// 多选checkbox选中
	$('input[type="checkbox"]').click(function(e) {
		$(this).parent("li").parent("ul").children("li").each(function(i, item) {
			console.log($(this).children("input").attr("checked"));
			if ($(this).children("input").attr("checked")) {
				$(this).parents(".checkbox").find(".sure").removeClass("gray");
				return false;
			} else {
				$(this).parents(".checkbox").find(".sure").addClass("gray");
			}
		})
	});

	// 展开菜单更多
	$(".filter-more").click(function() {
		$(this).hide();
		$(this).next().show();
		$(this).parent("div").parent("li").find("ul").children("li:gt(3)").show();
	});

	// 向上收缩菜单
	$(".filter-less").click(function() {
		$(this).hide();
		$(this).prev().show();
		$(this).parent("div").parent("li").find("ul").children("li:gt(9)").hide();
	});

	// 筛选列表确认按钮
	$(".btn-wrap .sure").click(function() {
		var ul = $(this).closest('div').parent().prev();
		var choosed = $('input:checkbox:checked', ul);
		if (choosed.length == 0) return false;
		var baseLink = $('#baseLink').val();
		var segments = "";
		if ($('#isSearchKey').val() == 'true') {
			var query = $('#queryStr').val() ;
			var price = $('#price_area').val() ;
			var order = $('#orderBy').val() ;
			var mctcd = $("#mctcd").val();//品牌旗舰店merchard_code
			var storeId = $("#storeId").val();//品牌旗舰店storeId
			var param = _getParam( query ) ;
			segments = [ param.brandEnName , param.catgNo , param.attrStr ] ;
			var j = _getLinkArray( segments , choosed , ul , 'key') ;
			var array = [] ;
			if( !_isEmpty( j[ 0 ] ) ) array.push( 'brandEnName=' + j[ 0 ] ) ;
			if( !_isEmpty( j[ 1 ] ) ) array.push( 'catgNo=' + j[ 1 ] ) ;
			if( !_isEmpty( j[ 2 ] ) ) array.push( 'attrStr=' + j[ 2 ] ) ;
			if( order ) order = '&orderBy=' + order ;
			if( mctcd ) mctcd = '&mctcd=' + mctcd;
			if( storeId ) storeId = '&storeId=' + storeId;
			window.location.href = baseLink + '&' + array.join( '&' ) + ( price || '' ) + ( order || '' ) + ( mctcd || '' ) + ( storeId || '');
		} else {
			segments = baseLink.split('-');
			var j = _getLinkArray(segments, choosed, ul);
			var query = $('#queryParams').val();
			if (query) query = '?' + query;
			var order = $('#orderBy').val();
			if (order) j.push(order);
			window.location.href = '/f-' + j.join('-') + '.html' + query;
		}
	});

	var _getParam = function(q) {
		var idx = q.indexOf('?');
		if (idx != -1) {
			q = q.substr(idx + 1);
		}
		var segments = q.split('&');
		var obj = {};
		for (var i = 0; i < segments.length; i++) {
			var kv = segments[i].split('=');
			obj[kv[0]] = kv[1];
		}
		return obj;
	}

	var _getLinkArray = function(segments, choosed, ul, flag) {
		var link_obj = _addLinkInfo(segments);
		var itemNo = ul.attr('name');
		var idx = 2;
		var prefix;
		if (itemNo == 'seo_en_brand_name') {
			idx = 0;
			prefix = '';
			var selected = prefix + choosed.map(function() {
				return $(this).attr('name');
			}).get().join("_");
			link_obj = _addLinkInfo([ selected ], link_obj);
		} else if (itemNo.indexOf('catg_level_no_') == 0) {
			idx = 1;
			var selected = choosed.map(function() {
				return $(this).attr('name');
			}).get().join("");
			// 当分类允许多选时使用下面代码
			// selected = ul.parent().attr("name") + "_" + selected;
			link_obj = _addLinkInfo([ undefined, selected ], link_obj);
		} else {
			choosed.each(function(i, n) {
				var segs = this.value;
				if (flag == 'key') {
					var param = _getParam(segs);
					segs = [ undefined, undefined, param.attrStr ];
				} else {
					segs = segs.split('-');
					segs = [ undefined, undefined, segs[3] ];
				}
				link_obj = _addLinkInfo(segs, link_obj);
			});
		}
		var j = [];
		if (link_obj.brands.length == 0)
			j.push('0');
		else
			j.push(link_obj.brands.join('_'));

		if (link_obj.category.length == 0)
			j.push('0');
		else
			j.push(link_obj.category.join('_'));

		var attr_str;
		var a = [];
		for ( var k in link_obj.attrs) {
			a.push(k + link_obj.attrs[k].join(''));
		}
		a.sort();
		if (a.length == 0)
			j.push('0');
		else
			j.push(a.join('_'));
		return j;
	};

	var _addLinkInfo = function(segments, obj) {
		if (!obj)
			obj = {
				brands : [],
				category : [],
				attrs : {}
			};
		var brands = segments[0];
		var category = segments[1];
		var attrs = segments[2];
		var _spl = function(str) {
			return _isEmpty(str) ? [] : str.split('_');
		};
		brands = _spl(brands);
		brands.sort();
		category = _spl(category);
		attrs = _spl(attrs);
		obj.brands.addAll(brands);
		obj.category.addAll(category);
		if (!_isEmpty(attrs)) {
			for (var i = 0; i < attrs.length; i++) {
				var attr_obj = _splAttr(attrs[i]);
				if (!obj.attrs[attr_obj.key])
					obj.attrs[attr_obj.key] = [];
				obj.attrs[attr_obj.key].addAll(attr_obj.array);
				obj.attrs[attr_obj.key].sort();
			}
		}
		return obj;
	};

	Array.prototype.contains = function(obj) {
		for (var i = 0; i < this.length; i++) {
			var _obj = this[i];
			if (obj == _obj)
				return true;
		}
		return false;
	};

	Array.prototype.addAll = function(array) {
		for (var i = 0; i < array.length; i++) {
			var _obj = array[i];
			if (this.contains(_obj))
				continue;
			this.push(_obj);
		}
	};

	var _isEmpty = function(str) {
		return !str || str == '0';
	};

	var _splAttr = function(str) {
		var key = str.substr(0, 3);
		str = str.substr(3);
		var array = [];
		while (true) {
			array.push(str.substr(0, 3));
			str = str.substr(3);
			if (str.length == 0)
				break;
		}
		return {
			key : key,
			array : array
		};
	};
});
