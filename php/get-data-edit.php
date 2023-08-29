<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
function get_pos($pos_id){
    $pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
          'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
          'PT Rep'];
    return $pos[$pos_id-1];
  }
if(isset($_GET['c_id'])){
    $C_ID = mysqli_real_escape_string($conn,$_GET['c_id']);
    $sql = "SELECT * from candi_info where Candidate_id='{$C_ID}'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $S_ID = $row['S_id'];
    $NAME = $row['S_name'];
    $POSITION = $row['position'];
    $YEAR = $row['S_year'];
    $COURSE = $row['Course'];
    $SECTION = $row['Section'];
    $PLATFORM = $row['platform'];

    $array = array($NAME,$POSITION,$S_ID,$YEAR,$COURSE,$SECTION,$PLATFORM);
    echo json_encode($array);
}

if(isset($_GET['s_id'])){
  $S_ID = $_GET['s_id'];
  $sql = "Select v_info.S_name,v_info.S_id,v_acc.pass,v_info.S_year,v_info.course,v_info.Section
          from v_info Join v_acc on v_info.S_id = v_acc.S_id where v_info.S_id='{$S_ID}'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_row($result);
  $data = json_encode($row);
  echo $data;
}
?>