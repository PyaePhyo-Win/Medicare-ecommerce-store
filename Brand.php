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

	$brandname=$_POST['txtbrandname'];
	$description=$_POST['txtdescription'];
	

	/* Auto Increment ID for Brand */
	$brandcode = 'Br_';
	$checkingrecentid = "SELECT MAX(RIGHT(BrandCode, LENGTH(BrandCode)-4)) AS RecentID FROM Brandtb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$brandnewcode = (int)$recentid + 1;
	$brandcode = $brandcode.(str_pad($brandnewcode, 4, '0', STR_PAD_LEFT));

	// Checking duplicate brand name
	$checkbrand="SELECT * FROM Brandtb WHERE BrandName='$brandname'";
	$checkresult=mysqli_query($dbconnect,$checkbrand);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Brand Name in Database')</script>";
		echo "<script>window.location='Brand.php'</script>";
	}
	else{
		// Inserting data into brand table
	    $brandinsert="INSERT INTO Brandtb(BrandCode,BrandName,Description) 
					VALUES ('$brandcode','$brandname','$description')";
		$brandinsertquery=mysqli_query($dbconnect,$brandinsert);

		if ($brandinsertquery) {
			echo "<script>window.alert('Adding Brand is Successful.')</script>";
		echo "<script>window.location='Brand.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Brand.')</script>";
		echo "<script>window.location='Brand.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Brand</title>
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
                    <a href="#">
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
        <div class="brandContainer">

		<div class="addbrand">

			<h1 class="title-form">Add Brand</h1>

			<form action="Brand.php" method="POST">

				<div class="brandform"> 

					<div class="brandinfo">
					
						<label for="brandname">Brand Name</label>
						<input type="text" id="brandname" name="txtbrandname" placeholder="Enter Brand Name" required><br>

						<label for="description">Brand Description</label>
						<input type="text" id="description" name="txtdescription" placeholder="Enter Brand Description" required><br>
					
					</div>

				</div>
				
				<div class="Brandform-button">
					<input type="submit" name="btnadd" value="ADD">
				</div>

			</form>
		</div>
		</div>
		<div class="admin-tables">

			<div class="brand">

					<div class="heading">
                        <h2>Brand Lists</h2>
                    </div>

				<table class="tbl-brand">

					<thead>
						<td>Brand Code</td>
						<td>Brand Name</td>
						<td>Brand Description</td>
						<td>Action</td>
					</thead>

					<?php 

						$brandselect="SELECT * FROM Brandtb";
						$result=mysqli_query($dbconnect,$brandselect);
						$count=mysqli_num_rows($result);

						for ($i=0; $i <$count ; $i++) 
						{ 
							$array=mysqli_fetch_array($result);
							$brcode=$array['BrandCode'];
							$brname=$array['BrandName'];
							$desc=$array['Description'];

							echo "<tbody>";
							echo "<tr>";

							echo "<td>$brcode</td>";
							echo "<td>$brname</td>";
							echo "<td>$desc</td>";
							echo "<td>
							
							<a href='BrandUpdate.php?brcode=$brcode'><i class='fa-solid fa-pen-to-square'></i></a>
							<a href='BrandDelete.php?brcode=$brcode'><i class='fa-solid fa-trash'></i></a>

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