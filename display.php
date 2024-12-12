<?php
include 'connect.php';  // Ensure the correct path to your connect.php

if (isset($_POST['displaySend'])) {
    // Start the table with headers
    $table = '<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
      <th class="bg-warning" scope="col">Id</th>
      <th class="bg-warning" scope="col">Name</th>
      <th class="bg-warning" scope="col">Email</th>
      <th class="bg-warning" scope="col">Phone</th>
      <th class="bg-warning" scope="col">Roll No</th>
      <th class="bg-warning" scope="col">Course</th>
      <th class="bg-warning" scope="col">Operations</th>
    </tr>
    </thead>
    <tbody>'; // Start tbody tag
    
    // Correct SQL query execution
    $sql = "SELECT * FROM `studentreg`";
    $result = mysqli_query($conn, $sql);
    $number = 1 ;
    
    if ($result) {
        // Loop through the rows and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= '<tr>
            <td>' . $number . '</td>  
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>' . $row['roll'] . '</td>
            <td>' . $row['course'] . '</td>
            <td>
                <button class="btn btn-secondary" onclick="getDetails(' . $row['id'] . ')">Update</button>
                <button class="btn btn-danger" onclick="deleteUser(' . $row['id'] . ')">Delete</button>
            </td>
            </tr>';
            $number++; // onces a table end value of one is increse by 1 
        }
    } else {
        // If query fails, show an error message
        $table .= '<tr><td colspan="7" class="text-center text-danger">Error fetching data from the database.</td></tr>';
    }

    // Close the table tags
    $table .= '</tbody></table>';
    
    echo $table; // Display the table
} else {
    echo "No display request received.";  // If displaySend is not set
}
?>
