<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['ptcode'])) 
{
	$ptcode=$_GET['ptcode'];

     $payquery="SELECT * FROM PaymentTypetb WHERE PaymentTypeCode='$ptcode'";
     $result=mysqli_query($dbconnect,$payquery);
     $fetcharray=mysqli_fetch_array($result);

     $PaymentTypeCode=$fetcharray['PaymentTypeCode'];
     $PaymentType=$fetcharray['PaymentType'];
     $PaymentDescription=$fetcharray['PaymentDescription'];
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtptname=$_POST['txtptname'];
	$txtpaydescription=$_POST['txtpaydescription'];
    $txtptcode=$_POST['txtptcode'];

	$update="UPDATE PaymentTypetb
			SET 
			PaymentType='$txtptname', PaymentDescription='$txtpaydescription'
			WHERE PaymentTypeCode='$txtptcode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Payment Type data is Successfully Updated.')</script>";
        echo "<script>window.location='PaymentType.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Brand Update')</script>";
   		echo "<script>window.location='PaymentTypeUpdate.php'</script>";
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
		<a href="PaymentType.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Payment Type</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="ptname">Payment Type Name</label><br>
								<input type="text" id="ptname" name="txtptname" value="<?php  echo $PaymentType; ?>" required><br>

								<label for="desription">Payment Description</label><br>
								<input type="text" id="desription" name="txtpaydescription" value="<?php echo "$PaymentDescription"; ?>" required><br>

								<input type="hidden" name="txtptcode" value="<?php echo $PaymentTypeCode; ?>">
							
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
