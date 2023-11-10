$(function() {
    //슬라이드
    let current = 0;
    $(".sliderwarp").append($(".slider").first().clone(true));

    setInterval(function(){
        current++;

        $(".sliderwarp").animate({maginTop: -400 * current + 'px'}, 700);

        if(current == 3){
            setTimeout(function(){
                $(".sliderwarp").animate({maginTop: 0}, 0);
                
            })
            current = 0;
        }

    }, 3000);

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").slideDown();
    })
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").slideUp();
    })
});