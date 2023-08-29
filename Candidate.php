<!DOCTYPE html>
<?php
$vote = 0;
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}
if(isset($_SESSION['Voted'])){
    header("Location:FinishVote.php");
    exit;
}
if($_SESSION['is_admin']==1){
    header("Location:adminc.php");
}
$representative_array = ['Nursing Rep','Pharma Rep','PT Rep'];
$rep_array_check = ['BSN','BSP','BSPT'];
$index_course = array_search($_SESSION['Course'],$rep_array_check);
unset($representative_array[$index_course]);

$posid = 0;
$pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
        'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
        'PT Rep'];
$conn = new mysqli("localhost","root","","chs_voting");
$sql = "SELECT * from candi_info where Candidate_id>2";
$result = mysqli_query($conn,$sql);
$c_info = [];
while($row = $result->fetch_assoc()){

    $c_info[] = ["c_id"=>$row['Candidate_id'],"S_id" => $row['S_id'],"S_name"=>$row['S_name'],
                 "position" =>$row['position'],"S_year" =>$row['S_year'],"Course"=>$row['Course'],
                 "Section"=>$row['Section'],"img"=>$row['img']];
    
}
function is_pres($item){
    global $posid;
    return $item['position'] == $posid;
}
?>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/table_candidate.css">
        <link rel="stylesheet" href="css/vote.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script src="js/main.js"></script>
        <title>Vote</title>
    </head>
    <body>
        <div class="container">
            <div class="menu">
                <div class="mmsulogo"><img src="assets/mmsu logo.png" alt=""></div>
                <button class="menubtn" onclick="location.href='Profile.php'">Profile</button><br>
                <button class="menubtn current" disabled onclick="location.href='Candidate.html'">Vote</button><br>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content">
                    <header>Click on the Candidate's image to vote</header>
                    <form method="post" id="voting-form"action="#">
                    <?php
                    foreach($pos as $item){
                        if(in_array($item,$representative_array)){
                            $posid++;
                            echo "<input type='hidden' name='$item' value='2'>";
                            continue;
                        }
                    ?>
                    <input disabled type="text" id="sel+<?=$item?>" value="" placeholder="Select a person to vote."/>
                    <table class="new-table">
                        <tbody>
                            <tr>
                                <th><?=$item?></th>
                                <td>
                                <!-- <div class="new-row">
                                        <div class="inner"> -->
                                            <label>
                                            <input onclick="ctxts('<?=$item?>','1');" type="radio" name="<?=$item?>" value="1" checked>
                                            <!-- <div class="profile-icon">
                                                <img src="" onerror="this.onerror=null; this.src='assets/place_holder.webp'">
                                            </div>
                                            <div class="secondary-info">
                                                <div class="short-info">
                                                No info
                                                </div>
                                                <div class="explore-more">
                                                    <button disabled type="button" class="more-info" onclick="show_student_info('<?=$a['S_id']?>','modal');">Abstain</button>
                                                </div>
                                            </div>
                                            <div class="candidate-name">
                                                <span class="c-name-span">Abstain</span>
                                            </div>
                                            </label>
                                            <div class="explore-container">
                                            </div> -->
                                        <!-- </div>
                                    </div> -->
                                <?php 
                                $posid++;
                                $f = array_filter($c_info,'is_pres');
                                foreach ($f as $a){?>
                                    <div class="new-row">
                                        <div class="inner">
                                            <label>
                                            <input onclick="ctxts('<?=$item?>','<?=$a['S_name']?>');" type="radio" name="<?=$item?>" value="<?=$a['c_id']?>">
                                            <div class="profile-icon">
                                                <img src="assets/<?=$a['img']?>" onerror="this.onerror=null; this.src='assets/place_holder.webp'">
                                            </div>
                                            <div class="secondary-info">
                                                <div class="short-info">
                                                Year <?=$a['S_year']?><br>
                                                <?=$a['Course']?>
                                                </div>
                                                <div class="explore-more">
                                                    <button type="button" class="more-info" onclick="show_student_info('<?=$a['c_id']?>','modal');">Info</button>
                                                </div>
                                            </div>
                                            <div class="candidate-name">
                                                <span class="c-name-span"><?=$a["S_name"]?></span>
                                            </div>
                                            </label>
                                            <div class="explore-container">
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php }?>
                    <input type="submit" id="submit"class="more-info send" value="Send Vote">
                    </form>
                </div>
            </div>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="remove" onclick="closemodal('modal')">
                    <i class="fa fa-circle" aria-hidden="true">
                        X
                    </i>
                </span>
                <div id="expl-con">
                    <div class="modal-title"><img src="assets/place_holder.webp"></div>
                    <div class="modal-title">John Isa Palacio</div>
                    <div class="modal-title">BSCPE 3A</div>
                    <p id="modal-text">Platform</p>
                </div>
                <div id="confirm-modal">
                <button id='confirm' class='more-info confirm'>Yes</button>
                </div>
            </div>
        </div>
        <script src="js/candidate.js" defer></script>
    </body>
</html>