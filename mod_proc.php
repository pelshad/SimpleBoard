<?php
  include_once "db/db_board.php";
  
  session_start();
  $login_user = $_SESSION["login_user"];

  $page = $_POST['page'];
  $i_board = $_POST["i_board"];
  $title = $_POST["title"];
  $ctnt= $_POST["ctnt"];
  $i_user = $login_user["i_user"];

  $param = [
    "i_board" => $i_board,
    "title" => $title,
    "ctnt" => $ctnt,
    "i_user" => $i_user,
  ];

  $result = upd_board($param);
  if($result){header("Location:detail.php?i_board=$i_board&page=$page");}
?>