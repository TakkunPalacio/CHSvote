<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();

$NAME = mysqli_escape_string($conn,$_POST['name']);
$S_ID = mysqli_escape_string($conn,$_POST['S_id']);
$PASS = mysqli_escape_string($conn,$_POST['pass']);
$YEAR = mysqli_escape_string($conn,$_POST['year']);
$COURSE = mysqli_escape_string($conn,$_POST['course']);
$SECTION =mysqli_escape_string($conn,$_POST['section']);
if(!empty($NAME)&&!empty($PASS)&&!empty($S_ID)&&!empty($YEAR)&&!empty($COURSE)&&!empty($SECTION)){
    
}else{
    die("Incomplete fields.");
}

$sql = "INSERT INTO v_acc (S_id,pass) VALUES
        ('{$S_ID}','{$PASS}')";
if(mysqli_query($conn,$sql)){
    $sql = "INSERT INTO v_info (S_id,S_name,course,S_year,Section) VALUES
            ('{$S_ID}','{$NAME}','{$COURSE}',{$YEAR},'{$SECTION}')";
            if(mysqli_query($conn,$sql)){
                echo 'success';
            }
}
?>