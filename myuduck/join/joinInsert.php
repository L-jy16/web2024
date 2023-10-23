<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>뮤지컬 회원가입 약관</title>
    <style>
    </style>
</head>

<body>
    <?php include "../include/header.php"?>
    <!-- //header -->


    <main>
        <!-- join__inner -->
        <section class="join__inner3">
            <h2 class="blind">회원가입</h2>
            <div class="join__from2 container2">
                <h3>회원가입 <span>Sing up</span></h3>
                <form action="joinResult.php" name="joinResult" method="post" onsubmit="return joinChecks();">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div class="check">
                            <label for="youId" class="required blind">아이디</label>
                            <input type="text" name="youId" id="youId" placeholder="아이디" class="input__style">
                            <div class="btn" onclick="idChecking()">아이디 중복 검사</div>
                        </div>
                        <p class="msg" id="youIdComment"></p>
                        <div>
                            <label for="youPass" class="required blind">비밀번호</label>
                            <input type="password" name="youPass" id="youPass" placeholder="비밀번호" class="input__style">
                        </div>
                        <div>
                            <label for="youPassC" class="required blind">비밀번호 확인</label>
                            <input type="password" name="youPassC" id="youPassC" placeholder="비밀번호 확인" class="input__style">
                        </div>
                        <div>
                            <label for="youName" class="required">이름 *</label>
                            <input type="text" name="youName" id="youName" placeholder="이름을 입력하세요" class="input__style">
                        </div>
                        <div class="check">
                            <label for="youEmail" class="required">이메일 *</label>
                            <input type="email" name="youEmail" id="youEmail" placeholder="이메일을 입력하세요" class="input__style">
                            <div class="btn" onclick="emailChecking()">이메일 중복 검사</div>
                        </div>
                        <p class="msg" id="memberEmailMsg"></p>
                        <div>
                            <label for="youPhone" class="required blind">연락처</label>
                            <input type="text" id="youPhone" name="youPhone" placeholder="연락처를 적어주세요!" class="input__style">
                        </div>
                        <button type="submit" id="submitBtn" class="join_btn btn-style3">회원가입 완료</button>
                    </fieldset>
                </form>
            </div>

        </section>
    
    
    </main>
    <!-- //main-->

    <?php include "../include/footer.php"?>
    <!-- //footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../script/commons.js"></script>
    <script>
        let isIdCheck = false;
        let isEmailCheck  = false;

        function idChecking(){
            let youId = $("#youId").val();

            if(youId == null || youId ==''){
                $("#youIdComment").text("-> 아이디를 입력해주세요.")
            } else {
                let getYouId = RegExp(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_-]{4,20}$/);

                if(!getYouId.test($("#youId").val())){
                    $("#youIdComment").text("아이디는 영어와 숫자를 포함하여 4~20글자 이내로 작성해야 합니다.")
                    $("#youId").val('')
                    $("#youId").focus();
                    return false;
                } else {
                    $("#youIdComment").text("멋진 아이디입니다.");
                    $("#youIdComment").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: {"youId": youId, "type": "isIdCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good"){
                            $("#youIdComment").text("사용 가능한 아이디입니다.");
                            isIdCheck = true;
                        } else {
                            $("#youIdComment").removeClass("green");
                            $("#youIdComment").text("이미 존재하는 아이디입니다.");
                            isIdCheck = false;
                        }
                    }
                })
            }
        }

        function emailChecking(){
            let youId = $("#youEmail").val();

            if(youEmail == null || youEmail ==''){
                $("#memberEmailMsg").text("-> 이메일을 입력해주세요.")
            } else {
                let getYouEmail = RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/);

                if(!getYouEmail.test($("#youEmail").val())){
                    $("#memberEmailMsg").text("이메일을 형식에 맞게 작성해주세요")
                    $("#youEmail").val('')
                    $("#youEmail").focus();
                    return false;
                } else {
                    $("#memberEmailMsg").text("사용 가능한 이메일입니다.");
                    $("#memberEmailMsg").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: {"youEmail": youEmail, "type": "isEmailCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good"){
                            $("#memberEmailMsg").text("사용 가능한 이메일입니다.");
                            isEmailCheck = true;
                        } else {
                            $("#memberEmailMsg").removeClass("green");
                            $("#memberEmailMsg").text("이미 존재하는 이메일입니다.");
                            isEmailCheck = false;
                        }
                    }
                })
            }
        }


        function joinChecks(){

            if( $("#youId").val() == '' ){
                $("#youIdComment").text("-> 아이디를 작성해주세요.")
                $("#youId").focus();
                return false;
            } else {
                if( $("#youEmail").val() == '' ){
                    $("#memberEmailMsg").text("-> 이메일을 작성해주세요.")
                    $("#youEmail").focus();
                    return false;
                }
            }
        }
    </script>
</body>
</html>