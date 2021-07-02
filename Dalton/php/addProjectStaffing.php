<?php
    require_once('header.inc');
?>
<?php
  require_once('../bll/getLogin.php');
  global $login;
  /* Check Login */
  if( $login != true )
    require_once('nav_default.inc');
  else
    require_once('nav_login.inc');

  /* GET Project_No */
  if( isset($_POST["strProject_No"]) )
    $strProject_No = $_POST["strProject_No"];
  if( isset($_GET["strProject_No"]) )
    $strProject_No = $_GET["strProject_No"];
?>
<section>ADD <?php echo $strProject_No; ?> PROJECT STAFFING DETAILS</section>
<div id="loader"></div>
<article class="padding1 animate-bottom">
<?php
  // include files from the DAL
  require_once('../DAL/db_functions.php');
  require_once('../BLL/validate_data.php');
  require_once('../BLL/utilities.php');

  $strConsultant_Id = $strDate_Assigned = $strDate_Completed = "";
  $strRole = $strHours_Worked = "";
  $booOk = 1;
  $blnblankForm = 0;

  if(isset($_POST["submit"])) {
    $strConsultant_Id = $_POST['strConsultant_Id'];
    $strProject_No = $_POST['strProject_No'];
    $strDate_Assigned = $_POST['strDate_Assigned'];
    $strDate_Completed = $_POST['strDate_Completed'];
    $strRole = $_POST['strRole'];
    $strHours_Worked =  $_POST['strHours_Worked'];
    //validateStaffing("addRecord");
    insertStaffing();
    $blnblankForm = 1;
  }
  if (!(isset($_POST["submit"])) or $blnblankForm = 1 or $booOk = 0 ){
    // $strConsultant_Id = "";
    // $strDate_Assigned = "";
    // $strDate_Completed = "";
    // $strRole = "";
    // $strHours_Worked = "";
    $blnblankForm = 0;
  }

  /* Display Project Details for reference */
  echo "<h4>".$strProject_No." Project Details</h4>";
  readSingleQuery("d_project", "Project_No", $strProject_No, "NonNumeric");
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

  /* Staffing */
  echo "<h4>Add New Staff</h4>";
  $selOptionList = "";
  $sql = " SELECT Consultant_Id, First_Name, Last_Name ";
  $sql.= " FROM d_consultant ";
  $sql.= " WHERE Consultant_Id not in ( SELECT Consultant_Id FROM d_project_consultant ";
  $sql.= "                     WHERE Project_No = '".$strProject_No."' )";

  readQuery2($sql);
  if($numRecords == 0) {
    displayWarning("Enter Consultant Details in Consultant Table Firstly!!!");
    $booOk = 0;
  }
  else {
    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ){
      $selOptionList .= "<option value='".$arrRows['Consultant_Id']."'>";
      $selOptionList .= $arrRows['Consultant_Id']."(".$arrRows['First_Name']." ".$arrRows['Last_Name'].")</option>";
    }
    console_log($selOptionList);
  }

  echo "<form action='addProjectStaffing.php' method='POST'>";
  echo "<table class='verticalTBL'>";
  echo "<tr>";
    echo "<th>Consultant Id</th>";
    echo "<td><select name='strConsultant_Id' class='floatLeft'>";
    echo $selOptionList."</td></tr>";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Project No</th>";
    echo "<td><input type='text' name='Project_No' size='20' ";
    echo " value='$strProject_No' disabled />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Date Assigned</th>";
    echo "<td><input type='date' name='strDate_Assigned' size='20' ";
    if( $strDate_Assigned == NULL || $strDate_Assigned == "" )
      echo " value='".date("Y-m-d")."' />";
    else echo " value='$strDate_Assigned' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Date Completed</th>";
    echo "<td><input type='date' name='strDate_Completed' size='20' value='$strDate_Completed' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Role</th>";
    echo "<td><select name='strRole'>";
    echo "<option value='Programmer'>Programmer</option>";
    echo "<option value='Web Designer'>Web Designer</option>";
    echo "<option value='Network Engineer'>Network Engineer</option>";
    echo "<option value='Software Architect'>Software Architect</option>";
    echo "<option value='Database Designer'>Database Designer</option>";
    echo "<option value='Database Administrator'>Database Administrator</option>";
    echo "<option value='Project Manager'>Project Manager</option>";
    echo "<option value='System Analyst'>System Analyst</option>";
    echo "<option value='Hardware Architect'>Hardware Architect</option>";
    echo "<option value='Tester'>Tester</option>";
    echo "<option value='Security'>Security</option>";
    echo "</select></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Hours Worked</th>";
    echo "<td><input type='text' name='strHours_Worked' size='20' value='$strHours_Worked' /></td>";
  echo "</tr>";
  echo "</table>";
  echo "<td><input type='hidden' name='strProject_No' size='20' value='$strProject_No'/>";
  echo "<input type='submit' class='floatLeft' name='submit' value='Assign New Consultant' />";
  echo "</form>";
  echo "<br/>";

  echo "<h4>".$strProject_No." Project Staffing Details</h4>";
  // displaySuccess( $Project_No." Project Staffing Details");
  //debug_to_console($sql);
  readSingleQuery("d_project_consultant", "project_no", $strProject_No, "NonNumeric");

  if( $numRecords === 0 ) {
    displayWarning("No Staff Assigned in ".$strProject_No."!");
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
?>
</article>
<?php
  require('footer.inc');
?>
