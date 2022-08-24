<?php 
//t_user = 고객정보 테이블 
//t_user 테이블에 데이터베이스를 입력하기 위한 파일
// 이 파일에서 함수를 미리 작성해놓고 필요한 파일마다 함수 호출
  include_once "db.php";

  // 사용자가 입력한 정보들을 t_user 테이블로 보내는 함수
  // join_proc.php 에서 사용
  function ins_user(&$param) { // &$변수 => 해당 변수를 참조한다는 뜻. 
    $uid = $param["uid"]; // $param = array(uid, upw, nm, gender)
    $upw = $param["upw"]; // 배열의 각 항목을 변수에 저장
    $nm = $param["nm"];
    $gender = $param["gender"];

    $conn = get_conn();
    $sql =
    " INSERT INTO t_user
      (uid, upw, nm, gender)
      VALUES
      ('$uid', '$upw', '$nm', '$gender')
    ";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }
   

  // 입력된 고객의 정보를 불러오고 확인하기 위한 함수
  //login_proc.php 에서 사용
  function sel_user(&$param)//언제든 수정가능하게 전체를 통틀어 부를 수 있는 변수명 사용
  {
    $uid = $param["uid"];
    $sql = 
    "SELECT i_user, uid, upw, nm, gender, profile_img
     FROM t_user
     WHERE uid = '$uid'
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
    //mysqli_fetch_assoc : mysqli_query 를 통해 얻은 result에서 레코드를 1개씩 리턴해주는 함수
  }

  //
  function upd_profile_img(&$param) {
    $sql = "UPDATE t_user 
               SET profile_img = '{$param["profile_img"]}' 
                  , nm = '{$param["nm"]}'
             WHERE i_user = {$param["i_user"]}";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
 }
?>