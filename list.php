<?php
  include_once "db/db_board.php";
  session_start();
  $nm = ""; // $nm = ""; < 변수초기화 //isset : 변수가 설정되었는지 확인하는 함수
  if(isset($_SESSION["login_user"])){//$_SESSION 함수에 변수가 설정되어있으면
    $login_user = $_SESSION["login_user"];
    $nm = $login_user["nm"];//데이터베이스에 있는 유저이름 가져오기
  }

  $page = 1;
  if(isset($_GET["page"])) {
      $page = intval($_GET["page"]);
      //intval : 문자열을 강제로 정수형으로 바꾸는 함수 
  }
 
  $search_txt = "";
  $headerTitle = "자유게시판";
  if(isset($_GET["search_txt"])) {
      $search_txt = $_GET["search_txt"];
      $headerTitle = " ' ${search_txt} ' 의 검색결과 ";
  }
  
  $row_count = 15;//페이지당 보일 게시글(레코드) 수
  $param = [ //키값과 변수명을 새로 지정함
    "row_count" => $row_count,
    "start_idx" => ($page - 1) * $row_count,
    "search_txt" => $search_txt
  ];
  // 위에서 설정한 param값을 db_board의 sel_pagin_count로 보냄
  $paging_count = sel_paging_count($param); 
  $list = sel_board_list($param); // db_board.php
 
  
  include_once "head.php";
?>

<body>
  <div class="container">
    <header class="mb-4 d-flex align-items-center flex-column"> <!--삼항식 >  조건 ? 참 : 거짓 -->
      <div class="text-center mt-3">
        <a href="list.php"><img class="w400" src="./img/logo.png" alt=""></a>
      </div>
    <?php
        if(isset($_SESSION["login_user"])) {
          $session_img = $_SESSION["login_user"]["profile_img"];
          $profile_img =$session_img == null ? "basic.jpg" : $_SESSION["login_user"]["i_user"]."/".$session_img;
        }
      ?>
      <div id ="link" class=" nav justify-content-center text-center">
        <a href = "list.php" class=" nav-item">게시판</a>
        <?php if(isset($_SESSION["login_user"])){//로그인이 된 상태일 때 ?>
          <a href="write.php" class="nav-item" >글쓰기</a>
          <button type="button" class="btn nav-item" data-bs-toggle="modal" data-bs-target="#profileBtnModal">프로필</button>
          <a href="logout.php" class="nav-item" >로그아웃</a>
        <?php } else { // 로그인이 안된 상태일 때 ?>
          <button type="button" class="btn nav-item" data-bs-toggle="modal" data-bs-target="#loginBtnModal">로그인</button>
        <?php } ?>
      </div>

      <!--if(로그인) { 프로필 사진, 환영문구 }-->
      <?php if(isset($_SESSION["login_user"])) { ?>
        <div class="d-flex align-items-center w300 justify-content-center shadow p-2 my-4 bg-body rounded" id="refreshing">
          <div class="circular_img wh45 me-3">
            <img src="img/profile/<?=$profile_img?>" onerror="this.onerror=null; this.src='img/profile/basic.jpg'" alt="프로필이미지">
          </div>
          <div class="fs-6 "> <?=$nm?> 님 환영합니다.</div>
        </div>
      <?php } ?>
    </header>

    <main>
      <div class="header_title">
        <h1><?=$headerTitle?></h1>
      </div>
      <div>
        <form action="list.php" method="get" class="d-flex justify-content-end">
          <div class="d-flex w400">
           
            
            <input type="search" class="form-control mx-2" name="search_txt" value="<?=$search_txt?>">
            <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>  
          </div>
        </form>
      </div>
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th>NO.</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성일시</th>
            <th>조회수</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($list as $item) { //배열의 원소나, 객체의 프로퍼티 만큼 반복?>
            <tr>
              <td><?=$item["i_board"]?></td>
              <td class="text-left" >
                <a href="detail.php?i_board=<?=$item["i_board"]?>&page=<?=$page?><?= $search_txt !== "" ? "&search_txt=" . $search_txt : "" ?>">
                  <?=str_replace($search_txt, "<mark>{$search_txt}</mark>", $item["title"])?>
                </a>
              </td> <!--str_replace : 문자열을 바꾸는 함수, str_replace("찾는 문자", "대체할 문자", "바꾸고자 하는 문자열")-->
              <td>
                <?=str_replace($search_txt, "<mark>{$search_txt}</mark>", $item["nm"])?>
              </td>
              <td class="t-gray"><?=$item["created_at"]?></td>

              <td class="t-gray"><?=$item["view_at"]?></td>
            </tr> 
    
          <?php } ?>
      </tbody>
    </table>
    <div class="pagination pagination-sm justify-content-center"><!--페이징-->
      <?php for($i=1; $i<=$paging_count; $i++) { ?> 
        <span class="<?= $i==$page ? "page-item active" : "page-item" ?>">
          <a class="page-link" href="list.php?page=<?=$i?><?= $search_txt !== "" ? "&search_txt=" . $search_txt  : "" ?>"><?=$i?></a>
        </span>    
      <?php } ?>
    </div>
    </main>

    
  </div>
  <?php
    include_once "footer.php";
    include_once "loginModal.php";
    include_once "profileModal.php";
  ?>

</body>
</html>