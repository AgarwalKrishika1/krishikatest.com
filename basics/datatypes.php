<!DOCTYPE html>
<html>
<body>
<?php
class DataTypes{
    public $variable;
    public $values;
    public function __construct($variable, $values){
        $this->variable = $variable;
        $this->values = $values;
        
}
public function printing(){
    return "Variable " . $this->variable ."with value ". $this->values ."";
}
}
$x = 5;
$a = "Krishika";
$b = 5.5;
$c = true;
$d = array("a", "b", "c");
var_dump($x);
echo "<br>";
$x = (string) $x;
echo "Datatype of x after explicit convert" . var_dump($x) . "";
echo "<br>";
$var = new DataTypes("z", "With constructor");
var_dump($var);
echo "<br> Single quote can not be used for special character <br>";
echo "<br> <br> <br> <h3> String functions </h3>";
echo "String length ";
echo strlen("Krishika");
echo "<br> Word count " . str_word_count("Leanring php") . "<br>";
echo "Check the position of 1st time occurence ";
echo strpos("Hello world!", "world");
$x = "Krishika Agarwal";
echo "<br>String to upper " . strtoupper($x) . "<br>";
echo "String to lower " . strtolower($x) . "<br>";
$x = "Hello World!";
echo "Replacing string ";
echo str_replace("World", "Dolly", $x);
echo "<br>";
echo "String reverse " . strrev($x) . "<br>"; 
echo "Remove whitespace " . trim($x) . "<br>";
$y = explode(" ", $x);
echo "String to array ";
print_r($y);
echo "<br>";
$x = "Php";
$y = "Leanring";
$z = $x . $y;
echo "Concetation with no Whitespace $z <br>";
$z = $x . " " . $y;
echo "Concetation with whitespace $z <br>";
$z = "$x  $y";
echo "Direct concetation $z <br>";
echo "Number of characters I want in substring: ";
echo substr($y,3,2);
echo "<br>";
echo "Substring till end " . substr($y, 3) . "<br>";
echo "Substring index from end " . substr($y, -7, 5) . "<br>";
echo "Type casting<br>";
$a = array("Volvo", "BMW", "Toyota"); // indexed array
$b = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43"); // associative array
$a = (object) $a;
$b = (object) $b;
var_dump($a);
echo "<br>";
var_dump($b);
echo "<br> <br>";
echo "Math functions <br>";
echo "Min " . min(5,6,6) . "<br>";
echo "Max " . max(5,6,6) . "<br>";
echo "pi " . pi() . "<br>";
echo "abs " . abs(-5.5) . "<br>";
echo "sqrt " . sqrt(125) . "<br>";
echo "round " . round(5.5) . "<br>";
echo "random  " . rand(2,100) . "<br>";
define("cars", [
    "Alfa Romeo",
    "BMW",
    "Toyota"
  ]);
echo "Constant defined: ". cars[0] . "<br>";
class Fruits {
    public function myValue(){
      return __CLASS__;
    }
  }
  $kiwi = new Fruits();
  echo "<p>Trying on magic constants ";
  echo $kiwi->myValue();
  echo "</p>"
?>
</body>
</html>
