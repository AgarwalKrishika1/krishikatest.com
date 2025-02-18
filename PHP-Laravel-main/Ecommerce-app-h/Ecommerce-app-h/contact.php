<?php

$conn  = mysqli_connect("localhost","root","","ecommerceapp");
$db = mysqli_select_db($conn, "ecommerceapp");

if (isset($_POST['submit'])) 
{

    $user_name_php =  $_POST['name'];
    $user_email_php =  $_POST['email'];
    $user_Message_php =  $_POST['message'];
    //$user_ratting_php = $_POST['rate'];
    //$ctstr_ratting_php = implode($user_ratting_php);

    //echo "$ctstr_ratting_php";

    $query ="INSERT INTO `feedback`(`User_Name`, `User_Email`, `User_Message`) VALUES ('$user_name_php','$user_email_php','$user_Message_php')";

    if ($conn->query($query) === true)

        {
	echo("Thank you, for giving us a genuine feed back.");
	} 
        
    else 
        {
        echo ("sorry, their was some technical issues please try again. ");
	}
  
}?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Contact Form</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <script>
      const btn = document.querySelector("button");
      const post = document.querySelector(".post");
      const widget = document.querySelector(".star-widget");
      const editBtn = document.querySelector(".edit");
      btn.onclick = ()=>
      {
        widget.style.display = "none";
        post.style.display = "block";
        editBtn.onclick = ()=>
        {
          widget.style.display = "block";
          post.style.display = "none";
        }
        return false;
      }
    </script>
  </head>
  <body>

    <!--Right side-->
<div class="contact-section">
        <div class="contact-info">
          <div><i class="fas fa-map-marker-alt"></i><a href="https://www.google.com/maps/place/Christ+Polytechnic+Institute/@22.2922433,70.7256715,15z/data=!4m5!3m4!1s0x0:0xb57fd68f4ca79aff!8m2!3d22.2922433!4d70.7256715" style="color: azure;">Address, City, State</a></div>
          <div><i class="fas fa-envelope"></i>darshillunagariya56@gmail.com</div>
          <div><i class="fas fa-phone"></i>+91 70465 65244</div>
          <div><i class="fas fa-clock"></i>Mon - Fri 8:00 AM to 8:00 PM</div>
        </div>


    <!--Left side-->
    <div class="contact-form">
        <h2>Contact Us</h2>
        <form class="contact" method="post" action="contact.php">
          <input type="text" name="name" class="text-box" placeholder="Your Name" required>
          <input type="email" name="email" class="text-box" placeholder="Your Email" required>
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
          <input type="submit" name="submit" class="send-btn" value="Send">
        </form>
    </div>
</div>
</body>
</html>