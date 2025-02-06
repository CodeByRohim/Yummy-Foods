<?php
include "../database/env.php";
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$hours = $_REQUEST['hours'];

$sql = "INSERT INTO contact_info (address, phone, email,  hours)
VALUES ('$address', '$phone', '$email', '$hours')";
$result = mysqli_query($conn,$sql);
if($result){
  $_SESSION['message'] = $_REQUEST;
  header("Location: ../admin panel/contact_info.php");
}
?>