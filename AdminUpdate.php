<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['admid'])) 
{
	$admid=$_GET['admid'];

     $admquery="SELECT * FROM Admintb WHERE AdminID='$admid'";
     $result=mysqli_query($dbconnect,$admquery);
     $array=mysqli_fetch_array($result);

     $AdminID=$array['AdminID'];
	 $AdminFirstName=$array['AdminFirstName'];
	 $AdminSurName=$array['AdminSurName'];
	 $AdminUsername=$array['AdminUsername'];
	 $AdminPhoneNo=$array['AdminPhoneNo'];
	 $AdminEmail=$array['AdminEmail'];
	 $AdminPassword=$array['AdminPassword'];
	 $AdminAddress=$array['AdminAddress'];
   
}
if(isset($_POST['btnupdate']))
{

  $fname=$_POST['txtFName'];
  $sname=$_POST['txtSName'];
  $uname=$_POST['txtUName'];
  $email=$_POST['txtEmail'];
  $pass=$_POST['txtPassword'];
  $phone=$_POST['txtPnumber'];
  $address=$_POST['txtaddress'];
  $admid=$_POST['txtadmid'];

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
    echo "<script>window.location='AdminUpdate.php'</script>";
  }
  else if (strlen($pass)<8 || !$number || !$uppercase || !$lowercase || !$special) 
  {
    echo "<script>window.alert('Password must be at least 8 characters in length and must contian at least one upper, one number, one lower and one special character.')</script>";
    echo "<script>window.location='AdminUpdate.php'</script>";

  }
  else
  {
   $update="UPDATE Admintb
			SET 
			AdminFirstName='$fname',AdminSurName='$sname', 
			AdminUsername='$uname',AdminPhoneNo='$phone',
			AdminEmail='$email',AdminPassword='$pass',
			AdminAddress='$address'
			WHERE AdminID='$admid'";
    $finalupdate=mysqli_query($dbconnect,$update);

    if($finalupdate)
    {
       echo "<script>window.alert('Updating Admin Data is Successful.')</script>";
       echo "<script>window.location='AdminListings.php'</script>";
    }
    else
    {
    	echo "<script>window.alert('Updating Admin Data Failed.')</script>";
       echo "<script>window.location='AdminUpdate.php'</script>";
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
	<link rel="stylesheet" type="text/css" href="AdminStyle.css">
	<script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>
<body class="updatebody">
	<div class="Updateheader">
		<a href="AdminListings.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Admin</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="admfname">Admin FirstName</label><br>
								<input type="text" id="admfname" name="txtFName" value="<?php  echo $AdminFirstName; ?>" required><br>

								<label for="admsname">Admin SurName</label><br>
								<input type="text" id="admsname" name="txtSName" value="<?php  echo $AdminSurName; ?>" required><br>

								<label for="admuname">Admin Username</label><br>
								<input type="text" id="admuname" name="txtUName" value="<?php  echo $AdminUsername; ?>" required><br>

								<label for="admphone">Admin Phone</label><br>
								<input type="text" id="admphone" name="txtPnumber" value="<?php echo "$AdminPhoneNo"; ?>" required><br>

								<label for="admeamil">Admin Email</label><br>
								<input type="email" id="admemail" name="txtEmail" value="<?php echo "$AdminEmail"; ?>" required><br>

								<label for="admpass">Admin Password</label><br>
								<input type="password" id="admpass" name="txtPassword" value="<?php echo "$AdminPassword"; ?>" required><br>

								<label for="admaddress">Admin Address</label><br>
								<input type="text" id="admaddress" name="txtaddress" value="<?php echo "$AdminAddress"; ?>" required><br>

								<input type="hidden" name="txtadmid" value="<?php echo $AdminID; ?>">
							
							</div>

						</div>
					
						<div class="Supform-button">
							<input type="submit" name="btnupdate" value="UPDATE">
						</div>

					</form>
			</div>

		</div>

	
       
</body>
</html>
