
<div class="modal fade" id="profileBtnModal" tabindex="-1" aria-labelledby="profileBtnModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mt-2 me-2">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="text-center my-3">
        <img src="img/logo.png" class="modal-title w200 d-inline-block" id="profileBtnModalLabel">
      </div>

      <div class="modal-body d-flex align-items-center flex-column">
        <div id="userProfile_img" class="mb-2" >
          <img src="img/profile/<?=$profile_img?>" class="circular_img w100 h100" id="user_image" onerror="this.onerror=null; this.src='img/profile/basic.jpg'" alt="프로필이미지">
        </div>
        <span class="t-gray d-block mb-5">이미지 변경을 원하시면 프로필 이미지를 클릭해주세요.</span>
        <form action="profile_proc.php" method="post" enctype="multipart/form-data" id="profileForm">
          <div class="d-none"><input type="file" name="img" accept="image/*" id="user_profile_img"></div>
          <div class="mb-5 btnStyle">
            <button type="submit" class="btn btn-lg">저장</button>
            <button type="button" class="btn btn-lg" data-bs-dismiss="modal">취소</button>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>

<script>
  const profileImg = document.querySelector('#userProfile_img');
  const profileElem = document.querySelector('#profileForm');

   profileImg.addEventListener('click', function() {
      profileElem.img.click();

      profileElem.addEventListener('change', function(e) { // 파일 값이 변하면
        if(e.target.files.length > 0) {
          preview = new FileReader();
          preview.onload = function(){ //프로필 이미지 src를 선택한 이미지 preview 보여주기
            document.getElementById("user_image").src = preview.result;            
          }
          preview.readAsDataURL(profileElem.img.files[0]);
        }
      });
    });
    
</script>
