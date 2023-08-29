<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}else{
    if(!$_SESSION['is_admin']==1){
        header("Location:index.php?n");
    }
}
if(isset($_POST['searchterm']) && isset($_POST['course']) && isset($_POST['year']) && isset($_POST['section'])){
    $SEARCHTERM = $_POST['searchterm'];
    $COURSETERM = $_POST['course'];
    $YEARTERM = $_POST['year'];
    $SECTIONTERM = $_POST['section'];
    $sql = "SELECT * from v_acc INNER JOIN v_info on v_acc.S_id = v_info.S_id 
    where S_name like '%{$SEARCHTERM}%' and course like '%{$COURSETERM}' and S_year like '%{$YEARTERM}%' and Section like '%{$SECTIONTERM}%'";
}else{
    $sql = "SELECT * from v_acc";
}
$output="";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
if($row['is_admin']==1){
    continue;
}
$sql = "SELECT * from v_info where S_id='".$row['S_id']."'";
$res = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($res);
$S_ID = $row['S_id'];
$PASS = $row['pass'];
$NAME = $data['S_name'];
$YEAR = $data['S_year'];
$COURSE = $data['course'];
$SECTION = $data['Section'];
$sql = "SELECT * FROM position_votes where S_id='$S_ID'";
$count = mysqli_query($conn,$sql);
if(mysqli_num_rows($count)>0){
    $voted = "Yes";
}else{
    $voted = "No";
}
$output .="
    <tr>
    <td>".$NAME."</td>
    <td>".$S_ID."</td>
    <td>".$PASS."</td>
    <td>".$YEAR."</td>
    <td>".$COURSE."</td>
    <td class='buttons no-print'>".$SECTION."</td>
    <td class='buttons no-print'>".$voted."</td>
    <td class='buttons no-print'>
    <button class='edit' onclick='editdata(".json_encode($S_ID).");'>Edit</button>
    <button class='delete' onclick='deletedata(".json_encode($S_ID).");'>Delete</button>
    </td>
    </tr>
";
}
echo $output;
?>