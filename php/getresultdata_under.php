<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
$sql = "SELECT * from v_info";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

$sql = "SELECT vote_count from candi_info where position = 0";
$result = mysqli_query($conn,$sql);
$abstain = mysqli_fetch_all($result);
$abstain = $abstain[0][0];
$percent = ($abstain/$count) * 100;
$percent = round($percent,1);
$output = "
<div class='under'>
        <p class='unde'>UNDECIDED</p><br>
        <p class='outof'>".$abstain." VOTERS OUT OF ".$count."</p>
        </div>
        <h1>".$percent."%</h1>
    </div>
";
echo $output;
?>