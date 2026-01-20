<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['brcode'])) 
{
	$brcode=$_GET['brcode'];

     $brquery="SELECT * FROM Brandtb WHERE BrandCode='$brcode'";
     $result=mysqli_query($dbconnect,$brquery);
     $fetcharray=mysqli_fetch_array($result);

     $BrandCode=$fetcharray['BrandCode'];
     $BrandName=$fetcharray['BrandName'];
     $Description=$fetcharray['Description'];
     
   
}

if (isset($_POST['btnupdate'])) 
{
	$txtbrname=$_POST['txtbrname'];
	$txtbrdescription=$_POST['txtbrdescription'];
	$txtbrcode=$_POST['txtbrcode'];

	$update="UPDATE Brandtb
			SET 
			BrandName='$txtbrname',Description='$txtbrdescription'
			WHERE BrandCode='$txtbrcode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Brand data is Successfully Updated.')</script>";
        echo "<script>window.location='Brand.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Brand Update')</script>";
   		echo "<script>window.location='BrandUpdate.php'</script>";
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
		<a href="Brand.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Brand</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="brname">Brand Name</label><br>
								<input type="text" id="brname" name="txtbrname" value="<?php  echo $BrandName; ?>" required><br>

								<label for="desription">Description</label><br>
								<input type="text" id="desription" name="txtbrdescription" value="<?php echo "$Description"; ?>" required><br>

								<input type="hidden" name="txtbrcode" value="<?php echo $BrandCode; ?>">
							
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
