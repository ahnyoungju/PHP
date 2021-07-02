<?php

// Library of Database Functions

// Database Connection Variables
$localhost="localhost";
$user="root";
$password="root";
$db="dalton";
$dsn="mysql:host=$localhost;dbname=$db;";

// Declare Global Variables
$dbConnection=NULL;
$stmt=NULL;
$numRecords=NULL;

// Establish MySQL Connection
function connect() {
  // use keyword global to access global variables
  global $user, $password, $dsn, $dbConnection; // Required to access global Variables

  try {
    // Create a PDO connection with the configuration data
    $dbConnection = new PDO($dsn, $user, $password);
  }
  catch(PDOException $error)  {
    // Display error message if applicable
    echo "<p class='warning'>An Error occured: ".$error->getMessage()."</p>";
  }
}

// Selecting all records from a table
function readQuery($table)
{
  global $numRecords, $dbConnection, $stmt;

  connect(); // run connect function

  // SQL Query - Results sorted by specified column
  $sqlStr = "SELECT * FROM ".$table.";";

  try {
    $stmt = $dbConnection->query($sqlStr);
    if($stmt === false) {
      die("Error executing the query: $sqlStr");
    }
  }
  catch(PDOException $error)  {
    // Display error message if could not run query
    echo "An Error occured: ".$error->getMessage();
  }

  $numRecords = $stmt->rowcount();

  // Close the database connection
  $dbConnection = NULL;
}

// Selecting all records from a table
function readQuery2($query)
{
  global $numRecords, $dbConnection, $stmt;

  connect(); // run connect function

  // SQL Query - Results sorted by specified column
  $sqlStr = $query;

  try {
    $stmt = $dbConnection->query($sqlStr);
    if($stmt === false) {
      die("Error executing the query: $sqlStr");
    }
  }
  catch(PDOException $error)  {
    // Display error message if could not run query
    echo "An Error occured: ".$error->getMessage();
  }

  $numRecords = $stmt->rowcount();

  // Close the database connection
  $dbConnection = NULL;
}

//Function to return a single record
function readSingleQuery($table, $column, $colValue, $colType)
{
	global $numRecords, $dbConnection, $stmt;

	connect(); //Run connect function

	$sqlStr = NULL;  //Initialise Variable to hold query

	if($colType === "numeric")
	{
		//Select Individual Record
		$sqlStr = "SELECT * FROM ".$table." WHERE ".$column." = ".$colValue.";";
	}
	else   //If Data-Type is non numeric
	{
		//Select Individual Record
		$sqlStr = "SELECT * FROM ".$table." WHERE ".$column." = '".$colValue."';";
	}

	//Run Query
	try 	{
		$stmt = $dbConnection->query($sqlStr);
		if($stmt === false)		{
			die("Error executing the query: $sqlStr");
		}
	}
	catch(PDOException $error)	{
		//Display error message if applicable
		echo "An Error occured: ".$error->getMessage();
	}

	//How many records are there?
	$numRecords = $stmt->rowcount();
  //echo "$numRecords rows selected";
	//Close the database connection
	$dbConnection = NULL;
}

// function to insert a consultant
function insertConsultant() {
  global $dbConnection, $stmt;
  global $strConsId , $strFirstName , $strLastName;
  global $strPhone , $strMobile , $strEmail , $strDateCommenced;
  global $strDOB , $strStreet , $strSuburb , $strPost;
  global $booOk;

  // connect to the database
  connect();

  // insert query
  $sqlStr = "INSERT INTO d_consultant VALUES (";
  $sqlStr.= "'".$strConsId."',"."'".$strFirstName."',"."'".$strLastName."',";
  $sqlStr.= "'".$strPhone."','".$strMobile."','".$strEmail."',";
  $sqlStr.= "'".$strDateCommenced."','".$strDOB."','".$strStreet."',";
  $sqlStr.= "'".$strSuburb."','".$strPost."');";

  //echo $sqlStr;
  // run insert Query
  try {
    $stmt = $dbConnection->query($sqlStr);

    if($stmt === false) {
      //displayWarning("Error executing the query: $sqlStr");
      $errinfo = ($dbConnection->errorInfo());
      // Display error message if could not run query
      if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
        displayWarning("The consultant id already exists.");
      $booOk = 0;
    }
    else {
      displaySuccess("The consultant:<strong>$strConsId</strong> has been added to the database.");
    }
  }
  catch(PDOException $error)  {
    $errinfo = ($dbConnection->errorInfo());
    // Display error message if could not run query
    if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
      displayWarning("The consultant id already exists.");
    else
      displayWarning("An Error occured: ".$error->getMessage());
    $booOk = 0;
  }
}

// Update Consultant record
function updateConsultant()  {
  global $dbConnection, $stmt;
  global $strConsId , $strFirstName , $strLastName;
  global $strPhone , $strMobile , $strEmail , $strDateCommenced;
  global $strDOB , $strStreet , $strSuburb , $strPost;
  global $booOk;

  connect();  // Run connect function
  // construct update SQL Statement
  $sqlStr = "UPDATE d_consultant SET ";
  $sqlStr .= "First_Name = '".$strFirstName."', ";
  $sqlStr .= "Last_Name = '".$strLastName."', ";
  $sqlStr .= "Home_Phone = '".$strPhone."', ";
  $sqlStr .= "Mobile = '".$strMobile."', ";
  $sqlStr .= "Email = '".$strEmail."', ";
  $sqlStr .= "Date_Commenced = '".$strDateCommenced."', ";
  $sqlStr .= "DOB = '".$strDOB."', ";
  $sqlStr .= "Street_Address = '".$strStreet."', ";
  $sqlStr .= "Suburb = '".$strSuburb."', ";
  $sqlStr .= "Post_Code = ".$strPost." ";
  $sqlStr .= "WHERE Consultant_Id = '".$strConsId."'; ";

  try {
    $stmt = $dbConnection->exec($sqlStr);
    if($stmt === false) {
      displayWarning("Error executing the query: ".$sqlStr);
      //displayWarning("DB Error: " + $dbConnection->errorInfo());
      $booOk = 0;
    }
    else {
      displaySuccess($strFirstName." ".$strLastName." has been updated" );
    }
  }
  catch(PDOException $error) {
    $errInfo = $dbConnection->errorInfo();

    //displayWarning("DB Error: ".$errInfo->getMessage());
    displayWarning("PDO Exception: ".$error->getMessage());
    $booOk = 0;
  }

  // Close the database connection
  $dbConnection = NULL;
}

function insertProject() {
  global $dbConnection, $stmt;
  global $strProjectNo, $strProjectName, $strProjectDes;
  global $strProjectManager, $strStartDate, $strFinishDate;
  global $strBudget, $strCostToDate, $strTracking, $strClient;
  global $booOk;
  // connect to the database
  connect();
  if($strCostToDate == null || $strCostToDate == '') $strCostToDate=0;
  // insert query
  $sqlStr = "INSERT INTO d_project VALUES (";
  $sqlStr.= " '".$strProjectNo."', '".$strProjectName."', \"".$strProjectDes."\", ";
  $sqlStr.= " '".$strProjectManager."','".$strStartDate."','".$strFinishDate."',";
  $sqlStr.= " ".$strBudget.",".$strCostToDate.",\"".$strTracking."\",";
  $sqlStr.= " ".$strClient." );";

  //echo $sqlStr;
  // run insert Query
  try {
    $stmt = $dbConnection->query($sqlStr);

    if($stmt === false) {
      //displayWarning("Error executing the query: $sqlStr");
      $errinfo = ($dbConnection->errorInfo());
      // Display error message if could not run query
      if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
        displayWarning("The project id already exists.(proejct no is only 7 characters long.)");
      $booOk = 0;
    }
    else {
      displaySuccess("The project:<strong>$strProjectNo</strong> has been added to the database.");
    }
  }
  catch(PDOException $error)  {
    $errinfo = ($dbConnection->errorInfo());
    // Display error message if could not run query
    if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
      displayWarning("The project id already exists.");
    else
      displayWarning("An Error occured: ".$error->getMessage());
    $booOk = 0;
  }
}

function updateProject() {
  global $dbConnection, $stmt;
  global $strProjectNo, $strProjectName, $strProjectDes;
  global $strProjectManager, $strStartDate, $strFinishDate;
  global $strBudget, $strCostToDate, $strTracking, $strClient;
  global $booOk;
  // connect to the database
  connect();
  if($strCostToDate == null || $strCostToDate == '') $strCostToDate=0;
  // insert query
  $sqlStr = "UPDATE d_project SET ";
  $sqlStr.= " Project_Name = '".$strProjectName."', ";
  $sqlStr.= " Project_Description = '".$strProjectDes."', ";
  $sqlStr.= " Project_Manager = '".$strProjectManager."', ";
  $sqlStr.= " Start_Date = '".$strStartDate."', ";
  $sqlStr.= " Finish_Date = '".$strFinishDate."', ";
  $sqlStr.= " Budget = ".$strBudget.", ";
  $sqlStr.= " Cost_To_Date = ".$strCostToDate.", ";
  $sqlStr.= " Tracking_Statement = \"".$strTracking."\", ";
  $sqlStr.= " Client_No = '".$strClient."' ";
  $sqlStr.= " WHERE Project_No = '".$strProjectNo."'; ";

  echo $sqlStr;
  // run insert Query
  try {
    $stmt = $dbConnection->query($sqlStr);

    if($stmt === false) {
      displayWarning("Error executing the query: $sqlStr");
      displayWarning("DB Error: " + $dbConnection->errorInfo());
      $booOk = 0;
    }
    else {
      displaySuccess("The project:<strong>$strProjectNo</strong> has been updated");
    }
  }
  catch(PDOException $error)  {
    $errinfo = ($dbConnection->errorInfo());
    // Display error message if could not run query
    if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
      displayWarning("The project no already exists.");
    else
      displayWarning("An Error occured: ".$error->getMessage());
    $booOk = 0;
  }
}


/*------------------------------------------------------------------------
 * Project Staffing: Insert Staffing details into d_project_consultant
 *------------------------------------------------------------------------*/
function insertStaffing() {
  global $dbConnection, $stmt;
  global $strProject_No, $strConsultant_Id, $strDate_Assigned;
  global $strDate_Completed, $strRole, $strHours_Worked;

  global $booOk;
  // connect to the database
  connect();
  if($strHours_Worked == null || $strHours_Worked == '' )
    $strHours_Worked = 0;
  if($strDate_Completed == "0000-00-00")
    $strDate_Completed = "";
  // insert query
  $sqlStr = "INSERT INTO d_project_consultant VALUES (";
  $sqlStr.= "'".$strConsultant_Id."', '".$strProject_No."', '".$strDate_Assigned."',";
  $sqlStr.= "'".$strDate_Completed."','".$strRole."', ".$strHours_Worked."); ";

  //echo $sqlStr;
  // run insert Query
  try {
    $stmt = $dbConnection->query($sqlStr);

    if($stmt === false) {
      //displayWarning("Error executing the query: $sqlStr");
      $errinfo = ($dbConnection->errorInfo());
      // Display error message if could not run query
      if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
        displayWarning("The consultant already exists in the project.");
      $booOk = 0;
    }
    else {
      displaySuccess("<strong>$strConsultant_Id</strong> has been added in $strProject_No.");
    }
  }
  catch(PDOException $error)  {
    $errinfo = ($dbConnection->errorInfo());
    // Display error message if could not run query
    if($errinfo[1] == 1062) // checking for a duplicate Primary Key Value
      displayWarning("The consultant already exists in the project.");
    else
      displayWarning("An Error occured: ".$error->getMessage());
    $booOk = 0;
  }
}

function updateStaffing() {
  global $dbConnection, $stmt;
  global $strProject_No, $strConsultant_Id, $strDate_Assigned;
  global $strDate_Completed, $strRole, $strHours_Worked;

  global $booOk;
  // connect to the database
  connect();
  if($strHours_Worked == null || $strHours_Worked == '') $strHours_Worked=0;
  // insert query
  $sqlStr = "UPDATE d_project_consultant SET ";
  $sqlStr.= " Date_Assigned = '".$strDate_Assigned."', ";
  $sqlStr.= " Date_Completed = '".$strDate_Completed."', ";
  $sqlStr.= " Role = '".$strRole."', ";
  $sqlStr.= " Hours_Worked = ".$strHours_Worked." ";
  $sqlStr.= " WHERE Consultant_Id = '".$strConsultant_Id."' AND Project_No = '".$strProject_No."'; ";

  //echo $sqlStr;
  // run insert Query
  try {
    $stmt = $dbConnection->query($sqlStr);

    if($stmt === false) {
      //displayWarning("Error executing the query: $sqlStr");
      $errinfo = ($dbConnection->errorInfo());
      // Display error message if could not run query
      displayWarning("CAN'T UPDATE: ".$errinfo->getMessage());
      $booOk = 0;
    }
    else {
      displaySuccess("<strong>$strConsultant_Id  $strProject_No</strong> has been updated.");
    }
  }
  catch(PDOException $error)  {
    $errinfo = ($dbConnection->errorInfo());
    // Display error message if could not run query
    displayWarning("An Error occured: ".$error->getMessage());
    $booOk = 0;
  }
}

// Delete a Record
function deleteRecord($table,$column,$colValue,$colDataType) {
	global $dbConnection, $stmt;
  global $booDeleteDone;
  $booDeleteDone = false;
	connect();  // Run connect function

  // constructing the delete sql string
  //If Data-Type is Varchar or Date
	if($colDataType === "varchar" || $colDataType === "date" || $colDataType === "datetime")  {
		//Delete Individual Record
		$sqlStr = "DELETE FROM ".$table." WHERE ".$column." = '".$colValue."';";
	}
  //If Data-Type is Numeric
	else	{
		//Delete Individual Record
		$sqlStr = "DELETE FROM ".$table." WHERE ".$column." = ".$colValue.";";
	}
  // Run Query
	try  {
		$stmt = $dbConnection->exec($sqlStr);
		if($stmt === false){
      //displayWarning("Error executing the query: ".$sqlStr);
      //displayWarning("DB Error: ".$dbConnection->getMessage());
      $errInfo = $dbConnection->errorInfo();

      if($errInfo[1] == 1451)
        displayWarning("<em>Cannot delete or update a parent row: a foreign key constraint fails</em>");
    }
    else {
      $booDeleteDone = true;
    }
  }
  catch(PDOException $error)
  {
    $errInfo = $dbConnection->errorInfo();

    if($errInfo[1] == 1451)
      displayWarning("<em>Cannot delete or update a parent row: a foreign key constraint fails</em>");
    else
      displayWarning("An Error occured: ".$error->getMessage());
  }
  // Close the connection
	$dbConnection = NULL;
}

function deleteRecord2($table,$whereStmt) {
	global $dbConnection, $stmt;
  global $booDeleteDone;
  $booDeleteDone = false;
	connect();  // Run connect function

  // constructing the delete sql string
  $sqlStr = "DELETE FROM ".$table." WHERE ".$whereStmt.";";

  // Run Query
	try  {
		$stmt = $dbConnection->exec($sqlStr);
		if($stmt === false){
      //displayWarning("Error executing the query: ".$sqlStr);
      //displayWarning("DB Error: ".$dbConnection->getMessage());
      $errInfo = $dbConnection->errorInfo();

      if($errInfo[1] == 1451)
        displayWarning("<em>Cannot delete or update a parent row: a foreign key constraint fails</em>");
    }
    else {
      $booDeleteDone = true;
    }
  }
  catch(PDOException $error)
  {
    $errInfo = $dbConnection->errorInfo();

    if($errInfo[1] == 1451)
      displayWarning("<em>Cannot delete or update a parent row: a foreign key constraint fails</em>");
    else
      displayWarning("An Error occured: ".$error->getMessage());
  }
  // Close the connection
	$dbConnection = NULL;
}

?>
