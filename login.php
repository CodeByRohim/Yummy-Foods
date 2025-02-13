
<?php 
session_start();
include_once "./inc/AuthHeader.php";
?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div style="background-image: url(https://images.unsplash.com/photo-1551218808-94e220e084d2?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHJlc3RhdXJhbnR8ZW58MHx8MHx8fDA%3D);" class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="./controller/LoginUserController.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control <?= isset($_SESSION['errors']['password']) ? 'is-invalid' : ''?> form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                                <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control <?= isset($_SESSION['errors']['password']) ? 'is-invalid' : ''?> form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                                <span class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></span>
                                        </div>
                                        <span class="text-danger"><?= ($_SESSION['errors']['inpassword'] ?? '') . ($_SESSION['errors']['inemail'] ?? '') ?></span>
                                        
                                         <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input  type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> 
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="index.php" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
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
    