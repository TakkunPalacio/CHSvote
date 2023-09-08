<?php
//use composer to install phpspreadsheet
//refer to documentation for guide
//excel format
//first sheet is for voters 
require 'C:\Users\John Isa\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$conn = new mysqli("localhost","root","","chs_voting");
session_start();
$excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
//data format
$pos_array = ['blank','President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
'Auditor','Public Information Officer','Business Manager','Nursing Rep.','Pharma Rep.',
'PT Rep.'];//position array
$type = $_POST['type'];
if($type==0){//voters and candidates

}elseif($type==1){//voters only
    $active = 0;
}else{//candidate only
    $active = 1;
}

if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){ //if file is an excel file

}else{
    echo "File is not an excel file";
    die;
}
function randomPassword() {
    $alphabet = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function insertvote($row){
    global $conn;
    $random_password = (randomPassword());
    $no = $row[0];
    $id = mysqli_escape_string($conn,$row[1]);
    $name = mysqli_escape_string($conn,$row[2]);
    $course = mysqli_escape_string($conn,$row[3]);
    $year = mysqli_escape_string($conn,$row[4]);
    $section = mysqli_escape_string($conn,$row[5]);
    $sql = "INSERT INTO v_acc (S_id,pass) VALUES ('{$id}','{$random_password}')";
    $sql1 = "INSERT INTO v_info (S_id,S_name,course,S_year,Section) VALUES ('{$id}','{$name}','{$course}',{$year},'{$section}')";
    if(mysqli_query($conn,$sql)){
        mysqli_query($conn,$sql1);
    }
    else{
        echo "Error inserting on No.".$no;
        die;
    }
}

function insertcandidate($row){
    global $conn,$pos_array;
    $id = mysqli_escape_string($conn,$row[0]);
    $name = mysqli_escape_string($conn,$row[1]);
    $pos = mysqli_escape_string($conn,$row[2]);
    $year = mysqli_escape_string($conn,$row[3]);
    $course = mysqli_escape_string($conn,$row[4]);
    $section = mysqli_escape_string($conn,$row[5]);
    $img = mysqli_escape_string($conn,$row[6]);
    $platform = mysqli_escape_string($conn,$row[7]);
    $index = array_search($pos,$pos_array);
    $sql = "INSERT INTO candi_info (S_id,S_name,position,S_year,Course,Section,img,platform) VALUES
            ('{$id}','{$name}','{$index}','{$year}','{$course}','{$section}','{$img}','{$platform}')";
    mysqli_query($conn,$sql);
}
function insertdata($active){
    global $excelMimes;
        $file = $_FILES['file']['tmp_name'];//load
        $reader = new Xlsx();
        $ss = $reader->load($file);
        $ws = $ss->getSheet($active);//active sheet 
        $ws_a = $ws->toArray();
        foreach($ws_a as $row){
            if(empty($row[0])||$row[0]=='No.'||$row[0]=='S_id'){
                continue;
            }
        if($active==0){//voter
            insertvote($row);
        }else{//candidate
            insertcandidate($row);
                }
        }


}
if(isset($active)){// voter or candidate 
    if($active==0){
    $sql = "DELETE FROM v_acc where is_admin=0";}
    else{
    $sql = "DELETE FROM candi_info where Candidate_id>2";
    }
    mysqli_query($conn,$sql);
    insertdata($active);
    echo "success";
}else{//both
    $sql = "DELETE FROM v_acc where is_admin=0";//delete all record in voters
    $sql1 = "DELETE FROM candi_info where Candidate_id>2";//delete all record in candidate
    mysqli_query($conn,$sql);
    mysqli_query($conn,$sql1);
    insertdata(1);
    insertdata(0);
    echo "success";
}
?>