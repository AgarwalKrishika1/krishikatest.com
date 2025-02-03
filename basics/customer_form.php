<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $genderErr = $addressErr = $phoneErr = $CityErr = "";
$name = $gender = $address = $phone = $city = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "Address Required";
  } else {
    $address= test_input($_POST["address"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$address)) {
      $addressErr = "Only letters and white space allowed";
    }
  }
  
      if(empty($_POST['phone'])){
        $phoneErr = 'Required';
      }
      else{
        $phone = test_input($_POST['phone']);
        if (!preg_match('/^\d{10}$/', $phone)) {
          $phoneErr = "Invalid phone number format. Please use xxxxxxxxxx.";
      }
      }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["city"])) {
    $CityErr = "city Name is required";
  } else {
    $city = test_input($_POST["city"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
      $CityErr = "Only letters and white space allowed";
    }
  }
}


//to remove extra spaces from front and end
//to remove any back slashes from user text
//to convert special chars to html type 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Contact Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  Address: <textarea name="address" rows="5" cols="40"> <?php echo $addres;?></textarea>
  <span class="error">* <?php echo $addressErr;?></span>
  <br><br>

  Phone Number: <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>

  <br><br>
  Gender:
  <input type="radio" name="gender" 
  <?php if (isset($gender) && $gender=="female") 
  echo "checked";?> value="female">Female
  <input type="radio" name="gender" 
  <?php if (isset($gender) && $gender=="male") 
  echo "checked";?> value="male">Male
  <input type="radio" name="gender" 
  <?php if (isset($gender) && $gender=="other") 
  echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>

  City: <input type="text" name="city" value="<?php echo $city;?>">
  <span class="error">* <?php echo $CityErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $address;
echo "<br>";
echo $phone;
echo "<br>";
echo $city;
echo "<br>";
echo $gender;
?>

</body>
</html>





