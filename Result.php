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

<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/result.css">
        <link rel="stylesheet" href="css/result.css" media="print">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tabular Result</title>
    </head>
    <body>

            <div class="no-print">
            <button class="menubtn" onclick="location.href='adminc.php'">Back to Admin</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                    
                    <div class="table-result">
                    <header>Result of the Votes - Table</header>
                    <br>
                    <div class="loader"></div> 
                    </div>
                
            </div>
    </body>
    <script src="js/result.js"></script>
    <script>
        function openwin(){
            window.open('localhost');
        }
    </script>
</html>