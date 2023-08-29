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
$sql = "SELECT * from candi_info";
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
        <title>Candidate</title>
    </head>
    <body>
        <div class="container">
        <div class="menu no-print">
                <div class="mmsulogo"><img src="assets/mmsu logo.png" alt=""></div>
                <button class="menubtn" onclick="location.href='importdata.php'">Import Data</button>
                <button class="menubtn current" disabled>Candidate</button><br>
                <button class="menubtn" onclick="location.href='adminv.php'">Voter</button>
                <button class="menubtn" onclick="location.href='Result.php'">Result [Table]</button>
                <button class="menubtn" onclick="location.href='result_pie.php'">Result [Poster]</button>
                <button class="menubtn" onclick="location.href='php/logout.php'">Logout</button>
            </div>
            <div class="main_content">
                <!--Put all contents here please-->
                <div class="content"> 
                <div class="search">
                        <form action="#" method="post" autocomplete="off">
                        <label>Total Number of Candidates: <?=$count?></label><br>
                            <label>Search:</label>
                            <input id="search" name="searchterm" type="text" placeholder="Search Candidate/s">
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
                            <label>Position:</label>
                            <select required id="positionsearch" name="position">
                            <option value="%">All</option>
                            <option value="1">President</option>
                            <option value="2">Vice President</option>
                            <option value="3">Secretary</option>
                            <option value="4">Assistant Secretary</option>
                            <option value="5">Treasurer</option>
                            <option value="6">Assistant Treasurer</option>
                            <option value="7">Auditor</option>
                            <option value="8">PIO</option>
                            <option value="9">Business Manager</option>
                            <option value="10">Nursing Rep</option>
                            <option value="11">Pharma Rep</option>
                            <option value="12">PT Rep</option>
                            </select>
                     </form>
                     </div>
                    <button class="add">Add Candidate</button>                
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Votes</th>
                            <th>Image</th>
                            <th>Platform</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody class="Candidate">
                        <tr>
                            <td>Error accessing database</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="myModal"class="modal">
            <div class="modal-content">
                <span class="close">&#x2716;</span>
                <div class="error-text">This is an error text</div>
                <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" id="candi_id" name="candi_id" value="1">
                    <div class="input-small">
                    <label>Name:</label>
                    <input required id="name" name="name" type="text" placeholder="Name">
                    <label>Position:</label>
                    <select required id="position" name="position">
                    <option value="1">President</option>
                    <option value="2">Vice President</option>
                    <option value="3">Secretary</option>
                    <option value="4">Assistant Secretary</option>
                    <option value="5">Treasurer</option>
                    <option value="6">Assistant Treasurer</option>
                    <option value="7">Auditor</option>
                    <option value="8">PIO</option>
                    <option value="9">Business Manager</option>
                    <option value="10">Nursing Rep</option>
                    <option value="11">Pharma Rep</option>
                    <option value="12">PT Rep</option>
                    </select>
                    <label>ID:</label>
                    <input required id="id" name="S_id" type="text" placeholder="ID">
                    </div>
                    <div class="input-small">
                    <label>Year:</label>
                    <input required id="year" name="year" type="text" placeholder="Year">
                    <label>Course:</label>
                    <input required id="course" name="course" type="text" placeholder="Course">
                    <label>Section:</label>
                    <input required id="section" name="section" type="text" placeholder="Section">
                    </div>
                    <div class="input image">
                    <label>Image - Don't send a file if you want to keep the current image.</label>
                    <input id="image" name="image" type="file">
                    </div>
                    <div class="input-platform">
                    <p><label>Platform</label></p>
                    <textarea id="platform" name="platform" maxlength="1000"></textarea>
                    </div>
                    <div class="form-button">
                    <input class="edit" type="submit" name="edit" value="Edit Candidate">
                    <input class="add form" type="submit" name="add" value="Add Candidate">
                    </div>
                </form>
                <button id="delete" class="delete">Delete</button>
            </div>
        </div>
        <div id="status_msg"class="modal">
            <div class="modal-content">
                <span class="close">&#x2716;</span>
                <div id="status_p">Successfully Deleted Data!</div>
            </div>
        </div>

        <script src="js/admin.js" defer></script>
    </body>
</html>