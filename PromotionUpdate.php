<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['promocode'])) 
{
	$promocode=$_GET['promocode'];

     $promoquery="SELECT * FROM Promotiontb WHERE PromotionCode='$promocode'";
     $result=mysqli_query($dbconnect,$promoquery);
     $fetcharray=mysqli_fetch_array($result);

     $PromotionCode=$fetcharray['PromotionCode'];
     $PromotionName=$fetcharray['PromotionName'];
     $PromotionMonth=$fetcharray['PromotionMonth'];
     $PromotionDescription=$fetcharray['PromotionDescription'];
     
}

if (isset($_POST['btnupdate'])) 
{
	$txtpromoname=$_POST['txtpromoname'];
	$txtpromomonth=$_POST['txtpromomonth'];
	$txtdescription=$_POST['txtdescription'];
	$txtpromocode=$_POST['txtpromocode'];

	$update="UPDATE Promotiontb
			SET 
			PromotionName='$txtpromoname',PromotionMonth='$txtpromomonth', 
			PromotionDescription='$txtdescription'
			WHERE PromotionCode='$txtpromocode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Promotion data is Successfully Updated.')</script>";
        echo "<script>window.location='Promotion.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Promotion Update')</script>";
   		echo "<script>window.location='PromotionUpdate.php'</script>";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Promotion Update</title>
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

				<h1 class="title-form">Update Promotion</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="promoname">Promotion Name</label><br>
								<input type="text" id="promoname" name="txtpromoname" value="<?php  echo $PromotionName; ?>" required><br>

								<label for="promomonth">Promotion Month</label><br>
								<input type="text" id="promomonth" name="txtpromomonth" value="<?php echo $PromotionMonth; ?>" required><br>

								<label for="promodesc">Promotion Description</label><br>
								<input type="text" id="promodesc" name="txtdescription" value="<?php echo $PromotionDescription; ?>" required><br>

								<input type="hidden" name="txtpromocode" value="<?php echo $PromotionCode; ?>">
							
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