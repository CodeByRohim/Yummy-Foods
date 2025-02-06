<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table For Data Update</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    
<?php
// session_start();
include "../database/env.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hours = $_POST['hours'];

    $sql = "UPDATE contact_info SET phone='$phone', email='$email', address='$address', hours='$hours' WHERE id=1";
    if ($conn->query($sql) === TRUE) {
        echo "Contact information updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<section id="contact-info">
    
    <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
    <h4 class="text-center">Contact Info For Home Page Show</h4>
        <form action="../controller/AdminContactInfoController.php" method="POST">
            <span><?=$_SESSION['message'] ?? ''?></span>
            <label class="d-block" for="phone">Phone: </label>
            <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="phone" type="text" name="phone" required>

            <label class="d-block" for="email">Email: </label>
            <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="email" type="email" name="email" required>

            <label class="d-block" for="address">Address: </label>
            <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="address" type="text" name="address" required>

            
                <label class="d-block" for="hours">Hours: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="hours" type="text" name="hours" required>
            

            <div class="d-flex justify-content-center mt-2"><button class="btn btn-primary" type="submit">Update</button></div>
        </form>
    </div>
</section>
</body>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>