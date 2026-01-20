<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['beaprocode'])) 
{
	$beaprocode=$_GET['beaprocode'];

     $beaproselect="SELECT * FROM BeautyProducttb, Brandtb, ProductTypetb WHERE BeautyProducttb.BrandCode = Brandtb.BrandCode AND ProductTypetb.ProductTypeCode = BeautyProducttb.ProductTypeCode AND BeautyProductCode='$beaprocode'";
	 $result=mysqli_query($dbconnect,$beaproselect);
	 $array=mysqli_fetch_array($result);

	 $BeautyProductCode=$array['BeautyProductCode'];
	 $BeautyProductName=$array['BeautyProductName'];
	 $BenefitsofProduct=$array['BenefitsofProduct'];
	 $UsageInstruction=$array['UsageInstruction'];
	 $Storagelnstruction=$array['Storagelnstruction'];
	 $CountryofOrigin=$array['CountryofOrigin'];
	 $ProductPrice=$array['ProductPrice'];
	 $ProductQuantity=$array['ProductQuantity'];
	 $ExpiredDate=$array['ExpiredDate'];
	 $ManufacturedDate=$array['ManufacturedDate'];
	 $BrandName=$array['BrandName'];
	 $ProductTypeName=$array['ProductTypeName'];
     
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtbeautyproduct=$_POST['txtbeautyproduct'];
	$txtbenefitsofproduct=$_POST['txtbenefitsofproduct'];
	$txtusageinstruction=$_POST['txtusageinstruction'];
	$txtstorageinstruction=$_POST['txtstorageinstruction'];
	$txtcountryoforigin=$_POST['txtcountryoforigin'];
	$txtproductprice=$_POST['txtproductprice'];
	$txtproductquantity=$_POST['txtproductquantity'];
	$txtexpireddate=$_POST['txtexpireddate'];
	$txtmanudate=$_POST['txtmanudate'];
	$txtprotcode=$_POST['txtprotcode'];

	$update="UPDATE BeautyProducttb
			SET 
			BeautyProductName='$txtbeautyproduct',BenefitsofProduct='$txtbenefitsofproduct',
			UsageInstruction='$txtusageinstruction',Storagelnstruction='$txtstorageinstruction',
			CountryofOrigin='$txtcountryoforigin',ProductPrice='$txtproductprice',
			ProductQuantity='$txtproductquantity',ExpiredDate='$txtexpireddate',
			ManufacturedDate='$txtmanudate' 
			WHERE BeautyProductCode='$txtprotcode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Beauty Product data is Successfully Updated.')</script>";
        echo "<script>window.location='BeautyProduct.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Supplied Product Update')</script>";
   		echo "<script>window.location='BeautyProductUpdate.php'</script>";
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
		<a href="BeautyProduct.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">

				<div class="addsupplier">

					<h1 class="title-form">Update Beauty Product</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="beautyproduct">Beauty Product Name</label><br>
								<input type="text" id="beautyproduct" name="txtbeautyproduct" value="<?php echo $BeautyProductName; ?>" required><br>

								<label for="beautyproduct">Brand Name</label><br>
								<input type="text" id="beautyproduct" value="<?php echo $BrandName; ?>" readonly ><br>

								<label for="beautyproduct">Product Type Name</label><br>
								<input type="text" id="beautyproduct" value="<?php echo "$ProductTypeName"; ?>" readonly ><br>
								
								<label for="benefitsofproduct">Benefits of Product</label><br>
								<input type="text" id="benefitsofproduct" name="txtbenefitsofproduct" value="<?php echo "$BenefitsofProduct"; ?>" required><br>

								<label for="usageinstruction">Usage Instruction</label><br>
								<input type="text" id="usageinstruction" name="txtusageinstruction" value="<?php echo "$UsageInstruction"; ?>" required><br>

								<label for="storageinstruction">Storage Instruction</label><br>
								<input type="text" id="storageinstruction" name="txtstorageinstruction" value="<?php echo "$Storagelnstruction"; ?>" required><br>

								<label for="countryoforigin">Country of Origin</label><br>
								<input type="text" id="countryoforigin" name="txtcountryoforigin" value="<?php echo "$CountryofOrigin"; ?>" required><br>

								<label for="productprice">Product Price</label><br>
								<input type="text" id="productprice" name="txtproductprice" value="<?php echo $ProductPrice; ?>" required><br>

								<label for="productquantity">Product Quantity</label><br>
								<input type="text" id="productquantity" name="txtproductquantity" value="<?php echo $ProductQuantity; ?>" required><br>

								<label for="expireddate">Expired Date</label><br>
								<input type="date" id="expireddate" name="txtexpireddate"value="<?php echo $ExpiredDate; ?>" required><br>

								<label for="manudate">Manufactured Date</label><br>
								<input type="date" id="manudate"  name="txtmanudate" value="<?php echo $ManufacturedDate; ?>" required><br>

								<input type="hidden" name="txtprotcode" value="<?php echo $BeautyProductCode; ?>">
							
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
