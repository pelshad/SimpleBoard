

<div class="modal fade " id="loginBtnModal" tabindex="-1" aria-labelledby="loginBtnModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mt-2 me-2">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="text-center my-3">
        <img src="./img/logo.png" class="modal-title w200 d-inline-block" id="loginBtnModalLabel">
      </div>
      <div class="modal-body">
        <form action="login_proc.php" method="post">
          <div class="mb-3">
            <input type="text" name="uid" class="form-control w400 m-auto p-2" placeholder="ID">
          </div>
          <div class="mb-3">
            <input type="password" name="upw" class="form-control w400 m-auto p-2"  placeholder="PASSWORD">
          </div>

        <div class="text-center">
          <a href="join.php" class="t-gray">회원가입</a>
        </div>
      </div>
      <div class="d-flex justify-content-center mt-3 mb-5">
        <button type="submit" class="btn btn-dark w400 p-2">로그인</button>
      </div>
      </form>
    </div>
  </div>
</div>