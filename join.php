
<?php include_once "head.php"?>

<body id="joinPage">
  <div id="refreshing">
  <div class="text-center mt-5 mb-3" >
    <a href="list.php"><img style="width:300px;" src="./img/logo.png" alt="H.project.logo"></a>
  </div>
  <div id="joinForm">
    <p>회원가입</p>
    <form action="join_proc.php" method="post">

      <div class="mb-4"><input class="form-control" type="text" name="nm" placeholder="이름"></div>

      <div class="mb-4"><input class="form-control" type="text" name="uid" placeholder="아이디"></div>

      <div class="mb-4 h100">
        <input class="form-control mb-4" type="password" id="upw" name="upw" placeholder="비밀번호" onchange="check_pw();">
        <input class="form-control" type="password" id="confirm_upw" name="confirm_upw" placeholder="비밀번호 확인" onchange="check_pw();">
        <p id="check"></p>
      </div>


      <div id="genderCheck">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="inlineRadio1" name="gender" value="0">
          <label class="form-check-label" for="inlineRadio1">여성</label>
        </div>
        <div class="form-check form-check-inline mb-4">
          <input class="form-check-input" type="radio" id="inlineRadio2" name="gender" value="1">
          <label class="form-check-label" for="inlineRadio2">남성</label>
        </div>
      </div>
      <div class="btnStyle">
        <input id="joinBtn" type="submit" class="btn mx-2" value="회원가입">
        <input type="reset" class="btn mx-2" value="초기화">
      </div>
    </form>
  </div>

  <?php include_once "footer.php"; ?>

  <script>
        function check_pw(){
            const upw = document.getElementById('upw').value;
            const confirm_upw = document.getElementById('confirm_upw').value;
            const check = document.getElementById('check');
            const joinBtn = document.getElementById('joinBtn');
 
            if(upw !=='' && confirm_upw !==''){
                if(upw === confirm_upw){
                  check.innerHTML='비밀번호가 일치합니다.'
                  check.style.color='gray';
                  check.style.fontSize='0.7rem';
                  joinBtn.disabled = false;
                }
                else{
                  check.innerHTML='비밀번호가 일치하지 않습니다.';
                  check.style.color='red';
                  check.style.fontSize='0.7rem';
                  joinBtn.disabled = true;

                }
            }
        }
    </script>
    </div>
</body>
</html> 

