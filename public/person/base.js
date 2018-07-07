// JavaScript Document


//G.DOMAIN = {
//    img01: "http://172.17.1.107:8888/",
//    www: "http://www.yiguo.com/"
//};

$(function () {
    //图片异步加载
    $(".floor-side li a img").scrollLoading();
    $(".p-img a img").scrollLoading();
    $(".floor-main .ad_01 a img").scrollLoading();
    $(".catalogs-ad  li a img").scrollLoading();
    $(".ad-item a img").scrollLoading();

    

    //选择城市
    $('.city').hover(function () {
        $(this).addClass('city-hover');
    }, function () {
        $(this).removeClass('city-hover');
    });

    //$(".city-con a").live("click", function() {
    //    var v = $(this).attr("v");
    //    var areaid = $(this).attr("aid");
    //    var name = $(this).text();
    //    var deliverytype = $(this).attr("_type");
    //    if (v != "" && v != undefined) {
    //        $.ajax({
    //            url: "/Handler/ChangeCity?deliverytype=" + encodeURIComponent(deliverytype) + "&cityid=" + v + "&cityname=" + encodeURIComponent(name) + "&areaid=" + encodeURIComponent(areaid) + "&r=" + Math.random(),
    //            success: function(data) {
    //                if (data.Msg == "1") {
    //                    window.location.href = window.location.href.replace("#", '');
    //                }
    //            },
    //            error: function() {

    //            }
    //        })
    //    }
    //    return false;
    //});

    //我的易果
    $('.myyiguo').hover(function () {
        $(this).addClass('current');
    }, function () {
        $(this).removeClass('current');
    });

    //手机易果
    $('.mobile').hover(function () {
        $(this).addClass('current');
    }, function () {
        $(this).removeClass('current');
    });

    //购物车
    $('.shopping-cart').hover(function () {
        $('.shopping-cart').addClass('shopping-cart-cur');
    }, function () {
        $('.shopping-cart').removeClass('shopping-cart-cur');
    });
    $('.shopping-list ul li').hover(function () {
        $(this).find('.del').css('visibility', 'visible');
    }, function () {
        $(this).find('.del').css('visibility', 'hidden');
    });

    //商品分类
    $('.catalogs').hover(function () {
        $('.catalogs .catalogs-list').show();
    }, function () {
        $('.catalogs .catalogs-list').hide();
    });
    $('.catalogs-list .item').hover(function () {
        $(this).addClass('current');
        $(this).find('.sub-item').show();
    }, function () {
        $(this).removeClass('current');
        $(this).find('.sub-item').hide();
    });

    //shopping cart count

    
    //侧边悬浮-购物车
    $(".sidebar .side-cart").hover(function () {
        $(this).addClass("side-cart-cur");
    }, function () {
        $(this).removeClass("side-cart-cur");
        });

    var flashlist = $(".flash_sale .product .time");
    $.each(flashlist, function (index, item) {
        var endtime = $(item).attr("_endtime");
        timer(endtime, item);
    });

    //适应分辨率
    var screenWidth = window.screen.width;
    if (screenWidth < 1300) {
        $('.w').addClass('w1280');
    }


});


 