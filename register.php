 
 <?php 
 session_start();
 include_once "./inc/AuthHeader.php";

 ?>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div style="background-image: url(https://plus.unsplash.com/premium_photo-1686090448301-4c453ee74718?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cmVzdGF1cmFudHxlbnwwfHwwfHx8MA%3D%3D);" class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="./controller/RegisterUserController.php" method="POST" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="first_name" type="text" class="form-control <?= isset($_SESSION['errors']['first_name']) ? 'is-invalid' : ''?> form-control-user" id="exampleFirstName"
                                            placeholder="First Name">
                                            <span class="text-danger"><?= $_SESSION['errors']['first_name'] ?? '' ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="last_name" type="text" class="form-control <?= isset($_SESSION['errors']['last_name']) ? 'is-invalid' : ''?> form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : ''?> form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                        <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control <?= isset($_SESSION['errors']['password']) ? 'is-invalid' : ''?> form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            <span class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></span>

                                    </div>
                                    <div class="col-sm-6">
                                        <input name="confirmPassword" type="password" class="form-control <?= isset($_SESSION['errors']['confirmPassword']) ? 'is-invalid' : ''?> form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            <span class="text-danger"><?= $_SESSION['errors']['confirmPassword'] ?? '' ?></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
include_once "./inc/AuthFooter.php";
session_unset();
?>

   