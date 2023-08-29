<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();

$C_ID = mysqli_escape_string($conn,$_POST['candi_id']);;
$NAME = mysqli_escape_string($conn,$_POST['name']);
$POSITION = mysqli_escape_string($conn,$_POST['position']);
$S_ID = mysqli_escape_string($conn,$_POST['S_id']);
$YEAR = mysqli_escape_string($conn,$_POST['year']);
$COURSE = mysqli_escape_string($conn,$_POST['course']);
$SECTION =mysqli_escape_string($conn,$_POST['section']);
$PLATFORM = mysqli_escape_string($conn,$_POST['platform']);
$new_img_name = " ";
if(!empty($C_ID)&&!empty($NAME)&&!empty($POSITION)&&!empty($S_ID)&&!empty($YEAR)&&!empty($COURSE)&&!empty($SECTION)){
    
}else{
    die("Incomplete fields.");
}
if(isset($_FILES['image'])){
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];
    
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
    $extensions = ["jpeg", "png", "jpg"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            //send image data here to assets file
            $time = time();
            $new_img_name = $time.$img_name;
            move_uploaded_file($tmp_name,"../assets/".$new_img_name);//move sent file to folder
        }
    }else{

    }
}else{
    $new_img_name = " ";
}

if($new_img_name!=" "){//set sql string
    $sql = "INSERT INTO candi_info (S_id,S_name,position,S_year,Course,Section,img,platform) 
    VALUES
    ('{$S_ID}','{$NAME}','{$POSITION}','{$YEAR}','{$COURSE}','{$SECTION}','{$new_img_name}','{$PLATFORM}')";
}else{
    $sql = "INSERT INTO candi_info (S_id,S_name,position,S_year,Course,Section,platform)
    VALUES
    ('{$S_ID}','{$NAME}','{$POSITION}','{$YEAR}','{$COURSE}','{$SECTION}','{$PLATFORM}')";  
}

if(mysqli_query($conn,$sql)){//run sql
    echo "success";
}
else{
    echo "Fail edit";
}
?>