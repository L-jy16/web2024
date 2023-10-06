<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID'];

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    // $sql = "UPDATE board SET boardTitle = '$boardTitle', regTime = '$regTime', boardContents = '$boardContents'WHERE boardID = '$boardID' AND memberID = '$memberID'";
    // $connect -> query($sql);
?>