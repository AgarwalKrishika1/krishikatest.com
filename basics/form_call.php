<!DOCTYPE html>
<html>
    <body>
        <form method="post" action="homepage.php">

            <?php
            //include display output from this page
            //even if there is error in include page
            include ("welcome.php");
            require ("welcome.php");
            echo "<br>Included files<br><br>";
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
            ?>
            Name: <input type="text" name="name" 
            value="<?php echo $name;?>">
            <br><br><br>
            E-Mail: <input type="text" name="email" 
            value="<?php echo $email;?>">
            <br><br><br>
            Phone Number: <input type="text" name="phone_numer" 
            value="<?php echo $phone_number;?>">
            <br><br><br>
            Comment: <textarea name="comment" 
            rows="5" cols="40"></textarea>
            <br><br><br>
            Gender:
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="other">Other
            <br><br><br>
            Submit: <input type="submit" name="submit" 
            value="Submit">
        </form>
    </body>
</html>