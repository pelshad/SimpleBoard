<?php //게시글 디테일, PK 값이 필요하다.
  include_once "db/db_board.php";
  session_start();// login_proc.php 에서 선언한 $login_user
  if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
    //db_user에서 설정한 함수 sel_user가 담겨져있다.
    // 아이디와 비밀번호를 true검사를 모두 통과한 세션 = 로그인한 유저라는 뜻
  }
  $i_board = $_GET["i_board"];
  $page = $_GET["page"];

  $search_txt = "";
  if(isset($_GET["search_txt"])) {
      $search_txt = $_GET["search_txt"];
  }

  $param = [
      "i_board" => $i_board // PK를 가져오는 부분
  ];
  $item = sel_board($param);
  $next_board = sel_next_board($param);
  $prev_board = sel_prev_board($param);
  $view_up = view_up($param);
  include_once "head.php";
 
?>


<body>
  <div class="container">
    <?php include_once "header.php"; ?>
    <h3 class="mb-4"><?=str_replace($search_txt, "<mark>{$search_txt}</mark>", $item["title"])?></h3>
    <div>
      <?php
          if(isset($_SESSION["login_User"])) {
            $session_img = $_SESSION["login_user"]["profile_img"];
          }

          $i_profile_img = $item["profile_img"] == null ? "basic.jpg" : $item["i_user"] . "/" . $item["profile_img"];
      ?>

      <div class="d-flex .align-items-start">
        <div class="circular_img wh45 me-2">
          <img src="img/profile/<?=$i_profile_img?>" onerror="this.onerror=null; this.src='img/profile/basic.jpg'" alt="프로필이미지">
        </div>
        <div class="d-inline-block" style="height:45px;">
          <div class="bold"><?=$item["nm"]?></div>
          <div class="t-gray"><?=$item["created_at"]?></div>
        </div>
      </div>
    </div>

 

    <div class="d-flex justify-content-between my-3">
      <!--isset(로그인한 유저가 맞다면) &&(and) 현재 로그인 중인 유저의 i_user === 글이 작성됐을 때 사용된 i_user-->
      <div>
          <?php if(isset($_SESSION["login_user"]) && $login_user["i_user"] === $item["i_user"]) { ?>
            <!--위 조건이 통과가 되면 아래 양식이 출력된다.-->
              <a href="mod.php?i_board=<?=$i_board?>&page=<?=$page?>"><button class="btn">수정</button></a>
              <button class="btn" onclick="isDel();">삭제</button>
          <?php } ?>
      </div>
      <div class="prev_next">
          <?php if($prev_board !== 0) { ?>
          <a href="detail.php?i_board=<?=$prev_board?>&page=<?=$page?>"><button class="btn">이전글</button></a>
          <?php } ?>
          <?php if($next_board !== 0) { ?>
          <a href="detail.php?i_board=<?=$next_board?>&page=<?=$page?>"><button class="btn">최신글</button></a>
          <?php } ?>
      </div>
    </div>

    <div class="main_ctnt p-5"><?=$item["ctnt"]?></div>

    <div class="mb-3 text-center">
      <a style="color:#4b4b4b;" href="list.php?page=<?=$page?><?= $search_txt !== "" ? "&search_txt=" . $search_txt : "" ?>">뒤로가기</a>
    </div>


    <script>
      
      function isDel() {
        console.log('isDel 실행');  

        const result = confirm('삭제하시겠습니까?');
        if(result) {
          location.href="del.php?i_board=<?=$i_board?>";
          // result = true 일때 del.php 로 i_board 값 보내주기
        }
      }
        
    </script>
  </div>
  <?php include_once "footer.php" ?>

</body>
</html>