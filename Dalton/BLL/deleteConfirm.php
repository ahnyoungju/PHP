<?php
  require_once('../php/header.inc');
?>
<?php
  require_once('getLogin.php');

  global $login;
  /* Check Login */
  echo "<nav><ul class='breadcrumb'>";
  if( $login != true ) {
    //require_once('../php/nav_default.inc');
    echo "<li><a href='../php/index.php'>ABOUT US</a></li>";
    echo "<li><a href='../php/contactUs.php'>CONTACT US</a></li>";
    echo "<li><a href='../php/login.php'>LOGIN</a></li>";
  }
  else {
    // require_once('../php/nav_login.inc');
    echo "<li><a href='../php/index.php'>ABOUT US</a></li>";
    echo "<li><a href='../php/contactUs.php'>CONTACT US</a></li>";
    echo "<li><a href='../php/viewConsultant.php' class='item'>CONSULTANTS</a></li>";
    echo "<li><a href='../php/viewProject.php' class='item'>PROJECTS</a></li>";
    echo "<li><a href='../php/viewProjectstaffing.php' class='item'>PROJECT STAFFING </a></li>";
    if( !empty($_SESSION['UserID'])) {
      echo "<li class='topnav-right'><a href='login.php' class='item'>Logout</a></li>";
      echo "<span class='loginstatus'>".$_SESSION['UserID']." logged in</span>";
    }
  }
  echo "</ul></nav>";
?>
<section>Are you sure you want to delete the <em><?php $_GET['ID'] ?></php></em> record?</section>
<article class="overflowX padding2">
<?php
  // include files from the DAL
  require_once('../DAL/db_functions.php');
  require_once('../BLL/utilities.php');
  // run Query on Customer  table

  echo "<form action='deleteConfirm.php' method='GET'>";
  echo "<input type='submit' name='okDelete' value='Delete Record' /><br /><br />";
  echo "<input type='submit' name='cancel' value='Cancel Deletion' /><br /><br />";
  echo "<input type='hidden' name='ID' value='".$_GET['ID']."' />";
  echo "<input type='hidden' name='TYPE' value='".$_GET['TYPE']."' />";
  if( isset($_GET['NUM']) )
    echo "<input type='hidden' name='NUM' value='".$_GET['NUM']."' />";
  echo "</form>";

  $booDeleteDone = false;
  if( isset($_GET['okDelete']) ) {
		if( $_GET['TYPE'] == "Consultant" ) {
			deleteRecord("d_consultant", "Consultant_Id",$_GET['ID'],"varchar");

			// check to see if the record was deleted
			if($booDeleteDone) {
				//Redirect to the view branch page if no errors occurred
				header("Location: ../php/viewConsultant.php");
			}
			else {
				// Record was not deleted
        displayWarning("You can not delete this record!<br />"."Other records in the system depend on it<br />"."Press 'Cancel Deletion' to return</p>");
			}
		}
		else if( $_GET['TYPE'] == "Project" ) {

			deleteRecord("d_project", "Project_No",$_GET['ID'],"varchar");
			// check to see if the record was deleted
			if($booDeleteDone) {
				//Redirect to the view branch page if no errors occurred
				header("Location: ../php/viewProject.php");
			}
			else {
				// Record was not deleted
        displayWarning("You can not delete this record!"."Other records in the system depend on it<br />"."Press 'Cancel Deletion' to return</p>");
			}
		}
    else if( $_GET['TYPE'] == "STAFFING" )  {
      $whereSql = " Consultant_Id = '".$_GET['ID']."' and Project_No = '".$_GET['NUM']."' ";
      deleteRecord2("d_project_consultant", $whereSql);

      if($booDeleteDone) {
				//Redirect to the view branch page if no errors occurred
				header("Location: ../php/viewProjectStaffing.php?ID=".$_GET['NUM']);
			}
			else {
				// Record was not deleted
        displayWarning("You can not delete this record!"."Press 'Cancel Deletion' to return</p>");
			}
    }
	}
	if( isset($_GET['cancel'])) {
		if( $_GET['TYPE'] == "Consultant" )
			header("Location: ../php/viewConsultant.php");
		else if( $_GET['TYPE'] == "Project" )
			header("Location: ../php/viewProject.php");
    else if( $_GET['TYPE'] == "STAFFING" )
      header("Location: ../php/viewProjectStaffing.php?ID=".$_GET['NUM']);
	}
?>
</article>
<?php
  require('../php/footer.inc');
?>
