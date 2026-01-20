<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['procode'])) 
{
	$procode=$_GET['procode'];
    $beautycode=$_GET['beautycode'];

     $promoquery="SELECT * FROM Promotion_BeautyProducttb WHERE PromotionCode='$procode' AND BeautyProductCode='$beautycode'";
     $result=mysqli_query($dbconnect,$promoquery);
     $fetcharray=mysqli_fetch_array($result);

     $PromotionCode=$fetcharray['PromotionCode'];
     $BeautyProductCode=$fetcharray['BeautyProductCode'];
     $PromotionRate=$fetcharray['PromotionRate'];
     $PromotionStartDate=$fetcharray['PromotionStartDate'];
     $PromotionEndDate=$fetcharray['PromotionEndDate'];
     $PromotionDuration=$fetcharray['PromotionDuration'];
     
}

if (isset($_POST['btnupdate'])) 
{
	$txtpromorate=$_POST['txtpromorate'];
	$txtpromostdate=$_POST['txtpromostdate'];
	$txtpromoendate=$_POST['txtpromoendate'];
	$txtpromoduration=$_POST['txtpromoduration'];
    $txtpromocode=$_POST['txtpromocode'];
    $txtbeaprocode=$_POST['txtbeaprocode'];

	$update="UPDATE Promotion_BeautyProducttb
			SET 
			PromotionRate='$txtpromorate',PromotionStartDate='$txtpromostdate', 
			PromotionEndDate='$txtpromoendate',PromotionDuration='$txtpromoduration'
			WHERE PromotionCode='$txtpromocode' AND BeautyProductCode='$txtbeaprocode'";

	$result=mysqli_query($dbconnect,$update);

	if ($result) 
	{
		echo "<script>window.alert('Assigned Promotion data is Successfully Updated.')</script>";
        echo "<script>window.location='AssignPromotion.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Assigned Promotion Update')</script>";
   		echo "<script>window.location='AssignPromotionUpdate.php'</script>";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Assigned Promotion Update</title>
	<link rel="stylesheet" type="text/css" href="AdminStyle.css">
	<script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>
<body class="updatebody">
	<div class="Updateheader">
		<a href="AssignPromotion.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"> <?php echo $AUN ; ?></i>  
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Update Assigned Promotion</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="promorate">Promotion Rate</label><br>
								<input type="text" id="promorate" name="txtpromorate" value="<?php  echo $PromotionRate; ?>" required><br>

								<label for="promostdate">Promotion Start Date</label><br>
								<input type="date" id="promostdate" name="txtpromostdate" value="<?php echo $PromotionStartDate; ?>" required><br>

								<label for="promoendate">Promotion End Date</label><br>
								<input type="date" id="promoendate" name="txtpromoendate" value="<?php echo $PromotionEndDate; ?>" required><br>

                                <label for="promoduration">Promotion Duration</label><br>
								<input type="text" id="promoduration" name="txtpromoduration" value="<?php  echo $PromotionDuration; ?>" required><br>

								<input type="hidden" name="txtpromocode" value="<?php echo $PromotionCode; ?>">

                                <input type="hidden" name="txtbeaprocode" value="<?php echo $BeautyProductCode; ?>">
							
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