<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
if(isset($_GET['c_id'])){
    $C_ID = mysqli_escape_string($conn,$_GET['c_id']);
    $sql = "DELETE from candi_info where Candidate_id={$C_ID}";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "success";
    }else{
        echo "Something went wrong. Please Try again";
    }
}
 
?>