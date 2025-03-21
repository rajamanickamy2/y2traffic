<?php 
session_start();
include("connect.php");

$email = $_SESSION['email'];

// Fetch user points
$user_query = mysqli_query($conn, "SELECT points FROM users WHERE email='$email'");
$user_row = mysqli_fetch_assoc($user_query);
$user_points = $user_row['points'];

// Fetch videos
$videos_query = mysqli_query($conn, "SELECT * FROM videos");

// Fetch watched videos for this user
$watched_query = mysqli_query($conn, "SELECT video_id FROM watched_videos WHERE user_email='$email'");
$watched_videos = [];
while ($row = mysqli_fetch_assoc($watched_query)) {
    $watched_videos[] = $row['video_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <link rel="stylesheet" href="userhomepage.css">
</head>
<body>
    <div class="left">
        <h2>
            <span>Hello</span> 
            <?php 
            $query = mysqli_query($conn, "SELECT firstName, lastName FROM users WHERE email='$email'");
            $row = mysqli_fetch_assoc($query);
            echo $row['firstName'].' '.$row['lastName'];
            ?>
        </h2>
        <p>Points: <?php echo $user_points; ?></p>
        <a href="logout.php" class="lout">Logout</a>
    </div>
    <br>
    <br>
    <div class="right">
        <h3>Watch Videos</h3>
        <table border="1" cellpadding="7" cellspacing="2" >
            <tr>
                <th>#</th>
                <th>Video Title</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
            <?php $count = 1; while ($video = mysqli_fetch_assoc($videos_query)) { 
                $video_title = "YouTube Video " . $count;
                $video_id = $video['id'];
                $is_watched = in_array($video_id, $watched_videos) ? "disabled" : ""; 
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($video_title); ?></td>
                    <td>
                        <a href="<?php echo htmlspecialchars($video['video_link']); ?>" target="_blank" onclick="enableButton('<?php echo $video_id; ?>')" <?php echo $is_watched ? 'style="pointer-events: none; color: gray;"' : ''; ?>>Watch Video</a>
                    </td>
                    <td>
                        <button id="btn_<?php echo $video_id; ?>" onclick="watchVideo('<?php echo $video_id; ?>')" <?php echo $is_watched; ?>>Watch & Earn Points</button>
                    </td>
                </tr>
            <?php $count++; } ?>
        </table>
    </div>

    <script>
    function enableButton(videoId) {
        setTimeout(() => {
            let button = document.getElementById("btn_" + videoId);
            if (button) {
                button.disabled = false;
            }
        }, 2000); // Enable button after 2 seconds
    }

    function watchVideo(videoId) {
        fetch('watch_video.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'video_id=' + videoId
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
    </script>

    <br> <br> <br>
    <footer>
        <div class="foothead">
            <h1><span style="color: green;font-weight: bolder; font-style: italic;">Comment Line</span> <span style="color: red;font-style: oblique;">Master ...</span></h1>
        </div>
        <div class="footernav">
            <ul class="fn">
                <p><a href="about.html">About us</a></p>&nbsp;&nbsp;&nbsp;
                <p><a href="contact.html">Contact us</a></p>&nbsp;&nbsp;&nbsp;
                <p><a href="index.php"><span style="color: green;">Login</span> / <span style="color: red;">Register</span></a></p>&nbsp;&nbsp;&nbsp;
            </ul>
        </div>
        <br><br><br>
    </footer>
    <footer2>
        <center>
            <p>&copy; 2024. All rights reserved.</p>
        </center>
    </footer2>
</body>
</html>
