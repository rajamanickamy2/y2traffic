<?php 
session_start();
include("connect.php");

if(isset($_POST['submit'])) {
    $email = $_SESSION['email'];
    $video_link = $_POST['video_link'];
    $views = $_POST['views'];

    $stmt = $conn->prepare("INSERT INTO videos (user_email, video_link, views, points) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("ssi", $email, $video_link, $views);
    $stmt->execute();
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="clienthomepage.css">
</head>
<body>
    <div class="left">
        <h2>
            <span>Hello</span> 
            <?php 
            if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];
                $query=mysqli_query($conn, "SELECT users.* FROM users WHERE users.email='$email'");
                while($row=mysqli_fetch_array($query)){
                    echo $row['firstName'].' '.$row['lastName'];
                }
            }
            ?>
        </h2>
        <a href="logout.php" class="lout">Logout</a>
    </div><br>
    <div class="right">
        <h3>Submit YouTube Video</h3>
        <form method="post">
            <input type="text" name="video_link" placeholder="Enter YouTube Link" required>
            <select name="views">
                <option value="100">100 Views</option>
                <option value="200">200 Views</option>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <br> <br> <br>
    <footer>
    <br>
    <br>
    <br>
    <div class="foothead">
        <H1><span style="color: green;font-weight: bolder; font-style: italic;">Comment Line</span> <span style="color: red;font-style: oblique;">Master ...</span></H1>
    </div>
    <div class="footernav">
        <ul class="fn">
           <a href="about.html"> <p>about us</p></a>&nbsp;&nbsp;&nbsp;
            <p><a href="contact.html">contact us</a></p>&nbsp;&nbsp;&nbsp;
            <p><a href="index.php"><sp1 style="color: green;">login</sp1> / <sp2 style="color: red;">register</sp2></a></p>&nbsp;&nbsp;&nbsp;
            
            
        </ul>
    </div>
    
    <br>
    <br>
    <br>
</footer>
<footer2>
    <center>
        <p>@ copy right 2024.All rights reserved</p>
    </center>
</footer2>
</body>  
</html>
