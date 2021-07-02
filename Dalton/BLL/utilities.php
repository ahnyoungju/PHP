<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function displayWarning($message) {
  $output = $message;
  if( is_array( $output ) )
    $output = implode( ',' , $output);
  echo "<p class='warning'>$output</p>";
  console_log($output);
}
function displaySuccess($message) {
  echo "<p class='success'>$message</p>";
  console_log($message);
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>
