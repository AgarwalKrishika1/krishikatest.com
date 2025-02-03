<?php
function OpenCon()
{
$dbhost = "localhost";
$dbuser = "krishikatest";
$dbpass = 'QrLY35@T$t8h';
$dbname = "krishikadb";
$conn = new mysqli(
    $dbhost, $dbuser, 
    $dbpass,$dbname) 
    or die("Connect failed: %s\n". $conn -> error);
return $conn;
}
function CloseCon($conn)
{
$conn -> close();
}
?>