<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['ID'])){
    header("Location:Profile.php?l");
    exit;
}

?>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script src="js/index.js"></script>
        <title>Welcome</title>
    </head>        
    <body>
        <div class="content">
        <div class="login-form">
            <h1 class="menu">Welcome to CHS Voting System</h1>
            <form method="post" action="php/login.php" autocomplete="off">
                <label>Student Number: </label>
                <input type="text" name="stu_no"><br>
                <label>Password: </label>
                <input type="text" name="password"><br>
                <button type="submit">Login</button>
            </form>
            <button onclick="abt('about_us')">About us</button>
            
        </div>
        <div id="about_us" class="modal" style="display:none" >
            <div id="content_au" class="modal-content">
                <span class="remove" onclick="closemodal('about_us')">
                <i class="remove-circle" >
                </i>
                </span>
            About Us:<br>
            Group 2 BSCPE<br>
            As part of the requirements from CPE 151<br>
            Languages Used: HTML, CSS, JS, PHP 
            <br>
            
            </div>
        </div>
        <div id="f_login" class="modal" style="display:none">
            <div class="modal-content">
                <span class="remove" onclick="location.href='index.php'">
                    <i class="remove-circle" >
                    </i>
                    </span>
            <?php
            if(isset($_GET['n'])){
                $msg = "Please Login in order to vote";
                echo "$msg";
                echo "<script>fail();</script>";
            }
            if(isset($_GET['s'])){
                $msg = "No account exists, please register or use a valid id";
                echo "$msg";
                echo "<script>fail();</script>";
                
            }
            ?>
            
            </div>
        </div>
    </div>
    </body>
</html>
<?php



?>