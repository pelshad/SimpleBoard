<?php
  // t_user 테이블에서 정보를 가져왔다.
  include_once "db/db_user.php";

  $uid = $_POST['uid'];//칼럼명을 부여한 인풋에 각각 입력된 데이터를 받아와
  $upw = $_POST['upw'];//각 변수에 저장. 변수명과 칼럼명은 달라도 된다.

 

  $param = [//$param 배열 중 키값 uid의 값을 $uid로 저장
    "uid" => $uid
  ];
  $result = sel_user($param); //위에서 설정한 $param 값을 넣은 것
  if(empty($result)){
      echo "해당하는 아이디 없음";
      die; //empty=비어있다. $result값이 비어 있다면. > $uid 값과 동일하지 않다면
  } // 해당 문구를 출력하고 함수를 종료한다.
  // 저장된 값들 중 맞는게 있다면 아래 내용으로 이동.

 

  //비밀번호가 맞으면 "list.php" 로 이동
  //비밀번호가 다르면 "login.php" 로 이동
 
  // $upw : 사용자가 입력한 비밀번호 === $result["upw"] :데이터 베이스에 저장된 비밀번호
  if($upw === $result["upw"]){
    session_start();//세션시작
    $_SESSION["login_user"] = $result;
    // 해당 세션을 만들고 $result에 저장, 후에 detail.php에서도 사용됨.
    // 즉 데이터베이스에 저장된 아이디와, 비밀번호로 로그인에 성공한 세션
    header("Location:list.php");
  }
  else{
    echo "<script>alert('Invalid username or password')</script>";
    echo "<script>location.replace('list.php');</script>";
    exit;
  }

  //SESSION : 웹 서버에 정보를 저장하고 사용자 측에서도 접근할 수 있는 키 값을 저장한다.
  //브라우저를 종료하는 시점에서 세션이 삭제가 되도록 설정 가능
  // 세션 변수 등록
  //$_SESSION['변수명'] = '데이터';
  // >> 변수명에 데이터 값을 저장한다.
?>