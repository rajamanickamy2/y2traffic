<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12768807";
$pass = "ZnvYVVc5MA";
$db = "sql12768807";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>