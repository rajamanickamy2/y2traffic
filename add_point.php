<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['video_id'])) {
    $videoId = $_GET['video_id'];
    $email = $_SESSION['email'];

    // Fetch user details
    $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($userQuery);
    $userId = $user['id'];

    // Check if the user has already clicked this video
    $checkQuery = mysqli_query($conn, "SELECT * FROM user_videos WHERE user_id='$userId' AND video_id='$videoId'");
    if (mysqli_num_rows($checkQuery) == 0) {
        // Add points and mark video as clicked
        mysqli_query($conn, "UPDATE users SET points = points + 1 WHERE id='$userId'");
        mysqli_query($conn, "INSERT INTO user_videos (user_id, video_id) VALUES ('$userId', '$videoId')");
    }
}

header("Location: user.php");
exit();
?>