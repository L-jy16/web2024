$(function(){
    // 이미지 슬라이드
    let currentIndex = 0;   //현재 이미지
    $(".sliderwrap").append($(".image").first().clone(true));  //첫번째 이미지를 복하해서 마지막에 추가

    setInterval(() => { //3초에 한번씩 실행
        currentIndex++; // 현재 이미지를 1씩 증가

        $(".sliderwrap").animate({marginTop: -300 * currentIndex + "px"}, 600); 

        if(currentIndex == 3){  // 마지막 이미지가 됐을 때
            setTimeout(() => {  //한번만 실행
                $(".sliderwrap").animate({marginTop:0}, 0); //애니메이션 정지
                currentIndex = 0;   //현재 이미지 초기화
            }, 700)
        }
    }, 3000)

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(".nav > ul > li > ul").stop().slideDown();
    });
    $(".nav > ul > li").mouseout(function(){
        $(".nav > ul > li > ul").stop().slideUp();
    });

});