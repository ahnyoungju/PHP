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
<section>VIEW PROJECT STAFFING DETAILS</section>
<div id="loader"></div>
<article class="padding2 animate-bottom">
<?php
// include files from the DAL
require_once('../DAL/db_functions.php');
require_once('../BLL/utilities.php');

// run Query on Project  table
readQuery("d_project");

debug_to_console("Reading project from database");

if($numRecords === 0) {
  displayWarning("No Project Found!");;
}
else {
  echo "<form action='viewProjectstaffing.php' method='POST'>";
  echo "<select name='Project_No' class='floatLeft'>";
  while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<option value=".$arrRows['Project_No'].">".$arrRows['Project_No'].": ".$arrRows['Project_Name']." </option>";
  }
  echo "</select>";
  echo "<input class='floatLeft' name='btnSP' type='submit' value='Show Projects' />";
  echo "</form><br />";
}

if( isset($_POST["btnSP"]) || isset($_GET["ID"]) ) {
  if( isset($_POST["Project_No"]) )
    $Project_No = $_POST["Project_No"];
  if( isset($_GET["ID"]) )
    $Project_No = $_GET["ID"];

  debug_to_console($Project_No." project staffing details");
  // echo "<br />";

  echo "<h4>".$Project_No." Project Staffing Details</h4>";
  // displaySuccess( $Project_No." Project Staffing Details");
  //debug_to_console($sql);
  readSingleQuery("d_project_consultant", "project_no", $Project_No, "NonNumeric");

  if( $numRecords === 0 ) {
    displayWarning("No Staff Assigned in ".$Project_No."!");
  }
  else {
    echo "<table>";
    echo "<tr><th>Consultant ID</th><th>Project No</th><th>Date Assigned</th><th>Date Completed</th><th>Role</th><th>Hours Worked</th><th>&nbsp;</th></tr>";
    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      debug_to_console($arrRows);
      echo "<tr>";
      echo "<td>".$arrRows['Consultant_Id']."</td>";
      echo "<td>".$arrRows['Project_No']."</td>";
      echo "<td>".$arrRows['Date_Assigned']."</td>";
      echo "<td>".$arrRows['Date_Completed']."</td>";
      echo "<td>".$arrRows['Role']."</td>";
      echo "<td>".$arrRows['Hours_Worked']."</td>";
      echo "<td>";
      echo "<a href='editProjectStaffing.php?ID=".$arrRows['Consultant_Id'];
      echo "&amp;NUM=".$arrRows['Project_No']."'>Edit</a>";
      echo "<br/><a href='../bll/deleteConfirm.php?TYPE=STAFFING";
      echo "&amp;ID=".$arrRows['Consultant_Id'];
      echo "&amp;NUM=".$arrRows['Project_No']."'>Delete</a>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
  } // end of count if
  echo "<form action='addProjectStaffing.php' method='POST'>";
  echo "<input type='hidden' name='strProject_No' value='".$Project_No."' />";
  echo "<input id='assignConsultant' class='floatLeft' type='submit' value='Assign a Consultant' />";
  echo "</form>";
} // end of button if
?>
</form>
</article>
<aside>&nbsp;</aside>

<?php
  require('footer.inc');
?>
