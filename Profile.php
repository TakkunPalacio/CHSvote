<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}
if($_SESSION['is_admin']==1){
    header("Location:adminc.php");
}
?>

<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script src="js/main.js">
        </script>
        <title>Profile</title>
    </head>
    <body>
        <div class="container">
            <div class="menu">
                <div class="mmsulogo"><img src="assets/Chs_logo.png" alt=""></div>
                <button class="menubtn current" disabled>Profile</button><br>
                <button class="menubtn" onclick="location.href='Candidate.php'">Vote</button><br>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content">
                    <table class="profile">
                        <tr>
                            <th>Student Number</th>
                            <th>:</th>
                            <td><?= $_SESSION["ID"];?></td>
                            
                        </tr>
                        <tr>

                            <th>Name</th>
                            <th>:</th>
                            <td><?=$_SESSION["Name"];?></td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <th>:</th>
                            <td><?=$_SESSION["Course"];?></td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <th>:</th>
                            <td><?=$_SESSION["S_Year"];?></td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <th>:</th>
                            <td><?=$_SESSION["Section"];?></td>
                        </tr>
                    </table>
                </div><br>
                
            </div>
        </div>
        <div id="modalB" class="modal">
            <div class="modal-content">
                <span class="remove" onclick="closemodalB('modalB')">
                    <i class="fa fa-circle" aria-hidden="true">
                        X
                    </i>
                </span>
                <div id="expl-con">
                    <div class="modal-title"></div>
                    Please press the logout button to be able to enter a new account.
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if(isset($_GET['l'])){
    
}
?>