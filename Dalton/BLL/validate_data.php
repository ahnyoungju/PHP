<?php

function validateConsultant($saveAction) {
  global $strConsId , $strFirstName , $strLastName;
  global $strPhone , $strMobile , $strEmail , $strDateCommenced;
  global $strDOB , $strStreet , $strSuburb , $strPost;

  global $strConsIdErr, $strPostErr;

  global $booConsId , $booFirstName , $booLastName;
  global $booPhone, $booEmail, $booDateCommenced, $booDOB;
  global $booStreet, $booSuburb, $booPost;
  global $booOk;

  if($_POST["strConsId"] == NULL) {
    $booConsId = 1;
    $strConsIdErr = "Please enter a Consultant ID";
    $booOk = 0;
  }
  else if( strlen($_POST["strConsId"]) != 9) {
    $booConsId = 1;
    $strConsIdErr = "Consultant ID should be 9 character long";
    $booOk = 0;
  }
  else
    $strConsId = strtoupper($_POST["strConsId"]);

  if($_POST["strFirstName"] == NULL) {
    $booFirstName = 1;
    $booOk = 0;
  }
  else
    $strFirstName = $_POST["strFirstName"];

  if($_POST["strLastName"] == NULL) {
    $booLastName = 1;
    $booOk = 0;
  }
  else
    $strLastName = $_POST["strLastName"];

  if($_POST["strPhone"] == NULL) {
    $booPhone = 1;
    $booOk = 0;
  }
  else
    $strPhone = $_POST["strPhone"];

  $strMobile = $_POST["strMobile"];

  if($_POST["strEmail"] == NULL) {
    $booEmail = 1;
    $booOk = 0;
  }
  else
    $strEmail = $_POST["strEmail"];

  if($_POST["strDateCommenced"] == NULL) {
    $booDateCommenced = 0;
    $booOk = 0;
  }
  else
    $strDateCommenced = $_POST["strDateCommenced"];

  if($_POST["strDOB"] == NULL) {
    $booDOB = 1;
    $booOk = 0;
  }
  else
    $strDOB = $_POST["strDOB"];

  if($_POST["strStreet"] == NULL) {
    $booStreet = 1;
    $booOk = 0;
  }
  else
    $strStreet = $_POST["strStreet"];

  if($_POST["strSuburb"] == NULL) {
    $booSuburb = 1;
    $booOk = 0;
  }
  else
    $strSuburb = $_POST["strSuburb"];

  if($_POST["strPost"] == NULL) {
    $booPost = 1;
    $booOk = 0;
    $strPostErr = "Please enter Post Code";
  }
  else if( $_POST["strPost"] > 10000 || $_POST["strPost"] < 999 ) {
    $booPost = 1;
    $booOk = 0;
    $strPostErr = "POST CODE should be 4 digit number!";
  }
  else
    $strPost = $_POST["strPost"];

  if($booOk)
	{
		if ($saveAction == "addRecord")
		    insertConsultant();
		else
		    updateConsultant();

		//Redirect to the view branch page if no errors occurred
		if ($booOk)
   	  header("Location: viewConsultant.php");
	}
	else {
		//echo "<br />Something wrong!!!";
    displayWarning("Something wrong!!!");
	}
}

function validateProject($saveAction) {
  global $strProjectNo, $strProjectName, $strProjectDes;
  global $strProjectManager, $strStartDate, $strFinishDate;
  global $strBudget, $strCostToDate, $strTracking, $strClient;
  global $strProjectNoErr;
  global $booProjectNo, $booProjectName, $booProjectDes;
  global $booStartDate, $booBudget, $booTracking;
  global $booOk;

  if($_POST["strProjectNo"] == NULL) {
    $booProjectNo = 1;
    $strProjectNoErr = "Please enter a Project Number";
    $booOk = 0;
  }
  else if( strlen($_POST["strProjectNo"]) != 7) {
    $booProjectNo = 1;
    $strProjectNoErr = "Project Number should be 7 character long";
    $booOk = 0;
  }
  else
    $strProjectNo = strtoupper($_POST["strProjectNo"]);

  if($_POST["strProjectName"] == NULL) {
    $booProjectName = 1;
    $booOk = 0;
  }
  else
    $strProjectName = $_POST["strProjectName"];

  $strProjectManager = $_POST["strProjectManager"];

  if($_POST["strProjectDes"] == NULL) {
    $booProjectDes = 1;
    $booOk = 0;
  }
  else
    $strProjectDes = $_POST["strProjectDes"];

  if($_POST["strStartDate"] == NULL) {
    $booStartDate = 1;
    $booOk = 0;
  }
  else
    $strStartDate = $_POST["strStartDate"];

  $strFinishDate = $_POST["strFinishDate"];

  if($_POST["strBudget"] == NULL) {
    $booBudget = 1;
    $booOk = 0;
  }
  else
    $strBudget = $_POST["strBudget"];

  $strCostToDate = $_POST["strCostToDate"];

  // if($_POST["strTracking"] == NULL) {
  //   $booTracking = 1;
  //   $booOk = 0;
  // }
  // else
    $strTracking = $_POST["strTracking"];

  $strClient = $_POST["strClient"];

  if($booOk)
	{
		if ($saveAction == "addRecord")
		    insertProject();
		else
		    updateProject();

		//Redirect to the view branch page if no errors occurred
		if ($booOk)
   	  header("Location: viewProject.php");
	}
	else {
		//echo "<br />Something wrong!!!";
    displayWarning("Something wrong!!!");
	}
}
?>
