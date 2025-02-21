<?php

session_start();
$banner_img = $_FILES['banner_img'];
$extension = pathinfo($banner_img['name'])['extension'];
$banner_heading = $_REQUEST['banner_heading'];
$banner_para = $_REQUEST['banner_para'];
$banner_url = $_REQUEST['banner_url'];
$cta_text = $_REQUEST['cta_text'];
$cta_link = $_REQUEST['cta_link'];
$id = $_SESSION['banners']['id'];
$_SESSION['banners'] = $_REQUEST;
$errors = [];
// $filename = '';
include_once "../database/env.php";

// BANNER IMAGE VALIDATION
define('SELECTED_EXTENSIONS',['jpg', 'png', 'jpeg']);
$max_upload_size = 1024 * 1024 * 2; // 2MB

if($banner_img['size'] > 0){
  if($banner_img['size'] > $max_upload_size){
    $errors['banner_error'] = "banner image size should be less than 2MB";
  } elseif(!in_array($extension, SELECTED_EXTENSIONS)){
    $errors['banner_error'] = "Only" . ' ' . implode(',', SELECTED_EXTENSIONS) . ' ' . "files accept.";
  } else{

      // File upload directory 
      if(!file_exists('../uploads/banner')){
        mkdir('../uploads/banner',0777,true);
      }
      // new file name upload
      $filename = 'banner-' . substr(uniqid(rand(),1),0,3)  . '.' . $extension;

      // upload new img
      if(!move_uploaded_file($banner_img['tmp_name'], "../uploads/banner/$filename")){
        $errors['banner_error'] = "Failed to upload banner image";
      }
  }
} 


// BANNER HEADING VALIDATION
if (empty($banner_heading)) {
  $errors['banner_heading'] = "Please enter heading";
} else if(strlen($banner_heading) > 81){
  $errors['banner_heading'] = "Banner heading should not be more than 80 characters";
}
// BANNER PARA VALIDATION
if (empty($banner_para)) {
  $errors['banner_para'] = "Please enter your banner paragraph";
} else if(strlen($banner_para) > 101){
  $errors['banner_para'] = "Banner paragraph should not be more than 100 characters";
}
// CTA TEXT VALIDATION
if (empty($cta_text)) {
  $errors['cta_text'] = "Please enter your CTA text";
} else if(strlen($cta_text) > 61){
  $errors['cta_text'] = "CTA text should not be more than 60 characters";
}


// IF ERROR OCCURS
if (count($errors) > 0){
  $_SESSION ['errors'] = $errors;
  header('Location: ../dashboard/tables.php');
} 
  // update or insert query
  $dataExits = false;
  $query = "SELECT * FROM banners LIMIT 1";
  $result = mysqli_query($conn, $query);
 
  if($result->num_rows > 0){
     // update
     $getBanner = mysqli_fetch_assoc($result); 
     $oldFilename = '../uploads/banner' . '/' . $getBanner['banner_img'];

    // delete old banner image
     if($banner_img['size'] > 0 && !empty($getBanner['banner_img'])){
     unlink($oldFilename);
     } //imp

    if($banner_img['size'] > 0){
      $query = "UPDATE banners SET banner_heading='$banner_heading',
      banner_para='$banner_para',banner_img='$filename',
      cta_text='$cta_text',cta_link='$cta_link',banner_url='$banner_url'";
    } else {
      $query = "UPDATE banners SET banner_heading='$banner_heading',
      banner_para='$banner_para',
      cta_text='$cta_text',cta_link='$cta_link',banner_url='$banner_url'";
    } //imp
    
    
  } else {
   // create
  $query ="INSERT INTO banners (banner_heading, banner_para, banner_img, cta_text, cta_link, banner_url) VALUES ('$banner_heading','$banner_para','$filename','$cta_text','$cta_link','$banner_url')";
  }


  $result = mysqli_query($conn, $query);

  $_SESSION['banners']['banner_heading'] = $banner_heading;
  $_SESSION['banners']['banner_para'] = $banner_para;
  $_SESSION['banners']['banner_url'] = $banner_url;
  $_SESSION['banners']['cta_text'] = $cta_text;
  $_SESSION['banners']['cta_link'] = $cta_link;
  $_SESSION['banners']['banner_img'] = $filename;
  $_SESSION['banners']['banner_url'] = $banner_url;
  header("Location: ../index.php#banner");
  


