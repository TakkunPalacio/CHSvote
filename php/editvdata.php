<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();

$old_s_id = $_POST['o_s_id'];
$S_ID = mysqli_escape_string($conn,$_POST['S_id']);
$NAME = mysqli_escape_string($conn,$_POST['name']);
$PASS = mysqli_escape_string($conn,$_POST['pass']);
$YEAR = mysqli_escape_string($conn,$_POST['year']);
$COURSE = mysqli_escape_string($conn,$_POST['course']);
$SECTION = mysqli_escape_string($conn,$_POST['section']);
$sql = "UPDATE v_info
set S_name='{$NAME}',course='{$COURSE}',S_year={$YEAR},Section='{$SECTION}' where S_id='{$old_s_id}'";
if(mysqli_query($conn,$sql)){
    $sql = "UPDATE v_acc
    set S_id='{$S_ID}',pass='{$PASS}' where S_ID='{$old_s_id}'";
    if(mysqli_query($conn,$sql)){
        echo "success";
    }
}
?>