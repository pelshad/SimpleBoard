
<div class="h200">
    <div class="header_top d-flex justify-content-end">
        <?php if(isset($_SESSION["login_user"])){//로그인이 된 상태일 때 ?>
          <a href="write.php" class="nav-item me-3" >글쓰기</a>
          <a href="profile.php" class="nav-item me-3">프로필</a>
          <a href="logout.php" class="nav-item me-3" >로그아웃</a>
        <?php } else { // 로그인이 안된 상태일 때 ?>
            <!-- <a href = "login.php" class="nav-item">로그인</a> -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#loginBtnModal">로그인</button>
        <?php } ?>
    </div>
      
    <div class="  text-center my-3" >
        <a href="list.php"><img style="width:300px;" src="./img/logo.png" alt="H.project.logo"></a>
    </div>
</div>

<?php include_once "loginModal.php"?>