<?php 
    $conn = mysqli_connect("localhost", "root", "", "trimLink");

    // Check for connection errors to PHP database
    if (!$conn) {
        echo "Current database connection error".mysqli_connect_error();
    }
?>