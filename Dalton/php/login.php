<?php
    require_once('header.inc');
?>
<style>
label{
  display:block;
  visibility:hidden;
  /* witdh:80%; */
  text-align:left;
  margin-left:10px;
}
input[type=text], input[type=password] {
  display:block;
  float:none;
  /* width:80%; */
  margin-left:10px;
  border:none;
  border-bottom: 1px solid lightgrey;
  border-radius:0px;
}

.visible {
  visibility:visible;
}

::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: red;
    opacity: 1; /* Firefox */
    font-size:1.1em;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: red;
}

::-ms-input-placeholder { /* Microsoft Edge */
    color: red;
}
</style>
<?php
require_once('../bll/getLogin.php');
global $login;
/* Check Login */
if( $login != true )
  require_once('nav_default.inc');
else
  require_once('nav_login.inc');

require_once('../dal/db_login.php');
require_once('../bll/checkLogin.php');
require_once('../BLL/utilities.php');

echo "<section>LOGIN</section>";
echo "<div id='loader'></div>";
echo "<article class='padding2 animate-bottom'>";
echo "<form action='login.php' method='POST' class='padding2'>";
if( $_SESSION['login'] == false ) {    // Didn't submit
  echo <<<LOGINFORM
    <fieldset>
      <legend>Login</legend>
      <label for="txtID">LOGIN ID </label>
      <input type="text" id="txtID" name="txtID" placeholder="Enter Login ID" onfocus="this.value=''; displayLabel(0);" onblur="displayHolder(0);"/>
      <label for="txtPwd">PASSWORD </label>
      <input type="password" id="txtPwd" name="txtPwd" placeholder="Enter Password" onfocus="this.value=''; displayLabel(1);" onblur="displayHolder(1);"/>
      <input type="submit" name="submit" value="Submit">
      <input type="reset" value="Reset">
    </fieldset>
LOGINFORM;
}  // end if NOT submit

if( isset($_POST["submit"]) ) { // CHECK LOGIN DETAILS
  $id = $_POST["txtID"];
  $pwd = $_POST["txtPwd"];
  $login = validateLogin($id,$pwd);   // checkLogin.php

  if( $login ) {
    $_SESSION['login'] = true;
    $_SESSION['UserID'] = $id;
    header( "Location: login.php");
  }
  else
    displayWarning("TRY AGAIN.");
}
if( isset($_POST["logOut"]) ) {
  logOut();
  header( "Location: login.php");
}
if( $_SESSION['login'] ) {
  displaySuccess("YOU ARE LOGGED IN( user id:".$_SESSION['UserID']." )");
  echo "<input class='floatLeft' type='submit' name='logOut' value='Logout' />";
}
echo "</form>";
echo "</article>";
 ?>

<aside>&nbsp;</aside>

<script>
function displayLabel(idx) {
  var labels = document.getElementsByTagName("label");
  labels[idx].classList.add('visible');
}
function displayHolder(idx) {
  var labels = document.getElementsByTagName("label");
  if( idx == 0 ) {
    var id = document.getElementById("txtID").value;
    if(id.length == 0) {
      document.getElementById("txtID").reset();
      labels[idx].classList.remove('visible');
    }
  }
  if( idx == 1 ) {
    var id = document.getElementById("txtPwd").value;
    if(id.length == 0) {
      document.getElementById("txtPwd").reset();
      labels[idx].classList.remove('visible');
    }
  }
}
</script>
<?php
  require('footer.inc');
?>
