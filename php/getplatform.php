<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();

$C_ID = mysqli_escape_string($conn,$_GET['c_id']);
$sql = "SELECT platform,img,S_name,Course,Section,S_year from candi_info where Candidate_id={$C_ID}";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_row($result);
if($data[1]==""){
    $img = "place_holder.webp";
}else{
    $img = $data[1];
}
$output = "
<div class='modal-title'><img src='assets/".$img."'></div>
<div class='modal-title'>".$data[2]."</div>
<div class='modal-title'>".$data[3]." ".$data[5].$data[4]."</div>
<p id='modal-text'>".$data[0]."</p>
";
echo $output;
?>