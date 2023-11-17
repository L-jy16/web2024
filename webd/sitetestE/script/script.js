$(function () {
    // 슬라이더
    let curr = 0;

    $(".sliderwrap").append($(".slider").first().clone(true));

    setInterval(function () {
        curr++;

        $(".sliderwrap").animate({ marginTop: -800 * curr + "px" }, 700)

        if (curr == 3) {
            setTimeout(function () {
                $(".sliderwrap").animate({ marginTop: 0 }, 0)

                curr = 0;
            })
        }
    }, 3000)

    // 메뉴
    $(".nav > ul > li").mouseover(function () {
        $(this).find(".submenu").stop().slideDown(400);
    });
    $(".nav > ul > li").mouseout(function () {
        $(this).find(".submenu").stop().slideUp(400);
    })

    // 팝업
    $(".popup_btn").click(function () {
        $(".popup-view").show();
    });
    $(".popup_close").click(function () {
        $(".popup-view").hide();
    })
});