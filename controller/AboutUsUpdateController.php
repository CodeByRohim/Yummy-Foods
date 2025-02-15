<?php
session_start();
$about_img = $_FILES['about_img'];
$about_title = $_REQUEST['about_title'];
$about_middle = $_REQUEST['about_middle'];
$about_bottom = $_REQUEST['about_bottom'];
$about_thumbnail = $_FILES['about_thumbnail'];
$video_url = $_REQUEST['video_url'];
$_SESSION['about'] = $_REQUEST;
$errors = [];

define('MAX_UPLOAD_SIZE', 1024 * 1024 * 2); 
define('ALLOWED_EXTENSIONS', ['jpg', 'png', 'jpeg', 'webp']);
$extension = pathinfo($about_img['name'])['extension'];
$extension2 = pathinfo($about_thumbnail['name'])['extension'];

// ABOUT US IMAGE VALIDATION
if($about_img['size'] > 0){ 
if($about_img['size'] > MAX_UPLOAD_SIZE){
  $errors['about_img'] = "Image size is too large. Please upload image less than 2MB.";
} else if(!in_array($extension, ALLOWED_EXTENSIONS)){
 $errors['about_img'] = "Invalid image format. Please upload image in" . implode(', ', ALLOWED_EXTENSIONS);
}
}

// ABOUT US THUMBNAIL VALIDATION
if($about_thumbnail['size'] > 0){
if($about_thumbnail['size'] > MAX_UPLOAD_SIZE){
  $errors['about_thumbnail'] = "Image size is too large. Please upload image less than 2MB.";
} else if(!in_array($extension2, ALLOWED_EXTENSIONS)){
  $errors['about_thumbnail'] = "Invalid image format. Please upload image in " . implode(',',ALLOWED_EXTENSIONS);
}
}

// ABOUT US TITLE VALIDATION
if (empty($about_title)) {
  $errors['about_title'] = "Please enter about title.";
} else if (strlen($about_title) < 10 || strlen($about_title) > 250) {
  $errors['about_title'] = "About title must be at least 3 characters long.";
}

// ABOUT US MIDDLE VALIDATION
if (empty($about_middle)) {
  $errors['about_middle'] = "Please enter about middle.";
} else if (strlen($about_middle) < 10 || strlen($about_middle) > 250){
  $errors['about_middle'] = "About middle must be at least 10 characters long.";
}

// ABOUT US MIDDLE VALIDATION
if (empty($about_bottom)) {
  $errors['about_bottom'] = "Please enter about bottom.";
} else if (strlen($about_bottom) < 10 || strlen($about_bottom) > 250){
  $errors['about_bottom'] = "About bottom must be at least 10 characters long.";
}

// Upload directory about img
if($about_img['size'] > 0){
  if(!file_exists('../uploads/aboutimg')){
    mkdir('../uploads/aboutimg', 0777, true);
  }
  $filename = 'about' . ' ' . substr(uniqid(rand(),1),0,3)  . '.' . $extension;
  $isUpload = move_uploaded_file($about_img['tmp_name'], "../uploads/aboutimg/$filename");
  if(!$isUpload){
    $errors['about_error'] = "Failed to upload about image";
  } 
} else{
  $query = "UPDATE about_us SET about_img='$about_img',about_title='$about_title',about_middle='$about_middle',about_bottom='$about_bottom',about_thumbnail='$about_thumbnail',video_url='$video_url' WHERE 1";
}

// Upload directory about img
if($about_thumbnail['size'] > 0){
  if(!file_exists('../uploads/aboutThumbnail')){
    mkdir('../uploads/aboutThumbnail', 0777, true);
}
$filename2 = 'about thumbnail' . ' ' . substr(uniqid(rand(),1),0,3)  . '.' . $extension2;

 $isUpload2 = move_uploaded_file($about_thumbnail['tmp_name'], "../uploads/aboutThumbnail/$filename2");
 if(!$isUpload2){
  $errors['about_thumbnail'] = "Failed to upload about thumbnail image";
 } 
} else{
  $query = "UPDATE about_us SET about_img='$about_img',about_title='$about_title',about_middle='$about_middle',about_bottom='$about_bottom',about_thumbnail='$about_thumbnail',video_url='$video_url' WHERE 1";
}


// IF ERRORS ARE FOUND
if(count($errors) > 0){
  $_SESSION['errors'] = $errors;
  header('Location: ../dashboard/tables.php#about');
}else {
// CONNECT TO DATABASE STORE
include_once "../database/env.php";
// $query = "INSERT INTO about_us (about_title, about_middle, about_img, about_bottom,about_thumbnail,video_url) VALUES ('$about_title', '$about_middle', '$filename', '$about_bottom', '$filename2', '$video_url')";
$query = "UPDATE about_us SET about_title='$about_title',about_middle ='$about_middle',about_bottom='$about_bottom',about_img='$filename',about_thumbnail='$filename2',video_url='$video_url'";
$result = mysqli_query($conn, $query);
$_SESSION['about']['about_heading'] = $about_title;
$_SESSION['about']['about_middle'] = $about_middle ;
$_SESSION['about']['about_bottom'] = $about_bottom;

$_SESSION['about']['about_img'] = $filename;
$_SESSION['about']['about_thumbnail'] = $filename2;
header("Location: ../index.php#about");
}