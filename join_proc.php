<?php
  include_once "db/db_user.php";
  // 이전 페이지였던 join.php 에서 작성된 값들을 받아옴
  $uid = $_POST["uid"];
  $upw = $_POST["upw"];
  $confirm_upw = $_POST["confirm_upw"];
  $nm = $_POST["nm"];
  $gender = $_POST["gender"];

  $param = [ //키값을 만들고 변수명을 부여
    "uid" => $uid,
    "upw" => $upw,
    "nm" => $nm,
    "gender" => $gender,
  ];
  // 함수 호출 시 '='의 의미는 오른쪽값을 복사하여 왼쪽에 넣는다는 의미. 같다는 의미와는 다름
  $result = ins_user($param);
  //db_user 에서 insert문을 작성한 쿼리문이 포함된 함수에 키값을 설정한 #param 변수를 넣음

    header("Location:list.php");
?>