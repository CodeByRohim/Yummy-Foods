<?php
session_start();
include "../database/env.php";
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$hours = $_REQUEST['hours'];
$errors = [];


// PHONE VALIDATION
if (empty($phone)) {
  $errors['phone'] = "Please enter your phone number.";
} else if(!$phone > 12){
  $errors['phone'] = "Invalid phone number.";
}
// EMAIL VALIDATION
if (empty($email)) {
  $errors['email'] = "Please enter your email.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = "Invalid email.";
}
// ADDRESS VALIDATION
if (empty($address)) {
  $errors['address'] = "Please enter your address.";
} 
// HOURS VALIDATION
if (empty($hours)) {
  $errors['hours'] = "Please enter your hours.";
}
// IF THERE ARE ERRORS
if(count($errors) > 0){
  $_SESSION['errors'] = $errors;
  header("Location: ../dashboard/tables.php");
} else{
$sql = "UPDATE contact_info SET address='$address', phone='$phone', email='$email', hours='$hours'";
 $result = mysqli_query($conn,$sql);
$_SESSION['contact_info']['phone'] = $phone;
$_SESSION['contact_info']['email'] = $email;
$_SESSION['contact_info']['address'] = $address;
$_SESSION['contact_info']['hours'] = $hours;
$_SESSION['message'] = "Contact information updated successfully!";

  header("Location: ../index.php#contact");
}
?>