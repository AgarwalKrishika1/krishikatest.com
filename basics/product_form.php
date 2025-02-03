<!DOCTYPE HTML>  
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<?php
$ProductnameErr = $ProductDescErr  = $CostPriceErr = $SellPriceErr= $CategoryErr = $StatusErr = "";
$Productname = $ProductDesc = $CostPrice = $SellPrice = $Category = $Status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["Productname"])) {
    $ProductnameErr = "Product Name is required";
  } else {
    $Productname = test_input($_POST["Productname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Productname)) {
      $ProductnameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["ProductDesc"])) {
    $ProductDescErr = "Required";
  } else {
    $ProductDesc = test_input($_POST["ProductDesc"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$ProductDesc)) {
      $ProductDescErr = "Only letters and white space allowed";
    }
  }

  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    
    // Set the upload directory (e.g., 'uploads' folder)
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create folder if not exists
    }

    // Create the path to save the uploaded image
    $uploadPath = $uploadDir . basename($imageName);

    // Move the uploaded image to the target folder
    if (move_uploaded_file($imageTmp, $uploadPath)) {
        echo "<br>";
        echo "<img src='$uploadPath' alt='Uploaded Image' style='max-width: 300px; max-height: 200px;'>";
    } else {
        echo "<h2>Error uploading the image.</h2>";
    }
} else {
    echo "<h2>Please select a valid image file.</h2>";
}

    if(empty($_POST['CostPrice'])){
        $CostPrice = 'Required';
      }
      else{
        $CostPrice = test_input($_POST['CostPrice']);
        if (!preg_match('/^\d{2,6}$/', $CostPrice)) {
          $CostPriceErr = "Invalid Cost price";
      }
      }


      if(empty($_POST['SellPrice'])){
        $SellPrice = 'Required';
      }
      else{
        $SellPrice = test_input($_POST['SellPrice']);
        if (!preg_match('/^\d{2,6}$/', $SellPrice)) {
          $SellPriceErr = "Invalid sell price";
      }
      }

    if (empty($_POST["Category"])) {
        $CategoryErr = "Category is required";
    } else {
        $Category = test_input($_POST["Category"]);
    }

    if (empty($_POST["Status"])) {
        $StatusErr = "Status is required";
    } else {
        $Status = test_input($_POST["Status"]);
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

<h2>PHP Product Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

  Product Name: <input type="text" name="Productname" value="<?php echo $Productname;?>">
  <span class="error">* <?php echo $ProductnameErr;?></span>
  <br><br>

  Product Description: <textarea name="ProductDesc" rows="5" cols="40"> <?php echo $ProductDesc;?></textarea>
  <span class="error">* <?php echo $ProductDescErr;?></span>
  <br><br>

  Product Image:<br>
  <label for="image">Choose an image to upload:</label>
    <input type="file" name="image" id="image" accept="image/*" required>
    <br><br>
    
  Cost Price: <input type="text" name="CostPrice" value="<?php echo $CostPrice;?>">
  <span class="error">* <?php echo $CostPriceErr;?></span>
  <br><br>

  Selling Price: <input type="text" name="SellPrice" value="<?php echo $SellPrice;?>">
  <span class="error">* <?php echo $SellPriceErr;?></span>
  <br><br>
  
  Category:
  <span class="error">* <?php echo $CategoryErr;?></span>
  <br>
  <input type="checkbox" id="Category" name="Electronic" value="Electronic">
  <label for="Electronic"> Electronic</label><br>
  <input type="checkbox" id="Category" name="Music" value="Music">
  <label for="Music"> Music</label><br>
  <input type="checkbox" id="Category" name="Clothing" value="Clothing">
  <label for="Clothing"> Clothing</label>
  <br><br>
  
  <label for="Status">Select Status:</label>
        <select name="Status" id="Status">
            <option value="Active" <?php echo ($Status == 'Active') ? 'selected' : ''; ?>>Active</option>
            <option value="Inactive" <?php echo ($Status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
        </select>
        <span class="error">* <?php echo $StatusErr;?></span>
    <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $Productname;
echo "<br>";
echo $ProductDesc;
echo "<br>";
//prod image
echo $CostPrice; 
echo "<br>";
echo $SellPrice;
echo "<br>";
echo $Category;
echo "<br>";
echo $Status;
echo "<br>";
?>

</body>
</html>





