IF seen there is an Error
<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
function if_acc_exist($stu_id){
    global $conn;
    $sql ="SELECT * from v_acc where S_id='$stu_id'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1){return true;}
    else{return false;}
};

function insert_new_acc($stu_id,$pass){
    global $conn;
    $sql = "INSERT INTO v_acc (S_id,pass) VALUES ('$stu_id','$pass')";
    if(mysqli_query($conn,$sql)){
        header("Location: ../Register.php?s");
    }else{
        echo "Dunno man error 151: inserting data failed. Refer to production";
    }
}
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $stu_no = $_POST['stu_no'];
    $pass = $_POST['stu_password'];
    if(if_acc_exist($stu_no)){
        header("Location: ../Register.php?f");
    }
    else{
        insert_new_acc($stu_no,$pass);
    }
    
    

}
?>