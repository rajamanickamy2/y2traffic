<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    exit("0");
}

$email = $_SESSION['email'];

// Fetch updated points
$result = mysqli_query($conn, "SELECT points FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($result);
echo $row['points'];
?>
