<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['deliid'])) 
{
	$deliid=$_GET['deliid'];

     $deliquery="SELECT * FROM Deliverytb WHERE DeliveryID='$deliid'";
     $result=mysqli_query($dbconnect,$deliquery);
     $fetcharray=mysqli_fetch_array($result);

     $DeliveryID=$fetcharray['DeliveryID'];
     $DeliveryName=$fetcharray['DeliveryName'];
     $DeliveryPhone=$fetcharray['DeliveryPhone'];
     $DeliveryEmail=$fetcharray['DeliveryEmail'];
     $DeliveryOfficeAddress=$fetcharray['DeliveryOfficeAddress'];
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtdeliname=$_POST['txtdeliname'];
	$txtdeliphone=$_POST['txtdeliphone'];
	$txtdeliemail=$_POST['txtdeliemail'];
	$txtdeliaddress=$_POST['txtdeliaddress'];
	$txtdeliid=$_POST['txtdeliid'];

	$update="UPDATE Deliverytb
			SET 
			DeliveryName='$txtdeliname',DeliveryPhone='$txtdeliphone', 
			DeliveryEmail='$txtdeliemail',DeliveryOfficeAddress='$txtdeliaddress'
			WHERE DeliveryID='$txtdeliid'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Delivery data is Successfully Updated.')</script>";
        echo "<script>window.location='Delivery.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Delivery Update')</script>";
   		echo "<script>window.location='DeliveryUpdate.php'</script>";
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
		<a href="Delivery.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Delivery</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="deliname">Delivery Name</label><br>
								<input type="text" id="deliname" name="txtdeliname" value="<?php  echo $DeliveryName; ?>" required><br>

								<label for="deliphone">Delivery Phone</label><br>
								<input type="text" id="deliphone" name="txtdeliphone" value="<?php echo $DeliveryPhone; ?>" required><br>

								<label for="delieamil">Delivery Email</label><br>
								<input type="email" id="deliemail" name="txtdeliemail" value="<?php echo "$DeliveryEmail"; ?>" required><br>

								<label for="deliaddress">Delivery Office Address</label><br>
								<input type="text" id="deliaddress" name="txtdeliaddress" value="<?php echo "$DeliveryOfficeAddress"; ?>" required><br>

								<input type="hidden" name="txtdeliid" value="<?php echo $DeliveryID; ?>">
							
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