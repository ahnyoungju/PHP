<?php
    require_once('header.inc');
?>
<?php
    require_once('../bll/getLogin.php');
    /* Check Login */
    if( $login != true )
        require_once('nav_default.inc');
    else
        require_once('nav_login.inc');
?>
<section>VIEW PROJECT DETAILS</section>
<div id="loader"></div>
<article class="overflowX overflowY padding2 animate-bottom">
<?php

// include files from the DAL
require_once('../DAL/db_functions.php');
require_once('../BLL/utilities.php');
// run Query on Project table
readQuery("d_project");

debug_to_console("Reading project from database");

if($numRecords === 0) {
  // echo "<p class='warning'>No Project Found!</p>";
  displayWarning("No Project Found!");
}
else {
  $arrRows = NULL;

  echo "<table>";
  echo "<tr>";
  echo "<th>Project No</th> <th>Project Name</th>";
  echo "<th>Project Description</th> <th>Project Manager</th>";
  echo "<th>Start Date</th> <th>Finish Date</th>";
  echo "<th>Budget</th> <th>Cost To Date</th>";
  echo "<th>Tracking Statement</th> <th>Client No</th>";
  echo "<th></th>";
  echo "</tr>";

  while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr>";
    echo "<td>".$arrRows['Project_No']."</td>";
    echo "<td>".$arrRows['Project_Name']."</td>";
    echo "<td>".$arrRows['Project_Description']."</td>";
    echo "<td>".$arrRows['Project_Manager']."</td>";
    echo "<td>".$arrRows['Start_Date']."</td>";
    echo "<td>".$arrRows['Finish_Date']."</td>";
    echo "<td>$".$arrRows['Budget']."</td>";
    echo "<td>$".$arrRows['Cost_To_Date']."</td>";
    echo "<td>".$arrRows['Tracking_Statement']."</td>";
    echo "<td>".$arrRows['Client_No']."</td>";
    // Add links with Project_No passed as variable to edit and delete page
    echo "<td><a href='editProject.php?ID=".$arrRows['Project_No']."'>Edit</a>";
    echo "<br/><a href='../bll/deleteConfirm.php?TYPE=Project&amp;ID=".$arrRows['Project_No']."'>Delete</a></td>";
    echo "</tr>";
  }
  echo "</table>";
  // echo "<br /><p class='success'>".$numRecords." Records Returned</p>";
  displaySuccess($numRecords." Records Returned");

  // to add a new Records
  echo "<form action='addProject.php' method='post'>";
  echo "<input type='submit' class='floatLeft' name='btnAddProject' value='Add a New Project'/>";
  echo "</form>";
}
?>
</article>
<?php
  require('footer.inc');
?>
