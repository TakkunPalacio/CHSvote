<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
$error =0;
$error_msg = "Required fields are missing. Please close this window and select a candidate for the missing positions <br>";
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $pos = ['President','Vice_President','Secretary','Assistant_Secretary','Treasurer','Assistant_Treasurer',
        'Auditor','Public_Information_Officer','Business_Manager','Nursing_Rep','Pharma_Rep',
        'PT_Rep'];
    $pos1 = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
    'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
    'PT Rep'];
    for($i=0;$i<sizeof($pos);$i++){
    if(!isset($_POST[$pos[$i]])){
        $error_msg.= $pos1[$i]."<br> ";
        $error = 1;
    }}
    if($error){
        echo $error_msg;
        die;}

    
    $sql = "SELECT * from position_votes where S_id='".$_SESSION['ID']."'";//insert vote data
    $result = mysqli_query($conn,$sql);
    if($result->num_rows==0){
        $sql = "INSERT INTO position_votes (S_id,president,v_president,secretary,a_secretary,treasurer,a_treasurer,auditor,pio
    ,b_manager,nursing_rep,pharma_rep,pt_rep) VALUES ('".$_SESSION['ID']."',";
    for($i=0;$i<sizeof($pos)-1;$i++){
    $sql .= $_POST[$pos[$i]].",";}
    $sql.=$_POST[$pos[11]];
    $sql.=")";
    
    //print($sql."<br>");
    mysqli_query($conn,$sql);

    $sql = "Select Candidate_id,vote_count from candi_info";
    $result = mysqli_query($conn,$sql);//get current vote count
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "Update candi_info
    set vote_count = 
    Case
    when Candidate_id = ".$_POST[$pos[0]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[1]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[2]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[3]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[4]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[5]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[6]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[7]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[8]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[9]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[10]]." then vote_count+1
    when Candidate_id = ".$_POST[$pos[11]]." then vote_count+1
    end
    where Candidate_id in (".$_POST[$pos[0]].",".$_POST[$pos[1]].",".$_POST[$pos[2]].",".$_POST[$pos[3]].",".$_POST[$pos[4]].",
    ".$_POST[$pos[5]].",".$_POST[$pos[6]].",".$_POST[$pos[7]].",".$_POST[$pos[8]].",".$_POST[$pos[9]].",".$_POST[$pos[10]].",
    ".$_POST[$pos[11]].");";
    mysqli_query($conn,$sql);//update vote count
    $_SESSION['Voted'] = 1;
    echo "success";
    }else{
        print("There is duplicate <br>");
        print("Redirect back to voting page.");
        $_SESSION['Voted'] = 1;
        header("Location:../Candidate.php");
    }
}
?>
