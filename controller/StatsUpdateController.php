<?php
session_start();
include "../database/env.php";

$clients = $_REQUEST['clients'];
$projects = $_REQUEST['projects'];
$support = $_REQUEST['support'];
$workers = $_REQUEST['workers'];
$stats_img = $_FILES['stats_img'];
$id = $_SESSION['stats']['id'];
$_SESSION['stats'] = $_REQUEST;
$errors = [];

$extension = pathinfo($stats_img['name'])['extension'];

define('ALLOWED_EXTENSIONS',['jpg','png','jpeg']);
define('MAX_UPLOAD_SIZE', 1024 * 1024 ); // 2MB


if($stats_img['size'] > 0){
  if(!in_array($extension, ALLOWED_EXTENSIONS)){
 $errors['stats_error'] = "Only" . ' ' . implode(', ', ALLOWED_EXTENSIONS) . ' ' . "file types are allowed.";
  } else if($stats_img['size'] > MAX_UPLOAD_SIZE){
 $errors['stats_error'] = "File size is too large.";
  } 
  }
  
  // File upload directory
  if($stats_img['size'] > 0){
    if(!file_exists('../uploads/stats')){
      mkdir('../uploads/stats',0777,true);
    }

// if previous img not found
    $filename = 'stats-' . substr(uniqid(rand(),1),0,3) . '.' . $extension;
    $upload = move_uploaded_file($stats_img['tmp_name'], "../uploads/stats/$filename");
    
    if(!$upload){
      $errors['stats_error'] = "Failed to upload file.";
    } 
  } else {
    $query ="UPDATE stat SET clients='$clients',projects='$projects',support='$support',workers='$workers'";
    $result = mysqli_query($conn, $query);
   }


  // IF ERRORS OCCURED
  if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/tables.php#stats');
    exit();
  } else{

    // update or insert
     $dataExits = false;
     $query = "SELECT * FROM stat LIMIT 1";
     $result = mysqli_query($conn, $query);

     
     if($result->num_rows > 0){
    // update
    $getStats = mysqli_fetch_assoc($result);
    $oldFilename = '../uploads/stats/' . '/' . $getStats['stats_img'];
    // prev img delete
    if($stats_img['size'] > 0 && $getStats['stats_img']){
      unlink( $oldFilename);
    }
    if($stats_img['size'] > 0){
      $query = "UPDATE stat SET clients='$clients',projects='$projects',support='$support',workers='$workers',stats_img='$filename'";
    } else{
      $query = "UPDATE stat SET clients='$clients',projects='$projects',support='$support',workers='$workers'";
    }
    
    } else{
      // create
      $query ="INSERT INTO stat (clients,projects,support,workers,stats_img) VALUES ('$clients','$projects','$support','$workers','$filename')";
    }

    $result = mysqli_query($conn, $query);
    $_SESSION['stats']['stats_img'] = $filename;
    header("Location: ../index.php#stats");
  }
  ?>