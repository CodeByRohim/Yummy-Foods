<?php
session_start();
$clients = $_REQUEST['clients'];
$projects = $_REQUEST['projects'];
$support = $_REQUEST['support'];
$workers = $_REQUEST['workers'];
$stats_img = $_FILES['stats_img'];
$_SESSION['stats'] = $_REQUEST;
$id = $_SESSION['stats']['id'];
$errors = [];
$extension = pathinfo($stats_img['name'])['extension'];
define('ALLOWED_EXTENSIONS',['jpg','png','jpeg']);
define('MAX_UPLOAD_SIZE', 1024 * 1024 ); // 2MB


include "../database/env.php";
if($stats_img['size'] > 0){
  if(!in_array($extension, ALLOWED_EXTENSIONS)){
 $errors['stats_error'] = "Only" . ' ' . implode(', ', ALLOWED_EXTENSIONS) . ' ' . "file types are allowed.";
  } else if($stats_img['size'] > MAX_UPLOAD_SIZE){
 $errors['stats_error'] = "File size is too large.";
  } else{

  }
  }
  

  if($stats_img['size'] > 0){
    if(!file_exists('../uploads/stats')){
      mkdir('../uploads/stats',0777,true);
    }
    $filename = 'stats' . ' ' . substr(uniqid(rand(),1),0,3) . '.' . $extension;
    $upload = move_uploaded_file($stats_img['tmp_name'], "../uploads/stats/$filename");
    
    if(!$upload){
      $errors['stats_error'] = "Failed to upload file.";
    } else {
     $query ="INSERT INTO stats( clients, projects, support, workers) VALUES ('$clients','$projects','$support','$workers')";
    }
  }


  // IF ERRORS OCCURED
  if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/tables#stats');
  } else{
    $query ="INSERT INTO stats( clients,projects,support,workers,stats_img) VALUES ('$clients','$projects','$support','$workers','$filename')";
    $result = mysqli_query($conn, $query);
      header("Location: ../index.php#stats");
  }