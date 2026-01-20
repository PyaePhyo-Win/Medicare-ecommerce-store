<?php

session_start();

include('connectmedicare.php');

if(isset($_POST['btnlogin']))
{
	$email=$_POST['txtemail'];
	$pass=$_POST['txtpassword'];

	$checkvalid="SELECT * FROM Customertb WHERE CustomerEmail='$email' AND CustomerPassword='$pass'";
  $result=mysqli_query($dbconnect,$checkvalid);
  $count=mysqli_num_rows($result);

    if($count>0)
    {
      $array=mysqli_fetch_array($result);

      $cusid=$array['CustomerID'];
      $cusername=$array['CustomerUsername'];
      $cusemail=$array['CustomerEmail'];
      $cusphone=$array['CustomerPhoneNo'];


      $_SESSION['CID']=$cusid;
      $_SESSION['CUNAME']=$cusername;
      $_SESSION['CEmail']=$cusemail;
      $_SESSION['CPhone']=$cusphone;
      
      setcookie("member","$cusername",time()+10,"/");
      
      echo "<script>window.alert('Login successful')</script>";
      echo "<script>window.location='homepage.php'</script>";
    }
    else
    {
      if(isset($_SESSION['LoginError']))
      {
        $counterror=$_SESSION['LoginError'];

        if ($counterror==1) 
        {
          echo "<script>window.alert('Login fail for second attempt!')</script>";
          $_SESSION['LoginError']=2;

        }
        else if ($counterror==2)
        {
          echo "<script>window.alert('Login fail for third attempt!')</script>";
          $_SESSION['LoginError']=3;
        }
        else if ($counterror==3)
        {
          echo "<script>window.alert('You are out of time.')</script>";
          echo "<script>window.location='timer.php'</script>";
        }
      }
      else
      {
        echo "<script>window.alert('Login fail for first attempt!')</script>";

        $_SESSION['LoginError']=1;
      }
    }

}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <link rel="stylesheet" type="text/css" href="CustomerStyle.css">
</head>
<body class="memberlogin" >

  <div class="loginContainer">

    <h1 class="title-form">Customer Login Form</h1>

	   <form action="CustomerLogin.php" method="POST">

        <div class="memberinfo">
            <div class="inputbox-login">
              <label for="email">Email</label>
		      <input type="email" id="email" name="txtemail" placeholder="Enter your email" required>
            </div>
            <div class="inputbox-login">
                <label for="pass">Password</label> 
                <input type="password" id="pass" name="txtpassword" placeholder="Enter your password" required>
            </div>
        </div>

       

        <div class="terms">
            <input type="checkbox" id="terms&Con" required><label for="terms&Con">Terms & Conditions</label>
        </div>
       
          <div class="g-recaptcha" data-sitekey="6LdSgSYpAAAAABTdg_dwd7uTTyTYCnPv7r3yh1-o"></div> 
     
        
        <div class="form-button">
            <input type="submit" name="btnlogin" value="LOGIN">
        </div>
        <div class="form-link">
            <a href="CustomerRegister.php">You don't have an account? Please Register</a>
        </div>
          
         

          

         
	   </form>
</div>

<!-- for recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>