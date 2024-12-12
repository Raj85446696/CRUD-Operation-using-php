<?php
include('connect.php');

// Fetch user details when updateid is sent
if (isset($_POST['updateid'])) {
    $userId = $_POST['updateid'];

    // Query to get the user data
    $sql = "SELECT * FROM `studentreg` WHERE id = $userId";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $response = mysqli_fetch_assoc($result); // Fetch the user data as an associative array
        echo json_encode($response); // Return the user data as JSON
    } else {
        // No data found for the given ID
        $response = array('status' => 200, 'message' => 'No data found for the given ID');
        echo json_encode($response);
    }
} elseif (isset($_POST['id'])) {
    // Update user details
    $id = $_POST['id'];
    $name = $_POST['nameSend'];
    $email = $_POST['emailSend'];
    $phone = $_POST['phoneSend'];
    $roll = $_POST['rollSend'];
    $course = $_POST['courseSend'];

    // SQL query to update user data
    $sql = "UPDATE `studentreg` SET name='$name', email='$email', phone='$phone', roll='$roll', course='$course' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>
