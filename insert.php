<?php 
include("connect.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract POST data
    $name = $_POST['nameSend'];
    $email = $_POST['emailSend'];
    $phone = $_POST['phoneSend'];
    $roll = $_POST['rollSend'];
    $course = $_POST['courseSend'];

    // Sanitize the inputs to prevent SQL Injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $roll = mysqli_real_escape_string($conn, $roll);
    $course = mysqli_real_escape_string($conn, $course);

    // SQL Query
    $sql = "INSERT INTO `studentreg` (`name`, `email`, `phone`, `roll`, `course`) 
            VALUES ('$name', '$email', '$phone', '$roll', '$course')";
    
    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Successfully inserted";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
