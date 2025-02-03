<!DOCTYPE html>
<html>
    <body>
        <?php
        echo readfile("k.txt");
        echo "<br>";
        $myfile = fopen("k.txt", "r") 
        or die("Unable to open file!");
        echo fread($myfile,
        filesize("k.txt"));
        fclose($myfile);

        //read single line
        echo"<br>Line 1 of file:  ";
        $myfile = fopen("k.txt", "r") or die("Unable to open file!");
        echo fgets($myfile);
        fclose($myfile);

        echo"<br>";
        $myfile = fopen("k.txt", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) {
            echo fgets($myfile) . "<br>";
        }
        fclose($myfile);
        echo "<br>";
        //output char by char
        $myfile = fopen("k.txt", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            echo fgetc($myfile);
        }
        fclose($myfile);
        echo "<br>";    
        echo file_exists("k.txt");
        ?>
    </body>
</html>