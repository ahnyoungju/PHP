<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="IT Consulting" />
    <meta name="description" content="Dalton Consulting" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dalton.css">
    <title>Dalton Consulting</title>
  </head>
  <body onbeforeunload="showLoader();" onpageshow="hideLoader();">
    <header>
      <span id="logo-top">DALTON</span>&nbsp;&nbsp;
      <span id="logo-bottom">CONSULTING</span>
    </header>
    <?php
    /* For Testing */
    $TEST = true;
    if( $TEST ) {
      ini_set('display_errors', 'On');
      // error_reporting(E_ALL);
      // E_STRICT helps by warning you that you’re using a deprecated
      //error_reporting(E_ALL | E_STRICT);
    }
    ?>
