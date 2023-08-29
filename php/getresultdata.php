<?php
$conn = new mysqli("localhost","root","","chs_voting");
session_start();
function get_pos($pos_id){
    $pos = ['President','Vice President','Secretary','Assistant Secretary','Treasurer','Assistant Treasurer',
          'Auditor','Public Information Officer','Business Manager','Nursing Rep','Pharma Rep',
          'PT Rep'];
    return $pos[$pos_id-1];
  }
$data = [];
$output ="";
$sql = "SELECT * from v_info";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
for($i=1;$i<=12;$i++){
$sql = "SELECT S_name,course,S_year,Section,img,vote_count from candi_info where position={$i} order by vote_count desc limit 1";
$result = mysqli_query($conn,$sql);
$s = mysqli_fetch_row($result);
array_push($data,[$s[0],$s[1],$s[2],$s[3],$s[4],$s[5],get_pos($i)]);
}

foreach ($data as $w){
    if($w[4]==""){
        $img = "place_holder.webp";
    }else{
        $img = $w[4];
    }
    if($w[5]>1){
        $vote = $w[5]." votes";
    }else{
        $vote = $w[5]." vote";
    }
    $percent = ($w[5] / $count) *100;
    $percent = round($percent,1);
    $output .="
    <div class='person'>
    <div class='chart'>
    <div class='donut a'>
        <img class='hole' src='assets/".$img."'>
    </div>
    </div>
    <div class='data'>
    <div class='info'>
        <div class='person-info'>
            <span><h2>".$w[0]."</h2></span>
            <p>".$w[1]." ".$w[2]."".$w[3].",
            ".$w[6]."</p>
        </div>
            <div class='percent'>
                <h1>".$percent."%</h1>
            </div>
    </div>
        <div class='votes'>
        <h3>".$vote."</h3>
        </div>
    </div>
    </div>
    ";
}
    echo $output;

?>