//引用网易七鱼客服系统
/*
  *页面中的引用
  *<a title="在线咨询"  onclick="openSDK(this)" id="OnlySign" class="lnk-ntalker Blue fr">在线咨询</a>
  *
  *<script src="https://qiyukf.com/script/f29248a33c0011caff94096b8e42ee08.js"></script>
  *<!--#include virtual="/inc/script/js/CustomerManagement.shtml"-->
  *
 */
/*var OnlyId,gDesc=""; //单品页专属在线咨询ID，商品描述
window.openSDK = function(On_line){
    //ysf.open();
    OnlyId=$(On_line).attr("id");
    location.href = ysf.url();
    var gPic = $("#spec-list ul li:first img").attr("picbigurl");
    //alert(gPic);


    if (OnlyId == "OnlySign") {
        //将访客正在浏览的商品链接发给客服
        ysf.product({
            show: 1, // 1为打开， 其他参数为隐藏（包括非零元素）
            title: prodInfo.cName,
            desc: gDesc,
            picture: gPic,
            note: prodInfo.salePrice,
            url: "//www.yougou.com"+prodInfo.url
        });
    }
}*/
//环信客服系统2018
// alert(0);
// $(function(){
    // alert(1);
    if("undefined" != typeof prodInfo){
        var track = {
            "track":{ //浏览轨迹发送
                "title":"我正在看：",
                "price":prodInfo.salePrice,
                "desc":prodInfo.cName,
                "img_url":$("#spec-list ul li:first img").attr("picbigurl"),
                "item_url":"//www.yougou.com"+prodInfo.url
            }
        }
    }else{
        var track = '';
    }
    window.easemobim = window.easemobim || {};
    easemobim.config = {
        //自定义“联系客服”按钮
        hide: true,
        // autoConnect: false,

        //发送轨迹消息
        configId: '1f142cd0-a8ca-4769-b447-59f9fa01bb65',
        //聊天窗口加载成功回调
        onready: function () {
            easemobim.sendExt({
                ext:{
                    "imageName": "mallImage3.png",
                    //custom代表自定义消息，无需修改
                    "type": "custom",
                    "msgtype":track
                }
            })
        }
    }

// })

