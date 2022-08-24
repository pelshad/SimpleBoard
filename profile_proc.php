<?php //사용자가 업로드 한 이미지를 각 개인의 폴더를 만들어 저장한다.
    include_once "db/db_user.php";
    session_start();
    define("PROFILE_PATH", "img/profile/");
    //^ 경로설정
    $login_user = &$_SESSION["login_user"];
    //& = 얕은 복사 : 주소값만 복사해옴
    //var_dump($_FILES); << 변수의 정보를 출력하는 함수 : 개발 당시에 확인용, 실제로 사용할 때에는 주석처리
   if($_FILES["img"]["name"] === "") {
        //echo "이미지 없음";//img ~ 이미지 첨부하는 input에서 설정한 name과 동일하게 설정
       header("location:list.php");
   }

    function gen_uuid_v4() { //UUID : 네트워크 상에서 고유성이 보장되는 id를 만들기 위한 표준 규약
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0x0fff) | 0x4000
            , mt_rand(0, 0x3fff) | 0x8000
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff) 
        ); //UUID를 직접 만드는 함수
    }
    $img_name = $_FILES["img"]["name"];
    $last_index = mb_strrpos($img_name, ".");//$img_name의 문자열에서 "."를 뒤에서 부터 찾고 리턴함
    $ext = mb_substr($img_name, $last_index);//문자열 자르기
    // $ext = 이미지 확장자명이 담겼다 ex).jpg / .png 
    $target_filenm = gen_uuid_v4() . $ext;//. <문자열합치기
    $target_full_path = PROFILE_PATH . $login_user["i_user"];
    if(!is_dir($target_full_path)) {
        mkdir($target_full_path, 0777, true);//mkdir : 디렉토리 생성
    }

    $tmp_img = $_FILES['img']['tmp_name'];//임시파일명, 폴더, 파일명
    $imageUpload = move_uploaded_file($tmp_img, $target_full_path . "/" .$target_filenm);
    
    if($imageUpload) { //업로드 성공!
        //이전에 등록된 프사가 있다면 삭제 후 새 프사로 업데이트하기
        if($login_user["profile_img"]){
          $saved_img = $target_full_path ."/". $login_user["profile_img"];
          if(file_exists($saved_img)){ //참과 거짓을 구분할 수 있는 함수?  => boolean 타입 =>if문에 넣을 수 있다.
            unlink($saved_img);//php 파일삭제 명령어
          }
        }
        //DB에 저장!
        $param = [
          "profile_img" => $target_filenm,
          "i_user" => $login_user["i_user"],
        ];
        $result = upd_profile_img($param);
        $login_user["profile_img"] = $target_filenm;
        $_SESSION["login_user"] = $login_user;
        Header("Location: list.php");

       

      }else {
        echo "업로드 실패";
     }
    
