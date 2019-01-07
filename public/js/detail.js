$(function () {
  $('#bot_plus').hover(
        function () {
          $(this).children().removeClass('up').addClass('up_')
        },
        function () {
          $(this).children().removeClass('up_').addClass('up')
        }
    )

  $('#bot_subtract').hover(
        function () {
          $(this).children().removeClass('down').addClass('down_')
        },
        function () {
          $(this).children().removeClass('down_').addClass('down')
        }
    )

  //尺码表
  $('.size-wrapper .param-list').each(function(i,item){
      var $liItem = $(item).children('li');
      var itemSize = $liItem.size();
      if(itemSize <= 10){
        $liItem.css('margin','24px 30px');  
      }else if(itemSize >= 11 && itemSize <= 12){
        $liItem.css('margin','24px 24px');  
      }
      else if(itemSize >= 13 && itemSize <= 14){
        $liItem.css('margin','24px 18px');  
      }
      else if(itemSize >= 15 && itemSize <= 16){
        $liItem.css('margin','24px 12px');  
      }
      else if(itemSize >= 17 && itemSize <= 18){
        $liItem.css('margin','24px 6px');  
      }
      else if(itemSize >= 19 && itemSize <= 20){
        $liItem.css('margin','24px 0px');  
      }
      else if(itemSize >= 21){
        $liItem.css('margin','24px 0px');  
      }
  });

    // 猜你喜欢
  $('#guessGuds2').children().hover(
        function () {
          $(this).addClass('like-active')
        },
        function () {
          $(this).removeClass('like-active')
        }
    )

    //收藏按钮
    $(".collect").click(function () {
        if ($(this).hasClass("active")) {
          $(this).removeClass("active");
        } else {
          $(this).addClass("active");
        }
      })
})
