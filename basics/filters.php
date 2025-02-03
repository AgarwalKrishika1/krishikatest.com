<!DOCTYPE html>
<html>
    <body>
        <?php
        $ip = "127.0.0.1";

        if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
          echo("$ip is a valid IP address");
        } else {
          echo("$ip is not a valid IP address");
        }
        echo("<br>");
        //filter for range 
        $int = 122;
        $min = 1;
        $max = 200;
        if (filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
        echo("Variable value is not within the legal range");
        } else {
        echo("Variable value is within the legal range");
        }
        echo("<br> remove html tags and words with ascii>127       ");
        $str = "<h1>Hello WorldÆØÅ!</h1>";
        $newstr = filter_var($str, 
        FILTER_SANITIZE_STRING, 
        FILTER_FLAG_STRIP_HIGH);
        echo $newstr;
        ?>
    </body>
</html>