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
$ProdName = $CustomerName = $price = $taxprice ="";
$ProdNameErr = $CustomerNameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["ProdName"])) {
        $ProdNameErr = "Product name is required";
    } else {
        $ProdName = test_input($_POST["ProdName"]);
    }

    if (empty($_POST["CustomerName"])) {
        $CustomerNameErr = "Customer name is required";
    } else {
        $CustomerName = test_input($_POST["CustomerName"]);
    }

    // Setting price based on selected product
    if ($_POST["ProdName"] === 'abc') {
        $price = 100;
        $taxprice = $price + (0.05*$price);
    }

    if ($_POST["ProdName"] === 'def') {
        $price = 200;
        $taxprice = $price + (0.05*$price);
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Order Form</h2>
<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<label for="ProdName">Select Product:</label>
        <select name="ProdName" id="ProdName">
            <option value="abc" <?php echo ($ProdName == 'abc') ? 'selected' : ''; ?>>abc</option>
            <option value="def" <?php echo ($ProdName == 'def') ? 'selected' : ''; ?>>def</option>
        </select>
        <span class="error">* <?php echo $ProdNameErr;?></span>
    <br><br>

    <label for="CustomerName">Select Customer:</label>
        <select name="CustomerName" id="CustomerName">
            <option value="xyz" <?php echo ($CustomerName == 'xyz') ? 'selected' : ''; ?>>xyz</option>
            <option value="xxx" <?php echo ($CustomerName == 'xxx') ? 'selected' : ''; ?>>xxx</option>
        </select>
        <span class="error">* <?php echo $CustomerNameErr;?></span>
    <br><br>

  <input type="submit" name="submit" value="Submit">  

</form>

<?php
// Echo the price if it's set after form submission
if ($price > 0) {
    echo "Price for selected product: $price<br>";
}
if ($taxprice > 0) {
    echo "Tax Price for selected product: $taxprice";
}
?>

</body>
</html>
