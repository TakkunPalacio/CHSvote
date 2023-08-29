<?php
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}else{
    if(!$_SESSION['is_admin']==1){
        header("Location:index.php?n");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/admin.css">
        <script src="js/main.js">
        </script>
        <title>Import Data</title>
        <style>
            *{
                color: #000;
            }
            header{
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="menu no-print">
                <div class="mmsulogo"><img src="assets/mmsu logo.png" alt=""></div>
                <button class="menubtn current" disabled onclick="location.href='importdata.php'">Import Data</button>
                <button class="menubtn" onclick="location.href='adminc.php'">Candidate</button><br>
                <button class="menubtn" onclick="location.href='adminv.php'">Voter</button>
                <button class="menubtn" onclick="location.href='Result.php'">Result [Table]</button>
                <button class="menubtn" onclick="location.href='result_pie.php'">Result [Poster]</button>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content">
                <header>Import Data</header>
                <div class="error-text">This is an error text</div>
                <div class="success-text">Successfully inserted data</div>
                <div class="process-text">Processing data</div>
                <div class="import-div">
                <form class="import" action="#" method="post" id="import" enctype="multipart/form-data">
                <p> Type of data to be imported </p>
                <input type="radio" name="type" value="0" id="vc" checked>
                <label for="vc">Voters and Candidates</label><br>
                <input type="radio" name="type" value="1" id="v">
                <label for="v">Voters Only</label><br>
                <input type="radio" name="type" value="2" id="c">
                <label for="c">Candidates Only</label><br>
                <p>Please only insert excel file</p>
                <input type="file" name="file"><br>
                <input class="submit" type="submit" name="submit_file" value="Submit">
                </form>
                <div class="instruction">
                    To import data:<br>
                    Have an excel file with the first sheet being named 'voters'
                    and the second sheet being named 'candidates'.<br><br>
                    Example:<br>
                    <img class="excel-img" src="assets/excel_example.png">
                    <br>
                    In the voters' sheet, have the column names be like this:
                    <br>
                    No. | S_id | Name | Course | S_year | Section<br>
                    In the candidates' sheet, have the column names be like this:
                    <br>
                    S_id | S_name | position | S_year | Course | Section | img | platform<br>
                    And insert the required data.
                </div>
                </div>
                NOTE: INSERTING DATA WILL DELETE CURRENT RECORDS. PROCEED WITH CAUTION  
                </div><br>
            </div>
        </div>
        <script src="js/import.js" defer></script>
    </body>
</html>