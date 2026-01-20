<?php 

session_start();

include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Add Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_POST['btnadd'])) {

	$paymenttype=$_POST['txtpaymenttype'];
	$description=$_POST['txtdescription'];
	

	/* Auto Increment ID for Payment Type */
	$payid = 'Pay_';
	$checkingrecentid = "SELECT MAX(RIGHT(PaymentTypeCode, LENGTH(PaymentTypeCode)-4)) AS RecentID FROM PaymentTypetb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$promonewid = (int)$recentid + 1;
	$payid = $payid.(str_pad($promonewid, 4, '0', STR_PAD_LEFT));

	// Copying image
	$paytypelogo=$_FILES['txtpaytypelogo']['name'];
	$folder="Medicareimage/";
	$paytypefilename=$folder."_".$paytypelogo;

	$copy=copy($_FILES['txtpaytypelogo']['tmp_name'], $paytypefilename);

	if (!$copy) {
		echo "<p>('Cannot upload Payment Type Logo Image')</p>";
		exit();
	}

	// Checking duplicate payment type
	$checkpaytype="SELECT * FROM PaymentTypetb WHERE PaymentType='$paymenttype'";
	$checkresult=mysqli_query($dbconnect,$checkpaytype);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Payment Type in Database')</script>";
		echo "<script>window.location='PaymentType.php'</script>";
	}
	else{
		// Inserting data into payment type table
	     $paytypeinsert="INSERT INTO PaymentTypetb(PaymentTypeCode,PaymentType,PaymentDescription,PaymentTypeLogo) 
					VALUES ('$payid','$paymenttype','$description','$paytypefilename')";
		$paytypeinsertquery=mysqli_query($dbconnect,$paytypeinsert);
		if ($paytypeinsertquery) {
			echo "<script>window.alert('Adding Payment Type is Successful.')</script>";
			echo "<script>window.location='PaymentType.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Payment Type.')</script>";
			echo "<script>window.location='PaymentType.php'</script>";
		} 
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Payment Type</title>
	<link rel="stylesheet" type="text/css" href="AdminStyle.css">
	<script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="admincontainer">
        <aside class="sidebar">
            <ul>
                <li>
                    <a href="AdminDashboard.php">
                    <i class="fas fa-home"></i>
                    <div class="title">Medicare E-commerce</div>
                    </a>
                </li>
                <li>
                    <a href="AdminDashboard.php">
                    <i class="fas fa-th-large"></i>
                    <div class="title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="Supplier.php">
                    <i class="fa-solid fa-people-group"></i>
                    <div class="title">Add Supplier</div>
                    </a>
                </li>
                <li>
                    <a href="ProductType.php">
                    <i class="fa-brands fa-product-hunt"></i>
                    <div class="title">Add ProductType</div>
                    </a>
                </li>
                <li>
                    <a href="Brand.php">
                    <i class="fa-solid fa-b"></i>
                    <div class="title">Add Brand</div>
                    </a>
                </li>
                <li>
                    <a href="BeautyProduct.php">
                    <i class="fa-solid fa-pills"></i>   
                    <div class="title">Add BeautyProduct</div>
                    </a>
                </li>
                <li>
                    <a href="SuppliedProduct.php">
                    <i class="fa-solid fa-boxes-packing"></i> 
                    <div class="title">Add SuppliedProduct</div>
                    </a>
                </li>
				<li>
                    <a href="Promotion.php">
                    <i class="fa-solid fa-percent"></i>   
                    <div class="title">Add Promotion</div>
                    </a>
                </li>
                <li>
                    <a href="AssignPromotion.php">
                    <i class="fa-solid fa-tags"></i>
                    <div class="title">Assign PromotionOnProduct</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                    <div class="title">Add PaymentType</div>
                    </a>
                </li>
                <li>
                    <a href="Delivery.php">
                    <i class="fa-solid fa-truck"></i>   
                    <div class="title">Add Delivery</div>
                    </a>
                </li>
                <li>
                    <a href="AdminListings.php">
                    <i class="fa-brands fa-black-tie"></i>   
                    <div class="title">Admin Listings</div>
                    </a>
                </li>
				<li>
                    <a href="CustomerListing.php">
                    <i class="fa-brands fa-black-tie"></i>   
                    <div class="title">Customer Listings</div>
                    </a>
                </li>
                <li>
                    <a href="AdminLogout.php">
                    <i class='fa-solid fa-right-from-bracket'></i>  
                    <div class="title">Logout</div>
                    </a>
                </li>
            </ul>
        </aside>
        <main class="main">
            <header class="admin-top-bar">
                <div class="searchbar">
                    <input type="text" name="search" placeholder="Search here">
                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div>
                <i class="fa-solid fa-bell"></i>
                <div class="user-admin">
					<i class="fa-solid fa-user"></i>
					<div class="name"><?php echo $AUN ?></div>
                </div>
            </header>
        
            <div class="SupContainer">

				<div class="addsupplier">

					<h1 class="title-form">Add Payment Type</h1>

					<form action="PaymentType.php" method="POST" enctype="multipart/form-data">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="paymenttype">Payment Type</label><br>
								<input type="text" id="paymenttype" name="txtpaymenttype" placeholder="Enter Payment Type" required><br>

								<label for="description">Payment Description</label><br>
								<input type="text" id="description" name="txtdescription" placeholder="Enter Payment Description" required><br>

								<label for="paytypelogo">Payment Type Logo</label><br>
								<input type="file" id="paytypelogo" name="txtpaytypelogo" required>
							
							</div>

						</div>
						
						<div class="Supform-button">
							<input type="submit" name="btnadd" value="ADD">
						</div>

					</form>

				</div>

			</div>

				<div class="admin-tables">

					<div class="brand">

						<div class="heading">
							<h2>Payment Type Lists</h2>
						</div>

						<table class="tbl-brand">

							<thead>
							
								<td>Payment Type Code</td>
								<td>Payment Type</td>
								<td>Payment Description</td>
								<td>Payment Type Logo</td>
								<td>Action</td>
							
							</thead>
							<?php 

								$paytypeselect="SELECT * FROM PaymentTypetb";
								$result=mysqli_query($dbconnect,$paytypeselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$ptcode=$array['PaymentTypeCode'];
									$ptype=$array['PaymentType'];
									$desc=$array['PaymentDescription'];
									$logo=$array['PaymentTypeLogo'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$ptcode</td>";
									echo "<td>$ptype</td>";
									echo "<td>$desc</td>";
									echo "<td><img src='$logo' class='tbl-photo'></td>";
									echo "<td>
									
									<a href='PaymentTypeUpdate.php?ptcode=$ptcode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='PaymentTypeDelete.php?ptcode=$ptcode'><i class='fa-solid fa-trash'></i></a>

									</td>";

									echo "</tr>";
									echo "</tbody>";

								}

							?>

						</table>

					</div>

				</div>


            <footer class="admin-footer">
                <p>Copyright © 2024 Medicare. All rights reserved. Created by PPW.</p>
            </footer>
		</main>
</div>


</body>
</html>