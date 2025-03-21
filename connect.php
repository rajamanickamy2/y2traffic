<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12768888";
$pass = "qgj4vLp1xg";
$db = "sql12768888";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
