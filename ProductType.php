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

	$producttype=$_POST['txtproducttype'];
	$description=$_POST['txtdescription'];
	

	/* Auto Increment ID for Product Type */
	$ptypecode = 'PT_';
	$checkingrecentid = "SELECT MAX(RIGHT(ProductTypeCode, LENGTH(ProductTypeCode)-4)) AS RecentID FROM ProductTypetb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$ptypenewcode = (int)$recentid + 1;
	$ptypecode = $ptypecode.(str_pad($ptypenewcode, 4, '0', STR_PAD_LEFT));

	// Checking duplicate product type
	$checkptype="SELECT * FROM ProductTypetb WHERE ProductTypeName='$producttype'";
	$checkresult=mysqli_query($dbconnect,$checkptype);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Product Type in Database')</script>";
		echo "<script>window.location='ProductType.php'</script>";
	}
	else{
		// Inserting data into product type table
	    $ptypeinsert="INSERT INTO ProductTypetb(ProductTypeCode,ProductTypeName,Description) 
					VALUES ('$ptypecode','$producttype','$description')";
		$ptypeinsertquery=mysqli_query($dbconnect,$ptypeinsert);

		if ($ptypeinsertquery) {
			echo "<script>window.alert('Adding Product Type is Successful.')</script>";
		echo "<script>window.location='ProductType.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Product Type.')</script>";
		echo "<script>window.location='ProductType.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Product Type</title>
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
                    <a href="#">
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
                    <a href="PaymentType.php">
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

					<h1 class="title-form">Add Product Type</h1>

					<form action="ProductType.php" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="producttype">Product Type Name</label><br>
								<input type="text" id="producttype" name="txtproducttype" placeholder="Enter Product Type" required><br>

								<label for="description">Product Type Description</label><br>
								<input type="text" id="description" name="txtdescription" placeholder="Enter Product Type Description" required><br>
							
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
							<h2>Product Type Lists</h2>
						</div>

						<table class="tbl-brand">

							<thead>
							
								<td>Product Type Code</td>
								<td>Product Type Name</td>
								<td>Product Description</td>
								<td>Action</td>
				
							</thead>
							<?php 

								$protypeselect="SELECT * FROM ProductTypetb";
								$result=mysqli_query($dbconnect,$protypeselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$protcode=$array['ProductTypeCode'];
									$protype=$array['ProductTypeName'];
									$desc=$array['Description'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$protcode</td>";
									echo "<td>$protype</td>";
									echo "<td>$desc</td>";
									echo "<td>
									
									<a href='ProductTypeUpdate.php?protcode=$protcode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='ProductTypeDelete.php?protcode=$protcode'><i class='fa-solid fa-trash'></i></a>

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