<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardID = $_POST['boardID'];
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID'];
    $regTime = time();
    $boardPass = $_POST['boardPass'];

    $sql = "SELECT youPass FROM members WHERE memberID = '$memberID'";
    $result = $connect -> query($sql);
    
    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    if($result){
        $youPassInfo = $result -> fetch_array(MYSQLI_ASSOC);
        $youPass = $youPassInfo['youPass'];

        if($boardPass){
            if($boardPass == $youPass){
                $sql = "UPDATE board SET boardTitle = '$boardTitle', regTime = '$regTime', boardContents = '$boardContents'WHERE boardID = '$boardID' AND memberID = '$memberID'";
                $connect -> query($sql);
            } else {
                echo "<script>alert('비밀번호가 틀렸습니다.');</script>";
            }
        } else {
            echo "<script>alert('비밀번호를 입력해주세요.');</script>";
        }
    } else {
        echo "관리자에게 문의하세요";
    }
?>

<script>
    location.href = "board.php";
</script>