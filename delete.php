<?php
include('connect.php'); 

// Check if the delete request is set
if (isset($_POST['deletesend'])) {
    // Get the ID from the POST request
    $unique = $_POST['deletesend'];

    // Validate the ID (ensure it's a valid integer)
    if (is_numeric($unique)) {
        // Prepare the DELETE query using a prepared statement
        $stmt = $conn->prepare("DELETE FROM studentreg WHERE `id` = ?");
        $stmt->bind_param("i", $unique); // 'i' is for integer type
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Student record deleted successfully.";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid ID provided.";
    }
} else {
    echo "No ID received for deletion.";
}

// Close the database connection
$conn->close();
?>
