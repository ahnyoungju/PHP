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
<section>EDIT CONSULTANT</section>
<div id="loader"></div>
<article class="overflowX padding2 animate-bottom">
<?php
  // include files from the DAL
  require_once('../DAL/db_functions.php');
  require_once('../BLL/validate_data.php');
  require_once('../BLL/utilities.php');

  $strConsId = $strFirstName = $strLastName = "";
  $strPhone = $strMobile = $strEmail = $strDateCommenced = "";
  $strDOB = $strStreet = $strSuburb = $strPost = "";

  $booConsId = $booFirstName = $booLastName = 0;
  $booPhone = $booEmail = $booDateCommenced = $booDOB = 0;
  $booStreet = $booSuburb = $booPost = 0;
  $booOk = 1; // to check everything

  if(isset($_POST["submit"])) {
    validateConsultant("editRecord");
  }
  else {
    if(isset($_GET['ID'])) {
      $strConsId = $_GET['ID'];
      console_log("Get ID: ".$strConsId);
    }
    readSingleQuery("d_consultant", "Consultant_Id", $strConsId, "varchar");
    // Test to see that we get a single record record returned
    if($numRecords == 0) {
      displayWarning("No matching consultant id: ".$strConsId);
    }
    else {
      $arrRows =$stmt->fetch(PDO::FETCH_ASSOC);
      $strConsId = $arrRows['Consultant_Id'];
      $strFirstName = $arrRows['First_Name'];
      $strLastName = $arrRows['Last_Name'];
      $strPhone = $arrRows['Home_Phone'];
      $strMobile = $arrRows['Mobile'];
      $strEmail = $arrRows['Email'];
      $strDateCommenced = $arrRows['Date_Commenced'];
      $strDOB = $arrRows['DOB'];
      $strStreet = $arrRows['Street_Address'];
      $strSuburb = $arrRows['Suburb'];
      $strPost = $arrRows['Post_Code'];
    }
  }

  echo "<form action='editConsultant.php' method='POST'>";
  echo "<table class='verticalTBL'>";
  echo "<tr>";
    echo "<th>Consultant Id</th>";
    echo "<td><input type='text' name='consId' size='20' ";
    echo " value='$strConsId' disabled />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>First Name</th>";
    echo "<td><input type='text' name='strFirstName' size='20' ";
    if( $booFirstName ) echo " value='' placeholder='Please enter a First Name' />";
    else echo " value='$strFirstName' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Last Name</th>";
    echo "<td><input type='text' name='strLastName' size='20' ";
    if( $booLastName ) echo " value='' placeholder='Please enter a Last Name' />";
    else echo " value='$strLastName' />";
  echo "</td></tr>";
  echo "<tr>";
    echo "<th>Home Phone</th>";
    echo "<td><input type='text' name='strPhone' size='20' ";
    if( $booPhone ) echo " value='' placeholder='Please enter a Home Phone' /></td>";
    else echo " value='$strPhone' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Mobile</th>";
    echo "<td><input type='text' name='strMobile' size='20' value='$strMobile' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Email</th>";
    echo "<td><input type='text' name='strEmail' size='20' ";
    if( $booEmail ) echo " value='' placeholder='Please enter e-Mail' /></td>";
    else echo " value='$strEmail' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Date Commenced</th>";
    echo "<td><input type='date' name='strDateCommenced' size='20' ";
    if( $booDateCommenced ) echo " value='' placeholder='Please enter date commenced' /></td>";
    else echo " value='$strDateCommenced' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Date of Birth</th>";
    echo "<td><input type='date' name='strDOB' size='20' ";
    if( $booDOB ) echo " value='' placeholder='Please enter date of birth' /></td>";
    else echo " value='$strDOB' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Street Address</th>";
    echo "<td><input type='text' name='strStreet' size='20' ";
    if( $booStreet ) echo " value='' placeholder='Please enter Street Address' /></td>";
    else echo " value='$strStreet' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Suburb</th>";
    echo "<td><input type='text' name='strSuburb' size='20' ";
    if( $booSuburb ) echo " value='' placeholder='Please enter suburb' /></td>";
    else echo " value='$strSuburb' /></td>";
  echo "</tr>";
  echo "<tr>";
    echo "<th>Post Code</th>";
    echo "<td><input type='text' name='strPost' size='20' ";
    if( $booPost ) echo " value='' placeholder='Please enter Post Code' /></td>";
    else echo " value='$strPost' /></td>";
  echo "</tr>";
  echo "</table>";
  echo "<input type='hidden' name='strConsId' size='20' ";
  echo " value='$strConsId' />";
  echo "<input type='submit' class='floatLeft' name='submit' value='Update Consultant Details' />";
  echo "</form>";
?>
</article>
<?php
  require('footer.inc');
?>
