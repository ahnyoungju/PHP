<?php

function validateLogin($id, $pwd) {
  // Check Validation of Login Details
  global $login, $numRecords, $stmt;

  if( $id == NULL ) {
    displayWarning("You should enter user id!");
    return false;
  }

  checkLoginPassword($id, $pwd);

  if( $numRecords == 0 ) {  // CAN NOT FIND USERNAME
    displayWarning("CAN NOT FIND USERNAME: ".$id);
    return false;
  }
  else {
    $arrRows = NULL;

    while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      if( $arrRows['password'] == $pwd ) {
        return true;
      }
    }
    displayWarning("NOT MATCH PASSWORD!" );
    return false;
  }
}

function logOut() {
  $_SESSION['UserID'] = "";
  $_SESSION['login'] = false;
}
?>
