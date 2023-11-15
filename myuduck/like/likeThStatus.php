<?php
include "../connect/connect.php";
include "../connect/session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loggedIn = isset($_SESSION['youId']) ? true : false;

    if ($loggedIn) {
        $youId = $_SESSION['youId'];
        $theaterId = $_POST['liketheaterId'];
        $thLogo = $_POST['likethLogo'];
        $thName = $_POST['likethName'];
        $isClicked = $_POST['isClicked'];

        if ($isClicked) {
            // 찜 추가
            $insertLikeTheaterQuery = "INSERT INTO likeTheater(youId, theaterId, thLogo, thName) VALUES ($youId, $theaterId, '$thLogo', '$thName')";
        } else {
            // 찜 취소
            $deleteLikeTheaterQuery = "DELETE FROM likeTheater WHERE youId = $youId AND theaterId = $theaterId";
        }

        $result = $connect->query($isClicked ? $insertLikeTheaterQuery : $deleteLikeTheaterQuery);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '찜 처리를 실패했습니다.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => '잘못된 요청입니다.']);
}
?>