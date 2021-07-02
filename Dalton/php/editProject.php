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
<section>EDIT PROJECT</section>
<div id="loader"></div>
<article class="overflowX padding2 animate-bottom">
<?php
  // include files from the DAL
  require_once('../DAL/db_functions.php');
  require_once('../BLL/validate_data.php');
  require_once('../BLL/utilities.php');

  $strProjectNo = $strProjectName = $strProjectDes = "";
  $strProjectManager = $strStartDate = $strFinishDate = "";
  $strBudget = $strCostToDate = $strTracking = $strClient = "";

  $selOptionList = $selOptionList2 = "";

  $booProjectNo = $booProjectName = $booProjectDes = 0;
  $booStartDate = $booBudget = $booTracking = 0;
  $booOk = 1;

  if(isset($_POST["submit"])) {
    validateProject("editRecord");
  }

  if(isset($_GET['ID'])) {
    $strProjectNo = $_GET['ID'];
    console_log("Project No: ".$strProjectNo);
  }
  if(isset($_POST['ID'])) {
    $strProjectNo = $_POST['strProjectNo'];
    console_log("Project No: ".$strProjectNo);
  }

  readSingleQuery("d_project", "Project_No", $strProjectNo, "varchar");
  // Test to see that we get a single record record returned
  if($numRecords == 0) {
    displayWarning("No matching project No: ".$strProjectNo);
  }
  else {
    $arrRows =$stmt->fetch(PDO::FETCH_ASSOC);
    $strProjectNo = $arrRows['Project_No'];
    $strProjectName = $arrRows['Project_Name'];
    $strProjectDes = $arrRows['Project_Description'];
    $strProjectManager = $arrRows['Project_Manager'];
    $strStartDate = $arrRows['Start_Date'];
    $strFinishDate = $arrRows['Finish_Date'];
    $strBudget = $arrRows['Budget'];
    $strCostToDate = $arrRows['Cost_To_Date'];
    $strTracking = $arrRows['Tracking_Statement'];
    $strClient = $arrRows['Client_No'];
  }

  /* Read Consultant List for selecting Project Manager */
  readQuery("d_consultant");
  if($numRecords == 0) {
    displayWarning("No Record in Consultants!!!");
    $booOk = 0;
  }
  else {
    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ){
      $selOptionList .= "<option value='".$arrRows['Consultant_Id']."' ";
      if($strProjectManager == $arrRows['Consultant_Id'])
        $selOptionList .= " selected ";
      $selOptionList .= ">".$arrRows['Consultant_Id'];
      $selOptionList .= "(".$arrRows['First_Name']." ".$arrRows['Last_Name'].")</option>";
    }
    console_log($selOptionList);
  }
  /* Read Client List */
  readQuery("d_client");
  if($numRecords == 0) {
    displayWarning("Enter Client Details in Client Table Firstly!!!");
    $booOk = 0;
  }
  else {
    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ){
      $selOptionList2 .= "<option value='".$arrRows['Client_No'];
      if($strClient == $arrRows['Client_No'])
        $selOptionList2 .= " selected ";
      $selOptionList2 .= "'>".$arrRows['Client_No']." - ";
      $selOptionList2 .= $arrRows['Company_Contact_Name']."(".$arrRows['Company_Name'].")</option>";
    }
    console_log($selOptionList2);
  }


//if($booOk) {
  echo "<form action='editProject.php' method='POST'>";
  echo "<table class='verticalTBL'>";
  echo "<tr>";
    echo "<th>Project No</th>";
    echo "<td><input type='text' name='projectNo' size='20' value='$strProjectNo' disabled />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Project Name</th>";
    echo "<td><input type='text' name='strProjectName' size='20' ";
    if( $booProjectName ) echo " value='' placeholder='Please enter a Project Name' />";
    else echo " value='$strProjectName' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Project Description</th>";
    echo "<td><input type='text' name='strProjectDes' size='20' ";
    echo " value='$strProjectDes' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Project Manager</th>";
    // echo "<td><input type='text' name='strProjectManager' size='20' ";
    // if( $booProjectManager ) echo " value='' placeholder='Please enter a Project Manager' />";
    // else echo " value='$strProjectManager' />";
    echo "<td><select name='strProjectManager'>$selOptionList</select>";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Start Date</th>";
    echo "<td><input type='text' name='strStartDate' size='20' ";
    echo " value='$strStartDate' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Finish Date</th>";
    echo "<td><input type='text' name='strFinishDate' size='20' ";
    echo " value='$strFinishDate' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Budget</th>";
    echo "<td><input type='text' name='strBudget' size='20' ";
    echo " value='$strBudget' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Cost To Date</th>";
    echo "<td><input type='text' name='strCostToDate' size='20' ";
    echo " value='$strCostToDate' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Tracking Statement</th>";
    echo "<td><input type='text' name='strTracking' size='20' ";
    echo " value='$strTracking' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Client No</th>";
    echo "<td><select name='strClient'>$selOptionList2</select></td>";
  echo "</td></tr>";
  echo "</table>";
  echo "<input type='hidden' name='strProjectNo' size='20' value='$strProjectNo' />";
  echo "<input type='submit' class='floatLeft' name='submit' value='Edit Project' />";
  echo "</form>";
//}
?>
</article>
<?php
  require('footer.inc');
?>
