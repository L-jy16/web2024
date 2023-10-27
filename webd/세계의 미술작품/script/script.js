$(function(){
    // 슬라이드
    let current = 0;

    $(".sliderWrap").append($(".img").first().clone(true));

    setInterval(function(){
        current++;

        $(".sliderWrap").animate({marginLeft: -100 * current + '%'}, 600);

        setTimeout(function(){
            if(current == 3){
                $(".sliderWrap").animate({marginLeft: 0}, 0);
                current = 0;
            }
            
        })
    }, 3000)

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown(400);
    });
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp(400);
    });

    // 팝업
    $(".popup-btn").click(function(){
        $(".popup-view").show();
    })
    $(".popup-close").click(function(){
        $(".popup-view").hide();
    })
});