<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
if(isset($_GET['s_id'])){
    $S_ID = mysqli_escape_string($conn,$_GET['s_id']);
    $sql = "DELETE from v_acc where S_id='{$S_ID}'";
    $result = mysqli_query($conn,$sql);
    if($result){
       echo "success";
    }else{
        echo "Something went wrong. Please Try again";
    }
}
?>