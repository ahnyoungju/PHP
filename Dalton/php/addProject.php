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
?>
<section>ADD NEW PROJECT</section>
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
  $strProjectNoErr = "";
  $booProjectNo = $booProjectName = $booProjectDes = 0;
  $booStartDate = $booBudget = $booTracking = 0;
  $booOk = 1;

  if(isset($_POST["submit"])) {
    validateProject("addRecord");
  }

  /* Read Consultant List for selecting Project Manager */
  readQuery("d_consultant");
  if($numRecords == 0) {
    displayWarning("Enter Manager Details in Consultant Table Firstly!!!");
    $booOk = 0;
  }
  else {
    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ){
      $selOptionList .= "<option value='".$arrRows['Consultant_Id']."'>";
      $selOptionList .= $arrRows['Consultant_Id']."(".$arrRows['First_Name']." ".$arrRows['Last_Name'].")</option>";
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
      $selOptionList2 .= "<option value='".$arrRows['Client_No']."'>";
      $selOptionList2 .= $arrRows['Client_No']." - ";
      $selOptionList2 .= $arrRows['Company_Contact_Name']."(".$arrRows['Company_Name'].")</option>";
    }
    console_log($selOptionList2);
  }

  // if($booOk) {
    echo "<form action='addProject.php' method='POST'>";
    echo "<table class='verticalTBL'>";
    echo "<tr>";
      echo "<th>Project No</th>";
      echo "<td><input type='text' name='strProjectNo' size='20' ";
      if( $booProjectNo ) echo " value='' placeholder='$strProjectNoErr' />";
      else echo " value='$strProjectNo' />";
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
      if( $booProjectDes ) echo " value='' placeholder='Please enter a Project Description'/>";
      else echo " value='$strProjectDes' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Project Manager</th>";
      echo "<td><select name='strProjectManager'>$selOptionList</select>";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Start Date</th>";
      echo "<td><input type='date' name='strStartDate' size='20' ";
      if( $booStartDate ) echo " value='' placeholder='Please enter start date'/>";
      else if( $strStartDate==NULL||$strStartDate=="" )
        echo " value='".date("Y-m-d")."' />";
      else echo " value='$strStartDate' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Finish Date</th>";
      echo "<td><input type='date' name='strFinishDate' size='20' ";
      echo " value='$strFinishDate' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Budget</th>";
      echo "<td><input type='text' name='strBudget' size='20' ";
      if( $booBudget ) echo " value='' placeholder='Please enter Project Budget'/>";
      else echo " value='$strBudget' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Cost To Date</th>";
      echo "<td><input type='text' name='strCostToDate' size='20' ";
      echo " value='$strCostToDate' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Tracking Statement</th>";
      echo "<td><input type='text' name='strTracking' size='20' ";
      if( $booTracking ) echo " value='' placeholder='Please enter Project Tracking Statement'/>";
      else echo " value='$strTracking' />";
    echo "</td></tr>";
    echo "<tr>";
      echo "<th>Client No</th>";
      echo "<td><select name='strClient'>$selOptionList2</select></td>";
    echo "</td></tr>";
    echo "</table>";
    echo "<input type='submit' class='floatLeft' name='submit' value='Submit New Project' />";
    echo "</form>";
  // }
?>
</article>
<?php
  require('footer.inc');
?>
