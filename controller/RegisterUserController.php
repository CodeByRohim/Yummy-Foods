<?php
session_start();
$first_name = $_REQUEST['fname'];
$last_name = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmPassword = $_REQUEST['confirmPassword'];
$encPassword = password_hash($password,PASSWORD_BCRYPT);

$errors = [];

// FIRST NAME VALIDATION
if (empty($first_name)) {
  $errors['first_name'] = "Please enter your first name";
} else if(strlen($first_name < 61)){
  $errors['first_name'] = "First name should not be more than 60 characters";
}
// EMAIL VALIDATION
if (empty($email)) {
  $errors['email'] = "Please enter your email";
} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors['email'] = "Invalid email format";
}
// PASSWORD VALIDATION
if (empty($password)) {
  $errors['password'] = "Please enter your password";;
}
if ($password != $confirmPassword) {
  $errors['confirmPassword'] = "Confirm password didn't match";
}

// IF ERROR OCCURS
if (count($errors) > 0){
  $_SESSION ['errors'] = $errors;
  header('Location: ../register.php');
} else{
  // CONNECT TO DATABASE STORE
  include "../database/env.php";
 $query = "INSERT INTO users(first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$encPassword')";
 $result = mysqli_query($conn, $query);

 if ($result) {
  $_SESSION['user'] = $_REQUEST;
  header("Location: ../dashboard/index.php");
 }
 
}