<?php
//error handler function
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");

//trigger error
echo($test);
echo "<br>";

function a($txt) {
    b("Glenn");
}
function b($txt) {
    c("Cleveland");
}
function c($txt) {
    debug_print_backtrace();
}
a("Peter");
echo "<br>";

// php code for logging error into a given file

// error message to be logged
$error_message = "This is an error message!";
// path of the log file where errors need to be logged
$log_file = "./my-errors.log";

// logging error message to given log file
error_log($error_message, 
3, $log_file);
?>

