
<?php
session_start();
require_once '../database/env.php';
$fullname =$_REQUEST['fullname'];
$email =$_REQUEST['email'];
$phone =$_REQUEST['phone'];
$date =$_REQUEST['date'];
$todaysDate = new DateTime();
$selectedDate = new DateTime($date);

$time =$_REQUEST['time'];
$people =$_REQUEST['people'];
$message =$_REQUEST['message'];
$errors = [];

// FULL NAME VALIDATION
if (empty($fullname)) {
  $errors['fullname'] = "Please enter your first name";
} else if(strlen($fullname < 61)){
  $errors['fullname'] = "Full name should not be more than 60 characters";
}
// EMAIL VALIDATION
if (empty($email)) {
  $errors['email'] = "Please enter your email";
} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors['email'] = "Invalid email format";
}

// PHONE VALIDATION
// if(empty($phone)) {
  // $errors['phone'] = "Please enter your phone number.";
  if(strlen($phone) != 11){
    $errors['phone'] = "Invalid phone number.";
  }
// }

//DATE VALIDATION
if (empty($date)) {
  $errors['date'] = "Please enter your date.";
} else if($selectedDate < $todaysDate){
  $errors['date'] = "Please enter a valid date.";
}

// TIME VALIDATION
if (empty($time)) {
  $errors['time'] = "Please enter your time.";
}
// PEOPLE VALIDATION
if (empty($people)) {
  $errors['people'] = "Please enter the number of people.";
} else if(!is_numeric($people) > 1){
  $errors['people'] = "Invalid number of people.";
}
// MESSAGE VALIDATION
if (empty($message)) {
  $errors['message'] = "Please enter your message.";
} else if (strlen($message) > 200) {
  $errors['message'] = "Message should not be more than 200 characters.";
}

// IF ERRORS OCCURED
if (!empty($errors)) {
  $_SESSION['errors'] = $errors;
  header("Location: ../index.php#book-a-table");
} else {
  $sql = "INSERT INTO book_table ( fullname, email, phone, date, time, people, message) VALUES ('$fullname','$email','$phone','$date','$time','$people','$message')";
  $result = mysqli_query($conn, $sql);
  $_SESSION['book_table']['fullname'] = $fullname;
  $_SESSION['book_table']['phone'] = $phone;
  $_SESSION['book_table']['email'] = $email;
  $_SESSION['book_table']['date'] = $date;
  $_SESSION['book_table']['time'] = $time;
  $_SESSION['book_table']['people'] = $people;
  $_SESSION['book_table']['message'] = $message;
  $_SESSION['success'] = "Table booked successfully.";

  header("Location: ../index.php#book-a-table")
}
?>