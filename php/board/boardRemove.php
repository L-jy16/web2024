<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";


    $boardID = $_GET['boardID'];
    $memberID = $_SESSION['memberID'];

    // 게시글 소유자 확인
    $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        $boardOwnerID = $info['memberID'];

        // 로그인 memberID와 게시글 memberID 일치 여부
        if($memberID == $boardOwnerID){
            $sql = "DELETE FROM board WHERE boardID = {$boardID}";
            $connect -> query($sql);
            echo "<script>alert('게시글이 삭제 되었습니다.');</script>";
        } else {
            echo "<script>alert('게시글 소유자만 삭제 할 수 있습니다.');</script>";
        }
    } else {
        echo "<script>alert('관리자에게 문의해주세요!');</script>";
    }


    // // 로그인 한 사람만 지우기
    // if(isset($_SESSION['memberID'])){  // 로그인 되어 있는지 안되어 있는지 확인
    //     $boardID = $_GET['boardID'];

    //     $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    //     $connect -> query($sql);   
    // } else {
    //     echo "<script>alert('지울 수 있는 권한이 없습니다. 로그인해주세요!');</script>";  // 로그인 안되어 있을 때 나오는 경고문
    // }

?>

    <script>
        location.href = "board.php";
    </script>
</body>
</html>