<?php
setcookie("test_cookie", "test", 
time() + 3600, "/");
?>
<html>
<body>

<?php
if(count($_COOKIE) > 0) {
  echo "Cookies are enabled.<br>";
} else {
  echo "Cookies are disabled.<br>";
}
if(!($_COOKIE)){
    echo "Cookie not set";
}
else{
    echo "Cookie set".$COOKIE["name"]."<br>";
}
?>

</body>
</html>