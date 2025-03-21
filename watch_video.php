<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    echo "User not logged in.";
    exit;
}

$email = $_SESSION['email'];
$video_id = $_POST['video_id'];

// Check if the user has already watched this video
$check_query = mysqli_query($conn, "SELECT * FROM watched_videos WHERE user_email='$email' AND video_id='$video_id'");
if (mysqli_num_rows($check_query) > 0) {
    echo "You have already watched this video and earned points.";
    exit;
}

// Award points (assuming each video gives 10 points)
mysqli_query($conn, "UPDATE users SET points = points + 1 WHERE email='$email'");

// Insert record into watched_videos
mysqli_query($conn, "INSERT INTO watched_videos (user_email, video_id) VALUES ('$email', '$video_id')");

echo "Points added successfully!";
?>
