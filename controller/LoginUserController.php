<?php 
session_start();
require "../database/env.php";

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$error = [];

// EMAIL VALIDATION
if (empty($email)) {
    $error['email'] = "Please enter your email.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Invalid email format.";
}

// PASSWORD VALIDATION
if (empty($password)) {
    $error['password'] = "Please enter your password.";
}

// iIF ERRORS FOUND
if (count($error) > 0) {
    $_SESSION ['errors'] = $error;
    header("Location: ../login.php");
    exit();
}

// Check if email exists in the database
// $email = mysqli_real_escape_string($conn, $email); // Escape user input to prevent SQL injection
$query = "SELECT first_name AS fname, last_name AS lname, email, password FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
// $user = $result->fetch_assoc();
$user = mysqli_fetch_assoc($result);
if ($user) {
    // Verify the entered password against the hashed password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
          'fname' => $user['fname'] ?? '',
          'lname' => $user['lname'] ?? '',
          'email' => $user['email']
        ];
        
        header("Location: ../dashboard/index.php");
        exit();
    } else {
        // Invalid password
        $_SESSION['errors'] = ["inpassword" => "Invalid password."];
        header("Location: ../login.php");
        exit();
    }
} else {
    // Email not found
    $_SESSION['errors'] = ["inemail" => "Invalid email."];
    header("Location: ../login.php");
    exit();
}
?>
