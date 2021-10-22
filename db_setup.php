
<?php
$servername = "localhost";
$username = "aachary5";
$password = "C96e#k4N";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
