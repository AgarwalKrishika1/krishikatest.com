<!DOCTYPE html>
<html>
    <body>
        <?php

function findMaxProductPair($arr) {
    sort($arr);
    $max1 = $arr[count($arr) - 1];
    $max2 = $arr[count($arr) - 2];
    $min1 = $arr[0];
    $min2 = $arr[1];
    $productMax = $max1 * $max2;
    $productMin = $min1 * $min2;
    if ($productMax > $productMin) {
        echo "The maximum product is the (" . $max1 . ", " . $max2 . ")\n";
    } else {
        echo "The maximum product is the (" . $min1 . ", " . $min2 . ")\n";
    }
    if ($productMax == $productMin) {
        echo "and (" . $max1 . ", " . $max2 . ")<br>";
    }
}

echo "CASE 1:<br>";
findMaxProductPair([3, 5, 10, 20,40,5]); 
echo "<br>CASE 2:<br>";
findMaxProductPair([-10, -3, 5, 6, -2]);

?>

    </body>
</html>