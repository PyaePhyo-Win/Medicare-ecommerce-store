<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['protcode'])) 
{
	$protcode=$_GET['protcode'];

     $protquery="SELECT * FROM ProductTypetb WHERE ProductTypeCode='$protcode'";
     $result=mysqli_query($dbconnect,$protquery);
     $fetcharray=mysqli_fetch_array($result);

     $ProductTypeCode=$fetcharray['ProductTypeCode'];
     $ProductTypeName=$fetcharray['ProductTypeName'];
     $Description=$fetcharray['Description'];
     
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtprotname=$_POST['txtprotname'];
	$txtprotdescription=$_POST['txtprotdescription'];
	$txtprotcode=$_POST['txtprotcode'];

	$update="UPDATE ProductTypetb
			SET 
			ProductTypeName='$txtprotname',Description='$txtprotdescription'
			WHERE ProductTypeCode='$txtprotcode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Product Type data is Successfully Updated.')</script>";
        echo "<script>window.location='ProductType.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Brand Update')</script>";
   		echo "<script>window.location='ProductTypeUpdate.php'</script>";
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
		<a href="ProductType.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Product Type</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="protname">Product Type Name</label><br>
								<input type="text" id="protname" name="txtprotname" value="<?php  echo $ProductTypeName; ?>" required><br>

								<label for="desription">Description</label><br>
								<input type="text" id="desription" name="txtprotdescription" value="<?php echo "$Description"; ?>" required><br>

								<input type="hidden" name="txtprotcode" value="<?php echo $ProductTypeCode; ?>">
							
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
