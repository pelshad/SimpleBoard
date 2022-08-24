<?php
include_once "db.php";

function ins_board(&$param)//특정값을 뽑아오기 위해 파라미터를 지정
{
  $title = $param["title"];
  $ctnt = $param["ctnt"];
  $i_user = $param["i_user"];

  $conn = get_conn();
  $sql =
  " INSERT INTO t_board
    (title, ctnt, i_user)
    VALUES
    ('$title', '$ctnt', $i_user)
  ";

  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}
//list.php, 페이징
function sel_paging_count(&$param) {
        $sql = "SELECT CEIL(COUNT(i_board) / {$param["row_count"]}) as cnt
                FROM t_board";

        if($param["search_txt"] !== "") {
            $sql .= " WHERE title LIKE '%{$param["search_txt"]}%' ";            
        }

        $conn = get_conn();        
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn); 
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }

    
// 리스트 형식으로 보여질 페이지에 쓰일 함수
// list.php
function sel_board_list(&$param){
  $start_idx = $param["start_idx"];
  $row_count = $param["row_count"];
  $sql = "SELECT A.i_board, A.title, A.i_user, A.created_at, A.view_at
                ,B.nm, B.profile_img 
          FROM t_board A
          INNER JOIN t_user B
          ON A.i_user = B.i_user
          WHERE A.title LIKE '%{$param["search_txt"]}%'
          OR B.nm LIKE '%{$param["search_txt"]}%'
          ORDER BY A.i_board DESC
          LIMIT {$param["start_idx"]}, {$param["row_count"]}";

  $conn = get_conn();
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}

function sel_board(&$param) {
  $i_board = $param["i_board"];
  $sql = "SELECT  A.title, A.ctnt, A.created_at, A.view_at
               , B.i_user, B.nm, B.profile_img
            FROM t_board A
      INNER JOIN t_user B
              ON A.i_user = B.i_user
           WHERE A.i_board = $i_board";
  $conn = get_conn();
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);        
  return mysqli_fetch_assoc($result);
}
//조회수
function view_up(&$param){
  $conn = get_conn();
  $i_board = $param["i_board"];
  $sql = "UPDATE t_board
          SET view_at = view_at + 1
          WHERE i_board = $i_board
          ";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}

//최신글
function sel_next_board(&$param)
{
  $i_board = $param["i_board"];
  $sql =
  "SELECT i_board
     FROM t_board
    WHERE i_board > $i_board
 ORDER BY i_board
    LIMIT   1
  ";

  $conn = get_conn();
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  $row = mysqli_fetch_assoc($result);
  if($row){
    return $row["i_board"];
  }
  return 0;
}

//지난글
function sel_prev_board(&$param) {
  $i_board = $param["i_board"];
  $sql = "SELECT i_board
            FROM t_board
           WHERE i_board < $i_board
           ORDER BY i_board DESC
           LIMIT 1";
  $conn = get_conn();
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);        
  $row = mysqli_fetch_assoc($result);
  if($row) {
      return $row["i_board"];
  }
  return 0;
}

function upd_board(&$param){
  $i_board = $param["i_board"];
  $title = $param["title"];
  $ctnt = $param["ctnt"];
  $i_user = $param["i_user"];

  $sql = 
  "UPDATE t_board
      SET title = '$title'
        , ctnt ='$ctnt'
        , updated_at = now()/*업데이트를 날짜를 항상 지금으로 */
    WHERE i_board = $i_board
      AND i_user = $i_user /* 로그인한 유저와 작성유저가 동일한지 확인 */
  ";

  $conn = get_conn();
  $result = mysqli_query($conn,$sql);
  mysqli_close($conn);
  return $result;
}

function del_board(&$param){
  $i_board = $param["i_board"];
  $i_user = $param["i_user"];
  $sql ="DELETE FROM t_board WHERE i_board = $i_board AND i_user = $i_user";
  $conn = get_conn(); //게시글 당사자만 지울 수 있도록 조건도 함께 걸어줬다.
  $result = mysqli_query($conn,$sql);
  mysqli_close($conn);
  return $result;
}


