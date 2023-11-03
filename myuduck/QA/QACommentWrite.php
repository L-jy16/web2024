<?php
 include "../connect/connect.php";
 include "../connect/session.php";
 
 $youId = $_POST['youID'];
 $boardId = $_POST['boardID'];
 $commentName = $_POST['name'];
 $commentPass = $_POST['pass'];
 $commentWrite = $_POST['msg'];
 $regTime = time();
 
 $sql = "INSERT INTO QAcomment(youId, boardId, commentName, commentPass, commentMsg, commentDelete, regTime) VALUES('$youId', '$boardId', '$commentName', '$commentPass', '$commentWrite', 1, '$regTime')";
 $result = $connect->query($sql);
 
 if ($result) {
     // 성공 응답 생성
     $response = array("success" => true, "message" => "댓글이 성공적으로 등록되었습니다.");
     echo json_encode($response);
 } else {
     // 실패 응답 생성
     $response = array("success" => false, "message" => "댓글 등록 중 오류가 발생했습니다.");
     echo json_encode($response);
 }
?>