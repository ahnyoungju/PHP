<?php

// Library of Database Functions

// Database Connection Variables
$localhost="localhost";
$user="root";
$password="root";
$db="Login";
$dsn="mysql:host=$localhost;dbname=$db;";

// Declare Global Variables
$dbConnection=NULL;
$stmt=NULL;
$numRecords=NULL;

$login=false;

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

function checkLoginPassword($userID, $userPwd) {
  // Selecting all records from a table
  global $numRecords, $dbConnection, $stmt;

  connect(); // run connect function

  // SQL Query - Results sorted by specified column
  $sqlStr = "SELECT password FROM tblusers WHERE username = '".$userID."' ";

  try {
    $stmt = $dbConnection->query($sqlStr);
    if($stmt === false) {
      die("Error executing the query: $sqlStr");
      displayWarning("Can't execute checking login");
    }
  }
  catch(PDOException $error)  {
    // Display error message if could not run query
    displayWarning( "An Error occured: ".$error->getMessage() );
  }

  $numRecords = $stmt->rowcount();

  // Close the database connection
  $dbConnection = NULL;
}
