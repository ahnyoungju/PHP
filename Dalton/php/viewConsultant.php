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
<section>VIEW CONSULTANT DETAILS</section>
<div id="loader"></div>
<article class="overflowX padding2 animate-bottom">
<?php
  // include files from the DAL
  require_once('../DAL/db_functions.php');
  require_once('../BLL/utilities.php');
  // run Query on Customer  table
  readQuery("d_consultant");

  debug_to_console("Reading consultant from database");

  if($numRecords === 0) {
    //echo "<p class='warning'>No Consultants Found!</p>";
    displayWarning("No Consultants Found!");
  }
  else {
    $arrRows = NULL;

    echo "<table>";
    echo "<tr>";
    echo "<th>Consultant Id</th> <th>First Name</th> <th>Last Name</th>";
    echo " <th>Home Phone</th> <th>Mobile</th> <th>Email</th>";
    echo " <th>Date Commenced</th> <th>Date of Birth</th> <th>Street Address</th>";
    echo " <th>Suburb</th> <th>Post Code</th><th></th>";
    echo "</tr>";

    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ) {

      echo "<tr>";
      echo "<td>".$arrRows['Consultant_Id']."</td>";
      echo "<td>".$arrRows['First_Name']."</td>";
      echo "<td>".$arrRows['Last_Name']."</td>";
      echo "<td>".$arrRows['Home_Phone']."</td>";
      echo "<td>".$arrRows['Mobile']."</td>";
      echo "<td>".$arrRows['Email']."</td>";
      echo "<td>".$arrRows['Date_Commenced']."</td>";
      echo "<td>".$arrRows['DOB']."</td>";
      echo "<td>".$arrRows['Street_Address']."</td>";
      echo "<td>".$arrRows['Suburb']."</td>";
      echo "<td>".$arrRows['Post_Code']."</td>";
      // Add links with consultant_id passed as variable to edit and delete page
      echo "<td><a href='editConsultant.php?ID=".$arrRows['Consultant_Id']."'>Edit</a>";
      echo "<br/><a href='../bll/deleteConfirm.php?TYPE=Consultant&amp;ID=".$arrRows['Consultant_Id']."'>Delete</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    //echo "<br /><p class='success'>".$numRecords." Records Returned</p>";
    displaySuccess($numRecords." Records Returned</p>");
  } //end of else

  // to add a new Records
  echo "<form action='addConsultant.php' method='post'>";
  echo "<input type='submit' class='floatLeft' name='btnAddCon' value='Add a New Consultant'/>";
  echo "</form>";
  // for error messges
  //echo "<br><p class='warning'>".print_r(error_get_last())."</p>";
?>
</article>
<?php
  require('footer.inc');
?>
