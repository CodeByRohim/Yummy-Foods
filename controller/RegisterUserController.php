<?php
session_start();
include "../database/env.php";
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmPassword = $_REQUEST['confirmPassword'];
$encPassword = password_hash($password,PASSWORD_BCRYPT);
$errors = [];


$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_assoc($result); 
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
} else {
  $query = "SELECT email FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  if(($result -> num_rows > 0)){
  $errors['email'] = "Email already exists";
  }
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
 $query = "INSERT INTO users(first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$encPassword')";
 $result = mysqli_query($conn, $query);

 if ($result) {
  $_SESSION['user'] = $_REQUEST;
  header("Location: ../dashboard/index.php");
 }
 
}