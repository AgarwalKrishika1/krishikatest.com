<!DOCTYPE html>
<html>
    <body>
        <?php
        function print_without_hyphen(){
            for($i = 1; $i <= 10; $i++){
                if($i<10){
                    echo "$i-";
                }
                else{
                    echo "$i<br>";
                }
            }
        }

        function total_till30(){
            $sum = 0;
            for($i = 1; $i <= 30; $i++){
                $sum += $i;
                if($i< 30) echo $i."+";
                else echo $i."";
            }
            echo "=" .$sum. "<br>";
        }


        function print_pattern(){
            for($i=0;$i<=5;$i++){
                for($j=$i;$j<5;$j++){
                    echo "* ";
                }
                echo "<br>";
            }
        }

        function factorial ($n){
            $product =1;
            for($i= 1;$i<=$n;$i++){ 
                $product *= $i;
            }
            echo $product   ."<br>";
        }

        function print_pattern_number(){
            $count=1;
            for($i=1;$i<=5;$i++){
                for($j=0;$j<$i;$j++){
                    echo "$count   ";
                    $count++;
                }
                echo "<br>";
            }
        }
        print_without_hyphen();
        total_till30();
        print_pattern();
        factorial(5);
        print_pattern_number()
        ?>
    </body>
</html>