<?php

include 'connectmedicare.php';

if(isset($_POST['btnregister']))
{
  $cusname=$_POST['txtcusname'];
  $uname=$_POST['txtusername'];
  $email=$_POST['txtemail'];
  $pass=$_POST['txtpassword'];
  $phone=$_POST['txtpnumber'];
  $address=$_POST['txtaddress'];

  /* AutoID for Customer */
  $cusid = 'Cus_';
  $checkingrecentid = "SELECT MAX(RIGHT(CustomerID, LENGTH(CustomerID)-7)) AS RecentID FROM Customertb";
  $recentid=mysqli_query($dbconnect,$checkingrecentid);
  $row = mysqli_fetch_assoc($recentid);
  $recentid = $row['RecentID'];
  $cusnewid = (int)$recentid + 1;
  $cusid = $cusid.(str_pad($cusnewid, 7, '0', STR_PAD_LEFT));
 

  /* Password Format */
  $number=preg_match('@[0-9]@', $pass);
  $uppercase=preg_match('@[A-Z]@',$pass);
  $lowercase=preg_match('@[a-z]@', $pass);
  $special=preg_match('@[^\w]@',$pass);

  /* Checking Email */
   $checkemail="SELECT * FROM Customertb WHERE CustomerEmail='$email'";
   $emailresult=mysqli_query($dbconnect,$checkemail);
   $count=mysqli_num_rows($emailresult);

  if ($count>0)
  {
    echo "<script>window.alert('Customer Email already exist! Try again.')</script>";
    echo "<script>window.location='CustomerRegister.php'</script>";
  }
  else if (strlen($pass)<8 || !$number || !$uppercase || !$lowercase || !$special) 
  {
    echo "<script>window.alert('Password must be at least 8 characters in length and must contian at least one upper, one number, one lower and one special character.')</script>";
    echo "<script>window.location='CustomerRegister.php'</script>";

  }
  else
  {
   $insert="INSERT INTO Customertb(CustomerID,CustomerName,CustomerUsername,CustomerEmail,CustomerPassword,CustomerPhoneNo,CustomerAddress)
       VALUES ('$cusid','$cusname','$uname','$email','$pass','$phone','$address')";

    $finalinsert=mysqli_query($dbconnect,$insert);

    if($finalinsert)
    {
       echo "<script>window.alert('Customer Registration is Successful')</script>";
       echo "<script>window.location='CustomerLogin.php'</script>";
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Social Media Campaigns</title>
   <link rel="stylesheet" type="text/css" href="CustomerStyle.css">
    
</head>
<body class="member-reg">
    <div class="regcontainer">

    <h1 class="title-form">Customer Registration Form</h1>

     <form action="CustomerRegister.php" method="POST">
      
      <div class="memberinfo">
         <div class="inputbox">
            <label for="customername">Customer Name</label>
            <input type="text" id="customername" name="txtcusname" placeholder="e.g Evans" required>
         </div>   
         <div class="inputbox">
            <label for="username">Username</label>
            <input type="text" id="username" name="txtusername" placeholder="e.g Tun Gyi" required>
         </div>
       
         <div class="inputbox">
            <label for="email">Email</label>
            <input type="email" id="email" name="txtemail" placeholder="----@gmail.com" required>
         </div>
         <div class="inputbox">
            <label for="password">Password</label>
            <input type="password" id="password" name="txtpassword" placeholder="eg. XXXXX" required>
         </div>
         <div class="inputbox">
            <label for="pnumber">Phone Number</label>
            <input type="text" id="pnumber" name="txtpnumber" placeholder="+959------" required>
         </div>
         <div class="inputbox">
            <label for="address">Address</label>
            <input type="text" id="address" name="txtaddress" placeholder="Enter your Address" required>
         </div>
   </div>

      <div class="terms">
        <input type="checkbox" id="terms&con" required><label for="terms&con">Terms & Conditions</label>
      </div>

      <div class="g-recaptcha" data-sitekey="6LdSgSYpAAAAABTdg_dwd7uTTyTYCnPv7r3yh1-o" id="recapt"></div> 

      <div class="form-button">
         <input type="submit"  name="btnregister" value="Register">
         <input type="reset"  name="btnclear" value="Clear">
      </div>
      <div class="form-link">
         <a href="CustomerLogin.php">"You already have an account? Please Login"</a>
      </div>
        

        

     </form>
 </div>
<!-- for recaptcha -->
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>