<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT users.*, users.role FROM `users` WHERE users.email='$email'");
$user = mysqli_fetch_assoc($query);

// If the user has already chosen a role, redirect them automatically
if ($user['role'] == 'user') {
    header("Location: userhomepage.php");
    exit();
} elseif ($user['role'] == 'client') {
    header("Location: clienthomepage.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['role']) && ($user['role'] == NULL)) {
        $role = $_POST['role'];
        
        // Update role in database
        mysqli_query($conn, "UPDATE users SET role='$role' WHERE email='$email'");
        
        // Redirect to respective page
        if ($role == 'user') {
            header("Location: userhomepage.php");
            exit();
        } elseif ($role == 'client') {
            header("Location: clienthomepage.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Role</title>
</head>
<body style="background-color: antiquewhite;">
    <center>
        <h2>Hello, <?php echo $user['firstName'] . ' ' . $user['lastName']; ?></h2>
        <p>Please choose one of the options below. You can only select once.</p>
        <form method="post">
            <button type="submit" name="role" value="user">User</button>
            <button type="submit" name="role" value="client">Client</button>
        </form>
    </center>

    <footer>
    <br>
    <br>
    <br>
    <div class="foothead">
        <H1><span style="color: green;font-weight: bolder; font-style: italic;">Comment Line</span> <span style="color: red;font-style: oblique;">Master ...</span></H1>
    </div>
    <div class="footernav">
        <ul class="fn">
            <p><a href="about.html">about us</a></p>&nbsp;&nbsp;&nbsp;
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

<style>
    
    h2{
        color:navy;
        letter-spacing: 8px;
    }
    span{
        color:red;
    }
    button{
    padding: 20px 60px;
    border: 1px solid antiquewhite;
    font-weight: bold;
    color:green;
    border-radius: 10px;
    cursor: grabbing;
    margin:30px;
}
p{
    color: blueviolet;
    letter-spacing: 4px;
    text-decoration: none;
}
    

/*  footer code  */

footer{
    background-color: rgb(5, 5, 48);
    color: white;
    display: flex;
    margin-top: 20%;
}
footer2 p{
    background-color: rgb(5, 5, 48);
    color: white;
    
    
}
.foothead{
    margin-left: 20%;
}
.fn{
    display: flex;
    
}
.fn p{
    border: 1px solid grey;
    padding:4px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.5s;
    
}
.fn p:hover{
    transition: 0.5s;
    border: 1px solid black;
    padding: 4px;
    background-color: white;
    color: black;
    border-radius: 5px;
}
.lout{

        border: 1px solid grey;
        padding:4px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.5s;
        background-color: rgb(5, 5, 48);
    color: white;
        
    }
    .lout:hover{
        transition: 0.5s;
        border: 1px solid black;
        padding: 4px;
        background-color: white;
        color: black;
        border-radius: 5px;
    }

</style>
