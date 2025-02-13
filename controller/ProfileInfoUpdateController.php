<?php
session_start();
$profile_img = $_FILES['profile_img'];
$max_upload_size = 1024 * 1024 * 1; // 1MB
$extension = pathinfo($profile_img['name'])['extension'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$email = $_REQUEST['email'];
$id = $_SESSION['user']['id'];
$errors = [];

// PROFILE IMAGE VALIDATION
define('SELECTED_EXTENSIONS',['jpg', 'png', 'jpeg']);

if($profile_img['size'] > 0){
  if($profile_img['size'] > $max_upload_size ){
    $errors['profile_error'] = "Profile image size should be less than 1MB";
  } elseif(!in_array($extension, SELECTED_EXTENSIONS)){
    $errors['profile_error'] = "Only" . ' ' . implode(',', SELECTED_EXTENSIONS) . ' ' . "files accept.";
  }
} 

// upload directory 
if($profile_img['size'] > 0){
    
  if(!file_exists('../uploads/users')){
    mkdir('../uploads/users');
  }
  $filename = 'Profile' . ' ' . substr(uniqid(rand(),1),0,3)  . '.' . $extension;
  $isUpload = move_uploaded_file($profile_img['tmp_name'], "../uploads/users/$filename");
} else {
  $query = "UPDATE users SET first_name='$first_name',last_name='$last_name',email='$email' WHERE id='$id'";
}




// FIRST NAME VALIDATION
if (empty($first_name)) {
  $errors['first_name'] = "Please enter your first name";
} else if(strlen($first_name < 61)){
  $errors['first_name'] = "First name should not be more than 60 characters";
}
// LASTT NAME VALIDATION
if (empty($last_name)) {
  $errors['last_name'] = "Please enter your last name";
} else if(strlen($last_name < 61)){
  $errors['last_name'] = "Last name should not be more than 60 characters";
}
// EMAIL VALIDATION
if (empty($email)) {
  $errors['email'] = "Please enter your email";
} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors['email'] = "Invalid email format";
} 


// IF ERROR OCCURS
if (count($errors) > 0){
  $_SESSION ['errors'] = $errors;
  header('Location: ../dashboard/profile.php');
} else{
  
  // CONNECT TO DATABASE STORE
  include_once "../database/env.php";
  $id = $_SESSION['user']['id'];
  $query = "UPDATE users SET first_name='$first_name',last_name='$last_name',email='$email',profile_img='$filename' WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $_SESSION['user']['first_name'] = $first_name;
  $_SESSION['user']['last_name'] = $last_name;
  $_SESSION['user']['email'] = $email;
  $_SESSION['user']['profile_img'] = $filename;
  header("Location: ../dashboard/profile.php");
}
  