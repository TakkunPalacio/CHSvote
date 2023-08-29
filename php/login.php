<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $id = $_POST['stu_no'];
    $pass = $_POST['password'];

    $sql ="SELECT * from v_acc where S_id='$id' and pass = '$pass'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0){
        header("Location: ../index.php?s");
    }
    else{
        $row = mysqli_fetch_assoc($result);
        $_SESSION["is_admin"] = $row['is_admin'];
        $sql = "SELECT * from v_info where S_id='$id'";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        $_SESSION["Name"] = $row['S_name'];
        $_SESSION["Course"] = $row['course'];
        $_SESSION["S_Year"] = $row['S_year'];
        $_SESSION["Section"] = $row ['Section'];
        $_SESSION["ID"] = $id;
        $sql = "SELECT * from position_votes where S_id='$id'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
        $_SESSION["Voted"] = 1;
        }
        header("Location: ../Profile.php?");
        exit;
    }
}
?>