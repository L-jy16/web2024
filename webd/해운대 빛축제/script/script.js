$(function(){
    //슬라이드
    let current = 0;

    $(".slider").hide().first().show();

    setInterval(function(){
        let next = (current+1) % 3;

        $(".slider").eq(current).fadeOut(1200); 
        $(".slider").eq(next).fadeIn(1200);
        
        current = next;       

    }, 3000)

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown(400);
    })
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp(400);
    })

    // 탭
    const tabbtn = $(".info__menu > a");
    const tabcont = $(".info__cont > div");
    tabcont.hide().eq(0).show()

    tabbtn.click(function(){
        const index = $(this).index()
        $(this).addClass("active").siblings().removeClass("active");
        tabcont.eq(index).show().siblings().hide();
    })


    // 팝업
    $(".popup_btn").click(function(){
        $(".popup-view").show();
    });
    $(".popup-close").click(function(){
        $(".popup-view").hide();
    });

});