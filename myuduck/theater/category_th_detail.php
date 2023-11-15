<?php
include "../connect/connect.php";
include "../connect/session.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

$theaterId = $_GET['theaterId'];

$sql = "SELECT * FROM theater WHERE theaterId = $theaterId";
$result = $connect->query($sql);

$theaterAllInfo = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $theaterId = $row['theaterId'];
        $thLogo = $row['thLogo'];
        $thName = $row['thName'];
        $thAddress = $row['thAddress'];
        $thCall = $row['thCall'];
        $thHomepage = $row['thHomepage'];
        $thTransport = $row['thTransport'];
        $thSeatImg = $row['thSeatImg'];
        $thPerform = $row['thPerform'];


        $thPerform = json_decode($row['thPerform'], true);

        $theaterAllInfo[] = array(
            'theaterId' => $theaterId,
            'thLogo' => $thLogo,
            'thName' => $thName,
            'thAddress' => $thAddress,
            'thCall' => $thCall,
            'thHomepage' => $thHomepage,
            'thTransport' => $thTransport,
            'thSeatImg' => $thSeatImg,
            'thPerform' => $thPerform
        );
    }
}

$loggedIn = isset($_SESSION['youId']) ? true : false;



if ($loggedIn) {
    $youId = $_SESSION['youId'];

    $theaterId = $_GET['theaterId'];

    // 사용자의 초기 찜 상태를 가져오는 로직 추가
    $initialLikeStatusQuery = "SELECT * FROM likeTheater WHERE youId = $youId AND theaterId = $theaterId";
    $initialLikeStatusResult = $connect->query($initialLikeStatusQuery);

    if ($initialLikeStatusResult && $initialLikeStatusResult->num_rows > 0) {
        $initialLikeStatus = $initialLikeStatusResult->fetch_assoc();
        echo json_encode(['status' => 'success', 'initialLikeStatus' => $initialLikeStatus]);
    } else {
        // 초기 찜 상태가 비어 있는 경우 빈 값을 반환
        echo json_encode(['status' => 'success', 'initialLikeStatus' => null]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/commons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">



    <title>극장 카테고리</title>
    <style>
    </style>
</head>

<body>
    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main>
        <div class="theater__inners">
            <div class="theater__info">
                <div class="th__detail_info">
                    <div class="theater_detail">
                        <div class="logo_img">
                            <div>
                                <button class="like-button">☆ 찜버튼</button>
                            </div>
                            <img src=<?= $thLogo ?> alt="<?= $thName ?>">
                        </div>
                        <div class="theater__detail__title">
                            <h2 class="logo"><?= $thName ?></h2>
                            <div class="logo_cont">
                                <div class="theater__address">주소 : <span><?= $thAddress ?></span></div>
                                <div class="theater__callnumber">전 화 : <span><?= $thCall ?></span></div>
                                <div class="theater__homepage"><a href="<?= $thHomepage ?>">공식 홈페이지 바로가기</a>
                                </div>
                            </div>
                            <div class="rating mt20">
                                <span class="rating_result">
                                </span>
                                <i class="rating_star far fa-star"></i>
                                <i class="rating_star far fa-star"></i>
                                <i class="rating_star far fa-star"></i>
                                <i class="rating_star far fa-star"></i>
                                <i class="rating_star far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="theater__detail__info container">
                    <h1>공연장 정보 <span>theater information</span></h1>
                    <div class="theater__detail__cont">
                        <section class="theater_transport">
                            <div class="main_theater_title">
                                <h3>오시는 길</h3>
                            </div>
                            <div class="transport_info">
                                <?= $thTransport ?>
                            </div>
                        </section>
                        <section class="theater_seat_info">

                            <div class="main_theater_title">
                                <h3>좌석 정보</h3>
                            </div>
                            <div class="seat_img">
                                <img src=<?= $thSeatImg ?> alt="좌석 정보">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- //main-->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../script/commons.js"></script>

    <script>
        //별점기능
        // const ratingStars = [...document.getElementsByClassName("rating_star")];
        // const ratingResult = document.querySelector(".rating_result");

        // printRatingResult(ratingResult);

        // function executeRating(stars, result) {
        //     const starClassActive = "rating_star fas fa-star";
        //     const starClassUnactive = "rating_star far fa-star";
        //     const starsLength = stars.length;
        //     let i;
        //     stars.map((star) => {
        //         star.onclick = () => {
        //             i = stars.indexOf(star);

        //             if (star.className.indexOf(starClassUnactive) !== -1) {
        //                 printRatingResult(result, i + 1);
        //                 for (i; i >= 0; --i) stars[i].className = starClassActive;
        //             } else {
        //                 printRatingResult(result, i);
        //                 for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
        //             }
        //         };
        //     });
        // }

        // function printRatingResult(result, num = 0) {
        //     result.textContent = `${num}/5`;
        // }

        // executeRating(ratingStars, ratingResult);

        // //찜버튼
        // const likeButton = document.querySelector('.like-button');

        // likeButton.addEventListener('click', function() {
        //     this.classList.toggle('clicked');

        //     if (this.classList.contains('clicked')) {
        //         this.innerHTML = '★ 찜버튼';
        //     } else {
        //         this.innerHTML = '☆ 찜버튼';
        //     }
        // });
    </script>
    <script>
         window.addEventListener('load', getInitialLikeStatus);

        //별점기능
        const ratingStars = [...document.getElementsByClassName("rating_star")];
        const ratingResult = document.querySelector(".rating_result");

        printRatingResult(ratingResult);

        function executeRating(stars, result) {
            const starClassActive = "rating_star fas fa-star";
            const starClassUnactive = "rating_star far fa-star";
            const starsLength = stars.length;
            let i;
            stars.map((star) => {
                star.onclick = () => {
                    i = stars.indexOf(star);

                    if (star.className.indexOf(starClassUnactive) !== -1) {
                        printRatingResult(result, i + 1);
                        for (i; i >= 0; --i) stars[i].className = starClassActive;
                    } else {
                        printRatingResult(result, i);
                        for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
                    }
                };
            });
        }

        function printRatingResult(result, num = 0) {
            result.textContent = `${num}/5`;
        }

        executeRating(ratingStars, ratingResult);

        // 찜버튼
        // const likeButton = document.querySelector('.like-button');

        // likeButton.addEventListener('click', function() {
        //     this.classList.toggle('clicked');

        //     if (this.classList.contains('clicked')) {
        //         this.innerHTML = '★ 찜버튼';
        //     } else {
        //         this.innerHTML = '☆ 찜버튼';
        //     }
        // });

        
       // 찜 버튼과 관련된 코드
        const likeButton = document.querySelector(".logo_img .like-button");

        likeButton.addEventListener('click', function() {
            if (!likeButton.disabled) {
                likeButton.disabled = true;

                console.log('버튼이 클릭되었습니다.');

                const isClicked = likeButton.classList.contains('clicked');

                if (!isClicked) {
                    likeButton.classList.add('clicked');
                    console.log('찜 추가');

                    // 찜 추가 로직
                    if (<?= $loggedIn ? 'true' : 'false' ?>) {
                        // 새로운 코드: 찜 추가 함수 호출
                        sendLikeData(true);
                    } else {
                        alert("로그인을 해주세요.");
                        window.location.href = '../login/login.php';
                    }
                } else {
                    likeButton.classList.remove('clicked');
                    console.log('찜 취소');

                    // 찜 취소 로직
                    if (<?= $loggedIn ? 'true' : 'false' ?>) {
                        // 새로운 코드: 찜 취소 함수 호출
                        sendLikeData(false);
                    } else {
                        alert("로그인을 해주세요.");
                        window.location.href = '../login/login.php';
                    }
                }

                // 초기 찜 상태 가져오기
                getInitialLikeStatus();
            }
        });

        // AJAX를 사용하여 liketh.php로 데이터 전송하는 함수
        function sendLikeData(isClicked) {
            const liketheaterId = <?= $theaterId ?>;
            const likethLogo = '<?= $thLogo ?>';
            const likethName = '<?= $thName ?>';

            $.ajax({
                type: 'POST',
                url: '../like/likeTh.php',
                data: {
                    liketheaterId: liketheaterId,
                    likethLogo: likethLogo,
                    likethName: likethName,
                    isClicked: isClicked
                },
                success: function(response) {
                    console.log(response);  // 응답 확인을 위한 로그

                    if (response.status === 'success') {
                        // 성공적인 응답 처리
                    } else {
                        // 에러 응답 처리
                    }

                    // 버튼 활성화
                    likeButton.disabled = false;
                },
                error: function(xhr, status, error) {
                    console.error('AJAX 요청 실패:', error);

                    // 버튼 활성화
                    likeButton.disabled = false;
                }
            });
        }

        // 초기 찜 상태를 가져오는 함수
        function getInitialLikeStatus() {
            $.ajax({
                type: 'GET',
                url: '../like/likeThStatus.php',
                success: function(response) {
                    console.log(response);  // 응답 확인을 위한 로그
                    if (response.status === 'success') {
                        const initialLikeStatus = response.initialLikeStatus;

                        if (initialLikeStatus && initialLikeStatus.likeStatus === 1) {
                            likeButton.classList.add('clicked');
                            likeButton.innerHTML = '★ 찜버튼';
                        } else {
                            likeButton.classList.remove('clicked');
                            likeButton.innerHTML = '☆ 찜버튼';
                        }
                    } else {
                        // 에러 응답 처리
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX 요청 실패:', error);
                }
            });
        }
</script>

</body>

</html>