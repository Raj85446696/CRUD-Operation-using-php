<?php 

$conn = mysqli_connect("localhost","root","","crud","3306");
if($conn==false){
    die("Not Connected to Database".mysqli_error($conn));
}
?>