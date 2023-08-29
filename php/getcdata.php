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

function get_pos($pos_id){
    $pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
          'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
          'PT Rep'];
    return $pos[$pos_id-1];
  }
$output="";
if(isset($_POST['searchterm']) && isset($_POST['course']) && isset($_POST['year']) && isset($_POST['section'])){
    $SEARCHTERM = $_POST['searchterm'];
    $COURSETERM = $_POST['course'];
    $YEARTERM = $_POST['year'];
    $SECTIONTERM = $_POST['section'];
    $POSTERM = $_POST['position'];
    $sql = "SELECT * from candi_info 
    where S_name like '%{$SEARCHTERM}%' and Course like '%{$COURSETERM}' and S_year like '%{$YEARTERM}%' and Section like '%{$SECTIONTERM}%' and position like '$POSTERM'";
}else{
    $sql = "SELECT * from candi_info";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
if($row['Candidate_id']==1 ||$row['Candidate_id']==2){
    continue;
}
$S_ID = $row['S_id'];
$NAME = $row['S_name'];
$POSITION = get_pos($row['position']);
$YEAR = $row['S_year'];
$COURSE = $row['Course'];
$SECTION = $row['Section'];
$PLATFORM = $row['platform'];
$C_ID = $row['Candidate_id'];
$VOTES = $row['vote_count'];

$output .="
    <tr>
    <td>".$NAME."</td>
    <td>".$POSITION."</td>
    <td>".$S_ID."</td>
    <td>".$YEAR."</td>
    <td>".$COURSE."</td>
    <td>".$SECTION."</td>
    <td>".$VOTES."</td>
    <td><img src='assets/".$row['img']."' onerror='imgerror(this);'></td>
    <td class='platform'>".$PLATFORM."</td>
    <td class='buttons'>
    <button class='edit' onclick='editdata(".$C_ID.");'>Edit</button>
    <button class='delete' onclick='deletedata(".$C_ID.");'>Delete</button>
    </td>
    </tr>
";
}
echo $output;
?>