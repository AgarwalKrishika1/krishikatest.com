<?php
// Start the session document start only
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
echo "<br><br>";
//print sessions variables
print_r($_SESSION);
// remove all session variables
session_unset();
// destroy the session
session_destroy();
echo "<br>Session destroyed";
?>

</body>
</html>