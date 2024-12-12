<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="newStuModal" tabindex="-1" aria-labelledby="newStuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newStuModalLabel">New Student Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="studentForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
        </div>

        <div class="mb-3">
          <label for="roll" class="form-label">Roll Number</label>
          <input type="text" class="form-control" id="roll" placeholder="Enter your roll number">
        </div>

        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" class="form-control" id="course" placeholder="Enter your course">
        </div>

        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" class="btn btn-primary" onclick="addUser()">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Model -->
<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="newStuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newStuModalLabel">Update Student Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="studentForm">
          <div class="mb-3">
            <label for="uname" class="form-label">Name</label>
            <input type="text" class="form-control" id="uname" placeholder="Enter your name">
          </div>

          <div class="mb-3">
            <label for="uemail" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="uemail" placeholder="Enter your email">
          </div>

          <div class="mb-3">
            <label for="uphone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="uphone" placeholder="Enter your phone number">
          </div>

          <div class="mb-3">
            <label for="uroll" class="form-label">Roll Number</label>
            <input type="text" class="form-control" id="uroll" placeholder="Enter your roll number">
          </div>

          <div class="mb-3">
            <label for="ucourse" class="form-label">Course</label>
            <input type="text" class="form-control" id="ucourse" placeholder="Enter your course">
          </div>

          <button type="reset" class="btn btn-danger">Reset</button>
          <!-- Updated button to call the updateUser function -->
          <button type="button" class="btn btn-primary" onclick="updateUser()">Update</button>
          <input type="hidden" id="hiddendata">
        </form>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid my-3">
  <h1 class="text-primary text-center">STUDENT REGISTRATION CRUD OPERATION</h1>
  <button class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#newStuModal">Add New Student</button>

  <div id="displayDatatable"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Function to display data in table 
function displayData() {
  $.ajax({
    url: "display.php",
    type: "POST",
    data: {
      displaySend: true
    },
    success: function(data, status) {
      $('#displayDatatable').html(data); // Corrected selector
    },
    error: function(xhr, status, error) {
      alert("Error loading data: " + error);
    }
  });
}

// Function to add a user
function addUser() {
  // Fetch input values
  const nameadd = document.querySelector('#name').value;
  const emailadd = document.querySelector('#email').value;
  const phoneadd = document.querySelector('#phone').value;
  const rolladd = document.querySelector('#roll').value;
  const courseadd = document.querySelector('#course').value;

  // Validate inputs (basic example)
  if (!nameadd || !emailadd || !phoneadd || !rolladd || !courseadd) {
    alert("All fields are required!");
    return;
  }

  // Send AJAX request to insert data
  $.ajax({
    url: "insert.php",
    type: "POST",
    data: {
      nameSend: nameadd,
      emailSend: emailadd,
      phoneSend: phoneadd,
      rollSend: rolladd,
      courseSend: courseadd
    },
    success: function(data, status) {
      alert(data); // Notify user of the result
      // Optional: Reset form and close modal
      document.getElementById("studentForm").reset();
      $('#newStuModal').modal('hide');
      displayData(); // Refresh the table
    },
    error: function(xhr, status, error) {
      alert("An error occurred while adding the user: " + error);
    }
  });
}

// Function to delete a user
function deleteUser(deleteid) {
  // Send AJAX request to delete data
  $.ajax({
    url: "delete.php",
    type: 'POST',
    data: {
      deletesend: deleteid
    },
    success: function(data, status) {
      alert("Student record deleted successfully.");
      displayData(); // Refresh the table after deletion
    },
    error: function(xhr, status, error) {
      alert("Error deleting user: " + error);
    }
  });
}
// Function to handle updating user data
function updateUser() {
  const uname = document.querySelector('#uname').value;
  const uemail = document.querySelector('#uemail').value;
  const uphone = document.querySelector('#uphone').value;
  const uroll = document.querySelector('#uroll').value;
  const ucourse = document.querySelector('#ucourse').value;
  const hiddenid = document.querySelector('#hiddendata').value; // Get the hidden user ID

  // Basic validation
  if (!uname || !uemail || !uphone || !uroll || !ucourse) {
    alert("All fields are required!");
    return;
  }

  // Send the updated data to the server
  $.ajax({
    url: "update.php", // The PHP file handling the update
    type: "POST",
    data: {
      id: hiddenid,
      nameSend: uname,
      emailSend: uemail,
      phoneSend: uphone,
      rollSend: uroll,
      courseSend: ucourse
    },
    success: function(data, status) {
      alert(data); // Notify the user that the update was successful
      $('#updateModal').modal('hide'); // Close the modal
      displayData(); // Refresh the table with updated data
    },
    error: function(xhr, status, error) {
      alert("An error occurred while updating the user: " + error);
    }
  });
}

// Function to update user details 
function getDetails(updateid) {
  $('#hiddendata').val(updateid); // Store the hidden field value (ID)

  $.post("update.php", { updateid: updateid }, function(data, status) {
    var userId = JSON.parse(data); // Correct variable name is userId, not userid
    $('#uname').val(userId.name);
    $('#uemail').val(userId.email);
    $('#uphone').val(userId.phone);
    $('#uroll').val(userId.roll);
    $('#ucourse').val(userId.course);
  });

  $('#updateModal').modal("show");
}


// Display data when the page loads
$(document).ready(function() {
  displayData(); // Load data on page load
});

</script>
</body>
</html>
