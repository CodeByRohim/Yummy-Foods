<?php 
session_start();
require "../database/env.php";

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$errors = [];
$user = [];
// EMAIL VALIDATION
if (empty($email)) {
    $errors['email'] = "Please enter your email.";
    
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}

// PASSWORD VALIDATION
if (empty($password)) {
    $errors['password'] = "Please enter your password.";
}

// Check if email exists in the database
$query = "SELECT * from users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if($result->num_rows == 0){
    $errors['email'] = "Email not found.";
} else{
   $user = mysqli_fetch_assoc($result);
  if(!password_verify($password,$user['password'])){
   $errors['password'] = "Invalid password.";
   
  }
}
if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: ../login.php");
} else{
    $_SESSION['user'] = $user;  //session save user from register User Controller
    header("Location: ../dashboard/index.php");
    
}
?>
