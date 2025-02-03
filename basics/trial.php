<!DOCTYPE html>
<html>
    <body>
        <?php

$array1 = [1,2,3,4,5];
$array2 = [11,23,35,48,58];

$array_count = 5;

$new_series = [];
for($i=0;$i<$array_count;$i++){
    $new_series.= $array1[$i].",".$array2[$i].",";
}

echo rtrim($new_series,",");
echo"<br>";
echo var_dump($new_series);

        ?>
    </body>
</html>
