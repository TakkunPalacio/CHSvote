<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}
$conn = new mysqli("localhost","root","","chs_voting");
$sql = "SELECT * from position_votes where S_id = '".$_SESSION['ID']."'";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_row();
$pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
        'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
        "PT Rep"];
// $representative_array = ['Nursing Rep','Pharma Rep','PT Rep'];
// $rep_array_check = ['BSN','BSP','BSPT'];
// $index_course = array_search($_SESSION['Course'],$rep_array_check);
// unset($representative_array[$index_course]);

$platform = "Thank you for Voting";
function getcandata($C_id,$pos_id){
    global $conn, $pos;
    if($C_id!=1){
    $sql = "SELECT * from candi_info where Candidate_id =".$C_id;
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_row();
    print($row[2]);
    echo "<br>";
    if($row[3]!=0){
    print($pos[$row[3]-1]);}else{
        print($pos[0]);
    }
    echo "<br>";
    print($row[5]." ");
    print($row[4]);
    print($row[6]);
    echo "<br>";
    }
    else{
    print("Position: ".$pos[$pos_id]." ");
    echo "<br>";
    print("Abstain");    
    }
}

function getimgdata($c_id){
    global $conn;
    $sql="SELECT img from candi_info where Candidate_id='{$c_id}'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    if($row['img']==""||$row['img']==null){
        $img = "place_holder.webp";
    }else{$img =$row['img'];}
    echo"<img class='image' src=assets/{$img}>";

}
?>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script src="js/main.js">
        </script>
        <style>
            .content{
                color:#000;
                font-weight: 300;
            }
           img, picture{
            position: flex;
            height: 98px;
            width: 98px;
            margin: 0;
            max-width: 98px;
            min-width: 98px;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
            border: 1px solid var(--menu-bg);}
            .inner {
                display: flex;
                max-width: 100%;
                flex-flow: row wrap;
                align-items: flex-end;
                padding:0;
                margin:0;
                align-items: center;
            }
            .candidate{
                width:200px;
                padding-bottom: 10px;
            }
            .image{
                flex-shrink: 0;
            }
            .txt-data{
                text-align: center;
                color:#000;
                font-weight: 700;
            }
            .img{
                text-align: center;
            }
            .mmsulogo img{

                position: flex;
                height: 154px;
                width: 154px;
                margin: 0;
                max-width: 154px;
                min-width: 98px;
                border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border: 1px solid var(--menu-bg);
            }
        </style>
        <title>Finish</title>
    </head>
    <body>
        <div class="container">
            <div class="menu">
                <div class="mmsulogo"><img src="assets/Chs_logo.png" alt=""></div>
                <button class="menubtn" onclick="location.href='Profile.php'">Profile</button><br>
                <button class="menubtn current" disabled onclick="location.href='Candidate.php'">Vote</button><br>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content">
                    Thank you for voting. Please logout and let the next student vote.
                </div><br>
                <div class="content">
                You have selected:<br><br>
                <div class="inner">
                <?php for ($i =1;$i<13;$i++){
                    if($row[$i]==2){
                        continue;
                    }
                    ?>
                <div class="candidate">
                <div class="img"><?php getimgdata($row[$i])?></div>
                <div class="txt-data"><?php getcandata($row[$i],$i-1)?></div>
                </div>
                <?php }?>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
