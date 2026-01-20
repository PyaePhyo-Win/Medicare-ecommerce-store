<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['supid'])) 
{
	$supid=$_GET['supid'];

     $supquery="SELECT * FROM Suppliertb WHERE SupplierID='$supid'";
     $result=mysqli_query($dbconnect,$supquery);
     $fetcharray=mysqli_fetch_array($result);

     $SupplierID=$fetcharray['SupplierID'];
     $SupplierName=$fetcharray['SupplierName'];
     $SupplierPhoneNo=$fetcharray['SupplierPhoneNo'];
     $SupplierEmail=$fetcharray['SupplierEmail'];
     $SupplierAddress=$fetcharray['SupplierAddress'];
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtsupname=$_POST['txtsupname'];
	$txtsupphone=$_POST['txtsupphone'];
	$txtsupemail=$_POST['txtsupemail'];
	$txtsupaddress=$_POST['txtsupaddress'];
	$txtsupid=$_POST['txtsupid'];

	$update="UPDATE Suppliertb
			SET 
			SupplierName='$txtsupname',SupplierPhoneNo='$txtsupphone', 
			SupplierEmail='$txtsupemail',SupplierAddress='$txtsupaddress'
			WHERE SupplierID='$txtsupid'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Supplier data is Successfully Updated.')</script>";
        echo "<script>window.location='Supplier.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Supplier Update')</script>";
   		echo "<script>window.location='SupplierUpdate.php'</script>";
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
		<a href="Supplier.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Supplier</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="supname">Supplier Name</label><br>
								<input type="text" id="supname" name="txtsupname" value="<?php  echo $SupplierName; ?>" required><br>

								<label for="supphone">Supplier Phone</label><br>
								<input type="text" id="supphone" name="txtsupphone" value="<?php echo "$SupplierPhoneNo"; ?>" required><br>

								<label for="supeamil">Supplier Email</label><br>
								<input type="email" id="supemail" name="txtsupemail" value="<?php echo "$SupplierEmail"; ?>" required><br>

								<label for="supaddress">Supplier Address</label><br>
								<input type="text" id="supaddress" name="txtsupaddress" value="<?php echo "$SupplierAddress"; ?>" required><br>

								<input type="hidden" name="txtsupid" value="<?php echo $SupplierID; ?>">
							
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
