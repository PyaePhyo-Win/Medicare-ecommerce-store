<?php 

include('connectmedicare.php');

if(isset($_POST['btnregister']))
{

  $fname=$_POST['txtFName'];
  $sname=$_POST['txtSName'];
  $uname=$_POST['txtUName'];
  $email=$_POST['txtEmail'];
  $pass=$_POST['txtPassword'];
  $phone=$_POST['txtPnumber'];
  $address=$_POST['txtaddress'];
 
  $admid = 'Adm_';
  $checkingrecentid = "SELECT MAX(RIGHT(AdminID, LENGTH(AdminID)-4)) AS RecentID FROM Admintb";
  $recentid=mysqli_query($dbconnect,$checkingrecentid);
  $row = mysqli_fetch_assoc($recentid);
  $recentid = $row['RecentID'];
  $admnewid = (int)$recentid + 1;
  $admid = $admid.(str_pad($admnewid, 4, '0', STR_PAD_LEFT));

  /* Password Format */

  $number=preg_match('@[0-9]@', $pass);
  $uppercase=preg_match('@[A-Z]@',$pass);
  $lowercase=preg_match('@[a-z]@', $pass);
  $special=preg_match('@[^\w]@',$pass);

  /* Checking Email */

   $checkemail="SELECT * FROM Admintb WHERE AdminEmail='$email'";
   $emailresult=mysqli_query($dbconnect,$checkemail);
   $count=mysqli_num_rows($emailresult);

  if ($count>0)
  {
    echo "<script>window.alert('Admin Email already exist! Try again')</script>";
    echo "<script>window.location='AdminRegister.php'</script>";
  }
  else if (strlen($pass)<8 || !$number || !$uppercase || !$lowercase || !$special) 
  {
    echo "<script>window.alert('Password must be at least 8 characters in length and must contian at least one upper, one number, one lower and one special character.')</script>";
    echo "<script>window.location='AdminRegister.php'</script>";

  }
  else
  {
   $insert="INSERT INTO Admintb(AdminID,AdminFirstName,AdminSurName,AdminUserName,AdminEmail,AdminPassword,AdminPhoneNo,AdminAddress)
       VALUES ('$admid','$fname','$sname','$uname','$email','$pass','$phone','$address')";

    $finalinsert=mysqli_query($dbconnect,$insert);

    if($finalinsert)
    {
       echo "<script>window.alert('Admin Registration is Successful.')</script>";
       echo "<script>window.location='AdminLogin.php'</script>";
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Medicare E-commerce Store</title>
   <link rel="stylesheet" type="text/css" href="adminstyle.css">
    
</head>
<body class="register-body">
    <div class="regcontainer">

    <h1 class="title-form">Admin Registration Form</h1>

     <form action="AdminRegister.php" method="POST">
      
      <div class="admininfo">
         <div class="inputbox">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="txtFName" placeholder="e.g Tun ---" required>
         </div>   
         <div class="inputbox">
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="txtSName" placeholder="e.g ---- Tun" required>
         </div>
         <div class="inputbox">
            <label for="username">Username</label>
            <input type="text" id="username" name="txtUName" placeholder="e.g Tun Gyi" required>
         </div>
       
         <div class="inputbox">
            <label for="email">Email</label>
            <input type="email" id="email" name="txtEmail" placeholder="----@gmail.com" required>
         </div>
         <div class="inputbox">
            <label for="password">Password</label>
            <input type="password" id="password" name="txtPassword" placeholder="abc----" required>
         </div>
         <div class="inputbox">
            <label for="pnumber">Phone Number</label>
            <input type="text" id="pnumber" name="txtPnumber" placeholder="+959------" required>
         </div>
         <div class="inputbox">
            <label for="address">Address</label>
            <textarea name="txtaddress" id="address" placeholder="e.g Yangon, Myanmar" required></textarea>
         </div>
      </div>

      <div class="terms">
        <input type="checkbox" id="terms&con" required><label for="terms&con">Terms & Conditions</label>
      </div>
      <div class="form-button">
         <input type="submit"  name="btnregister" value="Register">
         <input type="reset"  name="btnclear" value="Clear">
      </div>
      <div class="form-link">
         <a href="AdminLogin.php">"You already have an account? Please Login"</a>
      </div>
        

        

     </form>
 </div>


</body>
</html>
