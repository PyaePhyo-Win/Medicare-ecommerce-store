<?php

session_start();

include('connectmedicare.php');

if(isset($_POST['btnlogin']))
{
	$email=$_POST['txtemail'];
	$pass=$_POST['txtpassword'];

	$checkvalid="SELECT * FROM Admintb WHERE AdminEmail='$email' AND AdminPassword='$pass'";
  $result=mysqli_query($dbconnect,$checkvalid);
  $count=mysqli_num_rows($result);

    if($count>0)
    {
      $array=mysqli_fetch_array($result);

      $aid=$array['AdminID'];
      $afname=$array['AdminFirstName'];
      $asname=$array['AdminSurName'];
      $auname=$array['AdminUsername'];
      
  
      $_SESSION['AID']=$aid;
      $_SESSION['AFNAME']=$afname;
      $_SESSION['ASNAME']=$asname;
      $_SESSION['AUNAME']=$auname;
      
      
      echo "<script>window.alert('Login successful')</script>";
      echo "<script>window.location='AdminDashboard.php'</script>";
    }
    else
    {
      echo "<script>window.alert('Login Fail')</script>";
      echo "<script>window.location='AdminLogin.php'</script>";
    }

}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <link rel="stylesheet" type="text/css" href="AdminStyle.css">
</head>
<body class="adminlogin" >

  <div class="loginContainer">

    <h1 class="title-form">Admin Login Form</h1>

	   <form action="AdminLogin.php" method="POST">

        <div class="admininfo">
            <div class="inputbox-login">
              <label for="email">Email</label>
		      <input type="email" id="email" name="txtemail" placeholder="Enter your Email" required>
            </div>
            <div class="inputbox-login">
                <label for="pass">Password</label> 
                <input type="password" id="pass" name="txtpassword" placeholder="Enter your password" required>
            </div>
        </div>

		     
        <div class="terms">
            <input type="checkbox" id="terms&Con" required><label for="terms&Con">Terms & Conditions</label>
        </div>
        <div class="form-button">
            <input type="submit" name="btnlogin" value="LOGIN">
        </div>
        <div class="form-link">
            <a href="AdminRegister.php">You don't have an account? Please Register</a>
        </div>
          
         

          

         
	   </form>
</div>

</body>
</html>