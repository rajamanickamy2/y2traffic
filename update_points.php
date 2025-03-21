<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email']) || !isset($_GET['id'])) {
    exit("error");
}

$email = $_SESSION['email'];
$videoId = intval($_GET['id']);

// Check if the user has already watched this video
$checkWatchedQuery = "SELECT COUNT(*) AS watched FROM watched_videos WHERE user_email='$email' AND video_id=$videoId";
$watchedResult = mysqli_query($conn, $checkWatchedQuery);
$watchedRow = mysqli_fetch_assoc($watchedResult);

if ($watchedRow['watched'] == 0) { 
    // Add 1 point to the user
    mysqli_query($conn, "UPDATE users SET points = points + 1 WHERE email='$email'");

    // Mark video as watched
    mysqli_query($conn, "INSERT INTO watched_videos (user_email, video_id) VALUES ('$email', $videoId)");

    // Increase video view count
    mysqli_query($conn, "UPDATE videos SET current_views = current_views + 1 WHERE id=$videoId");

    echo "new"; // Video watched for the first time
} else {
    echo "old"; // Already watched
}
?>
