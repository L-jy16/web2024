<?php
include "../connect/connect.php";
include "../connect/session.php";

// 필요한 POST 데이터가 모두 제공되었는지 확인
if (isset($_POST['liketheaterId'], $_POST['likethLogo'], $_POST['likethName'], $_POST['isClicked'])) {
    $likeTheaterIdNum = $_POST['liketheaterId'];
    $likethLogo = $_POST['likethLogo'];
    $likethName = $_POST['likethName'];
    $isClicked = $_POST['isClicked'];

    // 사용자가 로그인되어 있는지 확인
    if (isset($_SESSION['youId']) && !empty($_SESSION['youId'])) {
        $youId = $_SESSION['youId'];

        // 찜하기 또는 찜 취소 작업 수행
        if ($isClicked) {
            // 찜하기 - 테이블에 정보 추가
            $insertSql = "INSERT INTO likeTheater (youId, liketheaterId, likethLogo, likethName, likeStatus) VALUES ('$youId', '$likeTheaterIdNum', '$likethLogo', '$likethName', 1)";
            $insertResult = $connect->query($insertSql);

            if ($insertResult) {
                $response = array(
                    'status' => 'success',
                    'message' => '찜하기 성공'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => '찜하기 실패: ' . $connect->error
                );
            }
        } else {
            // 찜 취소 - 테이블에서 정보 삭제
            $deleteSql = "DELETE FROM likeTheater WHERE youId = '$youId' AND liketheaterId = '$likeTheaterIdNum'";
            $deleteResult = $connect->query($deleteSql);

            if ($deleteResult) {
                $response = array(
                    'status' => 'success',
                    'message' => '찜 취소 성공'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => '찜 취소 실패: ' . $connect->error
                );
            }
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => '로그인이 필요합니다.'
        );
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => '올바르지 않은 요청입니다.'
    );
}

// JSON으로 응답 전송
echo json_encode($response);
exit; // 종료 추가
?>