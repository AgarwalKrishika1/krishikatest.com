<!DOCTYPE html>
<html>
    <body>
    <?php
// product
function array_product_elements($array) {
    $prod =  array_product($array); 
    echo "Product : $prod<br>";
    return $prod;
}

// combinations
function get_combinations($array, $size) {
    $combinations = [];
    $total_elements = count($array);

    if ($size == 1) {
        foreach ($array as $item) {
            $combinations[] = [$item];
        }
    } 
    else {
        //acts as sliding window 
        for ($i = 0; $i <= $total_elements - $size; $i++) {
            $remaining_elements = array_slice($array, $i + 1);
            foreach (get_combinations($remaining_elements, $size - 1) as $combination) {
                array_unshift($combination, $array[$i]);
                $combinations[] = $combination;
                echo implode(",", $combination) ."<br>";
            }
        }
    }

    return $combinations;
}

// Function to calculate the sum of products of all combinations of a given size
function calculate_sum_of_products($array, $size) {
    $combinations = get_combinations($array, $size);
    $sum = 0;

    foreach ($combinations as $combination) {
        $sum += array_product_elements($combination);
    }

    return $sum;
}

// Main code to calculate the sum for different cases
$array = [1, 2, 3, 4, 5];  // the given array

// CASE 1: Combinations of 3 elements
$size1 = 3;
$result1 = calculate_sum_of_products($array, $size1);
echo "Output sum for CASE 1 (combinations of 3): $result1 <br>";

// CASE 2: Combinations of 2 elements
$size2 = 2;
$result2 = calculate_sum_of_products($array, $size2);
echo "Output sum for CASE 2 (combinations of 2): $result2 <br>";
?>

    </body>
</html>