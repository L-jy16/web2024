<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    if (isset($_GET['boardID'])) {
        $boardID = $_GET['boardID'];
    } else {
        Header("Location: QA.php");
    }

    // 정보 가져오기
    // $QASql = "SELECT * FROM QAboard WHERE boardID = '$boardID'";
    // $QAResult = $connect->query($QASql);
    // $QAInfo = $QAResult->fetch_array(MYSQLI_ASSOC);

    // 이전글 가져오기
    $prevQASql = "SELECT * FROM QAboard WHERE boardID < '$boardID' ORDER BY boardID DESC LIMIT 1";
    $prevQAResult = $connect->query($prevQASql);
    $prevQAInfo = $prevQAResult->fetch_array(MYSQLI_ASSOC);

    // 다음글 가져오기
    $nextQASql = "SELECT * FROM QAboard WHERE boardID > '$boardID' ORDER BY boardID ASC LIMIT 1";
    $nextQAResult = $connect->query($nextQASql);
    $nextQAInfo = $nextQAResult->fetch_array(MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/commons3.css">

    <title>문의하기</title>
</head>

<body>
    <?php include "../include/header.php"?>
    <!-- //header -->

    <main id="main" role="main">
        <div class="boardWrap">
            <img src="../assets/img/QA.jpg" alt="이미지" class="intro__img">
            <section class="board__inner container">
                <div class="board__search">
                    <div class="board_view_T">
                        <span>문의작성</span><span class="en">Q&A</span>
                    </div>
                </div>
                <div class="board__wrap">
                    <div class="board__view">
                        <table>
                            <colgroup>
                                <col style="width: 20%">
                                <col style="width: 80%">
                            </colgroup>
                            <tbody>
<?php 
$boardID = $_GET['boardID'];

// 보드 뷰 + 1
$sql = "UPDATE QAboard SET boardview = boardview + 1 WHERE boardID = {$boardID}";
$connect -> query($sql);

$sql = "SELECT b.boardTitle, m.youId, b.regTime, b.boardView, b.boardContents FROM QAboard b JOIN myuduck m ON(b.youId = m.youId) WHERE b.boardID = {$boardID}";
$result = $connect->query($sql);

if ($result) {
    $info = $result->fetch_array(MYSQLI_ASSOC);

    echo "<tr><th>제목</th><td>" . $info['boardTitle'] . "</td></tr>";
    echo "<tr><th>등록자</th><td>" . $info['youId'] . "</td></tr>";
    echo "<tr><th>등록일</th><td>" . date('Y-m-d', $info['regTime']) . "</td></tr>";
    echo "<tr><th>조회수</th><td>" . $info['boardView'] . "</td></tr>";
    echo "<tr><th>내용</th><td>" . $info['boardContents'] . "</td></tr>";
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="board__viewpages">
                    <h4 class="blind">이전글/다음글 가기</h4>
                    <!-- <a href="#" class="prev">이전글</a>
                    <a href="#" class="next">다음글</a> -->
                    <?php if (!empty($prevQAInfo)) { ?>
                        <a href="QAView.php?boardID=<?= $prevQAInfo['boardID']; ?>" class="prev">
                            이전글 <?= substr($prevQAInfo['boardTitle'], 0, 20); ?>...
                        </a>
                    <?php } else { ?>
                        <span class="prev">이전글이 없습니다.</span>
                    <?php } ?>

                    <?php if (!empty($nextQAInfo)) { ?>
                        <a href="QAView.php?boardID=<?= $nextQAInfo['boardID']; ?>" class="next">
                            다음글 <?= substr($nextQAInfo['boardTitle'], 0, 20); ?>...
                        </a>
                    <?php } else { ?>
                        <span class="next">다음글이 없습니다.</span>
                    <?php } ?>




                </div>
                <div class="viewbtns__wrap">
                    <div class="board__btns viewbtns">
                        <a href="QAModify.php?boardID=<?= $_GET['boardID'] ?>" class="viewbtn">수정</a>
                        <a href="QA.php" class="viewbtn">목록</a>
                        <a href="QARemove.php?boardID=<?= $_GET['boardID'] ?>" class="viewbtn" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
                    </div>
                </div>
            </section>

        </div>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="../script/commons.js"></script>

</html>