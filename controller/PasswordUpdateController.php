<?php
session_start();

$oldPassword = $_REQUEST['old_password'];
$password = $_REQUEST['new_password'];
$confirmPassword = $_REQUEST['confirm_password'];
$encPassword = password_hash($password,PASSWORD_BCRYPT);

$errors = [];

// PASSWORD VALIDATION
if (empty($oldPassword)) {
  $errors['old_password'] = "Please enter  old password";;
}

if (empty($password)) {
  $errors['password'] = "Please enter your password";;
}

if ($password != $confirmPassword) {
  $errors['confirm_password'] = "Confirm password didn't match";
}


// check if the old password is correct
if(!password_verify($oldPassword,$_SESSION['user']['password'])){
  // update the password
 $errors["old_password"] = "Old password is incorrect";
  
}

// IF ERROR OCCURS
if (count($errors) > 0){
  $_SESSION ['errors'] = $errors;
  header('Location: ../dashboard/profile.php');
} else{
  
  // CONNECT TO DATABASE STORE
  include_once "../database/env.php";
  $id = $_SESSION['user']['id'];
  $query = "UPDATE users SET password='$encPassword' WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $_SESSION['user']['password'] = $encPassword;
  header("Location: ../dashboard/index.php");
}