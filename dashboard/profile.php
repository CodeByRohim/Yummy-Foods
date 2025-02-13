<?php
include_once "../inc/BackendHeader.php";
?>


<h1>Your Profile</h1>
<div class="row">
  <div class="col-lg-8">
    <div class="card rounded-0 shadow">
      <div class="card-header">Profile Info</div>
      <div class="card-body">
        <form action="../controller/ProfileInfoUpdateController.php" method="POST" enctype="multipart/form-data">
          <div class="row align-items-center">
            <div class="col-lg-4 text-center ">
              <label class="d-block" for="profile-img-input"><img  src="<?= getProfileUrl($fullname) ?>" alt="" class="profile_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center">
              </label>
              <input name="profile_img" class="d-none" id="profile-img-input" type="file">
              <span class="text-danger"><?= $_SESSION['errors']['profile_error'] ?? '' ?></span>

            </div>
            <div class="col-lg-8">
                  <input class="form-control mt-2" name="first_name" type="text" placeholder="First Name" value="<?= $_SESSION['user']['first_name'] ?>">
                  <span class="text-danger"><?= $_SESSION['errors']['first-name'] ?? ''?> </span>
                  <input class="form-control mt-2" name="last_name" type="text" placeholder="Last Name" value="<?= $_SESSION['user']['last_name'] ?>">
                  <span class="text-danger"><?= $_SESSION['errors']['last-name'] ?? ''?> </span>
                  <input class="form-control mt-2" name="email" type="email" placeholder="Email" value="<?= $_SESSION['user']['email'] ?>">
                  <span class="text-danger"><?= $_SESSION['errors']['email'] ?? ''?> </span>
               <button class="btn btn-primary mt-3" type="submit">Update Profile</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
  <div class="card rounded-0 shadow">
      <div class="card-header">Update Password</div>
      <div class="card-body">
        <form action="../controller/PasswordUpdateController.php" method="POST">        
            <input class="form-control mt-2" name="old_password" type="password" placeholder="Old Password">
            <span class="text-danger"><?= $_SESSION['errors']['old_password'] ?? '' ?></span>
            <input class="form-control mt-2" name="new_password" type="password" placeholder="New Password">
            <span class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></span>

            <input class="form-control mt-2" name="confirm_password" type="password" placeholder="Confirm Password">
            <span class="text-danger"><?= $_SESSION['errors']['confirm_password'] ?? '' ?></span>

            <button class="btn btn-primary mt-3" type="submit">Update Password</button>        
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include_once "../inc/BackendFooter.php";
unset($_SESSION['errors']);
?>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
<script>
  $(document).ready(function(){
    $('#profile-img-input').change(function(){
      let file = $(this)[0].files[0];
      let url = URL.createObjectURL(file);
      $('.profile_image').attr('src', url); 
    });
  });
</script>
