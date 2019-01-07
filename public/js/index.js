$(function () {
    // 页面滚动事件
  var $window = $(window), $nav = $('#logo'), $body = $('body')
  $window.bind('scroll', function () {
    $docHeight = $(document).height()
    $docScorllTop = $(document).scrollTop()
    if ($window.scrollTop() >= 258) {
      $('#logo')
                .addClass('fixed-nav')
                .nextAll('div')
                .eq(0)
                .css('margin-top', '264px')
            // 大logo区域
      $('.header-logo').hide()
            // 菜单上的logo
      $('#nav_logo')
                .css('display', 'inline-block')
                .siblings('.item')
                .css('padding', '15px 9px')

      $('.nav-container-down .nav-down-menu:visible').hide()
    } else {
      $('#logo')
                .removeClass('fixed-nav')
                .nextAll('div')
                .eq(0)
                .css('margin-top', '0')
      $('.header-logo').show()
      $('#nav_logo').hide().siblings('.item').css('padding', '15px')
      $('.nav-container-down .nav-down-menu:visible').hide()
    }
        // 筛选列表侧边栏固定
    if ($(window).scrollTop() >= 400 && $docScorllTop < $docHeight - 1260) {
      $('.filter-sub-navlist').addClass('filterFixed')
    } else {
      $('.filter-sub-navlist').removeClass('filterFixed')
    }
  })
    // 监听侧边栏大小
  $('.filter-list-wrap').resize(function () {
    if (
            parseFloat($('.filter-list-wrap').css('height')) >=
            $window.height() - 120
        ) {
      $('.filter-list-wrap').css({
        height: $window.height() - 130,
        'overflow-y': 'auto'
      })
    }
  })

    // 二维码移入移出事件
  $('.header .left-content>li').hover(
        function () {
          var $code = $(this).find('div.scan-code>div.border-content')
          $code.stop(true, true).show()
        },
        function () {
          var $code = $(this).find('div.scan-code>div.border-content')
          $code.stop(true, true).hide()
        }
    )

    // 公告
  $('div.notice').hover(
        function () {
          var $notice = $(this).find('.notice-content')
          $notice.stop(true, true).show()
        },
        function () {
          var $notice = $(this).find('.notice-content')
          $notice.stop(true, true).hide()
        }
    )

    // 菜单移入移出事件
  var menuList = {}
    // var currentOffet = 0
  $('[_yg_nav]').hover(
        function () {
            // 获取logo区域整体高度
          var $logoHeight = $('#logo').height()
          $('.nav-container-down').css('top', $logoHeight)

          var _nav = $(this).attr('_yg_nav')

            // 获取当前移入的菜单位置
            // if($(this)[0].tagName === 'A'){
            //   currentOffet = $(this).offset().left;
            // }
            // // 子菜单与顶级菜单左边对齐
            // $('#' + _nav).find('.sub-container').css('margin-left', currentOffet);

          var currentOffet = $('#nav_logo').next().offset().left + 15;
          $('#' + _nav)
                .find('.sub-container')
                .css('margin-left', currentOffet)

          clearTimeout(menuList[_nav + '_timer'])

          menuList[_nav + '_timer'] = setTimeout(function () {
            $('[_yg_nav]').each(function () {
              $(this)[
                        _nav == $(this).attr('_yg_nav')
                            ? 'addClass'
                            : 'removeClass'
                    ]('nav-up-selected')
            })

            $('#' + _nav).stop(true, true).slideDown(200)
          }, 150)
        },
        function () {
          var _nav = $(this).attr('_yg_nav')

          clearTimeout(menuList[_nav + '_timer'])

          menuList[_nav + '_timer'] = setTimeout(function () {
            $('[_yg_nav]').removeClass('nav-up-selected')

            $('#' + _nav).stop(true, true).slideUp(200)
          }, 150)
        }
    )

    // 多个3级菜单
  var $headerNavDl = $('.header-nav-dl'), maxNum = 9
  $.each($headerNavDl, function () {
    $dd = $(this).find('dd')
    if ($dd.length >= maxNum) {
      $dd.css('display', 'inline-block').css('width', '60px')
      $(this).css('width', '130px')
    }
  })

    // 搜索
  $('.search_btn').bind('click', function (e) {
    e.stopPropagation()
    var keyword = $('#keyword').val()
    if (!keyword == '') {
      $(this).parents('form').submit()
    }
  })

    // 切换新旧网站
  $('#switch-website').bind('click', function () {
    switchVersion()
  })

  function setCookie (c_name, value, expiredays) {
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie =
            c_name +
            '=' +
            escape(value) +
            (expiredays == null ? '' : ';expires=' + exdate.toGMTString()) +
            ';path=/;Domain=yougou.com'
  }

  function switchVersion () {
    setCookie('versionbelle', 'oldEdition', 365)
    window.location.href = 'https://www.yougou.com'
  }
})
