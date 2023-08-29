<?php
session_start();
if(isset($_SESSION['ID']) == false){
    header("Location:index.php?n");
    exit;
}else{
    if(!$_SESSION['is_admin']==1){
        header("Location:index.php?n");
    }
}
$conn = new mysqli("localhost","root","","chs_voting");
$sql = "SELECT * from v_info";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/admin.css">
        <script src="js/main.js">
        </script>
        <title>Voters</title>
    </head>
    <body>
        <div class="container">
        <div class="menu no-print">
                <div class="mmsulogo"><img src="assets/mmsu logo.png" alt=""></div>
                <button class="menubtn" onclick="location.href='importdata.php'">Import Data</button>
                <button class="menubtn" onclick="location.href='adminc.php'">Candidate</button><br>
                <button class="menubtn current" disabled>Voter</button>
                <button class="menubtn" onclick="location.href='Result.php'">Result [Table]</button>
                <button class="menubtn" onclick="location.href='result_pie.php'">Result [Poster]</button>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content"> 
                    <div class="search no-print">
                        <form action="#" method="post" autocomplete="off">
                            <label id="count">Total Number of Voters: <?=$count?></label><br>
                            <label>Search:</label>
                            <input id="search" name="searchterm" type="text" placeholder="Search Voter/s">
                            <label>Course:</label>
                            <select id="coursesearch" name="course">
                                <option value="">All</option>
                                <option value="BSN">BSN</option>
                                <option value="BSP">BSP</option>
                                <option value="BSPT">BSPT</option>
                            </select>
                            <label>Year:</label>
                            <select id="yearsearch" name="year">
                                <option value="">All</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <label>Section:</label>
                            <select id="sectionsearch" name="section">
                                <option value="">All</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                            <a class="download" href="downloadexcel.php">Download File for distribution</a>
                     </form>
                    
                     </div>
                    <button class="add no-print">Add Voter</button>                
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Password</th>
                            <th>Year</th>
                            <th>Course</th>
                            <th class="no-print">Section</th>
                            <th class="no-print">Voted</th>
                            <th class="no-print">Operation</th>
                        </tr>
                        </thead>
                        <tbody class="Voters">
                        <tr>
                            <td>Error Accessing Database</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="myModal"class="modal no-print">
            <div class="modal-content">
                <span class="close">&#x2716;</span>
                <div class="error-text">This is an error text</div> 
                <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    
                    <input type="hidden" id="o_s_id" name="o_s_id" value="1">
                    <div class="input-small">
                    <label>Name:</label>
                    <input required id="name" name="name" type="text" placeholder="Name">
                    <label>ID:</label>
                    <input required id="id" name="S_id" type="text" placeholder="ID">
                    <label>Password:</label>
                    <input required id="pass" name="pass" type="text" placeholder="Password">
                    </div>
                    <div class="input-small">
                    <label>Year:</label>
                    <input required id="year" name="year" type="text" placeholder="Year">
                    <label>Course:</label>
                    <input required id="course" name="course" type="text" placeholder="Course">
                    <label>Section:</label>
                    <input required id="section" name="section" type="text" placeholder="Section">
                    </div>
                    <div class="form-button">
                    <input class="edit" type="submit" name="edit" value="Edit Candidate">
                    <input class="add form" type="submit" name="add" value="Add Candidate">
                    </div>
                </form>
                <button id="delete" class="delete">Delete</button>
            </div>
        </div>
        <div id="status_msg"class="modal no-print">
            <div class="modal-content">
                <span class="close">&#x2716;</span>
                <div id="status_p">Successfully Deleted Data!</div>
            </div>
        </div>

        <script src="js/adminv.js" defer></script>
    </body>
</html>