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
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style_result.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster Result</title>
</head>
<body> 
    <div class="chslogo">
    <img class="chs" src="assets/Chs_logo.png" alt="">
    <img src="assets/mmsu logo.png" alt=""><br><br><br>
    <h1 class="hh1">CHS SC Election Results</h1>
    </div>
    <br>
    <br>
    <br>
<div class="results-data">

<!-- Js touches this div-->
<div class="jsedit">
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
<div class="person">
    <div class="chart">
    <div class="donut a">
        <img class="hole" src="assets/place_holder.webp">
    </div>
    </div>
    <div class="data">
    <div class="info">
        <div class="person-info">
            <span><h2>Placeholder</h2></span>
            <p>Placeholder</p>
        </div>
            <div class="percent">
                <h1>0%</h1>
            </div>
    </div>
        <div class="votes">
        <h3>0 votes</h3>
        </div>
    </div>
</div>
</div>
<!-- Js touches this div-->
<div class="undecided">
    <div class="under">
        <p class="unde">UNDECIDED</p><br>
        <p class="outof">123 VOTES OUT OF 1,304</p>
        </div>
        <h1>10%</h1>
    </div>
</div>
<div class="signatures">
    Sign
</div>
<script src="js/result_pie.js" defer></script>

</body>
</html>