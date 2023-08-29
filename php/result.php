<?php
session_start();
$conn = new mysqli("localhost","root","","chs_voting");
if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
$sql = "Select * from v_info";
$base_pos=1;
$num = mysqli_num_rows(mysqli_query($conn,$sql));//count the number of registered accounts
$output = " 
          <header>Result of the Votes - Table</header>                       
          <p> Total Amount of Voters:".$num."</p>
          <table>
          <thead>
          <tr>
          <th>Candidate Name</th>
          <th>Position</th>
          <th>Student ID</th>
          <th>Course</th>
          <th>Year</th>
          <th>Section</th>
          <th>Votes</th>
          <th>%Votes</th>
          </tr>
          </thead>";
$sql = "Select Candidate_id,S_name,position,S_id,Course,S_year,Section,vote_count from candi_info;";
$result = mysqli_query($conn,$sql);
function get_pos($pos_id){
  $pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
        'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
        'PT Rep'];
  return $pos[$pos_id-1];
}
while($row = mysqli_fetch_assoc($result)){
if($row['Candidate_id'] == 1 ||$row['Candidate_id'] == 2){//skip abstain ID
  continue;
}

$vote_percent = ($row['vote_count']/$num)*100;
$vote_percent = number_format($vote_percent,2);
$vote_percent .="%";
if($base_pos!=$row['position']){
  $base_pos = $row['position'];
  $details =["",'','','','','','',''];
}else{
$details = [$row['S_name'],get_pos($row['position']),$row['S_id'],$row['Course'],$row['S_year'],$row['Section'],$row['vote_count'],$vote_percent];
}
$output .="<tr>";
for($i = 0;$i<sizeof($details);$i++){
$output .="<td>".$details[$i]."</td>";}
}
$output .="</tr>";
echo $output;

?>