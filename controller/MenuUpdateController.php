<?php
session_start();
$menu_name = $_REQUEST['menu_name'];
$menu_price = $_REQUEST['menu_price'];
$menu_details = $_REQUEST['menu_details'];
$menu_img = $_FILES['menu_img'];
$_SESSION['menu'] = $_REQUEST;
// $id = $_SESSION['menu']['id'];
$id = $_REQUEST['id'];
$errors = [];
$extension = pathinfo($menu_img['name'])['extension'];
define('ALLOWED_EXTENSIONS',['jpg','png','jpeg']);
define('MAX_UPLOAD_SIZE', 1024 * 1024 ); // 2MB


include "../database/env.php";
if($menu_img['size'] > 0){
  if(!in_array($extension, ALLOWED_EXTENSIONS)){
 $errors['menu_error'] = "Only" . ' ' . implode(', ', ALLOWED_EXTENSIONS) . ' ' . "file types are allowed.";
  } else if($menu_img['size'] > MAX_UPLOAD_SIZE){
 $errors['menu_error'] = "File size is too large.";
  } else{

  }
  }
  

  if($menu_img['size'] > 0){
    if(!file_exists('../uploads/menu')){
      mkdir('../uploads/menu',0777,true);
    }
    $filename = 'menu' . ' ' . substr(uniqid(rand(),1),0,3) . '.' . $extension;
    $upload = move_uploaded_file($menu_img['tmp_name'], "../uploads/menu/$filename");
    
    if(!$upload){
      $errors['menu_error'] = "Failed to upload file.";
    } else {
     $query ="INSERT INTO menu( menu_name, menu_price, menu_details, ) VALUES ($menu_name','$menu_price','$menu_details')";
    }
  }


  // IF ERRORS OCCURED
  if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/tables.php#menu');
  } else{
    $query ="INSERT INTO menu (menu_img,menu_name,menu_price,menu_details) VALUES ('$filename','$menu_name','$menu_price','$menu_details')";
    $result = mysqli_query($conn, $query);
      header("Location: ../index.php#menu");
  }
  ?>
