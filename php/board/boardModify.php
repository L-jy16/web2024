<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="mint">
    <?php include "../include/skip.php" ?>
    <!-- //skip -->
    
    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intron__img small">
                <img srcset="../assets/img/intro03.jpg 1x,
                             ../assets/img/intro03@2x.jpg 2x,
                             ../assets/img/intro03@3x.jpg 3x" alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>게시글 수정하기</h2>
                <p>
                웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>게시글을 수정할 수 있습니다.
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__write">
                <form action="boardModifySave.php" name="boardWriteSave" method="post">
                    <fieldset>
                        <legend class="blind">게시글 수정하기</legend>
<?php
    $boardID = $_GET['boardID'];

    echo "<div><input type='hidden' name='boardID' value='{$boardID}'></div>";
    
    
    $sql = "SELECT * FROM board WHERE boardID = {$boardID}";
    $result = $connect -> query($sql);
    

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div><label for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='input__style' value='".$info['boardTitle']."'></div>";
        echo "<div><label for='boardContents'>내용</label><textarea name='boardContents' id='boardContents' rows='20' class='input__style'>".$info['boardContents']."</textarea></div>";
        echo "<div class='mt50'><label for='boardPass'>비밀번호</label><input type='password' id='boardPass' name='boardPass' class='input__style' autocomplete='off' placeholder='글을 수정하려면 로그인 비밀번호를 입력하셔야합니다.' require></div>";
    }
?>
                        <!-- <div>
                            <label for="boardTitle">제목</label>
                            <input type="text" id="boardTitle" name="boardTitle" class="input__style">
                        </div>
                        <div>
                            <label for="boardContents">내용</label>
                            <textarea name="boardContents" id="boardContents" rows="20" class="input__style"></textarea>
                        </div>-->
                        <!-- <div class="mt50">
                            <label for="boardPass">비밀번호</label>
                            <input type="password" id="boardPass" name="boardPass" class="input__style" autocomplete="off" placeholder="글을 수정하려면 로그인 비밀번호를 입력하셔야합니다." require>
                        </div> -->
                        <div class="board__btns">
                            <button type="submit" class="btn__style3">수정하기</button>
                        </div> 
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>