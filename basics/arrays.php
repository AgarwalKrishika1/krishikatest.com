<!DOCTYPE html>
<html>  
<body>
<?php
echo"<p> array and functions </p>";
$myArr = [];
$myArr[0] = "apples";
$myArr[1] = "bananas";
$myArr["fruit"] = "cherries";
$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
//add in array
array_push($myArr, "Orange", "Kiwi", "Lemon");

//access array
foreach ($car as $x => $y) {
  echo "$x: $y <br>";
}
echo "<br>";
foreach($myArr as $x => $y) {
echo "Mixed array $x: $y <br>";
}

//sorting
$cars = array("Volvo", "BMW", "Toyota");
sort($cars);
echo"<br> Sorting in ascending<br>";
$clength = count($cars);
for($x = 0; $x < $clength; $x++) {
  echo $cars[$x];
  echo "<br>";
}
echo "<br>";
$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);
    
for ($row = 0; $row < 4; $row++) {
  echo "<p><b>Row number $row</b></p>";
  echo "<ul>";
  for ($col = 0; $col < 3; $col++) {
    echo "<li>".$cars[$row][$col]."</li>";
  }
  echo "</ul>";
}
?>
</body>
</html>