<?php
if ( !session_id() ) @ session_start();
// for the test session_start();
// for the test session_destroy();
//session_destroy();
if( empty( $_SESSION['login'] ) )
  $_SESSION['login'] = false;

$login = $_SESSION['login'];
?>
