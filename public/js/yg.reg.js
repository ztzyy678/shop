//placeholder
(function($){
	if($.fn.placeholder){return;}
	$.fn.placeholder = function () {
		var fnFocus = function () {
			$(this).addClass('ph-wrap-focus').find('input').focus();
		}
		var fnPaste=function(e) {
			$(this).parent().addClass('ph-wrap-has');
		}
		var fnKey = function () {
			this.value != '' ? $(this).parent().addClass('ph-wrap-has') : '';
		}
		var fnBlur = function () {
			if ($.trim(this.value) == '') {
				$(this).val('').parent().removeClass('ph-wrap-has ph-wrap-focus');
			}
		}
		return this.each(function () {
			var $this = $(this), dSpan = $('<span/>', { 'class': 'placeholder', text: $this.attr('placeholder') });
			dWrap = $('<div/>', { 'class': 'ph-wrap', click: fnFocus });
			$this.wrap(dWrap).before(dSpan).bind({ keyup: fnKey, blur: fnBlur,paste:fnPaste });
			if ($.trim(this.value) != '') {
				$this.parent().addClass('ph-wrap-has');
			}
		})
	}
	// 检测 placeholder 支持
	$(function(){
		var supportPlaceholder = 'placeholder' in document.createElement('input');
		if (!supportPlaceholder) {
			$('input[placeholder]').placeholder();
		}
	});
	window.onload=function(){
		$('.ph-wrap input').each(function () {
			if ($.trim(this.value) != '') {
				$(this).parent().addClass('ph-wrap-has');
			}
		});
	}
})(jQuery);
//注册
var gRegFlag=0,blValidte=true; //注册类型，0为mobile，1为email（默认设置为手机注册）
var YouGou,gArrExistUser = [],gArrNoExistUser=[];
if(!YouGou){YouGou={};};
YouGou.reg={
	//验证
	valid:{},
	//错误提示
	regTip:{},
	//GA统计
	gaPv:{},
	//初始化
	init:{}
}
var ygReg = YouGou.reg;
ygReg={
	valid:{
		//唯一性验证
		Unique:function(name,option,callback){
			//先从gArrExistUser中查找是否存在
			if($.inArray(name,gArrExistUser)>=0){
				fnExit();
				return false;
			}
			if($.inArray(name,gArrNoExistUser)>=0){
				fnNoExit();
				return true;
			}
			$.post(basePath+'/my/checkUserNameIsExist.jhtml',{'name':name,'option':option},function(d){
				if(d=='true'){
					gArrExistUser.push(name);				//将已存在的账户保存在数组中，以免多次查询
					fnExit()
					return false;
				}else{
					gArrNoExistUser.push(name);
				}
				fnNoExit();
			});
			function fnExit(){
				ygReg.msg.show('reg_'+option+'_tip','该账号已存在');
				blValidte = false;
			}
			function fnNoExit(){
				ygReg.msg.show('reg_'+option+'_tip');
				if(!!callback&&typeof(callback)=='function'){
					callback();
				}
			}
		},
		//手机
		Mobile:function(strSelector,callback){
			var val = $(strSelector).val(),msg;
			var regexp_mobile=/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0-9]|17[0-9]|19[8|9]|166)\d{8}$/;
			if(val==''){
				msg = '请输入手机号码';
			}else if(!regexp_mobile.test(val)){
				msg = '格式错误';
			}
			if(msg){
				ygReg.msg.show('reg_mobile_tip',msg);
				blValidte = false;
				return false;
			}
			ygReg.valid.Unique(val,'mobile',callback)
		},
		//邮箱
		Email:function(strSelector,callback){
			var val = $(strSelector).val(),msg;
			var regexp_email=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			if(val==''){
				msg = '请输入邮箱';
			}else if(!regexp_email.test(val)){
				msg = '格式错误';
			}else if(val.indexOf('@yahoo')>=0 ){
				msg='雅虎邮箱即将停止服务，请更换其他邮箱。';
			}
			if(msg){
				ygReg.msg.show('reg_email_tip',msg);
				blValidte = false;
				return false;
			}
			ygReg.valid.Unique(val,'email',callback)
		},
		//密码
		Password:function(strSelector){
			var val = $(strSelector).val(),msg;
			var regexp_password=/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~\`\[\]\{\}\;\:\'\"\,\<\.\>\/\?\-\_\=\+\(\)\|\\]{6,25}$/;
			if($.trim(val)==''){
				msg = '请输入密码';
			}else if(!regexp_password.test(val)){
				msg = '密码应6-25位之间';
			}
			if(msg){blValidte = false;}
			ygReg.msg.show('reg_password_tip1',msg);
		},
		//密码强度
		PwdStrengthValidate:function(){
			var that=$(this),score=0;
			var val=that.val(),em=$("#pwdStrength em");
			if(val!=""){
				$("#pwdStrength").show();
			}else{
				$("#pwdStrength").hide();
			}
			if(val.length>2){
				// 有小写字母有数字
				if(val.match(/[a-z]/) && val.match(/\d+/) || val.length>12){score+=5}
				// 有大写字母有数字
				if(val.match(/[A-Z]/) && val.match(/\d+/)){score+=7}
				// 有小写字母和大写字母
				if(val.match(/[A-Z]/) && val.match(/[a-z]/)){score+=7}
				if(val.match(/[a-z]/) && val.match(/\d+/) && val.match(/[A-Z]/)){score+=10}
				// 有特殊字符
				if(val.match(/.[!,@,#,$,%,^,&,*,?,_,~]/)){score+=15}
				// 有小写字母或者大写字母有数字超过12位
				if(val.match(/[a-z]/) && val.match(/\d+/) && val.length>12){score+=15}
				if(val.match(/[A-Z]/) && val.match(/\d+/) && val.length>12){score+=15}
			}
			if(score<5){
				em.attr("class","").eq(0).addClass("pwdLow");
			}else if(score>=5 && score<20){
				em.attr("class","").eq(1).addClass("pwdMid");
			}else if(score>=20){
				em.attr("class","").eq(2).addClass("pwdHeight");
			}

		},
		//重复密码
		RePassword:function(strSelector){
			var val = $(strSelector).val(),msg;
			var regexp_password=/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~\`\[\]\{\}\;\:\'\"\,\<\.\>\/\?\-\_\=\+\(\)\|\\]{6,25}$/;
			if($.trim(val)==''){
				msg = '请输入确认密码';
			}else if(!regexp_password.test(val)){
				msg = '密码应6-25位之间';
			}else if(val!=$('#reg_password_').val()){
				msg = '两次密码输入不一致';
			}
			if(msg){blValidte = false;}
			ygReg.msg.show('reg_password_tip2',msg);
		},
		//验证码
		IdentifyCode:function(strSelector,callback){
			var val = $(strSelector).val(),msg;
			if(val==''){
				msg = '请输入验证码';
			}else if(val.length<4){
				msg = '验证码格式错误';
			}
			if(msg){
				blValidte = false;
				ygReg.msg.show('code2_tip',msg);
				return false;
			}
			if(!!callback&&typeof(callback)=='function'){
				$.post('/api/checkCode2.sc',{code:val},function(d){
					if(d==0){
						msg = '验证码不正确';
						blValidte = false;
						ygReg.valid.changeValidateImage2();
						ygReg.msg.show('code2_tip',msg);
						return 'false';
					}else {
						callback();
					}

				});
			}
			ygReg.msg.removeError('code2_tip');
		},
		//更换验证码
		changeValidateImage2:function(){
			var requestHost = 'https:' == document.location.protocol ? 'https://passport.yougou.com' : 'https://www.yougou.com';
			//$('#imageValidate2').attr("src",requestHost+'/servlet/imageValidate?rand='+Math.random());
			$('#imageValidate2').attr("src",requestHost+'/servlet/imageCaptcha?rand='+Math.random());
			return false;
		},
		//短信验证码
		MsgIdentifyCode:function(strSelector,callback){
			var val = $(strSelector).val(),msg;
			var regexp_code=/^[0-9]{4}$/;
			if(val==''){
				msg = '请输入短信验证码';
			}else if(!regexp_code.test(val)){
				msg = '短信验证码格式不正确';
			}
			if(msg){
				ygReg.msg.show('sendMsgTips',msg);
				blValidte = false;
				return false;
			}
			if(!!callback&&typeof(callback)=='function'){
				var phone = $('#reg_mobile_').val();
				$.post('/my/checkMobileCode.jhtml?phone='+phone+'&code='+val,function(d){
					if(d==0||d==2){
						msg = '短信验证码错误';
						blValidte = false;
						ygReg.msg.show('sendMsgTips',msg);
					}else {
						callback();
					}

				});
			}
			ygReg.msg.removeError('sendMsgTips');
		},
		//阅读交易条款
		Rules:function(){
			if(!$('#rules')[0].checked){
				blValidte = false;
				ygReg.msg.show('ruleTips','请阅读交易条款');
			}
		}
	},
	//提示信息
	msg:{
		show:function(id,msg,isSuccess){
			if(msg&&!isSuccess){
				$('#'+id).html( msg ).attr('className','errortips');
				$('#'+id).parent().prev("dd").children(".nreg_input_bg").css({"border":"1px solid #333"});
			}else{
				msg = msg?msg:'';
				$('#'+id).html(msg).attr('className','righttips');
				if($('#'+id).attr('data-msg')=='sendmsgtips'){
					$('#'+id).html(msg).addClass('sendmsg_tips');
				}
				$('#'+id).parent().prev("dd").children(".nreg_input_bg").css({"border":"1px solid #e3e2e2"});
			}
		},
		clear:function(){
			$('.errortips').html('').removeClass('errortips');
			$('.righttips').removeClass('righttips');
			$(".nreg_input_bg").css({"border":"1px solid #e3e2e2"});
		},
		removeError:function(id){
			$('#'+id).html('').removeClass('errortips');
			if(id=='code2_tip'){
				$('#'+id).parent().prev("dd").children(".nreg_input_bg").css({"width":"202px","border":"1px solid #e3e2e2"});
			}else if(id=='sendMsgTips'){
				$('#'+id).parent().prev("dd").children(".nreg_input_bg").css({"width":"235px","border":"1px solid #e3e2e2"});
			}else{
				$('#'+id).parent().prev("dd").children(".nreg_input_bg").css({"border":"1px solid #e3e2e2"});
			}
		}
	},
	gaPv:{
		register:function(type){
			try{
				if(type == "email"){
					_gaq.push(['_trackPageview','/PageAction/register/mail/start']);
				}else{
					_gaq.push(['_trackPageview','/PageAction/register/mobile/start']);
				}
			}catch(e){}
		},
		registerCheckPhone:function(type){
			try{
				//点击获取验证码行为数量
				if(type == "1"){
					_gaq.push(['_trackPageview','/PageAction/register/mobile/codesent']);
					//实际发送验证码数量
				}else{
					_gaq.push(['_trackPageview','/PageAction/register/mobile/codesucces']);
				}
			}catch(e){}
		}
	},
	init:function(dModule){
		//发送短信中...
		function sendMsg(){
			//这里异步发送短信，如果成功做如下操作
			var btnTip = $("#getMsgSpan"),btn = $("#sendMsgBtn");
			$("#sendMsgTips").show();
			btn.addClass("dis").css({"cursor":"default"});
			var t=60;
			btnTip.html(t+"秒");
			function handleTimeout(){
				t--;
				btnTip.html(t+"秒");
				if(t<=1)
				{
					btn.removeClass("dis").css({"cursor":"pointer"});
					btnTip.html("重新获取");
					$("#sendMsgTips").hide();
					$("#sendMsgBtn").removeAttr('islock');
				}else{
					setTimeout(handleTimeout,1000);
				}
			}
			setTimeout(handleTimeout,1000);
		}
		function codeValidCallback(){
		}
		//获取短信验证码
		function getPhoneMsg(){
			var ygVaild = ygReg.valid;
			var validResult = ygVaild.IdentifyCode('#code2_',codeValidCallback);
			if(validResult && validResult == 'false'){
				return false;
			}

			if($(this).attr('islock')){return false;}
			var inpMobile = $('#reg_mobile_'),strPhone = inpMobile.val();
			var validCode = $('#code2_').val();
			ygReg.valid.Mobile('#reg_mobile_',ajaxSendMsg);
			function ajaxSendMsg(){
				//发送消息
				ygReg.gaPv.registerCheckPhone(1);
				$("#sendMsgBtn").attr('islock','true');
				//获取手机验证码
				$.post('/my/getMobileCode.jhtml',{"phone" : strPhone,"codes":"checkCode","validCode":validCode},function(d){
					var msg,isSuccessMsg = false;
					$("#sendMsgBtn").removeAttr('islock');
					switch(d){
						case null:
							msg = '获取验证码失败!';
							break;
						case '2':
							$("#sendMsgBtn").attr('islock','true');
							msg='验证码已成功发送，请注意查收!';
							isSuccessMsg= true;
							ygReg.gaPv.registerCheckPhone(2);
							sendMsg();
							break;
						case '3':
							msg = '对不起，获取手机验证码系统出错，请联系客服!';
							break;
						case '4':
							msg = '手机号码存在异常，请更换手机号码!';
							break;
						case '5':
							msg = '提示：1分钟内不可重复获取验证码!';
							break;
						case '1':
							msg = '手机号码格式不正确!';
							break;
						case '0':
							msg = '图片验证码校验失败!';
							break;
						default :
							msg = d;
							break;
					}
					ygReg.msg.show('sendMsgTips',msg,isSuccessMsg);
				});
			}
			return false;
		}
		//表单提交验证
		function validateForm(){
			//TODO:异步校验nonce
			var regNonceName = $("#reg_nonce_id").attr("name");
			var regNonceValue = $("#reg_nonce_id").attr("value");
			var validNonce = false;
			$.ajax({
				type : "POST",
				url : "/validNonce.jhtml",
				data : {"regNonceName" : regNonceName,"regNonceValue":regNonceValue},
				dataType : "text",
				async : false,
				success : function(r) {
					if(r == 'nonce_success'){
						validNonce = true;
					}
				}
			});
			if(!validNonce){
				ygReg.msg.show('reg_mobile_tip','请刷新页面后重新提交');
				ygReg.msg.show('reg_email_tip','请刷新页面后重新提交');
				return false;
			}
			$(this).attr('disabled',true);
			//if($('.errortips').length>0){return false;}
			var ygVaild = ygReg.valid;
			blValidte = true;
			ygReg.msg.clear();
			if(gRegFlag==1){
				ygVaild.Email('#reg_email_');
			}else{
				ygVaild.Mobile('#reg_mobile_');
				ygVaild.MsgIdentifyCode('#reg_mobile_code_');
			}
			ygVaild.Password('#reg_password_');
			ygVaild.RePassword('#reg_password2');
			ygVaild.IdentifyCode('#code2_');
			ygVaild.Rules();
			if(!blValidte) return false;
			if(gRegFlag==1){
				ygVaild.Email('#reg_email_',function(){
					if($('#code2_',dModule)[0]){
						ygVaild.IdentifyCode('#code2_',fnSubmit);
					}else{
						fnSubmit();
					}
				});
			}else{
				ygVaild.Mobile('#reg_mobile_',function(){
					ygVaild.MsgIdentifyCode('#reg_mobile_code_',fnSubmit);
				});
			}
			return false;
		}
		//表单提交
		function fnSubmit(){
			if(blValidte){
				if(gRegFlag == 1){
					_gaq.push(['_trackPageview','/PageAction/register/mail/register']);
				}else{
					_gaq.push(['_trackPageview','/PageAction/register/mobile/register']);
				}
				if($('form',dModule)[0]){
					$('form',dModule).submit();

				}else{
					$('form').submit();

				}
				$('#reg_buton').attr('disabled',true);
				$('#pop_reg').attr('disabled',true);
			}
		}
		//tab
		$(".nreg_mob_ema").click(function(){
			$(this).next(".tab_user_name").show();
		})
		$('.reg_Tab').click(function(){
			$(this).parent().show();
			$(".nreg_input_bg").css("border","1px solid #e3e2e2");
			var $this = $(this);
			$this.parent().hide();
			if(!$this.hasClass('reg_TabCurr')){
				ygReg.msg.clear();
				//$this.addClass('reg_TabCurr').siblings('a').removeClass('reg_TabCurr');
				var regType = $this.attr('regtype');
				$("#option").val(regType);
				ygReg.gaPv.register(regType);
				$('.nreg_item[id]').hide().filter('.'+regType+'_regitem').show();
				gRegFlag=regType=='email'?1:0;
				ygReg.valid.changeValidateImage2();
			}
			return false;
		});
		//获取短信验证码
		$('#sendMsgBtn',dModule).click(getPhoneMsg);
		//密码强度验证
		$('#reg_password_').keyup(ygReg.valid.PwdStrengthValidate);
		//绑定验证
		$('dd input',dModule).focus(function(){
			$(this).addClass('nreg_yellowbor');
		}).blur(function(){
			var $this = $(this);
			$this.removeClass('nreg_yellowbor');
			if($this.attr('valid')){
				ygReg.valid[$this.attr('valid')](this);
			}
		});
		$('.changeImg').click(ygReg.valid.changeValidateImage2);
		//提交表单
		$('.nreg_submit',dModule).click(validateForm);
		//$('#reg_buton').click(validateForm);

		//默认ga
		if($('#pop_loginform').length==0){
			ygReg.gaPv.register('mobile');
//			ygReg.gaPv.register('email');
			ygReg.valid.changeValidateImage2();
		}
	}
};
$(function(){
	var doWhileExist = function(sModuleId,oFunction){
		if(document.getElementById(sModuleId)){oFunction(document.getElementById(sModuleId));}
	};
	doWhileExist('emailDiv',ygReg.init);
});
