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

	$supname=$_POST['txtsupname'];
	$supphone=$_POST['txtsupphone'];
	$supemail=$_POST['txtsupemail'];
	$supaddress=$_POST['txtsupaddress'];

	$supid = 'Sup_';
	$checkingrecentid = "SELECT MAX(RIGHT(SupplierID, LENGTH(SupplierID)-4)) AS RecentID FROM Suppliertb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$supnewid = (int)$recentid + 1;
	$supid = $supid.(str_pad($supnewid, 4, '0', STR_PAD_LEFT));

	$checksup="SELECT * FROM Suppliertb WHERE SupplierName='$supname'";
	$checkresult=mysqli_query($dbconnect,$checksup);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Supplier Name in Database')</script>";
		echo "<script>window.location='Supplier.php'</script>";
	}
	else{
	    $supinsert="INSERT INTO Suppliertb(SupplierID, SupplierName,
	    	SupplierPhoneNo, SupplierEmail, SupplierAddress	) 
					VALUES ('$supid','$supname','$supphone','$supemail','$supaddress')";
		$supinsertquery=mysqli_query($dbconnect,$supinsert);

		if ($supinsertquery) {
			echo "<script>window.alert('Adding Supplier is Successful.')</script>";
		echo "<script>window.location='Supplier.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Supplier.')</script>";
		echo "<script>window.location='Supplier.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Supplier</title>
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
                    <a href="#">
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

				<h1 class="title-form">Add Supplier</h1>

					<form action="Supplier.php" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="supname">Supplier Name</label><br>
								<input type="text" id="supname" name="txtsupname" placeholder="Enter Supplier Name" required><br>

								<label for="supphone">Supplier Phone</label><br>
								<input type="text" id="supphone" name="txtsupphone" placeholder="Enter Supplier Phone Number" required><br>

								<label for="supeamil">Supplier Email</label><br>
								<input type="email" id="supemail" name="txtsupemail" placeholder="Enter Supplier Email" required><br>

								<label for="supaddress">Supplier Address</label><br>
								<input type="text" id="supaddress" name="txtsupaddress" placeholder="Enter Supplier Address" required><br>
							
							</div>

						</div>
					
						<div class="Supform-button">
							<input type="submit" name="btnadd" value="ADD">
						</div>

					</form>
			</div>

		</div>
			<div class="admin-tables">

				<div class="supplier">

					<div class="heading">
						<h2>Supplier Lists</h2>
					</div>

						<table class="tbl-supplier">

							<thead>
								<td>Supplier ID</td>
								<td>Supplier Name</td>
								<td>Supplier Phone</td>
								<td>Supplier Email</td>
								<td>Supplier Address</td>
								<td>Action</td>
							</thead>
							<?php 

								$supselect="SELECT * FROM Suppliertb";
								$result=mysqli_query($dbconnect,$supselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$supid=$array['SupplierID'];
									$supname=$array['SupplierName'];
									$supphone=$array['SupplierPhoneNo'];
									$supemail=$array['SupplierEmail'];
									$supaddress=$array['SupplierAddress'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$supid</td>";
									echo "<td>$supname</td>";
									echo "<td>$supphone</td>";
									echo "<td>$supemail</td>";
									echo "<td>$supaddress</td>";
									echo "<td>
									
									<a href='SupplierUpdate.php?supid=$supid'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='SupplierDelete.php?supid=$supid'><i class='fa-solid fa-trash'></i></a>

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