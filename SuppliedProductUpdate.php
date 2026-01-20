<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['supdcode'])) 
{
	$supdcode=$_GET['supdcode'];

     $supdquery="SELECT * FROM Supplier_BeautyProducttb, BeautyProducttb, Suppliertb WHERE BeautyProducttb.BeautyProductCode = Supplier_BeautyProducttb.BeautyProductCode AND Suppliertb.SupplierID = Supplier_BeautyProducttb.SupplierID AND SuppliedCode='$supdcode'";
     $result=mysqli_query($dbconnect,$supdquery);
     $fetcharray=mysqli_fetch_array($result);

     $SuppliedCode=$fetcharray['SuppliedCode'];
     $BeautyProductName=$fetcharray['BeautyProductName'];
     $SupplierName=$fetcharray['SupplierName'];
     $SuppliedDate=$fetcharray['SuppliedDate'];
     $SuppliedProductQuantity=$fetcharray['SuppliedProductQuantity'];
     $SuppliedUnitPrice=$fetcharray['SuppliedUnitPrice'];
     $TotalPrice=$fetcharray['TotalPrice'];
     
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtsupunitprice=$_POST['txtsupunitprice'];
	$txtsupproqty=$_POST['txtsupproqty'];
	$totalprice=$txtsupproqty*$txtsupunitprice;
	$txtsupdcode=$_POST['txtsupdcode'];

	$update="UPDATE Supplier_BeautyProducttb
			SET 
			SuppliedProductQuantity='$txtsupproqty',SuppliedUnitPrice='$txtsupunitprice',
			TotalPrice='$totalprice'
			WHERE SuppliedCode='$txtsupdcode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Supplied Product data is Successfully Updated.')</script>";
        echo "<script>window.location='SuppliedProduct.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Supplied Product Update')</script>";
   		echo "<script>window.location='SuppliedProductUpdate.php'</script>";
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
		<a href="SuppliedProduct.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Supplied Product</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">

								<label >Beauty Product Name</label><br>
								<input type="text" value="<?php  echo $BeautyProductName; ?>" readonly ><br>

								<label >Supplier Name</label><br>
								<input type="text" value="<?php echo "$SupplierName"; ?>" readonly ><br>

								<label>Supplied Date</label><br>
								<input type="text" value="<?php  echo $SuppliedDate; ?>" readonly><br>

								<label for="supproductqty">Supplied Product Quantity</label><br>
								<input type="text" id="supproductqty" name="txtsupproqty" value="<?php echo "$SuppliedProductQuantity"; ?>" required><br>
							
								<label for="supunitprice">Supplied Unit Price</label><br>
								<input type="text" id="supunitprice" name="txtsupunitprice" value="<?php  echo $SuppliedUnitPrice; ?>" required><br>

								<label>Total Price</label><br>
								<input type="text" value="<?php echo "$TotalPrice"; ?>" readonly ><br>

								<input type="hidden" name="txtsupdcode" value="<?php echo $SuppliedCode; ?>">
							
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
