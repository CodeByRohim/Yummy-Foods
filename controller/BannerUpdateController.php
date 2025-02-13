<?php
session_start();
$banner_img = $_FILES['banner_img'];
$max_upload_size = 1024 * 1024 * 2; // 2MB
$extension = pathinfo($banner_img['name'])['extension'];
$banner_heading = $_REQUEST['banner_heading'];
$banner_para = $_REQUEST['banner_para'];
$id = $_SESSION['banners']['id'];
$_SESSION['banners'] = $_REQUEST;
$errors = [];

include_once "../database/env.php";
// BANNER IMAGE VALIDATION
define('SELECTED_EXTENSIONS',['jpg', 'png', 'jpeg']);

if($banner_img['size'] > 0){
  if($banner_img['size'] > $max_upload_size ){
    $errors['banner_error'] = "banner image size should be less than 2MB";
  } elseif(!in_array($extension, SELECTED_EXTENSIONS)){
    $errors['banner_error'] = "Only" . ' ' . implode(',', SELECTED_EXTENSIONS) . ' ' . "files accept.";
  } else{

  }
} 

// upload directory 
if($banner_img['size'] > 0){
    
  if(!file_exists('../uploads/banner')){
    mkdir('../uploads/banner',0777,true);
  }
  $filename = 'banner' . ' ' . substr(uniqid(rand(),1),0,3)  . '.' . $extension;
  
  $isUpload = move_uploaded_file($banner_img['tmp_name'], "../uploads/banner/$filename");
  if(!$isUpload){
    $errors['banner_error'] = "Failed to upload banner image";
  }
} else {
  $query = "UPDATE banners SET banner_heading='$banner_heading',banner_para ='$banner_para' WHERE id='$id'";
}

// BANNER HEADING VALIDATION
if (empty($banner_heading)) {
  $errors['banner_heading'] = "Please enter heading";
} else if(strlen($banner_heading < 81)){
  $errors['banner_heading'] = "Banner heading should not be more than 80 characters";
}
// BANNER PARA VALIDATION
if (empty($banner_para )) {
  $errors['banner_para'] = "Please enter your banner paragraph";
} else if(strlen($banner_para  < 101)){
  $errors['banner_para'] = "Banner paragraph should not be more than 100 characters";
}



// IF ERROR OCCURS
if (count($errors) > 0){
  $_SESSION ['errors'] = $errors;
  header('Location: ../dashboard/tables.php');
} else{
  
  // CONNECT TO DATABASE STORE
  
  // $query = "INSERT INTO banners (banner_heading, banner_para, banner_img) VALUES ('$banner_heading', '$banner_para', '$filename')";
  $query = "UPDATE banners SET banner_heading='$banner_heading',banner_para ='$banner_para',banner_img='$filename'";
  $result = mysqli_query($conn, $query);
  
  $_SESSION['banners']['banner_heading'] = $banner_heading;
  $_SESSION['banners']['banner_para'] = $banner_para ;
  $_SESSION['banners']['banner_img'] = $filename;
  header("Location: ../index.php#banner");
  
}
?>


  