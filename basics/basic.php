<!DOCTYPE html>
<html>
<body>

<?php
ECHO "Hello World!<br>";
echo "Hello World!<br>";
EcHo "Hello World!<br>";
print "Hello<br>";
$txt = "Basic trial for php<br>";
echo $txt;
$txt = "PHP";
echo "I am trying my hands on " . $txt . "";
//echo "<br";
$x = $y = $z = "<br>Fruit<br>";
echo $x;
var_dump($y);

// variable scopes 
$x = 5; // global scope

function myTest() {
  // using x inside this function will generate an error if $x not declared her 
  $x = "Krishika";
  echo "<p>Variable x inside function is: $x</p>";
  echo '<p>Variables while using single quotation needs to have " . $variable . " as  here ' . $x . '</p>';
  global $x;
  $y = $x;
}
myTest();

echo "<p>Variable x outside function is: $x</p>";
echo "Variable x when declared globally: $x</br>";
// another way to make chasnges if needed as this styores value $GLOBALS['x'];

function myTest2() {
     // if wish to store previous variable value use static
     static $x = 0;
     echo "$x </br>";
     $x++;
}

myTest2();
myTest2();
echo "Today is " . date("l");
?>

</body>
</html>
